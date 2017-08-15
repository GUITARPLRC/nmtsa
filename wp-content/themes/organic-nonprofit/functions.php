<?php
/**
 * This file includes the theme functions.
 *
 * @package NonProfit
 * @since NonProfit 4.0
 */

/*
-----------------------------------------------------------------------------------------------------
	Theme Setup
-----------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'nonprofit_setup' ) ) :

	function nonprofit_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'organic-nonprofit', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Enable support for site title tag.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails.
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'nonprofit-featured-large', 2400, 1800 ); // Large Featured Image.
		add_image_size( 'nonprofit-featured-medium', 1800, 1200 ); // Medium Featured Image.
		add_image_size( 'nonprofit-featured-small', 640, 640 ); // Small Featured Image.
		add_image_size( 'nonprofit-logo-size', 760, 280 ); // Logo Size.

		// Create Menus.
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main Menu', 'organic-nonprofit' ),
			'social-menu' => esc_html__( 'Social Menu', 'organic-nonprofit' ),
		));

		// Custom Header.
		register_default_headers( array(
			'forest' => array(
			'url'   => get_template_directory_uri() . '/images/header.jpg',
			'thumbnail_url' => get_template_directory_uri() . '/images/header-thumb.jpg',
			'description'   => esc_html__( 'Default Custom Header', 'organic-nonprofit' ),
			),
		));
		$defaults = array(
		'width'                 => 1800,
		'height'                => 640,
		'default-image' 		=> get_template_directory_uri() . '/images/header.jpg',
		'flex-height'           => true,
		'flex-width'            => true,
		'default-text-color'    => 'ffffff',
		'header-text'           => true,
		'uploads'               => true,
		);
		add_theme_support( 'custom-header', $defaults );

		// Custom Background.
		$defaults = array(
		'default-color'          => 'eeeeee',
		);
		add_theme_support( 'custom-background', $defaults );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'nonprofit_setup' );

/*
-------------------------------------------------------------------------------------------------------
	Admin Notice
-------------------------------------------------------------------------------------------------------
*/

/** Function organic_nonprofit_admin_notice */
function organic_nonprofit_admin_notice() {
	global $current_user ;
	$user_id = $current_user->ID;
	if ( ! get_user_meta( $user_id, 'organic_nonprofit_ignore_notice' ) ) {
		echo '<div class="notice updated is-dismissible"><p>';
		printf( __( 'Enjoying the NonProfit Theme? Try <a href="%1$s" target="_blank">GivingPress</a> for FREE! A complete website solution for non-profits. <a class="notice-dismiss" type="button" href="%2$s"><span class="screen-reader-text">Hide Notice</span></a>', 'organic-nonprofit' ), 'http://givingpress.com/', '?organic_nonprofit_nag_ignore=0' );
		echo '</p></div>';
	}
}
add_action( 'admin_notices', 'organic_nonprofit_admin_notice' );

/** Function organic_nonprofit_nag_ignore */
function organic_nonprofit_nag_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	if ( isset( $_GET['organic_nonprofit_nag_ignore'] ) && '0' == $_GET['organic_nonprofit_nag_ignore'] ) {
		 add_user_meta( $user_id, 'organic_nonprofit_ignore_notice', 'true', true );
	}
}
add_action( 'admin_init', 'organic_nonprofit_nag_ignore' );

/*
-------------------------------------------------------------------------------------------------------
	Theme Updater
-------------------------------------------------------------------------------------------------------
*/

