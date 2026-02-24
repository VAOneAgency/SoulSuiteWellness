<?php
/**
 * Services Section
 * 100% Customizer Driven - Matches Landing Page Style
 * 
 * @package SoulSuite
 */

// Get section settings
$services_title = get_theme_mod('soul_suite_services_title', 'PRODUCTS');
$services_bg_color = get_theme_mod('soul_suite_services_bg_color', '#f9f9f9');
$services_bg_image = get_theme_mod('soul_suite_services_bg_image');

// Square configuration
$merchant_id = get_theme_mod('soul_suite_square_merchant_id', '0ccyiu9cc0ezt1');
$location_id = get_theme_mod('soul_suite_square_location_id', '09TR3SSB0EZ79');

// Build background style
$services_bg_style = 'background-color: ' . esc_attr($services_bg_color) . ';';
if ($services_bg_image) {
    $services_bg_style .= ' background-image: url(' . esc_url($services_bg_image) . '); background-size: cover; background-position: center;';
}
?>

<section class="soul-services" style="<?php echo $services_bg_style; ?>">
<style>
.soul-services .service-card {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    border-left: 6px solid <?php echo esc_attr(get_theme_mod('soul_suite_service_card_border_left') ?: 'var(--color-teal)'); ?>;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 400px;
    position: relative;
    overflow: hidden;
}

.soul-services .service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
}

.soul-services .service-header h2 {
    color: <?php echo esc_attr(get_theme_mod('soul_suite_service_title_color', '#333333')); ?>;
    font-size: <?php echo esc_attr(get_theme_mod('soul_suite_service_title_font_size', '24')); ?>px;
    font-weight: <?php echo esc_attr(get_theme_mod('soul_suite_service_title_font_weight', '600')); ?>;
}

.soul-services .service-tag {
    background-color: <?php echo esc_attr(get_theme_mod('soul_suite_service_tag_custom_bg') ?: get_theme_mod('soul_suite_service_tag_bg_color', '#40e0d0')); ?>;
    color: <?php echo esc_attr(get_theme_mod('soul_suite_service_tag_text_color', '#ffffff')); ?>;
    font-size: <?php echo esc_attr(get_theme_mod('soul_suite_service_tag_font_size', '12')); ?>px;
    border-radius: <?php echo esc_attr(get_theme_mod('soul_suite_service_tag_border_radius', '4')); ?>px;
    padding: 4px 12px;
    display: inline-block;
    margin-top: 8px;
}

.soul-services .service-content {
    color: <?php echo esc_attr(get_theme_mod('soul_suite_service_content_color', '#666666')); ?>;
    font-size: <?php echo esc_attr(get_theme_mod('soul_suite_service_content_font_size', '15')); ?>px;
    line-height: <?php echo esc_attr(get_theme_mod('soul_suite_service_content_line_height', '1.6')); ?>;
}

.soul-services .service-price {
    color: <?php echo esc_attr(get_theme_mod('soul_suite_service_price_custom_color') ?: get_theme_mod('soul_suite_service_price_color', '#ff5b0c')); ?>;
    font-size: <?php echo esc_attr(get_theme_mod('soul_suite_service_price_font_size', '28')); ?>px;
    font-weight: <?php echo esc_attr(get_theme_mod('soul_suite_service_price_font_weight', '700')); ?>;
}

<?php if (get_theme_mod('soul_suite_service_btn_use_global', true)): ?>
    .soul-services .service-btn {
        background: var(--gradient-primary);
        color: var(--color-white);
        padding: 12px 30px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .soul-services .service-btn:hover {
        background: var(--gradient-primary-hover);
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
    }
<?php else: 
    $custom_btn_bg = get_theme_mod('soul_suite_service_btn_custom_bg', '#40e0d0');
?>
    .soul-services .service-btn {
        background: <?php echo esc_attr($custom_btn_bg); ?>;
        color: var(--color-white);
        padding: 12px 30px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .soul-services .service-btn:hover {
        filter: brightness(0.9);
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
    }
<?php endif; ?>
</style>
    <div class="container">
        <?php if ($services_title): ?>
        <h1><?php echo esc_html($services_title); ?></h1>
        <?php endif; ?>

        <div class="services-grid">
            <?php
            $services_count = 0;
            
            // Loop through 6 services
            for ($i = 1; $i <= 6; $i++) {
                // Check if service is enabled (default TRUE)
                $enabled = get_theme_mod("soul_suite_service_{$i}_enabled", true);
                
                if (!$enabled) {
                    if (current_user_can('manage_options')) {
                        echo "<!-- Service {$i}: DISABLED -->";
                    }
                    continue;
                }
                
                // Get service title FIRST to check if service exists
                $title = get_theme_mod("soul_suite_service_{$i}_title", '');
                
                // Skip if no title (service doesn't exist)
                if (empty($title)) {
                    if (current_user_can('manage_options')) {
                        echo "<!-- Service {$i}: NO TITLE (skipped) -->";
                    }
                    continue;
                }
                
                // Service exists! Now get the rest of the data
                $tag = get_theme_mod("soul_suite_service_{$i}_tag", '');
                $image = get_theme_mod("soul_suite_service_{$i}_image", '');
                $content = get_theme_mod("soul_suite_service_{$i}_content", '');
                $price = get_theme_mod("soul_suite_service_{$i}_price", '');
                $duration = get_theme_mod("soul_suite_service_{$i}_duration", '');
                $service_id = get_theme_mod("soul_suite_service_{$i}_service_id", '');
                $is_free = get_theme_mod("soul_suite_service_{$i}_is_free", false);
                
                $services_count++;
                
                // Build Square booking URL
                $booking_url = "https://book.squareup.com/appointments/{$merchant_id}/location/{$location_id}/services/{$service_id}";
                
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
                
            <?php } // end for loop ?>
            
            <?php if ($services_count === 0 && current_user_can('manage_options')): ?>
                <div style="background: #f8d7da; border: 2px solid #dc3545; padding: 30px; margin: 20px; border-radius: 8px; text-align: center;">
                    <h3 style="color: #721c24; margin-top: 0;">🚨 NO SERVICES DISPLAYED!</h3>
                    <p><strong>Services counted: <?php echo $services_count; ?></strong></p>
                    <p>The emergency fix function should have saved all 6 services. Let's check:</p>
                    <ul style="list-style: none; padding: 0; margin: 20px 0;">
                        <?php for ($x = 1; $x <= 6; $x++): 
                            $test_title = get_theme_mod("soul_suite_service_{$x}_title", '');
                            $test_enabled = get_theme_mod("soul_suite_service_{$x}_enabled", true);
                        ?>
                        <li style="margin: 5px 0;">Service <?php echo $x; ?>: 
                            <?php if (!$test_enabled): ?>
                                <strong style="color: #dc3545;">❌ DISABLED</strong>
                            <?php elseif (empty($test_title)): ?>
                                <strong style="color: #856404;">⚠️ EMPTY TITLE</strong>
                            <?php else: ?>
                                <strong style="color: #155724;">✅ "<?php echo esc_html(substr($test_title, 0, 40)); ?>..."</strong>
                            <?php endif; ?>
                        </li>
                        <?php endfor; ?>
                    </ul>
                    <p style="margin-top: 20px;">
                        <strong>Did you load an admin page after adding the emergency fix?</strong><br>
                        <a href="<?php echo admin_url(); ?>" class="button button-primary" style="margin: 10px 5px;">Go to Dashboard</a>
                        <a href="<?php echo admin_url('customize.php?autofocus[section]=soul_suite_services_section'); ?>" class="button" style="margin: 10px 5px;">Open Customizer</a>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>