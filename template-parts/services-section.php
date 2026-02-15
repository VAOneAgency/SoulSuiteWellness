<?php
/**
 * Services Section Partial
 * Driven 100% by Customizer - Enhanced Version
 */
?>
<section class="services-section"
    style="
        background-color: <?php echo esc_attr( get_theme_mod('soul_suite_services_bg_color', '#f9f9f9') ); ?>;
        <?php if ( get_theme_mod('soul_suite_services_bg_image') ) : ?>
            background-image: url('<?php echo esc_url( get_theme_mod('soul_suite_services_bg_image') ); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        <?php endif; ?>
    "
>
    <div class="container">
        <?php if ( get_theme_mod('soul_suite_services_title') ) : ?>
            <h2 class="section-title">
                <?php echo esc_html( get_theme_mod('soul_suite_services_title', 'PRODUCTS') ); ?>
            </h2>
        <?php endif; ?>
        
        <div class="services-list">
            <?php 
            // Loop through all 6 services
            for ($i = 1; $i <= 6; $i++) : 
                // Skip if service is disabled
                if (!get_theme_mod("soul_suite_service_{$i}_enabled", true)) {
                    continue;
                }
                
                // Get all service data from customizer
                $title      = get_theme_mod("soul_suite_service_{$i}_title", '');
                $tag        = get_theme_mod("soul_suite_service_{$i}_tag", '');
                $image      = get_theme_mod("soul_suite_service_{$i}_image", '');
                $content    = get_theme_mod("soul_suite_service_{$i}_content", '');
                $price      = get_theme_mod("soul_suite_service_{$i}_price", '');
                $duration   = get_theme_mod("soul_suite_service_{$i}_duration", '');
                $service_id = get_theme_mod("soul_suite_service_{$i}_service_id", '');
                $is_free    = get_theme_mod("soul_suite_service_{$i}_is_free", false);
                
                // Skip if no title (minimum requirement)
                if (empty($title)) {
                    continue;
                }
            ?>
                <div class="service-item" data-service-id="<?php echo esc_attr($service_id); ?>">
                    
                    <?php if (!empty($image)): ?>
                        <div class="service-image">
                            <img src="<?php echo esc_url($image); ?>" 
                                 alt="<?php echo esc_attr($title); ?>"
                                 loading="lazy">
                        </div>
                    <?php endif; ?>
                    
                    <div class="service-content">
                        <?php if (!empty($tag)): ?>
                            <span class="service-tag">
                                <?php echo esc_html($tag); ?>
                            </span>
                        <?php endif; ?>
                        
                        <h3 class="service-title">
                            <?php echo esc_html($title); ?>
                        </h3>
                        
                        <?php if (!empty($content)): ?>
                            <div class="service-description">
                                <?php echo wpautop( wp_kses_post($content) ); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="service-meta">
                            <?php if (!empty($price)): ?>
                                <span class="service-price">
                                    <i class="fa fa-tag" aria-hidden="true"></i>
                                    <?php echo esc_html($price); ?>
                                </span>
                            <?php endif; ?>
                            
                            <?php if (!empty($duration)): ?>
                                <span class="service-duration">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    <?php echo esc_html($duration); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <?php if (!empty($service_id)): 
                            $merchant_id = get_theme_mod('soul_suite_square_merchant_id', '0ccyiu9cc0ezt1');
                            $location_id = get_theme_mod('soul_suite_square_location_id', '09TR3SSB0EZ79');
                            
                            if (!empty($merchant_id) && !empty($location_id)) {
                                $booking_url = "https://book.squareup.com/appointments/{$merchant_id}/location/{$location_id}/services/{$service_id}";
                            ?>
                                <a href="<?php echo esc_url($booking_url); ?>" 
                                   class="btn primary-btn service-book-btn <?php echo $is_free ? 'free-service' : ''; ?>"
                                   target="_blank" 
                                   rel="noopener noreferrer">
                                   <?php echo $is_free ? 'Book Free Call' : 'Book Now'; ?>
                                </a>
                            <?php 
                            }
                        endif; ?>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
