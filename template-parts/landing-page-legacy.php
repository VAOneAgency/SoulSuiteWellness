<?php


// FORCE CLEAR CACHE FOR TESTING
if (current_user_can('manage_options') && isset($_GET['debug_bio'])) {
    $bio_value = get_theme_mod('soul_suite_about_owner_bio', 'NO BIO FOUND');
    echo '<!-- BIO DEBUG: ' . esc_html(substr($bio_value, 0, 100)) . '... -->';
    echo '<!-- BIO LENGTH: ' . strlen($bio_value) . ' characters -->';
}

// Get ALL customizer values - NO ESCAPED QUOTES IN DEFAULTS
$hero_bg_image = get_theme_mod('soul_suite_hero_bg_image', 'https://soulsuitewellness.com/wp-content/uploads/2025/07/Home-page.png');
$hero_bg_color = get_theme_mod('soul_suite_hero_bg_color', '#1a4d4d');
$hero_logo_align = get_theme_mod('soul_suite_hero_logo_align', 'center');
$hero_title = get_theme_mod('soul_suite_hero_title', 'Wellness Suite Recovery Portal (WellSR Portal)');
$hero_subtitle = get_theme_mod('soul_suite_hero_subtitle', 'DECODE. DISRUPT. HEAL. EXIT.');
$hero_description = get_theme_mod('soul_suite_hero_description', 'A transformational portal for healthcare and wellness leaders and their teams ready to break free from exhaustion and reclaim sustainable power.');
$hero_btn_text = get_theme_mod('soul_suite_hero_btn_text', 'BOOK A CLARITY CALL');
$hero_btn_url = get_theme_mod('soul_suite_hero_btn_url', '/intake-form/');

$burnout_bg_image = get_theme_mod('soul_suite_burnout_bg_image', '');
$burnout_bg_color = get_theme_mod('soul_suite_burnout_bg_color', '#ffffff');
$burnout_title = get_theme_mod('soul_suite_burnout_title', 'Breaking the Cycle');
$burnout_image = get_theme_mod('soul_suite_burnout_image', 'https://soulsuitewellness.com/wp-content/uploads/2025/07/AdobeStock_187293579_Preview.webp');
$burnout_highlight = get_theme_mod('soul_suite_burnout_highlight', 'ARE YOU CAUGHT IN A CYCLE OF BURNOUT?');
$burnout_content = get_theme_mod('soul_suite_burnout_content', '');

$services_bg_image = get_theme_mod('soul_suite_services_bg_image', '');
$services_bg_color = get_theme_mod('soul_suite_services_bg_color', '#f9f9f9');
$services_title = get_theme_mod('soul_suite_services_title', 'PRODUCTS');

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

$about_bg_image = get_theme_mod('soul_suite_about_bg_image', '');
$about_bg_color = get_theme_mod('soul_suite_about_bg_color', '#ffffff');
$about_content_bg = get_theme_mod('soul_suite_about_content_bg', 'transparent');
$about_image_border = get_theme_mod('soul_suite_about_image_border', '#40e0d0');
$about_text_color = get_theme_mod('soul_suite_about_text_color', '#333333');
$about_title = get_theme_mod('soul_suite_about_title', 'About the Owner');
$about_owner_image = get_theme_mod('soul_suite_about_owner_image', 'https://soulsuitewellness.com/wp-content/uploads/2025/07/IMG-BTM.jpg');
$about_owner_name = get_theme_mod('soul_suite_about_owner_name', 'Soulara Sevier');
$about_owner_title = get_theme_mod('soul_suite_about_owner_title', 'Founder & CEO | Soul Suite Wellness');
$about_owner_bio = get_theme_mod('soul_suite_about_owner_bio', '');

$contact_bg_image = get_theme_mod('soul_suite_contact_bg_image', '');
$contact_bg_color = get_theme_mod('soul_suite_contact_bg_color', '#f9f9f9');
$contact_title = get_theme_mod('soul_suite_contact_title', 'Get in Touch');
$contact_subtitle = get_theme_mod('soul_suite_contact_subtitle', 'We are here to support your wellness journey.');
$contact_email = get_theme_mod('soul_suite_contact_email', 'bewell@soulsuitewellness.com');
$contact_phone = get_theme_mod('soul_suite_contact_phone', '(678) 744-3723');
$contact_address = get_theme_mod('soul_suite_contact_address', 'Atlanta, Georgia, USA');

