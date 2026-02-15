<?php
/**
 * Template Name: Thank You Page
 * 
 * @package SoulSuite
 */

$bg_image = get_theme_mod('soul_suite_thankyou_bg_image', '');
$bg_color = get_theme_mod('soul_suite_thankyou_bg_color', '#f9f9f9');
$title = get_theme_mod('soul_suite_thankyou_title', 'Thank You!');
$message = get_theme_mod('soul_suite_thankyou_message', 'Your submission has been received. We\'ll be in touch soon!');
$title_color = get_theme_mod('soul_suite_thankyou_title_color', '#333333');
$text_color = get_theme_mod('soul_suite_thankyou_text_color', '#666666');

$bg_style = 'background-color: ' . esc_attr($bg_color) . ';';
if ($bg_image) {
    $bg_style .= ' background-image: url(' . esc_url($bg_image) . '); background-size: cover; background-position: center;';
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_html($title); ?> - <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    <style>
    .thankyou-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
    }
    .thankyou-content {
        text-align: center;
        max-width: 600px;
        background: rgba(255,255,255,0.95);
        padding: 60px 40px;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .thankyou-content .checkmark {
        width: 80px;
        height: 80px;
        margin: 0 auto 30px;
        background: linear-gradient(135deg, #40e0d0, #8c756a);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: scaleIn 0.5s ease;
    }
    .thankyou-content .checkmark i {
        font-size: 40px;
        color: #ffffff;
    }
    .thankyou-content h1 {
        color: <?php echo esc_attr($title_color); ?>;
        font-size: 48px;
        margin-bottom: 20px;
        font-weight: 700;
    }
    .thankyou-content p {
        color: <?php echo esc_attr($text_color); ?>;
        font-size: 18px;
        line-height: 1.8;
        margin-bottom: 40px;
    }
    .thankyou-content .hero-btn {
        display: inline-block;
        padding: 15px 40px;
        background: linear-gradient(90deg, #40e0d0, #8c756a, #ff5b0c);
        color: #ffffff;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .thankyou-content .hero-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    @keyframes scaleIn {
        from { transform: scale(0); }
        to { transform: scale(1); }
    }
    </style>
</head>
<body <?php body_class(); ?>>
    <section class="thankyou-section" style="<?php echo $bg_style; ?>">
        <div class="thankyou-content">
            <div class="checkmark">
                <i class="fa fa-check"></i>
            </div>
            <h1><?php echo esc_html($title); ?></h1>
            <div><?php echo wpautop(wp_kses_post($message)); ?></div>
            <a href="<?php echo home_url(); ?>" class="hero-btn">Return Home</a>
        </div>
    </section>
    <?php wp_footer(); ?>
</body>
</html>