<?php
/**
 * Template Part: Form Renderer
 * 
 * Renders Soul Suite forms on the frontend
 * 
 * @package SoulSuite
 */

if (!isset($form) || !$form) {
    return;
}

$config = $form->form_config;
$fields = isset($config['fields']) ? $config['fields'] : array();
$settings = isset($config['settings']) ? $config['settings'] : array();
?>

<div class="soul-suite-form-wrapper" id="soul-suite-form-<?php echo esc_attr($form->form_slug); ?>">
    <form class="soul-suite-form" data-form-slug="<?php echo esc_attr($form->form_slug); ?>" method="POST">
        
        <?php foreach ($fields as $field): ?>
            <div class="form-field form-field-<?php echo esc_attr($field['type']); ?> <?php echo esc_attr($field['classes'] ?? ''); ?>">
                
                <?php if ($field['type'] !== 'hidden'): ?>
                    <label for="<?php echo esc_attr($field['name']); ?>">
                        <?php echo esc_html($field['label']); ?>
                        <?php if ($field['required']): ?>
                            <span class="required">*</span>
                        <?php endif; ?>
                    </label>
                <?php endif; ?>
                
                <?php
                switch ($field['type']):
                    case 'textarea':
                        ?>
                        <textarea 
                            name="<?php echo esc_attr($field['name']); ?>" 
                            id="<?php echo esc_attr($field['name']); ?>"
                            placeholder="<?php echo esc_attr($field['placeholder'] ?? ''); ?>"
                            <?php echo $field['required'] ? 'required' : ''; ?>
                            rows="4"
                        ></textarea>
                        <?php
                        break;
                    
                    case 'select':
                        ?>
                        <select 
                            name="<?php echo esc_attr($field['name']); ?>" 
                            id="<?php echo esc_attr($field['name']); ?>"
                            <?php echo $field['required'] ? 'required' : ''; ?>
                        >
                            <option value="">-- <?php _e('Select One', 'soul-suite'); ?> --</option>
                            <?php foreach ($field['options'] as $option): ?>
                                <option value="<?php echo esc_attr($option); ?>"><?php echo esc_html($option); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php
                        break;
                    
                    case 'radio':
                        ?>
                        <div class="radio-group">
                            <?php foreach ($field['options'] as $option): ?>
                                <label class="radio-label">
                                    <input 
                                        type="radio" 
                                        name="<?php echo esc_attr($field['name']); ?>" 
                                        value="<?php echo esc_attr($option); ?>"
                                        <?php echo $field['required'] ? 'required' : ''; ?>
                                    >
                                    <?php echo esc_html($option); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <?php
                        break;
                    
                    case 'checkbox':
                        ?>
                        <div class="checkbox-group">
                            <?php foreach ($field['options'] as $option): ?>
                                <label class="checkbox-label">
                                    <input 
                                        type="checkbox" 
                                        name="<?php echo esc_attr($field['name']); ?>[]" 
                                        value="<?php echo esc_attr($option); ?>"
                                    >
                                    <?php echo esc_html($option); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <?php
                        break;
                    
                    case 'hidden':
                        ?>
                        <input 
                            type="hidden" 
                            name="<?php echo esc_attr($field['name']); ?>" 
                            value="<?php echo esc_attr($field['value'] ?? ''); ?>"
                        >
                        <?php
                        break;
                    
                    default:
                        // text, email, tel, url, etc.
                        ?>
                        <input 
                            type="<?php echo esc_attr($field['type']); ?>" 
                            name="<?php echo esc_attr($field['name']); ?>" 
                            id="<?php echo esc_attr($field['name']); ?>"
                            placeholder="<?php echo esc_attr($field['placeholder'] ?? ''); ?>"
                            <?php echo $field['required'] ? 'required' : ''; ?>
                        >
                        <?php
                        break;
                endswitch;
                ?>
            </div>
        <?php endforeach; ?>
        
        <div class="form-submit">
            <button type="submit" class="submit-btn">
                <?php _e('Submit', 'soul-suite'); ?>
            </button>
        </div>
        
        <div class="form-messages" style="display: none;"></div>
        
        <?php wp_nonce_field('soul_suite_nonce', 'soul_suite_nonce'); ?>
    </form>
</div>

