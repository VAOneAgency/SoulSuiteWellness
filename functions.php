<?php
/**
 * Soul Suite Wellness Theme Functions
 * 
 * @package SoulSuite
 * @version 2.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// =============================
// Load Theme Config FIRST (defines constants)
// =============================
require_once get_template_directory() . '/inc/theme-config.php';

// =============================
// Load Core Theme Files (now we can use constants)
// =============================
require_once SOUL_SUITE_INC_DIR . '/form-builder.php';
require_once SOUL_SUITE_INC_DIR . '/template-parts-controller.php';
require_once SOUL_SUITE_INC_DIR . '/customizer.php';

// Load admin files in admin only
if (is_admin()) {
    if (file_exists(SOUL_SUITE_INC_DIR . '/admin/forms-admin.php')) {
        require_once SOUL_SUITE_INC_DIR . '/admin/forms-admin.php';
    }
}

// Load legacy support files if they exist
$legacy_files = array(
    'custom-header.php',
    'template-tags.php',
    'extras.php',
    'jetpack.php',
    'navwalker.php',
    'custom-functions.php',
);

foreach ($legacy_files as $file) {
    $filepath = SOUL_SUITE_INC_DIR . '/' . $file;
    if (file_exists($filepath)) {
        require_once $filepath;
    }
}

// =============================
// Theme Setup
// =============================
if (!function_exists('soul_suite_setup')) :
function soul_suite_setup() {
    // Load text domain
    load_theme_textdomain('soul-suite', SOUL_SUITE_THEME_DIR . '/languages');
    
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    
    // Register image sizes
    $image_sizes = soul_suite_image_sizes();
    foreach ($image_sizes as $name => $size) {
        add_image_size($name, $size[0], $size[1], $size[2]);
    }
    
    // Legacy image sizes (backwards compatibility)
    add_image_size('monalisa_image_770_510', 770, 510, true);
    add_image_size('monalisa_image_1280_500', 1280, 500, true);
    add_image_size('monalisa_image_870_984', 870, 984, true);
    add_image_size('monalisa_image_200_200', 200, 200, true);
    add_image_size('monalisa_image_1200_800', 1200, 800, true);
    add_image_size('monalisa_image_210_90', 210, 90, true);
    add_image_size('monalisa_image_840_430', 840, 430, true);
    
    // Register navigation menus
    $nav_menus = soul_suite_nav_menus();
    register_nav_menus($nav_menus);
    
    // Legacy menu for backwards compatibility
    register_nav_menus(array(
        'menu-1' => __('Primary (Legacy)', 'soul-suite'),
    ));
    
    // Custom Logo
    add_theme_support('custom-logo');
    
    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Post formats
    add_theme_support('post-formats', array('audio', 'video'));
    
    // Custom background
    add_theme_support('custom-background', apply_filters('soul_suite_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    )));
    
    // Selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
    
    // Editor style
    add_editor_style(array('assets/css/editor-style.css', soul_suite_google_fonts_url()));
    
    // Set content width
    $GLOBALS['content_width'] = apply_filters('soul_suite_content_width', 1200);
}
endif;
add_action('after_setup_theme', 'soul_suite_setup');

// =============================
// Widget Areas
// =============================
function soul_suite_widgets_init() {
    $widget_areas = soul_suite_widget_areas();
    foreach ($widget_areas as $widget_area) {
        register_sidebar($widget_area);
    }
}
add_action('widgets_init', 'soul_suite_widgets_init');

// =============================
// Enqueue Scripts and Styles
// =============================
function soul_suite_scripts() {
    // Google Fonts
    wp_enqueue_style('soul-suite-google-fonts', soul_suite_google_fonts_url(), array(), null);
    
    // CSS Files
    wp_enqueue_style('bootstrap', SOUL_SUITE_ASSETS_URI . '/bootstrap/css/bootstrap.min.css', array(), '4.6.0');
    wp_enqueue_style('font-awesome', SOUL_SUITE_ASSETS_URI . '/fonts/font-awesome.min.css', array(), '4.7.0');
    wp_enqueue_style('owl-carousel', SOUL_SUITE_ASSETS_URI . '/owlcarousel/css/owl.carousel.css', array(), '2.3.4');
    wp_enqueue_style('owl-theme', SOUL_SUITE_ASSETS_URI . '/owlcarousel/css/owl.theme.css', array(), '2.3.4');
    wp_enqueue_style('animate', SOUL_SUITE_ASSETS_URI . '/css/animate.css', array(), '4.1.1');
    wp_enqueue_style('soul-suite-main-style', SOUL_SUITE_ASSETS_URI . '/css/style.css', array(), SOUL_SUITE_VERSION);
    wp_enqueue_style('soul-suite-style', get_stylesheet_uri(), array(), SOUL_SUITE_VERSION);
    
    // Custom CSS
    if (file_exists(SOUL_SUITE_THEME_DIR . '/assets/css/custom.css')) {
        wp_enqueue_style('soul-suite-custom', SOUL_SUITE_ASSETS_URI . '/assets/css/custom.css', array('soul-suite-style'), SOUL_SUITE_VERSION);
    }
    
    // JavaScript Files
    wp_enqueue_script('bootstrap', SOUL_SUITE_ASSETS_URI . '/bootstrap/js/bootstrap.min.js', array('jquery'), '4.6.0', true);
    wp_enqueue_script('wow', SOUL_SUITE_ASSETS_URI . '/js/wow.min.js', array('jquery'), '1.3.0', true);
    wp_enqueue_script('owl-carousel', SOUL_SUITE_ASSETS_URI . '/owlcarousel/js/owl.carousel.min.js', array('jquery'), '2.3.4', true);
    
    // Check if scripts.js exists
    if (file_exists(SOUL_SUITE_THEME_DIR . '/assets/js/scripts.js')) {
        wp_enqueue_script('soul-suite-scripts', SOUL_SUITE_ASSETS_URI . '/js/scripts.js', array('jquery'), SOUL_SUITE_VERSION, true);
    }
    
    // Localize script
    wp_localize_script('soul-suite-scripts', 'soulSuite', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('soul_suite_nonce'),
    ));
    
    // Comment reply
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'soul_suite_scripts');

// =============================
// Form Shortcode
// =============================
function soul_suite_form_shortcode($atts) {
    $atts = shortcode_atts(array(
        'slug' => '',
    ), $atts);
    
    if (empty($atts['slug'])) {
        return '<p class="form-error">Error: Form slug is required.</p>';
    }
    
    $form = Soul_Suite_Form_Builder::get_form_by_slug($atts['slug']);
    
    if (!$form) {
        return '<p class="form-error">Error: Form "' . esc_html($atts['slug']) . '" not found.</p>';
    }
    
    ob_start();
    $template = locate_template('template-parts/form-render.php');
    if ($template) {
        include $template;
    }
    return ob_get_clean();
}
add_shortcode('soul_suite_form', 'soul_suite_form_shortcode');

// =============================
// Form Submission Handler (AJAX)
// =============================
function soul_suite_handle_form_submission() {
    check_ajax_referer('soul_suite_nonce', 'nonce');
    
    $form_slug = sanitize_text_field($_POST['form_slug'] ?? '');
    $form = Soul_Suite_Form_Builder::get_form_by_slug($form_slug);
    
    if (!$form) {
        wp_send_json_error('Form not found');
    }
    
    $config = $form->form_config;
    $submission_data = array();
    
    // Collect and sanitize form data
    foreach ($config['fields'] as $field) {
        $value = $_POST[$field['name']] ?? '';
        
        // Sanitize based on field type
        switch ($field['type']) {
            case 'email':
                $value = sanitize_email($value);
                break;
            case 'textarea':
                $value = sanitize_textarea_field($value);
                break;
            default:
                if (is_array($value)) {
                    $value = array_map('sanitize_text_field', $value);
                } else {
                    $value = sanitize_text_field($value);
                }
        }
        
        $submission_data[$field['name']] = $value;
        
        // Validate required fields
        if (!empty($field['required']) && empty($value)) {
            wp_send_json_error($field['label'] . ' is required.');
        }
    }
    
    // Save submission
    $submission_id = Soul_Suite_Form_Builder::save_submission($form->id, $submission_data);
    
    if (!$submission_id) {
        wp_send_json_error('Failed to save submission.');
    }
    
    // Send email notification if enabled
    if (!empty($config['settings']['sendEmail'])) {
        $to = $config['settings']['emailTo'] ?? get_option('admin_email');
        $subject = 'New Form Submission: ' . $form->form_name;
        $message = "New submission received:\n\n";
        
        foreach ($submission_data as $key => $value) {
            if (is_array($value)) {
                $value = implode(', ', $value);
            }
            $message .= ucwords(str_replace('_', ' ', $key)) . ": " . $value . "\n";
        }
        
        wp_mail($to, $subject, $message);
    }
    
    wp_send_json_success(array(
        'message' => $config['settings']['successMessage'] ?? 'Thank you for your submission!',
        'redirect' => $config['settings']['redirectUrl'] ?? '',
    ));
}
add_action('wp_ajax_soul_suite_submit_form', 'soul_suite_handle_form_submission');
add_action('wp_ajax_nopriv_soul_suite_submit_form', 'soul_suite_handle_form_submission');

// =============================
// Content Filters
// =============================
function soul_suite_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'soul_suite_excerpt_length', 999);

function soul_suite_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'soul_suite_excerpt_more');

// =============================
// Body Classes
// =============================
function soul_suite_body_classes($classes) {
    if (is_singular()) {
        $classes[] = 'single-page';
    }
    
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }
    
    return $classes;
}
add_filter('body_class', 'soul_suite_body_classes');

// =============================
// Comments
// =============================
function soul_suite_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <div class="single_comment">
            <div class="media">
                <div class="comment_avatar">
                    <?php echo get_avatar($comment, 70); ?>
                </div>
                <div class="media-body text-left comment_single">
                    <h5 class="media-heading">
                        <?php comment_author_link(); ?> 
                        <span><?php echo ' - ' . get_comment_date('F j, Y') . ' ' . get_comment_date('g:i a'); ?></span>
                        <div class="creply_link">
                            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </div>
                    </h5>
                    <?php if ($comment->comment_approved == '0'): ?>
                        <p><em><?php _e('Your comment is awaiting moderation.', 'soul-suite'); ?></em></p>
                    <?php endif; ?>
                    <?php comment_text(); ?>
                </div>
            </div>
        </div>
    </li>
    <?php
}

// Comment form customization
function soul_suite_comment_form_defaults($defaults) {
    $defaults['comment_notes_after'] = '';
    $defaults['comment_notes_before'] = '';
    $defaults['title_reply'] = __('Write your comment here', 'soul-suite');
    $defaults['comment_field'] = '<div class="row"><div class="form-group col-md-12"><textarea id="comment" class="comment_field form-control" name="comment" cols="77" rows="3" placeholder="' . esc_attr__('Write your Comment', 'soul-suite') . '" aria-required="true"></textarea></div></div>';
    return $defaults;
}
add_filter('comment_form_defaults', 'soul_suite_comment_form_defaults');

function soul_suite_comment_form_fields($fields) {
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    
    $fields['author'] = '<div class="row"><div class="form-group col-md-4"><input type="text" name="author" id="author" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . esc_attr__('Your Name *', 'soul-suite') . '" size="22" tabindex="1"' . ($req ? ' aria-required="true"' : '') . ' class="input-name form-control" /></div>';
    
    $fields['email'] = '<div class="form-group col-md-4"><input type="text" name="email" id="email" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . esc_attr__('Your Email *', 'soul-suite') . '" size="22" tabindex="2"' . ($req ? ' aria-required="true"' : '') . ' class="input-email form-control" /></div>';
    
    $fields['url'] = '<div class="form-group col-md-4"><input type="text" name="url" id="url" value="' . esc_attr($commenter['comment_author_url']) . '" placeholder="' . esc_attr__('Website', 'soul-suite') . '" size="22" tabindex="3" class="input-url form-control" /></div></div>';
    
    return $fields;
}
add_filter('comment_form_default_fields', 'soul_suite_comment_form_fields');

// Load Forms Admin
if (is_admin() && file_exists(SOUL_SUITE_INC_DIR . '/admin/forms-admin.php')) {
    require_once SOUL_SUITE_INC_DIR . '/admin/forms-admin.php';
}


/**
 * Custom Contact Form (No Plugin)
 */
