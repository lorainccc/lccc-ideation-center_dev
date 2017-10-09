<?php
/**
 * lorainccc_subsite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lorainccc_subsite
 */



if ( ! function_exists( 'lorainccc_subsite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lorainccc_subsite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on lorainccc_subsite, use a find and replace
	 * to change 'campana' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'campana', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lorainccc_subsite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'lorainccc_subsite_setup' );


// Register scripts and stylesheets
require get_stylesheet_directory() . '/functions/enqueue-scripts.php';

// Register custom menus and menu walkers
require get_stylesheet_directory() . '/functions/menu.php';

// Register sidebars/widget areas
require get_stylesheet_directory() . '/functions/sidebar.php';






/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lorainccc_subsite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lorainccc_subsite_content_width', 640 );
}
add_action( 'after_setup_theme', 'lorainccc_subsite_content_width', 0 );




/**
 * Implement the Custom Header feature.
 */
require get_stylesheet_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_stylesheet_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_stylesheet_directory() . '/inc/jetpack.php';

/* Menu Functions */


/* End Menu Functions */
// CHANGE EXCERPT LENGTH FOR DIFFERENT POST TYPES

function custom_excerpt_length($length) {
    global $post;
    if ($post->post_type == 'lccc_event')
    return 30;
    else if ($post->post_type == 'lccc_announcement')
    return 70;
	// custom lenght for post excerpts on homepage
	else if ($post->post_type == 'post' && !in_category('featured') && is_front_page())
    return 15;
    else
    return 40;
}
add_filter('excerpt_length', 'custom_excerpt_length');

function lccc_custom_taxonomy_dropdown( $taxonomy ) {
	$currenttax = str_replace("%body%", "black", "<body text='%body%'>");
	$args = array(
				'orderby' => 'name',
				'order' => 'ASC',
	);
	$terms = get_terms( $taxonomy , $args );
	if ( $terms ) {
		printf( '<select name="%s" class="postform" onchange="location = this.options[this.selectedIndex].value;">', esc_attr( $taxonomy ) );
		printf('<option value="/security/daily-crime-log/">Select</option>');
		foreach ( $terms as $term ) {
			printf( '<option value="'.get_bloginfo('url').'/'.str_replace('_', '-', $taxonomy).'/%s">%s</option>', esc_attr( $term->slug ), esc_html( $term->name ) );
		}
		print( '</select>' );
	}
}

// Removing Default Jetpack Sharing Button Filters

function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
 
add_action( 'loop_start', 'jptweak_remove_share' );


function add_paged_var($public_query_vars) {
    $public_query_vars[] = 'page';
    return $public_query_vars;
}
add_filter('query_vars', 'add_paged_var');

function do_rewrite() {
    add_rewrite_rule('day/([^/]+)/?$', 'index.php?pagename=day&d=$matches[1]','top');
}

add_action('init', 'do_rewrite');

function get_url_var($name)
{
    $strURL = $_SERVER['REQUEST_URI'];
    $arrVals = split("/",$strURL);
    $found = 0;
    foreach ($arrVals as $index => $value) 
    {
        if($value == $name) $found = $index;
    }
    $place = $found + 1;
   return $arrVals[$place];
}




/**************************************************************
Functions added by Kiwi
**************************************************************/

// Takes Hex color value, converts to rgb and adds alpha value for transparency
function color_convert($color, $alpha) {
	
		list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
		$a = $alpha;

		echo 'rgba('. $r .','. $g .','. $b .',' . $a . ')';
	
}

// This removes the brackets around the ... at the end of an excerpt
function excerpt_end($more) {
	global $post;
return '...';
}
add_filter('excerpt_more', 'excerpt_end');

// Add ACF options pages

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Visit/Contact Campana Center Settings',
		'menu_title'	=> 'Visit/Contact',
		'parent_slug'	=> 'theme-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Fallbacks/Defaults',
		'menu_title'	=> 'Fallbacks/Defaults',
		'parent_slug'	=> 'theme-settings',
	));
	
}

// remove aside tag from widgets, change h1 to h2, add class .sidebar-widget
function campana_edit_widget_output( $output ) {
	
	$output[0]['before_widget'] = str_replace( 'aside', 'div', $output[0]['before_widget'] );
	$output[0]['before_widget'] = str_replace( 'class="widget', 'class="sidebar-widget widget', $output[0]['before_widget'] );
	$output[0]['after_widget'] = str_replace( 'aside', 'div', $output[0]['after_widget'] );
	$output[0]['before_title'] = str_replace( 'h1', 'h2', $output[0]['before_title'] );
	$output[0]['after_title'] = str_replace( 'h1', 'h2', $output[0]['after_title'] );
	
	return $output;
}
add_filter( 'dynamic_sidebar_params', 'campana_edit_widget_output' );


/**
 * Extend WordPress search to include custom fields
 *
 * https://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

// Hide content editor for certain pages/templates
add_action( 'admin_head', 'hide_editor' );
function hide_editor() {
	$template_file = $template_file = basename( get_page_template() );
	if($template_file == 'template-home.php' || $template_file == 'template-audience.php' || $template_file == 'template-overview.php' || $template_file == 'template-full-width.php' || $template_file == 'page.php' || $template_file == 'template-contact.php'){ 
		remove_post_type_support('page', 'editor');
	}
}

// Modify Events archive query
function modify_events_query( $events_query ) {
	if( !is_admin() && is_post_type_archive('lccc_events') && $events_query->is_main_query() ) {
		
		$today = date( 'Y-m-d' );
		$events_meta_query = array(
			array(
				'key'		=>	'event_end_date',
				'value'		=>	$today,
				'compare'	=>	'>=',
				'type'		=>	'DATE'
			)
		);
		
		$events_query->set( 'posts_per_page', 10 );
		$events_query->set( 'meta_query', $events_meta_query );
		$events_query->set( 'meta_key', 'event_start_date' );
		$events_query->set( 'order', 'ASC' );
		$events_query->set( 'orderby', 'meta_value' );
	}
}
add_action( 'pre_get_posts', 'modify_events_query', 1, 1 );

// Add tabindex="-1" to off-canvas menu

function offcanvas_tab_index() {
?>

<script>
	
	jQuery("#offCanvas ul li a, #offCanvas ul li a:first-of-type, .menu-icon, #offCanvas .gsc-search-box input#gsc-i-id1, #offCanvas .menu-item-6 a").attr("tabindex", -1);
	
</script>

<?php
}
add_action('wp_footer', 'offcanvas_tab_index', 200 );

?>