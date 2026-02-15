<div class="wrap soul-suite-admin">
    <h1 class="wp-heading-inline"><?php _e('Forms', 'soul-suite'); ?></h1>
    <a href="<?php echo admin_url('admin.php?page=soul-suite-forms-new'); ?>" class="page-title-action">
        <?php _e('Add New', 'soul-suite'); ?>
    </a>
    <hr class="wp-header-end">
    
    <?php if (empty($forms)): ?>
        <div class="soul-suite-empty-state">
            <div class="soul-suite-empty-icon">📝</div>
            <h2><?php _e('No forms yet', 'soul-suite'); ?></h2>
            <p><?php _e('Create your first form to start collecting submissions.', 'soul-suite'); ?></p>
            <a href="<?php echo admin_url('admin.php?page=soul-suite-forms-new'); ?>" class="button button-primary button-hero">
                <?php _e('Create Your First Form', 'soul-suite'); ?>
            </a>
        </div>
    <?php else: ?>
        <table class="wp-list-table widefat fixed striped soul-suite-forms-table">
            <thead>
                <tr>
                    <th class="column-name"><?php _e('Form Name', 'soul-suite'); ?></th>
                    <th class="column-slug"><?php _e('Shortcode', 'soul-suite'); ?></th>
                    <th class="column-submissions"><?php _e('Submissions', 'soul-suite'); ?></th>
                    <th class="column-date"><?php _e('Last Modified', 'soul-suite'); ?></th>
                    <th class="column-actions"><?php _e('Actions', 'soul-suite'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($forms as $form): 
                    global $wpdb;
                    $submissions_table = $wpdb->prefix . 'soul_suite_form_submissions';
                    $submissions_count = $wpdb->get_var($wpdb->prepare(
                        "SELECT COUNT(*) FROM {$submissions_table} WHERE form_id = %d",
                        $form->id
                    ));
                ?>
                    <tr>
                        <td class="column-name">
                            <strong>
                                <a href="<?php echo admin_url('admin.php?page=soul-suite-forms-new&form_id=' . $form->id); ?>">
                                    <?php echo esc_html($form->form_name); ?>
                                </a>
                            </strong>
                        </td>
                        <td class="column-slug">
                            <code>[soul_suite_form slug="<?php echo esc_attr($form->form_slug); ?>"]</code>
                            <button class="button button-small copy-shortcode" data-shortcode='[soul_suite_form slug="<?php echo esc_attr($form->form_slug); ?>"]'>
                                <?php _e('Copy', 'soul-suite'); ?>
                            </button>
                        </td>
                        <td class="column-submissions">
                            <a href="<?php echo admin_url('admin.php?page=soul-suite-submissions&form_id=' . $form->id); ?>">
                                <?php echo number_format($submissions_count); ?>
                            </a>
                        </td>
                        <td class="column-date">
                            <?php echo date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($form->updated_at)); ?>
                        </td>
                        <td class="column-actions">
                            <a href="<?php echo admin_url('admin.php?page=soul-suite-forms-new&form_id=' . $form->id); ?>" class="button button-small">
                                <?php _e('Edit', 'soul-suite'); ?>
                            </a>
                            <button class="button button-small button-link-delete delete-form" data-form-id="<?php echo $form->id; ?>">
                                <?php _e('Delete', 'soul-suite'); ?>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
jQuery(document).ready(function($) {
    // Copy shortcode to clipboard
    $('.copy-shortcode').on('click', function(e) {
        e.preventDefault();
        var shortcode = $(this).data('shortcode');
        navigator.clipboard.writeText(shortcode).then(function() {
            alert('Shortcode copied to clipboard!');
        });
    });
    
    // Delete form
    $('.delete-form').on('click', function(e) {
        e.preventDefault();
        
        if (!confirm('Are you sure you want to delete this form? This action cannot be undone.')) {
            return;
        }
        
        var formId = $(this).data('form-id');
        var $button = $(this);
        
        $.ajax({
            url: soulSuiteAdmin.ajaxUrl,
            type: 'POST',
            data: {
                action: 'soul_suite_delete_form',
                form_id: formId,
                nonce: soulSuiteAdmin.nonce
            },
            beforeSend: function() {
                $button.prop('disabled', true).text('Deleting...');
            },
            success: function(response) {
                if (response.success) {
                    $button.closest('tr').fadeOut(function() {
                        $(this).remove();
                    });
                } else {
                    alert('Failed to delete form: ' + response.data);
                    $button.prop('disabled', false).text('Delete');
                }
            },
            error: function() {
                alert('An error occurred while deleting the form.');
                $button.prop('disabled', false).text('Delete');
            }
        });
    });
});
</script>