<?php
/**
 * Soul Suite Form Builder - Admin UI
 * Adds Forms menu, list, and editor to WP admin.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class Soul_Suite_Forms_Admin {
    public static function init() {
        add_action( 'admin_menu', array( __CLASS__, 'register_menu' ) );
    }

    public static function register_menu() {
        add_menu_page(
            'Forms',
            'Forms',
            'manage_options',
            'soul-suite-forms',
            array( __CLASS__, 'render_forms_list' ),
            'dashicons-feedback',
            25
        );
        add_submenu_page(
            'soul-suite-forms',
            'Add New Form',
            'Add New',
            'manage_options',
            'soul-suite-form-add',
            array( __CLASS__, 'render_form_editor' )
        );
    }

    public static function render_forms_list() {
        echo '<div class="wrap"><h1>Forms</h1>';
        echo '<a href="admin.php?page=soul-suite-form-add" class="page-title-action">Add New</a>';
        // List forms from DB
        global $wpdb;
        $table = $wpdb->prefix . 'soul_suite_forms';
        $forms = $wpdb->get_results( "SELECT * FROM $table ORDER BY created_at DESC" );
        if ( $forms ) {
            echo '<table class="widefat"><thead><tr><th>Name</th><th>Slug</th><th>Created</th><th>Actions</th></tr></thead><tbody>';
            foreach ( $forms as $form ) {
                echo '<tr>';
                echo '<td>' . esc_html( $form->form_name ) . '</td>';
                echo '<td>' . esc_html( $form->form_slug ) . '</td>';
                echo '<td>' . esc_html( $form->created_at ) . '</td>';
                echo '<td><a href="admin.php?page=soul-suite-form-add&form=' . esc_attr( $form->id ) . '">Edit</a></td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>No forms found. <a href="admin.php?page=soul-suite-form-add">Create your first form</a>.</p>';
        }
        echo '</div>';
    }

    public static function render_form_editor() {
        $form_id = isset($_GET['form']) ? intval($_GET['form']) : 0;
        global $wpdb;
        $table = $wpdb->prefix . 'soul_suite_forms';
        $form = $form_id ? $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE id = %d", $form_id ) ) : null;
        $form_name = $form ? esc_attr($form->form_name) : '';
        $form_slug = $form ? esc_attr($form->form_slug) : '';
        $form_config = $form ? esc_textarea($form->form_config) : '';
        echo '<div class="wrap"><h1>' . ($form ? 'Edit Form' : 'Add New Form') . '</h1>';
        echo '<form method="post">';
        wp_nonce_field('soul_suite_save_form');
        echo '<table class="form-table">';
        echo '<tr><th><label for="form_name">Form Name</label></th><td><input name="form_name" id="form_name" value="' . $form_name . '" class="regular-text" required></td></tr>';
        echo '<tr><th><label for="form_slug">Form Slug</label></th><td><input name="form_slug" id="form_slug" value="' . $form_slug . '" class="regular-text" required></td></tr>';
        echo '<tr><th><label for="form_config">Form Config (JSON)</label></th><td><textarea name="form_config" id="form_config" rows="10" class="large-text code">' . $form_config . '</textarea></td></tr>';
        echo '</table>';
        echo '<p class="submit"><input type="submit" class="button-primary" value="' . ($form ? 'Update Form' : 'Create Form') . '"></p>';
        if ( $form ) echo '<input type="hidden" name="form_id" value="' . intval($form->id) . '">';
        echo '</form></div>';
    }
}

Soul_Suite_Forms_Admin::init();
