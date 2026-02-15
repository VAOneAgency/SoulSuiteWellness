<?php
/**
 * Template Part: Burnout/Breaking the Cycle Section
 * 
 * @package SoulSuite
 */

// Get values from customizer (if they exist)
$burnout_bg_image = get_option('soul_suite_burnout_bg_image');
$burnout_bg_color = get_option('soul_suite_burnout_bg_color', '#ffffff');
$burnout_title = get_option('soul_suite_burnout_title', 'Breaking the Cycle');

// Build background style
$bg_style = '';
if ($burnout_bg_image) {
    $bg_style .= "background-image: url('" . esc_url($burnout_bg_image) . "'); background-size: cover; background-position: center;";
}
$bg_style .= " background-color: " . esc_attr($burnout_bg_color) . ";";
?>

<section class="burnout-section" style="<?php echo $bg_style; ?>">
    <div class="container">
        <?php if ($burnout_title): ?>
        <h2 class="section-title"><?php echo esc_html($burnout_title); ?></h2>
        <?php endif; ?>
        
        <div class="burnout-content">
            <div class="burnout-image">
                <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/AdobeStock_187293579_Preview.webp" alt="Wellness candles representing peace and transformation">
            </div>
            
            <div class="burnout-text">
                <div class="burnout-highlight">
                    <h3>ARE YOU CAUGHT IN A CYCLE OF BURNOUT?</h3>
                </div>
                
                <p>If you're a healthcare executive, wellness leader, provider, or purpose-driven organization constantly pushing through stress, high turnover, and silent suffering—you're not alone.</p>
                
                <p>The cycle of burnout is an invisible system of over-functioning, people-pleasing, emotional suppression, and energetic depletion.</p>
                
                <p>This isn't about managing stress. It's about <strong>dismantling the system</strong> that's keeping your team stuck in survival mode.</p>
                
                <div class="burnout-cta">
                    <a href="<?php echo esc_url(get_option('soul_suite_hero_btn_url', '/intake-form/')); ?>" class="hero-btn primary-btn">
                        <?php echo esc_html(get_option('soul_suite_hero_btn_text', 'Book a Clarity Call')); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>>
