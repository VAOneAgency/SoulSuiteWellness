<?php
/**
 * Monalisa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Monalisa
 */

if ( ! function_exists( 'monalisa_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function monalisa_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Monalisa, use a find and replace
	 * to change 'monalisa' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'monalisa', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'monalisa_image_770_510', 770,510, true );
	add_image_size( 'monalisa_image_1280_500', 1280,500, true );
	add_image_size( 'monalisa_image_870_984', 870,984, true );
	add_image_size( 'monalisa_image_200_200', 200,200, true );
	add_image_size( 'monalisa_image_1200_800', 1200,800, true );
	add_image_size( 'monalisa_image_210_90', 210,90, true );
	add_image_size( 'monalisa_image_840_430', 840,430, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'monalisa' ),
	) );

	/*
	 * Set woocommerce support  
	 * 
	 */
	add_theme_support( 'woocommerce' );	
	
	// Custom Logo
	add_theme_support( 'custom-logo' );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	add_theme_support( 'post-formats', array(
		'audio',
		'video',
	) );
	
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'monalisa_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_editor_style( array( 'assets/css/editor-style.css', monalisa_google_fonts_url() ) );
}
endif;
add_action( 'after_setup_theme', 'monalisa_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function monalisa_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'monalisa_content_width', 640 );
}
add_action( 'after_setup_theme', 'monalisa_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function monalisa_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'monalisa' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'monalisa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'monalisa' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'monalisa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'monalisa_widgets_init' );

/**
 * register google fonts
 */
function monalisa_google_fonts_url() {
	$fonts_url = '';
	
	/* Translators: If there are characters in your language that are not
	* supported by Source Sans Pro, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$lato = esc_html_x( 'on', 'Lato font: on or off', 'monalisa' );

	/* Translators: If there are characters in your language that are not
	* supported by Lato, translate this to 'off'. Do not translate
	* into your own language.
	*/
	
	$montserrat = esc_html_x( 'on', 'Montserrat font: on or off', 'monalisa' );
	
	if ( 'off' !== $lato || 'off' !== $montserrat ) {
	$font_families = array();
	 
	if ( 'off' !== $lato ) {
	$font_families[] = 'Lato:300,300i,400,400i,700,700i';
	}
	 
	
	if ( 'off' !== $montserrat ) {
	$font_families[] = 'Montserrat:400,700';
	}
	 
	$query_args = array(
	'family' => urlencode( implode( '|', $font_families ) ),
	'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	 
	return esc_url_raw( $fonts_url );	
}

function monalisa_main_menu() {
		wp_nav_menu( array(
		'theme_location'    => 'menu-1',
		'depth'             => 5,
		'container'         => false,
		'menu_class'        => 'nav navbar-nav navbar-right',
		'fallback_cb'       => 'monalisa_navwalker::fallback',
		
		)
	); 	
}

/**
 * Enqueue scripts and styles.
 */
function monalisa_scripts() {
	
	//google font
	wp_enqueue_style( 'monalisa-google-fonts', monalisa_google_fonts_url(), array(), null );	
	wp_enqueue_style('bootstrap' , get_template_directory_uri(). '/assets/bootstrap/css/bootstrap.min.css');	
	wp_enqueue_style('font-awesome.min' , get_template_directory_uri(). '/assets/fonts/font-awesome.min.css');	
	wp_enqueue_style('owl.carousel' , get_template_directory_uri(). '/assets/owlcarousel/css/owl.carousel.css');	
	wp_enqueue_style('owl.theme' , get_template_directory_uri(). '/assets/owlcarousel/css/owl.theme.css');	
	wp_enqueue_style('prettyPhoto' , get_template_directory_uri(). '/assets/css/prettyPhoto.css');	
	wp_enqueue_style('flexslider' , get_template_directory_uri(). '/assets/css/flexslider.css');	
	wp_enqueue_style('animate' , get_template_directory_uri(). '/assets/css/animate.css');	
	wp_enqueue_style('monalisa-main-style' , get_template_directory_uri(). '/assets/css/style.css');	
	wp_enqueue_style( 'monalisa-style', get_stylesheet_uri() );

	// Load JS Files
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array(), '3.7.2' );	
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' ); 	
	wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.min.js', array(), '1.4.2' );
	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' ); 
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array('jquery'), '659812', true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.8.3.min.js', array('jquery'), '659812', true );
	wp_enqueue_script( 'jquery.inview.min', get_template_directory_uri() . '/assets/js/jquery.inview.min.js', array('jquery'), '659812', true );
	wp_enqueue_script( 'jquery.flexslider-min', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array('jquery'), '659812', true );
	wp_enqueue_script( 'jquery.prettyPhoto', get_template_directory_uri() . '/assets/js/jquery.prettyPhoto.js', array('jquery'), '659812', true );
	wp_enqueue_script( 'owl.carousel.min', get_template_directory_uri() . '/assets/owlcarousel/js/owl.carousel.min.js', array('jquery'), '659812', true );
	wp_enqueue_script( 'scrolltopcontrol', get_template_directory_uri() . '/assets/js/scrolltopcontrol.js', array('jquery'), '659812', true );
	wp_enqueue_script( 'wow.min', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '659812', true );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '659812', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'monalisa_scripts' );

function monalisa_wp_kses($val){
	return wp_kses($val, array(
	
	'p' => array(
		'class' =>array()
	),
	'span' => array(),
	'small' => array(),
	'div' => array(),
	'strong' => array(),
	'b' => array(),
	'br' => array(),
	'h1' => array(),
	'i' => array(
		'class' =>array()
	),	
	'ul' => array(
		'class' =>array()
	),	
	'ul' => array(
		'id' =>array()
	),	
	'li' => array(
		'class' =>array()
	),	
	'li' => array(
		'id' =>array()
	),
	'h2' => array(),
	'h3' => array(),
	'h4' => array(),
	'h5' => array(),
	'h6' => array(),
	'a'=> array('href' => array(),'target' => array()),
	'iframe'=> array('src' => array(),'height' => array(),'width' => array()),
	
	), '');
}

/*---------------------------------------------
 Initialising KingComposer editor
----------------------------------------------*/ 
if (class_exists('KingComposer')) {
 function monalisa_requireVcExtend(){
  include_once( get_template_directory().'/kc_extend/extend_kc.php');  
 }
 add_action('init', 'monalisa_requireVcExtend',2);
}

// modify search widget
function monalisa_my_search_form( $form ) {
	$form = '
		<div class="form-group search-input">
			<div class="search_form">
				<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url(home_url( '/' )) . '" >
				<input type="text" value="' . esc_attr(get_search_query()) . '" name="s" id="s" class="form-control search_field" placeholder="' . esc_attr__('Search...' , 'monalisa') .'">
				</form>
			</div>
		</div>
        ';
	return $form;
}
add_filter( 'get_search_form', 'monalisa_my_search_form' );

// comment list modify

function monalisa_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	<div class="single_comment">
		<div class="media">
			<div class="comment_avatar">
				<?php echo get_avatar( $comment, 70 ); ?>
			</div>

			<div class="media-body text-left comment_single">
				
				<h5 class="media-heading"><?php comment_author_link() ?> <span><?php echo esc_html(' - '); echo esc_html(get_comment_date('F j, Y')); ?> <?php echo esc_html(get_comment_date('g:i')); ?></span> <div class="creply_link"> <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></div></h5>
				<?php if ($comment->comment_approved == '0') : ?>
				<p><em><?php esc_html_e('Your comment is awaiting moderation.','monalisa'); ?></em></p>
				<?php endif; ?>
				 <?php comment_text(); ?>							
			</div>
		</div>
	</div>				
</li>


<?php } 

// comment box title change
add_filter( 'comment_form_defaults', 'monalisa_remove_comment_form_allowed_tags' );
function monalisa_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	$defaults['comment_notes_before'] = '';
	return $defaults;

}

