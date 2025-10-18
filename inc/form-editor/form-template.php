<?php
/**
 * Soulara Form Builder - Form Template
 * 
 * Template for rendering the dynamic form on the frontend
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Apply form styling
$button_bg = !empty($form_styling['button_bg']) ? $form_styling['button_bg'] : '#007bff';
$button_text = !empty($form_styling['button_text']) ? $form_styling['button_text'] : '#ffffff';
$button_hover = !empty($form_styling['button_hover']) ? $form_styling['button_hover'] : '#0069d9';
$label_color = !empty($form_styling['label_color']) ? $form_styling['label_color'] : '#333333';
$accent_color = !empty($form_styling['accent_color']) ? $form_styling['accent_color'] : '#007bff';
?>
<div class="soulara-form-container">
    <?php if (!empty($form_message)): ?>
        <div class="form-message form-message-<?php echo esc_attr($form_status); ?>">
            <?php echo wp_kses_post($form_message); ?>
        </div>
        
        <?php if ($form_status === 'success' && !empty($form_settings['redirect_url'])): ?>
            <script>
            setTimeout(function() {
                window.location.href = "<?php echo esc_url($form_settings['redirect_url']); ?>";
            }, <?php echo !empty($form_settings['redirect_delay']) ? absint($form_settings['redirect_delay']) * 1000 : 3000; ?>);
            </script>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php if ($form_status !== 'success' || empty($form_settings['hide_form_on_success'])): ?>
    <form id="soulara-form-<?php echo esc_attr($form_id); ?>" class="soulara-form" method="post">
        <input type="hidden" name="soulara_form_id" value="<?php echo esc_attr($form_id); ?>">
        <?php wp_nonce_field('soulara_form_submit', 'soulara_form_nonce'); ?>
        
        <div class="form-row">
            <div class="form-group col-md-12">
                <label><?php _e('I am:', 'monalisa'); ?></label>
                <div class="client-type-options">
                    <label class="client-type-option">
                        <input type="radio" name="client_type" value="individual" checked>
                        <span class="checkmark"></span>
                        <?php _e('Individual', 'monalisa'); ?>
                    </label>
                    <label class="client-type-option">
                        <input type="radio" name="client_type" value="business">
                        <span class="checkmark"></span>
                        <?php _e('Business', 'monalisa'); ?>
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Name field (always shown) -->
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="fullname"><?php echo !empty($form_fields['fullname']['label']) ? esc_html($form_fields['fullname']['label']) : __('Full Name', 'monalisa'); ?></label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>
        </div>
        
        <!-- Email field (always shown) -->
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="email"><?php echo !empty($form_fields['email']['label']) ? esc_html($form_fields['email']['label']) : __('Email Address', 'monalisa'); ?></label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        
        <!-- Business specific fields -->
        <div class="business-fields" style="display: none;">
            <?php if (!empty($form_fields['company']['enabled'])): ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="company"><?php echo esc_html($form_fields['company']['label']); ?></label>
                    <input type="text" class="form-control" id="company" name="company" <?php echo !empty($form_fields['company']['required']) ? 'required' : ''; ?>>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($form_fields['team_size']['enabled'])): ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="team_size"><?php echo esc_html($form_fields['team_size']['label']); ?></label>
                    <input type="number" class="form-control" id="team_size" name="team_size" min="1" <?php echo !empty($form_fields['team_size']['required']) ? 'required' : ''; ?>>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($form_fields['goals']['enabled'])): ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="goals"><?php echo esc_html($form_fields['goals']['label']); ?></label>
                    <textarea class="form-control" id="goals" name="goals" rows="3" <?php echo !empty($form_fields['goals']['required']) ? 'required' : ''; ?>></textarea>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($form_fields['attendees']['enabled'])): ?>
            <div class="form-group">
                <label><?php echo esc_html($form_fields['attendees']['label']); ?></label>
                <div id="attendees-container">
                    <div class="attendee-row">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <input type="text" class="form-control" name="attendees[0][name]" placeholder="Name">
                            </div>
                            <div class="form-group col-md-5">
                                <input type="email" class="form-control" name="attendees[0][email]" placeholder="Email">
                            </div>
                            <div class="form-group col-md-2">
                                <button type="button" class="btn btn-sm btn-secondary add-attendee">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Individual specific fields -->
        <div class="individual-fields">
            <?php if (!empty($form_fields['individual_focus']['enabled'])): ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="focus"><?php echo esc_html($form_fields['individual_focus']['label']); ?></label>
                    <textarea class="form-control" id="focus" name="focus" rows="3" <?php echo !empty($form_fields['individual_focus']['required']) ? 'required' : ''; ?>></textarea>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Services section -->
        <?php if (!empty($form_services)): ?>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label><?php echo !empty($form_fields['services']['label']) ? esc_html($form_fields['services']['label']) : __('Services Interested In', 'monalisa'); ?></label>
                <div class="services-container">
                    <?php foreach ($form_services as $index => $service): ?>
                        <div class="service-option">
                            <label>
                                <input type="checkbox" name="services[]" value="<?php echo esc_attr($service['value']); ?>" <?php checked(!empty($service['default_selected'])); ?>>
                                <span class="checkmark"></span>
                                <?php echo esc_html($service['label']); ?>
                                <?php if (!empty($service['description'])): ?>
                                    <small class="service-description"><?php echo esc_html($service['description']); ?></small>
                                <?php endif; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Contact method -->
        <?php if (!empty($form_fields['contact_method']['enabled'])): ?>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label><?php echo esc_html($form_fields['contact_method']['label']); ?></label>
                <div class="contact-method-options">
                    <label class="contact-method-option">
                        <input type="radio" name="contact_method" value="phone" checked>
                        <span class="checkmark"></span>
                        <?php _e('Phone Call', 'monalisa'); ?>
                    </label>
                    <label class="contact-method-option">
                        <input type="radio" name="contact_method" value="zoom">
                        <span class="checkmark"></span>
                        <?php _e('Zoom Meeting', 'monalisa'); ?>
                    </label>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Availability -->
        <?php if (!empty($form_fields['preferred_date']['enabled']) || !empty($form_fields['preferred_time']['enabled'])): ?>
        <div class="form-row">
            <?php if (!empty($form_fields['preferred_date']['enabled'])): ?>
            <div class="form-group col-md-6">
                <label for="preferred_date"><?php echo esc_html($form_fields['preferred_date']['label']); ?></label>
                <input type="date" class="form-control" id="preferred_date" name="preferred_date" min="<?php echo esc_attr(date('Y-m-d')); ?>" <?php echo !empty($form_fields['preferred_date']['required']) ? 'required' : ''; ?>>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($form_fields['preferred_time']['enabled'])): ?>
            <div class="form-group col-md-6">
                <label for="preferred_time"><?php echo esc_html($form_fields['preferred_time']['label']); ?></label>
                <select class="form-control" id="preferred_time" name="preferred_time" <?php echo !empty($form_fields['preferred_time']['required']) ? 'required' : ''; ?>>
                    <option value=""><?php _e('Select Time', 'monalisa'); ?></option>
                    <option value="morning"><?php _e('Morning (9AM - 12PM)', 'monalisa'); ?></option>
                    <option value="afternoon"><?php _e('Afternoon (12PM - 5PM)', 'monalisa'); ?></option>
                    <option value="evening"><?php _e('Evening (5PM - 8PM)', 'monalisa'); ?></option>
                </select>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <!-- Submit button -->
        <div class="form-row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary">
                    <?php echo !empty($form_settings['submit_text']) ? esc_html($form_settings['submit_text']) : __('Submit', 'monalisa'); ?>
                </button>
            </div>
        </div>
    </form>
    <?php endif; ?>
</div>

<style>
/* Base styles */
.soulara-form-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    font-family: inherit;
}

