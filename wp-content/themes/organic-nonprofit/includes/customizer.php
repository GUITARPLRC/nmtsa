<?php
/**
* Theme customizer with real-time update
*
* Very helpful: http://ottopress.com/2012/theme-customizer-part-deux-getting-rid-of-options-pages/
*
* @package NonProfit
* @since NonProfit 4.0
*/
function nonprofit_theme_customizer( $wp_customize ) {

	// Category Dropdown Control
	class NonProfit_Category_Dropdown_Control extends WP_Customize_Control {
	public $type = 'dropdown-categories';

	public function render_content() {
		$dropdown = wp_dropdown_categories(
				array(
					'name'              => '_customize-dropdown-categories-' . $this->id,
					'echo'              => 0,
					'show_option_none'  => esc_html__( '&mdash; Select &mdash;', 'organic-nonprofit' ),
					'option_none_value' => '0',
					'selected'          => $this->value(),
				)
			);

			// Hackily add in the data link parameter.
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

			printf( '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);
		}
	}

	// Custom Give Forms Dropdown Control
	class NonProfit_Form_Dropdown_Control extends WP_Customize_Control {

		public $type = 'posts';
		private $posts = false;
		public function __construct($manager, $id, $args = array(), $options = array()) {
		    $postargs = wp_parse_args($options, array(
		    	'numberposts' => '999',
		    	'post_type' => 'give_forms',
		    	));
		    $this->posts = get_posts($postargs);
		    parent::__construct( $manager, $id, $args );
		}

		/**
		* Render the content on the theme customizer page
		*/
		public function render_content() {
		    if (!empty($this->posts)) {
				?>
				    <label>
				        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				        <select data-customize-setting-link="<?php echo $this->id; ?>" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
				        	<option value="0"><?php echo esc_html__( '&mdash; Select &mdash;', 'organic-nonprofit' ) ?></option>
					        <?php foreach ( $this->posts as $post ) {
					            printf('<option value="%s" %s>%s</option>', $post->ID, selected($this->value(), $post->ID, false), $post->post_title);
					        } ?>
				        </select>
				    </label>
				<?php
		    }
		}
	}

	// Numerical Control
	class NonProfit_Customizer_Number_Control extends WP_Customize_Control {

		public $type = 'number';

		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
			</label>
			<?php
		}

	}

	// Sanitize Categories
	function nonprofit_sanitize_categories( $input ) {

		$categories = get_terms( 'category', array('fields' => 'ids', 'get' => 'all') );

		if ( in_array( $input, $categories ) ) {
		    return $input;
		} else {
			return '';
		}
	}

	function nonprofit_sanitize_pages( $input ) {
		$pages = get_all_page_ids();

	    if ( in_array( $input, $pages ) ) {
	        return $input;
	    } else {
	    	return '';
	    }
	}

	function nonprofit_sanitize_transition_interval( $input ) {
	    $valid = array(
	        '2000' 		=> esc_html__( '2 Seconds', 'organic-nonprofit' ),
	        '4000' 		=> esc_html__( '4 Seconds', 'organic-nonprofit' ),
	        '6000' 		=> esc_html__( '6 Seconds', 'organic-nonprofit' ),
	        '8000' 		=> esc_html__( '8 Seconds', 'organic-nonprofit' ),
	        '10000' 	=> esc_html__( '10 Seconds', 'organic-nonprofit' ),
	        '12000' 	=> esc_html__( '12 Seconds', 'organic-nonprofit' ),
	        '20000' 	=> esc_html__( '20 Seconds', 'organic-nonprofit' ),
	        '30000' 	=> esc_html__( '30 Seconds', 'organic-nonprofit' ),
	        '60000' 	=> esc_html__( '1 Minute', 'organic-nonprofit' ),
	        '999999999'	=> esc_html__( 'Hold Frame', 'organic-nonprofit' ),
	    );

	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

	function nonprofit_sanitize_transition_style( $input ) {
	    $valid = array(
	        'fade' 		=> esc_html__( 'Fade', 'organic-nonprofit' ),
	        'slide' 	=> esc_html__( 'Slide', 'organic-nonprofit' ),
	    );

	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

	function nonprofit_sanitize_columns( $input ) {
	    $valid = array(
	        'one' 		=> esc_html__( 'One Column', 'organic-nonprofit' ),
	        'two' 		=> esc_html__( 'Two Columns', 'organic-nonprofit' ),
	        'three' 	=> esc_html__( 'Three Columns', 'organic-nonprofit' ),
	        'four' 		=> esc_html__( 'Four Columns', 'organic-nonprofit' ),
	    );

	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

	function nonprofit_sanitize_slide_info( $input ) {
	    $valid = array(
	        'right' 		=> esc_html__( 'Right', 'organic-nonprofit' ),
	        'bottom' 		=> esc_html__( 'Bottom', 'organic-nonprofit' ),
	    );

	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

	function nonprofit_sanitize_align( $input ) {
	    $valid = array(
	        'left' 		=> esc_html__( 'Left Align', 'organic-nonprofit' ),
	        'center' 		=> esc_html__( 'Center Align', 'organic-nonprofit' ),
	        'right' 	=> esc_html__( 'Right Align', 'organic-nonprofit' ),
	    );

	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

	function nonprofit_sanitize_title_color( $input ) {
	    $valid = array(
	        'black' 	=> esc_html__( 'Black', 'organic-nonprofit' ),
	        'white' 	=> esc_html__( 'White', 'organic-nonprofit' ),
	    );

	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

	function nonprofit_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	function nonprofit_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}

	function nonprofit_sanitize_color( $input ){
		if ( preg_match( '/^#[a-f0-9]{6}$/i', $input ) ) {
			return $input;
		}
		else {
			return '';
		}
	}

	// Set site name and description text to be previewed in real-time
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';

	// Set site title color to be previewed in real-time
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	//-------------------------------------------------------------------------------------------------------------------//
	// Site Title Section
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_section( 'title_tagline' , array(
		'title'       => esc_html__( 'Site Title, Tagline & Logo', 'organic-nonprofit' ),
		'priority'    => 1,
	) );

		// Logo uploader
		$wp_customize->add_setting( 'nonprofit_logo', array(
			'default' 			=> get_template_directory_uri() . '/images/logo.png',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'nonprofit_logo', array(
			'label' 	=> esc_html__( 'Logo', 'organic-nonprofit' ),
			'section' 	=> 'title_tagline',
			'settings'	=> 'nonprofit_logo',
			'priority'	=> 40,
		) ) );

		// Logo Align
		$wp_customize->add_setting( 'nonprofit_logo_align', array(
		    'default' 			=> 'left',
		    'sanitize_callback' => 'nonprofit_sanitize_align',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_logo_align', array(
		    'type'		=> 'radio',
		    'label' 	=> esc_html__( 'Logo Alignment', 'organic-nonprofit' ),
		    'section' 	=> 'title_tagline',
		    'choices' 	=> array(
		        'left' 		=> esc_html__( 'Left Align', 'organic-nonprofit' ),
		        'center' 	=> esc_html__( 'Center Align', 'organic-nonprofit' ),
		        'right' 	=> esc_html__( 'Right Align', 'organic-nonprofit' ),
		    ),
		    'priority' => 45,
		) ) );

		// Site Title Align
		$wp_customize->add_setting( 'nonprofit_description_align', array(
		    'default' 			=> 'left',
		    'sanitize_callback' => 'nonprofit_sanitize_align',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_description_align', array(
		    'type' 		=> 'radio',
		    'label' 	=> esc_html__( 'Site Description Alignment', 'organic-nonprofit' ),
		    'section' 	=> 'title_tagline',
		    'choices' 	=> array(
		        'left' 		=> esc_html__( 'Left Align', 'organic-nonprofit' ),
		        'center' 	=> esc_html__( 'Center Align', 'organic-nonprofit' ),
		        'right' 	=> esc_html__( 'Right Align', 'organic-nonprofit' ),
		    ),
		    'priority' => 50,
		) ) );

	//-------------------------------------------------------------------------------------------------------------------//
	// Colors Section
	//-------------------------------------------------------------------------------------------------------------------//

		// Header Color
		$wp_customize->add_setting( 'nonprofit_colors_header', array(
			'default' => '#bfd73c',
			'sanitize_callback' => 'nonprofit_sanitize_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nonprofit_colors_header', array(
			'label'		=> esc_html__( 'Header Background Color', 'organic-nonprofit' ),
			'section'	=> 'colors',
			'settings'	=> 'nonprofit_colors_header',
			'priority' => 40,
		) ) );

		// Link Color
		$wp_customize->add_setting( 'nonprofit_colors_links', array(
			'default' => '#99cc00',
			'sanitize_callback' => 'nonprofit_sanitize_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nonprofit_colors_links', array(
			'label'		=> esc_html__( 'Link Color', 'organic-nonprofit' ),
			'section'	=> 'colors',
			'settings'	=> 'nonprofit_colors_links',
			'priority' => 50,
		) ) );

		// Link Hover Color
		$wp_customize->add_setting( 'nonprofit_colors_links_hover', array(
			'default' => '#669900',
			'sanitize_callback' => 'nonprofit_sanitize_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nonprofit_colors_links_hover', array(
			'label'		=> esc_html__( 'Link Hover Color', 'organic-nonprofit' ),
			'section'	=> 'colors',
			'settings'	=> 'nonprofit_colors_links_hover',
			'priority' => 60,
		) ) );

		// Heading Link Color
		$wp_customize->add_setting( 'nonprofit_colors_heading_links', array(
			'default' => '#333333',
			'sanitize_callback' => 'nonprofit_sanitize_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nonprofit_colors_heading_links', array(
			'label'		=> esc_html__( 'Heading Link Color', 'organic-nonprofit' ),
			'section'	=> 'colors',
			'settings'	=> 'nonprofit_colors_heading_links',
			'priority' => 70,
		) ) );

		// Heading Link Hover Color
		$wp_customize->add_setting( 'nonprofit_colors_heading_links_hover', array(
			'default' => '#99cc00',
			'sanitize_callback' => 'nonprofit_sanitize_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nonprofit_colors_heading_links_hover', array(
			'label'		=> esc_html__( 'Heading Link Hover Color', 'organic-nonprofit' ),
			'section'	=> 'colors',
			'settings'	=> 'nonprofit_colors_heading_links_hover',
			'priority' => 80,
		) ) );

		// Highlight Color
		$wp_customize->add_setting( 'nonprofit_colors_highlight', array(
			'default' => '#99cc00',
			'sanitize_callback' => 'nonprofit_sanitize_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nonprofit_colors_highlight', array(
			'label'		=> esc_html__( 'Highlight Color', 'organic-nonprofit' ),
			'section'	=> 'colors',
			'settings'	=> 'nonprofit_colors_highlight',
			'priority' => 90,
		) ) );

	//-------------------------------------------------------------------------------------------------------------------//
	// Theme Options Panel
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_panel( 'nonprofit_theme_options', array(
	    'priority' 			=> 1,
	    'capability' 		=> 'edit_theme_options',
	    'theme_supports'	=> '',
	    'title' 			=> esc_html__( 'Theme Options', 'organic-nonprofit' ),
	    'description' 		=> esc_html__( 'This panel allows you to customize specific areas of the NonProfit Theme.', 'organic-nonprofit' ),
	) );

	//-------------------------------------------------------------------------------------------------------------------//
	// Contact Section
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_section( 'nonprofit_contact_section' , array(
		'title'     => esc_html__( 'Contact Info Bar', 'organic-nonprofit' ),
		'priority'  => 100,
		'panel' 	=> 'nonprofit_theme_options',
	) );

		// Contact Address
		$wp_customize->add_setting( 'nonprofit_contact_address', array(
			'default' => '231 Front Street, Lahaina, HI 96761',
			'sanitize_callback' => 'nonprofit_sanitize_text',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_contact_address', array(
			'label'		=> esc_html__( 'Company Address', 'organic-nonprofit' ),
			'section'	=> 'nonprofit_contact_section',
			'settings'	=> 'nonprofit_contact_address',
			'type'		=> 'text',
			'priority' 	=> 20,
		) ) );

		// Contact Email
		$wp_customize->add_setting( 'nonprofit_contact_email', array(
			'default' => 'info@mynonprofit.com',
			'sanitize_callback' => 'sanitize_email',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_contact_email', array(
			'label'		=> esc_html__( 'Company Email Address', 'organic-nonprofit' ),
			'section'	=> 'nonprofit_contact_section',
			'settings'	=> 'nonprofit_contact_email',
			'type'		=> 'text',
			'priority' 	=> 40,
		) ) );

		// Contact Phone
		$wp_customize->add_setting( 'nonprofit_contact_phone', array(
			'default' => '808.123.4567',
			'sanitize_callback' => 'nonprofit_sanitize_text',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_contact_phone', array(
			'label'		=> esc_html__( 'Company Phone Number', 'organic-nonprofit' ),
			'section'	=> 'nonprofit_contact_section',
			'settings'	=> 'nonprofit_contact_phone',
			'type'		=> 'text',
			'priority' 	=> 60,
		) ) );

		// Header Search Field
		$wp_customize->add_setting( 'nonprofit_display_header_search', array(
			'default' => 1,
			'sanitize_callback' => 'nonprofit_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_display_header_search', array(
			'label'		=> esc_html__( 'Display Search Field?', 'organic-nonprofit' ),
			'section'	=> 'nonprofit_contact_section',
			'settings'	=> 'nonprofit_display_header_search',
			'type'		=> 'checkbox',
			'priority' => 80,
		) ) );

	//-------------------------------------------------------------------------------------------------------------------//
	// Slideshow Section
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_section( 'nonprofit_slider_section' , array(
		'title'       => esc_html__( 'Slideshow Settings', 'organic-nonprofit' ),
		'priority'    => 101,
		'panel' => 'nonprofit_theme_options',
	) );

		// Slider Transition Interval
		$wp_customize->add_setting( 'nonprofit_transition_interval', array(
	        'default' => '12000',
	        'sanitize_callback' => 'nonprofit_sanitize_transition_interval',
	    ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_transition_interval', array(
	        'type' => 'select',
	        'label' => esc_html__( 'Transition Interval', 'organic-nonprofit' ),
	        'section' => 'nonprofit_slider_section',
	        'choices' => array(
	            '2000' 		=> esc_html__( '2 Seconds', 'organic-nonprofit' ),
	            '4000' 		=> esc_html__( '4 Seconds', 'organic-nonprofit' ),
	            '6000' 		=> esc_html__( '6 Seconds', 'organic-nonprofit' ),
	            '8000' 		=> esc_html__( '8 Seconds', 'organic-nonprofit' ),
	            '10000' 	=> esc_html__( '10 Seconds', 'organic-nonprofit' ),
	            '12000' 	=> esc_html__( '12 Seconds', 'organic-nonprofit' ),
	            '20000' 	=> esc_html__( '20 Seconds', 'organic-nonprofit' ),
	            '30000' 	=> esc_html__( '30 Seconds', 'organic-nonprofit' ),
	            '60000' 	=> esc_html__( '1 Minute', 'organic-nonprofit' ),
	            '999999999'	=> esc_html__( 'Hold Frame', 'organic-nonprofit' ),
	        ),
	        'priority' => 10,
		) ) );

		// Slideshow Transition Style
		$wp_customize->add_setting( 'nonprofit_transition_style', array(
		    'default' => 'fade',
		    'sanitize_callback' => 'nonprofit_sanitize_transition_style',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_transition_style', array(
		    'type' => 'select',
		    'label' => esc_html__( 'Slideshow Transition Style', 'organic-nonprofit' ),
		    'section' => 'nonprofit_slider_section',
		    'choices' => array(
		        'fade' 	=> __( 'Fade', 'organic-nonprofit' ),
		        'slide' => __( 'Slide', 'organic-nonprofit' ),
		    ),
		    'priority' => 20,
		) ) );

	//-------------------------------------------------------------------------------------------------------------------//
	// Home Page Section
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_section( 'nonprofit_home_section' , array(
		'title'       => esc_html__( 'Home Page Template', 'organic-nonprofit' ),
		'priority'    => 102,
		'panel' => 'nonprofit_theme_options',
	) );

		// Slider Category Select
		$wp_customize->add_setting( 'nonprofit_slideshow_category' , array(
			'default' => '0',
			'sanitize_callback' => 'nonprofit_sanitize_categories',
		) );
		$wp_customize->add_control( new NonProfit_Category_Dropdown_Control( $wp_customize, 'nonprofit_slideshow_category', array(
			'label'		=> esc_html__( 'Featured Slideshow Category', 'organic-nonprofit' ),
			'section'	=> 'nonprofit_home_section',
			'settings'	=> 'nonprofit_slideshow_category',
			'type'		=> 'dropdown-categories',
			'priority' 	=> 10,
		) ) );

		// Slider Info Position
		$wp_customize->add_setting( 'slider_info_position', array(
			'default' => 'right',
			'sanitize_callback' => 'nonprofit_sanitize_slide_info',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slider_info_position', array(
			'label' => esc_html__( 'Featured Slide Info Position', 'organic-nonprofit' ),
			'section' => 'nonprofit_home_section',
			'settings' => 'slider_info_position',
			'type' => 'radio',
			'choices' => array(
		    	'right' 	=> esc_html__( 'Right', 'organic-nonprofit' ),
		    	'bottom' 	=> esc_html__( 'Bottom', 'organic-nonprofit' ),
			),
			'priority' => 20,
		) ) );

		if ( class_exists( 'Give' ) ) {

			// Give Form Selection
			$wp_customize->add_setting( 'nonprofit_home_give_form', array(
			    'default' => '0',
			    //'sanitize_callback' => 'nonprofit_sanitize_categories',
			) );
			$wp_customize->add_control( new NonProfit_Form_Dropdown_Control( $wp_customize, 'nonprofit_home_give_form', array(
			    'label' 	=> esc_html__( 'Give Donation Form', 'organic-nonprofit' ),
			    'section' 	=> 'nonprofit_home_section',
			    'settings'	=> 'nonprofit_home_give_form',
			    'type'		=> 'posts',
			    'priority' 	=> 30,
			) ) );

		} else {

			// Donation Tagline
			$wp_customize->add_setting( 'nonprofit_donation_tagline', array(
				'default' => 'Donations Are Welcome',
				'sanitize_callback' => 'nonprofit_sanitize_text',
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_donation_tagline', array(
				'label'		=> esc_html__( 'Donation Tagline', 'organic-nonprofit' ),
				'section'	=> 'nonprofit_home_section',
				'settings'	=> 'nonprofit_donation_tagline',
				'type'		=> 'text',
				'priority' => 30,
			) ) );

			// Donation Description
			$wp_customize->add_setting( 'nonprofit_donation_description', array(
				'default' => 'Enter a brief message about accepting donations for your cause. Edit the content in this section within the WordPress Customizer.',
				'sanitize_callback' => 'nonprofit_sanitize_text',
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_donation_description', array(
				'label'		=> esc_html__( 'Donation Description', 'organic-nonprofit' ),
				'section'	=> 'nonprofit_home_section',
				'settings'	=> 'nonprofit_donation_description',
				'type'		=> 'textarea',
				'priority' => 40,
			) ) );

			// Featured Link
			$wp_customize->add_setting( 'nonprofit_donation_link', array(
				'default' => '#',
				'sanitize_callback' => 'nonprofit_sanitize_text',
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_donation_link', array(
				'label'		=> esc_html__( 'Donation Link', 'organic-nonprofit' ),
				'section'	=> 'nonprofit_home_section',
				'settings'	=> 'nonprofit_donation_link',
				'type'		=> 'text',
				'priority' => 50,
			) ) );

			// Featured Link Text
			$wp_customize->add_setting( 'nonprofit_donation_link_text', array(
				'default' => 'Donate',
				'sanitize_callback' => 'nonprofit_sanitize_text',
			) );
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_donation_link_text', array(
				'label'		=> esc_html__( 'Donation Link Text', 'organic-nonprofit' ),
				'section'	=> 'nonprofit_home_section',
				'settings'	=> 'nonprofit_donation_link_text',
				'type'		=> 'text',
				'priority' => 60,
			) ) );

		}

		// Featured Page Left
		$wp_customize->add_setting( 'page_left', array(
			'default' => '2',
			'sanitize_callback' => 'nonprofit_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_left', array(
			'label'		=> esc_html__( 'Featured Page Left', 'organic-nonprofit' ),
			'section'	=> 'nonprofit_home_section',
			'settings'	=> 'page_left',
			'type'		=> 'dropdown-pages',
			'priority' => 80,
		) ) );

		// Featured Page Middle
		$wp_customize->add_setting( 'page_mid', array(
			'default' => '2',
			'sanitize_callback' => 'nonprofit_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_mid', array(
			'label'		=> esc_html__( 'Featured Page Middle', 'organic-nonprofit' ),
			'section'	=> 'nonprofit_home_section',
			'settings'	=> 'page_mid',
			'type'		=> 'dropdown-pages',
			'priority' => 100,
		) ) );

		// Featured Page Right
		$wp_customize->add_setting( 'page_right', array(
			'default' => '2',
			'sanitize_callback' => 'nonprofit_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_right', array(
			'label'		=> esc_html__( 'Featured Page Right', 'organic-nonprofit' ),
			'section'	=> 'nonprofit_home_section',
			'settings'	=> 'page_right',
			'type'		=> 'dropdown-pages',
			'priority' => 120,
		) ) );

		// Featured Page Bottom
		$wp_customize->add_setting( 'nonprofit_page_bottom', array(
			'default' => '2',
			'sanitize_callback' => 'nonprofit_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_page_bottom', array(
			'label'		=> esc_html__( 'Featured Page Bottom', 'organic-nonprofit' ),
			'section'	=> 'nonprofit_home_section',
			'settings'	=> 'nonprofit_page_bottom',
			'type'		=> 'dropdown-pages',
			'priority' => 140,
		) ) );

		// Tabs Category Select
		$wp_customize->add_setting( 'nonprofit_tabs_category' , array(
			'default' => '0',
			'sanitize_callback' => 'nonprofit_sanitize_categories',
		) );
		$wp_customize->add_control( new NonProfit_Category_Dropdown_Control( $wp_customize, 'nonprofit_tabs_category', array(
			'label'		=> esc_html__( 'Featured Tabs Category', 'organic-nonprofit' ),
			'section'	=> 'nonprofit_home_section',
			'settings'	=> 'nonprofit_tabs_category',
			'type'		=> 'dropdown-categories',
			'priority' 	=> 160,
		) ) );

	//-------------------------------------------------------------------------------------------------------------------//
	// Page Templates
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_section( 'nonprofit_templates_section' , array(
		'title'       => esc_html__( 'Additional Page Templates', 'organic-nonprofit' ),
		'priority'    => 104,
		'panel' => 'nonprofit_theme_options',
	) );

		// Blog Category
		$wp_customize->add_setting( 'nonprofit_blog_category', array(
	        'default' => '0',
	        'sanitize_callback' => 'nonprofit_sanitize_categories',
	    ) );
		$wp_customize->add_control( new NonProfit_Category_Dropdown_Control( $wp_customize, 'nonprofit_blog_category', array(
	        'type'	=> 'dropdown-categories',
	        'label' => esc_html__( 'Blog Template Category', 'organic-nonprofit' ),
	        'section' => 'nonprofit_templates_section',
	        'settings'	=> 'nonprofit_blog_category',
	        'priority' => 10,
		) ) );

		// Number of Blog Posts to Display
		$wp_customize->add_setting( 'nonprofit_blog_posts', array(
			'default' => '5',
			'sanitize_callback' => 'nonprofit_sanitize_text',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nonprofit_blog_posts', array(
			'label'		=> esc_html__( 'Blog Posts to Display', 'organic-nonprofit' ),
			'section'	=> 'nonprofit_templates_section',
			'settings'	=> 'nonprofit_blog_posts',
			'type'		=> 'text',
			'priority' => 20,
		) ) );

		// Project Columns Option
		$wp_customize->add_setting( 'project_columns', array(
			'default' => 'two',
			'sanitize_callback' => 'nonprofit_sanitize_columns',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'project_columns', array(
			'label' => esc_html__( 'Portfolio Project Columns', 'organic-nonprofit' ),
			'section' => 'nonprofit_templates_section',
			'settings' => 'project_columns',
			'type' => 'radio',
			'choices' => array(
		    	'one' 		=> esc_html__( 'One Column', 'organic-nonprofit' ),
		    	'two' 		=> esc_html__( 'Two Columns', 'organic-nonprofit' ),
		    	'three' 	=> esc_html__( 'Three Columns', 'organic-nonprofit' ),
		    	'four' 		=> esc_html__( 'Four Columns', 'organic-nonprofit' ),
			),
			'priority' => 30,
		) ) );

	//-------------------------------------------------------------------------------------------------------------------//
	// Page Templates
	//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_section( 'nonprofit_footer_section' , array(
		'title'       => esc_html__( 'Footer', 'organic-nonprofit' ),
		'priority'    => 105,
		'panel' => 'nonprofit_theme_options',
	) );

		// Footer Text
		$wp_customize->add_setting( 'footer_text', array(
			'sanitize_callback' => 'nonprofit_sanitize_text',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_text', array(
			'label'		=> esc_html__( 'Footer Text', 'organic-nonprofit' ),
			'section'	=> 'nonprofit_footer_section',
			'settings'	=> 'footer_text',
			'type'		=> 'text',
			'priority' => 10,
		) ) );

}
add_action('customize_register', 'nonprofit_theme_customizer');

/**
* Binds JavaScript handlers to make Customizer preview reload changes
* asynchronously.
*/
function nonprofit_customize_preview_js() {
	wp_enqueue_script( 'nonprofit-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ) );
}
add_action( 'customize_preview_init', 'nonprofit_customize_preview_js' );
