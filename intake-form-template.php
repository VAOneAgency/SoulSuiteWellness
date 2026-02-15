<?php
/**
 * Template Name: Intake Form
 * 
 * Custom intake form template for Soul Suite Wellness
 * 
 * @package SoulSuite
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Initialize variables
$form_message = '';
$form_success = false;
$errors = array();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['intake_form_submit'])) {
    // Verify nonce
    if (!isset($_POST['intake_form_nonce']) || !wp_verify_nonce($_POST['intake_form_nonce'], 'soul_suite_intake_form')) {
        $errors[] = 'Security check failed. Please try again.';
    } else {
        // Sanitize and validate form data
        $form_data = array();
        
        // Required fields
        $required_fields = array(
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email Address',
            'phone' => 'Phone Number',
        );
        
        foreach ($required_fields as $field => $label) {
            if (empty($_POST[$field])) {
                $errors[] = $label . ' is required.';
            } else {
                if ($field === 'email') {
                    $form_data[$field] = sanitize_email($_POST[$field]);
                    if (!is_email($form_data[$field])) {
                        $errors[] = 'Please enter a valid email address.';
                    }
                } else {
                    $form_data[$field] = sanitize_text_field($_POST[$field]);
                }
            }
        }
        
        // Optional fields
        $optional_fields = array(
            'company',
            'title',
            'service_interest',
            'message',
        );
        
        foreach ($optional_fields as $field) {
            if (isset($_POST[$field]) && !empty($_POST[$field])) {
                if ($field === 'message') {
                    $form_data[$field] = sanitize_textarea_field($_POST[$field]);
                } else {
                    $form_data[$field] = sanitize_text_field($_POST[$field]);
                }
            }
        }
        
        // If no errors, process the form
        if (empty($errors)) {
            // Save to database
            global $wpdb;
            $table_name = $wpdb->prefix . 'soul_suite_form_submissions';
            
            $result = $wpdb->insert(
                $table_name,
                array(
                    'form_id' => 0, // Intake form ID
                    'submission_data' => wp_json_encode($form_data),
                    'submitted_at' => current_time('mysql'),
                    'ip_address' => $_SERVER['REMOTE_ADDR'],
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                ),
                array('%d', '%s', '%s', '%s', '%s')
            );
            
            if ($result) {
                // Send email notification
                $to = get_option('soul_suite_contact_email', 'bewell@soulsuitewellness.com');
                $subject = 'New Intake Form Submission - ' . $form_data['first_name'] . ' ' . $form_data['last_name'];
                $message = "New intake form submission received:\n\n";
                
                foreach ($form_data as $key => $value) {
                    $label = ucwords(str_replace('_', ' ', $key));
                    $message .= $label . ": " . $value . "\n";
                }
                
                $message .= "\nSubmitted: " . current_time('mysql');
                
                wp_mail($to, $subject, $message);
                
                $form_success = true;
                $form_message = '<div class="alert alert-success"><strong>Thank you!</strong> Your intake form has been submitted successfully. We\'ll be in touch soon.</div>';
            } else {
                $errors[] = 'There was an error submitting your form. Please try again.';
            }
        }
    }
    
    // Build error message
    if (!empty($errors)) {
        $form_message = '<div class="alert alert-danger">';
        $form_message .= '<strong>Please correct the following errors:</strong><ul>';
        foreach ($errors as $error) {
            $form_message .= '<li>' . esc_html($error) . '</li>';
        }
        $form_message .= '</ul></div>';
    }
}

get_header();

// Page Header (replaces soul_suite_single_banner())
$header_bg_color = get_option('soul_suite_hero_bg_color', '#40e0d0');
?>

<div class="page-header intake-form-header" style="background: linear-gradient(135deg, <?php echo esc_attr($header_bg_color); ?>, #ff5b0c); padding: 80px 0; text-align: center; margin-bottom: 60px;">
    <div class="container">
        <h1 style="color: white; font-size: 2.5rem; margin: 0 0 15px 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
            <?php the_title(); ?>
        </h1>
        <?php if (has_excerpt()): ?>
            <p style="color: rgba(255,255,255,0.95); font-size: 1.2rem; margin: 0; max-width: 800px; margin: 0 auto;">
                <?php the_excerpt(); ?>
            </p>
        <?php endif; ?>
    </div>
</div>

<div id="primary" class="content-area">
    <div id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    while (have_posts()) : the_post();
                        // Display the page content before the form (if any)
                        if (get_the_content()) {
                            ?>
                            <div class="page-content">
                                <?php the_content(); ?>
                            </div>
                            <?php
                        }
                    endwhile;
                    ?>
                    
                    <?php if ($form_success): ?>
                        <?php echo $form_message; ?>
                        <div class="text-center" style="margin-top: 40px;">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Return to Home</a>
                        </div>
                    <?php else: ?>
                        <?php if (!empty($form_message)): ?>
                            <?php echo $form_message; ?>
                        <?php endif; ?>
                        
                        <div class="intake-form-container" style="max-width: 800px; margin: 40px auto; padding: 40px; background: #f9f9f9; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                            <form method="post" action="" class="soul-suite-intake-form">
                                <?php wp_nonce_field('soul_suite_intake_form', 'intake_form_nonce'); ?>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($_POST['first_name']) ? esc_attr($_POST['first_name']) : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name <span class="required">*</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($_POST['last_name']) ? esc_attr($_POST['last_name']) : ''; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email Address <span class="required">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone Number <span class="required">*</span></label>
                                            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? esc_attr($_POST['phone']) : ''; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company">Company/Organization</label>
                                            <input type="text" class="form-control" id="company" name="company" value="<?php echo isset($_POST['company']) ? esc_attr($_POST['company']) : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title/Position</label>
                                            <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($_POST['title']) ? esc_attr($_POST['title']) : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="service_interest">Service Interest</label>
                                    <select class="form-control" id="service_interest" name="service_interest">
                                        <option value="">-- Select a Service --</option>
                                        <option value="individual" <?php selected(isset($_POST['service_interest']) && $_POST['service_interest'] === 'individual'); ?>>Individual Strategy Call</option>
                                        <option value="business" <?php selected(isset($_POST['service_interest']) && $_POST['service_interest'] === 'business'); ?>>Business Strategy Call</option>
                                        <option value="virtual-reiki" <?php selected(isset($_POST['service_interest']) && $_POST['service_interest'] === 'virtual-reiki'); ?>>Virtual Reiki Session</option>
                                        <option value="mobile-reiki" <?php selected(isset($_POST['service_interest']) && $_POST['service_interest'] === 'mobile-reiki'); ?>>Mobile Reiki Service</option>
                                        <option value="other" <?php selected(isset($_POST['service_interest']) && $_POST['service_interest'] === 'other'); ?>>Other/Not Sure</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="message">How can we support you?</label>
                                    <textarea class="form-control" id="message" name="message" rows="5"><?php echo isset($_POST['message']) ? esc_textarea($_POST['message']) : ''; ?></textarea>
                                </div>
                                
                                <div class="form-group text-center" style="margin-top: 30px;">
                                    <button type="submit" name="intake_form_submit" class="btn btn-primary btn-lg" style="padding: 15px 60px; font-size: 1.1rem;">
                                        Submit Intake Form
                                    </button>
                                </div>
                                
                                <p class="text-center" style="margin-top: 20px; color: #777; font-size: 0.9rem;">
                                    <span class="required">*</span> Required fields
                                </p>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.intake-form-container .form-control {
    border: 1px solid #ddd;
    padding: 12px 15px;
    font-size: 1rem;
    border-radius: 8px;
    transition: border-color 0.3s ease;
}

.intake-form-container .form-control:focus {
    border-color: #40e0d0;
    box-shadow: 0 0 0 3px rgba(64, 224, 208, 0.1);
    outline: none;
}

.intake-form-container .form-group {
    margin-bottom: 25px;
}

.intake-form-container label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    display: block;
}

.intake-form-container .required {
    color: #ff5b0c;
}

.intake-form-container .btn-primary {
    background: linear-gradient(135deg, #40e0d0, #ff5b0c);
    border: none;
    border-radius: 50px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.intake-form-container .btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(64, 224, 208, 0.3);
}

.alert {
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 30px;
}

.alert-success {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.alert-danger {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.alert ul {
    margin: 10px 0 0 20px;
}
</style>

<?php get_footer(); ?>