<?php
/**
 * Template Name: Business Intake Form
 * 
 * Displays the external business intake form via iframe
 * 
 * @package SoulSuite
 */

get_header();

// Page Header
$header_bg_color = get_option('soul_suite_hero_bg_color', '#40e0d0');
?>

<div class="page-header intake-form-header" style="background: linear-gradient(135deg, <?php echo esc_attr($header_bg_color); ?>, #ff5b0c); padding: 80px 0; text-align: center; margin-bottom: 60px;">
    <div class="container">
        <h1 style="color: white; font-size: 2.5rem; margin: 0 0 15px 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
            <?php the_title(); ?>
        </h1>
        <?php if (has_excerpt()): ?>
            <p style="color: rgba(255,255,255,0.95); font-size: 1.2rem; margin: 0; max-width: 800px; margin: 0 auto;">
                <?php the_excerpt(); ?>
            </p>
        <?php endif; ?>
    </div>
</div>

<div id="primary" class="content-area">
    <div id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    while (have_posts()) : the_post();
                        // Display page content if any
                        if (get_the_content()) {
                            ?>
                            <div class="page-content" style="margin-bottom: 40px;">
                                <?php the_content(); ?>
                            </div>
                            <?php
                        }
                    endwhile;
                    ?>
                    
                    <!-- External Form Iframe -->
                    <div class="external-form-container" style="max-width: 700px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        <iframe 
                            src="https://app.soulsuitewellness.com/forms/wtl/597185b989731544565c3b70642a26b1" 
                            width="100%" 
                            height="850" 
                            frameborder="0" 
                            sandbox="allow-top-navigation allow-forms allow-scripts allow-same-origin allow-popups" 
                            allowfullscreen
                            style="border-radius: 10px; display: block;"
                        ></iframe>
                    </div>
                    
                    <?php if (current_user_can('administrator')): ?>
                    <!-- Admin Instructions (Only visible to admins) -->
                    <div class="admin-notice" style="max-width: 700px; margin: 40px auto; padding: 20px; background: #fff3cd; border: 1px solid #ffc107; border-radius: 10px;">
                        <h3 style="margin-top: 0; color: #856404;">📝 Admin Instructions</h3>
                        <p style="margin-bottom: 15px; color: #856404;">To edit this form, please visit:</p>
                        <p style="margin: 0;">
                            <a href="https://app.soulsuitewellness.com/admin/leads/forms" target="_blank" style="color: #0066cc; text-decoration: underline;">
                                https://app.soulsuitewellness.com/admin/leads/forms
                            </a>
                        </p>
                        <p style="margin-top: 10px; font-size: 0.9rem; color: #856404;">
                            <em>Login required. This notice is only visible to administrators.</em>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.external-form-container iframe {
    min-height: 850px;
}

@media (max-width: 768px) {
    .external-form-container {
        padding: 15px;
        margin: 0 15px;
    }
    
    .external-form-container iframe {
        min-height: 750px;
    }
}
</style>

<?php get_footer(); ?>