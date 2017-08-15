<?php
/**
* This template displays the post loop.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="post-date">
	<p><i class="fa fa-comment"></i> <a class="scroll" href="<?php the_permalink(); ?>#comments"><?php comments_number( esc_html__('Leave a Comment', 'organic-nonprofit'), esc_html__('1 Comment', 'organic-nonprofit'), esc_html__('% Comments', 'organic-nonprofit') ); ?></a></p>
	<p><i class="fa fa-clock-o"></i> <?php nonprofit_posted_on(); ?></p>
</div>

<?php if ( ! has_post_thumbnail() || has_post_thumbnail() && is_singular('jetpack-portfolio') ) { ?>
	<h1 class="headline"><?php the_title(); ?></h1>
<?php } ?>

<!-- BEGIN .article -->
<div class="article">

	<?php the_content(); ?>

<!-- END .article -->
</div>

<?php wp_link_pages(array(
	'before' => '<p class="page-links"><span class="link-label">' . esc_html__('Pages:', 'organic-nonprofit') . '</span>',
	'after' => '</p>',
	'link_before' => '<span>',
	'link_after' => '</span>',
	'next_or_number' => 'next_and_number',
	'nextpagelink' => esc_html__('Next', 'organic-nonprofit'),
	'previouspagelink' => esc_html__('Previous', 'organic-nonprofit'),
	'pagelink' => '%',
	'echo' => 1 )
); ?>

<?php $tag_list = get_the_tag_list( esc_html__( ", ", 'organic-nonprofit' ) ); if ( ! empty( $tag_list ) || has_category() ) { ?>

	<!-- BEGIN .post-meta -->
	<div class="post-meta">

		<p><i class="fa fa-bars"></i> <?php esc_html_e("Category:", 'organic-nonprofit'); ?> <?php the_category(', '); ?><?php $tag_list = get_the_tag_list( esc_html__( ", ", 'organic-nonprofit' ) ); if ( ! empty( $tag_list ) ) { ?> <i class="fa fa-tags"></i> <?php esc_html_e("Tags:", 'organic-nonprofit'); ?> <?php the_tags(''); ?><?php } ?></p>

	<!-- END .post-meta -->
	</div>

<?php } ?>

<!-- BEGIN .post-navigation -->
<div class="post-navigation">
	<div class="previous-post"><?php previous_post_link('&larr; %link'); ?></div>
	<div class="next-post"><?php next_post_link('%link &rarr;'); ?></div>
<!-- END .post-navigation -->
</div>

<?php if ( comments_open() || '0' != get_comments_number() ) comments_template(); ?>

<div class="clear"></div>

<?php endwhile; else: ?>

	<?php get_template_part( 'content/content', 'none' ); ?>

<?php endif; ?>
