<?php
/**
* The Header for our theme.
* Displays all of the <head> section and everything up till <div id="wrap">
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
?><!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

	<meta charset="<?php bloginfo('charset'); ?>">

	<!-- Mobile View -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url( bloginfo('pingback_url') ); ?>">

	<?php get_template_part( 'style', 'options' ); ?>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!-- BEGIN #wrapper -->
<div id="wrapper">

<?php if ( ! is_page_template('template-landing.php') ) { // Landing Page Conditional ?>

<!-- BEGIN #top-info -->
<div id="top-info">

	<?php if ( get_theme_mod( 'nonprofit_contact_email', 'info@mynonprofit.com' ) || get_theme_mod( 'nonprofit_contact_phone', '808.123.4567' ) || get_theme_mod( 'nonprofit_contact_address', '231 Front Street, Lahaina, HI 96761' ) ) { ?>

	<!-- BEGIN #contact-info -->
	<div id="contact-info">

		<!-- BEGIN .content -->
		<div class="content">

			<div class="align-left">

			<?php if ( get_theme_mod( 'nonprofit_contact_address', '231 Front Street, Lahaina, HI 96761' ) ) { ?>
				<span class="contact-address"><i class="fa fa-map-marker"></i> <?php echo esc_html( get_theme_mod( 'nonprofit_contact_address', '231 Front Street, Lahaina, HI 96761' ) ); ?></span>
			<?php } ?>

			<?php if ( get_theme_mod( 'nonprofit_contact_email', 'info@mynonprofit.com' ) ) { ?>
				<span class="contact-email text-right"><i class="fa fa-envelope"></i> <a class="link-email" href="mailto:<?php echo esc_html( get_theme_mod( 'nonprofit_contact_email', 'info@mynonprofit.com' ) ); ?>" target="_blank"><?php echo esc_html( get_theme_mod( 'nonprofit_contact_email', 'info@mynonprofit.com' ) ); ?></a></span>
			<?php } ?>

			<?php if ( get_theme_mod( 'nonprofit_contact_phone', '808.123.4567' ) ) { ?>
				<span class="contact-phone text-right"><i class="fa fa-phone"></i> <?php echo esc_html( get_theme_mod( 'nonprofit_contact_phone', '808.123.4567' ) ); ?></span>
			<?php } ?>

			</div>

			<?php if ( get_theme_mod('nonprofit_display_header_search', '1') == '1') { ?>

			<div class="align-right">

				<div class="header-search"><i class="fa fa-search"></i> <?php get_template_part( 'searchform' ); ?></div>

			</div>

			<?php } ?>

		<!-- END .content -->
		</div>

	<!-- END #contact-info -->
	</div>

	<?php } ?>

	<!-- BEGIN #top-nav -->
	<div id="top-nav">

		<!-- BEGIN .content -->
		<div class="content">

		<?php if ( get_theme_mod( 'nonprofit_logo', get_template_directory_uri() . '/images/logo.png' ) ) { ?>

			<!-- BEGIN #logo -->
			<h1 id="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( get_theme_mod( 'nonprofit_logo', get_template_directory_uri() . '/images/logo.png' ) ); ?>" alt="" />
					<h1 class="hide-text"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></h1>
				</a>
			<!-- END #logo -->
			</h1>

		<?php } else { ?>

			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></a>
			</h1>

		<?php } ?>

		<?php if ( has_nav_menu( 'main-menu' ) ) { ?>

			<span class="menu-toggle"><i class="fa fa-bars"></i></span>

			<!-- BEGIN #navigation -->
			<nav id="navigation" class="navigation-main vertical-center" role="navigation">

				<?php wp_nav_menu( array(
					'theme_location' 	=> 'main-menu',
					'title_li' 			=> '',
					'depth' 			=> 4,
					'fallback_cb'     	=> 'wp_page_menu',
					'container_class' 	=> '',
					'menu_class'      	=> 'menu'
					)
				); ?>

			<!-- END #navigation -->
			</nav>

		<?php } else { ?>

			<!-- BEGIN #navigation -->
			<nav id="navigation" class="navigation-main vertical-center" role="navigation">

				<p class="instruction"><?php printf( wp_kses( __( 'Create a Custom Navigation Menu <a href="%1$s">here</a>.', 'organic-nonprofit' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'nav-menus.php' ) ) ); ?></p>

			<!-- END #navigation -->
			</nav>

		<?php } ?>

		<!-- END .content -->
		</div>

	<!-- END #top-nav -->
	</div>

<!-- END #top-info -->
</div>

<?php $header_image = get_header_image(); ?>

<?php if ( ! is_page_template('template-home.php') || is_page_template('template-home.php') && '0' == get_theme_mod('nonprofit_slideshow_category', '0') ) { ?>
<?php if ( is_home() || is_404() || is_single() && ! is_singular('give_forms') || is_singular('give_forms') && ! has_post_thumbnail() || is_attachment() || is_archive() || is_search() || is_page() && ! has_post_thumbnail() ) { ?>
<?php if ( 'blank' != get_theme_mod( 'header_textcolor' ) || ! empty( $header_image ) ) { ?>

<!-- BEGIN #header -->
<div id="header">

	<?php if ( ! empty( $header_image ) ) { ?>

	<!-- BEGIN .custom-header -->
	<div class="custom-header" style="background-image: url(<?php header_image(); ?>);">

	<?php } ?>

	<!-- BEGIN #site-info -->
	<div id="site-info">

		<!-- BEGIN .content -->
		<div class="content">

			<div id="header-content" <?php if ( ! empty( $header_image ) ) { ?>class="vertical-center"<?php } ?>>

				<?php if ( 'blank' != get_theme_mod( 'header_textcolor' ) ) { ?>

					<!-- BEGIN #masthead -->
					<div id="masthead">

						<h2 class="site-description">
							<?php echo html_entity_decode( get_bloginfo( 'description' ) ); ?>
						</h2>

					<!-- END #masthead -->
					</div>

				<?php } ?>

			</div>

			<?php if ( ! empty( $header_image ) ) { ?>

			<img class="hide-img" src="<?php header_image(); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" alt="<?php echo esc_attr( get_bloginfo() ); ?>" />

			<?php } ?>

		<!-- END .content -->
		</div>

	<!-- END #site-info -->
	</div>

	<?php if ( ! empty( $header_image ) ) { ?>

	<!-- BEGIN .custom-header -->
	</div>

	<?php } ?>

<!-- END #header -->
</div>

<?php } ?>
<?php } ?>
<?php } ?>

<?php } // End Landing Page ?>

<!-- BEGIN .container -->
<div class="container">
