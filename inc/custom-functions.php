<?php

function monalisa_banner_img_url(){
	global $monalisa;
	
	$monalisa_home_banner_img = '';	
	
	if ( isset( $monalisa['monalisa_home_banner_img']['url']) ) {
		$monalisa_home_banner_img = $monalisa['monalisa_home_banner_img']['url'];
	}
	
	$monalisa_upload_banner_image = get_post_meta(get_the_ID(), '_monalisa_upload_banner_image', true);
	$monalisa_default_banner_img = get_template_directory_uri() . '/assets/img/bg/home-bg.jpg';

		
	
	if($monalisa_upload_banner_image){
		return $monalisa_upload_banner_image;
	}elseif($monalisa_home_banner_img){
		return $monalisa_home_banner_img;
	}else{
		return $monalisa_default_banner_img;
	}
}

function monalisa_blog_banner(){ 

?>

	<!-- START  HOME DESIGN -->
	<section class="section-top" style="background: url(<?php echo esc_url(monalisa_banner_img_url());?>)no-repeat;background-size:cover; background-position: center center;background-attachment:fixed">
		<div class="overlay">
			<div class="container">
				<div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
					<div class="section-top-title" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h2><?php esc_html_e('Blog' , 'monalisa');?></h2>
						<ol class="breadcrumb">
						  <li><a href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Home' , 'monalisa');?></a></li>
						  <li class="active"><?php esc_html_e('Blog' , 'monalisa');?></li>
						</ol>
					</div><!-- //.HERO-TEXT -->
				</div><!--- END COL -->
			</div><!--- END CONTAINER -->
		</div><!--- END HOME OVERLAY -->
	</section>	
	<!-- END  HOME DESIGN -->	
		
<?php }

function monalisa_shop_archive_banner(){ 

?>

	<!-- START  HOME DESIGN -->
		<section class="section-top" style="background: url(<?php echo esc_url(monalisa_banner_img_url());?>)no-repeat;background-size:cover; background-position: center center;background-attachment:fixed">
		<div class="overlay">
			<div class="container">
				<div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
					<div class="section-top-title" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h2><?php esc_html_e('Shop' , 'monalisa');?></h2>
						<ol class="breadcrumb">
						  <li><a href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Home' , 'monalisa');?></a></li>
						  <li class="active"><?php esc_html_e('Shop' , 'monalisa');?></li>
						</ol>
					</div><!-- //.HERO-TEXT -->
				</div><!--- END COL -->
			</div><!--- END CONTAINER -->
		</div><!--- END HOME OVERLAY -->
	</section>	
	<!-- END  HOME DESIGN -->	
		
<?php }

function monalisa_archive_banner(){ 

?>

	<!-- START  HOME DESIGN -->
	<section class="section-top" style="background: url(<?php echo esc_url(monalisa_banner_img_url());?>)no-repeat;background-size:cover; background-position: center center;background-attachment:fixed">
		<div class="overlay">
				<div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
					<div class="section-top-title" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h2><?php esc_html_e('Archive' , 'monalisa');?></h2>
						<ol class="breadcrumb">
						  <li><a href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Home' , 'monalisa');?></a></li>
						  <li class="active"><?php the_archive_title();?></li>
						</ol>
					</div><!-- //.HERO-TEXT -->
				</div><!--- END COL -->
			</div><!--- END CONTAINER -->
		</div><!--- END HOME OVERLAY -->
	</section>	
	<!-- END  HOME DESIGN -->	
		
<?php }

function monalisa_search_banner(){ 

?>

	<!-- START  HOME DESIGN -->
	<section class="section-top" style="background: url(<?php echo esc_url(monalisa_banner_img_url());?>)no-repeat;background-size:cover; background-position: center center;background-attachment:fixed">	
		<div class="overlay">
			<div class="container">
				<div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
					<div class="section-top-title" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h2><?php esc_html_e('Search' , 'monalisa');?></h2>
						<ol class="breadcrumb">
						  <li><a href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Home' , 'monalisa');?></a></li>
						  <li class="active"><?php printf( esc_html__( 'Search Results for: %s', 'monalisa' ), '<span>' . get_search_query() . '</span>' ); ?></li>
						</ol>
					</div><!-- //.HERO-TEXT -->
				</div><!--- END COL -->
			</div><!--- END CONTAINER -->
		</div><!--- END HOME OVERLAY -->
	</section>	
	<!-- END  HOME DESIGN -->	
		
<?php }

