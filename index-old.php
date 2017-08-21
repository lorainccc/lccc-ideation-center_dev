<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package LCCC Framework
 */

get_header(); ?>
<div class="row page-content">

	<div class="small-12 medium-8 large-8 columns">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<?php if ( is_active_sidebar( 'lccc-announcements-sidebar' ) ) { ?>
						<?php dynamic_sidebar( 'lccc-announcements-sidebar' ); ?>
				<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<div class="small-12 medium-4 large-4 columns">
	<?php if ( is_active_sidebar( 'lccc-badges-sidebar' ) ) { ?>
			<div class="small-12 medium-12 large-12 columns hide-for-print">
			<?php dynamic_sidebar( 'lccc-badges-sidebar' ); ?>
			</div>
	<?php } ?>
			<?php if ( is_active_sidebar( 'lccc-events-sidebar' ) ) { ?>
																							<?php dynamic_sidebar( 'lccc-events-sidebar' ); ?>
																		<?php } ?>				
	</div>
	<?php
 //Jetpack Sharing Buttons
if ( function_exists( 'sharing_display' ) ) {
    sharing_display( '', true );
}
 ?>
</div>
<?php get_footer(); ?>