function soul_suite_contact_form() {
    ob_start();
    ?>
    <form id="soul-suite-contact-form" class="soul-contact-form" method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
        <div class="form-group">
            <input type="text" name="contact_name" id="contact_name" placeholder="Your name" required>
        </div>
        <div class="form-group">
            <input type="email" name="contact_email" id="contact_email" placeholder="Your email" required>
        </div>
        <div class="form-group">
            <input type="text" name="contact_subject" id="contact_subject" placeholder="Subject" required>
        </div>
        <div class="form-group">
            <textarea name="contact_message" id="contact_message" rows="5" placeholder="Your message (optional)"></textarea>
        </div>
        <?php wp_nonce_field('soul_suite_contact_form', 'contact_nonce'); ?>
        <input type="hidden" name="action" value="soul_suite_submit_contact">
        <div class="form-group">
            <button type="submit" class="hero-btn primary-btn">Send Message</button>
        </div>
        <div class="form-message"></div>
    </form>
    
    <script>
    jQuery(document).ready(function($) {
        $('#soul-suite-contact-form').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('button[type="submit"]');
            var $msg = $form.find('.form-message');
            
            $btn.prop('disabled', true).text('Sending...');
            $msg.html('');
            
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(response) {
                    if (response.success) {
                        $msg.html('<p class="success">' + response.data.message + '</p>');
                        $form[0].reset();
                    } else {
                        $msg.html('<p class="error">' + response.data.message + '</p>');
                    }
                    $btn.prop('disabled', false).text('Send Message');
                },
                error: function() {
                    $msg.html('<p class="error">Something went wrong. Please try again.</p>');
                    $btn.prop('disabled', false').text('Send Message');
                }
            });
        });
    });
    </script>
    <?php
    return ob_get_clean();
}