function nonprofit_theme_updater() {
	require( get_template_directory() . '/updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'nonprofit_theme_updater' );

/*
-------------------------------------------------------------------------------------------------------
	Category ID to Name
-------------------------------------------------------------------------------------------------------
*/

function nonprofit_tax_id_to_name( $id ) {
	$term = get_term( $id, 'category' );
	if ( is_wp_error( $term ) ) {
		return false; }
	return $name = $term->name;
}

/*
-------------------------------------------------------------------------------------------------------
	Register Scripts
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'nonprofit_enqueue_scripts' ) ) {
	function nonprofit_enqueue_scripts() {

		// Enqueue Styles.
		wp_enqueue_style( 'nonprofit-style', get_stylesheet_uri() );
		wp_enqueue_style( 'nonprofit-style-mobile', get_template_directory_uri() . '/css/style-mobile.css', array( 'nonprofit-style' ), '1.0' );

		// Resgister Scripts.
		wp_register_script( 'nonprofit-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'nonprofit-hover', get_template_directory_uri() . '/js/hoverIntent.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'nonprofit-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery', 'nonprofit-hover' ), '20130729' );

		// Enqueue Scripts.
		wp_enqueue_script( 'nonprofit-html5shiv', get_template_directory_uri() . '/js/html5shiv.js' );
		wp_enqueue_script( 'nonprofit-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20130729', true );
		wp_enqueue_script( 'nonprofit-custom', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery', 'nonprofit-superfish', 'nonprofit-fitvids', 'masonry' ), '20130729', true );

		// IE Conditional Scripts.
		global $wp_scripts;
		$wp_scripts->add_data( 'nonprofit-html5shiv', 'conditional', 'lt IE 9' );

		// Load Flexslider on front page and slideshow page template.
		if ( is_home() || is_page_template( 'template-home.php' ) || is_single() || is_page_template( 'template-slideshow.php' ) ) {
			wp_enqueue_script( 'nonprofit-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '20130729' );
		}

		// Load single scripts only on single pages.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'nonprofit_enqueue_scripts' );

/*
-------------------------------------------------------------------------------------------------------
	Register Sidebars
-------------------------------------------------------------------------------------------------------
*/

function organic_widgets_init() {
	register_sidebar(array(
		'name' => esc_html__( 'Default Sidebar', 'organic-nonprofit' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	));
	register_sidebar(array(
		'name' => esc_html__( 'Left Sidebar', 'organic-nonprofit' ),
		'id' => 'sidebar-left',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	));
	register_sidebar(array(
		'name' => esc_html__( 'Footer Widgets', 'organic-nonprofit' ),
		'id' => 'footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer-widget">',
		'after_widget' => '</div></div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	));
}
add_action( 'widgets_init', 'organic_widgets_init' );

/*
-------------------------------------------------------------------------------------------------------
	Add Stylesheet To Visual Editor
-------------------------------------------------------------------------------------------------------
*/

add_action( 'widgets_init', 'nonprofit_add_editor_styles' );
/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
 */
function nonprofit_add_editor_styles() {
	add_editor_style( 'css/style-editor.css' );
}

/*
------------------------------------------------------------------------------------------------------
	Content Width
------------------------------------------------------------------------------------------------------
*/

function nonprofit_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nonprofit_content_width', 980 );
}
add_action( 'after_setup_theme', 'nonprofit_content_width', 0 );

/*
-------------------------------------------------------------------------------------------------------
	Comments Function
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'nonprofit_comment' ) ) :
	function nonprofit_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', 'organic-nonprofit' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'organic-nonprofit' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
		break;
			default :
		?>
		<li <?php comment_class(); ?> id="<?php echo esc_attr( 'li-comment-' . get_comment_ID() ); ?>">

		<article id="<?php echo esc_attr( 'comment-' . get_comment_ID() ); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 72;
					if ( '0' != $comment->comment_parent ) {
						$avatar_size = 48; }

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <br/> %2$s <br/>', 'organic-nonprofit' ),
							sprintf( '<span class="fn">%s</span>', wp_kses_post( get_comment_author_link() ) ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( esc_html__( '%1$s', 'organic-nonprofit' ), get_comment_date(), get_comment_time() )
							)
						);
						?>
					</div><!-- .comment-author .vcard -->
				</footer>

				<div class="comment-content">
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'organic-nonprofit' ); ?></em>
					<br />
				<?php endif; ?>
					<?php comment_text(); ?>
					<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'organic-nonprofit' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
					<?php edit_comment_link( esc_html__( 'Edit', 'organic-nonprofit' ), '<span class="edit-link">', '</span>' ); ?>
				</div>

			</article><!-- #comment-## -->

		<?php
		break;
		endswitch;
	}
endif; // Ends check for nonprofit_comment().

/*
-------------------------------------------------------------------------------------------------------
	Custom Excerpt Length
-------------------------------------------------------------------------------------------------------
*/

function nonprofit_excerpt_length( $length ) {
	return 38;
}
add_filter( 'excerpt_length', 'nonprofit_excerpt_length', 999 );

function nonprofit_excerpt_more( $more ) {
	return '... <a class="read-more" href="'. esc_url( get_permalink( get_the_ID() ) ) . '">'. esc_html__( 'Read More', 'organic-nonprofit' ) .'</a>';
}
add_filter( 'excerpt_more', 'nonprofit_excerpt_more' );

/*
-----------------------------------------------------------------------------------------------------
	Posted On Function
-------------------------------------------------------------------------------------------------------
*/

function nonprofit_posted_on() {
	if ( get_the_modified_time() != get_the_time() ) {
		printf( __( '<span class="%1$s">Last Updated:</span> %2$s <span class="meta-sep">by</span> %3$s', 'organic-nonprofit' ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_modified_time() ),
				get_the_modified_date()
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'organic-nonprofit' ), get_the_author() ),
				get_the_author()
			)
		);
	} else {
		printf( __( '<span class="%1$s">Posted:</span> %2$s <span class="meta-sep">by</span> %3$s', 'organic-nonprofit' ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				get_the_date()
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'organic-nonprofit' ), get_the_author() ),
				get_the_author()
			)
		);
	}
}

