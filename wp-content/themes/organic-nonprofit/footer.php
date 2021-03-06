<?php
/**
* The footer for our theme.
* This template is used to generate the footer for the theme.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
?>

<!-- END .container -->
</div>

<?php if ( ! is_page_template('template-landing.php') ) { // Landing Page Conditional ?>

<!-- BEGIN .footer -->
<div class="footer">

	<!-- BEGIN .content -->
	<div class="content no-bg">

		<?php if ( is_active_sidebar('footer') ) { ?>

		<!-- BEGIN .row -->
		<div class="row">

			<!-- BEGIN .footer-widgets -->
			<div class="footer-widgets">

				<?php dynamic_sidebar( 'footer' ); ?>

			<!-- END .footer-widgets -->
			</div>

		<!-- END .row -->
		</div>

		<?php } ?>

		<!-- BEGIN .row -->
		<div class="row">

			<!-- BEGIN .footer-information -->
			<div class="footer-information">

				<div class="align-left">

					<p><?php esc_html_e("Copyright", 'organic-nonprofit'); ?> &copy; <?php echo date( esc_html__("Y", 'organic-nonprofit')); ?> &middot; <?php esc_html_e("All Rights Reserved", 'organic-nonprofit'); ?> &middot; <?php bloginfo('name'); ?></p>

				</div>

				<?php if ( has_nav_menu( 'social-menu' ) ) { ?>

				<div class="align-right">

					<?php wp_nav_menu( array(
						'theme_location' => 'social-menu',
						'title_li' => '',
						'depth' => 1,
						'container_class' => 'social-menu',
						'menu_class'      => 'social-icons',
						'link_before'     => '<span>',
						'link_after'      => '</span>',
						)
					); ?>

				</div>

				<?php } ?>

			<!-- END .footer-information -->
			</div>

		<!-- END .row -->
		</div>

	<!-- END .content -->
	</div>

<!-- END .footer -->
</div>

<?php } // End Landing Page ?>

<!-- END #wrapper -->
</div>

<?php wp_footer(); ?>

</body>
</html>