<script>
jQuery(document).ready(function($) {
    $('.soul-suite-form').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $messages = $form.find('.form-messages');
        var $submitBtn = $form.find('.submit-btn');
        var formSlug = $form.data('form-slug');
        
        // Disable submit button
        $submitBtn.prop('disabled', true).text('<?php _e('Submitting...', 'soul-suite'); ?>');
        
        // Serialize form data
        var formData = $form.serialize();
        formData += '&action=soul_suite_submit_form&form_slug=' + formSlug;
        
        $.ajax({
            url: soulSuite.ajaxUrl,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $messages.removeClass('error').addClass('success')
                        .html(response.data.message).fadeIn();
                    
                    // Reset form
                    $form[0].reset();
                    
                    // Redirect if URL provided
                    if (response.data.redirect) {
                        setTimeout(function() {
                            window.location.href = response.data.redirect;
                        }, 2000);
                    }
                } else {
                    $messages.removeClass('success').addClass('error')
                        .html(response.data).fadeIn();
                }
            },
            error: function() {
                $messages.removeClass('success').addClass('error')
                    .html('<?php _e('An error occurred. Please try again.', 'soul-suite'); ?>').fadeIn();
            },
            complete: function() {
                $submitBtn.prop('disabled', false).text('<?php _e('Submit', 'soul-suite'); ?>');
            }
        });
    });
});
</script>

<style>
.soul-suite-form-wrapper {
    max-width: 680px;
    margin: 40px auto;
    padding: 50px;
    background: linear-gradient(135deg, #F7F7F7 0%, rgba(83, 222, 212, 0.05) 100%);
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(36, 92, 82, 0.15);
}

.soul-suite-form .form-field {
    margin-bottom: 25px;
}

.soul-suite-form label {
    display: block;
    font-weight: 600;
    color: #245C52;
    margin-bottom: 10px;
    font-family: 'Poppins', sans-serif;
}

.soul-suite-form input[type="text"],
.soul-suite-form input[type="email"],
.soul-suite-form input[type="tel"],
.soul-suite-form input[type="url"],
.soul-suite-form select,
.soul-suite-form textarea {
    width: 100%;
    padding: 16px 20px;
    border-radius: 12px;
    border: 2px solid rgba(83, 222, 212, 0.3);
    font-size: 1rem;
    background-color: #F7F7F7;
    color: #245C52;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.soul-suite-form input:focus,
.soul-suite-form select:focus,
.soul-suite-form textarea:focus {
    outline: none;
    border-color: #53DED4;
    background-color: #fff;
    box-shadow: 0 0 0 3px rgba(83, 222, 212, 0.1);
}

.soul-suite-form .checkbox-group,
.soul-suite-form .radio-group {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.soul-suite-form .checkbox-label,
.soul-suite-form .radio-label {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    background: rgba(83, 222, 212, 0.05);
    border-radius: 10px;
    border: 1px solid rgba(83, 222, 212, 0.2);
    cursor: pointer;
    transition: all 0.3s ease;
}

.soul-suite-form .checkbox-label:hover,
.soul-suite-form .radio-label:hover {
    background: rgba(83, 222, 212, 0.1);
    border-color: #53DED4;
}

.soul-suite-form .checkbox-label input,
.soul-suite-form .radio-label input {
    width: auto;
    margin-right: 12px;
    accent-color: #53DED4;
}

.soul-suite-form .required {
    color: #DF6E46;
}

.soul-suite-form .submit-btn {
    background: linear-gradient(135deg, #DF6E46 0%, #EBA958 100%);
    color: #F7F7F7;
    border: none;
    padding: 18px 40px;
    border-radius: 50px;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.4s ease;
    box-shadow: 0 8px 25px rgba(223, 110, 70, 0.3);
    width: 100%;
}

.soul-suite-form .submit-btn:hover {
    background: linear-gradient(135deg, #EBA958 0%, #53DED4 100%);
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(83, 222, 212, 0.4);
}

.soul-suite-form .submit-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.soul-suite-form .form-messages {
    margin-top: 20px;
    padding: 15px;
    border-radius: 10px;
    font-weight: 500;
}

.soul-suite-form .form-messages.success {
    background: rgba(83, 222, 212, 0.1);
    color: #245C52;
    border: 1px solid rgba(83, 222, 212, 0.3);
}

.soul-suite-form .form-messages.error {
    background: rgba(223, 110, 70, 0.1);
    color: #245C52;
    border: 1px solid rgba(223, 110, 70, 0.3);
}
</style>
