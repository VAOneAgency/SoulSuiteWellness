<?php
/**
 * Services Section
 * Displays services from WordPress Customizer
 * Navigate to: Appearance → Customize → Home Page Settings → Services Section
 * 
 * @package SoulSuite
 */

// Get section settings
$services_title = get_theme_mod('soul_suite_services_title', 'Our Services');
$bg_color = get_theme_mod('soul_suite_services_bg_color', '#f9f9f9');
$bg_image = get_theme_mod('soul_suite_services_bg_image');

// Square Appointments configuration
$merchant_id = get_theme_mod('soul_suite_square_merchant_id', '0ccyiu9cc0ezt1');
$location_id = get_theme_mod('soul_suite_square_location_id', '09TR3SSB0EZ79');
?>


<section class="services-section" id="services"
    style="
        background-color: <?php echo esc_attr($bg_color); ?>;
        <?php if ($bg_image): ?>
            background-image: url('<?php echo esc_url($bg_image); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        <?php endif; ?>
    ">
    <div class="container">
        <?php if ($services_title): ?>
            <div class="section-title text-center">
                <h2 class="wow fadeInUp"><?php echo esc_html($services_title); ?></h2>
            </div>
        <?php endif; ?>

        <div class="services-grid">
            <?php 
            // Loop through all 6 services
            for ($i = 1; $i <= 6; $i++) {
                // Check if service is enabled
                $enabled = get_theme_mod("soul_suite_service_{$i}_enabled", true);
                if (!$enabled) {
                    continue;
                }

                // Get service data from customizer
                $title = get_theme_mod("soul_suite_service_{$i}_title");
                $tag = get_theme_mod("soul_suite_service_{$i}_tag");
                $image = get_theme_mod("soul_suite_service_{$i}_image");
                $content = get_theme_mod("soul_suite_service_{$i}_content");
                $price = get_theme_mod("soul_suite_service_{$i}_price");
                $duration = get_theme_mod("soul_suite_service_{$i}_duration");
                $service_id = get_theme_mod("soul_suite_service_{$i}_service_id");
                $is_free = get_theme_mod("soul_suite_service_{$i}_is_free", false);

                // Skip if no title
                if (empty($title)) {
                    continue;
                }

                // Generate Square booking URL
                $booking_url = '';
                if (!empty($service_id)) {
                    $booking_url = "https://book.squareup.com/appointments/{$merchant_id}/{$location_id}/services/{$service_id}";
                }
                ?>
                <div class="service-card wow fadeInUp" data-wow-delay="<?php echo ($i * 0.1); ?>s">
                    <?php if ($image): ?>
                        <img src="<?php echo esc_url($image); ?>" 
                             alt="<?php echo esc_attr($title); ?>" 
                             class="service-image">
                    <?php endif; ?>

                    <div class="service-header">
                        <h3><?php echo esc_html($title); ?></h3>
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
                        <?php if ($price): ?>
                            <div class="service-price <?php echo $is_free ? 'free-service' : ''; ?>">
                                <?php echo esc_html($price); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($booking_url): ?>
                            <a href="<?php echo esc_url($booking_url); ?>" 
                               class="service-btn" 
                               target="_blank" 
                               rel="noopener noreferrer">
                                <i class="fa fa-calendar"></i> 
                                <?php echo $is_free ? 'Book Free Call' : 'Book Now'; ?>
                                <?php if ($duration): ?>
                                    <span class="btn-duration"> - <?php echo esc_html($duration); ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            } // end for loop
            ?>
        </div>

        <?php if (current_user_can('manage_options')): ?>
            <div style="background: #fff3cd; border: 1px solid #ffc107; padding: 15px; margin-top: 30px; border-radius: 5px;">
                <strong>Admin Notice:</strong> No services displaying? 
                <a href="<?php echo admin_url('customize.php?autofocus[section]=soul_suite_services_section'); ?>">
                    Click here to configure services in the Customizer
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>
