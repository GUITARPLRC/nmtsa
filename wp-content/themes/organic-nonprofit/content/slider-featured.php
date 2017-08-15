<?php
/**
* This template is used to display the theme featured slider.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
?>

<!-- BEGIN .slideshow -->
<div class="slideshow">

	<!-- BEGIN .flexslider -->
	<div class="flexslider loading" data-speed="<?php echo get_theme_mod('nonprofit_transition_interval', '12000'); ?>" data-transition="<?php echo get_theme_mod('nonprofit_transition_style', 'fade'); ?>">

		<div class="preloader"></div>

		<!-- BEGIN .slides -->
		<ul class="slides">
			
			<?php if ( class_exists( 'Jetpack' ) && nonprofit_has_featured_posts( 1 ) ) { ?>
			
				<?php $featured_posts = nonprofit_get_featured_posts(); ?>
				<?php foreach ( (array) $featured_posts as $order => $post ) : ?>
				<?php setup_postdata( $post ); ?>
			
					<?php get_template_part( 'content/slider', 'info' ); ?>
			
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			
			<?php } else { ?>
						
				<?php 
					$slideshow_query = new WP_Query(array(
					'cat' => get_theme_mod( 'nonprofit_slideshow_category', '0' ),
					'posts_per_page' => 999
					) );
				?>

				<?php if ( $slideshow_query->have_posts() ) : while( $slideshow_query->have_posts() ) : $slideshow_query->the_post(); ?>
				
					<?php get_template_part( 'content/slider', 'info' ); ?>
							
				<?php endwhile; else: endif; ?>
				<?php wp_reset_postdata(); ?>
				
			<?php } ?>

		<!-- END .slides -->
		</ul>

	<!-- END .flexslider -->
	</div>

<!-- END .slideshow -->
</div>