<?php
/**
* This template displays the donations loop.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
?>

<!-- BEGIN .donations-wrap -->
<div class="donations-wrap">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
	<!-- BEGIN .half -->
	<div class="half">
    	
    	<!-- BEGIN .donation-post -->
    	<div class="donation-post shadow radius-full">

        	<?php if ( has_post_thumbnail() ) { ?>
        		<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'nonprofit-featured-medium' ); ?></a>
        	<?php } else { ?>
        		<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/default-image.jpg" alt="<?php the_title(); ?>" /></a>
        	<?php } ?>
			
	    	<!-- BEGIN .information -->
	    	<div class="information">
	    	       
	       	 	<h2 class="title text-center"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	       	 	
	       	 	<?php if ( ! empty( $post->post_excerpt ) ) { ?>
	       	 		<div class="excerpt text-center"><?php the_excerpt(); ?></div>
	       	 	<?php } ?>
	       	
	       	<!-- END .information -->
	    	</div>
		
		<!-- END .donation-post -->
		</div>
	
	<!-- END .half -->
	</div>
    
<?php endwhile; ?>

<!-- END .donations-wrap -->
</div>
	
	<!-- BEGIN .pagination -->
	<div class="pagination">
		<?php echo nonprofit_get_pagination_links(); ?>
	<!-- END .pagination -->
	</div>

<?php else : ?>

<!-- END .donations-wrap -->
</div>

	<!-- BEGIN .content -->
	<div class="content not-set shadow radius-full">
		
		<!-- BEGIN .postarea -->
		<div class="postarea full-width">
	
			<?php get_template_part( 'content/content', 'none' ); ?>
			
		<!-- END .postarea -->
		</div>
	
	<!-- END .content -->
	</div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>