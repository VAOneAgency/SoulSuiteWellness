<div class="wrap soul-suite-admin soul-suite-form-editor">
    <h1><?php echo $form ? __('Edit Form', 'soul-suite') : __('Create New Form', 'soul-suite'); ?></h1>
    
    <div class="soul-suite-editor-container">
        <div class="soul-suite-editor-sidebar">
            <div class="soul-suite-panel">
                <h3><?php _e('Form Settings', 'soul-suite'); ?></h3>
                <div class="form-group">
                    <label for="form-name"><?php _e('Form Name', 'soul-suite'); ?></label>
                    <input type="text" id="form-name" class="widefat" value="<?php echo $form ? esc_attr($form->form_name) : ''; ?>" placeholder="Contact Form">
                </div>
                <div class="form-group">
                    <label for="form-slug"><?php _e('Form Slug', 'soul-suite'); ?></label>
                    <input type="text" id="form-slug" class="widefat" value="<?php echo $form ? esc_attr($form->form_slug) : ''; ?>" placeholder="contact-form">
                    <p class="description"><?php _e('Used in shortcode: [soul_suite_form slug="your-slug"]', 'soul-suite'); ?></p>
                </div>
            </div>
            
            <div class="soul-suite-panel">
                <h3><?php _e('Field Types', 'soul-suite'); ?></h3>
                <div class="field-types">
                    <button class="add-field-btn" data-field-type="text">
                        <span class="dashicons dashicons-edit"></span>
                        <?php _e('Text Input', 'soul-suite'); ?>
                    </button>
                    <button class="add-field-btn" data-field-type="email">
                        <span class="dashicons dashicons-email"></span>
                        <?php _e('Email', 'soul-suite'); ?>
                    </button>
                    <button class="add-field-btn" data-field-type="tel">
                        <span class="dashicons dashicons-phone"></span>
                        <?php _e('Phone', 'soul-suite'); ?>
                    </button>
                    <button class="add-field-btn" data-field-type="textarea">
                        <span class="dashicons dashicons-text"></span>
                        <?php _e('Textarea', 'soul-suite'); ?>
                    </button>
                    <button class="add-field-btn" data-field-type="select">
                        <span class="dashicons dashicons-menu"></span>
                        <?php _e('Dropdown', 'soul-suite'); ?>
                    </button>
                    <button class="add-field-btn" data-field-type="radio">
                        <span class="dashicons dashicons-marker"></span>
                        <?php _e('Radio', 'soul-suite'); ?>
                    </button>
                    <button class="add-field-btn" data-field-type="checkbox">
                        <span class="dashicons dashicons-yes"></span>
                        <?php _e('Checkbox', 'soul-suite'); ?>
                    </button>
                    <button class="add-field-btn" data-field-type="hidden">
                        <span class="dashicons dashicons-hidden"></span>
                        <?php _e('Hidden', 'soul-suite'); ?>
                    </button>
                </div>
            </div>
            
            <div class="soul-suite-panel">
                <h3><?php _e('Form Actions', 'soul-suite'); ?></h3>
                <div class="form-group">
                    <label>
                        <input type="checkbox" id="send-email" checked>
                        <?php _e('Send email notification', 'soul-suite'); ?>
                    </label>
                </div>
                <div class="form-group" id="email-settings">
                    <label for="email-to"><?php _e('Send to', 'soul-suite'); ?></label>
                    <input type="email" id="email-to" class="widefat" value="<?php echo soul_suite_get_option('contact_email'); ?>">
                </div>
                <div class="form-group">
                    <label for="redirect-url"><?php _e('Redirect URL (optional)', 'soul-suite'); ?></label>
                    <input type="url" id="redirect-url" class="widefat" placeholder="https://example.com/thank-you">
                </div>
                <div class="form-group">
                    <label for="success-message"><?php _e('Success Message', 'soul-suite'); ?></label>
                    <textarea id="success-message" class="widefat" rows="3">Thank you for your submission!</textarea>
                </div>
            </div>
        </div>
        
        <div class="soul-suite-editor-main">
            <div class="soul-suite-form-preview">
                <h2><?php _e('Form Preview', 'soul-suite'); ?></h2>
                <div id="form-fields-container" class="form-fields-sortable">
                    <?php if ($form && !empty($form->form_config)): 
                        $config = json_decode($form->form_config, true);
                        if (!empty($config['fields'])):
                            foreach ($config['fields'] as $index => $field):
                                include SOUL_SUITE_INC_DIR . '/admin/views/field-template.php';
                            endforeach;
                        endif;
                    endif; ?>
                </div>
                <button type="button" id="preview-submit-btn" class="button button-primary button-large" disabled>
                    <?php _e('Submit', 'soul-suite'); ?>
                </button>
            </div>
        </div>
    </div>
    
    <div class="soul-suite-editor-footer">
        <button type="button" id="save-form-btn" class="button button-primary button-large">
            <?php _e('Save Form', 'soul-suite'); ?>
        </button>
        <a href="<?php echo admin_url('admin.php?page=soul-suite-forms'); ?>" class="button button-large">
            <?php _e('Cancel', 'soul-suite'); ?>
        </a>
    </div>
