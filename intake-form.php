<?php
/**
 * Template Name: Soul Suite Intake Form with Calendly
 *
 * Template for displaying the lead intake form page with Calendly and Square booking integration.
 *
 * @package Monalisa
 */

// Process form submission
$form_message = '';
$form_status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['soul_intake_submit'])) {
    
    // Basic validation
    $errors = array();
    
    // Sanitize and validate required fields
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $call_type = sanitize_text_field($_POST['call_type']);
    
    // Validate required fields
    if (empty($name)) {
        $errors[] = 'Full name is required.';
    }
    
    if (empty($email) || !is_email($email)) {
        $errors[] = 'Valid email address is required.';
    }
    
    if (!in_array($call_type, ['individual', 'business', 'other'])) {
        $errors[] = 'Please select a call type.';
    }
    
    // If there are no validation errors, process the form
    if (empty($errors)) {
        
        // Prepare lead data
        $services = isset($_POST['services']) ? array_map('sanitize_text_field', $_POST['services']) : array();
        $event_signup = isset($_POST['event']) && $_POST['event'] === 'yes' ? 'Yes' : 'No';
        
        // Store lead in database
        global $wpdb;
        $table_name = $wpdb->prefix . 'form_leads';
        
        // Check if table exists, create if not
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            // Include the table creation function if not already loaded
            if (!function_exists('soul_suite_create_leads_table')) {
                require_once(get_template_directory() . '/functions.php');
            }
            soul_suite_create_leads_table();
        }
        
        $result = $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'call_type' => $call_type,
                'services' => json_encode($services),
                'event_signup' => $event_signup,
                'date_submitted' => current_time('mysql'),
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'user_agent' => $_SERVER['HTTP_USER_AGENT']
            ),
            array(
                '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'
            )
        );
        
        if ($result === false) {
            $errors[] = 'Failed to save form data. Please try again.';
        } else {
            // Send notification emails
            $admin_email = 'bewell@soulsuitewellness.com';
            $site_name = get_bloginfo('name');
            
            // Admin notification
            $admin_subject = "New Intake Form Submission - " . ucfirst($call_type);
            $admin_body = "New intake form submission from {$site_name}\n\n";
            $admin_body .= "Name: {$name}\n";
            $admin_body .= "Email: {$email}\n";
            $admin_body .= "Phone: {$phone}\n";
            $admin_body .= "Call Type: " . ucfirst($call_type) . "\n";
            $admin_body .= "Additional Services: " . (empty($services) ? 'None' : implode(", ", array_map(function($s) { return ucwords(str_replace('-', ' ', $s)); }, $services))) . "\n";
            $admin_body .= "Event Signup (7/30/25): {$event_signup}\n";
            $admin_body .= "Submitted: " . current_time('F j, Y g:i a') . "\n";
            
            $headers = array(
                'Content-Type: text/plain; charset=UTF-8',
                'Reply-To: ' . $email
            );
            
            wp_mail($admin_email, $admin_subject, $admin_body, $headers);
            
            // Client confirmation email
            $client_subject = "Thank you for connecting with Soul Suite Wellness";
            $client_body = "Dear {$name},\n\n";
            $client_body .= "Thank you for your interest in Soul Suite Wellness! We received your request for a " . strtolower($call_type) . " strategy call and look forward to supporting your healing journey.\n\n";
            $client_body .= "Next Steps:\n";
            $client_body .= "You'll see our booking calendar below where you can select your preferred appointment time.\n\n";
            if ($event_signup === 'Yes') {
                $client_body .= "We've also noted your interest in our Resilience Rx: Burnout Recovery Experience on July 30th, 2025 at 6:30pm ET. We'll send you more details soon!\n\n";
            }
            $client_body .= "If you have any questions, please don't hesitate to reach out.\n\n";
            $client_body .= "With gratitude,\nSoul Suite Wellness Team\n";
            $client_body .= "bewell@soulsuitewellness.com";
            
            wp_mail($email, $client_subject, $client_body, $headers);
            
            // Set success message
            $form_status = 'success';
            $form_message = 'Thank you! Your information has been received. Please book your appointment using the calendar below.';
            
            // Set the booking type for displaying the correct calendar
            $show_booking_type = $call_type;
        }
    }
    
    if (!empty($errors)) {
        // Set error message
        $form_status = 'error';
        $form_message = '<strong>Please correct the following errors:</strong><ul>';
        foreach ($errors as $error) {
            $form_message .= '<li>' . esc_html($error) . '</li>';
        }
        $form_message .= '</ul>';
    }
}

get_header();
?>

