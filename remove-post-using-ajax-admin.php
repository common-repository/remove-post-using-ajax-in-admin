<?php 
/*
Plugin Name: Remove Post Using Ajax in Admin
Plugin URI: https://profiles.wordpress.org/developer1996/
Description: This plugin is used for remove post using ajax in WordPress admin dashboard.
Version: 0.1
Author: Sanjay Parmar
Text Domain: sp-plugins
Domain Path: /languages
Author URL: https://profiles.wordpress.org/developer1996/
*/


// Prevent file access
if(!defined('ABSPATH')){
	exit();
}

// Load ajax file and define ajax url
add_action( 'admin_enqueue_scripts', 'rpuaa_enqueue_scripts' );

// Ajax call to move post in trash
add_action('wp_ajax_rpuaa_remove_post', 'rpuaa_remove_post');

if (!function_exists('rpuaa_enqueue_scripts')) { 

	function rpuaa_enqueue_scripts(){
	  wp_register_script( 
	    'rpuaaAjaxHandle', 
	    plugins_url('/assets/js/jquery.ajax.js', __FILE__), 
	    array(), 
	    false, 
	    true 
	  );
	  wp_enqueue_script( 'rpuaaAjaxHandle' );
	  wp_localize_script( 
	    'rpuaaAjaxHandle', 
	    'ajax_object', 
	    array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) 
	  );
	}

}

if (!function_exists('rpuaa_remove_post')) { 

	function rpuaa_remove_post(){
		check_ajax_referer( 'trash-post_' . $_POST['post_id'] );
		wp_trash_post( $_POST['post_id'] );
	 
		die();
	}

}


?>