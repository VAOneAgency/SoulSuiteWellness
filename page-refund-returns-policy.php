<?php
/**
 * Template Name: Refund and Returns Policy
 */
get_header();
?>
<main id="main" class="site-main refund-policy-page">
    <section class="refund-section">
        <div class="container">
            <h1><?php echo esc_html(get_theme_mod('soul_suite_refund_title', 'Refund and Returns Policy')); ?></h1>
            <div class="refund-content">
                <?php echo wpautop(wp_kses_post(get_theme_mod('soul_suite_refund_content', 'Please contact us for refund and return information.'))); ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
