<?php
/**
* Give WP Setup Functions
* See: https://givewp.com/
*
* @package NonProfit
* @since NonProfit 1.0
*/

function nonprofit_give_register_styles() {
	wp_enqueue_style( 'nonprofit-style-give', get_template_directory_uri() . '/give/style-give.css', array( 'give-styles' ), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'nonprofit_give_register_styles');

// Give WP content wrappers
function nonprofit_prepare_give_wrappers(){
    remove_action( 'give_before_main_content', 'give_output_content_wrapper', 10 );
    remove_action( 'give_after_main_content', 'give_output_content_wrapper_end', 10);
}
add_action( 'wp_head', 'nonprofit_prepare_give_wrappers' );

function nonprofit_open_give_content_wrappers() {
	?>  
	<div class="row">
		<div class="content">
			<div class="eleven columns">
				<div class="postarea clearfix">
    <?php
}
function nonprofit_close_give_content_wrappers() {
	?>
				</div>
	    	</div>
	 
	        <div class="five columns">
	        	<div class="sidebar">
	        		<?php dynamic_sidebar('give-forms-sidebar'); ?>
	        	</div>
	        </div>
        
        </div>
 	</div>
    <?php
}
add_action( 'give_before_main_content', 'nonprofit_open_give_content_wrappers', 10 );
add_action( 'give_after_main_content', 'nonprofit_close_give_content_wrappers', 10 );