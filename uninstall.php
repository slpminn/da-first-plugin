<?php 
/**
 * Trigger this file on Plugin unistall. 
 * @package da-first-plugin
 */

//Check to make sure that the uninstall is trully executed by WP.  WP_UNISTALL_PLUGIN is only defined by WP.
if ( ! defined ( 'WP_UNINSTALL_PLUGIN' ) ) {
	die();
}

//Both options accomplish the same thing.

//Clear Database stored data - Build-in WP. Option1
$books= get_posts( array('post_type' => 'book', 'numberposts' => -1) );
foreach( $books as $book ) {
	wp_delete_post( $book->ID, true );
}

//Clear Database stored data - Custom SQL - Option2
//Access the database via SQL
global $wpdb;
//Always use double quotes.
//Delete the posts 
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'book'" );
//Deleting the post meta data from the previous deleted posts.
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT $id FROM wp_posts)" );
//Deleting the custom taxonomy.
$wpdb->query( "DELETE FROM wp_term_relationship WHERE object_id NOT IN (SELECT $id FROM wp_posts)" );