function monalisa_comment_reform ($arg) {

$arg['title_reply'] = esc_html__('Write your comment Here','monalisa');
$arg['comment_field'] = '<div class="row"><div class="form-group col-md-12"><textarea id="comment" class="comment_field form-control" name="comment" cols="77" rows="3" placeholder="'. esc_html__("Write your Comment", "monalisa").'" aria-required="true"></textarea></div></div>';


return $arg;

}
add_filter('comment_form_defaults','monalisa_comment_reform');

// comment form modify

function monalisa_modify_comment_form_fields($fields){
	$commenter = wp_get_current_commenter();
	$req	   = get_option( 'require_name_email' );

	$fields['author'] = '<div class="row"><div class="form-group col-md-4"><input type="text" name="author" id="author" value="'. esc_attr( $commenter['comment_author'] ) .'" placeholder="'. esc_attr__("Your Name *", "monalisa").'" size="22" tabindex="1"'. ( $req ? 'aria-required="true"' : '' ).' class="input-name form-control" /></div>';

	$fields['email'] = '<div class="form-group col-md-4"><input type="text" name="email" id="email" value="'. esc_attr( $commenter['comment_author_email'] ) .'" placeholder="'.esc_attr__("Your Email *", "monalisa").'" size="22" tabindex="2"'. ( $req ? 'aria-required="true"' : '' ).' class="input-email form-control"  /></div>';
	
	$fields['url'] = '<div class="form-group col-md-4"><input type="text" name="url" id="url" value="'. esc_attr( $commenter['comment_author_url'] ) .'" placeholder="'. esc_attr__("Website", "monalisa").'" size="22" tabindex="2"'. ( $req ? 'aria-required="false"' : '' ).' class="input-url form-control"  /></div></div>';

	return $fields;
}
add_filter('comment_form_default_fields','monalisa_modify_comment_form_fields');

