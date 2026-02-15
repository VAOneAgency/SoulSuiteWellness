<?php

// Get ALL values from Customizer - absolute source of truth
$hero_bg_image = get_option('soul_suite_hero_bg_image');
$hero_bg_color = get_option('soul_suite_hero_bg_color', '#1a4d4d');
$hero_title = get_option('soul_suite_hero_title', 'Wellness Suite Recovery Portal™ (WellSR Portal)');
$hero_subtitle = get_option('soul_suite_hero_subtitle', 'DECODE. DISRUPT. HEAL. EXIT.');
$hero_description = get_option('soul_suite_hero_description');
$hero_btn_text = get_option('soul_suite_hero_btn_text', 'BOOK A CLARITY CALL');
$hero_btn_url = get_option('soul_suite_hero_btn_url', '/intake-form/');

$burnout_bg_image = get_option('soul_suite_burnout_bg_image');
$burnout_bg_color = get_option('soul_suite_burnout_bg_color', '#ffffff');
$burnout_title = get_option('soul_suite_burnout_title', 'Breaking the Cycle');
$burnout_image = get_option('soul_suite_burnout_image');
$burnout_highlight = get_option('soul_suite_burnout_highlight', 'ARE YOU CAUGHT IN A CYCLE OF BURNOUT?');
$burnout_content = get_option('soul_suite_burnout_content');

$services_bg_image = get_option('soul_suite_services_bg_image');
$services_bg_color = get_option('soul_suite_services_bg_color', '#f9f9f9');
$services_title = get_option('soul_suite_services_title', 'PRODUCTS');

$matrix_bg_image = get_option('soul_suite_matrix_bg_image');
$matrix_bg_color = get_option('soul_suite_matrix_bg_color', '#1a4d4d');
$matrix_title = get_option('soul_suite_matrix_title');
$matrix_intro = get_option('soul_suite_matrix_intro');
$matrix_point_1 = get_option('soul_suite_matrix_point_1');
$matrix_point_2 = get_option('soul_suite_matrix_point_2');
$matrix_point_3 = get_option('soul_suite_matrix_point_3');
$matrix_point_4 = get_option('soul_suite_matrix_point_4');
$matrix_note = get_option('soul_suite_matrix_note');
$matrix_conclusion = get_option('soul_suite_matrix_conclusion');
$matrix_cta_text = get_option('soul_suite_matrix_cta_text', 'Let\'s Have a Conversation');

$about_bg_image = get_option('soul_suite_about_bg_image');
$about_bg_color = get_option('soul_suite_about_bg_color', '#ffffff');
$about_title = get_option('soul_suite_about_title', 'About the Owner');
$about_owner_image = get_option('soul_suite_about_owner_image');
$about_owner_name = get_option('soul_suite_about_owner_name', 'Soulara Sevier');
$about_owner_title = get_option('soul_suite_about_owner_title');
$about_owner_bio = get_option('soul_suite_about_owner_bio');

$contact_bg_image = get_option('soul_suite_contact_bg_image');
$contact_bg_color = get_option('soul_suite_contact_bg_color', '#f9f9f9');
$contact_title = get_option('soul_suite_contact_title', 'Get in Touch');
$contact_subtitle = get_option('soul_suite_contact_subtitle');
$contact_email = get_option('soul_suite_contact_email', 'bewell@soulsuitewellness.com');
$contact_phone = get_option('soul_suite_contact_phone', '(678) 744-3723');
$contact_address = get_option('soul_suite_contact_address', 'Atlanta, Georgia, USA');

$merchant_id = get_option('soul_suite_square_merchant_id', '0ccyiu9cc0ezt1');
$location_id = get_option('soul_suite_square_location_id', '09TR3SSB0EZ79');

// Build background styles
$hero_bg_style = '';
if ($hero_bg_image) {
    $hero_bg_style .= "background-image: url('" . esc_url($hero_bg_image) . "'); background-size: cover; background-position: center;";
}
$hero_bg_style .= " background-color: " . esc_attr($hero_bg_color) . ";";

$burnout_bg_style = '';
if ($burnout_bg_image) {
    $burnout_bg_style .= "background-image: url('" . esc_url($burnout_bg_image) . "'); background-size: cover; background-position: center;";
}
$burnout_bg_style .= " background-color: " . esc_attr($burnout_bg_color) . ";";

$services_bg_style = '';
if ($services_bg_image) {
    $services_bg_style .= "background-image: url('" . esc_url($services_bg_image) . "'); background-size: cover; background-position: center;";
}
$services_bg_style .= " background-color: " . esc_attr($services_bg_color) . ";";

$matrix_bg_style = '';
if ($matrix_bg_image) {
    $matrix_bg_style .= "background-image: url('" . esc_url($matrix_bg_image) . "'); background-size: cover; background-position: center;";
}
$matrix_bg_style .= " background-color: " . esc_attr($matrix_bg_color) . ";";