.soulara-form .form-row {
    margin-bottom: 20px;
}

.soulara-form .form-group {
    margin-bottom: 15px;
}

.soulara-form label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: <?php echo esc_attr($label_color); ?>;
}

.soulara-form .form-control {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    transition: border-color 0.3s;
}

.soulara-form .form-control:focus {
    border-color: <?php echo esc_attr($accent_color); ?>;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

/* Client type options */
.client-type-options,
.contact-method-options {
    display: flex;
    gap: 20px;
    margin-top: 5px;
}

.client-type-option,
.contact-method-option {
    display: flex;
    align-items: center;
    cursor: pointer;
    position: relative;
    padding-left: 30px;
}

.client-type-option input,
.contact-method-option input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.client-type-option .checkmark,
.contact-method-option .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #fff;
    border: 2px solid #ddd;
    border-radius: 50%;
    transition: all 0.2s ease-in-out;
}

.client-type-option:hover .checkmark,
.contact-method-option:hover .checkmark {
    border-color: <?php echo esc_attr($accent_color); ?>;
}

.client-type-option input:checked ~ .checkmark,
.contact-method-option input:checked ~ .checkmark {
    background-color: <?php echo esc_attr($accent_color); ?>;
    border-color: <?php echo esc_attr($accent_color); ?>;
}

