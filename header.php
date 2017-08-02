<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package LCCC Framework
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-7542329-2', 'auto', {'allowLinker': true});
  ga('require', 'linker');
  ga('linker:autoLink', ['sites.lorainccc.edu'] );
  ga('send', 'pageview');

</script>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text hide-for-print" href="#content"><?php esc_html_e( 'Skip to content', 'lccc-framework' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		  <div class="row show-for-medium">
    <div class="large-6 medium-6 columns"><a href="/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/LCCC-Logo.png" height="70" width="325" alt="Lorain County Community College Logo" /></a>  </div>
    <div class="large-6 medium-6 columns">
     									<?php
          wp_nav_menu(array(
											'container' => false,
											'menu' => __( 'Header Shortcuts Menu', 'textdomain' ),
											'menu_class' => 'menu align-right hide-for-print',
											'theme_location' => 'header-shortcuts',
											'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
												));
											?>
      <!-- This should be similar to what is generated when using Wordpress searchform.php -->
					   <div class="large-9 medium-6 columns searchbox hide-for-print">
          <?php if ( is_active_sidebar( 'lccc-search-sidebar' ) ) { ?>
																<?php dynamic_sidebar( 'lccc-search-sidebar' ); ?>
								<?php }else{
															if ( class_exists( 'CustomGoogleSearch' ) ) {
																// check for plugin using plugin name
																// Plugin is activated
																		if ( is_active_sidebar( 'lccc-four-o-four-sidebar' ) ) {

																		}else{
																			$instance = array(
																			'display_results' => '3',
																		);                                               the_widget('CGS_Widget', $instance);
																			}
															}else{
																echo 'no widgets found';
															}
								}		?>
					</div>
    </div>
  </div>
<div class="medium-blue-bg show-for-medium">
    <div class="row">
      <div class="large-12 columns">
        <nav class="menu-centered">
									<?php
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
											?>
        </nav>
      </div>
    </div>
  </div>
  <div class="row show-for-small-only mobile-nav-bar hide-for-print">
    <div class="small-8 columns"> <a href="/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/lccclogo_white.svg" alt="" width="165" height="31.875" /></a> </div>
    <div class="small-2 columns clearfix"> <span data-responsive-toggle="mobile-search" data-hide-for="medium"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/magnifying-glass.svg" height="25" width="25" alt="" class="float-right" data-toggle/></span> </div>
    <div class="small-2 columns"> <span data-responsive-toggle="responsive-menu" data-hide-for="medium">
      <button class="menu-icon" type="button" data-toggle></button>
      </span> </div>
  </div>
  <div id="mobile-search" class="show-for-small-only hide-for-print">
         			<?php if ( is_active_sidebar( 'lccc-search-sidebar' ) ) { ?>
																<?php dynamic_sidebar( 'lccc-search-sidebar' ); ?>
								<?php }else{
															if ( class_exists( 'CustomGoogleSearch' ) ) {
																// check for plugin using plugin name
																// Plugin is activated
																		if ( is_active_sidebar( 'lccc-four-o-four-sidebar' ) ) {
																			echo 'sidebar active and plugin active';
																		}else{
																			$instance = array(
																			'display_results' => '3',
																		);                                               the_widget('CGS_Widget', $instance);
																			}
															}else{
																echo 'no widgets found';
															}
								}		?>
  </div>
  <div id="responsive-menu" class="show-for-small-only hide-for-print">
    <ul class="vertical menu" data-drilldown data-parent-link="true">
     <li><a href="/" alt="Link back to LCCC Home Page">Home</a></li>
					<?php 	wp_nav_menu(array(
													'container' => false,
													'menu' => __( 'Drill Menu', 'textdomain' ),
													'menu_class' => 'vertical menu',
													'theme_location' => 'mobile-primary',
													'menu_id' => 'mobile-primary-menu',
														//Recommend setting this to false, but if you need a fallback...
													'fallback_cb' => 'lc_drill_menu_fallback',
													'walker' => new lc_drill_menu_walker(),
												));
     ?>
     <li>&nbsp;</li>
     <?php
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
					?>
    </ul>
  </div>

		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">