$merchant_id = get_theme_mod('soul_suite_square_merchant_id', '0ccyiu9cc0ezt1');
$location_id = get_theme_mod('soul_suite_square_location_id', '09TR3SSB0EZ79');

// Build background styles safely
$hero_bg_style = 'background-color: ' . esc_attr($hero_bg_color) . ';';
if ($hero_bg_image) {
    $hero_bg_style .= ' background-image: url(' . esc_url($hero_bg_image) . '); background-size: cover; background-position: center;';
}

$burnout_bg_style = 'background-color: ' . esc_attr($burnout_bg_color) . ';';
if ($burnout_bg_image) {
    $burnout_bg_style .= ' background-image: url(' . esc_url($burnout_bg_image) . '); background-size: cover; background-position: center;';
}

$services_bg_style = 'background-color: ' . esc_attr($services_bg_color) . ';';
if ($services_bg_image) {
    $services_bg_style .= ' background-image: url(' . esc_url($services_bg_image) . '); background-size: cover; background-position: center;';
}

$matrix_bg_style = 'background-color: ' . esc_attr($matrix_bg_color) . '; color: ' . esc_attr($matrix_text_color) . '; text-align: ' . esc_attr($matrix_text_align) . ';';
if ($matrix_bg_image) {
    $matrix_bg_style .= ' background-image: url(' . esc_url($matrix_bg_image) . '); background-size: cover; background-position: center;';
}

$about_bg_style = 'background-color: ' . esc_attr($about_bg_color) . '; color: ' . esc_attr($about_text_color) . ';';
if ($about_bg_image) {
    $about_bg_style .= ' background-image: url(' . esc_url($about_bg_image) . '); background-size: cover; background-position: center;';
}

