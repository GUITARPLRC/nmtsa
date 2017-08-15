<?php
/**
* This template is used to display Give form archives.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
get_header(); ?>

<!-- BEGIN .post class -->
<div <?php post_class('donation-archive'); ?> id="post-<?php the_ID(); ?>">

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .content -->
		<div class="content no-bg donations">

			<?php get_template_part( 'give/loop', 'donations' ); ?>

		<!-- END .content -->
		</div>

	<!-- END .row -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>