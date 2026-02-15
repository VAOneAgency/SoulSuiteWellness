<?php
/**
 * Soul Suite Customizer - COMPLETE SOURCE OF TRUTH
 * 
 * @package SoulSuite
 */

if (!defined('ABSPATH')) exit;

function soul_suite_customize_register($wp_customize) {
    
    /**
     * =============================
     * HOME PAGE PANEL
     * =============================
     */
    $wp_customize->add_panel('soul_suite_home_page', array(
        'title' => __('Home Page Settings', 'soul-suite'),
        'description' => __('Customize all sections displayed on your home page', 'soul-suite'),
        'priority' => 10,
    ));
    
    /**
     * =============================
     * HERO SECTION
     * =============================
     */
    $wp_customize->add_section('soul_suite_hero_section', array(
        'title' => __('Hero Section', 'soul-suite'),
        'panel' => 'soul_suite_home_page',
        'priority' => 10,
    ));
    
    $wp_customize->add_setting('soul_suite_hero_bg_image', array(
        'default' => 'https://soulsuitewellness.com/wp-content/uploads/2025/07/Home-page.png',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_hero_bg_image', array(
        'label' => __('Background Image', 'soul-suite'),
        'section' => 'soul_suite_hero_section',
    )));
    
    $wp_customize->add_setting('soul_suite_hero_bg_color', array(
        'default' => '#1a4d4d',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_hero_bg_color', array(
        'label' => __('Background Color', 'soul-suite'),
        'section' => 'soul_suite_hero_section',
    )));
    
    $wp_customize->add_setting('soul_suite_hero_logo_align', array(
        'default' => 'center',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_hero_logo_align', array(
        'label' => __('Logo Alignment', 'soul-suite'),
        'section' => 'soul_suite_hero_section',
        'type' => 'select',
        'choices' => array(
            'left' => __('Left', 'soul-suite'),
            'center' => __('Center', 'soul-suite'),
            'right' => __('Right', 'soul-suite'),
        ),
    ));
    
    $wp_customize->add_setting('soul_suite_hero_title', array(
        'default' => 'Wellness Suite Recovery Portal™ (WellSR Portal)',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_hero_title', array(
        'label' => __('Hero Title', 'soul-suite'),
        'section' => 'soul_suite_hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_hero_subtitle', array(
        'default' => 'DECODE. DISRUPT. HEAL. EXIT.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_hero_subtitle', array(
        'label' => __('Hero Subtitle', 'soul-suite'),
        'section' => 'soul_suite_hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_hero_description', array(
        'default' => 'A transformational portal for healthcare and wellness leaders—and their teams—ready to break free from exhaustion and reclaim sustainable power.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('soul_suite_hero_description', array(
        'label' => __('Hero Description', 'soul-suite'),
        'section' => 'soul_suite_hero_section',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_setting('soul_suite_hero_btn_text', array(
        'default' => 'BOOK A CLARITY CALL',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_hero_btn_text', array(
        'label' => __('Button Text', 'soul-suite'),
        'section' => 'soul_suite_hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_hero_btn_url', array(
        'default' => '/intake-form/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('soul_suite_hero_btn_url', array(
        'label' => __('Button URL', 'soul-suite'),
        'section' => 'soul_suite_hero_section',
        'type' => 'url',
    ));
    
    /**
 * =============================
 * HERO SECTION - TYPOGRAPHY & SPACING
 * =============================
 */
$wp_customize->add_section('soul_suite_hero_typography', array(
    'title' => __('Hero Typography & Spacing', 'soul-suite'),
    'panel' => 'soul_suite_home_page',
    'priority' => 10.5,
));

// Logo Size
$wp_customize->add_setting('soul_suite_hero_logo_width', array(
    'default' => '200',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_hero_logo_width', array(
    'label' => __('Logo Width (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 100, 'max' => 500, 'step' => 10),
));

$wp_customize->add_setting('soul_suite_hero_logo_width_mobile', array(
    'default' => '150',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_hero_logo_width_mobile', array(
    'label' => __('Logo Width Mobile (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 80, 'max' => 300, 'step' => 10),
));

// Title Typography
$wp_customize->add_setting('soul_suite_hero_title_size', array(
    'default' => '48',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_hero_title_size', array(
    'label' => __('Title Font Size Desktop (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 24, 'max' => 96, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_hero_title_size_tablet', array(
    'default' => '36',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_hero_title_size_tablet', array(
    'label' => __('Title Font Size Tablet (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 20, 'max' => 72, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_hero_title_size_mobile', array(
    'default' => '28',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_hero_title_size_mobile', array(
    'label' => __('Title Font Size Mobile (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 18, 'max' => 48, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_hero_title_weight', array(
    'default' => '700',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_hero_title_weight', array(
    'label' => __('Title Font Weight', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'select',
    'choices' => array(
        '300' => '300 - Light',
        '400' => '400 - Normal',
        '500' => '500 - Medium',
        '600' => '600 - Semi-Bold',
        '700' => '700 - Bold',
        '800' => '800 - Extra Bold',
    ),
));

$wp_customize->add_setting('soul_suite_hero_title_line_height', array(
    'default' => '1.2',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_hero_title_line_height', array(
    'label' => __('Title Line Height', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 1, 'max' => 2.5, 'step' => 0.1),
));

$wp_customize->add_setting('soul_suite_hero_title_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_hero_title_letter_spacing', array(
    'label' => __('Title Letter Spacing (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => -5, 'max' => 10, 'step' => 0.5),
));

// Subtitle Typography
$wp_customize->add_setting('soul_suite_hero_subtitle_size', array(
    'default' => '24',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_hero_subtitle_size', array(
    'label' => __('Subtitle Font Size Desktop (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 14, 'max' => 48, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_hero_subtitle_size_mobile', array(
    'default' => '18',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_hero_subtitle_size_mobile', array(
    'label' => __('Subtitle Font Size Mobile (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 12, 'max' => 32, 'step' => 1),
));

// Description Typography
$wp_customize->add_setting('soul_suite_hero_desc_size', array(
    'default' => '18',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_hero_desc_size', array(
    'label' => __('Description Font Size Desktop (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 14, 'max' => 28, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_hero_desc_size_mobile', array(
    'default' => '16',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_hero_desc_size_mobile', array(
    'label' => __('Description Font Size Mobile (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 12, 'max' => 22, 'step' => 1),
));

// Spacing Controls
$wp_customize->add_setting('soul_suite_hero_title_margin_bottom', array(
    'default' => '20',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_hero_title_margin_bottom', array(
    'label' => __('Title Bottom Margin (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 0, 'max' => 100, 'step' => 5),
));

$wp_customize->add_setting('soul_suite_hero_subtitle_margin_bottom', array(
    'default' => '15',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_hero_subtitle_margin_bottom', array(
    'label' => __('Subtitle Bottom Margin (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 0, 'max' => 100, 'step' => 5),
));

$wp_customize->add_setting('soul_suite_hero_desc_margin_bottom', array(
    'default' => '30',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_hero_desc_margin_bottom', array(
    'label' => __('Description Bottom Margin (px)', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'number',
    'input_attrs' => array('min' => 0, 'max' => 100, 'step' => 5),
));

$wp_customize->add_setting('soul_suite_hero_content_padding', array(
    'default' => '60px 20px',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_hero_content_padding', array(
    'label' => __('Content Padding', 'soul-suite'),
    'section' => 'soul_suite_hero_typography',
    'type' => 'text',
    'description' => __('CSS padding (e.g., 60px 20px)', 'soul-suite'),
));
    
    /**
     * =============================
     * BURNOUT/INTRO SECTION
     * =============================
     */
    $wp_customize->add_section('soul_suite_burnout_section', array(
        'title' => __('Burnout/Intro Section', 'soul-suite'),
        'panel' => 'soul_suite_home_page',
        'priority' => 11,
    ));
    
    $wp_customize->add_setting('soul_suite_burnout_bg_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_burnout_bg_image', array(
        'label' => __('Background Image', 'soul-suite'),
        'section' => 'soul_suite_burnout_section',
    )));
    
    $wp_customize->add_setting('soul_suite_burnout_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_burnout_bg_color', array(
        'label' => __('Background Color', 'soul-suite'),
        'section' => 'soul_suite_burnout_section',
    )));
    
    $wp_customize->add_setting('soul_suite_burnout_title', array(
        'default' => 'Breaking the Cycle',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_burnout_title', array(
        'label' => __('Section Title', 'soul-suite'),
        'section' => 'soul_suite_burnout_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_burnout_image', array(
        'default' => 'https://soulsuitewellness.com/wp-content/uploads/2025/07/AdobeStock_187293579_Preview.webp',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_burnout_image', array(
        'label' => __('Featured Image', 'soul-suite'),
        'section' => 'soul_suite_burnout_section',
    )));
    
    $wp_customize->add_setting('soul_suite_burnout_highlight', array(
        'default' => 'ARE YOU CAUGHT IN A CYCLE OF BURNOUT?',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_burnout_highlight', array(
        'label' => __('Highlight Title', 'soul-suite'),
        'section' => 'soul_suite_burnout_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_burnout_content', array(
        'default' => "If you're a healthcare executive, wellness leader, provider, or purpose-driven organization constantly pushing through stress, high turnover, and silent suffering—you're not alone.\n\nThe cycle of burnout is an invisible system of over-functioning, people-pleasing, emotional suppression, and energetic depletion.\n\nThis isn't about managing stress. It's about dismantling the system that's keeping your team stuck in survival mode.",
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('soul_suite_burnout_content', array(
        'label' => __('Content', 'soul-suite'),
        'section' => 'soul_suite_burnout_section',
        'type' => 'textarea',
        'description' => __('HTML allowed. Paragraphs will be automatically added.', 'soul-suite'),
    ));
    
/**
 * =============================
 * BURNOUT SECTION - STYLING CONTROLS
 * =============================
 */

// Section Background (needs to be BEFORE other settings)
$wp_customize->add_setting('soul_suite_burnout_bg_color', array(
    'default' => 'linear-gradient(90deg, #40e0d0, #8c756a, #ff5b0c)',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_burnout_bg_color', array(
    'label' => __('Section Background', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'type' => 'text',
    'description' => __('Use gradient or solid color (e.g., linear-gradient(90deg, #40e0d0, #8c756a, #ff5b0c) or #ffffff)', 'soul-suite'),
));

// Section Title Styling
$wp_customize->add_setting('soul_suite_burnout_title_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_burnout_title_color', array(
    'label' => __('Section Title Color', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
)));

$wp_customize->add_setting('soul_suite_burnout_title_font_size', array(
    'default' => '40',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_burnout_title_font_size', array(
    'label' => __('Section Title Font Size (px)', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'type' => 'number',
    'input_attrs' => array('min' => 20, 'max' => 60, 'step' => 1),
));

// Highlight Title Styling
$wp_customize->add_setting('soul_suite_burnout_highlight_color', array(
    'default' => '#555555',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_burnout_highlight_color', array(
    'label' => __('Highlight Title Color', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
)));

$wp_customize->add_setting('soul_suite_burnout_highlight_bg', array(
    'default' => 'linear-gradient(90deg, #40e0d0, #8c756a, #ff5b0c)',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_burnout_highlight_bg', array(
    'label' => __('Highlight Background Color', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'type' => 'text',
    'description' => __('Use transparent, hex, or rgba', 'soul-suite'),
));

$wp_customize->add_setting('soul_suite_burnout_highlight_font_size', array(
    'default' => '24',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_burnout_highlight_font_size', array(
    'label' => __('Highlight Font Size (px)', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'type' => 'number',
    'input_attrs' => array('min' => 18, 'max' => 48, 'step' => 1),
));

// Content Text Styling
$wp_customize->add_setting('soul_suite_burnout_text_color', array(
    'default' => '#555555',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_burnout_text_color', array(
    'label' => __('Content Text Color', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
)));

$wp_customize->add_setting('soul_suite_burnout_text_font_size', array(
    'default' => '16',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_burnout_text_font_size', array(
    'label' => __('Content Font Size (px)', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'type' => 'number',
    'input_attrs' => array('min' => 12, 'max' => 24, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_burnout_text_line_height', array(
    'default' => '1.6',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_burnout_text_line_height', array(
    'label' => __('Content Line Height', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'type' => 'number',
    'input_attrs' => array('min' => 1, 'max' => 3, 'step' => 0.1),
));

// Content Box Background
$wp_customize->add_setting('soul_suite_burnout_content_bg', array(
    'default' => 'rgba(255, 255, 255, 0.95)',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_burnout_content_bg', array(
    'label' => __('Content Box Background', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'type' => 'text',
    'description' => __('Use hex or rgba (e.g., rgba(255,255,255,0.95))', 'soul-suite'),
));

// Image Border Styling
$wp_customize->add_setting('soul_suite_burnout_image_border_color', array(
    'default' => 'rgba(255, 255, 255, 0.2)',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_burnout_image_border_color', array(
    'label' => __('Image Border Color', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'type' => 'text',
    'description' => __('Use hex or rgba', 'soul-suite'),
));

$wp_customize->add_setting('soul_suite_burnout_image_border_width', array(
    'default' => '5',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_burnout_image_border_width', array(
    'label' => __('Image Border Width (px)', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'type' => 'number',
    'input_attrs' => array('min' => 0, 'max' => 20, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_burnout_image_border_radius', array(
    'default' => '20',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_burnout_image_border_radius', array(
    'label' => __('Image Border Radius (px)', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'type' => 'number',
    'input_attrs' => array('min' => 0, 'max' => 50, 'step' => 1),
));

// Button Styling
$wp_customize->add_setting('soul_suite_burnout_btn_use_global', array(
    'default' => true,
    'sanitize_callback' => 'rest_sanitize_boolean',
));
$wp_customize->add_control('soul_suite_burnout_btn_use_global', array(
    'label' => __('Use Global Button Style', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'type' => 'checkbox',
    'description' => __('Uncheck to customize button colors', 'soul-suite'),
));

$wp_customize->add_setting('soul_suite_burnout_btn_bg_color', array(
    'default' => '#40e0d0',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_burnout_btn_bg_color', array(
    'label' => __('Button Background Color', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'description' => __('Only used if "Use Global Button Style" is unchecked', 'soul-suite'),
)));

$wp_customize->add_setting('soul_suite_burnout_btn_text_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_burnout_btn_text_color', array(
    'label' => __('Button Text Color', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'description' => __('Only used if "Use Global Button Style" is unchecked', 'soul-suite'),
)));

$wp_customize->add_setting('soul_suite_burnout_btn_hover_bg', array(
    'default' => '#ff5b0c',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_burnout_btn_hover_bg', array(
    'label' => __('Button Hover Background', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'description' => __('Only used if "Use Global Button Style" is unchecked', 'soul-suite'),
)));

$wp_customize->add_setting('soul_suite_burnout_btn_hover_text', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_burnout_btn_hover_text', array(
    'label' => __('Button Hover Text Color', 'soul-suite'),
    'section' => 'soul_suite_burnout_section',
    'description' => __('Only used if "Use Global Button Style" is unchecked', 'soul-suite'),
)));
    
    /**
     * =============================
     * SERVICES SECTION
     * =============================
     */
    $wp_customize->add_section('soul_suite_services_section', array(
        'title' => __('Services Section', 'soul-suite'),
        'panel' => 'soul_suite_home_page',
        'priority' => 12,
    ));
    
    $wp_customize->add_setting('soul_suite_services_bg_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_services_bg_image', array(
        'label' => __('Background Image', 'soul-suite'),
        'section' => 'soul_suite_services_section',
    )));
    
    $wp_customize->add_setting('soul_suite_services_bg_color', array(
        'default' => '#f9f9f9',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_services_bg_color', array(
        'label' => __('Background Color', 'soul-suite'),
        'section' => 'soul_suite_services_section',
    )));
    
    $wp_customize->add_setting('soul_suite_services_title', array(
        'default' => 'PRODUCTS',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_services_title', array(
        'label' => __('Services Title', 'soul-suite'),
        'section' => 'soul_suite_services_section',
        'type' => 'text',
    ));
    
    /**
 * =============================
 * SERVICES CARD STYLING
 * =============================
 */
$wp_customize->add_section('soul_suite_services_styling', array(
    'title' => __('Services Card Styling', 'soul-suite'),
    'panel' => 'soul_suite_home_page',
    'priority' => 12.5,
    'description' => __('Customize service cards. Leave blank to use theme defaults.', 'soul-suite'),
));

// Card Border Left Color (accent stripe)
$wp_customize->add_setting('soul_suite_service_card_border_left', array(
    'default' => '', // Empty = use --color-teal
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_card_border_left', array(
    'label' => __('Card Left Border Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'description' => __('Leave blank to use primary teal color', 'soul-suite'),
)));

// Use Global Button Style or Custom
$wp_customize->add_setting('soul_suite_service_btn_use_global', array(
    'default' => true,
    'sanitize_callback' => 'rest_sanitize_boolean',
));
$wp_customize->add_control('soul_suite_service_btn_use_global', array(
    'label' => __('Use Global Button Style', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'checkbox',
    'description' => __('Check to use theme button colors, uncheck to customize', 'soul-suite'),
));

// Custom Button Background (only if not using global)
$wp_customize->add_setting('soul_suite_service_btn_custom_bg', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_btn_custom_bg', array(
    'label' => __('Custom Button Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'description' => __('Only used if "Use Global Button Style" is unchecked', 'soul-suite'),
)));

// Tag Color Override
$wp_customize->add_setting('soul_suite_service_tag_custom_bg', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_tag_custom_bg', array(
    'label' => __('Tag Background Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'description' => __('Leave blank to use primary teal', 'soul-suite'),
)));

// Price Color Override
$wp_customize->add_setting('soul_suite_service_price_custom_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_price_custom_color', array(
    'label' => __('Price Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'description' => __('Leave blank to use orange accent', 'soul-suite'),
)));

// ========== CARD STYLING ==========
$wp_customize->add_setting('soul_suite_service_card_bg', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_card_bg', array(
    'label' => __('Card Background Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
)));

$wp_customize->add_setting('soul_suite_service_card_border_color', array(
    'default' => '#e0e0e0',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_card_border_color', array(
    'label' => __('Card Border Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
)));

$wp_customize->add_setting('soul_suite_service_card_border_width', array(
    'default' => '1',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_service_card_border_width', array(
    'label' => __('Card Border Width (px)', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'number',
    'input_attrs' => array('min' => 0, 'max' => 10, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_service_card_border_radius', array(
    'default' => '8',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_service_card_border_radius', array(
    'label' => __('Card Border Radius (px)', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'number',
    'input_attrs' => array('min' => 0, 'max' => 50, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_service_card_shadow', array(
    'default' => '0 2px 8px rgba(0,0,0,0.1)',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_service_card_shadow', array(
    'label' => __('Card Box Shadow', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'text',
    'description' => __('CSS box-shadow value (e.g., 0 2px 8px rgba(0,0,0,0.1))', 'soul-suite'),
));

// ========== TITLE STYLING ==========
$wp_customize->add_setting('soul_suite_service_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_title_color', array(
    'label' => __('Title Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
)));

$wp_customize->add_setting('soul_suite_service_title_font_size', array(
    'default' => '24',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_service_title_font_size', array(
    'label' => __('Title Font Size (px)', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'number',
    'input_attrs' => array('min' => 14, 'max' => 48, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_service_title_font_weight', array(
    'default' => '600',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_service_title_font_weight', array(
    'label' => __('Title Font Weight', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'select',
    'choices' => array(
        '300' => __('Light (300)', 'soul-suite'),
        '400' => __('Normal (400)', 'soul-suite'),
        '500' => __('Medium (500)', 'soul-suite'),
        '600' => __('Semi-Bold (600)', 'soul-suite'),
        '700' => __('Bold (700)', 'soul-suite'),
    ),
));

// ========== TAG STYLING ==========
$wp_customize->add_setting('soul_suite_service_tag_bg_color', array(
    'default' => '#40e0d0',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_tag_bg_color', array(
    'label' => __('Tag Background Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
)));

$wp_customize->add_setting('soul_suite_service_tag_text_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_tag_text_color', array(
    'label' => __('Tag Text Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
)));

$wp_customize->add_setting('soul_suite_service_tag_font_size', array(
    'default' => '12',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_service_tag_font_size', array(
    'label' => __('Tag Font Size (px)', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'number',
    'input_attrs' => array('min' => 10, 'max' => 20, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_service_tag_border_radius', array(
    'default' => '4',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_service_tag_border_radius', array(
    'label' => __('Tag Border Radius (px)', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'number',
    'input_attrs' => array('min' => 0, 'max' => 20, 'step' => 1),
));

// ========== CONTENT/DESCRIPTION STYLING ==========
$wp_customize->add_setting('soul_suite_service_content_color', array(
    'default' => '#666666',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_content_color', array(
    'label' => __('Description Text Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
)));

$wp_customize->add_setting('soul_suite_service_content_font_size', array(
    'default' => '15',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_service_content_font_size', array(
    'label' => __('Description Font Size (px)', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'number',
    'input_attrs' => array('min' => 12, 'max' => 20, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_service_content_line_height', array(
    'default' => '1.6',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_service_content_line_height', array(
    'label' => __('Description Line Height', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'number',
    'input_attrs' => array('min' => 1, 'max' => 3, 'step' => 0.1),
));

// ========== PRICE STYLING ==========
$wp_customize->add_setting('soul_suite_service_price_color', array(
    'default' => '#ff5b0c',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_price_color', array(
    'label' => __('Price Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
)));

$wp_customize->add_setting('soul_suite_service_price_font_size', array(
    'default' => '28',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_service_price_font_size', array(
    'label' => __('Price Font Size (px)', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'number',
    'input_attrs' => array('min' => 16, 'max' => 48, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_service_price_font_weight', array(
    'default' => '700',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_service_price_font_weight', array(
    'label' => __('Price Font Weight', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'select',
    'choices' => array(
        '400' => __('Normal (400)', 'soul-suite'),
        '500' => __('Medium (500)', 'soul-suite'),
        '600' => __('Semi-Bold (600)', 'soul-suite'),
        '700' => __('Bold (700)', 'soul-suite'),
        '800' => __('Extra Bold (800)', 'soul-suite'),
    ),
));

// ========== BUTTON STYLING ==========
$wp_customize->add_setting('soul_suite_service_btn_bg_color', array(
    'default' => '#40e0d0',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_btn_bg_color', array(
    'label' => __('Button Background Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
)));

$wp_customize->add_setting('soul_suite_service_btn_text_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_btn_text_color', array(
    'label' => __('Button Text Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
)));

$wp_customize->add_setting('soul_suite_service_btn_hover_bg', array(
    'default' => '#ff5b0c',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_btn_hover_bg', array(
    'label' => __('Button Hover Background', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
)));

$wp_customize->add_setting('soul_suite_service_btn_hover_text', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_service_btn_hover_text', array(
    'label' => __('Button Hover Text Color', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
)));

$wp_customize->add_setting('soul_suite_service_btn_font_size', array(
    'default' => '16',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_service_btn_font_size', array(
    'label' => __('Button Font Size (px)', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'number',
    'input_attrs' => array('min' => 12, 'max' => 24, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_service_btn_font_weight', array(
    'default' => '600',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_service_btn_font_weight', array(
    'label' => __('Button Font Weight', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'select',
    'choices' => array(
        '400' => __('Normal (400)', 'soul-suite'),
        '500' => __('Medium (500)', 'soul-suite'),
        '600' => __('Semi-Bold (600)', 'soul-suite'),
        '700' => __('Bold (700)', 'soul-suite'),
    ),
));

$wp_customize->add_setting('soul_suite_service_btn_border_radius', array(
    'default' => '6',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_service_btn_border_radius', array(
    'label' => __('Button Border Radius (px)', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'number',
    'input_attrs' => array('min' => 0, 'max' => 50, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_service_btn_padding', array(
    'default' => '12px 30px',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_service_btn_padding', array(
    'label' => __('Button Padding', 'soul-suite'),
    'section' => 'soul_suite_services_styling',
    'type' => 'text',
    'description' => __('CSS padding (e.g., 12px 30px)', 'soul-suite'),
));
    
    /**
 * =============================
 * INDIVIDUAL SERVICE CARDS (6 TOTAL)
 * =============================
 */
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

for ($i = 1; $i <= 6; $i++) {
    $defaults = $services_data[$i];
    
    // Enable/Disable Service
    $wp_customize->add_setting("soul_suite_service_{$i}_enabled", array(
        'default' => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control("soul_suite_service_{$i}_enabled", array(
        'label' => sprintf(__('Enable Service %d', 'soul-suite'), $i),
        'section' => 'soul_suite_services_section',
        'type' => 'checkbox',
    ));
    
    // Service Title
    $wp_customize->add_setting("soul_suite_service_{$i}_title", array(
        'default' => $defaults['title'],
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control("soul_suite_service_{$i}_title", array(
        'label' => sprintf(__('Service %d Title', 'soul-suite'), $i),
        'section' => 'soul_suite_services_section',
        'type' => 'text',
    ));
    
    // Service Tag
    $wp_customize->add_setting("soul_suite_service_{$i}_tag", array(
        'default' => $defaults['tag'],
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control("soul_suite_service_{$i}_tag", array(
        'label' => sprintf(__('Service %d Tag (optional)', 'soul-suite'), $i),
        'section' => 'soul_suite_services_section',
        'type' => 'text',
    ));
    
    // Service Image
    $wp_customize->add_setting("soul_suite_service_{$i}_image", array(
        'default' => $defaults['image'],
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "soul_suite_service_{$i}_image", array(
        'label' => sprintf(__('Service %d Image', 'soul-suite'), $i),
        'section' => 'soul_suite_services_section',
    )));
    
    // Service Content
    $wp_customize->add_setting("soul_suite_service_{$i}_content", array(
        'default' => $defaults['content'],
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control("soul_suite_service_{$i}_content", array(
        'label' => sprintf(__('Service %d Description', 'soul-suite'), $i),
        'section' => 'soul_suite_services_section',
        'type' => 'textarea',
    ));
    
    // Service Price
    $wp_customize->add_setting("soul_suite_service_{$i}_price", array(
        'default' => $defaults['price'],
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control("soul_suite_service_{$i}_price", array(
        'label' => sprintf(__('Service %d Price', 'soul-suite'), $i),
        'section' => 'soul_suite_services_section',
        'type' => 'text',
    ));
    
    // Service Duration
    $wp_customize->add_setting("soul_suite_service_{$i}_duration", array(
        'default' => $defaults['duration'],
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control("soul_suite_service_{$i}_duration", array(
        'label' => sprintf(__('Service %d Duration', 'soul-suite'), $i),
        'section' => 'soul_suite_services_section',
        'type' => 'text',
    ));
    
    // Square Service ID
    $wp_customize->add_setting("soul_suite_service_{$i}_service_id", array(
        'default' => $defaults['service_id'],
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control("soul_suite_service_{$i}_service_id", array(
        'label' => sprintf(__('Service %d Square Service ID', 'soul-suite'), $i),
        'section' => 'soul_suite_services_section',
        'type' => 'text',
    ));
    
    // Is Free Service
    $wp_customize->add_setting("soul_suite_service_{$i}_is_free", array(
        'default' => $defaults['is_free'],
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control("soul_suite_service_{$i}_is_free", array(
        'label' => sprintf(__('Service %d is Free', 'soul-suite'), $i),
        'section' => 'soul_suite_services_section',
        'type' => 'checkbox',
    ));
}
    
    /**
     * =============================
     * MATRIX/SYSTEM RESET SECTION
     * =============================
     */
    $wp_customize->add_section('soul_suite_matrix_section', array(
        'title' => __('System Reset/Matrix Section', 'soul-suite'),
        'panel' => 'soul_suite_home_page',
        'priority' => 13,
    ));
    
    $wp_customize->add_setting('soul_suite_matrix_bg_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_matrix_bg_image', array(
        'label' => __('Background Image', 'soul-suite'),
        'section' => 'soul_suite_matrix_section',
    )));
    
    $wp_customize->add_setting('soul_suite_matrix_bg_color', array(
        'default' => '#1a4d4d',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_matrix_bg_color', array(
        'label' => __('Background Color', 'soul-suite'),
        'section' => 'soul_suite_matrix_section',
    )));
    
    $wp_customize->add_setting('soul_suite_matrix_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_matrix_text_color', array(
        'label' => __('Text Color', 'soul-suite'),
        'section' => 'soul_suite_matrix_section',
    )));
    
    $wp_customize->add_setting('soul_suite_matrix_text_align', array(
        'default' => 'center',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_matrix_text_align', array(
        'label' => __('Text Alignment', 'soul-suite'),
        'section' => 'soul_suite_matrix_section',
        'type' => 'select',
        'choices' => array(
            'left' => __('Left', 'soul-suite'),
            'center' => __('Center', 'soul-suite'),
            'right' => __('Right', 'soul-suite'),
        ),
    ));
    
    $wp_customize->add_setting('soul_suite_matrix_point_bg', array(
        'default' => 'rgba(255, 255, 255, 0.03)',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_matrix_point_bg', array(
        'label' => __('Point Background Color', 'soul-suite'),
        'section' => 'soul_suite_matrix_section',
        'type' => 'text',
        'description' => __('Use rgba format, e.g., rgba(255, 255, 255, 0.03)', 'soul-suite'),
    ));
    
    $wp_customize->add_setting('soul_suite_matrix_point_border', array(
        'default' => '#ff5b0c',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_matrix_point_border', array(
        'label' => __('Point Border Color', 'soul-suite'),
        'section' => 'soul_suite_matrix_section',
    )));
    
    $wp_customize->add_setting('soul_suite_matrix_point_bullet', array(
        'default' => '#40e0d0',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_matrix_point_bullet', array(
        'label' => __('Bullet Point Color', 'soul-suite'),
        'section' => 'soul_suite_matrix_section',
    )));
    
    $wp_customize->add_setting('soul_suite_matrix_title', array(
        'default' => 'BURNOUT ISN\'T JUST STRESS. IT\'S A WHOLE-SYSTEM BREAKDOWN',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_matrix_title', array(
        'label' => __('Matrix Title', 'soul-suite'),
        'section' => 'soul_suite_matrix_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_matrix_intro', array(
        'default' => 'Burnout isn\'t a personal failure—it\'s a predictable outcome of environments that ignore human sustainability.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('soul_suite_matrix_intro', array(
        'label' => __('Intro Text', 'soul-suite'),
        'section' => 'soul_suite_matrix_section',
        'type' => 'textarea',
    ));
    
    for ($i = 1; $i <= 4; $i++) {
        $defaults = array(
            1 => '<strong>Toxic Productivity & "Hero Culture"</strong> that reward overextension and silence real needs',
            2 => '<strong>Emotional Exhaustion, Empathic Overload & Values Misalignment</strong> that erode purpose and connection',
            3 => '<strong>Outdated Organizational Models</strong> that treat people as output instead of whole humans',
            4 => '<strong>Chronic Stress Patterns</strong> imprinted in the body, nervous system, and workplace culture—individually and collectively',
        );
        
        $wp_customize->add_setting("soul_suite_matrix_point_{$i}", array(
            'default' => $defaults[$i],
            'sanitize_callback' => 'wp_kses_post',
        ));
        $wp_customize->add_control("soul_suite_matrix_point_{$i}", array(
            'label' => sprintf(__('Point %d', 'soul-suite'), $i),
            'section' => 'soul_suite_matrix_section',
            'type' => 'textarea',
        ));
    }
    
    $wp_customize->add_setting('soul_suite_matrix_note', array(
        'default' => 'This isn\'t something a day off or a meditation app can fix.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_matrix_note', array(
        'label' => __('Note Text', 'soul-suite'),
        'section' => 'soul_suite_matrix_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_matrix_conclusion', array(
        'default' => 'Your people need a deep recalibration—a strategic, emotional, and physiological reset that restores well-being at the root.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('soul_suite_matrix_conclusion', array(
        'label' => __('Conclusion Text', 'soul-suite'),
        'section' => 'soul_suite_matrix_section',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_setting('soul_suite_matrix_cta_text', array(
        'default' => 'Let\'s Have a Conversation',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_matrix_cta_text', array(
        'label' => __('CTA Button Text', 'soul-suite'),
        'section' => 'soul_suite_matrix_section',
        'type' => 'text',
    ));
    
    /**
     * =============================
     * ABOUT OWNER SECTION
     * =============================
     */
    $wp_customize->add_section('soul_suite_about_section', array(
        'title' => __('About Owner Section', 'soul-suite'),
        'panel' => 'soul_suite_home_page',
        'priority' => 14,
    ));
    
    $wp_customize->add_setting('soul_suite_about_bg_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_about_bg_image', array(
        'label' => __('Background Image', 'soul-suite'),
        'section' => 'soul_suite_about_section',
    )));
    
    $wp_customize->add_setting('soul_suite_about_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_about_bg_color', array(
        'label' => __('Background Color (Section)', 'soul-suite'),
        'section' => 'soul_suite_about_section',
    )));
    
    $wp_customize->add_setting('soul_suite_about_content_bg', array(
        'default' => 'transparent',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_about_content_bg', array(
        'label' => __('Background Color (Content)', 'soul-suite'),
        'section' => 'soul_suite_about_section',
        'type' => 'text',
        'description' => __('Use hex or rgba. Default: transparent', 'soul-suite'),
    ));
    
    $wp_customize->add_setting('soul_suite_about_image_border', array(
        'default' => '#40e0d0',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_about_image_border', array(
        'label' => __('Owner Photo Border Color', 'soul-suite'),
        'section' => 'soul_suite_about_section',
    )));
    
    $wp_customize->add_setting('soul_suite_about_text_color', array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_about_text_color', array(
        'label' => __('Text Color', 'soul-suite'),
        'section' => 'soul_suite_about_section',
    )));
    
    $wp_customize->add_setting('soul_suite_about_title', array(
        'default' => 'About the Owner',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_about_title', array(
        'label' => __('Section Title', 'soul-suite'),
        'section' => 'soul_suite_about_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_about_owner_image', array(
        'default' => 'https://soulsuitewellness.com/wp-content/uploads/2025/07/IMG-BTM.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_about_owner_image', array(
        'label' => __('Owner Photo', 'soul-suite'),
        'section' => 'soul_suite_about_section',
    )));
    
    $wp_customize->add_setting('soul_suite_about_owner_name', array(
        'default' => 'Soulara Sevier',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_about_owner_name', array(
        'label' => __('Owner Name', 'soul-suite'),
        'section' => 'soul_suite_about_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_about_owner_title', array(
        'default' => 'Founder & CEO | Soul Suite Wellness',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_about_owner_title', array(
        'label' => __('Owner Title/Credentials', 'soul-suite'),
        'section' => 'soul_suite_about_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_about_owner_bio', array(
        'default' => "Welcome to Soul Suite Wellness, where transformation meets intention. I'm Soulara Sevier, and I'm passionate about guiding individuals on their journey to holistic wellness and personal empowerment.\n\nWith years of experience in wellness coaching and a deep commitment to helping others discover their authentic selves, I created Soul Suite Wellness as a sanctuary for those seeking meaningful change in their lives.\n\nMy approach combines traditional wellness practices with modern techniques, creating a unique experience tailored to each individual's needs. I believe that true wellness encompasses mind, body, and spirit, and I'm here to support you every step of the way on your transformative journey.\n\nAt Soul Suite Wellness, we don't just focus on temporary fixes – we work together to create lasting, sustainable changes that align with your deepest values and aspirations.",
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('soul_suite_about_owner_bio', array(
        'label' => __('Owner Bio', 'soul-suite'),
        'section' => 'soul_suite_about_section',
        'type' => 'textarea',
        'description' => __('HTML allowed. Paragraphs will be automatically added.', 'soul-suite'),
    ));
    // Name Typography
$wp_customize->add_setting('soul_suite_about_name_size', array(
    'default' => '32',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_about_name_size', array(
    'label' => __('Owner Name Font Size (px)', 'soul-suite'),
    'section' => 'soul_suite_about_section',
    'type' => 'number',
    'input_attrs' => array('min' => 20, 'max' => 60, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_about_name_weight', array(
    'default' => '700',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_about_name_weight', array(
    'label' => __('Owner Name Font Weight', 'soul-suite'),
    'section' => 'soul_suite_about_section',
    'type' => 'select',
    'choices' => array(
        '400' => 'Normal (400)',
        '500' => 'Medium (500)',
        '600' => 'Semi-Bold (600)',
        '700' => 'Bold (700)',
        '800' => 'Extra Bold (800)',
    ),
));

$wp_customize->add_setting('soul_suite_about_name_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_about_name_color', array(
    'label' => __('Owner Name Color', 'soul-suite'),
    'section' => 'soul_suite_about_section',
)));

// Title/Credentials Typography
$wp_customize->add_setting('soul_suite_about_title_size', array(
    'default' => '18',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_about_title_size', array(
    'label' => __('Credentials Font Size (px)', 'soul-suite'),
    'section' => 'soul_suite_about_section',
    'type' => 'number',
    'input_attrs' => array('min' => 14, 'max' => 32, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_about_title_color', array(
    'default' => '#666666',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_about_title_color', array(
    'label' => __('Credentials Color', 'soul-suite'),
    'section' => 'soul_suite_about_section',
)));

// Bio Typography
$wp_customize->add_setting('soul_suite_about_bio_size', array(
    'default' => '16',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_about_bio_size', array(
    'label' => __('Bio Font Size (px)', 'soul-suite'),
    'section' => 'soul_suite_about_section',
    'type' => 'number',
    'input_attrs' => array('min' => 14, 'max' => 24, 'step' => 1),
));

$wp_customize->add_setting('soul_suite_about_bio_line_height', array(
    'default' => '1.8',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_about_bio_line_height', array(
    'label' => __('Bio Line Height', 'soul-suite'),
    'section' => 'soul_suite_about_section',
    'type' => 'number',
    'input_attrs' => array('min' => 1, 'max' => 3, 'step' => 0.1),
));

$wp_customize->add_setting('soul_suite_about_bio_color', array(
    'default' => '#666666',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_about_bio_color', array(
    'label' => __('Bio Text Color', 'soul-suite'),
    'section' => 'soul_suite_about_section',
)));

// Button Control
$wp_customize->add_setting('soul_suite_about_btn_text', array(
    'default' => 'Learn More About Our Services',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_about_btn_text', array(
    'label' => __('Button Text', 'soul-suite'),
    'section' => 'soul_suite_about_section',
    'type' => 'text',
));

$wp_customize->add_setting('soul_suite_about_btn_url', array(
    'default' => '#services',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control('soul_suite_about_btn_url', array(
    'label' => __('Button URL', 'soul-suite'),
    'section' => 'soul_suite_about_section',
    'type' => 'url',
));

$wp_customize->add_setting('soul_suite_about_btn_bg', array(
    'default' => '#40e0d0',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_about_btn_bg', array(
    'label' => __('Button Background Color', 'soul-suite'),
    'section' => 'soul_suite_about_section',
)));

$wp_customize->add_setting('soul_suite_about_btn_text_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_about_btn_text_color', array(
    'label' => __('Button Text Color', 'soul-suite'),
    'section' => 'soul_suite_about_section',
)));

$wp_customize->add_setting('soul_suite_about_btn_hover_bg', array(
    'default' => '#ff5b0c',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_about_btn_hover_bg', array(
    'label' => __('Button Hover Background', 'soul-suite'),
    'section' => 'soul_suite_about_section',
)));
    
    /**
     * =============================
     * CONTACT SECTION
     * =============================
     */
    $wp_customize->add_section('soul_suite_contact_section', array(
        'title' => __('Contact Section', 'soul-suite'),
        'panel' => 'soul_suite_home_page',
        'priority' => 15,
    ));
    
    $wp_customize->add_setting('soul_suite_contact_bg_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_contact_bg_image', array(
        'label' => __('Background Image', 'soul-suite'),
        'section' => 'soul_suite_contact_section',
    )));
    
    $wp_customize->add_setting('soul_suite_contact_bg_color', array(
        'default' => '#f9f9f9',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_contact_bg_color', array(
        'label' => __('Background Color', 'soul-suite'),
        'section' => 'soul_suite_contact_section',
    )));
    
    $wp_customize->add_setting('soul_suite_contact_title', array(
        'default' => 'Get in Touch',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_contact_title', array(
        'label' => __('Contact Title', 'soul-suite'),
        'section' => 'soul_suite_contact_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_contact_subtitle', array(
        'default' => 'We are here to support your wellness journey. Reach out to explore how Soul Suite Wellness can serve you or your organization with intention and care.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('soul_suite_contact_subtitle', array(
        'label' => __('Contact Subtitle', 'soul-suite'),
        'section' => 'soul_suite_contact_section',
        'type' => 'textarea',
    ));
    
    /**
     * =============================
     * CONTACT INFORMATION
     * =============================
     */
    $wp_customize->add_section('soul_suite_contact', array(
        'title' => __('Contact Information', 'soul-suite'),
        'priority' => 35,
    ));
    
    $wp_customize->add_setting('soul_suite_contact_email', array(
        'default' => 'bewell@soulsuitewellness.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('soul_suite_contact_email', array(
        'label' => __('Email Address', 'soul-suite'),
        'section' => 'soul_suite_contact',
        'type' => 'email',
    ));
    
    $wp_customize->add_setting('soul_suite_contact_phone', array(
        'default' => '(678) 744-3723',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_contact_phone', array(
        'label' => __('Phone Number', 'soul-suite'),
        'section' => 'soul_suite_contact',
        'type' => 'tel',
    ));
    
    $wp_customize->add_setting('soul_suite_contact_address', array(
        'default' => 'Atlanta, Georgia, USA',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('soul_suite_contact_address', array(
        'label' => __('Address', 'soul-suite'),
        'section' => 'soul_suite_contact',
        'type' => 'textarea',
    ));
    
    /**
     * =============================
     * SOCIAL MEDIA LINKS
     * =============================
     */
    $wp_customize->add_section('soul_suite_social_links', array(
        'title' => __('Social Media Links', 'soul-suite'),
        'priority' => 40,
    ));
    
    $socials = array(
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'twitter' => 'Twitter',
        'linkedin' => 'LinkedIn',
        'tiktok' => 'TikTok',
        'youtube' => 'YouTube',
    );
    
    foreach ($socials as $key => $label) {
        $wp_customize->add_setting("ssw_social_{$key}_url", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("ssw_social_{$key}_url", array(
            'label' => sprintf(__('%s URL', 'soul-suite'), $label),
            'section' => 'soul_suite_social_links',
            'type' => 'url',
        ));
    }
    
    /**
     * =============================
     * SQUARE INTEGRATION
     * =============================
     */
    $wp_customize->add_section('soul_suite_square', array(
        'title' => __('Square Integration', 'soul-suite'),
        'priority' => 45,
    ));
    
    $wp_customize->add_setting('soul_suite_square_merchant_id', array(
        'default' => '0ccyiu9cc0ezt1',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_square_merchant_id', array(
        'label' => __('Square Merchant ID', 'soul-suite'),
        'section' => 'soul_suite_square',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_square_location_id', array(
        'default' => '09TR3SSB0EZ79',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_square_location_id', array(
        'label' => __('Square Location ID', 'soul-suite'),
        'section' => 'soul_suite_square',
        'type' => 'text',
    ));
    
    /**
     * =============================
     * REFUND & RETURNS POLICY
     * =============================
     */
    $wp_customize->add_section('soul_suite_refund_policy', array(
        'title' => __('Refund & Returns Policy', 'soul-suite'),
        'priority' => 50,
    ));
    
    $wp_customize->add_setting('soul_suite_refund_title', array(
        'default' => 'Refund and Returns Policy',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_refund_title', array(
        'label' => __('Page Title', 'soul-suite'),
        'section' => 'soul_suite_refund_policy',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('soul_suite_refund_content', array(
        'default' => 'Please contact us for refund and return information.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('soul_suite_refund_content', array(
        'label' => __('Policy Content', 'soul-suite'),
        'section' => 'soul_suite_refund_policy',
        'type' => 'textarea',
        'description' => __('You can use HTML for formatting.', 'soul-suite'),
    ));
    
    /**
 * =============================
 * THEME COLORS (CSS Variables)
 * =============================
 */
$wp_customize->add_section('soul_suite_theme_colors', array(
    'title' => __('Theme Color System', 'soul-suite'),
    'priority' => 5,
    'description' => __('Global colors used throughout your entire site. Changes here affect buttons, gradients, and accents everywhere.', 'soul-suite'),
));

// PRIMARY BRAND COLORS
$wp_customize->add_setting('soul_suite_color_teal', array(
    'default' => '#40e0d0',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_color_teal', array(
    'label' => __('Teal (Primary)', 'soul-suite'),
    'section' => 'soul_suite_theme_colors',
)));

$wp_customize->add_setting('soul_suite_color_teal_hover', array(
    'default' => '#39c9b9',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_color_teal_hover', array(
    'label' => __('Teal Hover', 'soul-suite'),
    'section' => 'soul_suite_theme_colors',
)));

$wp_customize->add_setting('soul_suite_color_brown', array(
    'default' => '#8c756a',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_color_brown', array(
    'label' => __('Brown (Secondary)', 'soul-suite'),
    'section' => 'soul_suite_theme_colors',
)));

$wp_customize->add_setting('soul_suite_color_brown_hover', array(
    'default' => '#7a6759',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_color_brown_hover', array(
    'label' => __('Brown Hover', 'soul-suite'),
    'section' => 'soul_suite_theme_colors',
)));

$wp_customize->add_setting('soul_suite_color_orange', array(
    'default' => '#ff5b0c',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_color_orange', array(
    'label' => __('Orange (Accent)', 'soul-suite'),
    'section' => 'soul_suite_theme_colors',
)));

$wp_customize->add_setting('soul_suite_color_orange_hover', array(
    'default' => '#e5520b',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_color_orange_hover', array(
    'label' => __('Orange Hover', 'soul-suite'),
    'section' => 'soul_suite_theme_colors',
)));

// SUPPORTING COLORS
$wp_customize->add_setting('soul_suite_color_dark_teal', array(
    'default' => '#227767',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_color_dark_teal', array(
    'label' => __('Dark Teal', 'soul-suite'),
    'section' => 'soul_suite_theme_colors',
)));

$wp_customize->add_setting('soul_suite_color_text', array(
    'default' => '#2c3e50',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_color_text', array(
    'label' => __('Text Color (Dark)', 'soul-suite'),
    'section' => 'soul_suite_theme_colors',
)));

$wp_customize->add_setting('soul_suite_color_text_light', array(
    'default' => '#555555',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_color_text_light', array(
    'label' => __('Text Color (Light)', 'soul-suite'),
    'section' => 'soul_suite_theme_colors',
)));

$wp_customize->add_setting('soul_suite_color_off_white', array(
    'default' => '#fdf8f4',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_color_off_white', array(
    'label' => __('Off-White Background', 'soul-suite'),
    'section' => 'soul_suite_theme_colors',
)));

// TYPOGRAPHY SETTINGS
$wp_customize->add_setting('soul_suite_font_size_base', array(
    'default' => '15',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_font_size_base', array(
    'label' => __('Base Font Size (pt)', 'soul-suite'),
    'section' => 'soul_suite_theme_colors',
    'type' => 'number',
    'input_attrs' => array('min' => 12, 'max' => 20, 'step' => 1),
));

/**
 * =============================
 * CONTACT SECTION - ENHANCED STYLING
 * =============================
 */
$wp_customize->add_section('soul_suite_contact_styling', array(
    'title' => __('Contact Section Styling', 'soul-suite'),
    'panel' => 'soul_suite_home_page',
    'priority' => 15.5,
));

// Title Colors
$wp_customize->add_setting('soul_suite_contact_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_contact_title_color', array(
    'label' => __('Title Color', 'soul-suite'),
    'section' => 'soul_suite_contact_styling',
)));

$wp_customize->add_setting('soul_suite_contact_subtitle_color', array(
    'default' => '#666666',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_contact_subtitle_color', array(
    'label' => __('Subtitle Color', 'soul-suite'),
    'section' => 'soul_suite_contact_styling',
)));

// Info Box Styling
$wp_customize->add_setting('soul_suite_contact_box_style', array(
    'default' => 'rounded',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_contact_box_style', array(
    'label' => __('Info Box Style', 'soul-suite'),
    'section' => 'soul_suite_contact_styling',
    'type' => 'select',
    'choices' => array(
        'rounded' => __('Rounded Square', 'soul-suite'),
        'circle' => __('Circle', 'soul-suite'),
        'square' => __('Square', 'soul-suite'),
        'transparent' => __('Transparent', 'soul-suite'),
    ),
));

$wp_customize->add_setting('soul_suite_contact_box_bg', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_contact_box_bg', array(
    'label' => __('Info Box Background', 'soul-suite'),
    'section' => 'soul_suite_contact_styling',
)));

$wp_customize->add_setting('soul_suite_contact_box_border', array(
    'default' => '#e0e0e0',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_contact_box_border', array(
    'label' => __('Info Box Border Color', 'soul-suite'),
    'section' => 'soul_suite_contact_styling',
)));

// Icon Styling
$wp_customize->add_setting('soul_suite_contact_icon_bg', array(
    'default' => '#40e0d0',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_contact_icon_bg', array(
    'label' => __('Icon Background Color', 'soul-suite'),
    'section' => 'soul_suite_contact_styling',
)));

$wp_customize->add_setting('soul_suite_contact_icon_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_contact_icon_color', array(
    'label' => __('Icon Color', 'soul-suite'),
    'section' => 'soul_suite_contact_styling',
)));

$wp_customize->add_setting('soul_suite_contact_icon_size', array(
    'default' => '24',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_contact_icon_size', array(
    'label' => __('Icon Size (px)', 'soul-suite'),
    'section' => 'soul_suite_contact_styling',
    'type' => 'number',
    'input_attrs' => array('min' => 16, 'max' => 48, 'step' => 1),
));

// Text Colors
$wp_customize->add_setting('soul_suite_contact_heading_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_contact_heading_color', array(
    'label' => __('Info Heading Color (OUR OFFICE, etc.)', 'soul-suite'),
    'section' => 'soul_suite_contact_styling',
)));

$wp_customize->add_setting('soul_suite_contact_text_color', array(
    'default' => '#666666',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_contact_text_color', array(
    'label' => __('Info Text Color', 'soul-suite'),
    'section' => 'soul_suite_contact_styling',
)));

$wp_customize->add_setting('soul_suite_contact_link_color', array(
    'default' => '#40e0d0',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_contact_link_color', array(
    'label' => __('Link Color', 'soul-suite'),
    'section' => 'soul_suite_contact_styling',
)));

/**
 * =============================
 * THANK YOU PAGE
 * =============================
 */
$wp_customize->add_section('soul_suite_thankyou_page', array(
    'title' => __('Thank You Page', 'soul-suite'),
    'priority' => 60,
));

$wp_customize->add_setting('soul_suite_thankyou_bg_image', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_thankyou_bg_image', array(
    'label' => __('Background Image', 'soul-suite'),
    'section' => 'soul_suite_thankyou_page',
)));

$wp_customize->add_setting('soul_suite_thankyou_bg_color', array(
    'default' => '#f9f9f9',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_thankyou_bg_color', array(
    'label' => __('Background Color', 'soul-suite'),
    'section' => 'soul_suite_thankyou_page',
)));

$wp_customize->add_setting('soul_suite_thankyou_title', array(
    'default' => 'Thank You!',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_thankyou_title', array(
    'label' => __('Page Title', 'soul-suite'),
    'section' => 'soul_suite_thankyou_page',
    'type' => 'text',
));

$wp_customize->add_setting('soul_suite_thankyou_message', array(
    'default' => 'Your submission has been received. We\'ll be in touch soon!',
    'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control('soul_suite_thankyou_message', array(
    'label' => __('Thank You Message', 'soul-suite'),
    'section' => 'soul_suite_thankyou_page',
    'type' => 'textarea',
));

$wp_customize->add_setting('soul_suite_thankyou_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_thankyou_title_color', array(
    'label' => __('Title Color', 'soul-suite'),
    'section' => 'soul_suite_thankyou_page',
)));

$wp_customize->add_setting('soul_suite_thankyou_text_color', array(
    'default' => '#666666',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_thankyou_text_color', array(
    'label' => __('Text Color', 'soul-suite'),
    'section' => 'soul_suite_thankyou_page',
)));

/**
 * =============================
 * BLOG PAGE SETTINGS
 * =============================
 */
$wp_customize->add_section('soul_suite_blog_settings', array(
    'title' => __('Blog Page Settings', 'soul-suite'),
    'priority' => 21,
));

$wp_customize->add_setting('soul_suite_blog_layout', array(
    'default' => 'classic',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_blog_layout', array(
    'label' => __('Blog Layout', 'soul-suite'),
    'section' => 'soul_suite_blog_settings',
    'type' => 'select',
    'choices' => array(
        'classic' => __('Classic (Full Width)', 'soul-suite'),
        'grid' => __('Grid (2 Columns)', 'soul-suite'),
        'grid-3' => __('Grid (3 Columns)', 'soul-suite'),
        'cards' => __('Cards with Shadow', 'soul-suite'),
        'masonry' => __('Masonry Grid', 'soul-suite'),
    ),
));

$wp_customize->add_setting('soul_suite_blog_bg_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_blog_bg_color', array(
    'label' => __('Background Color', 'soul-suite'),
    'section' => 'soul_suite_blog_settings',
)));

$wp_customize->add_setting('soul_suite_blog_card_bg', array(
    'default' => '#f9f9f9',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_blog_card_bg', array(
    'label' => __('Post Card Background', 'soul-suite'),
    'section' => 'soul_suite_blog_settings',
)));

$wp_customize->add_setting('soul_suite_blog_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_blog_title_color', array(
    'label' => __('Post Title Color', 'soul-suite'),
    'section' => 'soul_suite_blog_settings',
)));

$wp_customize->add_setting('soul_suite_blog_text_color', array(
    'default' => '#666666',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_blog_text_color', array(
    'label' => __('Post Text Color', 'soul-suite'),
    'section' => 'soul_suite_blog_settings',
)));

$wp_customize->add_setting('soul_suite_blog_meta_color', array(
    'default' => '#999999',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_blog_meta_color', array(
    'label' => __('Meta Info Color (date, comments)', 'soul-suite'),
    'section' => 'soul_suite_blog_settings',
)));

/** 
 * =============================
 * BLOG PAGE IMAGE SETTINGS
 * =============================
 */
$wp_customize->add_section('soul_suite_blog_page', array(
    'title' => __('Blog Page Settings', 'soul-suite'),
    'priority' => 20,
));

$wp_customize->add_setting('soul_suite_blog_image', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_blog_image', array(
    'label' => __('Blog Page Top Image', 'soul-suite'),
    'section' => 'soul_suite_blog_page',
)));

/**
 * =============================
 * BLOG PAGE BACKGROUND IMAGE
 * =============================
 */
$wp_customize->add_section('soul_suite_blog_page', array(
    'title' => __('Blog Page Settings', 'soul-suite'),
    'priority' => 20,
));

$wp_customize->add_setting('soul_suite_blog_bg_image', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_blog_bg_image', array(
    'label' => __('Blog Background Image', 'soul-suite'),
    'section' => 'soul_suite_blog_page',
)));

/** 
 * =============================
 * 404 PAGE IMAGE SETTINGS
 * =============================
 */
$wp_customize->add_section('soul_suite_404_page', array(
    'title' => __('404 Page Settings', 'soul-suite'),
    'priority' => 25,
));

$wp_customize->add_setting('soul_suite_404_image', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_404_image', array(
    'label' => __('404 Page Top Image', 'soul-suite'),
    'section' => 'soul_suite_404_page',
)));

/**
 * =============================
 * 404 PAGE BACKGROUND IMAGE
 * =============================
 */
$wp_customize->add_section('soul_suite_404_page', array(
    'title' => __('404 Page Settings', 'soul-suite'),
    'priority' => 25,
));

$wp_customize->add_setting('soul_suite_404_bg_image', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_404_bg_image', array(
    'label' => __('404 Background Image', 'soul-suite'),
    'section' => 'soul_suite_404_page',
)));

/**
 * =============================
 * PAGE TOP SECTION (BANNER)
 * =============================
 */
$wp_customize->add_section('soul_suite_page_top', array(
    'title' => __('Page Top Banner', 'soul-suite'),
    'priority' => 30,
    'description' => __('Controls the banner section at the top of pages and posts', 'soul-suite'),
));

// Default Background Image
$wp_customize->add_setting('soul_suite_page_top_bg_image', array(
    'default' => get_template_directory_uri() . '/assets/img/bg/home-bg.jpg',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_page_top_bg_image', array(
    'label' => __('Default Background Image', 'soul-suite'),
    'section' => 'soul_suite_page_top',
    'description' => __('Used when page has no featured image', 'soul-suite'),
)));

// Use Featured Image
$wp_customize->add_setting('soul_suite_page_top_use_featured', array(
    'default' => true,
    'sanitize_callback' => 'rest_sanitize_boolean',
));
$wp_customize->add_control('soul_suite_page_top_use_featured', array(
    'label' => __('Use Featured Image as Background', 'soul-suite'),
    'section' => 'soul_suite_page_top',
    'type' => 'checkbox',
    'description' => __('If enabled, page/post featured image will be used instead of default', 'soul-suite'),
));

// Overlay Settings
$wp_customize->add_setting('soul_suite_page_top_overlay_color', array(
    'default' => 'rgba(0,0,0,0.5)',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('soul_suite_page_top_overlay_color', array(
    'label' => __('Overlay Color', 'soul-suite'),
    'section' => 'soul_suite_page_top',
    'type' => 'text',
    'description' => __('Use rgba format (e.g., rgba(0,0,0,0.5))', 'soul-suite'),
));

// Title Color
$wp_customize->add_setting('soul_suite_page_top_title_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_page_top_title_color', array(
    'label' => __('Title Color', 'soul-suite'),
    'section' => 'soul_suite_page_top',
)));

// Title Font Size
$wp_customize->add_setting('soul_suite_page_top_title_size', array(
    'default' => '42',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_page_top_title_size', array(
    'label' => __('Title Font Size (px)', 'soul-suite'),
    'section' => 'soul_suite_page_top',
    'type' => 'number',
    'input_attrs' => array('min' => 24, 'max' => 72, 'step' => 1),
));

// Breadcrumb Color
$wp_customize->add_setting('soul_suite_page_top_breadcrumb_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_page_top_breadcrumb_color', array(
    'label' => __('Breadcrumb Color', 'soul-suite'),
    'section' => 'soul_suite_page_top',
)));

// Section Height
$wp_customize->add_setting('soul_suite_page_top_height', array(
    'default' => '350',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control('soul_suite_page_top_height', array(
    'label' => __('Section Height (px)', 'soul-suite'),
    'section' => 'soul_suite_page_top',
    'type' => 'number',
    'input_attrs' => array('min' => 200, 'max' => 600, 'step' => 10),
));

    
    /**
     * =============================
     * FOOTER SETTINGS
     * =============================
     */
    $wp_customize->add_section('soul_suite_footer', array(
        'title' => __('Footer Settings', 'soul-suite'),
        'priority' => 55,
    ));
    
    $wp_customize->add_setting('soul_suite_footer_bg_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'soul_suite_footer_bg_image', array(
        'label' => __('Background Image', 'soul-suite'),
        'section' => 'soul_suite_footer',
        'description' => __('Optional background image', 'soul-suite'),
    )));
    
    $wp_customize->add_setting('soul_suite_footer_bg_start', array(
        'default' => '#245C52',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_footer_bg_start', array(
        'label' => __('Background Gradient Start', 'soul-suite'),
        'section' => 'soul_suite_footer',
    )));
    
    $wp_customize->add_setting('soul_suite_footer_bg_end', array(
        'default' => '#1a4439',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_footer_bg_end', array(
        'label' => __('Background Gradient End', 'soul-suite'),
        'section' => 'soul_suite_footer',
    )));
    
    $wp_customize->add_setting('soul_suite_footer_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_footer_text_color', array(
        'label' => __('Text Color', 'soul-suite'),
        'section' => 'soul_suite_footer',
    )));
    
    $wp_customize->add_setting('soul_suite_footer_link_color', array(
        'default' => '#40e0d0',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_footer_link_color', array(
        'label' => __('Link Color', 'soul-suite'),
        'section' => 'soul_suite_footer',
    )));
    
    $wp_customize->add_setting('soul_suite_footer_link_hover_color', array(
        'default' => '#ff5b0c',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'soul_suite_footer_link_hover_color', array(
        'label' => __('Link Hover Color', 'soul-suite'),
        'section' => 'soul_suite_footer',
    )));
    
    $wp_customize->add_setting('soul_suite_footer_font_family', array(
        'default' => 'primary',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_footer_font_family', array(
        'label' => __('Font Family', 'soul-suite'),
        'section' => 'soul_suite_footer',
        'type' => 'select',
        'choices' => array(
            'primary' => __('Poppins (Primary)', 'soul-suite'),
            'secondary' => __('Playfair Display (Secondary)', 'soul-suite'),
            'accent' => __('Dancing Script (Accent)', 'soul-suite'),
            'inherit' => __('Inherit from Theme', 'soul-suite'),
        ),
    ));
    
    $wp_customize->add_setting('soul_suite_footer_font_size', array(
        'default' => '14',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('soul_suite_footer_font_size', array(
        'label' => __('Font Size (px)', 'soul-suite'),
        'section' => 'soul_suite_footer',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 10,
            'max' => 24,
            'step' => 1,
        ),
    ));
    
    $wp_customize->add_setting('soul_suite_footer_font_weight', array(
        'default' => '400',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_footer_font_weight', array(
        'label' => __('Font Weight', 'soul-suite'),
        'section' => 'soul_suite_footer',
        'type' => 'select',
        'choices' => array(
            '300' => __('Light (300)', 'soul-suite'),
            '400' => __('Normal (400)', 'soul-suite'),
            '500' => __('Medium (500)', 'soul-suite'),
            '600' => __('Semi-Bold (600)', 'soul-suite'),
            '700' => __('Bold (700)', 'soul-suite'),
        ),
    ));
    
    $wp_customize->add_setting('soul_suite_footer_text_align', array(
        'default' => 'center',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_footer_text_align', array(
        'label' => __('Text Alignment', 'soul-suite'),
        'section' => 'soul_suite_footer',
        'type' => 'select',
        'choices' => array(
            'left' => __('Left', 'soul-suite'),
            'center' => __('Center', 'soul-suite'),
            'right' => __('Right', 'soul-suite'),
        ),
    ));
    
    $wp_customize->add_setting('soul_suite_footer_line_height', array(
        'default' => '1.6',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_footer_line_height', array(
        'label' => __('Line Height', 'soul-suite'),
        'section' => 'soul_suite_footer',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 3,
            'step' => 0.1,
        ),
    ));
    
    $wp_customize->add_setting('soul_suite_footer_letter_spacing', array(
        'default' => '0',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('soul_suite_footer_letter_spacing', array(
        'label' => __('Letter Spacing (px)', 'soul-suite'),
        'section' => 'soul_suite_footer',
        'type' => 'number',
        'input_attrs' => array(
            'min' => -2,
            'max' => 5,
            'step' => 0.5,
        ),
    ));
    
    $wp_customize->add_setting('soul_suite_footer_copyright', array(
        'default' => '&copy; ' . date('Y') . ' Soul Suite Wellness. Made with <span class="heart">♥</span> by <a href="https://vaoneagency.com" target="_blank" rel="noopener">VAOne Agency</a>',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('soul_suite_footer_copyright', array(
        'label' => __('Copyright Text', 'soul-suite'),
        'section' => 'soul_suite_footer',
        'type' => 'textarea',
        'description' => __('HTML allowed. Use &lt;span class="heart"&gt;♥&lt;/span&gt; for animated heart.', 'soul-suite'),
    ));
}
add_action('customize_register', 'soul_suite_customize_register');