<?php
/**
 * Soul Suite Form Renderer
 * Renders forms from the Soul Suite Form Builder
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function soul_suite_render_form( $slug ) {
    $form = Soul_Suite_Form_Builder::get_form_by_slug( $slug );
    if ( ! $form ) {
        return '<div class="soul-suite-form-error">Form not found.</div>';
    }
    $config = json_decode( $form->form_config, true );
    if ( ! is_array( $config ) ) {
        return '<div class="soul-suite-form-error">Invalid form configuration.</div>';
    }
    ob_start();
    echo '<form class="soul-suite-form" method="post">';
    wp_nonce_field( 'soul_suite_form_submit', 'soul_suite_form_nonce' );
    echo '<input type="hidden" name="soul_suite_form_slug" value="' . esc_attr( $form->form_slug ) . '">';
    foreach ( $config['fields'] as $field ) {
        $type = isset($field['type']) ? $field['type'] : 'text';
        $name = isset($field['name']) ? $field['name'] : '';
        $label = isset($field['label']) ? $field['label'] : '';
        $required = !empty($field['required']) ? 'required' : '';
        echo '<div class="soul-suite-form-field">';
        if ( $label ) echo '<label>' . esc_html($label) . ($required ? ' <span>*</span>' : '') . '</label>';
        switch ( $type ) {
            case 'text':
            case 'email':
            case 'hidden':
                echo '<input type="' . esc_attr($type) . '" name="' . esc_attr($name) . '" ' . $required . '>';
                break;
            case 'textarea':
                echo '<textarea name="' . esc_attr($name) . '" ' . $required . '></textarea>';
                break;
            case 'select':
                echo '<select name="' . esc_attr($name) . '" ' . $required . '>';
                foreach ( $field['options'] as $opt ) {
                    echo '<option value="' . esc_attr($opt) . '">' . esc_html($opt) . '</option>';
                }
                echo '</select>';
                break;
            case 'checkbox':
                foreach ( $field['options'] as $opt ) {
                    echo '<label><input type="checkbox" name="' . esc_attr($name) . '[]" value="' . esc_attr($opt) . '"> ' . esc_html($opt) . '</label> ';
                }
                break;
            case 'radio':
                foreach ( $field['options'] as $opt ) {
                    echo '<label><input type="radio" name="' . esc_attr($name) . '" value="' . esc_attr($opt) . '"> ' . esc_html($opt) . '</label> ';
                }
                break;
        }
        echo '</div>';
    }
    echo '<button type="submit" class="primary-btn">Submit</button>';
    echo '</form>';
    return ob_get_clean();
}

add_shortcode( 'soul_suite_form', function( $atts ) {
    $atts = shortcode_atts( array( 'slug' => '' ), $atts );
    return soul_suite_render_form( $atts['slug'] );
});
