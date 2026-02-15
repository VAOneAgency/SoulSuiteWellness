<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SoulSuite
 */
?>

	</div><!-- #content -->

</div><!-- #page -->

<?php
// Get footer customizer settings
$footer_bg_image = get_theme_mod('soul_suite_footer_bg_image', '');
$footer_bg_start = get_theme_mod('soul_suite_footer_bg_start', '#245C52');
$footer_bg_end = get_theme_mod('soul_suite_footer_bg_end', '#1a4439');
$footer_text_color = get_theme_mod('soul_suite_footer_text_color', '#ffffff');
$footer_link_color = get_theme_mod('soul_suite_footer_link_color', '#40e0d0');
$footer_link_hover = get_theme_mod('soul_suite_footer_link_hover_color', '#ff5b0c');
$footer_font_family = get_theme_mod('soul_suite_footer_font_family', 'primary');
$footer_font_size = get_theme_mod('soul_suite_footer_font_size', '14');
$footer_font_weight = get_theme_mod('soul_suite_footer_font_weight', '400');
$footer_text_align = get_theme_mod('soul_suite_footer_text_align', 'center');
$footer_line_height = get_theme_mod('soul_suite_footer_line_height', '1.6');
$footer_letter_spacing = get_theme_mod('soul_suite_footer_letter_spacing', '0');
$footer_copyright = get_theme_mod('soul_suite_footer_copyright', '&copy; ' . date('Y') . ' Soul Suite Wellness. Made with <span class="heart">♥</span> by <a href="https://vaoneagency.com" target="_blank" rel="noopener">VAOne Agency</a>');

// Map font family choices to CSS variables
$font_family_map = array(
    'primary' => 'var(--font-primary)',
    'secondary' => 'var(--font-secondary)',
    'accent' => 'var(--font-accent)',
    'inherit' => 'inherit',
);
$footer_font = isset($font_family_map[$footer_font_family]) ? $font_family_map[$footer_font_family] : 'var(--font-primary)';

// Output inline styles based on customizer
?>
<style>
.site-footer {
    background: linear-gradient(135deg, <?php echo esc_attr($footer_bg_start); ?> 0%, <?php echo esc_attr($footer_bg_end); ?> 100%)<?php if ($footer_bg_image) { echo ', url(' . esc_url($footer_bg_image) . ')'; } ?>;
    <?php if ($footer_bg_image) { ?>
    background-size: cover, cover;
    background-position: center, center;
    background-blend-mode: overlay;
    <?php } ?>
    color: <?php echo esc_attr($footer_text_color); ?>;
}
.site-footer,
.footer-content,
.footer-copyright,
.footer-copyright p {
    color: <?php echo esc_attr($footer_text_color); ?>;
    font-family: <?php echo $footer_font; ?>;
    font-size: <?php echo esc_attr($footer_font_size); ?>px;
    font-weight: <?php echo esc_attr($footer_font_weight); ?>;
    line-height: <?php echo esc_attr($footer_line_height); ?>;
    letter-spacing: <?php echo esc_attr($footer_letter_spacing); ?>px;
    text-align: <?php echo esc_attr($footer_text_align); ?>;
}
.footer-social-links,
.footer-navigation {
    justify-content: <?php echo $footer_text_align === 'left' ? 'flex-start' : ($footer_text_align === 'right' ? 'flex-end' : 'center'); ?>;
}
.footer-menu a {
    color: <?php echo esc_attr($footer_text_color); ?> !important;
}
.footer-menu a:hover {
    color: <?php echo esc_attr($footer_link_hover); ?> !important;
}
.footer-copyright a {
    color: <?php echo esc_attr($footer_link_color); ?>;
}
.footer-copyright a:hover {
    color: <?php echo esc_attr($footer_link_hover); ?>;
}
</style>
<?php
// Footer Social Media Links
$socials = [
    'facebook' => 'Facebook',
    'instagram' => 'Instagram',
    'twitter' => 'Twitter',
    'linkedin' => 'LinkedIn',
    'tiktok' => 'TikTok',
    'youtube' => 'YouTube',
];
echo '<footer id="colophon" class="site-footer">';
echo '<div class="footer-content">';
echo '<div class="footer-social-links">';
foreach ($socials as $key => $label) {
    $url = get_theme_mod("ssw_social_{$key}_url", '');
    if (!empty($url)) {
        printf(
            '<a href="%s" class="footer-social-link footer-%s" target="_blank" rel="noopener" aria-label="%s"><i class="fa fa-%s"></i><span class="screen-reader-text">%s</span></a>',
            esc_url($url),
            esc_attr($key),
            esc_attr($label),
            esc_attr($key === 'tiktok' ? 'music' : $key),
            esc_html($label)
        );
    }
}
echo '</div>'; // .footer-social-links

// Footer Navigation Menu
if (has_nav_menu('footer')) {
    wp_nav_menu(array(
        'theme_location' => 'footer',
        'menu_id'        => 'footer-menu',
        'menu_class'     => 'footer-menu',
        'container'      => 'nav',
        'container_class' => 'footer-navigation',
        'depth'          => 1,
    ));
}

// Copyright from Customizer
echo '<div class="footer-copyright">';
echo '<p>' . wp_kses_post($footer_copyright) . '</p>';
echo '</div>'; // .footer-copyright

echo '</div>'; // .footer-content
echo '</footer>'; // #colophon

wp_footer(); ?>

</body>
</html>
