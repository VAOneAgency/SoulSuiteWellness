<?php
/**
 * Template Name: Services Page
 * 
 * Displays all services with Square booking integration
 * 
 * @package SoulSuite
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        
        <?php 
        // Include hero section
        get_template_part('template-parts/section', 'hero');
        
        // Include services section
        get_template_part('template-parts/section', 'services');
        
        // Include CTA section
        get_template_part('template-parts/section', 'cta');
        
        // Include contact section
        get_template_part('template-parts/section', 'contact');
        ?>
        
    </main>
</div>

<?php
get_footer();