.client-type-option .checkmark:after,
.contact-method-option .checkmark:after {
    content: "";
    position: absolute;
    display: none;
    top: 5px;
    left: 5px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: white;
}

.client-type-option input:checked ~ .checkmark:after,
.contact-method-option input:checked ~ .checkmark:after {
    display: block;
}

/* Services container */
.services-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.service-option {
    position: relative;
    padding-left: 30px;
}

.service-option label {
    display: flex;
    flex-direction: column;
    cursor: pointer;
    font-weight: normal;
}

.service-option input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.service-option .checkmark {
    position: absolute;
    top: 2px;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #fff;
    border: 2px solid #ddd;
    border-radius: 3px;
    transition: all 0.2s ease-in-out;
}

.service-option:hover .checkmark {
    border-color: <?php echo esc_attr($accent_color); ?>;
}

.service-option input:checked ~ .checkmark {
    background-color: <?php echo esc_attr($accent_color); ?>;
    border-color: <?php echo esc_attr($accent_color); ?>;
}

.service-option .checkmark:after {
    content: "";
    position: absolute;
    display: none;
    left: 6px;
    top: 2px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.service-option input:checked ~ .checkmark:after {
    display: block;
}

.service-description {
    display: block;
    margin-top: 3px;
    color: #666;
    font-size: 0.85em;
}

/* Attendees */
.attendee-row {
    margin-bottom: 10px;
}

.add-attendee {
    height: 38px;
    width: 100%;
}

/* Submit Button */
.btn-primary {
    background-color: <?php echo esc_attr($button_bg); ?>;
    color: <?php echo esc_attr($button_text); ?>;
    border: none;
    padding: 12px 25px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: <?php echo esc_attr($button_hover); ?>;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

/* Form messages */
.form-message {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.form-message-success {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.form-message-error {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

/* Responsive layout */
@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
    }
    
    .form-group.col-md-6,
    .form-group.col-md-5 {
        width: 100%;
        padding: 0;
    }
    
    .client-type-options,
    .contact-method-options {
        flex-direction: column;
        gap: 10px;
    }
    
    .attendee-row .form-row {
        flex-direction: column;
    }
    
    .attendee-row .form-group {
        margin-bottom: 10px;
    }
}
</style>

<script>
jQuery(document).ready(function($) {
    // Client type toggle
    $('input[name="client_type"]').change(function() {
        if ($(this).val() === 'individual') {
            $('.individual-fields').show();
            $('.business-fields').hide();
        } else {
            $('.individual-fields').hide();
            $('.business-fields').show();
        }
    });
    
    // Add attendee functionality
    $('.add-attendee').on('click', function() {
        var index = $('#attendees-container .attendee-row').length;
        var newRow = '<div class="attendee-row">' +
                     '<div class="form-row">' +
                     '<div class="form-group col-md-5">' +
                     '<input type="text" class="form-control" name="attendees[' + index + '][name]" placeholder="Name">' +
                     '</div>' +
                     '<div class="form-group col-md-5">' +
                     '<input type="email" class="form-control" name="attendees[' + index + '][email]" placeholder="Email">' +
                     '</div>' +
                     '<div class="form-group col-md-2">' +
                     '<button type="button" class="btn btn-sm btn-danger remove-attendee">-</button>' +
                     '</div>' +
                     '</div>' +
                     '</div>';
        $('#attendees-container').append(newRow);
    });
    
    // Remove attendee functionality
    $(document).on('click', '.remove-attendee', function() {
        $(this).closest('.attendee-row').remove();
    });
    
    // Initialize - show individual fields by default
    $('.individual-fields').show();
    $('.business-fields').hide();
});
</script>