// New Lead Form for Individual and Business Clients
add_action('init', function() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['client_type'], $_POST['fullname'], $_POST['email'])) {
    
    // Basic validation
    $errors = array();
    
    // Sanitize and validate required fields (matching template field names exactly)
    $type = sanitize_text_field($_POST['client_type']);
    $name = sanitize_text_field($_POST['fullname']); // Template uses 'fullname', not 'name'
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
    
    // If there are validation errors, handle them
    if (!empty($errors)) {
      // Store errors in session to display after redirect
      if (!session_id()) {
        session_start();
      }
      $_SESSION['form_errors'] = $errors;
      wp_redirect($_SERVER['REQUEST_URI']);
      exit;
    }

    $admin_email = 'bewell@soulsuitewellness.com';

    // Collect ALL form data that matches your template's form fields
    $services = isset($_POST['services']) ? array_map('sanitize_text_field', $_POST['services']) : array();
    $contact_method = isset($_POST['contact_method']) ? sanitize_text_field($_POST['contact_method']) : 'Not specified';
    
    // Map service values to readable names (matching your template exactly)
    $service_names = array(
        'wellness-coaching' => 'Wellness Coaching',
        'meditation' => 'Meditation Sessions', 
        'corporate-wellness' => 'Corporate Wellness Programs',
        'stress-management' => 'Stress Management',
        'mindfulness' => 'Mindfulness Training',
        'other' => 'Other'
    );
    
    // Process services into readable format
    $services_text = '';
    if (!empty($services)) {
      $services_text = "\nServices Interested In:\n";
      foreach ($services as $service) {
        $readable_name = isset($service_names[$service]) ? $service_names[$service] : ucwords(str_replace('-', ' ', $service));
        $services_text .= "✓ " . $readable_name . "\n";
      }
    } else {
      $services_text = "\nServices Interested In: None selected\n";
    }

    // Process attendee information and collect valid attendees for emailing
    $attendee_info = '';
    $valid_attendees = array();
    if (!empty($_POST['attendees']) && is_array($_POST['attendees'])) {
      $attendees_found = false;
      foreach ($_POST['attendees'] as $i => $attendee) {
        if (is_array($attendee)) {
          $attendee_name = sanitize_text_field($attendee['name'] ?? '');
          $attendee_email = sanitize_email($attendee['email'] ?? '');
          
          // Only process if we have at least a name or valid email
          if (!empty($attendee_name) || (!empty($attendee_email) && is_email($attendee_email))) {
            if (!$attendees_found) {
              $attendee_info .= "\n\nAdditional Attendees:\n";
              $attendees_found = true;
            }
            $attendee_info .= "Attendee " . ($i+1) . ": ";
            $attendee_info .= !empty($attendee_name) ? $attendee_name : 'No name';
            $attendee_info .= " <" . (!empty($attendee_email) ? $attendee_email : 'No email') . ">\n";
            
            // Store valid attendees for emailing (must have valid email)
            if (!empty($attendee_email) && is_email($attendee_email)) {
              $valid_attendees[] = array(
                'name' => !empty($attendee_name) ? $attendee_name : 'Team Member',
                'email' => $attendee_email
              );
            }
          }
        }
      }
      if (!$attendees_found) {
        $attendee_info = "\nAdditional Attendees: None\n";
      }
    }

    // Build comprehensive admin email
    $submission_time = current_time('F j, Y g:i a');
    $ip_address = $_SERVER['REMOTE_ADDR'];
    
    if ($type === 'individual') {
      $focus = sanitize_textarea_field($_POST['focus'] ?? ''); // Template field name
      $subject_admin = "🌿 New INDIVIDUAL Lead: $name";
      
      $body_admin = "==========================================\n";
      $body_admin .= "NEW INDIVIDUAL CLIENT LEAD\n";
      $body_admin .= "==========================================\n\n";
      $body_admin .= "CONTACT INFORMATION:\n";
      $body_admin .= "Full Name: $name\n";
      $body_admin .= "Email: $email\n";
      $body_admin .= "Preferred Contact Method: " . ucfirst($contact_method) . "\n";
      $body_admin .= "Submission Time: $submission_time\n";
      $body_admin .= "IP Address: $ip_address\n\n";
      
      $body_admin .= "CLIENT DETAILS:\n";
      $body_admin .= "Primary Focus/Concern: " . (!empty($focus) ? $focus : 'Not specified') . "\n";
      $body_admin .= $services_text;
      
      $body_admin .= "\n==========================================\n";
      $body_admin .= "NEXT STEPS:\n";
      $body_admin .= "Client will be redirected to Individual Strategy Call booking\n";
      $body_admin .= "Square URL: https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/GJZY3CEHIIJR6XSGCXQR6D6P\n";
      $body_admin .= "==========================================\n";
      
      $redirect_url = 'https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/GJZY3CEHIIJR6XSGCXQR6D6P'; 
      
    } else {
      // Business fields matching template exactly
      $company = sanitize_text_field($_POST['company'] ?? '');
      $goals = sanitize_textarea_field($_POST['goals'] ?? '');
      $team_size = intval($_POST['team_size'] ?? 0); // Template uses intval
      
      $subject_admin = "🏢 New BUSINESS Lead: $name" . (!empty($company) ? " ($company)" : "");
      
      $body_admin = "==========================================\n";
      $body_admin .= "NEW BUSINESS CLIENT LEAD\n";
      $body_admin .= "==========================================\n\n";
      $body_admin .= "CONTACT INFORMATION:\n";
      $body_admin .= "Full Name: $name\n";
      $body_admin .= "Email: $email\n";
      $body_admin .= "Preferred Contact Method: " . ucfirst($contact_method) . "\n";
      $body_admin .= "Submission Time: $submission_time\n";
      $body_admin .= "IP Address: $ip_address\n\n";
      
      $body_admin .= "BUSINESS DETAILS:\n";
      $body_admin .= "Business/Organization: " . (!empty($company) ? $company : 'Not specified') . "\n";
      $body_admin .= "Team Size: " . ($team_size > 0 ? $team_size . " members" : 'Not specified') . "\n";
      $body_admin .= "Team/Wellness Goals: " . (!empty($goals) ? $goals : 'Not specified') . "\n";
      $body_admin .= $services_text;
      $body_admin .= $attendee_info;
      
      $body_admin .= "\n==========================================\n";
      $body_admin .= "EMAIL NOTIFICATIONS SENT:\n";
      if (!empty($valid_attendees)) {
        $body_admin .= "✓ Main contact: " . $name . " (" . $email . ")\n";
        $body_admin .= "✓ Additional attendees notified: " . $attendee_emails_sent . "\n";
        if ($attendee_email_errors > 0) {
          $body_admin .= "⚠ Attendee email failures: " . $attendee_email_errors . "\n";
        }
        $body_admin .= "\nAttendees who received invitations:\n";
        foreach ($valid_attendees as $attendee) {
          $body_admin .= "- " . $attendee['name'] . " (" . $attendee['email'] . ")\n";
        }
      } else {
        $body_admin .= "✓ Main contact only: " . $name . " (" . $email . ")\n";
        $body_admin .= "Note: No additional attendees to notify\n";
      }
      $body_admin .= "\nNEXT STEPS:\n";
      $body_admin .= "Client will be redirected to Business Strategy Call booking\n";
      $body_admin .= "Square URL: https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/HWYWQ6UMI4Q34K3TM27C7EU4\n";
      $body_admin .= "==========================================\n";
      
      $redirect_url = 'https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/HWYWQ6UMI4Q34K3TM27C7EU4'; 
    }

    // Send to Admin with error handling
    $admin_email_sent = wp_mail($admin_email, $subject_admin, $body_admin);
    
    if (!$admin_email_sent) {
      error_log('Failed to send admin notification email for lead: ' . $name . ' (' . $email . ')');
    }

    // Send to User with error handling
    $subject_user = "🌸 Thank you for booking with Soulara at Soul Suite Wellness";
    $body_user = "Hi $name,\n\nThank you for booking your Soulful Strategy Call with Soulara.\nWe're honored to walk this path of wellness with you.\n\nWith love,\nSoul Suite Wellness";
    $user_email_sent = wp_mail($email, $subject_user, $body_user);
    
    if (!$user_email_sent) {
      error_log('Failed to send confirmation email to user: ' . $email);
    }

    // Send emails to additional attendees (business clients only)
    $attendee_emails_sent = 0;
    $attendee_email_errors = 0;
    
    if ($type === 'business' && !empty($valid_attendees)) {
      foreach ($valid_attendees as $attendee) {
        $attendee_subject = "🌸 You're invited to a Soul Suite Wellness Strategy Call";
        $attendee_body = "Hi " . $attendee['name'] . ",\n\n";
        $attendee_body .= "You've been invited by " . $name;
        if (!empty($company)) {
          $attendee_body .= " from " . $company;
        }
        $attendee_body .= " to join a Business Strategy Call with Soul Suite Wellness.\n\n";
        $attendee_body .= "This call will focus on wellness strategies for your team and organization.\n\n";
        $attendee_body .= "Meeting Details:\n";
        $attendee_body .= "- Organized by: " . $name . " (" . $email . ")\n";
        if (!empty($company)) {
          $attendee_body .= "- Company: " . $company . "\n";
        }
        $attendee_body .= "- Meeting type: Business Strategy Call\n";
        $attendee_body .= "- Duration: 30 minutes\n\n";
        $attendee_body .= "The meeting organizer will book the appointment time and send you the calendar invite with the meeting link.\n\n";
        $attendee_body .= "We look forward to supporting your team's wellness journey!\n\n";
        $attendee_body .= "With gratitude,\n";
        $attendee_body .= "Soul Suite Wellness Team\n";
        $attendee_body .= "bewell@soulsuitewellness.com";

        $attendee_email_result = wp_mail($attendee['email'], $attendee_subject, $attendee_body);
        
        if ($attendee_email_result) {
          $attendee_emails_sent++;
        } else {
          $attendee_email_errors++;
          error_log('Failed to send attendee notification to: ' . $attendee['email'] . ' for lead: ' . $name);
        }
      }
    }

    // Store success message in session
    if (!session_id()) {
      session_start();
    }
    
    if ($admin_email_sent && $user_email_sent) {
      if ($type === 'business' && !empty($valid_attendees)) {
        if ($attendee_emails_sent > 0) {
          $_SESSION['form_success'] = "Thank you for booking with Soulara at Soul Suite Wellness. You and your team members ($attendee_emails_sent additional attendees) will receive confirmation emails shortly.";
        } else {
          $_SESSION['form_success'] = "Thank you for booking with Soulara at Soul Suite Wellness. You will receive a confirmation email shortly. Note: We couldn't send emails to additional attendees - please forward the booking details to them.";
        }
      } else {
        $_SESSION['form_success'] = 'Thank you for booking with Soulara at Soul Suite Wellness. You will receive a confirmation email shortly.';
      }
    } else {
      $_SESSION['form_success'] = 'Thank you for booking with Soulara at Soul Suite Wellness. If you don\'t receive a confirmation email, please contact us directly.';
    }

    // Use WordPress redirect function instead of JavaScript
    wp_redirect($redirect_url);
    exit;
  }
});

