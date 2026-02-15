<?php
/**
 * Product Save Handler
 * 
 * @package SoulSuite
 * @since 1.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Save product meta box data
 * 
 * @param int $post_id Post ID
 */
function soul_save_product_meta($post_id) {
    // Check if nonce is set and valid
    if (!isset($_POST['soul_product_meta_nonce']) || !wp_verify_nonce($_POST['soul_product_meta_nonce'], 'soul_save_product_meta')) {
        return;
    }
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Check if this is a revision
    if (wp_is_post_revision($post_id)) {
        return;
    }
    
    // Define all meta fields with their sanitization callbacks
    $meta_fields = array(
        // Product Info
        'soul_product_sku' => 'sanitize_text_field',
        'soul_product_short_description' => 'sanitize_textarea_field',
        'soul_product_duration' => 'sanitize_text_field',
        'soul_product_duration_custom' => 'sanitize_text_field',
        
        // Pricing
        'soul_product_price' => 'soul_sanitize_price',
        'soul_product_sale_price' => 'soul_sanitize_price',
        
        // Inventory
        'soul_product_stock_status' => 'sanitize_text_field',
        'soul_product_stock_quantity' => 'absint',
        
        // Call to Action
        'soul_product_button_text' => 'sanitize_text_field',
        'soul_product_button_link' => 'esc_url_raw',
        'soul_product_button_new_tab' => 'absint',
        
        // Gallery
        'soul_product_gallery' => 'soul_sanitize_gallery',
    );
    
    // Process and save each field
    foreach ($meta_fields as $field => $sanitize_callback) {
        $value = isset($_POST[$field]) ? $_POST[$field] : '';
        
        // Special handling for duration with custom value
        if ($field === 'soul_product_duration' && $value === 'custom' && !empty($_POST['soul_product_duration_custom'])) {
            $value = 'custom:' . sanitize_text_field($_POST['soul_product_duration_custom']);
        }
        
        // Special handling for gallery
        if ($field === 'soul_product_gallery' && !empty($value)) {
            $gallery_ids = explode(',', $value);
            $gallery_ids = array_map('absint', $gallery_ids);
            $gallery_ids = array_filter($gallery_ids);
            
            // Ensure the first gallery image is set as featured image if not set
            if (!empty($gallery_ids) && !has_post_thumbnail($post_id)) {
                set_post_thumbnail($post_id, $gallery_ids[0]);
            }
            
            $value = implode(',', $gallery_ids);
        }
        
        // Sanitize the value using the specified callback
        if (is_callable($sanitize_callback)) {
            $sanitized_value = call_user_func($sanitize_callback, $value);
            update_post_meta($post_id, '_' . $field, $sanitized_value);
        } else {
            // Default sanitization
            $sanitized_value = sanitize_text_field($value);
            update_post_meta($post_id, '_' . $field, $sanitized_value);
        }
    }
    
    // Handle sale price validation
    $price = get_post_meta($post_id, '_soul_product_price', true);
    $sale_price = get_post_meta($post_id, '_soul_product_sale_price', true);
    
    if (!empty($sale_price) && $sale_price >= $price) {
        // If sale price is higher than or equal to regular price, remove it
        update_post_meta($post_id, '_soul_product_sale_price', '');
    }
    
    // Update stock status based on quantity if needed
    $stock_quantity = get_post_meta($post_id, '_soul_product_stock_quantity', true);
    $stock_status = get_post_meta($post_id, '_soul_product_stock_status', true);
    
    if (empty($stock_quantity) && $stock_status === 'instock') {
        update_post_meta($post_id, '_soul_product_stock_status', 'outofstock');
    }
}
add_action('save_post_soul_product', 'soul_save_product_meta');

/**
 * Sanitize price input
 * 
 * @param mixed $price Price to sanitize
 * @return string Sanitized price
 */
function soul_sanitize_price($price) {
    if ('' === $price) {
        return '';
    }
    
    // Remove any non-numeric characters except decimal point
    $price = preg_replace('/[^0-9.]/', '', $price);
    
    // Convert to float and format with 2 decimal places
    $price = number_format((float) $price, 2, '.', '');
    
    return $price;
}

/**
 * Sanitize gallery input
 * 
 * @param string $gallery Comma-separated list of attachment IDs
 * @return string Sanitized gallery string
 */
function soul_sanitize_gallery($gallery) {
    if (empty($gallery)) {
        return '';
    }
    
    // Convert to array of integers
    $ids = explode(',', $gallery);
    $ids = array_map('absint', $ids);
    $ids = array_filter($ids);
    
    return implode(',', $ids);
}

/**
 * Add meta boxes for product data
 */
function soul_add_product_meta_boxes() {
    add_meta_box(
        'soul_product_details',
        __('Product Details', 'soul-suite'),
        'soul_product_details_callback',
        'soul_product',
        'normal',
        'high'
    );
    
    add_meta_box(
        'soul_product_gallery',
        __('Product Gallery', 'soul-suite'),
        'soul_product_gallery_callback',
        'soul_product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'soul_add_product_meta_boxes');
