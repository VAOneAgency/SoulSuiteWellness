<?php
/**
 * Main Product Post Type Class
 * 
 * @package SoulSuite
 * @since 1.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

// Include required files
require_once get_template_directory() . '/inc/post-types/class-product-save.php';
require_once get_template_directory() . '/inc/post-types/class-product-gallery.php';
require_once get_template_directory() . '/inc/post-types/class-product-admin-columns.php';

// Register custom taxonomy for product categories
function soul_register_product_categories() {
    $labels = array(
        'name'              => _x('Product Categories', 'taxonomy general name', 'soul-suite'),
        'singular_name'     => _x('Product Category', 'taxonomy singular name', 'soul-suite'),
        'search_items'      => __('Search Product Categories', 'soul-suite'),
        'all_items'         => __('All Product Categories', 'soul-suite'),
        'parent_item'       => __('Parent Category', 'soul-suite'),
        'parent_item_colon' => __('Parent Category:', 'soul-suite'),
        'edit_item'         => __('Edit Category', 'soul-suite'),
        'update_item'       => __('Update Category', 'soul-suite'),
        'add_new_item'      => __('Add New Category', 'soul-suite'),
        'new_item_name'     => __('New Category Name', 'soul-suite'),
        'menu_name'         => __('Categories', 'soul-suite'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'product-category'),
    );

    register_taxonomy('product_category', array('soul_product'), $args);
}
add_action('init', 'soul_register_product_categories', 0);

/**
 * Register Product Custom Post Type
 */
