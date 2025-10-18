<?php
/**
 * Product Admin Columns
 * 
 * @package Monalisa
 * @since 1.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Add custom columns to products list
 * 
 * @param array $columns Existing columns
 * @return array Modified columns
 */
function monalisa_add_product_columns($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'featured_image' => __('Image', 'monalisa'),
        'title' => $columns['title'],
        'product_cat' => __('Categories', 'monalisa'),
        'price' => __('Price', 'monalisa'),
        'stock_status' => __('Stock', 'monalisa'),
        'date' => $columns['date']
    );
    
    return $new_columns;
}
add_filter('manage_monalisa_product_posts_columns', 'monalisa_add_product_columns');

/**
 * Display custom column content
 * 
 * @param string $column Column name
 * @param int $post_id Post ID
 */
function monalisa_display_product_columns($column, $post_id) {
    switch ($column) {
        case 'featured_image':
            $thumbnail = get_the_post_thumbnail_url($post_id, 'thumbnail');
            if ($thumbnail) {
                printf(
                    '<img src="%s" alt="%s" width="50" height="50" style="border-radius: 4px;">',
                    esc_url($thumbnail),
                    esc_attr(get_the_title($post_id))
                );
            } else {
                echo '<span class="dashicons dashicons-format-image" style="font-size: 32px; width: 32px; height: 32px; color: #ddd;"></span>';
            }
            break;
            
        case 'product_cat':
            $terms = get_the_terms($post_id, 'product_category');
            if ($terms && !is_wp_error($terms)) {
                $term_links = array();
                foreach ($terms as $term) {
                    $term_links[] = sprintf(
                        '<a href="%s">%s</a>',
                        esc_url(add_query_arg('product_category', $term->slug, 'edit.php?post_type=monalisa_product')),
                        esc_html($term->name)
                    );
                }
                echo implode(', ', $term_links);
            } else {
                echo '<span class="na">—</span>';
            }
            break;
            
        case 'price':
            $price = get_post_meta($post_id, '_monalisa_product_price', true);
            $sale_price = get_post_meta($post_id, '_monalisa_product_sale_price', true);
            
            if (!empty($sale_price)) {
                echo '<del>' . wc_price($price) . '</del> <ins>' . wc_price($sale_price) . '</ins>';
            } elseif (!empty($price)) {
                echo wc_price($price);
            } else {
                echo '<span class="na">—</span>';
            }
            break;
            
        case 'stock_status':
            $stock_status = get_post_meta($post_id, '_monalisa_product_stock_status', true);
            $stock_quantity = get_post_meta($post_id, '_monalisa_product_stock_quantity', true);
            
            $statuses = array(
                'instock' => array(
                    'label' => __('In Stock', 'monalisa'),
                    'class' => 'instock',
                    'icon' => 'yes'
                ),
                'outofstock' => array(
                    'label' => __('Out of Stock', 'monalisa'),
                    'class' => 'outofstock',
                    'icon' => 'no'
                ),
                'onbackorder' => array(
                    'label' => __('On Backorder', 'monalisa'),
                    'class' => 'onbackorder',
                    'icon' => 'info'
                )
            );
            
            if (isset($statuses[$stock_status])) {
                $status = $statuses[$stock_status];
                printf(
                    '<mark class="%s"><span class="dashicons dashicons-%s"></span> %s</mark>',
                    esc_attr($status['class']),
                    esc_attr($status['icon']),
                    esc_html($status['label'])
                );
                
                if (!empty($stock_quantity) && 'outofstock' !== $stock_status) {
                    echo ' <small class="stock-quantity">(' . esc_html($stock_quantity) . ')</small>';
                }
            } else {
                echo '<span class="na">—</span>';
            }
            break;
    }
}
add_action('manage_monalisa_product_posts_custom_column', 'monalisa_display_product_columns', 10, 2);

/**
 * Make custom columns sortable
 * 
 * @param array $columns Existing sortable columns
 * @return array Modified sortable columns
 */
function monalisa_make_product_columns_sortable($columns) {
    $columns['price'] = 'price';
    $columns['stock_status'] = 'stock_status';
    return $columns;
}
add_filter('manage_edit-monalisa_product_sortable_columns', 'monalisa_make_product_columns_sortable');

/**
 * Handle sorting by custom columns
 * 
 * @param WP_Query $query The WP_Query instance
 */
function monalisa_handle_product_column_sorting($query) {
    if (!is_admin() || !$query->is_main_query() || $query->get('post_type') !== 'monalisa_product') {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    switch ($orderby) {
        case 'price':
            $query->set('meta_key', '_monalisa_product_price');
            $query->set('orderby', 'meta_value_num');
            break;
            
        case 'stock_status':
            $query->set('meta_key', '_monalisa_product_stock_status');
            $query->set('orderby', 'meta_value');
            break;
    }
}
add_action('pre_get_posts', 'monalisa_handle_product_column_sorting');

/**
 * Add custom CSS for admin columns
 */
function monalisa_product_admin_column_styles() {
    global $post_type;
    
    if ('monalisa_product' === $post_type) {
        ?>
        <style type="text/css">
            .column-featured_image {
                width: 60px;
                text-align: center;
            }
            .column-price {
                width: 120px;
            }
            .column-stock_status {
                width: 120px;
            }
            .column-product_cat {
                width: 15%;
            }
            mark {
                display: inline-block;
                padding: 4px 8px;
                border-radius: 3px;
                font-weight: 600;
                line-height: 1.4;
            }
            mark.instock {
                background: #c6e1c6;
                color: var(--color-orange);
            }
            mark.outofstock {
                background: #f8dda7;
                color: #94660c;
            }
            mark.onbackorder {
                background: #e0e0e0;
                color: #666;
            }
            .na {
                color: #999;
                font-style: italic;
            }
            .stock-quantity {
                color: #666;
                font-size: 0.9em;
            }
        </style>
        <?php
    }
}
add_action('admin_head-edit.php', 'monalisa_product_admin_column_styles');
