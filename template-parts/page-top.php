<?php
/**
 * Template Part: Page Top Banner
 * COMPLETE CUSTOMIZER CONTROL
 * 
 * @package SoulSuite
 */

// Get all customizer settings
$use_featured = get_theme_mod('soul_suite_page_top_use_featured', true);
$default_bg = get_theme_mod('soul_suite_page_top_bg_image', get_template_directory_uri() . '/assets/img/bg/home-bg.jpg');
$bg_color = get_theme_mod('soul_suite_page_top_bg_color', '#1a4d4d');
$overlay_color = get_theme_mod('soul_suite_page_top_overlay_color', 'rgba(0,0,0,0.5)');
$section_height = get_theme_mod('soul_suite_page_top_height', '350');
$section_padding = get_theme_mod('soul_suite_page_top_padding', '80px 20px');

// Title settings
$title_color = get_theme_mod('soul_suite_page_top_title_color', '#ffffff');
$title_size = get_theme_mod('soul_suite_page_top_title_size', '42');
$title_weight = get_theme_mod('soul_suite_page_top_title_weight', '700');
$title_margin = get_theme_mod('soul_suite_page_top_title_margin', '0 0 20px 0');

// Breadcrumb settings
$breadcrumb_color = get_theme_mod('soul_suite_page_top_breadcrumb_color', '#ffffff');
$breadcrumb_size = get_theme_mod('soul_suite_page_top_breadcrumb_size', '14');

// Effects
$border_bottom = get_theme_mod('soul_suite_page_top_border_bottom', '');
$text_shadow = get_theme_mod('soul_suite_page_top_text_shadow', '2px 2px 4px rgba(0,0,0,0.3)');

// Determine background image
$bg_image = $default_bg;
if ($use_featured && has_post_thumbnail()) {
    $bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
}

// If no image at all, use background color
if (empty($bg_image)) {
    $bg_image = '';
}
?>

<style>
.section-top {
    min-height: <?php echo esc_attr($section_height); ?>px;
    display: flex;
    align-items: center;
    justify-content: center;
    <?php if ($bg_image): ?>
    background-image: url(<?php echo esc_url($bg_image); ?>);
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
    <?php else: ?>
    background-color: <?php echo esc_attr($bg_color); ?>;
    <?php endif; ?>
    position: relative;
    padding: <?php echo esc_attr($section_padding); ?>;
    <?php if ($border_bottom): ?>
    border-bottom: <?php echo esc_attr($border_bottom); ?>;
    <?php endif; ?>
}
.section-top .overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: <?php echo esc_attr($overlay_color); ?>;
}
.section-top .section-top-title {
    position: relative;
    z-index: 2;
}
.section-top .section-top-title h2 {
    color: <?php echo esc_attr($title_color); ?>;
    font-size: <?php echo esc_attr($title_size); ?>px;
    font-weight: <?php echo esc_attr($title_weight); ?>;
    margin: <?php echo esc_attr($title_margin); ?>;
    <?php if ($text_shadow): ?>
    text-shadow: <?php echo esc_attr($text_shadow); ?>;
    <?php endif; ?>
}
.section-top .breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
    font-size: <?php echo esc_attr($breadcrumb_size); ?>px;
}
.section-top .breadcrumb li,
.section-top .breadcrumb li a {
    color: <?php echo esc_attr($breadcrumb_color); ?>;
    <?php if ($text_shadow): ?>
    text-shadow: <?php echo esc_attr($text_shadow); ?>;
    <?php endif; ?>
}
.section-top .breadcrumb > .active {
    color: <?php echo esc_attr($breadcrumb_color); ?>;
    opacity: 0.8;
}
@media (max-width: 768px) {
    .section-top .section-top-title h2 {
        font-size: <?php echo round($title_size * 0.7); ?>px;
    }
    .section-top .breadcrumb {
        font-size: <?php echo round($breadcrumb_size * 0.9); ?>px;
    }
}
</style>

<section class="section-top">	
    <div class="overlay">
        <div class="container">
            <div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
                <div class="section-top-title">
                    <h2><?php the_title(); ?></h2>
                    <?php if (function_exists('yoast_breadcrumb')): ?>
                        <?php yoast_breadcrumb('<ol class="breadcrumb">', '</ol>'); ?>
                    <?php else: ?>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo home_url(); ?>">Home</a></li>
                            <?php if (is_category() || is_single()): ?>
                                <li><?php the_category(', '); ?></li>
                            <?php endif; ?>
                            <li class="active"><?php the_title(); ?></li>
                        </ol>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>