<div id="primary" class="content-area">
    <div id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                    ?>

                    <?php if ($form_status !== 'success'): ?>
                    <form id="soul-intake-form" method="POST">
                        <h3>Book Your Strategy Call</h3>
                        
                        <div class="form-field">
                            <label for="name">Full Name*</label>
                            <input type="text" name="name" id="name" required value="<?php echo isset($_POST['name']) ? esc_attr($_POST['name']) : ''; ?>">
                        </div>

                        <div class="form-field">
                            <label for="email">Email Address*</label>
                            <input type="email" name="email" id="email" required value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>">
                        </div>

                        <div class="form-field">
                            <label for="phone">Phone Number</label>
                            <input type="tel" name="phone" id="phone" value="<?php echo isset($_POST['phone']) ? esc_attr($_POST['phone']) : ''; ?>">
                        </div>

                        <div class="form-field">
                            <label for="call_type">Select Call Type*</label>
                            <select name="call_type" id="call_type" required>
                                <option value="">-- Choose One --</option>
                                <option value="individual" <?php selected(isset($_POST['call_type']) ? $_POST['call_type'] : '', 'individual'); ?>>Individual Strategy Call</option>
                                <option value="business" <?php selected(isset($_POST['call_type']) ? $_POST['call_type'] : '', 'business'); ?>>Business Strategy Call</option>
                                <option value="other" <?php selected(isset($_POST['call_type']) ? $_POST['call_type'] : '', 'other'); ?>>Other / General Inquiry</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label>Interested in Additional Services?</label>
                            <div class="checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="services[]" value="mobile-south" <?php echo (isset($_POST['services']) && in_array('mobile-south', $_POST['services'])) ? 'checked' : ''; ?>>
                                    Mobile Reiki - South Atlanta
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="services[]" value="mobile-metro" <?php echo (isset($_POST['services']) && in_array('mobile-metro', $_POST['services'])) ? 'checked' : ''; ?>>
                                    Mobile Reiki - Metro Atlanta
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="services[]" value="mobile-outside" <?php echo (isset($_POST['services']) && in_array('mobile-outside', $_POST['services'])) ? 'checked' : ''; ?>>
                                    Mobile Reiki - Outside Metro (30 mi)
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="services[]" value="virtual" <?php echo (isset($_POST['services']) && in_array('virtual', $_POST['services'])) ? 'checked' : ''; ?>>
                                    Virtual Reiki Session
                                </label>
                            </div>
                        </div>

                        <div class="form-field">
                            <label>Want to attend our upcoming event?</label>
                            <div class="event-signup">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="event" value="yes" <?php echo (isset($_POST['event']) && $_POST['event'] === 'yes') ? 'checked' : ''; ?>>
                                    Resilience Rx: Burnout Recovery Experience <strong>7/30/25 – 6:30pm ET</strong>
                                </label>
                            </div>
                        </div>

                        <input type="hidden" name="soul_intake_submit" value="1">
                        <button type="submit">Submit & Continue to Booking</button>
                    </form>
                    <?php endif; ?>

                    <?php if (!empty($form_message)): ?>
                    <div id="form-message" class="<?php echo $form_status; ?>">
                        <?php echo $form_message; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($form_status === 'success' && isset($show_booking_type)): ?>
                    <!-- Calendly Booking Section -->
                    <div id="booking-section">
                        <h3 class="booking-title">📅 Select Your Appointment Time</h3>
                        
                        <?php if ($show_booking_type === 'other'): ?>
                        <!-- General Inquiry Calendly -->
                        <div class="calendly-inline-widget" 
                             data-url="https://calendly.com/soulsuitewellness/general-inquiry?hide_event_type_details=1&hide_gdpr_banner=1&primary_color=53ded4"
                             style="min-width:320px;height:700px;">
                        </div>
                        <?php else: ?>
                        <!-- Individual/Business Calendly -->
                        <div class="calendly-inline-widget" 
                             data-url="https://calendly.com/soulsuitewellness/<?php echo $show_booking_type === 'individual' ? 'individual-strategy-call' : 'business-strategy-call'; ?>?hide_event_type_details=1&hide_gdpr_banner=1&primary_color=53ded4"
                             style="min-width:320px;height:700px;">
                        </div>
                        
                        <!-- Square Booking Fallback (only for individual/business) -->
                        <div class="booking-fallback">
                            <p>Having trouble with the calendar above? You can also book directly through Square:</p>
                            <a href="<?php echo $show_booking_type === 'individual' ? 'https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/GJZY3CEHIIJR6XSGCXQR6D6P' : 'https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/HWYWQ6UMI4Q34K3TM27C7EU4'; ?>" 
                               class="square-booking-btn" 
                               target="_blank">
                                Book via Square Appointments →
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Calendly Script -->
                    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
                    
                    <!-- Pre-fill Calendly with form data -->
                    <script>
                    window.addEventListener('load', function() {
                        // Check if Calendly is loaded
                        var checkCalendly = setInterval(function() {
                            if (typeof Calendly !== 'undefined') {
                                clearInterval(checkCalendly);
                                
                                // Pre-fill the Calendly form with the submitted data
                                var prefillData = {
                                    name: '<?php echo esc_js($name); ?>',
                                    email: '<?php echo esc_js($email); ?>',
                                    customAnswers: {
                                        a1: '<?php echo esc_js($phone); ?>', // Phone number as custom answer
                                        a2: 'Call type: <?php echo esc_js(ucfirst($show_booking_type)); ?>' // Include call type in notes
                                    }
                                };
                                
                                // Get the Calendly iframe
                                var calendlyFrame = document.querySelector('.calendly-inline-widget iframe');
                                if (calendlyFrame) {
                                    // Wait for the iframe to load
                                    calendlyFrame.onload = function() {
                                        calendlyFrame.contentWindow.postMessage({
                                            event: 'calendly.prefill',
                                            prefill: prefillData
                                        }, 'https://calendly.com');
                                    };
                                }
                            }
                        }, 100);
                    });
                    </script>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@400;600;700&display=swap');

