<?php
/**
* This template displays the blog loop.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
?>

<?php $wp_query = new WP_Query(array('cat'=>get_theme_mod('nonprofit_blog_category', '0'), 'posts_per_page'=>get_theme_mod('nonprofit_blog_posts', '5'), 'paged'=>$paged, 'suppress_filters'=>0)); ?>
<?php if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
<?php $thumb = ( get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'nonprofit-featured-medium' ) : false; ?>
<?php global $more; $more = 0; ?>

<!-- BEGIN .blog-holder -->
<div class="blog-holder shadow radius-full">

	<?php if ( has_post_thumbnail()) { ?>
		<div class="feature-img post-banner" <?php if ( ! empty( $thumb ) ) { ?> style="background-image: url(<?php echo esc_url($thumb[0]); ?>);" <?php } ?>>
			<h2 class="headline img-headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php the_post_thumbnail( 'nonprofit-featured-medium' ); ?>
		</div>
	<?php } ?>

	<!-- BEGIN .postarea -->
	<div class="postarea">

		<!-- BEGIN .post class -->
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<div class="post-date">
				<p><i class="fa fa-clock-o"></i> <?php nonprofit_posted_on(); ?> <span class="align-right"><i class="fa fa-comment"></i> <a class="scroll" href="<?php the_permalink(); ?>#comments"><?php comments_number( esc_html__('Leave a Comment', 'organic-nonprofit'), esc_html__('1 Comment', 'organic-nonprofit'), esc_html__('% Comments', 'organic-nonprofit') ); ?></a></span></p>
			</div>

			<?php if ( ! has_post_thumbnail() ) { ?>
				<h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php } ?>

			<!-- BEGIN .article -->
			<div class="article">

				<?php the_content( esc_attr__("Read More", 'organic-nonprofit')); ?>

			<!-- END .article -->
			</div>

		<!-- END .post class -->
		</div>

	<!-- END .postarea -->
	</div>

<!-- END .blog-holder -->
</div>

<?php endwhile; ?>

	<?php if ($wp_query->max_num_pages > 1) { ?>

		<!-- BEGIN .pagination -->
		<div class="pagination">
			<?php echo nonprofit_get_pagination_links(); ?>
		<!-- END .pagination -->
		</div>

	<?php } ?>

<?php else : ?>

<!-- BEGIN .blog-holder -->
<div class="blog-holder shadow radius-full">

	<!-- BEGIN .postarea -->
	<div class="postarea">

		<?php get_template_part( 'content/content', 'none' ); ?>

	<!-- END .postarea -->
	</div>

<!-- END .blog-holder -->
</div>

<?php endif; ?>
