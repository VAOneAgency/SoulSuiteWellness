<?php
/**
 * Template Part: Contact Section
 * 
 * @package SoulSuite
 */

// Get values from CUSTOMIZER (single source of truth)
$contact_bg_image = get_theme_mod('soul_suite_contact_bg_image', '');
$contact_bg_color = get_theme_mod('soul_suite_contact_bg_color', '#f9f9f9');
$contact_title = get_theme_mod('soul_suite_contact_title', 'Get in Touch');
$contact_subtitle = get_theme_mod('soul_suite_contact_subtitle', 'We are here to support your wellness journey.');
$contact_email = get_theme_mod('soul_suite_contact_email', 'bewell@soulsuitewellness.com');
$contact_phone = get_theme_mod('soul_suite_contact_phone', '(678) 744-3723');
$contact_address = get_theme_mod('soul_suite_contact_address', 'Atlanta, Georgia, USA');

// Build background style
$contact_bg_style = 'background-color: ' . esc_attr($contact_bg_color) . ';';
if ($contact_bg_image) {
    $contact_bg_style .= ' background-image: url(' . esc_url($contact_bg_image) . '); background-size: cover; background-position: center;';
}
?>

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
                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                    <div class="text">
                        <h4>OUR OFFICE</h4>
                        <p><?php echo esc_html($contact_address); ?></p>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($contact_phone): ?>
                <div class="info-box">
                    <div class="icon"><i class="fa fa-phone"></i></div>
                    <div class="text">
                        <h4>CALL OR TEXT</h4>
                        <p><a href="tel:<?php echo esc_attr(str_replace(array('(', ')', ' ', '-'), '', $contact_phone)); ?>"><?php echo esc_html($contact_phone); ?></a></p>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($contact_email): ?>
                <div class="info-box">
                    <div class="icon"><i class="fa fa-envelope"></i></div>
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