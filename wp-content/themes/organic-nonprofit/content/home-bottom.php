<?php
/**
* This template is used to display the homepage bottom section.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
$has_content = get_the_content(); ?>

<?php if ( '' != $has_content ) { ?>

<!-- BEGIN .postarea -->
<div class="postarea">

	<?php if ( ! has_post_thumbnail() ) { ?>
		<h2 class="headline text-center"><?php the_title(); ?></h2>
	<?php } ?>

	<?php the_content( esc_html__("Read More", 'organic-nonprofit') ); ?>

<!-- END .postarea -->
</div>

<?php } ?>
