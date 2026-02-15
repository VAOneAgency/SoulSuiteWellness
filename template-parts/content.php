<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package SoulSuite
 */
$image_url = get_theme_mod('soul_suite_page_image', ''); // Default to empty if no image is set

$categories_list = get_the_category_list( esc_html__( ', ', 'soul-suite' ) );
$tags_list = get_the_tag_list( '', esc_html__( ', ', 'soul-suite' ) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
	<div class="single_post_blog">
	
		<?php if ($image_url): ?>
			<div class="post_img">
				<img src="<?php echo esc_url($image_url); ?>" class="img-responsive post_image" alt="<?php the_title_attribute(); ?>">
			</div>
		<?php elseif (has_post_thumbnail()): ?>
			<div class="post_img">
				<?php if (is_single()): ?>
					<?php the_post_thumbnail('soul_suite_image_840_430', array('class' => 'img-responsive post_image')); ?>
				<?php else: ?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('soul_suite_image_840_430', array('class' => 'img-responsive post_image')); ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		
		<div class="entry_meta">
			<i class="fa fa-calendar-o"></i> <?php echo esc_html(get_the_time('F d, Y'));?> &nbsp; <?php esc_html_e(' - ', 'soul-suite');?> &nbsp; <i class="fa fa-comments"></i> <?php comments_popup_link( '0 comments', '1 Comment ', '% Comments ', 'comments-link', ' 0 Comments '); ?> &nbsp; <?php esc_html_e(' - ' , 'soul-suite'); if($categories_list){ ?>
			&nbsp; <i class="fa fa-folder-o"></i> <?php echo wp_kses_post($categories_list); } ?> &nbsp; <?php if($tags_list){ esc_html_e(' - ' , 'soul-suite'); ?> &nbsp; <i class="fa fa-tag"></i> <?php echo wp_kses_post($tags_list); }?>
			
		</div>		
			<?php
			if ( is_single() ) :
				
			else : ?>
   
			<header class="entry-header">
				<?php	the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
			</header><!-- .entry-header -->
  <?php    
			endif; 
			
			?>

				
		
		<div class="entry-content">
			<?php
			if(!is_single()){
				the_excerpt();
			}else{
				the_content();
			}
				
			if(!is_single()){ ?>
			<div class="post_btn">	
				<a class="btn btn-default btn-portfolio-bg" href="<?php the_permalink();?>"><?php esc_html_e('Read More..' , 'soul-suite');?> </a>
			</div>
		<?php	}
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'soul-suite' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->