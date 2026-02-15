<?php
/**
 * About Owner section.
 *
 * @package SoulSuite
 */

if (!defined('ABSPATH')) {
    exit;
}

$data = isset($args['data']) && is_array($args['data']) ? $args['data'] : [];
?>
<section class="about-owner" style="<?php echo esc_attr($data['about_bg_style'] ?? ''); ?>">
    <div class="container">
        <style>
            .owner-content { background-color: <?php echo esc_attr($data['about_content_bg'] ?? 'transparent'); ?>; }
            .owner-image img { border: 4px solid <?php echo esc_attr($data['about_image_border'] ?? '#40e0d0'); ?>; }
        </style>

        <?php if (!empty($data['about_title'])): ?>
            <h2 class="section-title"><?php echo esc_html($data['about_title']); ?></h2>
        <?php endif; ?>

        <div class="owner-content">
            <?php if (!empty($data['about_owner_image'])): ?>
                <div class="owner-image">
                    <img src="<?php echo esc_url($data['about_owner_image']); ?>" alt="<?php echo esc_attr($data['about_owner_name'] ?? ''); ?>">
                </div>
            <?php endif; ?>

            <div class="owner-info">
                <div class="owner-credentials">
                    <?php if (!empty($data['about_owner_name'])): ?>
                        <h3 class="owner-name"><?php echo esc_html($data['about_owner_name']); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($data['about_owner_title'])): ?>
                        <p class="owner-title"><?php echo esc_html($data['about_owner_title']); ?></p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($data['about_owner_bio'])): ?>
                    <div class="owner-bio">
                        <?php echo wpautop(wp_kses_post($data['about_owner_bio'])); ?>
                    </div>
                <?php elseif (current_user_can('manage_options')): ?>
                    <div class="owner-bio" style="background:#fff3cd;padding:20px;border-left:4px solid #ffc107;">
                        <p><strong>⚠️ Admin Notice:</strong> Owner Bio is empty in Customizer. Add it in <strong>Customize → Home Page Settings → About Owner Section → Owner Bio</strong>.</p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($data['hero_btn_text']) && !empty($data['hero_btn_url'])): ?>
                    <div class="cta-section">
                        <a href="<?php echo esc_url($data['hero_btn_url']); ?>" class="hero-btn primary-btn">
                            <?php echo esc_html($data['hero_btn_text']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>