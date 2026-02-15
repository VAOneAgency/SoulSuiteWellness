<?php
/**
 * Template Part: Matrix/System Reset Section
 * 
 * @package SoulSuite
 */

$matrix_title = get_option('soul_suite_matrix_title', 'Your System Reset');
$matrix_subtitle = get_option('soul_suite_matrix_subtitle');
$matrix_content = get_option('soul_suite_matrix_content');
$matrix_points = get_option('soul_suite_matrix_points', array());

// Default points if none configured
if (empty($matrix_points)) {
    $matrix_points = array(
        '✓ Release accumulated stress and tension',
        '✓ Restore your natural energy flow',
        '✓ Reset your nervous system',
        '✓ Reconnect with your authentic self',
    );
}
?>

<section class="system-reset-section">
    <div class="container">
        <div class="system-reset-content">
            <?php if ($matrix_title): ?>
                <h1 class="reset-title"><?php echo esc_html($matrix_title); ?></h1>
            <?php endif; ?>
            
            <?php if ($matrix_subtitle): ?>
                <p class="reset-subtitle"><?php echo esc_html($matrix_subtitle); ?></p>
            <?php endif; ?>
            
            <div class="system-matrix">
                <?php if ($matrix_content): ?>
                    <div class="system-matrix-intro">
                        <?php echo wpautop($matrix_content); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($matrix_points)): ?>
                    <div class="system-matrix-points">
                        <?php foreach ($matrix_points as $point): ?>
                            <div class="system-matrix-point">
                                <div class="system-matrix-point-text">
                                    <?php echo wp_kses_post($point); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="system-reset-conclusion">
                <p class="reset-conclusion-text">
                    This is your invitation to step out of survival mode and into a life of authentic wellness. 
                    Your system reset begins with a single decision.
                </p>
                <span class="reset-conclusion-emphasis">
                    Are you ready to reclaim your power?
                </span>
            </div>
            
            <div class="system-reset-cta">
                <?php 
                $btn_text = get_option('soul_suite_btn_primary_text', 'Begin Your Reset');
                $btn_url = get_option('soul_suite_btn_primary_url', function_exists('soul_suite_get_square_url') ? soul_suite_get_square_url('individual') : '#');
                ?>
                <a href="<?php echo esc_url($btn_url); ?>" class="hero-btn primary-btn">
                    <?php echo esc_html($btn_text); ?>
                </a>
            </div>
        </div>
    </div>
</section>