/**
 * Handle Contact Form Submission
 */
function soul_suite_handle_contact_form() {
    // Verify nonce
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'soul_suite_contact_form')) {
        wp_send_json_error(array('message' => 'Security check failed.'));
    }
    
    // Sanitize inputs
    $name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['contact_email']);
    $subject = sanitize_text_field($_POST['contact_subject']);
    $message = sanitize_textarea_field($_POST['contact_message']);
    
    // Validate
    if (empty($name) || empty($email) || empty($subject)) {
        wp_send_json_error(array('message' => 'Please fill in all required fields.'));
    }
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
    }
    
    // Send email
    $to = get_theme_mod('soul_suite_contact_email', 'bewell@soulsuitewellness.com');
    $email_subject = 'Contact Form: ' . $subject;
    $email_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = array('Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email);
    
    $sent = wp_mail($to, $email_subject, $email_body, $headers);
    
    if ($sent) {
        wp_send_json_success(array('message' => 'Thank you! Your message has been sent.'));
    } else {
        wp_send_json_error(array('message' => 'Failed to send message. Please try again.'));
    }
}
add_action('wp_ajax_soul_suite_submit_contact', 'soul_suite_handle_contact_form');
add_action('wp_ajax_nopriv_soul_suite_submit_contact', 'soul_suite_handle_contact_form');