/*
-------------------------------------------------------------------------------------------------------
	Pagination Function
-------------------------------------------------------------------------------------------------------
*/

function nonprofit_get_pagination_links() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'prev_text' => esc_html__( '&laquo;', 'organic-nonprofit' ),
		'next_text' => esc_html__( '&raquo;', 'organic-nonprofit' ),
		'total' => $wp_query->max_num_pages,
	) );
}

/*
-------------------------------------------------------------------------------------------------------
	Custom Page Links
-------------------------------------------------------------------------------------------------------
*/

function nonprofit_wp_link_pages_args_prevnext_add( $args ) {
	global $page, $numpages, $more, $pagenow;

	if ( ! $args['next_or_number'] == 'next_and_number' ) {
		return $args; }

	$args['next_or_number'] = 'number'; // Keep numbering for the main part.
	if ( ! $more ) {
		return $args; }

	if ( $page -1 ) { // There is a previous page.
		$args['before'] .= _wp_link_page( $page -1 )
			. $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>'; }

	if ( $page < $numpages ) { // There is a next page.
		$args['after'] = _wp_link_page( $page + 1 )
			. $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
			. $args['after']; }

	return $args;
}

add_filter( 'wp_link_pages_args', 'nonprofit_wp_link_pages_args_prevnext_add' );

/*
-------------------------------------------------------------------------------------------------------
	Body Class
-------------------------------------------------------------------------------------------------------
*/

function nonprofit_body_class( $classes ) {

	$header_image = get_header_image();

	if ( is_singular() ) {
		$classes[] = 'nonprofit-singular'; }

	if ( has_post_thumbnail() ) {
		$classes[] = 'has-featured-img'; }

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'nonprofit-right-sidebar'; }

	if ( is_active_sidebar( 'sidebar-left' ) ) {
		$classes[] = 'nonprofit-left-sidebar'; }

	if ( is_page_template( 'template-home.php' ) && class_exists( 'Jetpack' ) && nonprofit_has_featured_posts( 1 )
	|| is_page_template( 'template-home.php' ) && '0' != get_theme_mod( 'nonprofit_slideshow_category' ) ) {
		$classes[] = 'nonprofit-slider-active'; }

	if ( ! empty( $header_image ) ) {
		$classes[] = 'nonprofit-header-active'; }

	if ( empty( $header_image ) ) {
		$classes[] = 'nonprofit-header-inactive'; }

	if ( 'blank' != get_theme_mod( 'header_textcolor' ) ) {
		$classes[] = 'nonprofit-title-active'; }

	if ( 'blank' == get_theme_mod( 'header_textcolor' ) ) {
		$classes[] = 'nonprofit-title-inactive'; }

	if ( get_theme_mod( 'nonprofit_logo', get_template_directory_uri() . '/images/logo.png' ) ) {
		$classes[] = 'nonprofit-logo-active'; }

	if ( get_theme_mod( 'nonprofit_description_align', 'left' ) == 'left' ) {
		$classes[] = 'nonprofit-description-left'; }

	if ( get_theme_mod( 'nonprofit_description_align' ) == 'center' ) {
		$classes[] = 'nonprofit-description-center'; }

	if ( get_theme_mod( 'nonprofit_description_align' ) == 'right' ) {
		$classes[] = 'nonprofit-description-right'; }

	if ( get_theme_mod( 'nonprofit_logo_align', 'left' ) == 'left' ) {
		$classes[] = 'nonprofit-logo-left'; }

	if ( get_theme_mod( 'nonprofit_logo_align' ) == 'center' ) {
		$classes[] = 'nonprofit-logo-center'; }

	if ( get_theme_mod( 'nonprofit_logo_align' ) == 'right' ) {
		$classes[] = 'nonprofit-logo-right'; }

	if ( get_theme_mod( 'nonprofit_contact_email', 'info@mynonprofit.com' ) || get_theme_mod( 'nonprofit_contact_phone', '808.123.4567' ) || get_theme_mod( 'nonprofit_contact_address', '231 Front Street, Lahaina, HI 96761' ) ) {
		$classes[] = 'nonprofit-info-active'; }

	if ( get_theme_mod( 'background_image' ) ) {
		// This class will render when a background image is set
		// regardless of whether the user has set a color as well.
		$classes[] = 'nonprofit-background-image';
	} else if ( ! in_array( get_background_color(), array( '', get_theme_support( 'custom-background', 'default-color' ) ) ) ) {
		// This class will render when a background color is set
		// but no image is set. In the case the content text will
		// Adjust relative to the background color.
		$classes[] = 'nonprofit-relative-text';
	}

	return $classes;
}
add_action( 'body_class', 'nonprofit_body_class' );

