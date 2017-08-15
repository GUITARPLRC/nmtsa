<?php
/**
* This template displays the portfolio loop.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
?>

<!-- BEGIN .portfolio-wrap -->
<div class="portfolio-wrap">

<?php $portfolio_query = new WP_Query(array('post_type' => 'jetpack-portfolio', 'posts_per_page' => 48, 'paged' => $paged, 'suppress_filters' => 0 ) ); ?>
<?php if ($portfolio_query->have_posts() ) : while($portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>

	<?php
  		$portfolio_column = get_theme_mod( 'project_columns', 'two' );
  		if ( $portfolio_column ) {
  			switch ( $portfolio_column ) {
  				case 'one':
    				$content = 'single';
    				break;

  				case 'two':
  					$content = 'half';
  					break;

  				case 'three':
  					$content = 'third';
  					break;

  				case 'four':
  					$content = 'fourth';
  					break;
  			}
  		}
  		else {
  			$content = 'half';
  		}
    ?>

	<!-- BEGIN .columns -->
	<div class="<?php echo $content; ?>">

    	<!-- BEGIN .portfolio-item -->
    	<div class="portfolio-item shadow radius-full">

        	<?php if ( has_post_thumbnail() ) { ?>
        		<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'nonprofit-featured-medium' ); ?></a>
        	<?php } else { ?>
        		<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/default-image.jpg" alt="<?php the_title(); ?>" /></a>
        	<?php } ?>

	    	<!-- BEGIN .information -->
	    	<div class="information">

	       	 	<h2 class="title text-center"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	       	<!-- END .information -->
	    	</div>

		<!-- END .portfolio-item -->
		</div>

	<!-- END .columns -->
	</div>

<?php endwhile; ?>

<!-- END .portfolio-wrap -->
</div>

	<?php if ($portfolio_query->max_num_pages > 1) { ?>

		<!-- BEGIN .pagination -->
		<div class="pagination">

			<?php
			$big = 999999999; // need an unlikely integer
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, $paged ),
				'prev_text' => esc_html__('&laquo;', 'organic-nonprofit'),
				'next_text' => esc_html__('&raquo;', 'organic-nonprofit'),
				'total' => $portfolio_query->max_num_pages
			) );
			?>

		<!-- END .pagination -->
		</div>

	<?php } ?>

<?php else : ?>

<!-- END .portfolio-wrap -->
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
