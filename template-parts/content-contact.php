<?php
/**
 * Template Part: Contact Section
 * COMPLETE CUSTOMIZER CONTROL
 * 
 * @package SoulSuite
 */

// Get ALL customizer values
$contact_bg_image = get_theme_mod('soul_suite_contact_bg_image', '');
$contact_bg_color = get_theme_mod('soul_suite_contact_bg_color', '#f9f9f9');
$contact_title = get_theme_mod('soul_suite_contact_title', 'Get in Touch');
$contact_subtitle = get_theme_mod('soul_suite_contact_subtitle', 'We are here to support your wellness journey. Reach out to explore how Soul Suite Wellness can serve you or your organization with intention and care.');
$contact_email = get_theme_mod('soul_suite_contact_email', 'bewell@soulsuitewellness.com');
$contact_phone = get_theme_mod('soul_suite_contact_phone', '(678) 744-3723');
$contact_address = get_theme_mod('soul_suite_contact_address', 'Atlanta, Georgia, USA');

// Styling options
$box_style = get_theme_mod('soul_suite_contact_box_style', 'rounded');
$box_bg = get_theme_mod('soul_suite_contact_box_bg', '#ffffff');
$box_border = get_theme_mod('soul_suite_contact_box_border', '#e0e0e0');
$icon_bg = get_theme_mod('soul_suite_contact_icon_bg', '#40e0d0');
$icon_color = get_theme_mod('soul_suite_contact_icon_color', '#ffffff');
$icon_size = get_theme_mod('soul_suite_contact_icon_size', '24');
$title_color = get_theme_mod('soul_suite_contact_title_color', '#333333');
$subtitle_color = get_theme_mod('soul_suite_contact_subtitle_color', '#666666');
$heading_color = get_theme_mod('soul_suite_contact_heading_color', '#333333');
$text_color = get_theme_mod('soul_suite_contact_text_color', '#666666');
$link_color = get_theme_mod('soul_suite_contact_link_color', '#40e0d0');

// Build background style
$contact_bg_style = 'background-color: ' . esc_attr($contact_bg_color) . ';';
if ($contact_bg_image) {
    $contact_bg_style .= ' background-image: url(' . esc_url($contact_bg_image) . '); background-size: cover; background-position: center;';
}

// Icon box style classes
$box_class = '';
switch ($box_style) {
    case 'circle':
        $box_class = 'icon-circle';
        break;
    case 'square':
        $box_class = 'icon-square';
        break;
    case 'transparent':
        $box_class = 'icon-transparent';
        break;
    default:
        $box_class = 'icon-rounded';
}
?>

<style>
.contact-section {
    padding: 80px 0;
}
.contact-section .section-title h2 {
    color: <?php echo esc_attr($title_color); ?>;
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 15px;
}
.contact-section .section-title p {
    color: <?php echo esc_attr($subtitle_color); ?>;
    font-size: 18px;
    line-height: 1.6;
    max-width: 800px;
    margin: 0 auto 50px;
}
.contact-section .line {
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, #40e0d0, #8c756a, #ff5b0c);
    margin: 20px auto;
}
.contact-section .contact-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 50px;
    align-items: start;
}
@media (max-width: 768px) {
    .contact-section .contact-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

/* Info Boxes */
.contact-section .info-box {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    padding: 25px;
    background: <?php echo esc_attr($box_bg); ?>;
    border: 1px solid <?php echo esc_attr($box_border); ?>;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}
.contact-section .info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

/* Icon Styles */
.contact-section .icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: <?php echo esc_attr($icon_bg); ?>;
    color: <?php echo esc_attr($icon_color); ?>;
}
.contact-section .icon i {
    font-size: <?php echo esc_attr($icon_size); ?>px;
}

/* Icon Shape Variations */
.contact-section .icon-rounded {
    border-radius: 8px;
}
.contact-section .icon.icon-circle {
    border-radius: 50%;
}
.contact-section .icon.icon-square {
    border-radius: 0;
}
.contact-section .icon.icon-transparent {
    background: transparent;
    border: 2px solid <?php echo esc_attr($icon_bg); ?>;
    color: <?php echo esc_attr($icon_bg); ?>;
}

/* Text Styles */
.contact-section .text h4 {
    color: <?php echo esc_attr($heading_color); ?>;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 10px;
}
.contact-section .text p {
    color: <?php echo esc_attr($text_color); ?>;
    font-size: 16px;
    line-height: 1.6;
    margin: 0;
}
.contact-section .text a {
    color: <?php echo esc_attr($link_color); ?>;
    text-decoration: none;
    transition: all 0.3s ease;
}
.contact-section .text a:hover {
    opacity: 0.8;
    text-decoration: underline;
}
</style>

<section class="contact-section" style="<?php echo $contact_bg_style; ?>">
    <div class="container">
        <div class="section-title">
            <?php if ($contact_title): ?>
                <h2><?php echo wp_kses_post($contact_title); ?></h2>
            <?php endif; ?>
            
            <div class="line"></div>
            
            <?php if ($contact_subtitle): ?>
                <p><?php echo esc_html($contact_subtitle); ?></p>
            <?php endif; ?>
        </div>
        
        <div class="contact-content">
            <div class="contact-info">
                <?php if ($contact_address): ?>
                <div class="info-box">
                    <div class="icon <?php echo $box_class; ?>">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="text">
                        <h4>OUR OFFICE</h4>
                        <p><?php echo esc_html($contact_address); ?></p>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($contact_phone): ?>
                <div class="info-box">
                    <div class="icon <?php echo $box_class; ?>">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="text">
                        <h4>CALL OR TEXT</h4>
                        <p><a href="tel:<?php echo esc_attr(str_replace(array('(', ')', ' ', '-'), '', $contact_phone)); ?>"><?php echo esc_html($contact_phone); ?></a></p>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($contact_email): ?>
                <div class="info-box">
                    <div class="icon <?php echo $box_class; ?>">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="text">
                        <h4>EMAIL US</h4>
                        <p><a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="contact-form">
                <?php echo do_shortcode('[soul_suite_form slug="contact-form"]'); ?>
            </div>
        </div>
    </div>
</section>