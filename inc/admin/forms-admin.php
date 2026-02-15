<?php
/**
 * Soul Suite Forms - Admin Interface
 * COMPLETE WORKING VERSION
 * 
 * @package SoulSuite
 */

if (!defined('ABSPATH')) exit;

/**
 * Enqueue admin scripts and styles
 */
add_action('admin_enqueue_scripts', 'soul_suite_forms_admin_scripts');
function soul_suite_forms_admin_scripts($hook) {
    // Only load on our form pages
    if (strpos($hook, 'soul-suite-forms') === false) {
        return;
    }
    
    // Localize script with ajaxurl
    wp_localize_script('jquery', 'soulSuiteAdmin', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('soul_suite_forms')
    ));
}

/**
 * Add admin menu for Forms
 */
add_action('admin_menu', 'soul_suite_forms_admin_menu');
function soul_suite_forms_admin_menu() {
    add_menu_page(
        __('Soul Suite Forms', 'soul-suite'),
        __('Forms', 'soul-suite'),
        'manage_options',
        'soul-suite-forms',
        'soul_suite_forms_list_page',
        'dashicons-feedback',
        30
    );
    
    add_submenu_page(
        'soul-suite-forms',
        __('All Forms', 'soul-suite'),
        __('All Forms', 'soul-suite'),
        'manage_options',
        'soul-suite-forms',
        'soul_suite_forms_list_page'
    );
    
    add_submenu_page(
        'soul-suite-forms',
        __('Add New', 'soul-suite'),
        __('Add New', 'soul-suite'),
        'manage_options',
        'soul-suite-forms-new',
        'soul_suite_forms_editor_page'
    );
    
    add_submenu_page(
        'soul-suite-forms',
        __('Submissions', 'soul-suite'),
        __('Submissions', 'soul-suite'),
        'manage_options',
        'soul-suite-submissions',
        'soul_suite_forms_submissions_page'
    );
}

/**
 * Forms List Page
 */
function soul_suite_forms_list_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'soul_suite_forms';
    
    // Handle delete action
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['form_id'])) {
        check_admin_referer('delete-form-' . $_GET['form_id']);
        $wpdb->delete($table_name, array('id' => intval($_GET['form_id'])));
        echo '<div class="notice notice-success"><p>Form deleted successfully!</p></div>';
    }
    
    $forms = $wpdb->get_results("SELECT * FROM $table_name ORDER BY updated_at DESC");
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Soul Suite Forms</h1>
        <a href="<?php echo admin_url('admin.php?page=soul-suite-forms-new'); ?>" class="page-title-action">Add New</a>
        <hr class="wp-header-end">
        
        <?php if (empty($forms)): ?>
            <p>No forms found. <a href="<?php echo admin_url('admin.php?page=soul-suite-forms-new'); ?>">Create your first form!</a></p>
        <?php else: ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Form Name</th>
                        <th>Shortcode</th>
                        <th>Submissions</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($forms as $form): 
                        $submissions_table = $wpdb->prefix . 'soul_suite_form_submissions';
                        $count = $wpdb->get_var($wpdb->prepare(
                            "SELECT COUNT(*) FROM $submissions_table WHERE form_id = %d",
                            $form->id
                        ));
                    ?>
                    <tr>
                        <td><strong><?php echo esc_html($form->form_name); ?></strong></td>
                        <td>
                            <input type="text" value='[soul_suite_form slug="<?php echo esc_attr($form->form_slug); ?>"]' readonly onclick="this.select();" style="width: 300px;">
                        </td>
                        <td><?php echo intval($count); ?></td>
                        <td><?php echo date('Y-m-d H:i', strtotime($form->updated_at)); ?></td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=soul-suite-forms-new&form_id=' . $form->id); ?>">Edit</a> |
                            <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=soul-suite-forms&action=delete&form_id=' . $form->id), 'delete-form-' . $form->id); ?>" onclick="return confirm('Are you sure?');" style="color: #b32d2e;">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Form Editor Page
 */