/*
-------------------------------------------------------------------------------------------------------
	Post Class
-------------------------------------------------------------------------------------------------------
*/

function nonprofit_post_classes( $classes, $class, $post_id ) {

	if ( 0 == get_comments_number( $post_id ) ) {
		$classes[] = 'no-comments';
	}

	return $classes;
}
add_filter( 'post_class', 'nonprofit_post_classes', 10, 3 );

/*
-----------------------------------------------------------------------------------------------
	Retrieve email value from Customizer and add mailto protocol
-----------------------------------------------------------------------------------------------
*/

function nonprofit_get_email_link() {
	$email = get_theme_mod( 'nonprofit_link_email' );

	if ( ! $email ) {
		return false; }

	return 'mailto:' . sanitize_email( $email );
}

/*
-------------------------------------------------------------------------------------------------------
	Posted Author and Date Function
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'nonprofit_posted_on' ) ) {
	function nonprofit_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'organic-nonprofit' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'organic-nonprofit' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';
	}
}

/*
-------------------------------------------------------------------------------------------------------
	First Featured Video
-------------------------------------------------------------------------------------------------------
*/

function nonprofit_first_embed_media() {
	global $post, $posts;
	$first_vid = '';
	$content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
	$embeds = get_media_embedded_in_content( $content );

	if ( ! empty( $embeds ) ) {
		foreach ( $embeds as $embed ) {
			if ( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) ) {
				return $embed;
			}
		}
	} else {
		return false;
	}
}

/*
-------------------------------------------------------------------------------------------------------
	Remove First Gallery
-------------------------------------------------------------------------------------------------------
*/

function nonprofit_remove_gallery( $content ) {

	if ( is_page_template( 'template-slideshow.php' ) ) {
		$content = preg_replace( '/\[gallery(.*?)ids=[^\]]+\]/', '', $content, 1 );
	}
	return $content;
}
add_filter( 'the_content', 'nonprofit_remove_gallery' );

/*
-------------------------------------------------------------------------------------------------------
	Includes
-------------------------------------------------------------------------------------------------------
*/

require_once( get_template_directory() . '/includes/customizer.php' );
require_once( get_template_directory() . '/includes/typefaces.php' );
require_once( get_template_directory() . '/includes/woocommerce-setup.php' );
require_once( get_template_directory() . '/includes/plugin-activation.php' );
require_once( get_template_directory() . '/includes/plugin-activation-class.php' );

/*
-------------------------------------------------------------------------------------------------------
	Load Give Files
-------------------------------------------------------------------------------------------------------
*/

if ( class_exists( 'Give' ) ) {
	require_once( get_template_directory() . '/give/give-setup.php' );
}

/*
-------------------------------------------------------------------------------------------------------
	Load Jetpack File
-------------------------------------------------------------------------------------------------------
*/

if ( class_exists( 'Jetpack' ) ) {
	require get_template_directory() . '/includes/jetpack.php';
}
