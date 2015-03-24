<?php

/*
 * Plugin Name: JP Sharing
 * Plugin URI: http://wordpress.org/plugins/jetpack-sharing/
 * Description: Share content with Facebook, Twitter, and many more.
 * Author: JP Bot
 * Version: 3.4.1
 * Text Domain: jetpack
 * Domain Path: /languages/
 * License: GPL2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Module Name: Sharing
 * Module Description: Allow visitors to share your content on Facebook, Twitter, and more with a click.
 * Jumpstart Description: Twitter, Facebook and Google+ buttons at the bottom of each post, making it easy for visitors to share your content.
 * Sort Order: 7
 * Recommendation Order: 6
 * First Introduced: 1.1
 * Major Changes In: 1.2
 * Requires Connection: No
 * Auto Activate: Yes
 * Module Tags: Social, Recommended
 * Feature: Recommended, Jumpstart
 */

define( 'JETPACK__VERSION', '3.4.1' );

if ( !function_exists( 'sharing_init' ) )
	include dirname( __FILE__ ).'/sharedaddy/sharedaddy.php';

add_action( 'init', 'jetpack_sharing_register_genericons', 1 );
function jetpack_sharing_register_genericons() {
	if ( ! wp_style_is( 'genericons', 'registered' ) ) {
		wp_register_style( 'genericons', plugins_url( 'genericons/genericons/genericons.css', __FILE__ ), false, '3.1' );
	}
}

/*
add_action( 'jetpack_modules_loaded', 'sharedaddy_loaded' );

function sharedaddy_loaded() {
	Jetpack::enable_module_configurable( __FILE__ );
	Jetpack::module_configuration_load( __FILE__, 'sharedaddy_configuration_load' );
}

function sharedaddy_configuration_load() {
	wp_safe_redirect( menu_page_url( 'sharing', false ) . "#sharing-buttons" );
	exit;
} 
*/

function jetpack_sharing_load_textdomain() {
	load_plugin_textdomain( 'jetpack', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'jetpack_sharing_load_textdomain' );

function jetpack_sharing_settings_link($actions) {
	return array_merge(
		array( 'settings' => sprintf( '<a href="%s">%s</a>', 'options-general.php?page=sharing', __( 'Settings', 'jetpack' ) ) ),
		$actions
	);
	return $actions;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'jetpack_sharing_settings_link' );