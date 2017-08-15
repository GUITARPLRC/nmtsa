<?php
/**
 * The Template for displaying all single Give Forms.
 *
 * Override this template by copying it to yourtheme/give/single-give-forms.php
 *
 * @package Give/Templates
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<?php $thumb = ( get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'nonprofit-featured-large' ) : false; ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="feature-img page-banner" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo esc_url($thumb[0]); ?>);" <?php } ?>>
			<h1 class="headline img-headline"><?php the_title(); ?></h1>
			<?php the_post_thumbnail( 'nonprofit-featured-large' ); ?>
		</div>
	<?php } ?>
	
	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .content -->
		<div class="content shadow radius-full">

		<?php if ( is_active_sidebar( 'give-forms-sidebar' ) ) { ?>
		
			<!-- BEGIN .eleven columns -->
			<div class="eleven columns">

				<!-- BEGIN .postarea -->
				<div class="postarea">

					<?php while ( have_posts() ) : the_post(); ?>
											
						<?php if ( ! has_post_thumbnail() ) { ?>
							<h1 class="headline"><?php the_title(); ?></h1>
						<?php } ?>
						
						<?php do_action( 'give_single_form_summary' ); ?>

					<?php endwhile; // end of the loop. ?>
					
				<!-- END .postarea -->
				</div>

			<!-- END .eleven columns -->
			</div>

			<!-- BEGIN .five columns -->
			<div class="five columns">
				
				<div class="sidebar">
					<?php dynamic_sidebar('give-forms-sidebar'); ?>
				</div>

			<!-- END .five columns -->
			</div>

		<?php } else { ?>
		
			<!-- BEGIN .sixteen columns -->
			<div class="sixteen columns">

				<!-- BEGIN .postarea full-width -->
				<div class="postarea full-width">
					
					<?php while ( have_posts() ) : the_post(); ?>
						
						<?php if ( ! has_post_thumbnail() ) { ?>
							<h1 class="headline text-center"><?php the_title(); ?></h1>
						<?php } ?>
						
						<?php do_action( 'give_single_form_summary' ); ?>

					<?php endwhile; // end of the loop. ?>

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