// =============================
// Search Form
// =============================
function soul_suite_search_form($form) {
    $form = '
        <div class="form-group search-input">
            <div class="search_form">
                <form role="search" method="get" id="searchform" class="searchform" action="' . esc_url(home_url('/')) . '">
                    <input type="text" value="' . esc_attr(get_search_query()) . '" name="s" id="s" class="form-control search_field" placeholder="' . esc_attr__('Search...', 'soul-suite') . '">
                </form>
            </div>
        </div>
    ';
    return $form;
}
add_filter('get_search_form', 'soul_suite_search_form');

// =============================
// Helper Functions
// =============================
function soul_suite_kses($content) {
    $allowed_tags = array(
        'p' => array('class' => array()),
        'span' => array('class' => array()),
        'div' => array('class' => array()),
        'strong' => array(),
        'b' => array(),
        'br' => array(),
        'h1' => array('class' => array()),
        'h2' => array('class' => array()),
        'h3' => array('class' => array()),
        'h4' => array('class' => array()),
        'h5' => array('class' => array()),
        'h6' => array('class' => array()),
        'i' => array('class' => array()),
        'ul' => array('class' => array(), 'id' => array()),
        'ol' => array('class' => array(), 'id' => array()),
        'li' => array('class' => array(), 'id' => array()),
        'a' => array('href' => array(), 'target' => array(), 'class' => array()),
        'img' => array('src' => array(), 'alt' => array(), 'class' => array()),
    );
    return wp_kses($content, $allowed_tags);
}

function soul_suite_main_menu() {
    // Try legacy menu location first (menu-1), then fall back to primary
    $menu_locations = get_nav_menu_locations();
    $menu_location = 'primary';
    
    // Check if menu-1 (Primary Legacy) has a menu assigned
    if (isset($menu_locations['menu-1']) && $menu_locations['menu-1'] > 0) {
        $menu_location = 'menu-1';
    }
    
    wp_nav_menu(array(
        'theme_location' => $menu_location,
        'depth' => 3,
        'container' => false,
        'menu_class' => 'nav navbar-nav',
        'fallback_cb' => '__return_false',
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    ));
}

/**
 * Output CSS Custom Properties (Variables) from Customizer
 */
