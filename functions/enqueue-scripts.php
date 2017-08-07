<?php
/**
 * Enqueue google fonts.
 */
function add_google_fonts() {
wp_enqueue_style( 'open-sans-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic', false );
wp_enqueue_style( 'raleway-google-fonts', 'https://fonts.googleapis.com/css?family=Raleway:400,700', false );

}

add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

/**
 * Enqueue scripts and styles.
 */

function lorainccc_subsite_foundation_scripts() {
 
  	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );
 
	wp_enqueue_style( 'foundation-app',  get_template_directory_uri() . '/foundation/css/app.css' );
	wp_enqueue_style( 'foundation-normalize', get_template_directory_uri() . '/foundation/css/normalize.css' );
	wp_enqueue_style( 'foundation',  get_template_directory_uri() . '/foundation/css/foundation.css' );

	wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/foundation/js/vendor/foundation.js', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'foundation-whatinput', get_template_directory_uri() . '/foundation/js/vendor/what-input.js', array( 'jquery' ), '1', true);

	wp_enqueue_script( 'foundation-init-js', get_template_directory_uri() . '/foundation.js', array( 'jquery' ), '1', true );

	wp_enqueue_script( 'lorainccc_subsite-function-script', get_stylesheet_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );

	wp_localize_script( 'lorainccc_subsite-function-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	));

}
add_action( 'wp_enqueue_scripts', 'lorainccc_subsite_foundation_scripts' );

function lorainccc_subsite_scripts() {
	wp_enqueue_style( 'lorainccc_subsite-style', get_stylesheet_directory_uri() . '/css/style.css');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lorainccc_subsite_scripts', 99 );