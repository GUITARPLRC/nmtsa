<style type="text/css" media="screen">
	<?php
		$header_color = get_theme_mod('nonprofit_colors_header', '#bfd73c');
		$link_color = get_theme_mod('nonprofit_colors_links', '#99cc00');
		$heading_link_color = get_theme_mod('nonprofit_colors_heading_links', '#333333');
		$link_hover_color = get_theme_mod('nonprofit_colors_links_hover', '#669900');
		$heading_link_hover_color = get_theme_mod('nonprofit_colors_heading_links_hover', '#99cc00');
		$highlight_color = get_theme_mod('nonprofit_colors_highlight', '#99cc00');
	?>

	#wrapper #masthead .site-description {
		color: #<?php echo get_theme_mod('header_textcolor'); ?> ;
	}

	#wrapper #header {
		<?php
			if ($header_color) {
				echo 'background-color: ' .$header_color. ';';
			};
		?>
	}

	.container a, .container a:link, .container a:visited, a.link-email, a.link-email:link, a.link-email:visited,
	#wrapper .widget ul.menu li a, #wrapper .widget ul.menu li a:link, #wrapper .widget ul.menu li a:visited,
	#wrapper .widget ul.menu li ul.sub-menu li a, #wrapper .widget ul.menu li ul.sub-menu li a:link, #wrapper .widget ul.menu li ul.sub-menu li a:visited {
		<?php
			if ($link_color) {
				echo 'color: ' .$link_color. ';';
			};
		?>
	}
	
	.container a:hover, .container a:focus, .container a:active, a.link-email:hover, a.link-email:active, a.link-email:active,
	#wrapper .widget ul.menu li a:hover, #wrapper .widget ul.menu li a:focus, #wrapper .widget ul.menu li a:active,
	#wrapper .widget ul.menu li ul.sub-menu li a:hover, #wrapper .widget ul.menu li ul.sub-menu li a:focus, #wrapper .widget ul.menu li ul.sub-menu li a:active,
	#wrapper .widget ul.menu .current_page_item a, #wrapper .widget ul.menu .current-menu-item a {
		<?php
			if ($link_hover_color) {
				echo 'color: ' .$link_hover_color. ';';
			};
		?>
	}

	.container h1 a, .container h2 a, .container h3 a, .container h4 a, .container h5 a, .container h6 a,
	.container h1 a:link, .container h2 a:link, .container h3 a:link, .container h4 a:link, .container h5 a:link, .container h6 a:link,
	.container h1 a:visited, .container h2 a:visited, .container h3 a:visited, .container h4 a:visited, .container h5 a:visited, .container h6 a:visited {
		<?php
			if ($heading_link_color) {
				echo 'color: ' .$heading_link_color. ';';
			};
		?>
	}

	.container h1 a:hover, .container h2 a:hover, .container h3 a:hover, .container h4 a:hover, .container h5 a:hover, .container h6 a:hover,
	.container h1 a:focus, .container h2 a:focus, .container h3 a:focus, .container h4 a:focus, .container h5 a:focus, .container h6 a:focus,
	.container h1 a:active, .container h2 a:active, .container h3 a:active, .container h4 a:active, .container h5 a:active, .container h6 a:active {
		<?php
			if ($heading_link_hover_color) {
				echo 'color: ' .$heading_link_hover_color. ';';
			};
		?>
	}

	#submit:hover, #searchsubmit:hover, .reply a:hover, .gallery a:hover, a.button:hover, .more-link:hover, .social-icons li a:hover,
	#comments #respond input#submit:hover, .container .gform_wrapper input.button:hover, .flex-direction-nav li a:hover, .featured-give .give-btn {
		<?php
			if ($highlight_color) {
				echo 'background-color: ' .$highlight_color. ' !important;';
			};
		?>
	}
</style>
