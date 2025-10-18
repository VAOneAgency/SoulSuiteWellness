<?php
/**
Template Name: Intake Form
 *
 * Template for displaying the lead intake form page.
 *
 * @package Monalisa
 */

// Process form submission
$form_message = '';
$form_status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['client_type'], $_POST['fullname'], $_POST['email'])) {
    
    // Basic validation
    $errors = array();
    
    // Sanitize and validate required fields
    $type = sanitize_text_field($_POST['client_type']);
    $name = sanitize_text_field($_POST['fullname']);
    $email = sanitize_email($_POST['email']);
    
    // Validate required fields
    if (empty($name)) {
        $errors[] = 'Full name is required.';
    }
    
    if (empty($email) || !is_email($email)) {
        $errors[] = 'Valid email address is required.';
    }
    
    if (!in_array($type, ['individual', 'business'])) {
        $errors[] = 'Invalid client type selected.';
    }
    
    // If there are no validation errors, process the form
    if (empty($errors)) {
        $admin_email = 'bewell@soulsuitewellness.com';
        $site_name = get_bloginfo('name');
        
        // Prepare lead data for database
        $lead_data = array(
            'client_type' => $type,
            'fullname' => $name,
            'email' => $email,
            'date_submitted' => current_time('mysql'),
            'services' => isset($_POST['services']) ? array_map('sanitize_text_field', $_POST['services']) : array(),
            'contact_method' => isset($_POST['contact_method']) ? sanitize_text_field($_POST['contact_method']) : ''
        );
        
        // Add individual-specific fields
        if ($type === 'individual') {
            $lead_data['focus'] = isset($_POST['focus']) ? sanitize_textarea_field($_POST['focus']) : '';
        }
        
        // Add business-specific fields
        if ($type === 'business') {
            $lead_data['company'] = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
            $lead_data['goals'] = isset($_POST['goals']) ? sanitize_textarea_field($_POST['goals']) : '';
            $lead_data['team_size'] = isset($_POST['team_size']) ? intval($_POST['team_size']) : 0;
            
            // Process attendee information
            $attendees = array();
            if (!empty($_POST['attendees']) && is_array($_POST['attendees'])) {
                foreach ($_POST['attendees'] as $i => $attendee) {
                    if (is_array($attendee) && !empty($attendee['name']) && !empty($attendee['email'])) {
                        $attendees[] = array(
                            'name' => sanitize_text_field($attendee['name']),
                            'email' => sanitize_email($attendee['email'])
                        );
                    }
                }
            }
            $lead_data['attendees'] = $attendees;
        }
        
        // Store lead in database using WordPress custom table or options
        // For simplicity, we'll use transients for now - in a real implementation, you'd use a custom table
        $leads = get_option('soulara_intake_leads', array());
        $leads[] = $lead_data;
        update_option('soulara_intake_leads', $leads);
        
        // Prepare email content
        $email_subject = "New Lead: {$name} - {$type} Client";
        
        $email_body = "New lead submission from {$site_name}\n\n";
        $email_body .= "Client Type: " . ucfirst($type) . "\n";
        $email_body .= "Full Name: {$name}\n";
        $email_body .= "Email: {$email}\n\n";
        
        // Add services
        if (!empty($lead_data['services'])) {
            $email_body .= "Interested Services: \n";
            foreach ($lead_data['services'] as $service) {
                $email_body .= "- " . ucfirst(str_replace('-', ' ', $service)) . "\n";
            }
            $email_body .= "\n";
        }
        
        // Add contact preference
        $email_body .= "Preferred Contact Method: " . ucfirst($lead_data['contact_method']) . "\n\n";
        
        if ($type === 'individual') {
            if (!empty($lead_data['focus'])) {
                $email_body .= "Focus/Concern: {$lead_data['focus']}\n\n";
            }
        } else {
            $email_body .= "Company: {$lead_data['company']}\n";
            if (!empty($lead_data['goals'])) {
                $email_body .= "Goals: {$lead_data['goals']}\n";
            }
            $email_body .= "Team Size: {$lead_data['team_size']}\n\n";
            
            if (!empty($attendees)) {
                $email_body .= "Additional Attendees:\n";
                foreach ($attendees as $attendee) {
                    $email_body .= "- {$attendee['name']} ({$attendee['email']})\n";
                }
            }
        }
        
        // Send notification email to admin
        $headers = array('Content-Type: text/plain; charset=UTF-8');
        wp_mail($admin_email, $email_subject, $email_body, $headers);
        
        // Set success message and redirect to Square booking
        $form_status = 'success';
        $form_message = 'Thank you! Your information has been received. Redirecting to booking calendar...';
        
        // Determine redirect URL based on client type
        if ($type === 'individual') {
            $redirect_url = 'https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/GJZY3CEHIIJR6XSGCXQR6D6P';
        } else {
            $redirect_url = 'https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/HWYWQ6UMI4Q34K3TM27C7EU4';
        }
        
    } else {
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
monalisa_single_banner();
?>

<div id="primary" class="content-area">
    <div id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    while (have_posts()) : the_post();
                        // Display the page content before the form (if any)
                        the_content();
                    endwhile;
                    ?>

                    <form id="soulara-lead-form" method="POST">
                        <div class="form-field">
                            <label>Are you booking as a...</label>
                            <select name="client_type" id="client_type" required>
                                <option value="">Select one</option>
                                <option value="individual">Individual</option>
                                <option value="business">Business</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label for="fullname">Full Name</label>
                            <input type="text" name="fullname" id="fullname" required>
                        </div>

                        <div class="form-field">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" required>
                        </div>

                        <div class="form-field">
                            <label>What services are you interested in? (Check all that apply)</label>
                            <div class="checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="services[]" value="wellness-coaching"> Wellness Coaching
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="services[]" value="meditation"> Meditation Sessions
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="services[]" value="corporate-wellness"> Corporate Wellness Programs
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="services[]" value="stress-management"> Stress Management
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="services[]" value="mindfulness"> Mindfulness Training
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="services[]" value="other"> Other
                                </label>
                            </div>
                        </div>

                        <div class="form-field">
                            <label>Preferred Contact Method for 30-minute Strategy Call</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="contact_method" value="phone" required> Phone
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="contact_method" value="zoom" required> Zoom
                                </label>
                            </div>
                        </div>

                        <div id="individual-fields" style="display:none;">
                            <div class="form-field">
                                <label for="focus">What's your primary area of concern or intention?</label>
                                <textarea name="focus" id="focus" rows="3"></textarea>
                            </div>
                        </div>

                        <div id="business-fields" style="display:none;">
                            <div class="form-field">
                                <label for="company">Business/Organization Name</label>
                                <input type="text" name="company" id="company">
                            </div>

                            <div class="form-field">
                                <label for="goals">What are your team or wellness goals?</label>
                                <textarea name="goals" id="goals" rows="3"></textarea>
                            </div>

                            <div class="form-field">
                                <label for="team_size">How many team members need support?</label>
                                <input type="number" name="team_size" id="team_size" min="1">
                            </div>

                            <div class="form-disclaimer">
                                <strong>Note:</strong> This first call allows up to <strong>3 total attendees</strong>. If more than one person from your team is joining, you may list them below. This strategy call is designed to assess your team's needs and set up next steps for full training and support.
                            </div>

                            <div id="attendee-repeater">
                                <div class="attendee-group">
                                    <label>Additional Attendee 1</label>
                                    <input type="text" name="attendees[0][name]" placeholder="Name">
                                    <input type="email" name="attendees[0][email]" placeholder="Email">
                                </div>
                                <div class="attendee-group">
                                    <label>Additional Attendee 2</label>
                                    <input type="text" name="attendees[1][name]" placeholder="Name">
                                    <input type="email" name="attendees[1][email]" placeholder="Email">
                                </div>
                            </div>
                        </div>

                        <!-- New booking notice -->
                        <div class="booking-notice">
                            <strong>📅 Next Step:</strong> After submitting this form, you'll be redirected to select your preferred date and time from available slots on our booking calendar.
                        </div>

                        <button type="submit">Submit & Continue to Booking</button>
                    </form>

                    <div id="form-message" style="<?php echo !empty($form_message) ? 'display:block;' : 'display:none;'; ?>" class="<?php echo $form_status; ?>">
                        <?php echo $form_message; ?>
                    </div>

                    <!-- JavaScript Notice Modal -->
                    <div id="booking-notice-modal" class="modal-overlay" style="display:none;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>🎯 Strategy Call Added!</h3>
                            </div>
                            <div class="modal-body">
                                <p><strong>Great!</strong> Your strategy call has been added to the cart.</p>
                                <p><strong>Next step:</strong> You'll now be redirected to select your preferred date and time from available slots.</p>
                                <div class="loading-spinner">
                                    <div class="spinner"></div>
                                    <p>Redirecting to booking calendar...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- #primary -->

<style>
#soulara-lead-form {
  background: #F3EEE9;
  padding: 40px;
  max-width: 640px;
  margin: 40px auto;
  border-radius: 16px;
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
  font-family: 'Lato', sans-serif;
  border-left: 5px solid #D17953;
}

.form-field {
  margin-bottom: 24px;
}

#soulara-lead-form label {
  font-weight: 700;
  font-size: 1rem;
  color: #17786E;
  display: block;
  margin-bottom: 8px;
  letter-spacing: 0.5px;
}