function monalisa_single_banner(){ 

?>

	<!-- START  HOME DESIGN -->
	<section class="section-top" style="background: url(<?php echo esc_url(monalisa_banner_img_url());?>)no-repeat;background-size:cover; background-position: center center;background-attachment:fixed">	
		<div class="overlay">
			<div class="container">
				<div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
					<div class="section-top-title" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h2><?php the_title();?></h2>
						<ol class="breadcrumb">
						  <li><a href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Home' , 'monalisa');?></a></li>
						  <li class="active"><?php the_title();?></li>
						</ol>
					</div><!-- //.HERO-TEXT -->
				</div><!--- END COL -->
			</div><!--- END CONTAINER -->
		</div><!--- END HOME OVERLAY -->
	</section>	
	<!-- END  HOME DESIGN -->	
		
<?php }

function monalisa_404_banner(){ 

?>

	<!-- START  HOME DESIGN -->
	<section class="section-top" style="background: url(<?php echo esc_url(monalisa_banner_img_url());?>)no-repeat;background-size:cover; background-position: center center;background-attachment:fixed">
		<div class="overlay">
			<div class="container">
				<div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
					<div class="section-top-title" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
						<h2><?php esc_html_e('404' , 'monalisa');?></h2>
						<ol class="breadcrumb">
						  <li><a href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Home' , 'monalisa');?></a></li>
						  <li class="active"><?php esc_html_e('404' , 'monalisa');?></li>
						</ol>
					</div><!-- //.HERO-TEXT -->
				</div><!--- END COL -->
			</div><!--- END CONTAINER -->
		</div><!--- END HOME OVERLAY -->
	</section>	
	<!-- END  HOME DESIGN -->	
		
<?php }

