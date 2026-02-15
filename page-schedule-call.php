<?php
/**
 * Template Name: Schedule a Call
 *
 * Displays a scheduling page (e.g., Calendly embed or Squarespace link).
 */
get_header();
?>
<main id="main" class="site-main schedule-call-page">
    <section class="schedule-section">
        <div class="container">
            <h1><?php echo esc_html( get_theme_mod('ssw_schedule_title', 'Schedule a Call') ); ?></h1>
            <div class="schedule-content">
                <?php echo do_shortcode('[ssw_schedule_form]'); ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
