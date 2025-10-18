<?php
/**
 * Soulara Form Builder - Custom Post Type
 * 
 * Registers a custom post type for managing intake forms
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register the Form custom post type
 */
function soulara_register_form_post_type() {
    $labels = array(
        'name'                  => _x('Intake Forms', 'Post type general name', 'monalisa'),
        'singular_name'         => _x('Intake Form', 'Post type singular name', 'monalisa'),
        'menu_name'             => _x('Intake Forms', 'Admin Menu text', 'monalisa'),
        'name_admin_bar'        => _x('Intake Form', 'Add New on Toolbar', 'monalisa'),
        'add_new'               => __('Add New', 'monalisa'),
        'add_new_item'          => __('Add New Form', 'monalisa'),
        'new_item'              => __('New Form', 'monalisa'),
        'edit_item'             => __('Edit Form', 'monalisa'),
        'view_item'             => __('View Form', 'monalisa'),
        'all_items'             => __('All Forms', 'monalisa'),
        'search_items'          => __('Search Forms', 'monalisa'),
        'not_found'             => __('No forms found.', 'monalisa'),
        'not_found_in_trash'    => __('No forms found in Trash.', 'monalisa'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 30,
        'menu_icon'          => 'dashicons-feedback',
        'supports'           => array('title'),
    );

    register_post_type('soulara_form', $args);
}
add_action('init', 'soulara_register_form_post_type');

/**
 * Register custom meta box for form configuration
 */
function soulara_form_meta_boxes() {
    add_meta_box(
        'soulara_form_settings',
        __('Form Settings', 'monalisa'),
        'soulara_form_settings_callback',
        'soulara_form',
        'normal',
        'high'
    );
    
    add_meta_box(
        'soulara_form_services',
        __('Service Options', 'monalisa'),
        'soulara_form_services_callback',
        'soulara_form',
        'normal',
        'high'
    );
    
    add_meta_box(
        'soulara_form_fields',
        __('Form Fields', 'monalisa'),
        'soulara_form_fields_callback',
        'soulara_form',
        'normal',
        'high'
    );
    
    add_meta_box(
        'soulara_form_styling',
        __('Form Styling', 'monalisa'),
        'soulara_form_styling_callback',
        'soulara_form',
        'normal',
        'default'
    );
    
    add_meta_box(
        'soulara_form_shortcode',
        __('Form Shortcode', 'monalisa'),
        'soulara_form_shortcode_callback',
        'soulara_form',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'soulara_form_meta_boxes');

/**
 * Form Settings meta box callback
 */
function soulara_form_settings_callback($post) {
    wp_nonce_field('soulara_form_settings_nonce', 'soulara_form_settings_nonce');
    $form_settings = get_post_meta($post->ID, '_form_settings', true);
    
    if (empty($form_settings)) {
        $form_settings = array(
            'admin_email' => get_option('admin_email'),
            'success_message' => 'Thank you! Your information has been received. Please wait while we redirect you to our booking calendar...',
            'redirect_url' => '',
            'redirect_delay' => 3000,
        );
    }
    ?>
    <table class="form-table">
        <tr>
            <th><label for="admin_email"><?php _e('Notification Email', 'monalisa'); ?></label></th>
            <td>
                <input type="email" id="admin_email" name="form_settings[admin_email]" 
                       value="<?php echo esc_attr($form_settings['admin_email']); ?>" class="regular-text">
                <p class="description"><?php _e('Email address to receive form submissions', 'monalisa'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="success_message"><?php _e('Success Message', 'monalisa'); ?></label></th>
            <td>
                <textarea id="success_message" name="form_settings[success_message]" rows="3" 
                          class="large-text"><?php echo esc_textarea($form_settings['success_message']); ?></textarea>
                <p class="description"><?php _e('Message displayed after successful form submission', 'monalisa'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="redirect_url"><?php _e('Redirect URL', 'monalisa'); ?></label></th>
            <td>
                <input type="text" id="redirect_url" name="form_settings[redirect_url]" 
                       value="<?php echo esc_url($form_settings['redirect_url']); ?>" class="regular-text">
                <p class="description"><?php _e('Optional. URL to redirect after form submission (e.g., booking page)', 'monalisa'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="redirect_delay"><?php _e('Redirect Delay (ms)', 'monalisa'); ?></label></th>
            <td>
                <input type="number" id="redirect_delay" name="form_settings[redirect_delay]" 
                       value="<?php echo esc_attr($form_settings['redirect_delay']); ?>" class="small-text" min="0" step="500">
                <p class="description"><?php _e('Delay before redirect in milliseconds (3000 = 3 seconds)', 'monalisa'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Form Services meta box callback
 */
function soulara_form_services_callback($post) {
    wp_nonce_field('soulara_form_services_nonce', 'soulara_form_services_nonce');
    $services = get_post_meta($post->ID, '_form_services', true);
    
    if (empty($services) || !is_array($services)) {
        $services = array(
            array('value' => 'wellness-coaching', 'label' => 'Wellness Coaching', 'default' => false),
            array('value' => 'meditation', 'label' => 'Meditation Sessions', 'default' => false),
            array('value' => 'corporate-wellness', 'label' => 'Corporate Wellness Programs', 'default' => false),
            array('value' => 'stress-management', 'label' => 'Stress Management', 'default' => false),
            array('value' => 'mindfulness', 'label' => 'Mindfulness Training', 'default' => false),
            array('value' => 'other', 'label' => 'Other', 'default' => false),
        );
    }
    ?>
    <p><?php _e('Define the services that clients can select in the form.', 'monalisa'); ?></p>
    
    <div id="service-options-container">
        <table class="widefat striped">
            <thead>
                <tr>
                    <th width="35%"><?php _e('Service Name', 'monalisa'); ?></th>
                    <th width="35%"><?php _e('Value', 'monalisa'); ?> <span class="description">(internal use)</span></th>
                    <th width="20%"><?php _e('Default Selected', 'monalisa'); ?></th>
                    <th width="10%"><?php _e('Actions', 'monalisa'); ?></th>
                </tr>
            </thead>
            <tbody id="service-options">
                <?php foreach($services as $index => $service) : ?>
                <tr class="service-row">
                    <td>
                        <input type="text" name="form_services[<?php echo $index; ?>][label]" 
                               value="<?php echo esc_attr($service['label']); ?>" class="regular-text">
                    </td>
                    <td>
                        <input type="text" name="form_services[<?php echo $index; ?>][value]" 
                               value="<?php echo esc_attr($service['value']); ?>" class="regular-text">
                    </td>
                    <td>
                        <input type="checkbox" name="form_services[<?php echo $index; ?>][default]" 
                               value="1" <?php checked(!empty($service['default'])); ?>>
                    </td>
                    <td>
                        <button type="button" class="button remove-service"><?php _e('Remove', 'monalisa'); ?></button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>
            <button type="button" id="add-service" class="button button-secondary">
                <?php _e('Add Service', 'monalisa'); ?>
            </button>
        </p>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        var serviceIndex = <?php echo count($services); ?>;
        
        // Add new service option
        $('#add-service').on('click', function() {
            var newRow = $('<tr class="service-row"></tr>');
            
            newRow.append('<td><input type="text" name="form_services[' + serviceIndex + '][label]" value="" class="regular-text"></td>');
            newRow.append('<td><input type="text" name="form_services[' + serviceIndex + '][value]" value="" class="regular-text"></td>');
            newRow.append('<td><input type="checkbox" name="form_services[' + serviceIndex + '][default]" value="1"></td>');
            newRow.append('<td><button type="button" class="button remove-service">' + '<?php _e('Remove', 'monalisa'); ?>' + '</button></td>');
            
            $('#service-options').append(newRow);
            serviceIndex++;
        });
        
        // Remove service option
        $('#service-options-container').on('click', '.remove-service', function() {
            $(this).closest('tr').remove();
        });
    });
    </script>
    <?php
}

/**
 * Form Fields meta box callback
 */
function soulara_form_fields_callback($post) {
    wp_nonce_field('soulara_form_fields_nonce', 'soulara_form_fields_nonce');
    $fields = get_post_meta($post->ID, '_form_fields', true);
    
    if (empty($fields) || !is_array($fields)) {
        $fields = array(
            'client_type' => array('enabled' => true, 'required' => true, 'label' => 'Are you booking as a...'),
            'fullname' => array('enabled' => true, 'required' => true, 'label' => 'Full Name'),
            'email' => array('enabled' => true, 'required' => true, 'label' => 'Email Address'),
            'services' => array('enabled' => true, 'required' => false, 'label' => 'What services are you interested in?'),
            'contact_method' => array('enabled' => true, 'required' => true, 'label' => 'Preferred Contact Method'),
            'preferred_date' => array('enabled' => true, 'required' => true, 'label' => 'Preferred Date'),
            'preferred_time' => array('enabled' => true, 'required' => true, 'label' => 'Preferred Time'),
            'individual_focus' => array('enabled' => true, 'required' => false, 'label' => 'What\'s your primary area of concern or intention?'),
            'company' => array('enabled' => true, 'required' => false, 'label' => 'Business/Organization Name'),
            'goals' => array('enabled' => true, 'required' => false, 'label' => 'What are your team or wellness goals?'),
            'team_size' => array('enabled' => true, 'required' => false, 'label' => 'How many team members need support?'),
            'attendees' => array('enabled' => true, 'required' => false, 'label' => 'Additional Attendees'),
        );
    }
    ?>
    <p><?php _e('Configure which fields appear in your form and their settings.', 'monalisa'); ?></p>
    
    <table class="widefat striped">
        <thead>
            <tr>
                <th width="40%"><?php _e('Field', 'monalisa'); ?></th>
                <th width="30%"><?php _e('Label', 'monalisa'); ?></th>
                <th width="15%"><?php _e('Required', 'monalisa'); ?></th>
                <th width="15%"><?php _e('Enabled', 'monalisa'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $field_labels = array(
                'client_type' => __('Client Type (Individual/Business)', 'monalisa'),
                'fullname' => __('Full Name', 'monalisa'),
                'email' => __('Email Address', 'monalisa'),
                'services' => __('Services Selection', 'monalisa'),
                'contact_method' => __('Contact Method', 'monalisa'),
                'preferred_date' => __('Preferred Date', 'monalisa'),
                'preferred_time' => __('Preferred Time', 'monalisa'),
                'individual_focus' => __('Individual - Focus/Concern', 'monalisa'),
                'company' => __('Business - Company Name', 'monalisa'),
                'goals' => __('Business - Team Goals', 'monalisa'),
                'team_size' => __('Business - Team Size', 'monalisa'),
                'attendees' => __('Business - Additional Attendees', 'monalisa'),
            );
            
            foreach ($field_labels as $field_id => $label) :
                $field = isset($fields[$field_id]) ? $fields[$field_id] : array(
                    'enabled' => true,
                    'required' => false,
                    'label' => $label
                );
                
                // Core fields that cannot be disabled
                $core_fields = array('client_type', 'fullname', 'email');
                $is_core = in_array($field_id, $core_fields);
            ?>
            <tr>
                <td>
                    <strong><?php echo esc_html($label); ?></strong>
                    <?php if ($is_core): ?>
                        <span class="description">(<?php _e('Core field - cannot be disabled', 'monalisa'); ?>)</span>
                    <?php endif; ?>
                </td>
                <td>
                    <input type="text" name="form_fields[<?php echo $field_id; ?>][label]" 
                           value="<?php echo esc_attr($field['label']); ?>" class="regular-text">
                </td>
                <td>
                    <input type="checkbox" name="form_fields[<?php echo $field_id; ?>][required]" value="1"
                           <?php checked(!empty($field['required'])); ?>
                           <?php if ($is_core) echo 'disabled'; ?>>
                    <?php if ($is_core): ?>
                        <input type="hidden" name="form_fields[<?php echo $field_id; ?>][required]" value="1">
                    <?php endif; ?>
                </td>
                <td>
                    <input type="checkbox" name="form_fields[<?php echo $field_id; ?>][enabled]" value="1"
                           <?php checked(!empty($field['enabled'])); ?>
                           <?php if ($is_core) echo 'disabled'; ?>>
                    <?php if ($is_core): ?>
                        <input type="hidden" name="form_fields[<?php echo $field_id; ?>][enabled]" value="1">
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
}

/**
 * Form Styling meta box callback
 */
function soulara_form_styling_callback($post) {
    wp_nonce_field('soulara_form_styling_nonce', 'soulara_form_styling_nonce');
    $styling = get_post_meta($post->ID, '_form_styling', true);
    
    if (empty($styling)) {
        $styling = array(
            'background_color' => '#F3EEE9',
            'border_color' => '#D17953',
            'button_color' => '#D26138',
            'button_hover_color' => '#BA5C38',
            'label_color' => '#17786E',
            'font_family' => 'Lato, sans-serif',
        );
    }
    ?>
    <p><?php _e('Customize the appearance of your form.', 'monalisa'); ?></p>
    
    <table class="form-table">
        <tr>
            <th><label for="background_color"><?php _e('Form Background', 'monalisa'); ?></label></th>
            <td>
                <input type="text" id="background_color" name="form_styling[background_color]" 
                       value="<?php echo esc_attr($styling['background_color']); ?>" class="color-picker">
            </td>
        </tr>
        <tr>
            <th><label for="border_color"><?php _e('Border Color', 'monalisa'); ?></label></th>
            <td>
                <input type="text" id="border_color" name="form_styling[border_color]" 
                       value="<?php echo esc_attr($styling['border_color']); ?>" class="color-picker">
            </td>
        </tr>
        <tr>
            <th><label for="button_color"><?php _e('Button Color', 'monalisa'); ?></label></th>
            <td>
                <input type="text" id="button_color" name="form_styling[button_color]" 
                       value="<?php echo esc_attr($styling['button_color']); ?>" class="color-picker">
            </td>
        </tr>
        <tr>
            <th><label for="button_hover_color"><?php _e('Button Hover Color', 'monalisa'); ?></label></th>
            <td>
                <input type="text" id="button_hover_color" name="form_styling[button_hover_color]" 
                       value="<?php echo esc_attr($styling['button_hover_color']); ?>" class="color-picker">
            </td>
        </tr>
        <tr>
            <th><label for="label_color"><?php _e('Label Color', 'monalisa'); ?></label></th>
            <td>
                <input type="text" id="label_color" name="form_styling[label_color]" 
                       value="<?php echo esc_attr($styling['label_color']); ?>" class="color-picker">
            </td>
        </tr>
        <tr>
            <th><label for="font_family"><?php _e('Font Family', 'monalisa'); ?></label></th>
            <td>
                <select id="font_family" name="form_styling[font_family]" class="regular-text">
                    <option value="Lato, sans-serif" <?php selected($styling['font_family'], 'Lato, sans-serif'); ?>>Lato</option>
                    <option value="Montserrat, sans-serif" <?php selected($styling['font_family'], 'Montserrat, sans-serif'); ?>>Montserrat</option>
                    <option value="'Open Sans', sans-serif" <?php selected($styling['font_family'], "'Open Sans', sans-serif"); ?>>Open Sans</option>
                    <option value="Roboto, sans-serif" <?php selected($styling['font_family'], 'Roboto, sans-serif'); ?>>Roboto</option>
                    <option value="Arial, sans-serif" <?php selected($styling['font_family'], 'Arial, sans-serif'); ?>>Arial</option>
                </select>
            </td>
        </tr>
    </table>
    
    <script>
    jQuery(document).ready(function($) {
        $('.color-picker').wpColorPicker();
    });
    </script>
    <?php
}

/**
 * Form Shortcode meta box callback
 */
function soulara_form_shortcode_callback($post) {
    $shortcode = '[soulara_form id="' . $post->ID . '"]';
    ?>
    <p><?php _e('Use this shortcode to display your form on any page or post:', 'monalisa'); ?></p>
    <input type="text" class="widefat" value="<?php echo esc_attr($shortcode); ?>" readonly onclick="this.select();">
    <?php
}

/**
 * Save form meta data
 */
function soulara_save_form_meta($post_id) {
    // Check if our nonces are set and verify them
    if (!isset($_POST['soulara_form_settings_nonce']) || 
        !wp_verify_nonce($_POST['soulara_form_settings_nonce'], 'soulara_form_settings_nonce')) {
        return;
    }

    if (!isset($_POST['soulara_form_services_nonce']) || 
        !wp_verify_nonce($_POST['soulara_form_services_nonce'], 'soulara_form_services_nonce')) {
        return;
    }

    if (!isset($_POST['soulara_form_fields_nonce']) || 
        !wp_verify_nonce($_POST['soulara_form_fields_nonce'], 'soulara_form_fields_nonce')) {
        return;
    }

    if (!isset($_POST['soulara_form_styling_nonce']) || 
        !wp_verify_nonce($_POST['soulara_form_styling_nonce'], 'soulara_form_styling_nonce')) {
        return;
    }

    // Check if this is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions
    if (isset($_POST['post_type']) && 'soulara_form' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    // Save form settings
    if (isset($_POST['form_settings'])) {
        $form_settings = array();
        $form_settings['admin_email'] = sanitize_email($_POST['form_settings']['admin_email']);
        $form_settings['success_message'] = wp_kses_post($_POST['form_settings']['success_message']);
        $form_settings['redirect_url'] = esc_url_raw($_POST['form_settings']['redirect_url']);
        $form_settings['redirect_delay'] = absint($_POST['form_settings']['redirect_delay']);
        
        update_post_meta($post_id, '_form_settings', $form_settings);
    }

    // Save form services
    if (isset($_POST['form_services']) && is_array($_POST['form_services'])) {
        $services = array();
        foreach ($_POST['form_services'] as $service) {
            if (!empty($service['label']) && !empty($service['value'])) {
                $services[] = array(
                    'label' => sanitize_text_field($service['label']),
                    'value' => sanitize_key($service['value']),
                    'default' => isset($service['default']) ? true : false,
                );
            }
        }
        update_post_meta($post_id, '_form_services', $services);
    }

    // Save form fields
    if (isset($_POST['form_fields']) && is_array($_POST['form_fields'])) {
        $fields = array();
        foreach ($_POST['form_fields'] as $field_id => $field) {
            $fields[$field_id] = array(
                'label' => sanitize_text_field($field['label']),
                'required' => isset($field['required']) ? true : false,
                'enabled' => isset($field['enabled']) ? true : false,
            );
        }
        
        // Ensure core fields are always enabled
        foreach (array('client_type', 'fullname', 'email') as $core_field) {
            $fields[$core_field]['enabled'] = true;
            $fields[$core_field]['required'] = true;
        }
        
        update_post_meta($post_id, '_form_fields', $fields);
    }

    // Save form styling
    if (isset($_POST['form_styling'])) {
        $styling = array();
        $styling['background_color'] = sanitize_hex_color($_POST['form_styling']['background_color']);
        $styling['border_color'] = sanitize_hex_color($_POST['form_styling']['border_color']);
        $styling['button_color'] = sanitize_hex_color($_POST['form_styling']['button_color']);
        $styling['button_hover_color'] = sanitize_hex_color($_POST['form_styling']['button_hover_color']);
        $styling['label_color'] = sanitize_hex_color($_POST['form_styling']['label_color']);
        $styling['font_family'] = sanitize_text_field($_POST['form_styling']['font_family']);
        
        update_post_meta($post_id, '_form_styling', $styling);
    }
}
add_action('save_post_soulara_form', 'soulara_save_form_meta');

// Helper function to sanitize hex colors
if (!function_exists('sanitize_hex_color')) {
    function sanitize_hex_color($color) {
        if ('' === $color) {
            return '';
        }
        
        // 3 or 6 hex digits, or the empty string.
        if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color)) {
            return $color;
        }
        
        return '';
    }
}
