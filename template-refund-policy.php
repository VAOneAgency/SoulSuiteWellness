<?php
/**
 * Template Name: Refund and Returns Policy
 *
 * Displays the refund and returns policy page.
 * 
 * @package SoulSuite
 */

get_header();

// Page Header
$header_bg_color = get_option('soul_suite_hero_bg_color', '#40e0d0');
?>

<div class="page-header refund-header" style="background: linear-gradient(135deg, <?php echo esc_attr($header_bg_color); ?>, #ff5b0c); padding: 80px 0; text-align: center; margin-bottom: 60px;">
    <div class="container">
        <h1 style="color: white; font-size: 2.5rem; margin: 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
            <?php echo esc_html(get_option('soul_suite_refund_title', 'Refund and Returns Policy')); ?>
        </h1>
    </div>
</div>

<main id="main" class="site-main refund-policy-page">
    <section class="refund-section">
        <div class="container">
            <div class="refund-content" style="max-width: 900px; margin: 0 auto; padding: 40px; background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                <?php
                // Get refund policy content from customizer
                $refund_content = get_option('soul_suite_refund_content', '');
                
                if (!empty($refund_content)) {
                    echo wpautop(wp_kses_post($refund_content));
                } else {
                    // Default content if nothing set in customizer
                    ?>
                    <h2>Soul Suite Wellness – Refund Policy</h2>
                    
                    <p>At Soul Suite Wellness, we are committed to supporting your journey to healing, balance, and empowerment. We deeply value the trust you place in our services and strive to ensure your complete satisfaction.</p>
                    
                    <p>Please contact us at <a href="mailto:<?php echo esc_attr(get_option('soul_suite_contact_email', 'bewell@soulsuitewellness.com')); ?>"><?php echo esc_html(get_option('soul_suite_contact_email', 'bewell@soulsuitewellness.com')); ?></a> for refund and return information.</p>
                    
                    <?php if (current_user_can('administrator')): ?>
                    <div class="admin-notice" style="margin-top: 40px; padding: 20px; background: #fff3cd; border: 1px solid #ffc107; border-radius: 10px;">
                        <p style="margin: 0; color: #856404;">
                            <strong>Admin:</strong> To customize this content, go to <strong>Appearance → Customize → Refund & Returns Policy</strong>
                        </p>
                    </div>
                    <?php endif; ?>
                    <?php
                }
                ?>
                
                <?php
                // Display page content if set
                while (have_posts()) : the_post();
                    if (get_the_content()) {
                        ?>
                        <div class="additional-content" style="margin-top: 40px; padding-top: 40px; border-top: 1px solid #eee;">
                            <?php the_content(); ?>
                        </div>
                        <?php
                    }
                endwhile;
                ?>
            </div>
        </div>
    </section>
</main>

<style>
.refund-content h2 {
    color: #245C52;
    font-family: 'Playfair Display', serif;
    margin-top: 0;
    margin-bottom: 25px;
}

.refund-content h3 {
    color: #40e0d0;
    margin-top: 30px;
    margin-bottom: 15px;
}

.refund-content p {
    line-height: 1.8;
    margin-bottom: 20px;
    color: #333;
}

.refund-content a {
    color: #40e0d0;
    text-decoration: none;
    border-bottom: 1px solid rgba(64, 224, 208, 0.3);
    transition: all 0.3s ease;
}

.refund-content a:hover {
    color: #ff5b0c;
    border-bottom-color: rgba(255, 91, 12, 0.5);
}

.refund-content ul, .refund-content ol {
    margin-bottom: 20px;
    padding-left: 30px;
}

.refund-content li {
    margin-bottom: 10px;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .refund-content {
        padding: 30px 20px;
        margin: 0 15px;
    }
}
</style>

<?php get_footer(); ?>