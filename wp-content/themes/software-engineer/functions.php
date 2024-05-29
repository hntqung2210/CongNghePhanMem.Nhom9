<?php
// Add custom Theme Functions here
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'nguyen-style', get_stylesheet_directory_uri() . '/nguyen.css' );
    wp_enqueue_style( 'duy-style',  get_stylesheet_directory_uri() . '/duy.css');
	wp_enqueue_script('wn-script', get_stylesheet_directory_uri() . '/includes/js/script.js', array( 'jquery' ),'',true );

	
}

// //RETURN WP 4.0
add_filter( 'use_block_editor_for_post', '__return_false' );
