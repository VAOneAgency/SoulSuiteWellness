<?php
/**
 * Template Name: Home Page
 * 
 * Full-featured homepage with all sections
 * 
 * @package SoulSuite
 */

get_header();
?>

<div id="primary" class="content-area home-page">
    <main id="main" class="site-main">
        
        <?php 
        // Hero Section
        get_template_part('template-parts/section', 'hero');
        
        // About/Owner Section
        get_template_part('template-parts/section', 'about');
        
        // Services Section
        get_template_part('template-parts/section', 'services');
        
        // Matrix/System Reset Section
        get_template_part('template-parts/section', 'matrix');
        
        // CTA Section
        get_template_part('template-parts/section', 'cta');
        
        // Contact Section
        get_template_part('template-parts/section', 'contact');
        ?>
        
    </main>
</div>

<?php
get_footer();
