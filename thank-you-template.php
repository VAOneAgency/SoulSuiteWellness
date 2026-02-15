<?php
/**
 * Template Name: Thank You Page
 *
 * A custom template for displaying a Thank You page after form submissions.
 *
 * @package SoulSuite
 */

get_header();
?>

<div id="primary" class="content-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <section class="thank-you-page">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e( 'Thank You!', 'soul-suite' ); ?></h1>
                    </header><!-- .page-header -->

                    <div class="page-content">
                        <p><?php esc_html_e( 'Your submission has been received. We will get back to you shortly.', 'soul-suite' ); ?></p>
                    </div><!-- .page-content -->
                </section><!-- .thank-you-page -->
            </div>
        </div>
    </div>
</div><!-- #primary -->

<?php
get_footer();