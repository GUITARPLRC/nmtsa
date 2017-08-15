<?php

/*
-------------------------------------------------------------------------------------------------------
	Theme License and Updater
-----------------------------------------------------------------------------------------------------
*/

// Includes the files needed for the theme updater.
if ( ! class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes.
$updater = new EDD_Theme_Updater_Admin(
	// Config settings.
	$config = array(
		'remote_api_url' => 'https://organicthemes.com', // Site where EDD is hosted.
		'item_name' => 'NonProfit Theme', // Name of theme.
		'theme_slug' => 'organic-nonprofit', // Theme slug.
		'version' => '5.5.2', // The current version of this theme.
		'author' => 'Organic Themes', // The author of this theme.
		'download_id' => '2531', // Optional, used for generating a license renewal link.
		'renew_url' => '', // Optional, allows for a custom license renewal link.
	),
	// Strings.
	$strings = array(
		'theme-license' => __( 'Theme License', 'organic-nonprofit' ),
		'enter-key' => __( 'Enter your theme license key.', 'organic-nonprofit' ),
		'license-key' => __( 'License Key', 'organic-nonprofit' ),
		'license-action' => __( 'License Action', 'organic-nonprofit' ),
		'deactivate-license' => __( 'Deactivate License', 'organic-nonprofit' ),
		'activate-license' => __( 'Activate License', 'organic-nonprofit' ),
		'status-unknown' => __( 'License status is unknown.', 'organic-nonprofit' ),
		'renew' => __( 'Renew?', 'organic-nonprofit' ),
		'unlimited' => __( 'unlimited', 'organic-nonprofit' ),
		'license-key-is-active' => __( 'License key is active.', 'organic-nonprofit' ),
		'expires%s' => __( 'Expires %s.', 'organic-nonprofit' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'organic-nonprofit' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'organic-nonprofit' ),
		'license-key-expired' => __( 'License key has expired.', 'organic-nonprofit' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'organic-nonprofit' ),
		'license-is-inactive' => __( 'License is inactive.', 'organic-nonprofit' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'organic-nonprofit' ),
		'site-is-inactive' => __( 'Site is inactive.', 'organic-nonprofit' ),
		'license-status-unknown' => __( 'License status is unknown.', 'organic-nonprofit' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'organic-nonprofit' ),
		'update-available' => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'organic-nonprofit' ),
	)
);
