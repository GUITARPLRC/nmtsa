<?php
/**
* This template is used to display the theme slider gallery.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
?>

<!-- BEGIN .slideshow gallery-slideshow -->
<div class="slideshow gallery-slideshow radius-top">

	<!-- BEGIN .flexslider -->
	<div class="flexslider loading" data-speed="<?php echo get_theme_mod('nonprofit_transition_interval', '12000'); ?>" data-transition="<?php echo get_theme_mod('nonprofit_transition_style', 'fade'); ?>">

		<div class="preloader"></div>

		<!-- BEGIN .slides -->
		<ul class="slides">
		
			<?php while ( have_posts() ) : the_post(); if ( get_post_gallery() ) : ?>
			            
	            <?php $gallery = get_post_gallery( $post, false ); $ids = explode( ",", $gallery['ids'] ); ?>
	            
	            <?php foreach( $ids as $id ) { ?>
	            	<?php $link = wp_get_attachment_url( $id ); ?>
	                <li><img src="<?php echo esc_url($link); ?>" class="gallery-slider-img" /></li>
	            <?php } ?>
			            
			<?php endif; endwhile; ?>

		<!-- END .slides -->
		</ul>

	<!-- END .flexslider -->
	</div>

<!-- END .slideshow gallery-slideshow -->
</div>