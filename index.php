<?php
/**
 * The main template file - BLOG PAGE
 *
 * @package SoulSuite
 */

get_header();
get_template_part('template-parts/page-top'); 

$layout = get_theme_mod('soul_suite_blog_layout', 'classic');
$bg_color = get_theme_mod('soul_suite_blog_bg_color', '#ffffff');
$bg_image = get_theme_mod('soul_suite_blog_bg_image', '');

$bg_style = 'background-color: ' . esc_attr($bg_color) . ';';
if ($bg_image) {
    $bg_style .= ' background-image: url(' . esc_url($bg_image) . '); background-size: cover; background-position: center; background-attachment: fixed;';
}

// Layout class
$layout_class = '';
switch ($layout) {
    case 'grid':
        $layout_class = 'blog-grid blog-grid-2';
        break;
    case 'grid-3':
        $layout_class = 'blog-grid blog-grid-3';
        break;
    case 'cards':
        $layout_class = 'blog-cards';
        break;
    case 'masonry':
        $layout_class = 'blog-masonry';
        break;
    default:
        $layout_class = 'blog-classic';
}
?>

<style>
.blog-section {
    padding: 80px 0;
    min-height: 100vh;
}
.blog-grid-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}
.blog-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}
@media (max-width: 992px) {
    .blog-grid-3 {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 768px) {
    .blog-grid-2, .blog-grid-3 {
        grid-template-columns: 1fr;
    }
}
.blog-cards .single_post_blog {
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}
</style>

<div class="blog-section" style="<?php echo $bg_style; ?>">
    <div class="container">
        <div class="<?php echo esc_attr($layout_class); ?>">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    get_template_part('template-parts/content', get_post_format());
                endwhile;
                
                the_posts_navigation();
            else :
                get_template_part('template-parts/content', 'none');
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
