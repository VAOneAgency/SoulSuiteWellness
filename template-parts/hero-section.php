<?php
/**
 * Template Part: Hero Section (Dynamic)
 * 
 * @package SoulSuite
 */

// Get all values from customizer
$hero_bg_image = get_option('soul_suite_hero_bg_image');
$hero_bg_color = get_option('soul_suite_hero_bg_color', '#1a4d4d');
$hero_title = get_option('soul_suite_hero_title', 'Wellness Suite Recovery Portal™ (WellSR Portal)');
$hero_subtitle = get_option('soul_suite_hero_subtitle', 'DECODE. DISRUPT. HEAL. EXIT.');
$hero_description = get_option('soul_suite_hero_description', 'A transformational portal for healthcare and wellness leaders—and their teams—ready to break free from exhaustion and reclaim sustainable power.');
$hero_btn_text = get_option('soul_suite_hero_btn_text', 'BOOK A CLARITY CALL');
$hero_btn_url = get_option('soul_suite_hero_btn_url', '/intake-form/');

// Build background style
$bg_style = '';
if ($hero_bg_image) {
    $bg_style .= "background-image: url('" . esc_url($hero_bg_image) . "'); background-size: cover; background-position: center;";
}
$bg_style .= " background-color: " . esc_attr($hero_bg_color) . ";";
?>

<section class="hero-section" style="<?php echo $bg_style; ?>">
    <div class="container">
        <div class="hero-content">
            <div class="hero-logo">
                <?php 
                $logo = get_custom_logo();
                if ($logo) {
                    echo $logo;
                } else {
                    ?>
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/cropped-logo-e1752929960469.png" alt="<?php bloginfo('name'); ?> Logo" class="logo">
                    <?php
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