function monalisa_header(){ 
global $monalisa;

$monalisa_spinner_text = '';	
$monalisa_preloader_opt = '';	
$monalisa_homepage_opt = '';	

if ( isset( $monalisa['monalisa_spinner_text']) ) {
	$monalisa_spinner_text = $monalisa['monalisa_spinner_text'];
}

if ( isset( $monalisa['monalisa_preloader_opt']) ) {
	$monalisa_preloader_opt = $monalisa['monalisa_preloader_opt'];
}

if ( isset( $monalisa['monalisa_homepage_opt']) ) {
	$monalisa_homepage_opt = $monalisa['monalisa_homepage_opt'];
}

$monalisa_default_logo_img = get_template_directory_uri() . '/assets/img/logo.png';

?>

<?php if($monalisa_preloader_opt == '1' && !$monalisa_homepage_opt == '1') { ?>

<!-- START PRELOADER -->
<div class="preloader">
	<div class="status">
		<div class="status-mes"><h4><?php echo esc_attr($monalisa_spinner_text);?></h4></div>
	</div>
</div>
<!-- END PRELOADER -->

<?php }elseif($monalisa_preloader_opt == '1' && $monalisa_homepage_opt == '1'){ ?>	

<?php if(is_front_page()) {?>
<!-- START PRELOADER -->
<div class="preloader">
	<div class="status">
		<div class="status-mes"><h4><?php echo esc_attr($monalisa_spinner_text);?></h4></div>
	</div>
</div>
<!-- END PRELOADER -->
<?php } } ?>



<!-- START NAVBAR -->
<!-- <div class="navbar navbar-default navbar-fixed-top menu-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only"><?php echo esc_html_e('Toggle navigation' , 'monalisa');?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?php echo esc_url(home_url('/'));?>" class="navbar-brand">
				<?php if(get_custom_logo()){
					 the_custom_logo();
				}else { ?>
				  <img src="<?php echo esc_url($monalisa_default_logo_img);?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				<?php } ?>		
			</a>
		</div>
		<div class="navbar-collapse collapse">
			<nav id="navigation">
				<?php monalisa_main_menu();?>
			</nav>
		</div> 
	</div><!--- END CONTAINER -->
</div>
<!-- END NAVBAR -->	
<?php }

function monalisa_footer(){ 
    global $monalisa;

    // Initialize variables with Soul Suite Wellness social media links
    $monalisa_copywrite_text = '';    
    $monalisa_footer_fb_link = 'https://www.facebook.com/soulsuitewellness';    
    $monalisa_footer_tw_link = '#';    
    $monalisa_footer_align_link = 'https://www.alignable.com/atlanta-ga/soul-suite-wellness-tm?user=16332141';    
    $monalisa_footer_linkedin_link = '#';    
    $monalisa_footer_youtube_link = 'https://youtube.com/channel/UCeb0vH5DPS6R8D4qeNLX0Fg';    
    $monalisa_footer_insta_link = 'https://www.instagram.com/soulsuitewellness';    

    // Get theme options if they exist, otherwise use defaults
    if (isset($monalisa['monalisa_copywrite_text']) && !empty($monalisa['monalisa_copywrite_text'])) {
        $monalisa_copywrite_text = $monalisa['monalisa_copywrite_text'];
    }    
    
    if (isset($monalisa['monalisa_footer_fb_link']) && !empty($monalisa['monalisa_footer_fb_link'])) {
        $monalisa_footer_fb_link = $monalisa['monalisa_footer_fb_link'];
    }        
    
    if (isset($monalisa['monalisa_footer_tw_link']) && !empty($monalisa['monalisa_footer_tw_link'])) {
        $monalisa_footer_tw_link = $monalisa['monalisa_footer_tw_link'];
    }    
    
    if (isset($monalisa['monalisa_footer_align_link']) && !empty($monalisa['monalisa_footer_align_link'])) {
        $monalisa_footer_align_link = $monalisa['monalisa_footer_align_link'];
    }    
    
    if (isset($monalisa['monalisa_footer_linkedin_link']) && !empty($monalisa['monalisa_footer_linkedin_link'])) {
        $monalisa_footer_linkedin_link = $monalisa['monalisa_footer_linkedin_link'];
    }    
        
    if (isset($monalisa['monalisa_footer_youtube_link']) && !empty($monalisa['monalisa_footer_youtube_link'])) {
        $monalisa_footer_youtube_link = $monalisa['monalisa_footer_youtube_link'];
    }    
    
    if (isset($monalisa['monalisa_footer_insta_link']) && !empty($monalisa['monalisa_footer_insta_link'])) {
        $monalisa_footer_insta_link = $monalisa['monalisa_footer_insta_link'];
    }    
    
    $monalisa_default_logo_img = get_template_directory_uri() . '/assets/img/logo.png';
?>

    <!-- START FOOTER -->
    <footer class="footer section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    
                    <!-- Footer Logo -->
                    <div class="footer-logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php if (get_custom_logo()) {
                                the_custom_logo();
                            } else { ?>
                                <img src="<?php echo esc_url($monalisa_default_logo_img); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" style="max-width: 150px; height: auto;">
                            <?php } ?>    
                        </a>
                    </div>
                    
                    <!-- Social Media Links - Soul Suite Wellness -->
                    <div class="footer_social">
                        <ul>
                            <li>
                                <a class="footer_facebook" 
                                   href="<?php echo esc_url($monalisa_footer_fb_link); ?>" 
                                   title="Follow us on Facebook"
                                   target="_blank"
                                   rel="noopener noreferrer">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            
                            <!--<li>-->
                            <!--    <a class="footer_twitter" -->
                            <!--       href="<?php echo esc_url($monalisa_footer_tw_link); ?>" -->
                            <!--       title="Follow us on Twitter"-->
                            <!--       target="_blank"-->
                            <!--       rel="noopener noreferrer">-->
                            <!--        <i class="fa fa-twitter"></i>-->
                            <!--    </a>-->
                            <!--</li>-->
                            
                            <li>
                                <a class="footer_align" 
                                   href="<?php echo esc_url($monalisa_footer_align_link); ?>" 
                                   title="Connect with us on Alignable"
                                   target="_blank"
                                   rel="noopener noreferrer">
                                    <i class="alignable-icon">
                                        <svg width="20" height="20" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                                            <path fill="currentColor" d="M400,400H0V0h400v400ZM209.26,145.37c-.25-.2-.64-.35-.75-.62-9.16-22.11-18.35-44.21-27.34-66.39-.44-1.09.33-3.41,1.31-4.22,22.25-18.47,47.75-26.69,76.57-22.96,26.86,3.48,48.34,17.15,66.09,36.99,22.54,25.19,37.08,55.12,49.9,85.97,6.18,14.86,11.69,30,17.51,45.02,5.71-71.62-18.44-131.03-75.48-174.89C262.4,2.23,201.01-6.12,135.66,13.94c-.21,1.35-.38,1.72-.29,2,1.09,3.32,2.26,6.61,3.34,9.92,14.17,43.5,27.82,87.2,48.59,128.18,7.86,15.51,16.71,30.41,30.46,41.62,9.95,8.11,20.93,11.14,32.83,4.63,4.46-2.44,8.55-5.8,12.24-9.33,4.16-3.99,7.69-8.64,11.52-13.04.58.44,1.17.64,1.32,1.03,9.09,21.97,18.18,43.93,27.06,65.98.46,1.14-.52,3.59-1.61,4.52-17.6,15.02-38.05,23.1-61.15,23.68-25.21.63-47.28-8.18-66.64-24.01-19.18-15.68-32.7-35.83-44.32-57.32-20.75-38.37-34.92-79.42-48.44-120.71-2.29-7.01-4.78-13.96-7.27-21.18C-18.56,124.49-17.65,264.54,61.21,337.54c15.03-45.21,29.99-90.2,44.95-135.2.52.07,1.05.15,1.57.22,1.06,1.65,2.21,3.25,3.17,4.97,11.73,21.09,25.51,40.61,43.69,56.7,2.19,1.93,2.68,3.62,1.73,6.45-9.62,28.69-19.08,57.44-28.62,86.16-2.39,7.19-4.9,14.33-7.38,21.56,1.2.66,2.03,1.22,2.94,1.6,19.97,8.35,40.78,13.35,62.36,14.6,25.13,1.45,49.77-1.28,73.83-9.3,36.56-12.19,66.83-33.27,91.11-63.06,1.07-1.31,1.47-4.01.93-5.66-8.67-26.39-17.31-52.79-26.42-79.03-9.12-26.27-19.2-52.16-32.83-76.5-7.11-12.7-15.04-24.85-26.76-33.88-13.58-10.45-26.43-10.31-39.37.86-6,5.17-11.11,11.37-16.84,17.34Z"/>
                                        </svg>
                                    </i>
                                </a>
                            </li>
                            
                            <!--<li>-->
                            <!--    <a class="footer_linkedin" -->
                            <!--       href="<?php echo esc_url($monalisa_footer_linkedin_link); ?>" -->
                            <!--       title="Connect with us on LinkedIn"-->
                            <!--       target="_blank"-->
                            <!--       rel="noopener noreferrer">-->
                            <!--        <i class="fa fa-linkedin"></i>-->
                            <!--    </a>-->
                            <!--</li>-->
                            
                            <li>
                                <a class="footer_youtube" 
                                   href="<?php echo esc_url($monalisa_footer_youtube_link); ?>" 
                                   title="Subscribe to our YouTube channel"
                                   target="_blank"
                                   rel="noopener noreferrer">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                            
                            <li>
                                <a class="footer_insta" 
                                   href="<?php echo esc_url($monalisa_footer_insta_link); ?>" 
                                   title="Follow us on Instagram"
                                   target="_blank"
                                   rel="noopener noreferrer">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Copyright Text - Always Show -->
                    <div class="footer_copyright">
                        <p>
                            <?php 
                            if ($monalisa_copywrite_text) {
                                echo wp_kses_post($monalisa_copywrite_text);
                            } else {
                                echo esc_html__('© 2025 Soul Suite Wellness™. All Rights Reserved.', 'monalisa') . '<br>' . 
                                     esc_html__('Designed by ', 'monalisa') . '<a href="https://vaoneagency.com/chat" target="_blank" rel="noopener noreferrer" style="color: var(--color-orange); text-decoration: none;">VAOne Agency</a>';
                            }
                            ?>
                        </p>                            
                    </div>
                    
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
    </footer>
    <!-- END FOOTER -->
    
<?php }