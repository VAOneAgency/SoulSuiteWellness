<?php
/**
 * Template Part: About Owner Section
 * COMPLETE CUSTOMIZER CONTROL
 * 
 * @package SoulSuite
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get all customizer values
$about_bg_image = get_theme_mod('soul_suite_about_bg_image', '');
$about_bg_color = get_theme_mod('soul_suite_about_bg_color', '#ffffff');
$about_content_bg = get_theme_mod('soul_suite_about_content_bg', 'transparent');
$about_image_border = get_theme_mod('soul_suite_about_image_border', '#40e0d0');
$about_title = get_theme_mod('soul_suite_about_title', 'About the Owner');
$owner_image = get_theme_mod('soul_suite_about_owner_image', 'https://soulsuitewellness.com/wp-content/uploads/2025/07/IMG-BTM.jpg');
$owner_name = get_theme_mod('soul_suite_about_owner_name', 'Soulara Sevier');
$owner_title = get_theme_mod('soul_suite_about_owner_title', 'Founder & CEO | Soul Suite Wellness');
$owner_bio = get_theme_mod('soul_suite_about_owner_bio', '');

// Typography
$name_size = get_theme_mod('soul_suite_about_name_size', '32');
$name_weight = get_theme_mod('soul_suite_about_name_weight', '700');
$name_color = get_theme_mod('soul_suite_about_name_color', '#333333');
$title_size = get_theme_mod('soul_suite_about_title_size', '18');
$title_color = get_theme_mod('soul_suite_about_title_color', '#666666');
$bio_size = get_theme_mod('soul_suite_about_bio_size', '16');
$bio_line_height = get_theme_mod('soul_suite_about_bio_line_height', '1.8');
$bio_color = get_theme_mod('soul_suite_about_bio_color', '#666666');

// Button settings
$btn_text = get_theme_mod('soul_suite_about_btn_text', 'Learn More About Our Services');
$btn_url = get_theme_mod('soul_suite_about_btn_url', '#services');
$btn_bg = get_theme_mod('soul_suite_about_btn_bg', '#40e0d0');
$btn_text_color = get_theme_mod('soul_suite_about_btn_text_color', '#ffffff');
$btn_hover_bg = get_theme_mod('soul_suite_about_btn_hover_bg', '#ff5b0c');
$btn_font_size = get_theme_mod('soul_suite_about_btn_font_size', '16');
$btn_padding = get_theme_mod('soul_suite_about_btn_padding', '15px 40px');
$btn_border_radius = get_theme_mod('soul_suite_about_btn_border_radius', '50');
$btn_font_weight = get_theme_mod('soul_suite_about_btn_font_weight', '600');
$btn_letter_spacing = get_theme_mod('soul_suite_about_btn_letter_spacing', '0');

// Build background style
$about_bg_style = 'background-color: ' . esc_attr($about_bg_color) . ';';
if ($about_bg_image) {
    $about_bg_style .= ' background-image: url(' . esc_url($about_bg_image) . '); background-size: cover; background-position: center;';
}
?>

<style>
.about-owner {
    padding: 80px 0;
}
.about-owner .section-title {
    font-size: 36px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 50px;
    color: #333;
}
.about-owner .owner-content {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 50px;
    align-items: center;
    background-color: <?php echo esc_attr($about_content_bg); ?>;
    padding: 40px;
    border-radius: 15px;
}
@media (max-width: 992px) {
    .about-owner .owner-content {
        grid-template-columns: 1fr;
        text-align: center;
    }
}
.about-owner .owner-image {
    display: flex;
    justify-content: center;
}
.about-owner .owner-image img {
    width: 100%;
    max-width: 400px;
    border-radius: 15px;
    border: 4px solid <?php echo esc_attr($about_image_border); ?>;
}
.about-owner .owner-name {
    font-size: <?php echo esc_attr($name_size); ?>px;
    font-weight: <?php echo esc_attr($name_weight); ?>;
    color: <?php echo esc_attr($name_color); ?>;
    margin-bottom: 10px;
}
.about-owner .owner-title {
    font-size: <?php echo esc_attr($title_size); ?>px;
    color: <?php echo esc_attr($title_color); ?>;
    margin-bottom: 25px;
    font-style: italic;
}
.about-owner .owner-bio {
    font-size: <?php echo esc_attr($bio_size); ?>px;
    line-height: <?php echo esc_attr($bio_line_height); ?>;
    color: <?php echo esc_attr($bio_color); ?>;
    margin-bottom: 30px;
}
.about-owner .cta-section {
    margin-top: 30px;
}
.about-owner .cta-section .hero-btn {
    display: inline-block;
    padding: <?php echo esc_attr($btn_padding); ?>;
    background: <?php echo esc_attr($btn_bg); ?>;
    color: <?php echo esc_attr($btn_text_color); ?>;
    text-decoration: none;
    border-radius: <?php echo esc_attr($btn_border_radius); ?>px;
    font-size: <?php echo esc_attr($btn_font_size); ?>px;
    font-weight: <?php echo esc_attr($btn_font_weight); ?>;
    letter-spacing: <?php echo esc_attr($btn_letter_spacing); ?>px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    text-transform: uppercase;
}
.about-owner .cta-section .hero-btn:hover {
    background: <?php echo esc_attr($btn_hover_bg); ?>;
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}
</style>

<section class="about-owner" style="<?php echo $about_bg_style; ?>">
    <div class="container">
        <?php if ($about_title): ?>
            <h2 class="section-title"><?php echo esc_html($about_title); ?></h2>
        <?php endif; ?>

        <div class="owner-content">
            <?php if ($owner_image): ?>
                <div class="owner-image">
                    <img src="<?php echo esc_url($owner_image); ?>" alt="<?php echo esc_attr($owner_name); ?>">
                </div>
            <?php endif; ?>

            <div class="owner-info">
                <div class="owner-credentials">
                    <?php if ($owner_name): ?>
                        <h3 class="owner-name"><?php echo esc_html($owner_name); ?></h3>
                    <?php endif; ?>

                    <?php if ($owner_title): ?>
                        <p class="owner-title"><?php echo esc_html($owner_title); ?></p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($owner_bio)): ?>
                    <div class="owner-bio">
                        <?php echo wpautop(wp_kses_post($owner_bio)); ?>
                    </div>
                <?php elseif (current_user_can('manage_options')): ?>
                    <div class="owner-bio" style="background:#fff3cd;padding:20px;border-left:4px solid #ffc107;">
                        <p><strong>⚠️ Admin Notice:</strong> Owner Bio is empty in Customizer. Add it in <strong>Customize → Home Page Settings → About Owner Section → Owner Bio</strong>.</p>
                    </div>
                <?php endif; ?>

                <?php if ($btn_text && $btn_url): ?>
                    <div class="cta-section">
                        <a href="<?php echo esc_url($btn_url); ?>" class="hero-btn primary-btn">
                            <?php echo esc_html($btn_text); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>