#soul-intake-form {
    background: linear-gradient(135deg, #F7F7F7 0%, rgba(83, 222, 212, 0.05) 100%);
    padding: 50px;
    max-width: 680px;
    margin: 40px auto;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(36, 92, 82, 0.15), 0 8px 25px rgba(36, 92, 82, 0.08);
    font-family: 'Poppins', sans-serif;
    border: 1px solid rgba(83, 222, 212, 0.2);
    position: relative;
    overflow: hidden;
}

#soul-intake-form::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #53DED4 0%, #EBA958 50%, #DF6E46 100%);
}

#soul-intake-form h3, .booking-title {
    font-family: 'Playfair Display', serif;
    color: #245C52;
    font-size: 2.2rem;
    margin-bottom: 35px;
    text-align: center;
    font-weight: 700;
    position: relative;
}

#soul-intake-form h3::after {
    content: '✨';
    font-family: 'Dancing Script', cursive;
    position: absolute;
    right: -30px;
    top: -5px;
    font-size: 1.5rem;
    color: #EBA958;
}

.form-field {
    margin-bottom: 28px;
    position: relative;
}

#soul-intake-form label {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 1rem;
    color: #245C52;
    display: block;
    margin-bottom: 10px;
    letter-spacing: 0.3px;
}

#soul-intake-form input, 
#soul-intake-form select {
    width: 100%;
    padding: 16px 20px;
    border-radius: 12px;
    border: 2px solid rgba(83, 222, 212, 0.3);
    font-size: 1rem;
    background-color: #F7F7F7;
    color: #245C52;
    font-family: 'Poppins', sans-serif;
    box-sizing: border-box;
    transition: all 0.3s ease;
    font-weight: 400;
}

#soul-intake-form input:focus, 
#soul-intake-form select:focus {
    outline: none;
    border-color: #53DED4;
    background-color: #fff;
    box-shadow: 0 0 0 3px rgba(83, 222, 212, 0.1);
    transform: translateY(-1px);
}

.checkbox-group {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 15px;
    margin-top: 12px;
}

.checkbox-label {
    display: flex !important;
    align-items: center;
    font-family: 'Poppins', sans-serif !important;
    font-weight: 400 !important;
    color: #245C52 !important;
    cursor: pointer;
    padding: 12px 15px;
    background: rgba(83, 222, 212, 0.05);
    border-radius: 10px;
    border: 1px solid rgba(83, 222, 212, 0.2);
    transition: all 0.3s ease;
}

.checkbox-label:hover {
    background: rgba(83, 222, 212, 0.1);
    border-color: #53DED4;
    transform: translateY(-1px);
}

.checkbox-label input[type="checkbox"] {
    width: auto !important;
    margin-right: 12px;
    margin-bottom: 0;
    accent-color: #53DED4;
    transform: scale(1.2);
}

.event-signup {
    background: linear-gradient(135deg, rgba(235, 169, 88, 0.1) 0%, rgba(235, 169, 88, 0.05) 100%);
    padding: 20px;
    border-radius: 15px;
    border-left: 4px solid #EBA958;
    margin-top: 12px;
    position: relative;
}

.event-signup::before {
    content: '🌟';
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 1.5rem;
}

