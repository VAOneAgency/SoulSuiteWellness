<?php


// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
   exit;
}

get_header();
monalisa_shop_archive_banner();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-12">
					<div class="main_blog_area">
						<?php
						if ( have_posts() ) :
							woocommerce_content();
						endif;
						?>

					</div> 
				</div> <!-- End Col  -->
				
				<div class="col-lg-3 col-md-3 col-12">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div><!-- End Col  -->
				
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->
  
<?php
get_footer();
?>
