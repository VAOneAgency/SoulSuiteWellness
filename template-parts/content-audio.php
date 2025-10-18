<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package monalisa
 */

$categories_list = get_the_category_list( esc_html__( ', ', 'monalisa' ) );
$tags_list = get_the_tag_list( '', esc_html__( ', ', 'monalisa' ) );
$monalisa_embede_code = get_post_meta(get_the_ID(), '_monalisa_embed_code', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single_post_blog">
	
		<?php if($monalisa_embede_code){ ?>
		<div class="post_audio_video">
			<?php echo monalisa_wp_kses($monalisa_embede_code); ?>
		</div>
		<?php } ?>
		
		<?php
		
		if ( is_single() ) :
			
		else : ?>

		<header class="entry-header">
			<?php	the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		</header><!-- .entry-header -->
		
		<?php  endif; ?>
		
		<div class="entry_meta">
			<i class="fa fa-calendar-o"></i> <?php echo esc_html(get_the_time('F d, Y'));?> &nbsp; <?php esc_html_e(' - ', 'monalisa');?> &nbsp; <i class="fa fa-comments"></i> <?php comments_popup_link( '0 comments', '1 Comment ', '% Comments ', 'comments-link', ' 0 Comments'); ?> &nbsp; <?php esc_html_e(' - ' , 'monalisa'); if($categories_list){ ?>
			&nbsp; <i class="fa fa-folder-o"></i> <?php echo monalisa_wp_kses($categories_list); } ?> &nbsp; <?php if($tags_list){ esc_html_e(' - ' , 'monalisa'); ?> &nbsp; <i class="fa fa-tag"></i> <?php echo monalisa_wp_kses($tags_list); }?>
			
		</div>
		
		<div class="entry-content">
			<?php
			if(!is_single()){
				the_excerpt();
			}else{
				the_content();
			}
				
			if(!is_single()){ ?>
			<div class="post_btn">	
				<a class="btn btn-default btn-portfolio-bg" href="<?php the_permalink();?>"><?php esc_html_e('Read More..' , 'monalisa');?> </a>
			</div>
		<?php	}
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'monalisa' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
