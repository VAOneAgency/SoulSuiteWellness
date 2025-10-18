<?php
/**
Template Name: Full Width
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package monalisa
 */

get_header();
monalisa_single_banner();
?>

	<div id="blog" class="content-area">
		<div id="main" class="site-main">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<?php
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/content', 'page' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
						?>					
					</div>
				</div>
			</div>
			
		</div><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
