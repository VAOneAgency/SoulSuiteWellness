<?php
/**
 * Template Name: Landing Page
 * 
 * @package SoulSuite
 */

// Get ALL customizer values
$hero_bg_image = get_theme_mod('soul_suite_hero_bg_image', 'https://soulsuitewellness.com/wp-content/uploads/2025/07/Home-page.png');
$hero_bg_color = get_theme_mod('soul_suite_hero_bg_color', '#1a4d4d');
$hero_logo_align = get_theme_mod('soul_suite_hero_logo_align', 'center');
$hero_title = get_theme_mod('soul_suite_hero_title', 'Wellness Suite Recovery Portal (WellSR Portal)');
$hero_subtitle = get_theme_mod('soul_suite_hero_subtitle', 'DECODE. DISRUPT. HEAL. EXIT.');
$hero_description = get_theme_mod('soul_suite_hero_description', 'A transformational portal for healthcare and wellness leaders and their teams ready to break free from exhaustion and reclaim sustainable power.');
$hero_btn_text = get_theme_mod('soul_suite_hero_btn_text', 'BOOK A CLARITY CALL');
$hero_btn_url = get_theme_mod('soul_suite_hero_btn_url', '/intake-form/');

$matrix_bg_image = get_theme_mod('soul_suite_matrix_bg_image', '');
$matrix_bg_color = get_theme_mod('soul_suite_matrix_bg_color', '#1a4d4d');
$matrix_text_color = get_theme_mod('soul_suite_matrix_text_color', '#ffffff');
$matrix_text_align = get_theme_mod('soul_suite_matrix_text_align', 'center');
$matrix_point_bg = get_theme_mod('soul_suite_matrix_point_bg', 'rgba(255, 255, 255, 0.03)');
$matrix_point_border = get_theme_mod('soul_suite_matrix_point_border', '#ff5b0c');
$matrix_point_bullet = get_theme_mod('soul_suite_matrix_point_bullet', '#40e0d0');
$matrix_title = get_theme_mod('soul_suite_matrix_title', 'BURNOUT IS NOT JUST STRESS');
$matrix_intro = get_theme_mod('soul_suite_matrix_intro', 'Burnout is not a personal failure.');
$matrix_point_1 = get_theme_mod('soul_suite_matrix_point_1', '');
$matrix_point_2 = get_theme_mod('soul_suite_matrix_point_2', '');
$matrix_point_3 = get_theme_mod('soul_suite_matrix_point_3', '');
$matrix_point_4 = get_theme_mod('soul_suite_matrix_point_4', '');
$matrix_note = get_theme_mod('soul_suite_matrix_note', '');
$matrix_conclusion = get_theme_mod('soul_suite_matrix_conclusion', '');
$matrix_cta_text = get_theme_mod('soul_suite_matrix_cta_text', 'Lets Have a Conversation');

// Build background styles
$hero_bg_style = 'background-color: ' . esc_attr($hero_bg_color) . ';';
if ($hero_bg_image) {
    $hero_bg_style .= ' background-image: url(' . esc_url($hero_bg_image) . '); background-size: cover; background-position: center;';
}

