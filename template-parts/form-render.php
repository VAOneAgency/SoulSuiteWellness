<?php
/**
 * Form Render Template
 * Displays forms created with Form Builder
 */

if (!isset($form) || !$form) {
    return;
}

$config = $form->form_config;
$fields = $config['fields'] ?? array();
?>

<form class="soul-suite-dynamic-form" data-form-slug="<?php echo esc_attr($form->form_slug); ?>" method="post">
    <?php foreach ($fields as $field): ?>
        <div class="form-group">
            <?php
            $field_id = esc_attr($field['name']);
            $field_label = esc_html($field['label']);
            $field_placeholder = esc_attr($field['placeholder'] ?? '');
            $field_required = !empty($field['required']) ? 'required' : '';
            $field_classes = esc_attr($field['classes'] ?? '');
            
            switch ($field['type']):
                case 'text':
                case 'email':
                case 'tel':
                    ?>
                    <input 
                        type="<?php echo esc_attr($field['type']); ?>" 
                        name="<?php echo $field_id; ?>" 
                        id="<?php echo $field_id; ?>" 
                        placeholder="<?php echo $field_placeholder ?: $field_label; ?>"
                        class="form-control <?php echo $field_classes; ?>"
                        <?php echo $field_required; ?>
                    >
                    <?php
                    break;
                    
                case 'textarea':
                    ?>
                    <textarea 
                        name="<?php echo $field_id; ?>" 
                        id="<?php echo $field_id; ?>" 
                        placeholder="<?php echo $field_placeholder ?: $field_label; ?>"
                        class="form-control <?php echo $field_classes; ?>"
                        rows="5"
                        <?php echo $field_required; ?>
                    ></textarea>
                    <?php
                    break;
                    
                case 'select':
                    ?>
                    <select 
                        name="<?php echo $field_id; ?>" 
                        id="<?php echo $field_id; ?>"
                        class="form-control <?php echo $field_classes; ?>"
                        <?php echo $field_required; ?>
                    >
                        <option value=""><?php echo $field_label; ?></option>
                        <?php foreach ($field['options'] as $option): ?>
                            <option value="<?php echo esc_attr($option); ?>"><?php echo esc_html($option); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php
                    break;
                    
                case 'checkbox':
                    foreach ($field['options'] as $option):
                        ?>
                        <label class="checkbox-label">
                            <input 
                                type="checkbox" 
                                name="<?php echo $field_id; ?>[]" 
                                value="<?php echo esc_attr($option); ?>"
                                class="<?php echo $field_classes; ?>"
                            >
                            <?php echo esc_html($option); ?>
                        </label>
                        <?php
                    endforeach;
                    break;
                    
                case 'radio':
                    foreach ($field['options'] as $option):
                        ?>
                        <label class="radio-label">
                            <input 
                                type="radio" 
                                name="<?php echo $field_id; ?>" 
                                value="<?php echo esc_attr($option); ?>"
                                class="<?php echo $field_classes; ?>"
                                <?php echo $field_required; ?>
                            >
                            <?php echo esc_html($option); ?>
                        </label>
                        <?php
                    endforeach;
                    break;
                    
                case 'hidden':
                    ?>
                    <input type="hidden" name="<?php echo $field_id; ?>" value="<?php echo esc_attr($field['value'] ?? ''); ?>">
                    <?php
                    break;
            endswitch;
            ?>
        </div>
    <?php endforeach; ?>
    
    <?php wp_nonce_field('soul_suite_nonce', 'nonce'); ?>
    <input type="hidden" name="form_slug" value="<?php echo esc_attr($form->form_slug); ?>">
    
    <div class="form-group">
        <button type="submit" class="hero-btn primary-btn">Send Message</button>
    </div>
    
    <div class="form-message"></div>
</form>

<script>
jQuery(document).ready(function($) {
    $('.soul-suite-dynamic-form').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $btn = $form.find('button[type="submit"]');
        var $msg = $form.find('.form-message');
        
        $btn.prop('disabled', true).text('Sending...');
        $msg.html('');
        
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: $form.serialize() + '&action=soul_suite_submit_form',
            success: function(response) {
                if (response.success) {
                    $msg.html('<p style="color: #28a745; font-weight: bold; padding: 15px; background: #d4edda; border-radius: 5px;">' + response.data.message + '</p>');
                    $form[0].reset();
                    
                    // Redirect if URL provided
                    if (response.data.redirect) {
                        setTimeout(function() {
                            window.location.href = response.data.redirect;
                        }, 2000);
                    }
                } else {
                    $msg.html('<p style="color: #dc3545; font-weight: bold; padding: 15px; background: #f8d7da; border-radius: 5px;">' + response.data + '</p>');
                }
                $btn.prop('disabled', false).text('Send Message');
            },
            error: function() {
                $msg.html('<p style="color: #dc3545; font-weight: bold; padding: 15px; background: #f8d7da; border-radius: 5px;">Something went wrong. Please try again.</p>');
                $btn.prop('disabled', false).text('Send Message');
            }
        });
    });
});
</script>