function soul_suite_output_css_variables() {
    $teal = get_theme_mod('soul_suite_color_teal', '#40e0d0');
    $teal_hover = get_theme_mod('soul_suite_color_teal_hover', '#39c9b9');
    $brown = get_theme_mod('soul_suite_color_brown', '#8c756a');
    $brown_hover = get_theme_mod('soul_suite_color_brown_hover', '#7a6759');
    $orange = get_theme_mod('soul_suite_color_orange', '#ff5b0c');
    $orange_hover = get_theme_mod('soul_suite_color_orange_hover', '#e5520b');
    $dark_teal = get_theme_mod('soul_suite_color_dark_teal', '#227767');
    $text = get_theme_mod('soul_suite_color_text', '#2c3e50');
    $text_light = get_theme_mod('soul_suite_color_text_light', '#555555');
    $off_white = get_theme_mod('soul_suite_color_off_white', '#fdf8f4');
    $font_base = get_theme_mod('soul_suite_font_size_base', '15');
    
    ?>
    <style id="soul-suite-css-variables">
    :root {
        /* Brand Colors */
        --color-teal: <?php echo esc_attr($teal); ?>;
        --color-teal-hover: <?php echo esc_attr($teal_hover); ?>;
        --color-brown: <?php echo esc_attr($brown); ?>;
        --color-brown-hover: <?php echo esc_attr($brown_hover); ?>;
        --color-orange: <?php echo esc_attr($orange); ?>;
        --color-orange-hover: <?php echo esc_attr($orange_hover); ?>;
        --color-dark-teal: <?php echo esc_attr($dark_teal); ?>;
        
        /* Text Colors */
        --color-text: <?php echo esc_attr($text); ?>;
        --color-text-light: <?php echo esc_attr($text_light); ?>;
        --color-off-white: <?php echo esc_attr($off_white); ?>;
        --color-white: #ffffff;
        --color-black: #000000;
        
        /* Soulara Aliases (for legacy support) */
        --soulara-teal: <?php echo esc_attr($teal_hover); ?>;
        --soulara-brown: <?php echo esc_attr($brown_hover); ?>;
        --soulara-orange: <?php echo esc_attr($orange_hover); ?>;
        --soulara-text: #000000;
        
        /* Gradients */
        --gradient-primary: linear-gradient(90deg, <?php echo esc_attr($teal); ?>, <?php echo esc_attr($brown); ?>, <?php echo esc_attr($orange); ?>);
        --gradient-primary-hover: linear-gradient(90deg, <?php echo esc_attr($teal_hover); ?>, <?php echo esc_attr($brown_hover); ?>, <?php echo esc_attr($orange_hover); ?>);
        --soulara-gradient: linear-gradient(90deg, <?php echo esc_attr($teal_hover); ?> 0%, <?php echo esc_attr($brown_hover); ?> 50%, <?php echo esc_attr($orange_hover); ?> 100%);
        
        /* Typography */
        --font-size-base: <?php echo esc_attr($font_base); ?>pt;
        --font-size-small: 0.85em;
        --font-size-medium: 1em;
        --font-size-large: 1.2em;
        
        /* Shadows */
        --shadow-small: 0 5px 15px rgba(0, 0, 0, 0.1);
        --shadow-medium: 0 10px 30px rgba(0, 0, 0, 0.1);
        --shadow-large: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    
    /* Global Button Styles */
    .hero-btn,
    .primary-btn {
        background: var(--gradient-primary);
        color: var(--color-white);
        font-size: var(--font-size-base);
        transition: all 0.3s ease;
    }
    
    .hero-btn:hover,
    .primary-btn:hover {
        background: var(--gradient-primary-hover);
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
    }
    </style>
    <?php
}
add_action('wp_head', 'soul_suite_output_css_variables');

/**
 * EMERGENCY: Force-save ALL 6 services to database
 * This will run ONCE when you load any admin page
 */
add_action('admin_init', 'soul_suite_emergency_fix_services', 1);
function soul_suite_emergency_fix_services() {
    // Check if already fixed
    if (get_option('soul_suite_services_emergency_fixed_v2')) {
        return;
    }
    
    // ALL 6 SERVICES - Complete data
    $services_data = array(
        1 => array(
            'title' => '𝗦𝗼𝘂𝗹𝗳𝘂𝗹 𝗦𝘁𝗿𝗮𝘁𝗲𝗴𝘆 𝗖𝗮𝗹𝗹',
            'tag' => 'Individuals ONLY',
            'image' => 'https://soulsuitewellness.com/wp-content/uploads/2025/07/individual.png',
            'content' => '𝗡𝗼𝘁𝗵𝗶𝗻𝗴 𝗵𝗮𝗽𝗽𝗲𝗻𝘀 𝗯𝘆 𝗮𝗰𝗰𝗶𝗱𝗲𝗻𝘁—our paths have crossed for a reason, guided by energy and alignment. This free 15-minute call is a sacred space for individuals ready to release stress, realign emotionally, and explore their deeper purpose in a supportive, soulful way. Ready to be seen, heard, and supported on your wellness journey? Let\'s begin.',
            'price' => '$0.00',
            'duration' => '15 mins',
            'service_id' => 'GJZY3CEHIIJR6XSGCXQR6D6P',
            'is_free' => true,
        ),
        2 => array(
            'title' => '𝗦𝗼𝘂𝗹𝗳𝘂𝗹 𝗦𝘁𝗿𝗮𝘁𝗲𝗴𝘆 𝗖𝗮𝗹𝗹',
            'tag' => 'Businesses ONLY',
            'image' => 'https://soulsuitewellness.com/wp-content/uploads/2025/07/business_call.png',
            'content' => 'This 30-minute call is a chance to align your wellness goals with Soul Reiki\'s holistic offerings for teams and organizations. Explore services like energy healing, resilience training, and workplace wellness support. Let\'s co-create a more balanced, empowered culture—book today.',
            'price' => '$0.00',
            'duration' => '30 mins',
            'service_id' => 'HWYWQ6UMI4Q34K3TM27C7EU4',
            'is_free' => true,
        ),
        3 => array(
            'title' => '𝗩𝗶𝗿𝘁𝘂𝗮𝗹 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝘀𝘀𝗶𝗼𝗻',
            'tag' => '',
            'image' => 'https://soulsuitewellness.com/wp-content/uploads/2025/07/𝗩𝗶𝗿𝘁𝘂𝗮𝗹-𝗥𝗲𝗶𝗸𝗶-𝗦𝗲𝘀𝘀𝗶𝗼𝗻.png',
            'content' => 'Experience the healing power of Reiki—virtually. This gentle energy practice works across distance to help release blockages and restore mind-body-spirit balance. Relax in your own space as healing energy, intuitive channeling, and optional crystal support guide you toward clarity and renewal. Ready to receive deep healing from wherever you are? Book your session today.',
            'price' => '$111.00',
            'duration' => '1 hr',
            'service_id' => 'U43Y7M73OO622DHKS3CUD42L',
            'is_free' => false,
        ),
        4 => array(
            'title' => '𝗠𝗼𝗯𝗶𝗹𝗲 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝗿𝘃𝗶𝗰𝗲',
            'tag' => 'South Atlanta',
            'image' => 'https://soulsuitewellness.com/wp-content/uploads/2025/07/mobile-rekii.png',
            'content' => 'Experience the healing power of in-person Reiki—a gentle energy practice that helps restore balance in your body, mind, and spirit. Each session may include intuitive channeling and crystal healing to help you feel clear, centered, and renewed. Based in Metro Atlanta. Ready to reconnect and realign? Book your session today.',
            'price' => '$111.00',
            'duration' => '1 hr',
            'service_id' => 'YXCE5X5HUZRMBOBURHCYPYGS',
            'is_free' => false,
        ),
        5 => array(
            'title' => '𝗠𝗼𝗯𝗶𝗹𝗲 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝗿𝘃𝗶𝗰𝗲',
            'tag' => 'Metro Atlanta',
            'image' => 'https://soulsuitewellness.com/wp-content/uploads/2025/07/Mobile-Rei.png',
            'content' => 'In-person Reiki offers a powerful way to restore balance in your body, mind, and spirit through gentle energy healing. Sessions may include intuitive channeling and crystal healing to help you release blockages and reconnect with your true self. Serving Metro Atlanta. Ready to feel clear, aligned, and renewed? Book today.',
            'price' => '$144.00',
            'duration' => '1 hr',
            'service_id' => '2OIBU3CYV3YAZ47L2YXJTAVP',
            'is_free' => false,
        ),
        6 => array(
            'title' => '𝗠𝗼𝗯𝗶𝗹𝗲 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝗿𝘃𝗶𝗰𝗲',
            'tag' => 'Up to 30 Miles Outside Metro Atlanta',
            'image' => 'https://soulsuitewellness.com/wp-content/uploads/2025/07/30mile.png',
            'content' => 'Discover the healing power of in-person Reiki—a gentle, energy-based practice designed to clear blockages and restore balance in your body, mind, and spirit. Ready to reconnect with your center? Book now and take the first step toward clarity and peace.',
            'price' => '$222.00',
            'duration' => '1 hr',
            'service_id' => 'GISRJASPYOZGFQIPTRV35KZO',
            'is_free' => false,
        ),
    );
    
    // Save each service to database
    foreach ($services_data as $i => $service) {
        set_theme_mod("soul_suite_service_{$i}_enabled", true);
        set_theme_mod("soul_suite_service_{$i}_title", $service['title']);
        set_theme_mod("soul_suite_service_{$i}_tag", $service['tag']);
        set_theme_mod("soul_suite_service_{$i}_image", $service['image']);
        set_theme_mod("soul_suite_service_{$i}_content", $service['content']);
        set_theme_mod("soul_suite_service_{$i}_price", $service['price']);
        set_theme_mod("soul_suite_service_{$i}_duration", $service['duration']);
        set_theme_mod("soul_suite_service_{$i}_service_id", $service['service_id']);
        set_theme_mod("soul_suite_service_{$i}_is_free", $service['is_free']);
    }
    
    // Mark as fixed
    update_option('soul_suite_services_emergency_fixed_v2', true);
    
    // Show success message
    add_action('admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p><strong>🎉 SUCCESS!</strong> All 6 services saved to database. <a href="' . home_url() . '" target="_blank">View your landing page now!</a></p>';
        echo '</div>';
    });
}

