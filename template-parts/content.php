<?php
/**
 * Template part for displaying posts
 * CUSTOMIZER CONTROLLED
 *
 * @package SoulSuite
 */

$card_bg = get_theme_mod('soul_suite_blog_card_bg', '#f9f9f9');
$title_color = get_theme_mod('soul_suite_blog_title_color', '#333333');
$text_color = get_theme_mod('soul_suite_blog_text_color', '#666666');
$meta_color = get_theme_mod('soul_suite_blog_meta_color', '#999999');

$categories_list = get_the_category_list(esc_html__(', ', 'soul-suite'));
$tags_list = get_the_tag_list('', esc_html__(', ', 'soul-suite'));
?>

<style>
.single_post_blog {
    background: <?php echo esc_attr($card_bg); ?>;
    margin-bottom: 40px;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}
.single_post_blog:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.single_post_blog .entry-title a {
    color: <?php echo esc_attr($title_color); ?>;
    text-decoration: none;
}
.single_post_blog .entry-title a:hover {
    opacity: 0.8;
}
.single_post_blog .entry-content {
    color: <?php echo esc_attr($text_color); ?>;
    padding: 30px;
}
.single_post_blog .entry_meta {
    color: <?php echo esc_attr($meta_color); ?>;
    padding: 20px 30px;
    border-bottom: 1px solid #e0e0e0;
    font-size: 14px;
}
.single_post_blog .entry-header {
    padding: 0 30px;
}
.single_post_blog .post_img img {
    width: 100%;
    height: auto;
    display: block;
}
.single_post_blog .post_btn {
    margin-top: 20px;
}
.single_post_blog .post_btn .btn {
    background: linear-gradient(90deg, #40e0d0, #8c756a, #ff5b0c);
    color: #ffffff;
    padding: 10px 30px;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}
.single_post_blog .post_btn .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
</style>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
	<div class="single_post_blog">
	
		<?php if (has_post_thumbnail()): ?>
			<div class="post_img">
				<?php if (is_single()): ?>
					<?php the_post_thumbnail('full', array('class' => 'img-responsive post_image')); ?>
				<?php else: ?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('full', array('class' => 'img-responsive post_image')); ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		
		<div class="entry_meta">
			<i class="fa fa-calendar-o"></i> <?php echo esc_html(get_the_time('F d, Y'));?> 
			<?php if ($categories_list): ?>
				| <i class="fa fa-folder-o"></i> <?php echo wp_kses_post($categories_list); ?>
			<?php endif; ?>
			<?php if (!is_single()): ?>
				| <i class="fa fa-comments"></i> <?php comments_popup_link('0 comments', '1 Comment', '% Comments', 'comments-link', '0 Comments'); ?>
			<?php endif; ?>
		</div>		
			
		<?php if (!is_single()): ?>
			<header class="entry-header">
				<?php the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
			</header>
		<?php endif; ?>
		
		<div class="entry-content">
			<?php
			if (!is_single()) {
				the_excerpt();
			} else {
				the_content();
			}
			
			if (!is_single()): ?>
				<div class="post_btn">	
					<a class="btn btn-default btn-portfolio-bg" href="<?php the_permalink();?>">Read More</a>
				</div>
			<?php endif;
			
			wp_link_pages(array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'soul-suite'),
				'after'  => '</div>',
			));
			?>
		</div>
	</div>
</article>