<?php
/**
 * Template Part: CTA (Call to Action) Section
 * 
 * @package SoulSuite
 */

$btn_text = get_option('soul_suite_btn_primary_text', 'Book Your Session');
$btn_url = get_option('soul_suite_btn_primary_url', function_exists('soul_suite_get_square_url') ? soul_suite_get_square_url('individual') : '#');
$btn_style = get_option('soul_suite_btn_primary_style', 'primary');
?>

<section class="cta-section">
	<div class="container">
		<div class="cta-content">
			<h2>Ready to Begin Your Wellness Journey?</h2>
			<p>Take the first step towards a healthier, more balanced you.</p>
			<a href="<?php echo esc_url($btn_url); ?>" class="hero-btn <?php echo esc_attr($btn_style); ?>-btn">
				<?php echo esc_html($btn_text); ?>
			</a>
		</div>
	</div>
</section>
