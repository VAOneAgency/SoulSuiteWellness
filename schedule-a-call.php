<?php
/**
 * Template Name: Schedule a Call
 * 
 * Displays intake form with Calendly/Square booking
 * 
 * @package SoulSuite
 */

get_header();
?>

<div id="primary" class="content-area schedule-call-page">
    <main id="main" class="site-main">
        
        <div class="page-header">
            <div class="container">
                <h1><?php the_title(); ?></h1>
                <?php if (get_the_content()): ?>
                    <div class="page-intro">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Display the Soul Suite intake form
                    // You can customize which form appears here
                    echo do_shortcode('[soul_suite_form slug="intake-form"]');
                    ?>
                </div>
            </div>
        </div>
        
    </main>
</div>

<?php
get_footer();
