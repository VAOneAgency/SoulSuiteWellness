<?php
/**
 * Soul Suite Form Builder
 * 
 * Admin interface for creating and managing forms
 * 
 * @package SoulSuite
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Soul_Suite_Form_Builder {
    private $table_name;
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'soul_suite_forms';
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        add_action('wp_ajax_soul_suite_save_form', array($this, 'ajax_save_form'));
        add_action('wp_ajax_soul_suite_delete_form', array($this, 'ajax_delete_form'));
        add_action('wp_ajax_soul_suite_get_form', array($this, 'ajax_get_form'));
    }
    public static function create_tables() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'soul_suite_forms';
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            form_name varchar(255) NOT NULL,
            form_slug varchar(255) NOT NULL,
            form_config longtext NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY  (id),
            UNIQUE KEY form_slug (form_slug)
        ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        $submissions_table = $wpdb->prefix . 'soul_suite_form_submissions';
        $sql2 = "CREATE TABLE IF NOT EXISTS $submissions_table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            form_id mediumint(9) NOT NULL,
            submission_data longtext NOT NULL,
            submitted_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            ip_address varchar(45),
            user_agent text,
            PRIMARY KEY  (id),
            KEY form_id (form_id)
        ) $charset_collate;";
        dbDelta($sql2);
    }
    public function add_admin_menu() {
        add_menu_page(
            __('Soul Suite Forms', 'soul-suite'),
            __('Forms', 'soul-suite'),
            'manage_options',
            'soul-suite-forms',
            array($this, 'render_forms_page'),
            'dashicons-feedback',
            30
        );
        add_submenu_page(
            'soul-suite-forms',
            __('All Forms', 'soul-suite'),
            __('All Forms', 'soul-suite'),
            'manage_options',
            'soul-suite-forms',
            array($this, 'render_forms_page')
        );
        add_submenu_page(
            'soul-suite-forms',
            __('Add New Form', 'soul-suite'),
            __('Add New', 'soul-suite'),
            'manage_options',
            'soul-suite-forms-new',
            array($this, 'render_form_editor')
        );
        add_submenu_page(
            'soul-suite-forms',
            __('Submissions', 'soul-suite'),
            __('Submissions', 'soul-suite'),
            'manage_options',
            'soul-suite-submissions',
            array($this, 'render_submissions_page')
        );
    }
    public function enqueue_admin_scripts($hook) {
        if (strpos($hook, 'soul-suite-forms') === false) {
            return;
        }
        wp_enqueue_style('soul-suite-admin', SOUL_SUITE_ASSETS_URI . '/css/admin.css', array(), SOUL_SUITE_VERSION);
        wp_enqueue_script('soul-suite-form-builder', SOUL_SUITE_ASSETS_URI . '/js/form-builder.js', array('jquery', 'jquery-ui-sortable'), SOUL_SUITE_VERSION, true);
        wp_localize_script('soul-suite-form-builder', 'soulSuiteAdmin', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('soul_suite_forms'),
        ));
    }
    public function render_forms_page() {
        global $wpdb;
        $forms = $wpdb->get_results("SELECT * FROM {$this->table_name} ORDER BY updated_at DESC");
        include SOUL_SUITE_INC_DIR . '/admin/views/forms-list.php';
    }
    public function render_form_editor() {
        $form_id = isset($_GET['form_id']) ? intval($_GET['form_id']) : 0;
        $form = null;
        if ($form_id > 0) {
            global $wpdb;
            $form = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$this->table_name} WHERE id = %d", $form_id));
        }
        include SOUL_SUITE_INC_DIR . '/admin/views/form-editor.php';
    }
    public function render_submissions_page() {
        global $wpdb;
        $submissions_table = $wpdb->prefix . 'soul_suite_form_submissions';
        $form_id = isset($_GET['form_id']) ? intval($_GET['form_id']) : 0;
        if ($form_id > 0) {
            $submissions = $wpdb->get_results($wpdb->prepare(
                "SELECT * FROM {$submissions_table} WHERE form_id = %d ORDER BY submitted_at DESC",
                $form_id
            ));
        } else {
            $submissions = $wpdb->get_results("SELECT * FROM {$submissions_table} ORDER BY submitted_at DESC LIMIT 100");
        }
        $forms = $wpdb->get_results("SELECT id, form_name FROM {$this->table_name}");
        include SOUL_SUITE_INC_DIR . '/admin/views/submissions-list.php';
    }
    public function ajax_save_form() {
        check_ajax_referer('soul_suite_forms', 'nonce');
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Unauthorized');
        }
        $form_id = isset($_POST['form_id']) ? intval($_POST['form_id']) : 0;
        $form_name = sanitize_text_field($_POST['form_name']);
        $form_slug = sanitize_title($_POST['form_slug']);
        $form_config = wp_json_encode($_POST['form_config']);
        global $wpdb;
        if ($form_id > 0) {
            $result = $wpdb->update(
                $this->table_name,
                array(
                    'form_name' => $form_name,
                    'form_slug' => $form_slug,
                    'form_config' => $form_config,
                ),
                array('id' => $form_id),
                array('%s', '%s', '%s'),
                array('%d')
            );
        } else {
            $result = $wpdb->insert(
                $this->table_name,
                array(
                    'form_name' => $form_name,
                    'form_slug' => $form_slug,
                    'form_config' => $form_config,
                ),
                array('%s', '%s', '%s')
            );
            $form_id = $wpdb->insert_id;
        }
        if ($result !== false) {
            wp_send_json_success(array(
                'message' => 'Form saved successfully',
                'form_id' => $form_id,
            ));
        } else {
            wp_send_json_error('Failed to save form');
        }
    }
    public function ajax_delete_form() {
        check_ajax_referer('soul_suite_forms', 'nonce');
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Unauthorized');
        }
        $form_id = intval($_POST['form_id']);
        global $wpdb;
        $result = $wpdb->delete($this->table_name, array('id' => $form_id), array('%d'));
        if ($result) {
            wp_send_json_success('Form deleted successfully');
        } else {
            wp_send_json_error('Failed to delete form');
        }
    }
    public function ajax_get_form() {
        check_ajax_referer('soul_suite_forms', 'nonce');
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Unauthorized');
        }
        $form_id = intval($_POST['form_id']);
        global $wpdb;
        $form = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$this->table_name} WHERE id = %d", $form_id));
        if ($form) {
            $form->form_config = json_decode($form->form_config, true);
            wp_send_json_success($form);
        } else {
            wp_send_json_error('Form not found');
        }
    }
    public static function get_form_by_slug($slug) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'soul_suite_forms';
        $form = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table_name} WHERE form_slug = %s", $slug));
        if ($form) {
            $form->form_config = json_decode($form->form_config, true);
            return $form;
        }
        return null;
    }
    public static function save_submission($form_id, $data) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'soul_suite_form_submissions';
        $result = $wpdb->insert(
            $table_name,
            array(
                'form_id' => $form_id,
                'submission_data' => wp_json_encode($data),
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            ),
            array('%d', '%s', '%s', '%s')
        );
        return $result !== false ? $wpdb->insert_id : false;
    }
}
// Initialize form builder
new Soul_Suite_Form_Builder();
// Create tables on theme activation
register_activation_hook(__FILE__, array('Soul_Suite_Form_Builder', 'create_tables'));
