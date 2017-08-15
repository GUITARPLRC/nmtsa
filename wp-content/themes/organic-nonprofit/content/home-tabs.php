<?php
/**
* This template is used to display the homepage bottom section.
*
* @package NonProfit
* @since NonProfit 5.0
*
*/
?>

<!-- BEGIN .organic-tabs -->
<div class="organic-tabs">

	<?php $tabs = new WP_Query(array('cat' => get_theme_mod('nonprofit_tabs_category', '0'), 'posts_per_page' => 6 )); ?>

	<ul id="tabs">

		<?php if ($tabs->have_posts()) : $count = 1; while ($tabs->have_posts()) : $tabs->the_post(); ?>

		<?php $trim_title = get_the_title(); ?>
		<?php $short_title = wp_trim_words( $trim_title, $num_words = 2, $more = '' ); ?>

		<li><a href="<?php echo esc_url( '#panel-' . $count ); ?>"><?php echo esc_html( $short_title ); ?></a></li>

		<?php $count++; ?>
		<?php endwhile; ?>

	</ul>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	<?php if ($tabs->have_posts()) : $count = 1; while ($tabs->have_posts()) : $tabs->the_post(); ?>
	<?php $video = nonprofit_first_embed_media(); ?>

	<!-- BEGIN #tabs -->
	<div id="panel-<?php echo $count; ?>">

		<h2 class="headline small"><?php echo esc_html( nonprofit_tax_id_to_name( get_theme_mod('nonprofit_tabs_category') ) ); ?></h2>

		<?php if ( ! empty( $video ) ) { ?>
			<div class="feature-vid"><?php echo $video ?></div>
		<?php } else { ?>
			<?php if ( has_post_thumbnail()) { ?>
				<a class="feature-img" href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail( 'nonprofit-featured-medium' ); ?></a>
			<?php } ?>
		<?php } ?>

		<!-- BEGIN .information -->
		<div class="information">

			<h3 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

			<?php if ( ! empty( $post->post_excerpt ) ) { ?>
				<?php the_excerpt(); ?>
			<?php } else { ?>
				<?php the_content( esc_attr__("Read More", 'organic-nonprofit')); ?>
			<?php } ?>

		<!-- END .information -->
		</div>

	<!-- END #tabs -->
	</div>

	<?php $count++; ?>
	<?php endwhile; endif; ?>

<!-- END .organic-tabs -->
</div>
