<?php
/**
Template Name: Home Page
*
* This template is used to display the home page.
*
* @package NonProfit
* @since NonProfit 4.0
*
*/
get_header(); ?>

<?php if ( class_exists( 'Jetpack' ) && nonprofit_has_featured_posts( 1 ) || '0' != get_theme_mod('nonprofit_slideshow_category', '0') ) { ?>

<!-- BEGIN .home-slider -->
<div class="home-slider">

	<!-- BEGIN .row -->
	<div class="row">

		<?php get_template_part( 'content/slider', 'featured' ); ?>

	<!-- END .row -->
	</div>

<!-- END .home-slider -->
</div>

<?php } ?>

<!-- BEGIN .homepage -->
<div class="homepage">

	<?php if ( class_exists( 'Give' ) && '0' != get_theme_mod('nonprofit_home_give_form', '0') ) { ?>
	
	<?php $give_query = new WP_Query(array('post_type' => 'give_forms', 'p' => get_theme_mod('nonprofit_home_give_form', '0'), 'posts_per_page' => 1, 'suppress_filters' => 0 ) ); ?>
	<?php if ($give_query->have_posts() ) : while($give_query->have_posts() ) : $give_query->the_post(); ?>
	<?php $thumb = ( get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'nonprofit-featured-large' ) : false; ?>
	
	<!-- BEGIN .featured-give -->
	<div class="featured-give shadow"<?php if ( has_post_thumbnail() ) { ?> style="background-image: url(<?php echo esc_url($thumb[0]); ?>);"<?php } ?>>
	
		<!-- BEGIN .row -->
		<div class="row">
			
			<!-- BEGIN .donation -->
			<div class="donation<?php if ( has_post_thumbnail() ) { ?> radius-full shadow<?php } ?>">
					
				<h2 class="headline text-center"><?php the_title(); ?></h2>
				
				<?php if ( ! empty( $post->post_excerpt ) ) { ?>
					<div class="excerpt text-center"><?php the_excerpt(); ?></div>
				<?php } ?>
				
				<?php do_action( 'give_single_form_summary' ); ?>
			
			<!-- END .donation -->
			</div>
			
		<!-- END .row -->
		</div>

	<!-- END .featured-give -->
	</div>
	
	<?php endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	<?php } elseif ( get_theme_mod('nonprofit_donation_tagline', 'Donations Are Welcome') && '' != get_theme_mod('nonprofit_donation_tagline', 'Donations Are Welcome') ) { ?>
	
	<!-- BEGIN .featured-donation -->
	<div class="featured-donation shadow">
				
		<!-- BEGIN .row -->
		<div class="row">
			
			<!-- BEGIN .content -->
			<div class="content donation">
			
				<?php if ( get_theme_mod('nonprofit_donation_link', '#') && '' != get_theme_mod('nonprofit_donation_link', '#')) { ?>
				
				<div class="twelve columns">
					<h2><?php echo get_theme_mod('nonprofit_donation_tagline', 'Donations Are Welcome'); ?></h2>
					<p class="description"><?php echo get_theme_mod('nonprofit_donation_description', 'Enter a brief message about accepting donations for your cause. Edit the content in this section within the WordPress Customizer.'); ?></p>
				</div>
				
				<div class="four columns vertical-center">
					<div class="align-right">
						<a class="button large" href="<?php echo get_theme_mod('nonprofit_donation_link', '#'); ?>"><span class="btn-holder"><?php echo get_theme_mod('nonprofit_donation_link_text', 'Donate'); ?></span></a>
					</div>
				</div>
				
				<?php } else { ?>
				
				<div class="text-center">
					<h2><?php echo get_theme_mod('nonprofit_donation_tagline', 'Donations Are Welcome'); ?></h2>
					<p class="description"><?php echo get_theme_mod('nonprofit_donation_description', 'Enter a brief message about accepting donations for your cause. Edit the content in this section within the WordPress Customizer.'); ?></p>
				</div>
				
				<?php } ?>
			
			<!-- END .content -->
			</div>
			
		<!-- END .row -->
		</div>

	<!-- END .featured-donation -->
	</div>

	<?php } ?>

	<?php if ( get_theme_mod( 'page_left' ) && get_theme_mod( 'page_mid' ) && get_theme_mod( 'page_right' ) ) { ?>
	
	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .content -->
		<div class="content featured-pages no-bg">

			<div class="holder third">
				<?php $recent = new WP_Query('page_id='.get_theme_mod('page_left')); while($recent->have_posts()) : $recent->the_post(); ?>
					<?php get_template_part( 'content/home', 'page' ); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>

			<div class="holder third">
				<?php $recent = new WP_Query('page_id='.get_theme_mod('page_mid')); while($recent->have_posts()) : $recent->the_post(); ?>
					<?php get_template_part( 'content/home', 'page' ); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>

			<div class="holder third">
				<?php $recent = new WP_Query('page_id='.get_theme_mod('page_right')); while($recent->have_posts()) : $recent->the_post(); ?>
					<?php get_template_part( 'content/home', 'page' ); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>

		<!-- END .content -->
		</div>
	
	<!-- END .row -->
	</div>

	<?php } ?>

	<?php if ( get_theme_mod( 'nonprofit_page_bottom' ) && get_theme_mod('nonprofit_tabs_category') ) { ?>
	
	<!-- BEGIN .row -->
	<div class="row">

		<?php $recent = new WP_Query('page_id='.get_theme_mod('nonprofit_page_bottom')); while($recent->have_posts()) : $recent->the_post(); ?>
		<?php $thumb = ( get_the_post_thumbnail() ) ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'nonprofit-featured-medium' ) : false; ?>
		<?php $has_content = get_the_content(); ?>

		<!-- BEGIN .content -->
		<div class="content bottom-section no-bg">
		
			<!-- BEGIN .eight columns -->
			<div class="eight columns">
			
				<!-- BEGIN .featured-bottom -->
				<div class="featured-bottom shadow radius-full">
	
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="feature-img page-banner<?php if ( '' == $has_content ) { ?> radius-full<?php } ?>" style="background-image: url(<?php echo esc_url($thumb[0]); ?>);">
						<h2 class="headline img-headline"><?php the_title(); ?></h2>
						<?php the_post_thumbnail( 'nonprofit-featured-medium' ); ?>
					</div>
				<?php } ?>
	
				<?php get_template_part( 'content/home', 'bottom' ); ?>
				
				<!-- END .featured-bottom -->
				</div>
			
			<!-- END .eight columns -->
			</div>
			
			<!-- BEGIN .eight columns -->
			<div class="eight columns">
			
				<!-- BEGIN .featured-tabs -->
				<div class="featured-tabs radius-full">
				
					<?php get_template_part( 'content/home', 'tabs' ); ?>
				
				<!-- END .featured-bottom -->
				</div>
			
			<!-- END .eight columns -->
			</div>

		<!-- END .content -->
		</div>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	
	<!-- END .row -->
	</div>

	<?php } ?>
		
	<?php if ( '' == get_theme_mod( 'page_left' ) && '' == get_theme_mod( 'nonprofit_page_bottom' ) || '' == get_theme_mod( 'page_mid' ) && '' == get_theme_mod( 'nonprofit_page_bottom' ) || '' == get_theme_mod( 'page_right' ) && '' == get_theme_mod( 'nonprofit_page_bottom' ) ) { ?>
	
	<!-- BEGIN .row -->
	<div class="row">
	
		<!-- BEGIN .content -->
		<div class="content not-set shadow radius-full">
			
			<!-- BEGIN .postarea -->
			<div class="postarea full-width">

				<?php get_template_part( 'content/content', 'none' ); ?>
				
			<!-- END .postarea -->
			</div>
		
		<!-- END .content -->
		</div>
	
	<!-- END .row -->
	</div>
	
	<?php } ?>

<!-- END .homepage -->
</div>

<?php get_footer(); ?>
