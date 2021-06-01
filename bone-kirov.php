<?php
/*
Plugin Name: Import Countries
Description: Import
Author: Bone Kirov
Version: 1.0.0
*/


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'BONE_KIROV_VERSION', '1.0.0' );




	include( plugin_dir_path( __FILE__ ) . '/includes/register-post-type.php');
	include( plugin_dir_path( __FILE__ ) . '/includes/import-countries-list.php');
	include( plugin_dir_path( __FILE__ ) . '/includes/favourite-api.php');
	include( plugin_dir_path( __FILE__ ) . '/includes/template-page-files.php');

	function import__on__active() {
		add_action('admin_init','import_countries');


}
register_activation_hook( __FILE__, 'import__on__active' );

function plugin_directory_scripts() {
		wp_enqueue_script( 'jqueryPlugin', 'https://code.jquery.com/jquery-3.6.0.min.js');
		wp_enqueue_script( 'add-fav',  plugin_dir_url( __FILE__ ) . 'js/add-favourite.js' );
		wp_enqueue_style( 'boostrap-min',  plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css' );
		wp_enqueue_style( 'plugin-css',  plugin_dir_url( __FILE__ ) . 'css/plugin-css.css' );
		wp_localize_script('add-fav', 'boneData', array(
			'root_url' => get_site_url(),
			'nonce' => wp_create_nonce('wp_rest')
		));

}
add_action( 'wp_enqueue_scripts', 'plugin_directory_scripts' );


?>
