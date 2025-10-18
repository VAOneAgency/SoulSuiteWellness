<?php
/**
 * Soulara Form Builder - Shortcode
 * 
 * Handles the shortcode to display forms and form submission processing
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register the form shortcode
 */
function soulara_form_shortcode($atts) {
    $atts = shortcode_atts(array(
        'id' => 0,
    ), $atts, 'soulara_form');
    
    $form_id = absint($atts['id']);
    
    if (empty($form_id) || 'soulara_form' !== get_post_type($form_id)) {
        return '<p class="error">' . __('Invalid form. Please check the form ID.', 'monalisa') . '</p>';
    }
    
    // Get form configuration
    $form_settings = get_post_meta($form_id, '_form_settings', true);
    $form_services = get_post_meta($form_id, '_form_services', true);
    $form_fields = get_post_meta($form_id, '_form_fields', true);
    $form_styling = get_post_meta($form_id, '_form_styling', true);
    
    if (empty($form_settings) || empty($form_services) || empty($form_fields) || empty($form_styling)) {
        return '<p class="error">' . __('Form is not properly configured.', 'monalisa') . '</p>';
    }
    
    // Check if form was submitted
    $form_message = '';
    $form_status = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['soulara_form_id']) && $form_id == $_POST['soulara_form_id']) {
        list($form_status, $form_message) = soulara_process_form_submission($form_id, $form_fields);
    }
    
    // Start output buffering to capture the form HTML
    ob_start();
    
    // Include the form template
    include(get_template_directory() . '/inc/form-editor/form-template.php');
    
    // Return the buffered content
    return ob_get_clean();
}
add_shortcode('soulara_form', 'soulara_form_shortcode');

/**
 * Process form submission
 * 
 * @param int $form_id The ID of the form being processed
 * @param array $form_fields The form field configuration
 * @return array [status, message]
 */
