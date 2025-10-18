<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Monalisa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single_post_blog">
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry_meta">
			<i class="fa fa-calendar-o"></i> <?php echo esc_html(get_the_time('F d, Y'));?> 
		</div>	
		<?php endif; ?>
			
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		
		<div class="post_btn">	
			<a class="btn btn-default btn-portfolio-bg" href="<?php the_permalink();?>"><?php esc_html_e('Read More..' , 'monalisa');?> </a>
		</div>		
	</div>
</article><!-- #post-## -->