.event-signup .checkbox-label {
    background: rgba(235, 169, 88, 0.15);
    border-color: rgba(235, 169, 88, 0.4);
    color: #245C52 !important;
    font-weight: 500 !important;
}

.event-signup .checkbox-label:hover {
    background: rgba(235, 169, 88, 0.2);
    border-color: #EBA958;
}

#soul-intake-form button {
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
    margin-top: 30px;
    position: relative;
    overflow: hidden;
}

#soul-intake-form button:hover {
    background: linear-gradient(135deg, #EBA958 0%, #53DED4 100%);
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(83, 222, 212, 0.4);
}

#soul-intake-form button:active {
    transform: translateY(-1px);
}

#form-message {
    margin: 30px auto;
    text-align: center;
    padding: 25px;
    border-radius: 15px;
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    font-weight: 500;
    max-width: 680px;
    position: relative;
}

#form-message.success {
    background: linear-gradient(135deg, rgba(83, 222, 212, 0.1) 0%, rgba(83, 222, 212, 0.05) 100%);
    color: #245C52;
    border-left: 5px solid #53DED4;
    border: 1px solid rgba(83, 222, 212, 0.3);
}

#form-message.success::before {
    content: '✨';
    position: absolute;
    top: 20px;
    right: 25px;
    font-size: 1.5rem;
}

#form-message.error {
    background: linear-gradient(135deg, rgba(223, 110, 70, 0.1) 0%, rgba(223, 110, 70, 0.05) 100%);
    color: #245C52;
    border-left: 5px solid #DF6E46;
    border: 1px solid rgba(223, 110, 70, 0.3);
}

#form-message.error ul {
    text-align: left;
    padding-left: 20px;
    margin-top: 15px;
}

#form-message.error li {
    margin-bottom: 8px;
}

/* Booking Section Styles */
#booking-section {
    max-width: 1000px;
    margin: 50px auto;
    padding: 40px;
    background: linear-gradient(135deg, #F7F7F7 0%, rgba(83, 222, 212, 0.03) 100%);
    border-radius: 20px;
    box-shadow: 0 15px 45px rgba(36, 92, 82, 0.1);
}

.booking-title {
    margin-bottom: 30px;
}

.calendly-inline-widget {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(36, 92, 82, 0.08);
    margin-bottom: 30px;
}

.booking-fallback {
    text-align: center;
    padding: 30px;
    background: rgba(235, 169, 88, 0.05);
    border-radius: 15px;
    border: 1px solid rgba(235, 169, 88, 0.2);
    margin-top: 30px;
}

.booking-fallback p {
    font-family: 'Poppins', sans-serif;
    color: #245C52;
    margin-bottom: 20px;
    font-size: 1rem;
}

.square-booking-btn {
    display: inline-block;
    background: linear-gradient(135deg, #53DED4 0%, #245C52 100%);
    color: #F7F7F7;
    padding: 15px 35px;
    border-radius: 50px;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(83, 222, 212, 0.3);
}

.square-booking-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(83, 222, 212, 0.4);
    color: #F7F7F7;
    text-decoration: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    #soul-intake-form {
        margin: 20px;
        padding: 35px 25px;
    }
    
    #soul-intake-form h3, .booking-title {
        font-size: 1.8rem;
    }
    
    #soul-intake-form h3::after {
        right: -20px;
        font-size: 1.2rem;
    }
    
    .checkbox-group {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    #soul-intake-form button {
        padding: 16px 32px;
        font-size: 1rem;
    }
    
    #booking-section {
        padding: 25px;
        margin: 30px 15px;
    }
    
    .calendly-inline-widget {
        height: 600px !important;
    }
}

@media (max-width: 480px) {
    #soul-intake-form {
        margin: 15px;
        padding: 25px 20px;
    }
    
    #soul-intake-form h3, .booking-title {
        font-size: 1.6rem;
    }
    
    .checkbox-label, .event-signup .checkbox-label {
        padding: 10px 12px;
        font-size: 0.9rem;
    }
}

/* Loading Animation for Submit Button */
#soul-intake-form button.loading {
    background: linear-gradient(135deg, #245C52 0%, #245C52 100%);
    cursor: not-allowed;
}

#soul-intake-form button.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -10px 0 0 -10px;
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid #F7F7F7;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
// Add loading state to form submission
jQuery(document).ready(function($) {
    $('#soul-intake-form').on('submit', function() {
        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        
        // Only add loading state if form is valid
        if (this.checkValidity()) {
            $submitBtn.addClass('loading').html('');
        }
    });
});
</script>

<?php
get_footer();
?>