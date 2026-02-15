/**
 * Soul Suite Form Builder
 * Admin JavaScript for form creation and management
 */

(function($) {
    'use strict';
    
    var FormBuilder = {
        currentFieldIndex: null,
        fields: [],
        
        init: function() {
            this.bindEvents();
            this.initSortable();
            this.loadExistingFields();
        },
        
        bindEvents: function() {
            var self = this;
            
            // Add field buttons
            $('.add-field-btn').on('click', function() {
                var fieldType = $(this).data('field-type');
                self.addField(fieldType);
            });
            
            // Save form
            $('#save-form-btn').on('click', function() {
                self.saveForm();
            });
            
            // Field actions (delegated)
            $('#form-fields-container').on('click', '.edit-field-btn', function() {
                var fieldIndex = $(this).closest('.form-field-item').data('field-index');
                self.editField(fieldIndex);
            });
            
            $('#form-fields-container').on('click', '.delete-field-btn', function() {
                if (confirm('Are you sure you want to delete this field?')) {
                    var fieldIndex = $(this).closest('.form-field-item').data('field-index');
                    self.deleteField(fieldIndex);
                }
            });
            
            // Modal controls
            $('.soul-suite-modal-close').on('click', function() {
                $('#field-edit-modal').fadeOut();
            });
            
            $('#save-field-btn').on('click', function() {
                self.saveFieldEdit();
            });
            
            // Field type change shows/hides options
            $('#field-type').on('change', function() {
                var type = $(this).val();
                if (type === 'select' || type === 'radio' || type === 'checkbox') {
                    $('#field-options-group').show();
                } else {
                    $('#field-options-group').hide();
                }
            });
            
            // Auto-generate slug from name
            $('#form-name').on('blur', function() {
                if ($('#form-slug').val() === '') {
                    var slug = $(this).val().toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                    $('#form-slug').val(slug);
                }
            });
        },
        
        initSortable: function() {
            $('#form-fields-container').sortable({
                handle: '.field-drag-handle',
                placeholder: 'field-placeholder',
                update: function() {
                    // Reorder fields array based on new DOM order
                    var newOrder = [];
                    $('#form-fields-container .form-field-item').each(function() {
                        var index = $(this).data('field-index');
                        newOrder.push(FormBuilder.fields[index]);
                    });
                    FormBuilder.fields = newOrder;
                    FormBuilder.refreshFieldIndices();
                }
            });
        },
        
        addField: function(type) {
            var field = {
                type: type,
                label: this.getDefaultLabel(type),
                name: 'field_' + Date.now(),
                placeholder: '',
                required: false,
                options: [],
                classes: ''
            };
            
            this.fields.push(field);
            this.renderField(this.fields.length - 1);
        },
        
        editField: function(index) {
            this.currentFieldIndex = index;
            var field = this.fields[index];
            
            // Populate modal
            $('#field-label').val(field.label);
            $('#field-name').val(field.name);
            $('#field-placeholder').val(field.placeholder);
            $('#field-required').prop('checked', field.required);
            $('#field-classes').val(field.classes);
            
            if (field.options && field.options.length > 0) {
                $('#field-options').val(field.options.join('\n'));
                $('#field-options-group').show();
            } else {
                $('#field-options-group').hide();
            }
            
            // Show modal
            $('#field-edit-modal').fadeIn();
        },
        
        saveFieldEdit: function() {
            if (this.currentFieldIndex === null) return;
            
            var field = this.fields[this.currentFieldIndex];
            field.label = $('#field-label').val();
            field.name = $('#field-name').val();
            field.placeholder = $('#field-placeholder').val();
            field.required = $('#field-required').is(':checked');
            field.classes = $('#field-classes').val();
            
            // Handle options for select/radio/checkbox
            if (['select', 'radio', 'checkbox'].indexOf(field.type) !== -1) {
                var optionsText = $('#field-options').val();
                field.options = optionsText.split('\n').filter(function(opt) {
                    return opt.trim() !== '';
                });
            }
            
            // Re-render the field
            this.renderField(this.currentFieldIndex);
            
            // Close modal
            $('#field-edit-modal').fadeOut();
            this.currentFieldIndex = null;
        },
        
        deleteField: function(index) {
            this.fields.splice(index, 1);
            this.refreshFieldIndices();
            this.renderAllFields();
        },
        
        renderField: function(index) {
            var field = this.fields[index];
            var template = $('#field-template').html();
            
            var html = template
                .replace(/{{index}}/g, index)
                .replace(/{{label}}/g, field.label)
                .replace(/{{type}}/g, field.type);
            
            var $existingField = $('#form-fields-container .form-field-item[data-field-index="' + index + '"]');
            if ($existingField.length) {
                $existingField.replaceWith(html);
            } else {
                $('#form-fields-container').append(html);
            }
        },
        
        renderAllFields: function() {
            $('#form-fields-container').empty();
            for (var i = 0; i < this.fields.length; i++) {
                this.renderField(i);
            }
        },
        
        refreshFieldIndices: function() {
            $('#form-fields-container .form-field-item').each(function(index) {
                $(this).attr('data-field-index', index);
            });
        },
        
        loadExistingFields: function() {
            // This would load fields from the existing form data if editing
            var formId = $('#form-id').val();
            if (formId && formId !== '0') {
                // Fields are already rendered in PHP, just need to build the fields array
                var self = this;
                $('#form-fields-container .form-field-item').each(function() {
                    // This is a simplified version - in reality, field data would be embedded
                    // For now, we'll rely on the PHP rendering
                });
            }
        },
        
        saveForm: function() {
            var formName = $('#form-name').val();
            var formSlug = $('#form-slug').val();
            var formId = $('#form-id').val();
            
            if (!formName || !formSlug) {
                alert('Please enter a form name and slug.');
                return;
            }
            
            var formConfig = {
                fields: this.fields,
                settings: {
                    sendEmail: $('#send-email').is(':checked'),
                    emailTo: $('#email-to').val(),
                    redirectUrl: $('#redirect-url').val(),
                    successMessage: $('#success-message').val()
                }
            };
            
            var $btn = $('#save-form-btn');
            $btn.prop('disabled', true).text('Saving...');
            
            $.ajax({
                url: soulSuiteAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'soul_suite_save_form',
                    nonce: soulSuiteAdmin.nonce,
                    form_id: formId,
                    form_name: formName,
                    form_slug: formSlug,
                    form_config: formConfig
                },
                success: function(response) {
                    if (response.success) {
                        alert('Form saved successfully!');
                        if (formId === '0') {
                            // Redirect to edit page for newly created form
                            window.location.href = 'admin.php?page=soul-suite-forms-new&form_id=' + response.data.form_id;
                        }
                    } else {
                        alert('Error: ' + response.data);
                    }
                },
                error: function() {
                    alert('An error occurred while saving the form.');
                },
                complete: function() {
                    $btn.prop('disabled', false).text('Save Form');
                }
            });
        },
        
        getDefaultLabel: function(type) {
            var labels = {
                'text': 'Text Field',
                'email': 'Email Address',
                'tel': 'Phone Number',
                'textarea': 'Message',
                'select': 'Select Option',
                'radio': 'Choose One',
                'checkbox': 'Checkbox',
                'hidden': 'Hidden Field'
            };
            return labels[type] || 'Field';
        }
    };
    
    // Initialize on document ready
    $(document).ready(function() {
        if ($('.soul-suite-form-editor').length) {
            FormBuilder.init();
        }
    });
    
})(jQuery);
