<?php
/**
Template Name: Landing Page
*
* This template is used to display a landing, or coming soon page.
*
* @package NonProfit
* @since NonProfit 1.0
*
*/
get_header(); ?>

<?php $thumb = ( '' != get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'nonprofit-featured-large' ) : false; ?>

<!-- BEGIN .post class -->
<div <?php post_class('landing-page'); ?> id="page-<?php the_ID(); ?>" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo $thumb[0]; ?>);" <?php } ?>>

	<!-- BEGIN .absolute-center -->
	<div class="absolute-center">

		<!-- BEGIN .content -->
		<div class="content shadow radius-full">

			<!-- BEGIN .postarea -->
			<div class="postarea full-width-width">

			<?php if ( get_theme_mod( 'nonprofit_logo', get_template_directory_uri() . '/images/logo.png' ) ) { ?>

				<h1 id="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo esc_url( get_theme_mod( 'nonprofit_logo', get_template_directory_uri() . '/images/logo.png' ) ); ?>" alt="" />
						<span class="logo-text"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></span>
					</a>
				</h1>

			<?php } else { ?>

				<div id="masthead" class="<?php if (get_theme_mod('logo_align', 'center') == 'center') { ?>text-center<?php } if (get_theme_mod('logo_align') == 'right') { ?>text-right<?php } ?>">

					<h1 class="site-title<?php if (get_theme_mod('title_color') == 'white') { ?> white<?php } ?>">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></a>
					</h1>

					<h2 class="site-description">
						<?php echo wp_kses_post( get_bloginfo( 'description' ) ); ?>
					</h2>

				</div>

			<?php } ?>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php $has_content = get_the_content(); ?>

			<?php if ( '' != $has_content ) { ?>

				<!-- BEGIN .article -->
				<div class="article text-center">

					<?php the_content(__("Read More", 'organic-nonprofit')); ?>

				<!-- END .article -->
				</div>

			<?php } ?>

			<?php endwhile; endif; ?>

			<!-- END .postarea -->
			</div>

		<!-- END .content -->
		</div>

	<!-- END .absolute-center -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>