#soulara-lead-form input, 
#soulara-lead-form select, 
#soulara-lead-form textarea {
  width: 100%;
  padding: 14px 16px;
  border-radius: 8px;
  border: 1px solid #999;
  font-size: 1rem;
  background-color: #fff;
  color: #222;
  font-family: 'Lato', sans-serif;
}

#soulara-lead-form textarea {
  resize: vertical;
}

.checkbox-group, .radio-group {
  display: flex;
  flex-wrap: wrap;
  margin-top: 5px;
}

.checkbox-label, .radio-label {
  display: inline-flex !important;
  align-items: center;
  margin-right: 15px;
  margin-bottom: 10px;
  font-weight: normal;
  color: #333;
  width: calc(50% - 15px);
}

.checkbox-label input, .radio-label input {
  width: auto !important;
  margin-right: 8px;
}

@media (max-width: 768px) {
  .checkbox-label, .radio-label {
    width: 100%;
  }
}

#soulara-lead-form button {
  background: #D26138;
  color: #fff;
  border: none;
  padding: 14px 32px;
  border-radius: 50px;
  font-weight: 700;
  font-size: 1rem;
  text-transform: uppercase;
  cursor: pointer;
  transition: background 0.3s ease;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

#soulara-lead-form button:hover {
  background: #BA5C38;
}

