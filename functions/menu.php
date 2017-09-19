<?php

// This theme uses wp_nav_menu() in one location.
register_nav_menus( 
	array(
		'primary' => esc_html__( 'Primary', 'campana' ),
		'left-nav' => esc_html__( 'Left Nav', 'campana' ),
		'footer-quicklinks-nav' => esc_html__( 'Footer Quicklinks', 'lorainccc' ),
		'footer-campus-location-nav' => esc_html__( 'Footer Campus Locations', 'lorainccc' ),
		'mobile-primary' => esc_html__( 'Mobile Primary Menu', 'campana' ),
  		'header-shortcuts' => esc_html__( 'Header Shortcuts Menu', 'lorainccc' ),
  		'mobile-header-shortcuts' => esc_html__( 'Mobile Header Shortcuts Menu', 'lorainccc' ),
		'campana-main-nav' => __( 'Campana Main Menu', 'campana'),
		'campana-top-nav' => __( 'Campana Top Menu'),
		'campana-footer-nav' => __( 'Campana Footer Links', 'campana')
	) 
);

/***********************************************************
Existing Menus, Walkers and Fallbacks Built into theme
***********************************************************/

// Primary Nav Menu
function primary_nav() {
	wp_nav_menu(array(
		'container' => false,
		'menu' => __( 'Primary', 'textdomain' ),
		'menu_class' => 'dropdown menu hide-for-print',
		'theme_location' => 'primary',
		'items_wrap'      => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>',
		//Recommend setting this to false, but if you need a fallback...
		'fallback_cb' => 'lc_topbar_menu_fallback',
		'walker' => new lc_top_bar_menu_walker,
	));
}

// Walker for Primary Nav Menu
class lc_top_bar_menu_walker extends Walker_Nav_Menu {
	//Add vertical menu class and submenu data attribute to sub menus
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\" data-submenu>\n";
	}
}

// Fallback for Primary Nav Menu
function lc_topbar_menu_fallback($args) {
	/*
	 * Instantiate new Page Walker class instead of applying a filter to the
	 * "wp_page_menu" function in the event there are multiple active menus in theme.
	*/

	$walker_page = new Walker_Page();
	$fallback = $walker_page->walk(get_pages(), 0);
	$fallback = str_replace("<ul class='children'>", '<ul class="children submenu menu vertical" data-submenu>', $fallback);

	echo '<ul class="dropdown menu" data-dropdown-menu">'.$fallback.'</ul>';
}

// Primary Menu on Mobile
function primary_nav_mobile() {
	wp_nav_menu(array(
		'container' => false,
		'menu' => __( 'Drill Menu', 'textdomain' ),
		'menu_class' => 'vertical menu',
		'theme_location' => 'mobile-primary',
		'menu_id' => 'mobile-primary-menu',
		//Recommend setting this to false, but if you need a fallback...
		'fallback_cb' => 'lc_drill_menu_fallback',
		'walker' => new lc_drill_menu_walker(),
	));
}

// Walker for Primary Menu on Mobile
class lc_drill_menu_walker extends Walker_Nav_Menu {
	// Add vertical menu class
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\">\n";
	}
}

// Fallback for Primary Menu on Mobile
function lc_drill_menu_fallback($args) {
	/*
	 * Instantiate new Page Walker class instead of applying a filter to the
	 * "wp_page_menu" function in the event there are multiple active menus in theme.
	*/

	$walker_page = new Walker_Page();
	$fallback = $walker_page->walk(get_pages(), 0);
	$fallback = str_replace("children", "children vertical menu", $fallback);
	echo '<ul class="vertical menu" data-drilldown="">'.$fallback.'</ul>';
}

// Header Shortcuts Menu
function header_shortcuts_menu() {
	wp_nav_menu(array(
		'container' => false,
		'menu' => __( 'Header Shortcuts Menu', 'textdomain' ),
		'menu_class' => 'menu align-right hide-for-print',
		'theme_location' => 'header-shortcuts',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	));
}


// Header Shortcuts Menu for Mobile
function header_shortcuts_mobile_menu() {
	wp_nav_menu(array(
		'container' => false,
		'menu' => __( 'Drill Menu', 'textdomain' ),
		'menu_class' => 'vertical menu',
		'theme_location' => 'mobile-header-shortcuts',
		'menu_id' => 'mobile-header-shortcuts',
		//Recommend setting this to false, but if you need a fallback...
		'fallback_cb' => 'lc_drill_menu_fallback',
		'walker' => new lc_drill_menu_walker(),
	));
}

// Drilldown Submenu for Mobile
function mobile_submenu() {
	wp_nav_menu(array(
    	'container' => false,
        'menu' => __( 'Drill Menu', 'textdomain' ),
        'menu_class' => 'vertical menu',
        'theme_location' => 'left-nav',
        'menu_id' => 'sub-mobile-primary-menu',
        //Recommend setting this to false, but if you need a fallback...
        'fallback_cb' => 'lc_drill_menu_fallback',
        'walker' => new lc_drill_menu_walker(),
	));
}


// Left Sidebar Nav Menu
function left_nav() {
	// Primary navigation menu.
	wp_nav_menu( array(
		'menu_class'     => 'nav-menu',
		'theme_location' => 'left-nav',
	));
}

// Footer Campus Locations Nav
function footer_campus_locations_nav() {
	wp_nav_menu( array(
		'menu_class'     => 'underline',
		'theme_location' => 'footer-campus-location-nav',
	));
}

// Primary Footer Nav
function footer_quicklinks_nav() {
	wp_nav_menu( array(
		'menu_class'     => 'underline',
		'theme_location' => 'footer-quicklinks-nav',
	));
}

/**********************************************************************
Menus, Walkers and Fallbacks added by Kiwi Creative for Campana theme
***********************************************************************/

// Campana Main Menu
function campana_main_nav() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'vertical large-horizontal menu',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion large-dropdown" data-close-on-click-inside="false">%3$s</ul>',
        'theme_location' => 'campana-main-nav',        			// Where it's located in the theme
        'depth' => 5,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Topbar_Menu_Walker()
    ));
} 

// Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
class Topbar_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu vertical\">\n";
    }
}

// The Top Menu
function campana_top_nav() {
    wp_nav_menu(array(
    	'container' => 'false',                         // Remove nav container
    	'menu' => __( 'Campana Top Menu', 'campana' ),   	// Nav name
    	'menu_class' => 'vertical large-horizontal menu',      					// Adding custom nav class
    	'theme_location' => 'campana-top-nav',             // Where it's located in the theme
        'depth' => 0,                                   // Limit the depth of the nav
    	'fallback_cb' => ''  							// Fallback function
	));
}

function campana_footer_nav() {
	wp_nav_menu( array(
		'menu_class'     => 'footer-links',
		'theme_location' => 'campana-footer-nav',
	));
}


// Add Foundation active class to menu
function required_active_nav_class( $classes, $item ) {
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );
