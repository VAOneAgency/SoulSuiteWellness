<?php
/**
 * Template Name: KC Template
 *
 * 
 * @package monalisa
 */

get_header(); 


?>
		<div class="clearfix"></div>

		<div id="kc_page_template">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; // End of the loop. ?>
		</div><!-- #main -->
		
		<div class="clearfix"></div>

<?php get_footer(); ?>