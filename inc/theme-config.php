<?php
/**
 * Soul Suite Theme Configuration - SYNCED WITH CUSTOMIZER
 * 
 * Core theme constants, settings, and configuration
 * 
 * @package SoulSuite
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Constants
 */
define('SOUL_SUITE_VERSION', '2.0.0');
define('SOUL_SUITE_THEME_DIR', get_template_directory());
define('SOUL_SUITE_THEME_URI', get_template_directory_uri());
define('SOUL_SUITE_INC_DIR', SOUL_SUITE_THEME_DIR . '/inc');
define('SOUL_SUITE_ASSETS_URI', SOUL_SUITE_THEME_URI . '/assets');

/**
 * Color Palette Constants
 */
define('SOUL_SUITE_COLOR_TEAL', '#40e0d0');
define('SOUL_SUITE_COLOR_TEAL_HOVER', '#39c9b9');
define('SOUL_SUITE_COLOR_BROWN', '#8c756a');
define('SOUL_SUITE_COLOR_BROWN_HOVER', '#7a6759');
define('SOUL_SUITE_COLOR_ORANGE', '#ff5b0c');
define('SOUL_SUITE_COLOR_ORANGE_HOVER', '#e5520b');
define('SOUL_SUITE_COLOR_DARK_TEAL', '#227767');
define('SOUL_SUITE_COLOR_TEXT', '#2c3e50');
define('SOUL_SUITE_COLOR_TEXT_LIGHT', '#555');
define('SOUL_SUITE_COLOR_OFF_WHITE', '#fdf8f4');
define('SOUL_SUITE_COLOR_WHITE', '#ffffff');

/**
 * Typography Constants
 */
define('SOUL_SUITE_FONT_PRIMARY', "'Poppins', sans-serif");
define('SOUL_SUITE_FONT_SECONDARY', "'Playfair Display', serif");
define('SOUL_SUITE_FONT_ACCENT', "'Dancing Script', cursive");

/**
 * Spacing Constants (in pixels)
 */
define('SOUL_SUITE_SPACING_SECTION', 80);
define('SOUL_SUITE_SPACING_LARGE', 40);
define('SOUL_SUITE_SPACING_MEDIUM', 30);
define('SOUL_SUITE_SPACING_SMALL', 20);
define('SOUL_SUITE_SPACING_XSMALL', 10);

/**
 * Border Radius Constants
 */
define('SOUL_SUITE_RADIUS_LARGE', 20);
define('SOUL_SUITE_RADIUS_MEDIUM', 15);
define('SOUL_SUITE_RADIUS_SMALL', 10);
define('SOUL_SUITE_RADIUS_PILL', 50);

/**
 * Theme Options Defaults - MATCHES CUSTOMIZER EXACTLY
 */
function soul_suite_get_defaults() {
    return array(
        // Contact Information
        'contact_email' => 'bewell@soulsuitewellness.com',
        'contact_phone' => '(678) 744-3723',
        'contact_address' => 'Atlanta, Georgia, USA',
        
        // Social Media Links - MATCHES CUSTOMIZER ssw_social_ PREFIX
        'ssw_social_facebook_url' => 'https://www.facebook.com/soulsuitewellness',
        'ssw_social_instagram_url' => 'https://www.instagram.com/soulsuitewellness',
        'ssw_social_twitter_url' => '',
        'ssw_social_linkedin_url' => 'https://www.alignable.com/atlanta-ga/soul-suite-wellness-tm?user=16332141',
        'ssw_social_youtube_url' => 'https://youtube.com/channel/UCeb0vH5DPS6R8D4qeNLX0Fg',
        'ssw_social_tiktok_url' => '',
        
        // Square Integration - ALL 6 Services
        'square_location_id' => '09TR3SSB0EZ79',
        'square_merchant_id' => '0ccyiu9cc0ezt1',
        
        // Individual Service IDs (matches customizer service_{n}_service_id pattern)
        'service_1_service_id' => 'GJZY3CEHIIJR6XSGCXQR6D6P', // Individual Strategy Call
        'service_2_service_id' => 'HWYWQ6UMI4Q34K3TM27C7EU4', // Business Strategy Call
        'service_3_service_id' => 'U43Y7M73OO622DHKS3CUD42L', // Virtual Reiki
        'service_4_service_id' => 'YXCE5X5HUZRMBOBURHCYPYGS', // Mobile Reiki - South Atlanta
        'service_5_service_id' => '2OIBU3CYV3YAZ47L2YXJTAVP', // Mobile Reiki - Metro Atlanta
        'service_6_service_id' => 'GISRJASPYOZGFQIPTRV35KZO', // Mobile Reiki - 30 Miles
        
        // Legacy/backward compatibility (for old code that might reference these)
        'square_individual_service_id' => 'GJZY3CEHIIJR6XSGCXQR6D6P',
        'square_business_service_id' => 'HWYWQ6UMI4Q34K3TM27C7EU4',
        
        // Calendly Integration
        'calendly_username' => 'soulsuitewellness',
        'calendly_individual_event' => 'individual-strategy-call',
        'calendly_business_event' => 'business-strategy-call',
        'calendly_general_event' => 'general-inquiry',
        'calendly_primary_color' => '53ded4',
        
        // Global Settings
        'enable_animations' => true,
        'enable_smooth_scroll' => true,
        'google_analytics_id' => '',
        
        // Footer Settings
        'footer_copyright' => '&copy; ' . date('Y') . ' Soul Suite Wellness. Made with <span class="heart">♥</span> by <a href="https://vaoneagency.com" target="_blank" rel="noopener">VAOne Agency</a>',
        'footer_tagline' => 'Empowering Your Journey to Wellness',
    );
}

