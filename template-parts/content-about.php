<?php
/**
 * About Owner Section
 * Displays owner bio from WordPress Customizer
 * Navigate to: Appearance → Customize → Home Page Settings → About Owner Section
 * 
 * @package SoulSuite
 */

// Get section settings from customizer
$section_title = get_theme_mod('soul_suite_about_title', 'About the Owner');
$bg_color = get_theme_mod('soul_suite_about_bg_color', 'transparent');
$text_color = get_theme_mod('soul_suite_about_text_color', '#333333');

// Get owner data from customizer
$owner_image = get_theme_mod('soul_suite_about_owner_image', 'https://soulsuitewellness.com/wp-content/uploads/2025/07/IMG-BTM.jpg');
$owner_name = get_theme_mod('soul_suite_about_owner_name', 'Soulara Sevier');
$owner_title = get_theme_mod('soul_suite_about_owner_title', 'Founder & CEO | Soul Suite Wellness');
$owner_bio = get_theme_mod('soul_suite_about_owner_bio', '');

// Get CTA button settings - check both primary and legacy names
$btn_text = get_theme_mod('soul_suite_btn_primary_text', get_theme_mod('soul_suite_hero_btn_text', 'Book a Clarity Call'));
$btn_url = get_theme_mod('soul_suite_btn_primary_url', get_theme_mod('soul_suite_hero_btn_url', '#'));
?>

<section class="about-owner" id="about" style="background-color: <?php echo esc_attr($bg_color); ?>; color: <?php echo esc_attr($text_color); ?>;">
    <div class="container">
        <?php if ($section_title): ?>
            <h2 class="section-title wow fadeInUp"><?php echo esc_html($section_title); ?></h2>
        <?php endif; ?>
        
        <div class="owner-content wow fadeInUp" data-wow-delay="0.2s">
            <?php if ($owner_image): ?>
                <div class="owner-image">
                    <img src="<?php echo esc_url($owner_image); ?>" 
                         alt="<?php echo esc_attr($owner_name); ?>">
                </div>
            <?php endif; ?>
            
            <div class="owner-info">
                <div class="owner-credentials">
                    <?php if ($owner_name): ?>
                        <h3 class="owner-name"><?php echo esc_html($owner_name); ?></h3>
                    <?php endif; ?>
                    
                    <?php if ($owner_title): ?>
                        <p class="owner-title"><?php echo esc_html($owner_title); ?></p>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($owner_bio)): ?>
                    <div class="owner-bio">
                        <?php echo wpautop(wp_kses_post($owner_bio)); ?>
                    </div>
                <?php else: ?>
                    <?php if (current_user_can('manage_options')): ?>
                        <div style="background: #fff3cd; border: 1px solid #ffc107; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0; border-radius: 5px;">
                            <strong>⚠ Admin Notice:</strong> Owner Bio is empty in Customizer. Please add content in 
                            <a href="<?php echo admin_url('customize.php?autofocus[section]=soul_suite_about_section'); ?>">
                                <strong>Customize → Home Page Settings → About Owner Section → Owner Bio</strong>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                
                <?php if ($btn_url && $btn_text): ?>
                    <div class="cta-section">
                        <a href="<?php echo esc_url($btn_url); ?>" class="hero-btn primary-btn">
                            <?php echo esc_html($btn_text); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
