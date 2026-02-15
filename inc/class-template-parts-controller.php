<?php
/**
 * Template Parts Controller
 * 
 * Manages editable template sections
 * 
 * @package SoulSuite
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Soul_Suite_Template_Parts {
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            __('Section Editor', 'soul-suite'),
            __('Sections', 'soul-suite'),
            'manage_options',
            'soul-suite-sections',
            array($this, 'render_sections_page'),
            'dashicons-layout',
            25
        );
    }
    
    /**
     * Register settings
     */
    public function register_settings() {
        // Hero Section
        register_setting('soul_suite_sections', 'soul_suite_hero_title');
        register_setting('soul_suite_sections', 'soul_suite_hero_subtitle');
        register_setting('soul_suite_sections', 'soul_suite_hero_content');
        register_setting('soul_suite_sections', 'soul_suite_hero_bg_image');
        register_setting('soul_suite_sections', 'soul_suite_hero_btn_text');
        register_setting('soul_suite_sections', 'soul_suite_hero_btn_url');
        
        // About Section
        register_setting('soul_suite_sections', 'soul_suite_about_title');
        register_setting('soul_suite_sections', 'soul_suite_about_content');
        register_setting('soul_suite_sections', 'soul_suite_about_image');
        register_setting('soul_suite_sections', 'soul_suite_owner_name');
        register_setting('soul_suite_sections', 'soul_suite_owner_title');
        register_setting('soul_suite_sections', 'soul_suite_owner_bio');
        register_setting('soul_suite_sections', 'soul_suite_owner_image');
        
        // Services Section
        register_setting('soul_suite_sections', 'soul_suite_services_title');
        register_setting('soul_suite_sections', 'soul_suite_services_subtitle');
        register_setting('soul_suite_sections', 'soul_suite_services');
        
        // Matrix/System Reset Section
        register_setting('soul_suite_sections', 'soul_suite_matrix_title');
        register_setting('soul_suite_sections', 'soul_suite_matrix_subtitle');
        register_setting('soul_suite_sections', 'soul_suite_matrix_content');
        register_setting('soul_suite_sections', 'soul_suite_matrix_points');
        
        // Contact Section
        register_setting('soul_suite_sections', 'soul_suite_contact_title');
        register_setting('soul_suite_sections', 'soul_suite_contact_subtitle');
        register_setting('soul_suite_sections', 'soul_suite_contact_form_shortcode');
        
        // Global Button Settings
        register_setting('soul_suite_sections', 'soul_suite_btn_primary_text');
        register_setting('soul_suite_sections', 'soul_suite_btn_primary_url');
        register_setting('soul_suite_sections', 'soul_suite_btn_primary_style');
    }
    
    /**
     * Render sections page
     */
    public function render_sections_page() {
        ?>
        <div class="wrap soul-suite-admin">
            <h1><?php _e('Section Editor', 'soul-suite'); ?></h1>
            <p class="description"><?php _e('Edit the content for each section of your website.', 'soul-suite'); ?></p>
            
            <form method="post" action="options.php">
                <?php settings_fields('soul_suite_sections'); ?>
                
                <div class="soul-suite-tabs">
                    <nav class="nav-tab-wrapper">
                        <a href="#hero" class="nav-tab nav-tab-active"><?php _e('Hero', 'soul-suite'); ?></a>
                        <a href="#about" class="nav-tab"><?php _e('About', 'soul-suite'); ?></a>
                        <a href="#services" class="nav-tab"><?php _e('Services', 'soul-suite'); ?></a>
                        <a href="#matrix" class="nav-tab"><?php _e('Matrix', 'soul-suite'); ?></a>
                        <a href="#contact" class="nav-tab"><?php _e('Contact', 'soul-suite'); ?></a>
                        <a href="#buttons" class="nav-tab"><?php _e('Buttons', 'soul-suite'); ?></a>
                    </nav>
                    
                    <!-- Hero Section -->
                    <div id="hero" class="tab-content active">
                        <h2><?php _e('Hero Section', 'soul-suite'); ?></h2>
                        <table class="form-table">
                            <tr>
                                <th><label for="hero_title"><?php _e('Title', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="hero_title" name="soul_suite_hero_title" 
                                           value="<?php echo esc_attr(get_option('soul_suite_hero_title')); ?>" 
                                           class="large-text">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="hero_subtitle"><?php _e('Subtitle', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="hero_subtitle" name="soul_suite_hero_subtitle" 
                                           value="<?php echo esc_attr(get_option('soul_suite_hero_subtitle')); ?>" 
                                           class="large-text">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="hero_content"><?php _e('Content', 'soul-suite'); ?></label></th>
                                <td>
                                    <?php 
                                    wp_editor(
                                        get_option('soul_suite_hero_content'), 
                                        'hero_content',
                                        array('textarea_name' => 'soul_suite_hero_content')
                                    ); 
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="hero_bg_image"><?php _e('Background Image', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="hero_bg_image" name="soul_suite_hero_bg_image" 
                                           value="<?php echo esc_url(get_option('soul_suite_hero_bg_image')); ?>" 
                                           class="large-text">
                                    <button type="button" class="button upload-image-btn" data-target="hero_bg_image">
                                        <?php _e('Select Image', 'soul-suite'); ?>
                                    </button>
                                    <div class="image-preview">
                                        <?php if ($img = get_option('soul_suite_hero_bg_image')): ?>
                                            <img src="<?php echo esc_url($img); ?>" style="max-width: 300px;">
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="hero_btn_text"><?php _e('Button Text', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="hero_btn_text" name="soul_suite_hero_btn_text" 
                                           value="<?php echo esc_attr(get_option('soul_suite_hero_btn_text')); ?>" 
                                           class="regular-text">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="hero_btn_url"><?php _e('Button URL', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="url" id="hero_btn_url" name="soul_suite_hero_btn_url" 
                                           value="<?php echo esc_url(get_option('soul_suite_hero_btn_url')); ?>" 
                                           class="large-text">
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- About Section -->
                    <div id="about" class="tab-content">
                        <h2><?php _e('About Section', 'soul-suite'); ?></h2>
                        <table class="form-table">
                            <tr>
                                <th><label for="about_title"><?php _e('Section Title', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="about_title" name="soul_suite_about_title" 
                                           value="<?php echo esc_attr(get_option('soul_suite_about_title')); ?>" 
                                           class="large-text">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="owner_name"><?php _e('Owner Name', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="owner_name" name="soul_suite_owner_name" 
                                           value="<?php echo esc_attr(get_option('soul_suite_owner_name')); ?>" 
                                           class="large-text">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="owner_title"><?php _e('Owner Title', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="owner_title" name="soul_suite_owner_title" 
                                           value="<?php echo esc_attr(get_option('soul_suite_owner_title')); ?>" 
                                           class="large-text">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="owner_bio"><?php _e('Owner Bio', 'soul-suite'); ?></label></th>
                                <td>
                                    <?php 
                                    wp_editor(
                                        get_option('soul_suite_owner_bio'), 
                                        'owner_bio',
                                        array('textarea_name' => 'soul_suite_owner_bio')
                                    ); 
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="owner_image"><?php _e('Owner Image', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="owner_image" name="soul_suite_owner_image" 
                                           value="<?php echo esc_url(get_option('soul_suite_owner_image')); ?>" 
                                           class="large-text">
                                    <button type="button" class="button upload-image-btn" data-target="owner_image">
                                        <?php _e('Select Image', 'soul-suite'); ?>
                                    </button>
                                    <div class="image-preview">
                                        <?php if ($img = get_option('soul_suite_owner_image')): ?>
                                            <img src="<?php echo esc_url($img); ?>" style="max-width: 200px;">
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Services Section -->
                    <div id="services" class="tab-content">
                        <h2><?php _e('Services Section', 'soul-suite'); ?></h2>
                        <p class="description"><?php _e('Manage your services. Each service can link to a Square booking URL.', 'soul-suite'); ?></p>
                        <table class="form-table">
                            <tr>
                                <th><label for="services_title"><?php _e('Section Title', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="services_title" name="soul_suite_services_title" 
                                           value="<?php echo esc_attr(get_option('soul_suite_services_title')); ?>" 
                                           class="large-text">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="services_subtitle"><?php _e('Subtitle', 'soul-suite'); ?></label></th>
                                <td>
                                    <textarea id="services_subtitle" name="soul_suite_services_subtitle" 
                                              class="large-text" rows="3"><?php echo esc_textarea(get_option('soul_suite_services_subtitle')); ?></textarea>
                                </td>
                            </tr>
                        </table>
                        
                        <div id="services-manager">
                            <button type="button" class="button button-primary" id="add-service-btn">
                                <?php _e('Add Service', 'soul-suite'); ?>
                            </button>
                            <div id="services-list">
                                <!-- Services will be loaded here via JavaScript -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Matrix Section -->
                    <div id="matrix" class="tab-content">
                        <h2><?php _e('System Reset / Matrix Section', 'soul-suite'); ?></h2>
                        <table class="form-table">
                            <tr>
                                <th><label for="matrix_title"><?php _e('Section Title', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="matrix_title" name="soul_suite_matrix_title" 
                                           value="<?php echo esc_attr(get_option('soul_suite_matrix_title')); ?>" 
                                           class="large-text">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="matrix_subtitle"><?php _e('Subtitle', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="matrix_subtitle" name="soul_suite_matrix_subtitle" 
                                           value="<?php echo esc_attr(get_option('soul_suite_matrix_subtitle')); ?>" 
                                           class="large-text">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="matrix_content"><?php _e('Content', 'soul-suite'); ?></label></th>
                                <td>
                                    <?php 
                                    wp_editor(
                                        get_option('soul_suite_matrix_content'), 
                                        'matrix_content',
                                        array('textarea_name' => 'soul_suite_matrix_content')
                                    ); 
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Contact Section -->
                    <div id="contact" class="tab-content">
                        <h2><?php _e('Contact Section', 'soul-suite'); ?></h2>
                        <table class="form-table">
                            <tr>
                                <th><label for="contact_title"><?php _e('Section Title', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="contact_title" name="soul_suite_contact_title" 
                                           value="<?php echo esc_attr(get_option('soul_suite_contact_title')); ?>" 
                                           class="large-text">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="contact_subtitle"><?php _e('Subtitle', 'soul-suite'); ?></label></th>
                                <td>
                                    <textarea id="contact_subtitle" name="soul_suite_contact_subtitle" 
                                              class="large-text" rows="3"><?php echo esc_textarea(get_option('soul_suite_contact_subtitle')); ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="contact_form_shortcode"><?php _e('Contact Form Shortcode', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="contact_form_shortcode" name="soul_suite_contact_form_shortcode" 
                                           value="<?php echo esc_attr(get_option('soul_suite_contact_form_shortcode')); ?>" 
                                           class="large-text" 
                                           placeholder='[soul_suite_form slug="contact"]'>
                                    <p class="description"><?php _e('Enter the shortcode for your contact form.', 'soul-suite'); ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Global Button Settings -->
                    <div id="buttons" class="tab-content">
                        <h2><?php _e('Global Button Settings', 'soul-suite'); ?></h2>
                        <p class="description"><?php _e('Configure your primary call-to-action button that appears throughout the site.', 'soul-suite'); ?></p>
                        <table class="form-table">
                            <tr>
                                <th><label for="btn_primary_text"><?php _e('Primary Button Text', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="text" id="btn_primary_text" name="soul_suite_btn_primary_text" 
                                           value="<?php echo esc_attr(get_option('soul_suite_btn_primary_text', 'Book Your Session')); ?>" 
                                           class="regular-text">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="btn_primary_url"><?php _e('Primary Button URL', 'soul-suite'); ?></label></th>
                                <td>
                                    <input type="url" id="btn_primary_url" name="soul_suite_btn_primary_url" 
                                           value="<?php echo esc_url(get_option('soul_suite_btn_primary_url')); ?>" 
                                           class="large-text">
                                    <p class="description"><?php _e('Leave empty to use the default Square booking URL.', 'soul-suite'); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="btn_primary_style"><?php _e('Button Style', 'soul-suite'); ?></label></th>
                                <td>
                                    <select id="btn_primary_style" name="soul_suite_btn_primary_style">
                                        <option value="primary" <?php selected(get_option('soul_suite_btn_primary_style'), 'primary'); ?>>Primary (Gradient)</option>
                                        <option value="secondary" <?php selected(get_option('soul_suite_btn_primary_style'), 'secondary'); ?>>Secondary (Outline)</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        
                        <h3><?php _e('Button Preview', 'soul-suite'); ?></h3>
                        <div class="button-preview-wrapper">
                            <a href="#" class="hero-btn primary-btn"><?php echo esc_html(get_option('soul_suite_btn_primary_text', 'Book Your Session')); ?></a>
                            <a href="#" class="hero-btn secondary-btn"><?php echo esc_html(get_option('soul_suite_btn_primary_text', 'Book Your Session')); ?></a>
                        </div>
                    </div>
                </div>
                
                <?php submit_button(__('Save Changes', 'soul-suite'), 'primary large'); ?>
            </form>
        </div>
        
        <script>
        jQuery(document).ready(function($) {
            // Tab switching
            $('.nav-tab').on('click', function(e) {
                e.preventDefault();
                var target = $(this).attr('href');
                
                $('.nav-tab').removeClass('nav-tab-active');
                $(this).addClass('nav-tab-active');
                
                $('.tab-content').removeClass('active');
                $(target).addClass('active');
            });
            
            // Media uploader
            $('.upload-image-btn').on('click', function(e) {
                e.preventDefault();
                var button = $(this);
                var target = button.data('target');
                
                var frame = wp.media({
                    title: 'Select Image',
                    button: { text: 'Use this image' },
                    multiple: false
                });
                
                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    $('#' + target).val(attachment.url);
                    button.next('.image-preview').html('<img src="' + attachment.url + '" style="max-width: 300px;">');
                });
                
                frame.open();
            });
        });
        </script>
        <?php
    }
}

// Initialize template parts controller
new Soul_Suite_Template_Parts();