$contact_bg_style = 'background-color: ' . esc_attr($contact_bg_color) . ';';
if ($contact_bg_image) {
    $contact_bg_style .= ' background-image: url(' . esc_url($contact_bg_image) . '); background-size: cover; background-position: center;';
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
    .system-matrix-point {
        background: <?php echo esc_attr($matrix_point_bg); ?>;
        border-left-color: <?php echo esc_attr($matrix_point_border); ?>;
    }
    .system-matrix-point::before {
        color: <?php echo esc_attr($matrix_point_bullet); ?>;
    }
    
    .hero-logo {
        text-align: <?php echo esc_attr($hero_logo_align); ?> !important;
        display: block !important;
        width: 100% !important;
    }
    .hero-logo img,
    .hero-logo a {
        display: inline-block !important;
    }
    
    .owner-content {
        background-color: <?php echo esc_attr($about_content_bg); ?>;
    }
    .owner-image img {
        border: 4px solid <?php echo esc_attr($about_image_border); ?>;
    }
    </style>
</head>

<body <?php body_class(); ?>>
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

    <section class="burnout-section" style="<?php echo $burnout_bg_style; ?>">
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

    <section class="soul-services" style="<?php echo $services_bg_style; ?>">
        <div class="container">
            <?php if ($services_title): ?>
            <h1><?php echo esc_html($services_title); ?></h1>
            <?php endif; ?>

            <div class="services-grid">
                <?php
                // Loop through 6 services
                for ($i = 1; $i <= 6; $i++) {
                    // Check if service is enabled
                    $enabled = get_theme_mod("soul_suite_service_{$i}_enabled", true);
                    if (!$enabled) continue;
                    
                    // Get all service data from customizer
                    $title = get_theme_mod("soul_suite_service_{$i}_title", '');
                    $tag = get_theme_mod("soul_suite_service_{$i}_tag", '');
                    $image = get_theme_mod("soul_suite_service_{$i}_image", '');
                    $content = get_theme_mod("soul_suite_service_{$i}_content", '');
                    $price = get_theme_mod("soul_suite_service_{$i}_price", '$0.00');
                    $duration = get_theme_mod("soul_suite_service_{$i}_duration", '');
                    $service_id = get_theme_mod("soul_suite_service_{$i}_service_id", '');
                    $is_free = get_theme_mod("soul_suite_service_{$i}_is_free", false);
                    
                    // Skip if no title
                    if (empty($title)) continue;
                    
                    // Build Square booking URL
                    $booking_url = 'https://book.squareup.com/appointments/' . esc_attr($merchant_id) . '/location/' . esc_attr($location_id) . '/services/' . esc_attr($service_id);
                    
                    // Add free-service class conditionally
                    $card_class = $is_free ? 'service-card free-service' : 'service-card';
                    ?>
                    
                    <div class="<?php echo esc_attr($card_class); ?>">
                        <?php if ($image): ?>
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" class="service-image">
                        <?php endif; ?>
                        
                        <div class="service-header">
                            <h2><?php echo esc_html($title); ?></h2>
                            <?php if ($tag): ?>
                            <span class="service-tag"><?php echo esc_html($tag); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($content): ?>
                        <div class="service-content">
                            <?php echo wpautop(wp_kses_post($content)); ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="service-footer">
                            <div class="service-price"><?php echo esc_html($price); ?></div>
                            <?php if ($service_id): ?>
                            <a href="<?php echo esc_url($booking_url); ?>" class="service-btn">
                                Book Now<?php echo $duration ? ' - ' . esc_html($duration) : ''; ?>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                <?php } ?>
            </div>
        </div>
    </section>

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
                
                <?php if ($matrix_point_1 || $matrix_point_2 || $matrix_point_3 || $matrix_point_4): ?>
                <div class="system-matrix-points">
                    <?php if ($matrix_point_1): ?>
                    <div class="system-matrix-point">
                        <div class="system-matrix-point-text"><?php echo wp_kses_post($matrix_point_1); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($matrix_point_2): ?>
                    <div class="system-matrix-point">
                        <div class="system-matrix-point-text"><?php echo wp_kses_post($matrix_point_2); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($matrix_point_3): ?>
                    <div class="system-matrix-point">
                        <div class="system-matrix-point-text"><?php echo wp_kses_post($matrix_point_3); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($matrix_point_4): ?>
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
    <section class="about-owner" style="<?php echo $about_bg_style; ?>">
        <div class="container">
            <?php if ($about_title): ?>
            <h2 class="section-title"><?php echo esc_html($about_title); ?></h2>
            <?php endif; ?>
            
            <div class="owner-content">
                <?php if ($about_owner_image): ?>
                <div class="owner-image">
                    <img src="<?php echo esc_url($about_owner_image); ?>" alt="<?php echo esc_attr($about_owner_name); ?>">
                </div>
                <?php endif; ?>
                
                <div class="owner-info">
                    <div class="owner-credentials">
                        <?php if ($about_owner_name): ?>
                        <h3 class="owner-name"><?php echo esc_html($about_owner_name); ?></h3>
                        <?php endif; ?>
                        
                        <?php if ($about_owner_title): ?>
                        <p class="owner-title"><?php echo esc_html($about_owner_title); ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <?php 
                    // CRITICAL: Check if bio exists and output it
                    if (!empty($about_owner_bio)) : 
                    ?>
                        <div class="owner-bio">
                            <?php echo wpautop(wp_kses_post($about_owner_bio)); ?>
                        </div>
                    <?php else: ?>
                        <!-- BIO IS EMPTY IN CUSTOMIZER -->
                        <?php if (current_user_can('manage_options')): ?>
                            <div class="owner-bio" style="background: #fff3cd; padding: 20px; border-left: 4px solid #ffc107;">
                                <p><strong>⚠️ Admin Notice:</strong> Owner Bio is empty in Customizer. Please add content in <strong>Customize → Home Page Settings → About Owner Section → Owner Bio</strong></p>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if ($hero_btn_text && $hero_btn_url): ?>
                    <div class="cta-section">
                        <a href="<?php echo esc_url($hero_btn_url); ?>" class="hero-btn primary-btn">
                            <?php echo esc_html($hero_btn_text); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
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
                    <?php echo soul_suite_contact_form(); ?>
                </div>
            </div>
        </div>
    </section>

    <?php wp_footer(); ?>
</body>
</html>