<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package LCCC Framework
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js"><!-- added .no-js to prevent FOUC on repsonsive nav -->
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
	
	<div class="off-canvas-wrapper">
	
		<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
			
			<div class="off-canvas position-right" id="offCanvas" data-position="right" data-off-canvas data-trap-focus="false">
			
				<?php get_template_part( 'template-parts/nav', 'offcanvas'); ?>
			
			</div>
			
			<div class="off-canvas-content" data-off-canvas-content>
				
				<div id="page" class="hfeed site">

					<a class="skip-link screen-reader-text hide-for-print" href="#content"><?php esc_html_e( 'Skip to content', 'lccc-framework' ); ?></a>

					<header id="masthead" class="site-header" role="banner">

						<?php get_template_part( 'template-parts/nav', 'topbar' ); ?>

					</header><!-- #masthead -->

					<div id="content" class="site-content">