function soul_suite_forms_editor_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'soul_suite_forms';
    $form_id = isset($_GET['form_id']) ? intval($_GET['form_id']) : 0;
    $form = null;
    
    if ($form_id > 0) {
        $form = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $form_id));
        if ($form) {
            $form->form_config = json_decode($form->form_config, true);
        }
    }
    
    // Default form config
    if (!$form) {
        $form = (object) array(
            'id' => 0,
            'form_name' => '',
            'form_slug' => '',
            'form_config' => array(
                'fields' => array(),
                'settings' => array(
                    'sendEmail' => true,
                    'emailTo' => get_option('admin_email'),
                    'successMessage' => 'Thank you for your submission!',
                    'redirectUrl' => ''
                )
            )
        );
    }
    ?>
    <div class="wrap">
        <h1><?php echo $form_id > 0 ? 'Edit Form' : 'Add New Form'; ?></h1>
        
        <form id="form-editor" method="post">
            <table class="form-table">
                <tr>
                    <th><label for="form-name">Form Name</label></th>
                    <td><input type="text" id="form-name" name="form_name" value="<?php echo esc_attr($form->form_name); ?>" class="regular-text" required></td>
                </tr>
                <tr>
                    <th><label for="form-slug">Form Slug</label></th>
                    <td>
                        <input type="text" id="form-slug" name="form_slug" value="<?php echo esc_attr($form->form_slug); ?>" class="regular-text" required>
                        <p class="description">Used in shortcode: [soul_suite_form slug="<strong>your-slug</strong>"]</p>
                    </td>
                </tr>
            </table>
            
            <h2>Form Fields</h2>
            <p><button type="button" class="button add-field" data-type="text">+ Text</button>
            <button type="button" class="button add-field" data-type="email">+ Email</button>
            <button type="button" class="button add-field" data-type="tel">+ Phone</button>
            <button type="button" class="button add-field" data-type="textarea">+ Textarea</button>
            <button type="button" class="button add-field" data-type="select">+ Dropdown</button></p>
            
            <div id="fields-container">
                <?php if (!empty($form->form_config['fields'])): ?>
                    <?php foreach ($form->form_config['fields'] as $index => $field): ?>
                        <div class="field-item" style="background:#fff;border:1px solid #ddd;padding:15px;margin:10px 0;">
                            <strong><?php echo esc_html($field['label']); ?></strong> (<?php echo esc_html($field['type']); ?>)
                            <button type="button" class="button button-small delete-field" style="float:right;">Delete</button>
                            <input type="hidden" name="fields[<?php echo $index; ?>][type]" value="<?php echo esc_attr($field['type']); ?>">
                            <input type="hidden" name="fields[<?php echo $index; ?>][label]" value="<?php echo esc_attr($field['label']); ?>">
                            <input type="hidden" name="fields[<?php echo $index; ?>][name]" value="<?php echo esc_attr($field['name']); ?>">
                            <input type="hidden" name="fields[<?php echo $index; ?>][placeholder]" value="<?php echo esc_attr($field['placeholder'] ?? ''); ?>">
                            <input type="hidden" name="fields[<?php echo $index; ?>][required]" value="<?php echo !empty($field['required']) ? '1' : '0'; ?>">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <h2>Form Settings</h2>
            <table class="form-table">
                <tr>
                    <th><label>Send Email Notification</label></th>
                    <td><input type="checkbox" name="settings[sendEmail]" value="1" <?php checked(!empty($form->form_config['settings']['sendEmail'])); ?>></td>
                </tr>
                <tr>
                    <th><label for="email-to">Email Address</label></th>
                    <td><input type="email" id="email-to" name="settings[emailTo]" value="<?php echo esc_attr($form->form_config['settings']['emailTo'] ?? get_option('admin_email')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="success-message">Success Message</label></th>
                    <td><textarea id="success-message" name="settings[successMessage]" rows="3" class="large-text"><?php echo esc_textarea($form->form_config['settings']['successMessage'] ?? ''); ?></textarea></td>
                </tr>
            </table>
            
            <input type="hidden" name="form_id" value="<?php echo $form_id; ?>">
            <?php wp_nonce_field('soul_suite_forms', 'soul_suite_forms_nonce'); ?>
            
            <p class="submit">
                <button type="submit" class="button button-primary button-large">Save Form</button>
            </p>
        </form>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        let fieldIndex = <?php echo !empty($form->form_config['fields']) ? count($form->form_config['fields']) : 0; ?>;
        
        // Add field
        $('.add-field').on('click', function() {
            const type = $(this).data('type');
            const label = prompt('Enter field label:');
            if (!label) return;
            
            const name = label.toLowerCase().replace(/[^a-z0-9]/g, '_');
            const html = `
                <div class="field-item" style="background:#fff;border:1px solid #ddd;padding:15px;margin:10px 0;">
                    <strong>${label}</strong> (${type})
                    <button type="button" class="button button-small delete-field" style="float:right;">Delete</button>
                    <input type="hidden" name="fields[${fieldIndex}][type]" value="${type}">
                    <input type="hidden" name="fields[${fieldIndex}][label]" value="${label}">
                    <input type="hidden" name="fields[${fieldIndex}][name]" value="${name}">
                    <input type="hidden" name="fields[${fieldIndex}][placeholder]" value="">
                    <input type="hidden" name="fields[${fieldIndex}][required]" value="1">
                </div>
            `;
            
            $('#fields-container').append(html);
            fieldIndex++;
        });
        
        // Delete field
        $(document).on('click', '.delete-field', function() {
            if (confirm('Delete this field?')) {
                $(this).closest('.field-item').remove();
            }
        });
        
        // Auto-generate slug
        $('#form-name').on('blur', function() {
            if ($('#form-slug').val() === '') {
                const slug = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
                $('#form-slug').val(slug);
            }
        });
        
        // Save form
        $('#form-editor').on('submit', function(e) {
            e.preventDefault();
            
            const formData = $(this).serialize() + '&action=soul_suite_save_form';
            
            $.post(ajaxurl, formData, function(response) {
                if (response.success) {
                    alert('Form saved successfully!');
                    const formId = response.data.form_id;
                    if (formId && !$('input[name="form_id"]').val()) {
                        window.location.href = '<?php echo admin_url('admin.php?page=soul-suite-forms-new&form_id='); ?>' + formId;
                    } else {
                        location.reload();
                    }
                } else {
                    alert('Error: ' + response.data);
                }
            });
        });
    });
    </script>
    <?php
}

