<?php
/**
* This template is used to display the theme featured slider.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
?>

<?php $thumb = ( get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'nonprofit-featured-large' ) : false; ?>

<li <?php post_class(); ?> id="post-<?php the_ID(); ?>" <?php if ( has_post_thumbnail() ) { ?> style="background-image: url(<?php echo esc_url($thumb[0]); ?>);"<?php } else { ?> style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/images/default-image.jpg');"<?php } ?>>

		<!-- BEGIN .information -->
		<div class="information<?php if ( 'bottom' == get_theme_mod( 'slider_info_position', 'right' ) ) { ?> bottom-position<?php } ?>">

			<!-- BEGIN .content -->
			<div class="content no-bg clearfix">

				<h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

				<?php if ( ! empty( $post->post_excerpt ) ) { ?>

					<!-- BEGIN .excerpt -->
					<div class="excerpt">

						<div class="post-date">
							<p class="align-left"><i class="fa fa-clock-o"></i>
								<?php if ( get_the_modified_time() != get_the_time() ) { ?>
									<?php esc_html_e("Updated on", 'organic-nonprofit'); ?> <?php the_modified_date( esc_html__("F j, Y", 'organic-nonprofit') ); ?>
								<?php } else { ?>
									<?php esc_html_e("Posted on", 'organic-nonprofit'); ?> <?php the_time( esc_html__("F j, Y", 'organic-nonprofit') ); ?>
								<?php } ?>
							</p>
							<p class="align-right"><i class="fa fa-comment"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number( esc_html__("Leave a Comment", 'organic-nonprofit'), esc_html__("1 Comment", 'organic-nonprofit'), '% Comments'); ?></a></p>
						</div>

						<?php the_excerpt(); ?>

						<p><a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'organic-nonprofit'); ?></a></p>

					<!-- END .excerpt -->
					</div>

				<?php } ?>

			<!-- END .content -->
			</div>

		<!-- END .information -->
		</div>

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="hide-img"><?php the_post_thumbnail( 'nonprofit-featured-large' ); ?></div>
	<?php } else { ?>
		<img class="hide-img" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/default-image.jpg" alt="<?php the_title_attribute(); ?>" />
	<?php } ?>

</li>
