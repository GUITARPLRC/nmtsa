<?php
/**
* Jetpack Compatibility File
* See: http://jetpack.me/
*
* @package NonProfit
* @since NonProfit 1.0
*/

/**
* Add support for Jetpack's Featured Content
*/
function nonprofit_jetpack_setup() {

	// See: http://jetpack.me/support/featured-content/
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'nonprofit_get_featured_posts',
		'max_posts' => 10,
	) );

	// Add theme support for CPT
	add_theme_support( 'jetpack-portfolio' );

}
add_action( 'after_setup_theme', 'nonprofit_jetpack_setup' );

/**
* Featured Content: get our featured posts
*/
function nonprofit_get_featured_posts() {
	return apply_filters( 'nonprofit_get_featured_posts', array() );
}

/**
* Featured Content: check if we have at least one post in our FC tag
*/
function nonprofit_has_featured_posts( $minimum = 1 ) {
	if ( is_paged() )
		return true;

	$minimum = absint( $minimum );
	$featured_posts = apply_filters( 'nonprofit_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) )
		return false;

	if ( $minimum > count( $featured_posts ) )
		return false;

	return true;
}