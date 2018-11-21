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
	//Public method or class
	//can be access everywhere.
	
	//Protected method or class
	//can be access only inside the class itself or a class that extends the original class.
	// $this->print_stuff(); // calls the protected method. 
	// protected function print_stuff() {}

	//Private method or class
	//can be access only by the class itself and not by an extended class.
	// private function print_stuff() {}
	
	//Static method
	//can be applied to a public, protected, or private
	//allows the method without initializing the class.
	// public statuc function my_static_method() {}
	// myclass::my_static_method(); calls the method without initializing the class.
	
	//All methods inside the class by default are public.
	
	function __construct() {
		// Default method called when the function Initializes.
		add_action( 'init', array( $this, 'custom_post_type' ) );	
	}

	function register() {
		add_action( 'admin_enqueue_scripts', array ( $this, 'enqueue' ) );
		// admin_enqueue_scripts adds script to the admin (Back End).
		// wp_enqueue_scripts adds the script to the Front End.
	}

	function activate() {
		
		//Calling a method inside a method.  Just in case that the plugin is not activated by the function __contruct.
		$this->custom_post_type();  

		/* This function is useful when used with custom post types as it allows for automatic flushing of the WordPress rewrite rules (usually needs to be done manually for new custom post types). However, this is an expensive operation so it should only be used when absolutely necessary. */
		flush_rewrite_rules();
	}

	function deactivate() {

		flush_rewrite_rules();

	}

	function custom_post_type() {
		
		register_post_type( 'book', ['public'=> true,'label'=>'Books'] );
	
	}

	function enqueue() {
		
		// enqueue all our scripts
		wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
		wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ) );

	}

} // end class DavidAragoFirstPlugin

if ( class_exists( 'DavidAragoFirstPlugin' ) ) {
	$davidAragoFirstPlugin = new DavidAragoFirstPlugin(); //New instance of the class.
	$davidAragoFirstPlugin->register(); //Inside the new instance of the class, call the method.
}

//Delegate activation of the plugin to a file
// 	require_once plugin_dir_path( __FILE__ ) . 'inc/da-first-plugin-activate.php';
//Activation hook if the activate method delegated to another file.
// 	register_activation_hook( __FILE__, array( DavidAragoFirstPluginActivate, 'activate' ) );

//Delegate activation of the plugin to a file
// 	require_once plugin_dir_path( __FILE__ ) . 'inc/da-first-plugin-deactivate.php';
//Deactivation hook if the deactivate method delegated to another file.
// 	register_activation_hook( __FILE__, array( DavidAragoFirstPluginDeactivate, 'deactivate' ) );

//activation hook if the activate method is on the class itself.
register_activation_hook( __FILE__, array( $davidAragoFirstPlugin, 'activate' ) );

//deactivation hook if the activate method is on the class itself.
register_deactivation_hook( __FILE__, array( $davidAragoFirstPlugin, 'deactivate' ) );