/**
 * Submissions Page
 */
function soul_suite_forms_submissions_page() {
    global $wpdb;
    $submissions_table = $wpdb->prefix . 'soul_suite_form_submissions';
    $forms_table = $wpdb->prefix . 'soul_suite_forms';
    
    $submissions = $wpdb->get_results("
        SELECT s.*, f.form_name 
        FROM $submissions_table s
        LEFT JOIN $forms_table f ON s.form_id = f.id
        ORDER BY s.submitted_at DESC
        LIMIT 100
    ");
    ?>
    <div class="wrap">
        <h1>Form Submissions</h1>
        
        <?php if (empty($submissions)): ?>
            <p>No submissions yet.</p>
        <?php else: ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Form</th>
                        <th>Submitted</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submissions as $sub): 
                        $data = json_decode($sub->submission_data, true);
                    ?>
                    <tr>
                        <td><?php echo esc_html($sub->form_name); ?></td>
                        <td><?php echo date('Y-m-d H:i', strtotime($sub->submitted_at)); ?></td>
                        <td>
                            <?php foreach ($data as $key => $value): ?>
                                <strong><?php echo esc_html(ucwords(str_replace('_', ' ', $key))); ?>:</strong> 
                                <?php echo esc_html(is_array($value) ? implode(', ', $value) : $value); ?><br>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * AJAX: Save Form
 */
add_action('wp_ajax_soul_suite_save_form', function() {
    check_ajax_referer('soul_suite_forms', 'soul_suite_forms_nonce');
    
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Unauthorized');
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'soul_suite_forms';
    
    $form_id = intval($_POST['form_id'] ?? 0);
    $form_name = sanitize_text_field($_POST['form_name']);
    $form_slug = sanitize_title($_POST['form_slug']);
    
    // Build fields array
    $fields = array();
    if (!empty($_POST['fields']) && is_array($_POST['fields'])) {
        foreach ($_POST['fields'] as $field) {
            $fields[] = array(
                'type' => sanitize_text_field($field['type']),
                'label' => sanitize_text_field($field['label']),
                'name' => sanitize_text_field($field['name']),
                'placeholder' => sanitize_text_field($field['placeholder'] ?? ''),
                'required' => !empty($field['required']),
            );
        }
    }
    
    // Build settings
    $settings = array(
        'sendEmail' => !empty($_POST['settings']['sendEmail']),
        'emailTo' => sanitize_email($_POST['settings']['emailTo'] ?? get_option('admin_email')),
        'successMessage' => sanitize_textarea_field($_POST['settings']['successMessage'] ?? ''),
        'redirectUrl' => esc_url_raw($_POST['settings']['redirectUrl'] ?? ''),
    );
    
    $form_config = wp_json_encode(array(
        'fields' => $fields,
        'settings' => $settings
    ));
    
    if ($form_id > 0) {
        $wpdb->update(
            $table_name,
            array('form_name' => $form_name, 'form_slug' => $form_slug, 'form_config' => $form_config),
            array('id' => $form_id)
        );
    } else {
        $wpdb->insert(
            $table_name,
            array('form_name' => $form_name, 'form_slug' => $form_slug, 'form_config' => $form_config)
        );
        $form_id = $wpdb->insert_id;
    }
    
    wp_send_json_success(array('form_id' => $form_id));
});