.attendee-group {
  margin-bottom: 15px;
}

.attendee-group input {
  margin-top: 6px;
  margin-right: 10px;
  width: calc(50% - 12px);
  display: inline-block;
}

.form-disclaimer {
  font-size: 0.95rem;
  background: #FFF5E1;
  padding: 15px 20px;
  border-left: 5px solid #F4BB41;
  border-radius: 8px;
  color: #333;
  margin-bottom: 20px;
  line-height: 1.4;
}

/* New booking notice styling */
.booking-notice {
  background: #E8F4F8;
  padding: 15px 20px;
  border-left: 5px solid #17786E;
  border-radius: 8px;
  color: #333;
  margin-bottom: 20px;
  line-height: 1.4;
  font-size: 0.95rem;
}

#form-message {
  margin-top: 30px;
  margin-bottom: 30px;
  text-align: center;
  padding: 15px;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 600;
}

#form-message.success {
  background-color: #e0f7f5;
  color: #17786E;
  border-left: 5px solid #1BC5AC;
}

#form-message.error {
  background-color: #ffe9e9;
  color: #d44950;
  border-left: 5px solid #d44950;
}

#form-message.error ul {
  text-align: left;
  padding-left: 20px;
}

/* Modal styling */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.modal-content {
  background: white;
  padding: 30px;
  border-radius: 16px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
  max-width: 400px;
  width: 90%;
  text-align: center;
  animation: slideIn 0.3s ease;
}

@keyframes slideIn {
  from {
    transform: translateY(-50px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.modal-header h3 {
  color: #17786E;
  margin-bottom: 15px;
  font-size: 1.3rem;
}

.modal-body p {
  margin-bottom: 15px;
  line-height: 1.5;
  color: #333;
}

.loading-spinner {
  margin-top: 20px;
}

.spinner {
  border: 3px solid #f3f3f3;
  border-top: 3px solid #17786E;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  animation: spin 1s linear infinite;
  margin: 0 auto 10px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.loading-spinner p {
  color: #666;
  font-size: 0.9rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('client_type').addEventListener('change', function() {
        const type = this.value;
        document.getElementById('individual-fields').style.display = type === 'individual' ? 'block' : 'none';
        document.getElementById('business-fields').style.display = type === 'business' ? 'block' : 'none';
    });
a
    // Handle form submission with JavaScript notice
    document.getElementById('soulara-lead-form').addEventListener('submit', function(e) {
        // Let the form submit normally, but show notice if successful
        <?php if($form_status === 'success' && isset($redirect_url)): ?>
        e.preventDefault();
        
        // Show the modal notice
        document.getElementById('booking-notice-modal').style.display = 'flex';
        
        // Redirect after 3 seconds
        setTimeout(function() {
            window.location.href = '<?php echo $redirect_url; ?>';
        }, 3000);
        <?php endif; ?>
    });

    // If there's a success message from PHP, show the modal and redirect
    <?php if($form_status === 'success' && isset($redirect_url)): ?>
    document.getElementById('booking-notice-modal').style.display = 'flex';
    setTimeout(function() {
        window.location.href = '<?php echo $redirect_url; ?>';
    }, 3000);
    <?php endif; ?>
    
    // Show appropriate fields based on pre-selected client type (for when form reloads with errors)
    const clientType = document.getElementById('client_type').value;
    if (clientType) {
        document.getElementById('individual-fields').style.display = clientType === 'individual' ? 'block' : 'none';
        document.getElementById('business-fields').style.display = clientType === 'business' ? 'block' : 'none';
    }
});
</script>

<?php
get_footer();