</div>

<input type="hidden" id="form-id" value="<?php echo $form ? $form->id : 0; ?>">

<!-- Field Edit Modal -->
<div id="field-edit-modal" class="soul-suite-modal" style="display: none;">
    <div class="soul-suite-modal-content">
        <div class="soul-suite-modal-header">
            <h2><?php _e('Edit Field', 'soul-suite'); ?></h2>
            <button class="soul-suite-modal-close">&times;</button>
        </div>
        <div class="soul-suite-modal-body">
            <div class="form-group">
                <label><?php _e('Field Label', 'soul-suite'); ?></label>
                <input type="text" id="field-label" class="widefat">
            </div>
            <div class="form-group">
                <label><?php _e('Field Name', 'soul-suite'); ?></label>
                <input type="text" id="field-name" class="widefat">
                <p class="description"><?php _e('Unique identifier for this field (no spaces)', 'soul-suite'); ?></p>
            </div>
            <div class="form-group">
                <label><?php _e('Placeholder', 'soul-suite'); ?></label>
                <input type="text" id="field-placeholder" class="widefat">
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" id="field-required">
                    <?php _e('Required field', 'soul-suite'); ?>
                </label>
            </div>
            <div class="form-group" id="field-options-group" style="display: none;">
                <label><?php _e('Options (one per line)', 'soul-suite'); ?></label>
                <textarea id="field-options" class="widefat" rows="5"></textarea>
                <p class="description"><?php _e('For select, radio, and checkbox fields', 'soul-suite'); ?></p>
            </div>
            <div class="form-group">
                <label><?php _e('CSS Classes', 'soul-suite'); ?></label>
                <input type="text" id="field-classes" class="widefat" placeholder="col-md-6 custom-class">
            </div>
        </div>
        <div class="soul-suite-modal-footer">
            <button type="button" id="save-field-btn" class="button button-primary"><?php _e('Save Field', 'soul-suite'); ?></button>
            <button type="button" class="button soul-suite-modal-close"><?php _e('Cancel', 'soul-suite'); ?></button>
        </div>
    </div>
</div>

<script type="text/template" id="field-template">
    <div class="form-field-item" data-field-index="{{index}}">
        <div class="field-header">
            <span class="field-drag-handle dashicons dashicons-menu"></span>
            <span class="field-label">{{label}}</span>
            <span class="field-type-badge">{{type}}</span>
            <div class="field-actions">
                <button class="edit-field-btn" title="<?php _e('Edit', 'soul-suite'); ?>">
                    <span class="dashicons dashicons-edit"></span>
                </button>
                <button class="delete-field-btn" title="<?php _e('Delete', 'soul-suite'); ?>">
                    <span class="dashicons dashicons-trash"></span>
                </button>
            </div>
        </div>
    </div>
</script>