<?php
/**
 * The header for our theme
 *
 * @package SoulSuite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="container">
			<div class="header-inner">
				<div class="site-branding">
				<?php
				if (has_custom_logo()) {
					the_custom_logo();
				} else {
					?>
					<h1 class="site-title">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<?php bloginfo('name'); ?>
						</a>
					</h1>
					<?php
					$description = get_bloginfo('description', 'display');
					if ($description || is_customize_preview()) :
						?>
						<p class="site-description"><?php echo $description; ?></p>
						<?php
					endif;
				}
				?>
				</div>
				
				<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span class="screen-reader-text"><?php _e('Menu', 'soul-suite'); ?></span>
					<i class="fa fa-bars"></i>
				</button>
				<div class="menu-wrapper">
					<?php soul_suite_main_menu(); ?>
					</div>
				</nav>
			</div>
		</div>
	</header>
	
	<div id="content" class="site-content">