/**
 * EMERGENCY FIX v2: Force-save Matrix Points to Database
 */
add_action('admin_init', 'soul_suite_emergency_fix_matrix_points', 1);
function soul_suite_emergency_fix_matrix_points() {
    // Check if already fixed
    if (get_option('soul_suite_matrix_emergency_fixed')) {
        return;
    }
    
    // Force-save all matrix data from customizer defaults
    $matrix_data = array(
        'soul_suite_matrix_title' => 'BURNOUT ISN\'T JUST STRESS. IT\'S A WHOLE-SYSTEM BREAKDOWN',
        'soul_suite_matrix_intro' => 'Burnout isn\'t a personal failure—it\'s a predictable outcome of environments that ignore human sustainability.',
        'soul_suite_matrix_point_1' => '<strong>Toxic Productivity & "Hero Culture"</strong> that reward overextension and silence real needs',
        'soul_suite_matrix_point_2' => '<strong>Emotional Exhaustion, Empathic Overload & Values Misalignment</strong> that erode purpose and connection',
        'soul_suite_matrix_point_3' => '<strong>Outdated Organizational Models</strong> that treat people as output instead of whole humans',
        'soul_suite_matrix_point_4' => '<strong>Chronic Stress Patterns</strong> imprinted in the body, nervous system, and workplace culture—individually and collectively',
        'soul_suite_matrix_note' => 'This isn\'t something a day off or a meditation app can fix.',
        'soul_suite_matrix_conclusion' => 'Your people need a deep recalibration—a strategic, emotional, and physiological reset that restores well-being at the root.',
        'soul_suite_matrix_cta_text' => 'Let\'s Have a Conversation',
    );
    
    // Save each value to database
    foreach ($matrix_data as $key => $value) {
        set_theme_mod($key, $value);
    }
    
    // Mark as fixed
    update_option('soul_suite_matrix_emergency_fixed', true);
    
    // Show success message
    add_action('admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p><strong>✅ Matrix Section Fixed!</strong> All bullet points saved to database. Refresh your landing page!</p>';
        echo '</div>';
    });
}

