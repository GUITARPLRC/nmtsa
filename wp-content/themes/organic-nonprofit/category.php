<?php
/**
* This template is used to display category post indexes.
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
		<div class="content no-bg clearfix">

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>

			<!-- BEGIN .eleven columns -->
			<div class="eleven columns">
			
				<?php get_template_part( 'loop', 'category' ); ?>

			<!-- END .eleven columns -->
			</div>

			<!-- BEGIN .five columns -->
			<div class="five columns">

				<?php get_sidebar('blog'); ?>

			<!-- END .five columns -->
			</div>

		<?php } else { ?>

			<!-- BEGIN .sixteen columns -->
			<div class="sixteen columns">

				<?php get_template_part( 'loop', 'category' ); ?>

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