$matrix_bg_style = 'background-color: ' . esc_attr($matrix_bg_color) . '; color: ' . esc_attr($matrix_text_color) . '; text-align: ' . esc_attr($matrix_text_align) . ';';
if ($matrix_bg_image) {
    $matrix_bg_style .= ' background-image: url(' . esc_url($matrix_bg_image) . '); background-size: cover; background-position: center;';
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/landing-page.css">
    
    <style>
    /* Matrix Point Styling */
    .system-matrix-point {
        background: <?php echo esc_attr($matrix_point_bg); ?>;
        border-left-color: <?php echo esc_attr($matrix_point_border); ?>;
    }
    .system-matrix-point::before {
        color: <?php echo esc_attr($matrix_point_bullet); ?>;
    }
    
    /* Hero Logo Alignment */
    .hero-logo {
        text-align: <?php echo esc_attr($hero_logo_align); ?> !important;
        display: block !important;
        width: 100% !important;
    }
    .hero-logo img,
    .hero-logo a {
        display: inline-block !important;
    }
    
    /* Hero Typography & Spacing */
    .hero-logo img {
        max-width: <?php echo esc_attr(get_theme_mod('soul_suite_hero_logo_width', '200')); ?>px;
    }
    @media (max-width: 768px) {
        .hero-logo img {
            max-width: <?php echo esc_attr(get_theme_mod('soul_suite_hero_logo_width_mobile', '150')); ?>px;
        }
    }

    .hero-title {
        font-size: <?php echo esc_attr(get_theme_mod('soul_suite_hero_title_size', '48')); ?>px;
        font-weight: <?php echo esc_attr(get_theme_mod('soul_suite_hero_title_weight', '700')); ?>;
        line-height: <?php echo esc_attr(get_theme_mod('soul_suite_hero_title_line_height', '1.2')); ?>;
        letter-spacing: <?php echo esc_attr(get_theme_mod('soul_suite_hero_title_letter_spacing', '0')); ?>px;
        margin-bottom: <?php echo esc_attr(get_theme_mod('soul_suite_hero_title_margin_bottom', '20')); ?>px;
    }

    .hero-subtitle {
        font-size: <?php echo esc_attr(get_theme_mod('soul_suite_hero_subtitle_size', '24')); ?>px;
        margin-bottom: <?php echo esc_attr(get_theme_mod('soul_suite_hero_subtitle_margin_bottom', '15')); ?>px;
    }

    .hero-description {
        font-size: <?php echo esc_attr(get_theme_mod('soul_suite_hero_desc_size', '18')); ?>px;
        margin-bottom: <?php echo esc_attr(get_theme_mod('soul_suite_hero_desc_margin_bottom', '30')); ?>px;
    }

    .hero-content {
        padding: <?php echo esc_attr(get_theme_mod('soul_suite_hero_content_padding', '60px 20px')); ?>;
    }

    /* Tablet */
    @media (max-width: 992px) {
        .hero-title {
            font-size: <?php echo esc_attr(get_theme_mod('soul_suite_hero_title_size_tablet', '36')); ?>px;
        }
    }

    /* Mobile */
    @media (max-width: 768px) {
        .hero-title {
            font-size: <?php echo esc_attr(get_theme_mod('soul_suite_hero_title_size_mobile', '28')); ?>px;
        }
        .hero-subtitle {
            font-size: <?php echo esc_attr(get_theme_mod('soul_suite_hero_subtitle_size_mobile', '18')); ?>px;
        }
        .hero-description {
            font-size: <?php echo esc_attr(get_theme_mod('soul_suite_hero_desc_size_mobile', '16')); ?>px;
        }
    }
    </style>
</head>

<body <?php body_class(); ?>>
    <!-- Hero Section -->
    <section class="hero-section" style="<?php echo $hero_bg_style; ?>">
        <div class="container">
            <div class="hero-content">
                <div class="hero-logo">
                    <?php 
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/cropped-logo-e1752929960469.png" alt="' . esc_attr(get_bloginfo('name')) . ' Logo" class="logo">';
                    }
                    ?>
                </div>
                <?php if ($hero_title): ?>
                <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                <?php endif; ?>
                
                <?php if ($hero_subtitle): ?>
                <h2 class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></h2>
                <?php endif; ?>
                
                <?php if ($hero_description): ?>
                <p class="hero-description"><?php echo esc_html($hero_description); ?></p>
                <?php endif; ?>
                
                <?php if ($hero_btn_text && $hero_btn_url): ?>
                <div class="hero-buttons">
                    <a href="<?php echo esc_url($hero_btn_url); ?>" class="hero-btn primary-btn">
                        <?php echo esc_html($hero_btn_text); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Burnout Section -->
    <?php get_template_part('template-parts/burnout-section'); ?>

    <!-- Services Section -->
    <?php get_template_part('template-parts/services-section'); ?>

    <!-- System Reset/Matrix Section -->
    <section class="system-reset-section" style="<?php echo $matrix_bg_style; ?>">
        <div class="container">
            <div class="system-reset-content">
                <?php if ($matrix_title): ?>
                <h2 class="reset-title"><?php echo esc_html($matrix_title); ?></h2>
                <?php endif; ?>
                
                <?php if ($matrix_intro): ?>
                <p class="system-reset-intro"><?php echo esc_html($matrix_intro); ?></p>
                <?php endif; ?>
                
                <?php if (!empty($matrix_point_1) || !empty($matrix_point_2) || !empty($matrix_point_3) || !empty($matrix_point_4)): ?>
                <div class="system-matrix-points">
                    <?php if (!empty($matrix_point_1)): ?>
                    <div class="system-matrix-point">
                        <div class="system-matrix-point-text"><?php echo wp_kses_post($matrix_point_1); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($matrix_point_2)): ?>
                    <div class="system-matrix-point">
                        <div class="system-matrix-point-text"><?php echo wp_kses_post($matrix_point_2); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($matrix_point_3)): ?>
                    <div class="system-matrix-point">
                        <div class="system-matrix-point-text"><?php echo wp_kses_post($matrix_point_3); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($matrix_point_4)): ?>
                    <div class="system-matrix-point">
                        <div class="system-matrix-point-text"><?php echo wp_kses_post($matrix_point_4); ?></div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <div class="system-reset-conclusion">
                    <?php if ($matrix_note): ?>
                    <p class="reset-note"><?php echo esc_html($matrix_note); ?></p>
                    <?php endif; ?>
                    
                    <?php if ($matrix_conclusion): ?>
                    <p class="reset-conclusion-text"><?php echo esc_html($matrix_conclusion); ?></p>
                    <?php endif; ?>
                </div>
                
                <?php if ($matrix_cta_text && $hero_btn_url): ?>
                <div class="system-reset-cta">
                    <a href="<?php echo esc_url($hero_btn_url); ?>" class="hero-btn primary-btn">
                        <?php echo esc_html($matrix_cta_text); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- About Owner Section -->
    <?php get_template_part('template-parts/about-section'); ?>

    <!-- Contact Section -->
    <?php get_template_part('template-parts/content-contact'); ?>

    <!-- Footer -->
    <?php get_footer(); ?>
</body>
</html>