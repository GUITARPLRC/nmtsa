<?php
/**
* This template displays single post content.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
get_header(); ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .content -->
		<div class="content shadow radius-full">

			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>

				<!-- BEGIN .eleven columns -->
				<div class="eleven columns">
				
					<?php $thumb = ( get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'nonprofit-featured-medium' ) : false; ?>
					
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="feature-img post-banner" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo esc_url($thumb[0]); ?>);" <?php } ?>>
							<?php if ( ! is_singular('jetpack-portfolio') ) { ?>
								<h1 class="headline img-headline"><?php the_title(); ?></h1>
							<?php } ?>
							<?php the_post_thumbnail( 'nonprofit-featured-medium' ); ?>
						</div>
					<?php } ?>

					<!-- BEGIN .postarea -->
					<div class="postarea">

						<?php get_template_part( 'loop', 'post' ); ?>

					<!-- END .postarea -->
					</div>

				<!-- END .eleven columns -->
				</div>

				<!-- BEGIN .five columns -->
				<div class="five columns">

					<?php get_sidebar('post'); ?>

				<!-- END .five columns -->
				</div>

			<?php } else { ?>

				<!-- BEGIN .sixteen columns -->
				<div class="sixteen columns">
					
					<?php $thumb = ( get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'nonprofit-featured-medium' ) : false; ?>

					<?php if ( has_post_thumbnail() ) { ?>
						<div class="feature-img post-banner" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo esc_url($thumb[0]); ?>);" <?php } ?>>
							<h1 class="headline img-headline"><?php the_title(); ?></h1>
							<?php the_post_thumbnail( 'nonprofit-featured-medium' ); ?>
						</div>
					<?php } ?>

					<!-- BEGIN .postarea full-width -->
					<div class="postarea full-width">

						<?php get_template_part( 'loop', 'post' ); ?>

					<!-- END .postarea full-width -->
					</div>

				<!-- END .sixteen columns -->
				</div>

			<?php } ?>

		<!-- END .content -->
		</div>

	<!-- END .row -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>