$about_bg_style = '';
if ($about_bg_image) {
    $about_bg_style .= "background-image: url('" . esc_url($about_bg_image) . "'); background-size: cover; background-position: center;";
}
$about_bg_style .= " background-color: " . esc_attr($about_bg_color) . ";";

$contact_bg_style = '';
if ($contact_bg_image) {
    $contact_bg_style .= "background-image: url('" . esc_url($contact_bg_image) . "'); background-size: cover; background-position: center;";
}
$contact_bg_style .= " background-color: " . esc_attr($contact_bg_color) . ";";
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
</head>

<body <?php body_class(); ?>>
    <!-- Hero Section - 100% DYNAMIC -->
    <section class="hero-section" style="<?php echo $hero_bg_style; ?>">
        <div class="container">
            <div class="hero-content">
                <div class="hero-logo">
                    <?php 
                    if (has_custom_logo()) {
                        the_custom_logo();
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

    <!-- Burnout Section - 100% DYNAMIC -->
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

    <!-- Services Section - 100% DYNAMIC -->
    <section class="soul-services" style="<?php echo $services_bg_style; ?>">
        <div class="container">
            <?php if ($services_title): ?>
            <h1><?php echo esc_html($services_title); ?></h1>
            <?php endif; ?>

            <div class="services-grid">
                <!-- Individual Strategy Call -->
                <div class="service-card free-service">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/individual.png" alt="Individual Strategy Call" class="service-image">
                    <div class="service-header">
                        <h2>𝗦𝗼𝘂𝗹𝗳𝘂𝗹 𝗦𝘁𝗿𝗮𝘁𝗲𝗴𝘆 𝗖𝗮𝗹𝗹</h2>
                        <span class="service-tag">Individuals ONLY</span>
                    </div>
                    <div class="service-content">
                        <p>𝗡𝗼𝘁𝗵𝗶𝗻𝗴 𝗵𝗮𝗽𝗽𝗲𝗻𝘀 𝗯𝘆 𝗮𝗰𝗰𝗶𝗱𝗲𝗻𝘁—our paths have crossed for a reason, guided by energy and alignment.</p>
                        <p>This free 15-minute call is a sacred space for individuals ready to release stress, realign emotionally, and explore their deeper purpose in a supportive, soulful way.</p>
                        <p>Ready to be seen, heard, and supported on your wellness journey? Let's begin.</p>
                    </div>
                    <div class="service-footer">
                        <div class="service-price">$0.00</div>
                        <a href="https://book.squareup.com/appointments/<?php echo esc_attr($merchant_id); ?>/location/<?php echo esc_attr($location_id); ?>/services/GJZY3CEHIIJR6XSGCXQR6D6P" class="service-btn">Book Now - 15 mins</a>
                    </div>
                </div>

                <!-- Business Strategy Call -->
                <div class="service-card free-service">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/business_call.png" alt="Business Strategy Call" class="service-image">
                    <div class="service-header">
                        <h2>𝗦𝗼𝘂𝗹𝗳𝘂𝗹 𝗦𝘁𝗿𝗮𝘁𝗲𝗴𝘆 𝗖𝗮𝗹𝗹</h2>
                        <span class="service-tag">Businesses ONLY</span>
                    </div>
                    <div class="service-content">
                        <p>This 30-minute call is a chance to align your wellness goals with Soul Reiki's holistic offerings for teams and organizations.</p>
                        <p>Explore services like energy healing, resilience training, and workplace wellness support.</p>
                        <p>Let's co-create a more balanced, empowered culture—book today.</p>
                    </div>
                    <div class="service-footer">
                        <div class="service-price">$0.00</div>
                        <a href="https://book.squareup.com/appointments/<?php echo esc_attr($merchant_id); ?>/location/<?php echo esc_attr($location_id); ?>/services/HWYWQ6UMI4Q34K3TM27C7EU4" class="service-btn">Book Now - 30 mins</a>
                    </div>
                </div>

                <!-- Virtual Reiki -->
                <div class="service-card">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/𝗩𝗶𝗿𝘁𝘂𝗮𝗹-𝗥𝗲𝗶𝗸𝗶-𝗦𝗲𝘀𝘀𝗶𝗼𝗻.png" alt="Virtual Reiki" class="service-image">
                    <div class="service-header">
                        <h2>𝗩𝗶𝗿𝘁𝘂𝗮𝗹 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝘀𝘀𝗶𝗼𝗻</h2>
                    </div>
                    <div class="service-content">
                        <p>Experience the healing power of Reiki—virtually. This gentle energy practice works across distance to help release blockages and restore mind-body-spirit balance.</p>
                        <p>Relax in your own space as healing energy, intuitive channeling, and optional crystal support guide you toward clarity and renewal.</p>
                        <p>Ready to receive deep healing from wherever you are? Book your session today.</p>
                    </div>
                    <div class="service-footer">
                        <div class="service-price">$111.00</div>
                        <a href="https://book.squareup.com/appointments/<?php echo esc_attr($merchant_id); ?>/location/<?php echo esc_attr($location_id); ?>/services/U43Y7M73OO622DHKS3CUD42L" class="service-btn">Book Now - 1 hr</a>
                    </div>
                </div>

                <!-- Mobile Reiki South Atlanta -->
                <div class="service-card">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/mobile-rekii.png" alt="Mobile Reiki South Atlanta" class="service-image">
                    <div class="service-header">
                        <h2>𝗠𝗼𝗯𝗶𝗹𝗲 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝗿𝘃𝗶𝗰𝗲</h2>
                        <span class="service-tag">South Atlanta</span>
                    </div>
                    <div class="service-content">
                        <p>Experience the healing power of in-person Reiki—a gentle energy practice that helps restore balance in your body, mind, and spirit.</p>
                        <p>Each session may include intuitive channeling and crystal healing to help you feel clear, centered, and renewed.</p>
                        <p>Based in Metro Atlanta. Ready to reconnect and realign? Book your session today.</p>
                    </div>
                    <div class="service-footer">
                        <div class="service-price">$111.00</div>
                        <a href="https://book.squareup.com/appointments/<?php echo esc_attr($merchant_id); ?>/location/<?php echo esc_attr($location_id); ?>/services/YXCE5X5HUZRMBOBURHCYPYGS" class="service-btn">Book Now - 1 hr</a>
                    </div>
                </div>

                <!-- Mobile Reiki Metro Atlanta -->
                <div class="service-card">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/Mobile-Rei.png" alt="Mobile Reiki Metro Atlanta" class="service-image">
                    <div class="service-header">
                        <h2>𝗠𝗼𝗯𝗶𝗹𝗲 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝗿𝘃𝗶𝗰𝗲</h2>
                        <span class="service-tag">Metro Atlanta</span>
                    </div>
                    <div class="service-content">
                        <p>In-person Reiki offers a powerful way to restore balance in your body, mind, and spirit through gentle energy healing.</p>
                        <p>Sessions may include intuitive channeling and crystal healing to help you release blockages and reconnect with your true self.</p>
                        <p>Serving Metro Atlanta. Ready to feel clear, aligned, and renewed? Book today.</p>
                    </div>
                    <div class="service-footer">
                        <div class="service-price">$144.00</div>
                        <a href="https://book.squareup.com/appointments/<?php echo esc_attr($merchant_id); ?>/location/<?php echo esc_attr($location_id); ?>/services/2OIBU3CYV3YAZ47L2YXJTAVP" class="service-btn">Book Now - 1 hr</a>
                    </div>
                </div>

                <!-- Extended Mobile Reiki -->
                <div class="service-card">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/30mile.png" alt="Extended Mobile Reiki" class="service-image">
                    <div class="service-header">
                        <h2>𝗠𝗼𝗯𝗶𝗹𝗲 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝗿𝘃𝗶𝗰𝗲</h2>
                        <span class="service-tag">Up to 30 Miles Outside Metro Atlanta</span>
                    </div>
                    <div class="service-content">
                        <p>Discover the healing power of in-person Reiki—a gentle, energy-based practice designed to clear blockages and restore balance in your body, mind, and spirit.</p>
                        <p>Ready to reconnect with your center? Book now and take the first step toward clarity and peace.</p>
                    </div>
                    <div class="service-footer">
                        <div class="service-price">$222.00</div>
                        <a href="https://book.squareup.com/appointments/<?php echo esc_attr($merchant_id); ?>/location/<?php echo esc_attr($location_id); ?>/services/GISRJASPYOZGFQIPTRV35KZO" class="service-btn">Book Now - 1 hr</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- System Reset/Matrix Section - 100% DYNAMIC -->
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
                        <p><?php echo wp_kses_post($matrix_point_1); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($matrix_point_2): ?>
                    <div class="system-matrix-point">
                        <p><?php echo wp_kses_post($matrix_point_2); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($matrix_point_3): ?>
                    <div class="system-matrix-point">
                        <p><?php echo wp_kses_post($matrix_point_3); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($matrix_point_4): ?>
                    <div class="system-matrix-point">
                        <p><?php echo wp_kses_post($matrix_point_4); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <?php if ($matrix_note): ?>
                <p class="reset-note"><?php echo esc_html($matrix_note); ?></p>
                <?php endif; ?>
                
                <?php if ($matrix_conclusion): ?>
                <p class="reset-conclusion-text"><?php echo esc_html($matrix_conclusion); ?></p>
                <?php endif; ?>
                
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

    <!-- About Owner Section - 100% DYNAMIC -->
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
                    
                    <?php if ($about_owner_bio): ?>
                    <div class="owner-bio">
                        <?php echo wpautop(wp_kses_post($about_owner_bio)); ?>
                    </div>
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

    <!-- Contact Section - 100% DYNAMIC -->
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
                    <?php echo do_shortcode('[contact-form-7 id="YOUR_FORM_ID" title="Contact form 1"]'); ?>
                </div>
            </div>
        </div>
    </section>

    <?php wp_footer(); ?>
</body>
</html>