// Display form messages (add this to your theme if you want to show messages)
add_action('wp_head', function() {
  if (!session_id()) {
    session_start();
  }
  
  if (isset($_SESSION['form_errors'])) {
    echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
        var messageDiv = document.getElementById('form-message');
        if (messageDiv) {
          messageDiv.style.display = 'block';
          messageDiv.innerHTML = 'Error: " . implode('<br>', $_SESSION['form_errors']) . "';
          messageDiv.style.color = 'red';
        }
      });
    </script>";
    unset($_SESSION['form_errors']);
  }
  
  if (isset($_SESSION['form_success'])) {
    echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
        var formDiv = document.getElementById('soulara-lead-form');
        var messageDiv = document.getElementById('form-message');
        if (formDiv) formDiv.style.display = 'none';
        if (messageDiv) {
          messageDiv.style.display = 'block';
          messageDiv.innerHTML = '" . esc_js($_SESSION['form_success']) . "';
          messageDiv.style.color = 'green';
        }
      });
    </script>";
    unset($_SESSION['form_success']);
  }
});

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/navwalker.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/required-plugin.php';
require get_template_directory() . '/inc/demo_install.php';

/**
 * Load the Soulara Form Builder system
 */
require_once get_template_directory() . '/inc/form-editor/init.php';