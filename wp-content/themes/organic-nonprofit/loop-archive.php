<?php
/**
* This template displays the archive loop.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- BEGIN .post class -->
<div <?php post_class('archive-holder'); ?> id="post-<?php the_ID(); ?>">

	<h2 class="headline small"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	<div class="post-date">
		<p><i class="fa fa-clock-o"></i> <?php nonprofit_posted_on(); ?> <span class="align-right"><i class="fa fa-comment"></i> <a class="scroll" href="<?php the_permalink(); ?>#comments"><?php comments_number( esc_html__('Leave a Comment', 'organic-nonprofit'), esc_html__('1 Comment', 'organic-nonprofit'), esc_html__('% Comments', 'organic-nonprofit') ); ?></a></span></p>
	</div>

	<?php if ( has_post_thumbnail()) { ?>
		<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organic-nonprofit' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'nonprofit-featured-large' ); ?></a>
	<?php } ?>

	<?php the_excerpt(); ?>

	<?php $tag_list = get_the_tag_list( esc_html__( ",", 'organic-nonprofit' ) ); if ( ! empty( $tag_list ) || has_category() ) { ?>

		<!-- BEGIN .post-meta -->
		<div class="post-meta">

			<p><i class="fa fa-bars"></i> <?php esc_html_e("Category:", 'organic-nonprofit'); ?> <?php the_category(', '); ?> <?php if ( ! empty( $tag_list ) ) { ?><i class="fa fa-tags"></i> <?php esc_html_e("Tags:", 'organic-nonprofit'); ?> <?php the_tags(''); ?><?php } ?></p>

		<!-- END .post-meta -->
		</div>

	<?php } ?>

<!-- END .post class -->
</div>

<?php endwhile; ?>

<!-- BEGIN .pagination -->
<div class="pagination">
	<?php echo nonprofit_get_pagination_links(); ?>
<!-- END .pagination -->
</div>

<?php else: ?>

	<?php get_template_part( 'content/content', 'none' ); ?>

<?php endif; ?>
