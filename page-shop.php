<?php
/**
 * Template Name: Shop Page
 *
 * Displays a shop page with Squarespace or external links.
 */
get_header();
?>
<main id="main" class="site-main shop-page">
    <section class="shop-section">
        <div class="container">
            <h1><?php echo esc_html( get_theme_mod('ssw_shop_title', 'Shop Our Services') ); ?></h1>
            <div class="shop-list">
                <?php for ($i = 1; $i <= 3; $i++) :
                    $title = get_theme_mod("ssw_service_{$i}_title", "Service {$i}");
                    $url = get_theme_mod("ssw_service_{$i}_squarespace_url", '');
                ?>
                    <div class="shop-item">
                        <h2><?php echo esc_html($title); ?></h2>
                        <?php if (!empty($url)): ?>
                            <a href="<?php echo esc_url($url); ?>" class="btn" target="_blank">Buy Now</a>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
