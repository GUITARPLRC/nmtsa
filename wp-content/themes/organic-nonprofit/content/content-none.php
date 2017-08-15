<?php
/**
* This template is used when no content is present.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
?>

<!-- BEGIN .no-results -->
<div class="no-results">

<?php if ( is_page_template('template-home.php') ) { ?>

	<h2 class="headline text-center"><?php esc_html_e("No Options Saved", 'organic-nonprofit'); ?></h2>
	<p class="text-center"><?php printf( wp_kses( __( 'Please set and save the theme options for the Home Page template within the <a href="%1$s">Customizer</a>.', 'organic-nonprofit' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'customize.php' ) ) ); ?></p>

<?php } elseif ( is_page_template('template-portfolio.php') ) { ?>

	<h2 class="headline text-center"><?php esc_html_e("No Projects Found", 'organic-nonprofit'); ?></h2>
	<p class="text-center"><?php printf( wp_kses( __( '<a href="%1$s">Add New</a> Projects to start creating your Portfolio.', 'organic-nonprofit' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php?post_type=jetpack-portfolio' ) ) ); ?></p>

<?php } else { ?>

	<h2 class="headline"><?php esc_html_e("No Results Found", 'organic-nonprofit'); ?></h2>
	<p><?php esc_html_e("It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.", 'organic-nonprofit'); ?></p>
	<div class="no-result-search"><?php get_template_part( 'searchform' ); ?></div>

<?php } ?>

<!-- END .no-results -->
</div>
