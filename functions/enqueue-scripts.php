<?php
/**
 * Enqueue google fonts.
 */
function add_google_fonts() {
//wp_enqueue_style( 'open-sans-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic', false );
//wp_enqueue_style( 'raleway-google-fonts', 'https://fonts.googleapis.com/css?family=Raleway:400,700', false );
wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:400,500,600,700', false );
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

	//Adds Google Analytics, Google Tag, Hotjar and Eloqua to header
	wp_enqueue_script( 'lc-eloqua-scripts', get_stylesheet_directory_uri() . '/js/lc-eloqua.js', array(), '20180828', false);
	wp_enqueue_script( 'lc-google-analytics-scripts', get_stylesheet_directory_uri() . '/js/lc-google-analytics.js', array(), '20180828', false);
	wp_enqueue_script( 'lc-google-tag-scripts', get_stylesheet_directory_uri() . '/js/lc-google-tag.js', array(), '20180828', false);
	wp_enqueue_script( 'lc-hotjar-scripts', get_stylesheet_directory_uri() . '/js/lc-hotjar.js', array(), '20180828', false);
	wp_enqueue_script( 'lc-siteimprove-scripts', get_stylesheet_directory_uri() . '/js/lc-siteimprove.js', array(), '20180828', false);
	
	wp_localize_script( 'lorainccc_subsite-function-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	));

}
add_action( 'wp_enqueue_scripts', 'lorainccc_subsite_foundation_scripts' );

function lorainccc_subsite_scripts() {
	wp_enqueue_style( 'lorainccc_subsite-style', get_stylesheet_directory_uri() . 'style.css');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lorainccc_subsite_scripts', 99 );

function sticky_shrinking_header() {
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/classie/1.0.1/classie.min.js" type="text/javascript"></script>
<script>
	function init() {
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 100,
            header = document.querySelector("header");
        if (distanceY > shrinkOn) {
            classie.add(header,"smaller");
        } else {
            if (classie.has(header,"smaller")) {
                classie.remove(header,"smaller");
            }
        }
    });
}
window.onload = init();
</script>
<?php
}
add_action( 'wp_footer', 'sticky_shrinking_header', 100);

function flip_cards_init() {
	if( is_front_page() ) :
?>
<script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>
<script>
	jQuery(".card").flip();
</script>
<?php
	endif;
}
add_action( 'wp_footer', 'flip_cards_init', 100 );


// Enqueue colors.js for custom ACF color picker pallete
function my_admin_enqueue_scripts() {

	wp_enqueue_script( 'my-admin-js', get_stylesheet_directory_uri() . '/js/colors.js', array(), '1.0.0', true );

}

add_action('admin_enqueue_scripts', 'my_admin_enqueue_scripts');