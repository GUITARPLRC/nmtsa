<?php
/**
* This template is used to display author information, when clicking on an authors name.
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
		<div class="content">

			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>

				<!-- BEGIN .eleven columns -->
				<div class="eleven columns">

					<!-- BEGIN .postarea -->
					<div class="postarea">

						<?php get_template_part( 'content/content', 'author' ); ?>

					<!-- END .postarea -->
					</div>

				<!-- END eleven columns -->
				</div>

				<!-- BEGIN .five columns -->
				<div class="five columns">

					<?php get_sidebar(); ?>

				<!-- END .five columns -->
				</div>

			<?php } else { ?>

				<!-- BEGIN .sixteen columns -->
				<div class="sixteen columns">

					<!-- BEGIN .postarea full-width -->
					<div class="postarea full-width">

						<?php get_template_part( 'content/content', 'author' ); ?>

					<!-- END .postarea full-width -->
					</div>

				<!-- END sixteen columns -->
				</div>

			<?php } ?>

		<!-- END .content -->
		</div>

	<!-- END .row -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>