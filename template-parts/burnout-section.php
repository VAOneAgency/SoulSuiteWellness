<?php
/**
 * Template Part: Burnout/Breaking the Cycle Section
 * 
 * @package SoulSuite
 */

// Get content from customizer
$burnout_bg_image = get_theme_mod('soul_suite_burnout_bg_image', '');
$burnout_bg_color = get_theme_mod('soul_suite_burnout_bg_color', 'linear-gradient(90deg, #40e0d0, #8c756a, #ff5b0c)');
$burnout_title = get_theme_mod('soul_suite_burnout_title', 'Breaking the Cycle');
$burnout_image = get_theme_mod('soul_suite_burnout_image', 'https://soulsuitewellness.com/wp-content/uploads/2025/07/AdobeStock_187293579_Preview.webp');
$burnout_highlight = get_theme_mod('soul_suite_burnout_highlight', 'ARE YOU CAUGHT IN A CYCLE OF BURNOUT?');
$burnout_content = get_theme_mod('soul_suite_burnout_content', '');
$hero_btn_text = get_theme_mod('soul_suite_hero_btn_text', 'BOOK A CLARITY CALL');
$hero_btn_url = get_theme_mod('soul_suite_hero_btn_url', '/intake-form/');

// Get styling from customizer
$title_color = get_theme_mod('soul_suite_burnout_title_color', '#ffffff');
$title_font_size = get_theme_mod('soul_suite_burnout_title_font_size', '40');
$highlight_color = get_theme_mod('soul_suite_burnout_highlight_color', '#555555');
$highlight_bg = get_theme_mod('soul_suite_burnout_highlight_bg', 'rgba(255, 255, 255, 0.95)');
$highlight_font_size = get_theme_mod('soul_suite_burnout_highlight_font_size', '24');
$text_color = get_theme_mod('soul_suite_burnout_text_color', '#555555');
$text_font_size = get_theme_mod('soul_suite_burnout_text_font_size', '16');
$text_line_height = get_theme_mod('soul_suite_burnout_text_line_height', '1.6');
$image_border_color = get_theme_mod('soul_suite_burnout_image_border_color', 'rgba(255, 255, 255, 0.2)');
$image_border_width = get_theme_mod('soul_suite_burnout_image_border_width', '5');
$image_border_radius = get_theme_mod('soul_suite_burnout_image_border_radius', '20');
$content_bg = get_theme_mod('soul_suite_burnout_content_bg', 'rgba(255, 255, 255, 0.95)');
$btn_use_global = get_theme_mod('soul_suite_burnout_btn_use_global', true);
$btn_bg = get_theme_mod('soul_suite_burnout_btn_bg_color', '#40e0d0');
$btn_text = get_theme_mod('soul_suite_burnout_btn_text_color', '#ffffff');
$btn_hover_bg = get_theme_mod('soul_suite_burnout_btn_hover_bg', '#ff5b0c');
$btn_hover_text = get_theme_mod('soul_suite_burnout_btn_hover_text', '#ffffff');

// Build background style
$burnout_bg_style = 'background: ' . esc_attr($burnout_bg_color) . ';';
if ($burnout_bg_image) {
    $burnout_bg_style .= ' background-image: url(' . esc_url($burnout_bg_image) . '); background-size: cover; background-position: center;';
}
?>

<style>
/* Burnout Section Styling from Customizer */
.burnout-section {
    padding: 80px 0;
    <?php echo $burnout_bg_style; ?>
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    color: #ffffff;
}

.burnout-section .container {
    width: 100%;
    margin: 0 auto;
    padding: 0 40px;
    position: relative;
    z-index: 2;
}

.burnout-section .section-title {
    text-align: center;
    font-size: <?php echo esc_attr($title_font_size); ?>px;
    color: <?php echo esc_attr($title_color); ?>;
    margin-bottom: 50px;
    font-weight: 700;
    text-transform: uppercase;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    position: relative;
}

.burnout-content {
    display: flex;
    align-items: center;
    gap: 60px;
    margin-top: 60px;
    max-width: 1500px;
    margin-left: auto;
    margin-right: auto;
    flex-wrap: wrap;
}

.burnout-image {
    flex: 1;
    min-width: 400px;
}

.burnout-image img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: <?php echo esc_attr($image_border_radius); ?>px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border: <?php echo esc_attr($image_border_width); ?>px solid <?php echo esc_attr($image_border_color); ?>;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.burnout-image img:hover {
    transform: scale(1.02);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
}

.burnout-text {
    flex: 1;
    padding: 40px;
    background: <?php echo esc_attr($content_bg); ?>;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
    color: <?php echo esc_attr($text_color); ?>;
    min-width: 600px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.burnout-highlight h3 {
    color: <?php echo esc_attr($highlight_color); ?>;
    font-size: <?php echo esc_attr($highlight_font_size); ?>px;
    margin: 0;
    font-weight: 700;
    text-transform: uppercase;
}

.burnout-body {
    color: <?php echo esc_attr($text_color); ?>;
    font-size: <?php echo esc_attr($text_font_size); ?>px;
    line-height: <?php echo esc_attr($text_line_height); ?>;
}

.burnout-body p {
    margin-bottom: 15px;
}

.burnout-cta {
    margin-top: 10px;
}

<?php if (!$btn_use_global): ?>
/* Custom Button Styling (when global is disabled) */
.burnout-section .burnout-cta .hero-btn {
    background: <?php echo esc_attr($btn_bg); ?> !important;
    color: <?php echo esc_attr($btn_text); ?> !important;
}

.burnout-section .burnout-cta .hero-btn:hover {
    background: <?php echo esc_attr($btn_hover_bg); ?> !important;
    color: <?php echo esc_attr($btn_hover_text); ?> !important;
}
<?php endif; ?>

/* Responsive */
@media (max-width: 992px) {
    .burnout-content {
        flex-direction: column;
    }
    
    .burnout-image,
    .burnout-text {
        min-width: 100%;
    }
}
</style>

<section class="burnout-section">
    <div class="container">
        <?php if ($burnout_title): ?>
        <h2 class="section-title"><?php echo esc_html($burnout_title); ?></h2>
        <?php endif; ?>
        
        <div class="burnout-content">
            <?php if ($burnout_image): ?>
            <div class="burnout-image">
                <img src="<?php echo esc_url($burnout_image); ?>" alt="<?php echo esc_attr($burnout_highlight); ?>">
            </div>
            <?php endif; ?>
            
            <div class="burnout-text">
                <?php if ($burnout_highlight): ?>
                <div class="burnout-highlight">
                    <h3><?php echo esc_html($burnout_highlight); ?></h3>
                </div>
                <?php endif; ?>
                
                <?php if ($burnout_content): ?>
                <div class="burnout-body">
                    <?php echo wpautop(wp_kses_post($burnout_content)); ?>
                </div>
                <?php endif; ?>
                
                <?php if ($hero_btn_text && $hero_btn_url): ?>
                <div class="burnout-cta">
                    <a href="<?php echo esc_url($hero_btn_url); ?>" class="hero-btn primary-btn">
                        <?php echo esc_html($hero_btn_text); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>