/**
 * Get theme option with fallback to default
 * 
 * NOTE: This function adds 'soul_suite_' prefix automatically
 * So call it with: soul_suite_get_option('contact_email')
 * NOT: soul_suite_get_option('soul_suite_contact_email')
 */
function soul_suite_get_option($key, $default = '') {
    $defaults = soul_suite_get_defaults();
    
    // Try to get from WordPress options (adds soul_suite_ prefix)
    $value = get_option('soul_suite_' . $key, '');
    
    // Fallback to defaults array
    if (empty($value) && isset($defaults[$key])) {
        return $defaults[$key];
    }
    
    return !empty($value) ? $value : $default;
}

/**
 * Update theme option
 */
function soul_suite_update_option($key, $value) {
    return update_option('soul_suite_' . $key, $value);
}

/**
 * Get Square booking URL
 * 
 * @param string|int $type Either 'individual', 'business', or service number 1-6
 * @return string Square booking URL
 */
function soul_suite_get_square_url($type = 'individual') {
    $merchant_id = get_theme_mod('soul_suite_square_merchant_id', '0ccyiu9cc0ezt1');
    $location_id = get_theme_mod('soul_suite_square_location_id', '09TR3SSB0EZ79');
    
    // Handle legacy type strings
    if ($type === 'business') {
        $service_id = get_theme_mod('soul_suite_service_2_service_id', 'HWYWQ6UMI4Q34K3TM27C7EU4');
    } elseif ($type === 'individual') {
        $service_id = get_theme_mod('soul_suite_service_1_service_id', 'GJZY3CEHIIJR6XSGCXQR6D6P');
    } elseif (is_numeric($type) && $type >= 1 && $type <= 6) {
        // Get service by number (1-6)
        $service_id = get_theme_mod("soul_suite_service_{$type}_service_id", '');
    } else {
        // Default to individual
        $service_id = get_theme_mod('soul_suite_service_1_service_id', 'GJZY3CEHIIJR6XSGCXQR6D6P');
    }
    
    return "https://book.squareup.com/appointments/{$merchant_id}/location/{$location_id}/services/{$service_id}";
}

/**
 * Get Square booking URL for a specific service number
 * 
 * @param int $service_number Service number 1-6
 * @return string Square booking URL
 */
function soul_suite_get_service_square_url($service_number) {
    $merchant_id = get_theme_mod('soul_suite_square_merchant_id', '0ccyiu9cc0ezt1');
    $location_id = get_theme_mod('soul_suite_square_location_id', '09TR3SSB0EZ79');
    $service_id = get_theme_mod("soul_suite_service_{$service_number}_service_id", '');
    
    if (empty($service_id)) {
        return '';
    }
    
    return "https://book.squareup.com/appointments/{$merchant_id}/location/{$location_id}/services/{$service_id}";
}

/**
 * Get Calendly URL
 */
