<?php 
/**
 * @package da-first-plugin
 */
/*
	Plugin Name: DA First Plugin
	Plugin URI: https:/davidarago.com/plugin/da-first-plugin
	Description:  This is my first plugin
	Version: 1.0.0
	Author: David Arago
	Author URI: https://davidarago.com
	License: GPLV2
	Text Domain: da-first-plugin-domain
 */
define('WP_DEBUG', true);

defined ( 'ABSPATH' ) or die();  //Makes sure that the plugin is inizialized by WP.

class DavidAragoFirstPlugin 
{

	function __construct() {
		// Default method called when the function Initializes.
		add_action( 'init', array( $this, 'custom_post_type' ) );	
	}

	function activate() {
		
		//Calling a method inside a method.  Just in case that the plugin is not activated by the function __contruct.
		$this->custom_post_type();  

		/* This function is useful when used with custom post types as it allows for automatic flushing of the WordPress rewrite rules (usually needs to be done manually for new custom post types). However, this is an expensive operation so it should only be used when absolutely necessary. */
		flush_rewrite_rules();
	}

	function deactivate() {

	}

	function custom_post_type() {
		
		register_post_type( 'book', ['public'=> true,'label'=>'Books'] );
	
	}

} // end class DavidAragoFirstPlugin

if ( class_exists( 'DavidAragoFirstPlugin' ) )
	$davidAragoFirstPlugin = new DavidAragoFirstPlugin();

//activation hook
register_activation_hook( __FILE__, array( $davidAragoFirstPlugin, 'activate' ) );

//deactivation hook
register_deactivation_hook( __FILE__, array( $davidAragoFirstPlugin, 'deactivate' ) );