/**
 * EMERGENCY FIX v3: Force-save Burnout Content to Database
 */
add_action('admin_init', 'soul_suite_emergency_fix_burnout', 1);
function soul_suite_emergency_fix_burnout() {
    // Check if already fixed
    if (get_option('soul_suite_burnout_emergency_fixed')) {
        return;
    }
    
    // Force-save burnout content from customizer default
    $burnout_content = "If you're a healthcare executive, wellness leader, provider, or purpose-driven organization constantly pushing through stress, high turnover, and silent suffering—you're not alone.\n\nThe cycle of burnout is an invisible system of over-functioning, people-pleasing, emotional suppression, and energetic depletion.\n\nThis isn't about managing stress. It's about dismantling the system that's keeping your team stuck in survival mode.";
    
    set_theme_mod('soul_suite_burnout_content', $burnout_content);
    
    // Mark as fixed
    update_option('soul_suite_burnout_emergency_fixed', true);
    
    // Show success message
    add_action('admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p><strong>✅ Burnout Content Fixed!</strong> Content saved to database.</p>';
        echo '</div>';
    });
}
/**
 * EMERGENCY FIX v4: Force-save Burnout Styling Defaults
 */
add_action('admin_init', 'soul_suite_emergency_fix_burnout_styling', 1);
function soul_suite_emergency_fix_burnout_styling() {
    // Check if already fixed
    if (get_option('soul_suite_burnout_styling_fixed')) {
        return;
    }
    
    // Force-save burnout styling defaults
    set_theme_mod('soul_suite_burnout_bg_color', 'linear-gradient(90deg, #40e0d0, #8c756a, #ff5b0c)');
    set_theme_mod('soul_suite_burnout_title_color', '#ffffff');
    set_theme_mod('soul_suite_burnout_title_font_size', '40');
    set_theme_mod('soul_suite_burnout_highlight_color', '#555555');
    set_theme_mod('soul_suite_burnout_highlight_bg', 'transparent');
    set_theme_mod('soul_suite_burnout_highlight_font_size', '24');
    set_theme_mod('soul_suite_burnout_text_color', '#555555');
    set_theme_mod('soul_suite_burnout_text_font_size', '16');
    set_theme_mod('soul_suite_burnout_text_line_height', '1.6');
    set_theme_mod('soul_suite_burnout_content_bg', 'rgba(255, 255, 255, 0.95)');
    set_theme_mod('soul_suite_burnout_image_border_color', 'rgba(255, 255, 255, 0.2)');
    set_theme_mod('soul_suite_burnout_image_border_width', '5');
    set_theme_mod('soul_suite_burnout_image_border_radius', '20');
    
    // Mark as fixed
    update_option('soul_suite_burnout_styling_fixed', true);
    
    // Show success message
    add_action('admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p><strong>✅ Burnout Styling Fixed!</strong> All styling defaults restored to original design.</p>';
        echo '</div>';
    });
}