function soul_suite_get_calendly_url($event_type = 'individual') {
    $defaults = soul_suite_get_defaults();
    $username = soul_suite_get_option('calendly_username');
    $primary_color = soul_suite_get_option('calendly_primary_color');
    
    $event_map = array(
        'individual' => soul_suite_get_option('calendly_individual_event'),
        'business' => soul_suite_get_option('calendly_business_event'),
        'general' => soul_suite_get_option('calendly_general_event'),
    );
    
    $event = isset($event_map[$event_type]) ? $event_map[$event_type] : $event_map['individual'];
    
    return "https://calendly.com/{$username}/{$event}?hide_event_type_details=1&hide_gdpr_banner=1&primary_color={$primary_color}";
}

/**
 * Get social media URL
 * 
 * @param string $platform Platform name (facebook, instagram, twitter, linkedin, youtube, tiktok)
 * @return string Social media URL
 */
function soul_suite_get_social_url($platform) {
    // Customizer uses ssw_social_{platform}_url pattern
    return get_theme_mod("ssw_social_{$platform}_url", '');
}

/**
 * Get contact information
 * 
 * @param string $type Type of contact info (email, phone, address)
 * @return string Contact information
 */
function soul_suite_get_contact_info($type = 'email') {
    // Customizer uses soul_suite_contact_{type} pattern
    $value = get_theme_mod("soul_suite_contact_{$type}", '');
    
    // Fallback to defaults if empty
    if (empty($value)) {
        $defaults = soul_suite_get_defaults();
        $key = "contact_{$type}";
        return isset($defaults[$key]) ? $defaults[$key] : '';
    }
    
    return $value;
}

/**
 * Check if social media links are configured
 * 
 * @return bool True if at least one social link is set
 */
function soul_suite_has_social_links() {
    $platforms = array('facebook', 'instagram', 'twitter', 'linkedin', 'youtube', 'tiktok');
    
    foreach ($platforms as $platform) {
        if (!empty(soul_suite_get_social_url($platform))) {
            return true;
        }
    }
    
    return false;
}

/**
 * Theme supports and features
 */
function soul_suite_theme_features() {
    return array(
        'post-thumbnails',
        'title-tag',
        'automatic-feed-links',
        'custom-logo',
        'html5' => array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'),
        'custom-background' => array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ),
        'customize-selective-refresh-widgets',
    );
}

/**
 * Image sizes for the theme
 */
function soul_suite_image_sizes() {
    return array(
        'soul-suite-hero' => array(1920, 800, true),
        'soul-suite-service' => array(600, 400, true),
        'soul-suite-team' => array(400, 400, true),
        'soul-suite-thumbnail' => array(300, 300, true),
        'soul-suite-large' => array(1200, 800, false),
    );
}

/**
 * Navigation menu locations
 */
function soul_suite_nav_menus() {
    return array(
        'primary' => __('Primary Menu', 'soul-suite'),
        'footer' => __('Footer Menu', 'soul-suite'),
    );
}

/**
 * Widget areas configuration
 */
function soul_suite_widget_areas() {
    return array(
        array(
            'name' => __('Sidebar', 'soul-suite'),
            'id' => 'sidebar-1',
            'description' => __('Main sidebar widget area', 'soul-suite'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ),
        array(
            'name' => __('Footer Column 1', 'soul-suite'),
            'id' => 'footer-1',
            'description' => __('First footer column', 'soul-suite'),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="footer-widget-title">',
            'after_title' => '</h4>',
        ),
        array(
            'name' => __('Footer Column 2', 'soul-suite'),
            'id' => 'footer-2',
            'description' => __('Second footer column', 'soul-suite'),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="footer-widget-title">',
            'after_title' => '</h4>',
        ),
        array(
            'name' => __('Footer Column 3', 'soul-suite'),
            'id' => 'footer-3',
            'description' => __('Third footer column', 'soul-suite'),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="footer-widget-title">',
            'after_title' => '</h4>',
        ),
    );
}

/**
 * Enqueue Google Fonts
 */
function soul_suite_google_fonts_url() {
    $fonts = array(
        'Poppins:300,400,500,600,700',
        'Playfair+Display:400,600,700',
        'Dancing+Script:400,600,700'
    );
    
    return add_query_arg(
        array(
            'family' => implode('|', $fonts),
            'display' => 'swap',
        ),
        'https://fonts.googleapis.com/css2'
    );
}