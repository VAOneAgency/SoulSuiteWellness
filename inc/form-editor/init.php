<?php
/**
 * Soulara Form Builder - Init
 * 
 * Initializes the form builder system and loads required components
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Load the form post type
require_once get_template_directory() . '/inc/form-editor/form-post-type.php';

// Load the form shortcode
require_once get_template_directory() . '/inc/form-editor/form-shortcode.php';

/**
 * Enqueue form scripts and styles
 */
function soulara_form_enqueue_scripts() {
    // Only enqueue scripts when a form is on the page
    global $post;
    
    if (is_a($post, 'WP_Post') && (
        has_shortcode($post->post_content, 'soulara_form') || 
        is_page_template('intake-form-template.php')
    )) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_style('jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
        
        // Enqueue custom form scripts if needed
        // wp_enqueue_script('soulara-forms', get_template_directory_uri() . '/js/soulara-forms.js', array('jquery'), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'soulara_form_enqueue_scripts');

/**
 * Admin scripts for form editor
 */
function soulara_form_admin_scripts($hook) {
    global $post_type;
    
    if ('soulara_form' === $post_type && ('post.php' === $hook || 'post-new.php' === $hook)) {
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_style('wp-color-picker');
    }
}
add_action('admin_enqueue_scripts', 'soulara_form_admin_scripts');

/**
 * Update the intake form template to use the form shortcode
 */
function soulara_update_intake_form_template($template) {
    if (is_page_template('intake-form-template.php')) {
        // Get the default form ID (first form created)
        $forms = get_posts(array(
            'post_type' => 'soulara_form',
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'ASC'
        ));
        
        if (!empty($forms)) {
            $default_form_id = $forms[0]->ID;
            // This will be accessible in the template file
            set_query_var('soulara_default_form_id', $default_form_id);
        }
    }
    
    return $template;
}
add_filter('template_include', 'soulara_update_intake_form_template');

/**
 * Add settings link on plugin page
 */
function soulara_form_settings_link($links) {
    $settings_link = '<a href="' . admin_url('edit.php?post_type=soulara_form') . '">' . __('Manage Forms', 'monalisa') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}

/**
 * Add admin menu for Form Builder
 */
function soulara_form_admin_menu() {
    add_submenu_page(
        'edit.php?post_type=soulara_form',
        __('Form Settings', 'monalisa'),
        __('Settings', 'monalisa'),
        'manage_options',
        'soulara-form-settings',
        'soulara_form_settings_page'
    );
}
add_action('admin_menu', 'soulara_form_admin_menu');

/**
 * Form settings page
 */
function soulara_form_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Form Builder Settings', 'monalisa'); ?></h1>
        <div class="card">
            <h2><?php _e('Usage Instructions', 'monalisa'); ?></h2>
            <p><?php _e('To add a form to a page or post, use the following shortcode:', 'monalisa'); ?></p>
            <code>[soulara_form id="FORM_ID"]</code>
            <p><?php _e('Replace FORM_ID with the ID of the form you want to display.', 'monalisa'); ?></p>
            
            <h3><?php _e('Available Forms', 'monalisa'); ?></h3>
            <?php
            $forms = get_posts(array(
                'post_type' => 'soulara_form',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC'
            ));
            
            if (!empty($forms)) {
                echo '<table class="widefat fixed striped">';
                echo '<thead><tr>';
                echo '<th>' . __('Form Name', 'monalisa') . '</th>';
                echo '<th>' . __('Form ID', 'monalisa') . '</th>';
                echo '<th>' . __('Shortcode', 'monalisa') . '</th>';
                echo '<th>' . __('Submissions', 'monalisa') . '</th>';
                echo '</tr></thead>';
                echo '<tbody>';
                
                foreach ($forms as $form) {
                    $submissions = get_post_meta($form->ID, '_form_submissions', true);
                    $count = is_array($submissions) ? count($submissions) : 0;
                    
                    echo '<tr>';
                    echo '<td><a href="' . esc_url(admin_url('post.php?post=' . $form->ID . '&action=edit')) . '">' . esc_html($form->post_title) . '</a></td>';
                    echo '<td>' . esc_html($form->ID) . '</td>';
                    echo '<td><code>[soulara_form id="' . esc_html($form->ID) . '"]</code></td>';
                    echo '<td>' . $count . '</td>';
                    echo '</tr>';
                }
                
                echo '</tbody></table>';
            } else {
                echo '<p>' . __('No forms created yet.', 'monalisa') . '</p>';
                echo '<p><a href="' . admin_url('post-new.php?post_type=soulara_form') . '" class="button button-primary">' . __('Create Your First Form', 'monalisa') . '</a></p>';
            }
            ?>
        </div>
    </div>
    <?php
}