/**
 * EMERGENCY FIX v5: Force-save About Owner Bio
 */
add_action('admin_init', 'soul_suite_emergency_fix_about_bio', 1);
function soul_suite_emergency_fix_about_bio() {
    // Check if already fixed
    if (get_option('soul_suite_about_bio_fixed')) {
        return;
    }
    
    // Force-save the default bio to database
    $default_bio = "Welcome to Soul Suite Wellness, where transformation meets intention. I'm Soulara Sevier, and I'm passionate about guiding individuals on their journey to holistic wellness and personal empowerment.

With years of experience in wellness coaching and a deep commitment to helping others discover their authentic selves, I created Soul Suite Wellness as a sanctuary for those seeking meaningful change in their lives.

My approach combines traditional wellness practices with modern techniques, creating a unique experience tailored to each individual's needs. I believe that true wellness encompasses mind, body, and spirit, and I'm here to support you every step of the way on your transformative journey.

At Soul Suite Wellness, we don't just focus on temporary fixes – we work together to create lasting, sustainable changes that align with your deepest values and aspirations.";
    
    set_theme_mod('soul_suite_about_owner_bio', $default_bio);
    
    // Mark as fixed
    update_option('soul_suite_about_bio_fixed', true);
    
    // Show success message
    add_action('admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p><strong>✅ About Owner Bio Fixed!</strong> Default bio saved to database. <a href="' . home_url() . '" target="_blank">View your page now!</a></p>';
        echo '</div>';
    });
}

/**
 * EMERGENCY FIX v6: Create Form Builder Tables
 */
add_action('admin_init', 'soul_suite_emergency_create_form_tables', 1);
function soul_suite_emergency_create_form_tables() {
    if (get_option('soul_suite_form_tables_created')) {
        return;
    }
    
    Soul_Suite_Form_Builder::create_tables();
    update_option('soul_suite_form_tables_created', true);
    
    add_action('admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p><strong>✅ Form Builder Ready!</strong> Database tables created. <a href="' . admin_url('admin.php?page=soul-suite-forms') . '">Create your first form!</a></p>';
        echo '</div>';
    });
}

// =============================
// Debug & Customizer Fixes
// =============================
// Debug: Check if template controller loaded
add_action('admin_notices', function() {
    if (class_exists('Soul_Suite_Template_Parts')) {
        echo '<div class="notice notice-success is-dismissible"><p>✅ Template Controller Loaded!</p></div>';
    } else {
        echo '<div class="notice notice-error"><p>❌ Template Controller NOT Loaded</p></div>';
    }
});

// Ensure customizer runs after WordPress defaults
// add_action('customize_register', 'soul_suite_customize_register', 11);

// =============================
// Cleanup WordPress Head
// =============================
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');