function soul_suite_register_product_cpt() {
    $labels = array(
        'name'                  => _x('Products', 'Post Type General Name', 'soul-suite'),
        'singular_name'         => _x('Product', 'Post Type Singular Name', 'soul-suite'),
        'menu_name'             => __('Products', 'soul-suite'),
        'name_admin_bar'        => __('Product', 'soul-suite'),
        'archives'              => __('Product Archives', 'soul-suite'),
        'attributes'            => __('Product Attributes', 'soul-suite'),
        'all_items'             => __('All Products', 'soul-suite'),
        'add_new_item'          => __('Add New Product', 'soul-suite'),
        'add_new'               => __('Add New', 'soul-suite'),
        'new_item'              => __('New Product', 'soul-suite'),
        'edit_item'             => __('Edit Product', 'soul-suite'),
        'update_item'           => __('Update Product', 'soul-suite'),
        'view_item'             => __('View Product', 'soul-suite'),
        'view_items'            => __('View Products', 'soul-suite'),
        'search_items'          => __('Search Product', 'soul-suite'),
        'not_found'             => __('Not found', 'soul-suite'),
        'not_found_in_trash'    => __('Not found in Trash', 'soul-suite'),
    );
    
    $args = array(
        'label'                 => __('Product', 'soul-suite'),
        'description'           => __('Wellness Products', 'soul-suite'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'            => array('product_category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'              => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'            => 'dashicons-cart',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'           => true,
        'has_archive'          => true,
        'exclude_from_search'  => false,
        'publicly_queryable'   => true,
        'capability_type'      => 'post',
        'show_in_rest'         => true,
    );
    
    register_post_type('soul_product', $args);
}
add_action('init', 'soul_suite_register_product_cpt', 0);

/**
 * Enqueue admin scripts and styles for product post type
 */
function soul_product_admin_assets($hook) {
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
add_action('admin_enqueue_scripts', 'soul_product_admin_assets');

/**
 * Product details meta box callback
 * 
 * @param WP_Post $post Current post object
 */
function soul_product_details_callback($post) {
    // Add nonce for security
    wp_nonce_field('soul_save_product_meta', 'soul_product_meta_nonce');
    
    // Get existing values with defaults
    $price = get_post_meta($post->ID, '_soul_product_price', true);
    $sale_price = get_post_meta($post->ID, '_soul_product_sale_price', true);
    $sku = get_post_meta($post->ID, '_soul_product_sku', true);
    $stock_status = get_post_meta($post->ID, '_soul_product_stock_status', true);
    $stock_quantity = get_post_meta($post->ID, '_soul_product_stock_quantity', true);
    $duration = get_post_meta($post->ID, '_soul_product_duration', true);
    $short_description = get_post_meta($post->ID, '_soul_product_short_description', true);
    $button_text = get_post_meta($post->ID, '_soul_product_button_text', true);
    $button_link = get_post_meta($post->ID, '_soul_product_button_link', true);
    $button_new_tab = get_post_meta($post->ID, '_soul_product_button_new_tab', true);
    
    // Default values
    $stock_status = !empty($stock_status) ? $stock_status : 'instock';
    $button_new_tab = !empty($button_new_tab) ? '1' : '0';
    
    ?>
    <div class="soul-product-fields">
        <!-- Price Fields -->
        <div class="soul-field-group">
            <h3 class="soul-section-title"><?php esc_html_e('Pricing', 'soul-suite'); ?></h3>
            
            <div class="soul-field-row">
                <div class="soul-field-col">
                    <label for="soul_product_sku"><?php esc_html_e('SKU', 'soul-suite'); ?></label>
                    <input type="text" id="soul_product_sku" name="soul_product_sku" value="<?php echo esc_attr($sku); ?>" class="regular-text">
                    <p class="description"><?php esc_html_e('Stock keeping unit', 'soul-suite'); ?></p>
                </div>
                
                <div class="soul-field-col">
                    <label for="soul_product_price"><?php esc_html_e('Regular Price', 'soul-suite'); ?></label>
                    <input type="number" id="soul_product_price" name="soul_product_price" value="<?php echo esc_attr($price); ?>" min="0" step="0.01" class="regular-text">
                </div>
                
                <div class="soul-field-col">
                    <label for="soul_product_sale_price"><?php esc_html_e('Sale Price', 'soul-suite'); ?></label>
                    <input type="number" id="soul_product_sale_price" name="soul_product_sale_price" value="<?php echo esc_attr($sale_price); ?>" min="0" step="0.01" class="regular-text">
                </div>
            </div>
        </div>
        
        <!-- Stock Status -->
        <div class="soul-field-group">
            <h3 class="soul-section-title"><?php esc_html_e('Inventory', 'soul-suite'); ?></h3>
            
            <div class="soul-field-row">
                <div class="soul-field-col">
                    <label for="soul_product_stock_status"><?php esc_html_e('Stock Status', 'soul-suite'); ?></label>
                    <select id="soul_product_stock_status" name="soul_product_stock_status" class="regular-text">
                        <option value="instock" <?php selected($stock_status, 'instock'); ?>><?php esc_html_e('In Stock', 'soul-suite'); ?></option>
                        <option value="outofstock" <?php selected($stock_status, 'outofstock'); ?>><?php esc_html_e('Out of Stock', 'soul-suite'); ?></option>
                        <option value="onbackorder" <?php selected($stock_status, 'onbackorder'); ?>><?php esc_html_e('On Backorder', 'soul-suite'); ?></option>
                    </select>
                </div>
                
                <div class="soul-field-col">
                    <label for="soul_product_stock_quantity"><?php esc_html_e('Stock Quantity', 'soul-suite'); ?></label>
                    <input type="number" id="soul_product_stock_quantity" name="soul_product_stock_quantity" value="<?php echo esc_attr($stock_quantity); ?>" min="0" step="1" class="regular-text">
                    <p class="description"><?php esc_html_e('Leave blank to manage stock without tracking quantity', 'soul-suite'); ?></p>
                </div>
            </div>
        </div>
        
        <!-- Product Details -->
        <div class="soul-field-group">
            <h3 class="soul-section-title"><?php esc_html_e('Product Details', 'soul-suite'); ?></h3>
            
            <div class="soul-field-row">
                <div class="soul-field-col">
                    <label for="soul_product_duration"><?php esc_html_e('Duration', 'soul-suite'); ?></label>
                    <select id="soul_product_duration" name="soul_product_duration" class="regular-text">
                        <option value=""><?php esc_html_e('Select duration', 'soul-suite'); ?></option>
                        <option value="15 mins" <?php selected($duration, '15 mins'); ?>><?php esc_html_e('15 minutes', 'soul-suite'); ?></option>
                        <option value="30 mins" <?php selected($duration, '30 mins'); ?>><?php esc_html_e('30 minutes', 'soul-suite'); ?></option>
                        <option value="45 mins" <?php selected($duration, '45 mins'); ?>><?php esc_html_e('45 minutes', 'soul-suite'); ?></option>
                        <option value="1 hour" <?php selected($duration, '1 hour'); ?>><?php esc_html_e('1 hour', 'soul-suite'); ?></option>
                        <option value="1.5 hours" <?php selected($duration, '1.5 hours'); ?>><?php esc_html_e('1.5 hours', 'soul-suite'); ?></option>
                        <option value="2 hours" <?php selected($duration, '2 hours'); ?>><?php esc_html_e('2 hours', 'soul-suite'); ?></option>
                        <option value="custom" <?php echo (strpos($duration, 'custom:') === 0) ? 'selected' : ''; ?>><?php esc_html_e('Custom', 'soul-suite'); ?></option>
                    </select>
                    <input type="text" id="soul_product_duration_custom" name="soul_product_duration_custom" 
                           value="<?php echo (strpos($duration, 'custom:') === 0) ? esc_attr(substr($duration, 7)) : ''; ?>" 
                           class="regular-text" style="margin-top: 5px; <?php echo (strpos($duration, 'custom:') === 0) ? '' : 'display: none;' ?>">
                </div>
            </div>
            
            <div class="soul-field-row">
                <div class="soul-field-col">
                    <label for="soul_product_short_description"><?php esc_html_e('Short Description', 'soul-suite'); ?></label>
                    <textarea id="soul_product_short_description" name="soul_product_short_description" rows="3" class="large-text" maxlength="160"><?php echo esc_textarea($short_description); ?></textarea>
                    <p class="description"><?php esc_html_e('A brief description for product listings (max 160 characters).', 'soul-suite'); ?></p>
                </div>
            </div>
        </div>
        
        <!-- Call to Action -->
        <div class="soul-field-group">
            <h3 class="soul-section-title"><?php esc_html_e('Call to Action', 'soul-suite'); ?></h3>
            
            <div class="soul-field-row">
                <div class="soul-field-col">
                    <label for="soul_product_button_text"><?php esc_html_e('Button Text', 'soul-suite'); ?></label>
                    <input type="text" id="soul_product_button_text" name="soul_product_button_text" value="<?php echo esc_attr($button_text); ?>" class="regular-text" placeholder="<?php esc_attr_e('e.g., Learn More, Book Now', 'soul-suite'); ?>">
                </div>
                
                <div class="soul-field-col">
                    <label for="soul_product_button_link"><?php esc_html_e('Button Link', 'soul-suite'); ?></label>
                    <input type="url" id="soul_product_button_link" name="soul_product_button_link" value="<?php echo esc_url($button_link); ?>" class="regular-text">
                </div>
                
                <div class="soul-field-col">
                    <label>
                        <input type="checkbox" id="soul_product_button_new_tab" name="soul_product_button_new_tab" value="1" <?php checked($button_new_tab, '1'); ?>>
                        <?php esc_html_e('Open in new tab', 'soul-suite'); ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Add custom fields to REST API response
 */
function soul_register_product_rest_fields() {
    register_rest_field('soul_product', 'product_meta', array(
        'get_callback' => 'soul_get_product_meta_for_api',
        'schema' => null,
    ));
}
add_action('rest_api_init', 'soul_register_product_rest_fields');

/**
 * Get product meta for REST API
 */
function soul_get_product_meta_for_api($object) {
    $post_id = $object['id'];
    
    return array(
        'price' => get_post_meta($post_id, '_soul_product_price', true),
        'sale_price' => get_post_meta($post_id, '_soul_product_sale_price', true),
        'sku' => get_post_meta($post_id, '_soul_product_sku', true),
        'stock_status' => get_post_meta($post_id, '_soul_product_stock_status', true),
        'stock_quantity' => get_post_meta($post_id, '_soul_product_stock_quantity', true),
        'duration' => get_post_meta($post_id, '_soul_product_duration', true),
        'button_text' => get_post_meta($post_id, '_soul_product_button_text', true),
        'button_link' => get_post_meta($post_id, '_soul_product_button_link', true),
        'button_new_tab' => (bool) get_post_meta($post_id, '_soul_product_button_new_tab', true),
        'gallery' => array_filter(explode(',', get_post_meta($post_id, '_soul_product_gallery', true))),
    );
}

/**
 * Add product category filter dropdown to admin
 */
function soul_add_product_category_filter() {
    global $typenow;
    
    if ('soul_product' === $typenow) {
        $taxonomy = 'product_category';
        $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        
        wp_dropdown_categories(array(
            'show_option_all' => __("Show All {$info_taxonomy->label}"),
            'taxonomy' => $taxonomy,
            'name' => $taxonomy,
            'orderby' => 'name',
            'selected' => $selected,
            'show_count' => true,
            'hide_empty' => false,
            'value_field' => 'slug',
        ));
    }
}
add_action('restrict_manage_posts', 'soul_add_product_category_filter');

/**
 * Add quick edit fields
 */
function soul_add_quick_edit_fields($column_name, $post_type) {
    if ('soul_product' !== $post_type) {
        return;
    }
    
    static $print_nonce = true;
    
    if ($print_nonce) {
        $print_nonce = false;
        wp_nonce_field('soul_quick_edit_nonce', 'soul_quick_edit_nonce');
    }
    
    ?>
    <fieldset class="inline-edit-col-right">
        <div class="inline-edit-col">
            <div class="inline-edit-group wp-clearfix">
                <label class="inline-edit-status alignleft">
                    <span class="title"><?php esc_html_e('Stock Status', 'soul-suite'); ?></span>
                    <select name="_soul_product_stock_status">
                        <option value="instock"><?php esc_html_e('In Stock', 'soul-suite'); ?></option>
                        <option value="outofstock"><?php esc_html_e('Out of Stock', 'soul-suite'); ?></option>
                        <option value="onbackorder"><?php esc_html_e('On Backorder', 'soul-suite'); ?></option>
                    </select>
                </label>
            </div>
            <div class="inline-edit-group wp-clearfix">
                <label>
                    <span class="title"><?php esc_html_e('Price', 'soul-suite'); ?></span>
                    <span class="input-text-wrap">
                        <input type="text" name="_soul_product_price" class="text regular_price" placeholder="" value="">
                    </span>
                </label>
            </div>
        </div>
    </fieldset>
    <?php
}
add_action('quick_edit_custom_box', 'soul_add_quick_edit_fields', 10, 2);

/**
 * Save quick edit data
 */
function soul_save_quick_edit_data($post_id) {
    // Check if nonce is set and valid
    if (!isset($_POST['soul_quick_edit_nonce']) || !wp_verify_nonce($_POST['soul_quick_edit_nonce'], 'soul_quick_edit_nonce')) {
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
    
    // Save stock status
    if (isset($_POST['_soul_product_stock_status'])) {
        update_post_meta($post_id, '_soul_product_stock_status', sanitize_text_field($_POST['_soul_product_stock_status']));
    }
    
    // Save price
    if (isset($_POST['_soul_product_price'])) {
        $price = soul_sanitize_price($_POST['_soul_product_price']);
        update_post_meta($post_id, '_soul_product_price', $price);
    }
}
add_action('save_post_soul_product', 'soul_save_quick_edit_data');

/**
 * Enqueue quick edit script
 */
function soul_enqueue_quick_edit_script($hook) {
    global $post_type;
    
    if ('edit.php' === $hook && 'soul_product' === $post_type) {
        wp_enqueue_script('soul-quick-edit', get_template_directory_uri() . '/assets/js/quick-edit.js', array('jquery'), '1.0.0', true);
    }
}
add_action('admin_enqueue_scripts', 'soul_enqueue_quick_edit_script');