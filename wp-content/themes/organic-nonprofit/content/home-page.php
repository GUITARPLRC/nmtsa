<?php
/**
* This template is used to display the homepage middle section.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
$thumb = ( get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'nonprofit-featured-small' ) : false; ?>

<!-- BEGIN .content -->
<div class="content radius-full shadow">

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="feature-img page-banner" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo esc_url($thumb[0]); ?>);" <?php } ?>>
			<h2 class="headline img-headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php the_post_thumbnail( 'nonprofit-featured-small' ); ?>
		</div>
	<?php } ?>

	<!-- BEGIN .information -->
	<div class="information">

		<?php if ( ! has_post_thumbnail() ) { ?>
			<h2 class="headline text-center"><?php the_title(); ?></h2>
		<?php } ?>

		<?php the_excerpt(); ?>

	<!-- END .information -->
	</div>

<!-- END .content -->
</div>