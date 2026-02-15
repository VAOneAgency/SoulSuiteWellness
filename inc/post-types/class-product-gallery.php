<?php
/**
 * Product Gallery Meta Box
 * 
 * @package SoulSuite
 * @since 1.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Product gallery meta box callback
 * 
 * @param WP_Post $post Current post object
 */
function soul_product_gallery_callback($post) {
    $gallery = get_post_meta($post->ID, '_soul_product_gallery', true);
    $gallery_ids = !empty($gallery) ? explode(',', $gallery) : array();
    ?>
    <div class="soul-product-gallery">
        <ul class="soul-gallery-images">
            <?php if (!empty($gallery_ids)) : ?>
                <?php foreach ($gallery_ids as $image_id) : ?>
                    <?php if (wp_attachment_is_image($image_id)) : ?>
                        <li class="image" data-attachment_id="<?php echo esc_attr($image_id); ?>">
                            <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                            <a href="#" class="delete" title="<?php esc_attr_e('Remove image', 'soul-suite'); ?>">×</a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        
        <input type="hidden" id="soul_product_gallery" name="soul_product_gallery" value="<?php echo esc_attr(implode(',', $gallery_ids)); ?>">
        
        <p class="add-gallery-images">
            <a href="#" class="button button-primary" id="add-gallery-images">
                <?php esc_html_e('Add gallery images', 'soul-suite'); ?>
            </a>
        </p>
        
        <p class="description">
            <?php esc_html_e('Add images to create a product gallery. The first image will be used as the featured image.', 'soul-suite'); ?>
        </p>
    </div>
    <?php
}

/**
 * Enqueue admin scripts and styles for product gallery
 */
function soul_product_gallery_admin_assets($hook) {
    global $post_type;
    
    if (('post.php' === $hook || 'post-new.php' === $hook) && 'soul_product' === $post_type) {
        // Enqueue media scripts
        wp_enqueue_media();
        
        // Enqueue custom admin styles and scripts
        wp_enqueue_style('soul-product-admin', get_template_directory_uri() . '/assets/css/admin-product.css', array(), '1.0.0');
        
        wp_enqueue_script(
            'soul-product-admin', 
            get_template_directory_uri() . '/assets/js/admin-product.js', 
            array('jquery', 'jquery-ui-sortable'), 
            '1.0.0', 
            true
        );
        
        wp_localize_script('soul-product-admin', 'soulProductAdmin', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('soul_product_nonce'),
            'mediaTitle' => __('Select or Upload Product Image', 'soul-suite'),
            'mediaButton' => __('Use this image', 'soul-suite'),
            'removeImage' => __('Remove image', 'soul-suite')
        ));
    }
}
add_action('admin_enqueue_scripts', 'soul_product_gallery_admin_assets');

/**
 * AJAX handler for product gallery
 */
function soul_ajax_product_gallery() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'soul_product_nonce')) {
        wp_send_json_error(__('Security check failed', 'soul-suite'));
    }
    
    // Check permissions
    if (!current_user_can('edit_posts')) {
        wp_send_json_error(__('Permission denied', 'soul-suite'));
    }
    
    $attachment_id = isset($_POST['attachment_id']) ? absint($_POST['attachment_id']) : 0;
    
    if ($attachment_id) {
        wp_send_json_success(array(
            'id' => $attachment_id,
            'thumbnail' => wp_get_attachment_thumb_url($attachment_id),
            'title' => get_the_title($attachment_id)
        ));
    }
    
    wp_send_json_error(__('Invalid attachment ID', 'soul-suite'));
}
add_action('wp_ajax_soul_product_gallery', 'soul_ajax_product_gallery');