function soulara_process_form_submission($form_id, $form_fields) {
    // Basic validation
    $errors = array();
    
    // Get form configuration
    $form_settings = get_post_meta($form_id, '_form_settings', true);
    
    // Sanitize and validate required fields
    $type = isset($_POST['client_type']) ? sanitize_text_field($_POST['client_type']) : '';
    $name = isset($_POST['fullname']) ? sanitize_text_field($_POST['fullname']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    
    // Validate core required fields
    if (empty($name)) {
        $errors[] = __('Full name is required.', 'monalisa');
    }
    
    if (empty($email) || !is_email($email)) {
        $errors[] = __('Valid email address is required.', 'monalisa');
    }
    
    if (!in_array($type, ['individual', 'business'])) {
        $errors[] = __('Invalid client type selected.', 'monalisa');
    }
    
    // Validate other required fields
    foreach ($form_fields as $field_id => $field) {
        if (!empty($field['required']) && !empty($field['enabled'])) {
            // Skip core fields already validated
            if (in_array($field_id, ['client_type', 'fullname', 'email'])) {
                continue;
            }
            
            // Skip fields that are only shown conditionally based on client type
            if (($type === 'individual' && strpos($field_id, 'company') === 0) || 
                ($type === 'business' && $field_id === 'individual_focus')) {
                continue;
            }
            
            $field_value = isset($_POST[$field_id]) ? $_POST[$field_id] : '';
            
            if (empty($field_value)) {
                $errors[] = sprintf(__('%s is required.', 'monalisa'), $field['label']);
            }
        }
    }
    
    // If there are no validation errors, process the form
    if (empty($errors)) {
        $admin_email = !empty($form_settings['admin_email']) ? $form_settings['admin_email'] : get_option('admin_email');
        $site_name = get_bloginfo('name');
        
        // Prepare lead data for database
        $lead_data = array(
            'form_id' => $form_id,
            'client_type' => $type,
            'fullname' => $name,
            'email' => $email,
            'date_submitted' => current_time('mysql'),
            'services' => isset($_POST['services']) ? array_map('sanitize_text_field', $_POST['services']) : array(),
            'contact_method' => isset($_POST['contact_method']) ? sanitize_text_field($_POST['contact_method']) : '',
            'preferred_date' => isset($_POST['preferred_date']) ? sanitize_text_field($_POST['preferred_date']) : '',
            'preferred_time' => isset($_POST['preferred_time']) ? sanitize_text_field($_POST['preferred_time']) : ''
        );
        
        // Add individual-specific fields
        if ($type === 'individual') {
            $lead_data['focus'] = isset($_POST['focus']) ? sanitize_textarea_field($_POST['focus']) : '';
        }
        
        // Add business-specific fields
        if ($type === 'business') {
            $lead_data['company'] = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
            $lead_data['goals'] = isset($_POST['goals']) ? sanitize_textarea_field($_POST['goals']) : '';
            $lead_data['team_size'] = isset($_POST['team_size']) ? intval($_POST['team_size']) : 0;
            
            // Process attendee information
            $attendees = array();
            if (!empty($_POST['attendees']) && is_array($_POST['attendees'])) {
                foreach ($_POST['attendees'] as $i => $attendee) {
                    if (is_array($attendee) && !empty($attendee['name']) && !empty($attendee['email'])) {
                        $attendees[] = array(
                            'name' => sanitize_text_field($attendee['name']),
                            'email' => sanitize_email($attendee['email'])
                        );
                    }
                }
            }
            $lead_data['attendees'] = $attendees;
        }
        
        // Store lead in database using WordPress custom table or options
        $leads = get_option('soulara_intake_leads', array());
        $leads[] = $lead_data;
        update_option('soulara_intake_leads', $leads);
        
        // Also store submission with the specific form for easy viewing in admin
        $submissions = get_post_meta($form_id, '_form_submissions', true);
        if (!is_array($submissions)) {
            $submissions = array();
        }
        $submissions[] = $lead_data;
        update_post_meta($form_id, '_form_submissions', $submissions);
        
        // Prepare email content
        $email_subject = sprintf(__('New Lead: %s - %s Client', 'monalisa'), $name, ucfirst($type));
        
        $email_body = sprintf(__("New lead submission from %s\n\n", 'monalisa'), $site_name);
        $email_body .= sprintf(__("Form: %s\n", 'monalisa'), get_the_title($form_id));
        $email_body .= sprintf(__("Client Type: %s\n", 'monalisa'), ucfirst($type));
        $email_body .= sprintf(__("Full Name: %s\n", 'monalisa'), $name);
        $email_body .= sprintf(__("Email: %s\n\n", 'monalisa'), $email);
        
        // Add services
        if (!empty($lead_data['services'])) {
            $email_body .= __("Interested Services:\n", 'monalisa');
            $services_map = array();
            
            // Create a map of service values to labels for readability
            foreach ($form_services as $service) {
                $services_map[$service['value']] = $service['label'];
            }
            
            foreach ($lead_data['services'] as $service) {
                $service_label = isset($services_map[$service]) ? $services_map[$service] : ucfirst(str_replace('-', ' ', $service));
                $email_body .= "- " . $service_label . "\n";
            }
            $email_body .= "\n";
        }
        
        // Add contact preference and availability
        if (!empty($lead_data['contact_method'])) {
            $email_body .= sprintf(__("Preferred Contact Method: %s\n", 'monalisa'), ucfirst($lead_data['contact_method']));
        }
        
        if (!empty($lead_data['preferred_date'])) {
            $email_body .= sprintf(__("Preferred Date: %s\n", 'monalisa'), $lead_data['preferred_date']);
        }
        
        if (!empty($lead_data['preferred_time'])) {
            $email_body .= sprintf(__("Preferred Time: %s\n\n", 'monalisa'), ucfirst($lead_data['preferred_time']));
        }
        
        if ($type === 'individual') {
            if (!empty($lead_data['focus'])) {
                $email_body .= sprintf(__("Focus/Concern: %s\n\n", 'monalisa'), $lead_data['focus']);
            }
        } else {
            if (!empty($lead_data['company'])) {
                $email_body .= sprintf(__("Company: %s\n", 'monalisa'), $lead_data['company']);
            }
            
            if (!empty($lead_data['goals'])) {
                $email_body .= sprintf(__("Goals: %s\n", 'monalisa'), $lead_data['goals']);
            }
            
            if (!empty($lead_data['team_size'])) {
                $email_body .= sprintf(__("Team Size: %s\n\n", 'monalisa'), $lead_data['team_size']);
            }
            
            if (!empty($attendees)) {
                $email_body .= __("Additional Attendees:\n", 'monalisa');
                foreach ($attendees as $attendee) {
                    $email_body .= sprintf("- %s (%s)\n", $attendee['name'], $attendee['email']);
                }
            }
        }
        
        // Send notification email to admin
        $headers = array('Content-Type: text/plain; charset=UTF-8');
        wp_mail($admin_email, $email_subject, $email_body, $headers);
        
        // Allow hooking into the form submission
        do_action('soulara_form_submitted', $lead_data, $form_id);
        
        // Set success message
        $success_message = !empty($form_settings['success_message']) ? 
                            $form_settings['success_message'] : 
                            __('Thank you! Your information has been received.', 'monalisa');
        
        return array('success', $success_message);
        
    } else {
        // Set error message
        $error_message = '<strong>' . __('Please correct the following errors:', 'monalisa') . '</strong><ul>';
        foreach ($errors as $error) {
            $error_message .= '<li>' . esc_html($error) . '</li>';
        }
        $error_message .= '</ul>';
        
        return array('error', $error_message);
    }
}

/**
 * Add submissions column to the forms list
 */
function soulara_add_form_submissions_column($columns) {
    $columns['submissions'] = __('Submissions', 'monalisa');
    return $columns;
}
add_filter('manage_soulara_form_posts_columns', 'soulara_add_form_submissions_column');

/**
 * Add content to the submissions column
 */
function soulara_form_submissions_column_content($column, $post_id) {
    if ('submissions' === $column) {
        $submissions = get_post_meta($post_id, '_form_submissions', true);
        $count = is_array($submissions) ? count($submissions) : 0;
        
        echo '<strong>' . $count . '</strong>';
        
        if ($count > 0) {
            echo ' <a href="' . esc_url(admin_url('post.php?post=' . $post_id . '&action=edit&tab=submissions')) . '">';
            echo __('View', 'monalisa');
            echo '</a>';
        }
    }
}
add_action('manage_soulara_form_posts_custom_column', 'soulara_form_submissions_column_content', 10, 2);

/**
 * Add submission meta box to form edit page
 */
function soulara_add_submissions_meta_box() {
    add_meta_box(
        'soulara_form_submissions',
        __('Form Submissions', 'monalisa'),
        'soulara_form_submissions_callback',
        'soulara_form',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'soulara_add_submissions_meta_box');

/**
 * Submission meta box callback
 */
function soulara_form_submissions_callback($post) {
    $submissions = get_post_meta($post->ID, '_form_submissions', true);
    
    if (!is_array($submissions) || empty($submissions)) {
        echo '<p>' . __('No submissions yet.', 'monalisa') . '</p>';
        return;
    }
    
    // Order by latest first
    $submissions = array_reverse($submissions);
    
    echo '<div class="submissions-wrapper">';
    
    // Display submissions
    foreach ($submissions as $index => $submission) {
        $submission_date = isset($submission['date_submitted']) ? date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($submission['date_submitted'])) : '';
        
        echo '<div class="submission-item">';
        echo '<h3>' . sprintf(__('Submission #%d - %s', 'monalisa'), count($submissions) - $index, $submission_date) . '</h3>';
        
        echo '<table class="widefat fixed striped submission-details">';
        
        // Basic info
        echo '<tr><td width="30%"><strong>' . __('Client Type', 'monalisa') . ':</strong></td><td>' . ucfirst($submission['client_type']) . '</td></tr>';
        echo '<tr><td><strong>' . __('Full Name', 'monalisa') . ':</strong></td><td>' . esc_html($submission['fullname']) . '</td></tr>';
        echo '<tr><td><strong>' . __('Email', 'monalisa') . ':</strong></td><td>' . esc_html($submission['email']) . '</td></tr>';
        
        // Services
        if (!empty($submission['services'])) {
            echo '<tr><td><strong>' . __('Services', 'monalisa') . ':</strong></td><td>';
            foreach ($submission['services'] as $service) {
                echo esc_html(ucfirst(str_replace('-', ' ', $service))) . '<br>';
            }
            echo '</td></tr>';
        }
        
        // Contact preferences
        if (!empty($submission['contact_method'])) {
            echo '<tr><td><strong>' . __('Contact Method', 'monalisa') . ':</strong></td><td>' . ucfirst($submission['contact_method']) . '</td></tr>';
        }
        
        if (!empty($submission['preferred_date'])) {
            echo '<tr><td><strong>' . __('Preferred Date', 'monalisa') . ':</strong></td><td>' . $submission['preferred_date'] . '</td></tr>';
        }
        
        if (!empty($submission['preferred_time'])) {
            echo '<tr><td><strong>' . __('Preferred Time', 'monalisa') . ':</strong></td><td>' . ucfirst($submission['preferred_time']) . '</td></tr>';
        }
        
        // Client type specific fields
        if ($submission['client_type'] === 'individual') {
            if (!empty($submission['focus'])) {
                echo '<tr><td><strong>' . __('Focus/Concern', 'monalisa') . ':</strong></td><td>' . nl2br(esc_html($submission['focus'])) . '</td></tr>';
            }
        } else {
            if (!empty($submission['company'])) {
                echo '<tr><td><strong>' . __('Company', 'monalisa') . ':</strong></td><td>' . esc_html($submission['company']) . '</td></tr>';
            }
            
            if (!empty($submission['goals'])) {
                echo '<tr><td><strong>' . __('Team Goals', 'monalisa') . ':</strong></td><td>' . nl2br(esc_html($submission['goals'])) . '</td></tr>';
            }
            
            if (!empty($submission['team_size'])) {
                echo '<tr><td><strong>' . __('Team Size', 'monalisa') . ':</strong></td><td>' . intval($submission['team_size']) . '</td></tr>';
            }
            
            if (!empty($submission['attendees'])) {
                echo '<tr><td><strong>' . __('Additional Attendees', 'monalisa') . ':</strong></td><td>';
                foreach ($submission['attendees'] as $attendee) {
                    echo esc_html($attendee['name']) . ' (' . esc_html($attendee['email']) . ')<br>';
                }
                echo '</td></tr>';
            }
        }
        
        echo '</table>';
        echo '</div>';
    }
    
    echo '</div>';
    
    // Add some basic styling
    ?>
    <style>
    .submission-item {
        margin-bottom: 25px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 20px;
    }
    .submission-details {
        border-collapse: collapse;
    }
    .submission-details td {
        padding: 8px;
        vertical-align: top;
    }
    </style>
    <?php
}
