<?php
/**
 * Template Name: Gateway Template
 *
 * @package WordPress
 * @subpackage lorainccc
 * @since Lorainccc 1.0
 */
get_header(); ?>
<div class="small-12 medium-12 large-12 columns gateway-header hide-for-print">
	<?php the_post_thumbnail(); ?>
	</div>
<div class="row page-content">
 <div class="small-12 medium-12 large-12 columns breadcrumb-container">
   <?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
</div>

	<div class="small-12 medium-12 large-12 columns">		
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
	<div class="small-12 medium-6 large-4 columns hide-for-print">
<div class="small-12 medium-12 large-12 columns">
			<?php if ( is_active_sidebar( 'lccc-badges-sidebar' ) ) { ?>
							<?php dynamic_sidebar( 'lccc-badges-sidebar' ); ?>
				<?php } ?>
		</div>
	<div class="small-12 medium-12 large-12 columns">
			<?php if ( is_active_sidebar( 'lccc-events-sidebar' ) ) { ?>
							<?php dynamic_sidebar( 'lccc-events-sidebar' ); ?>
				<?php } ?>
	</div>
			<div class="small-12 medium-12 large-12 columns">
			<?php if ( is_active_sidebar( 'sub-site-announcements-sidebar' ) ) { ?>
							<?php dynamic_sidebar( 'sub-site-announcements-sidebar' ); ?>
				<?php } ?>
	</div>
	</div>
 <div class="small-12 medium-6 large-8 columns hide-for-print">		
			<?php if ( is_active_sidebar( 'gateway-menu-sidebar' ) ) { ?>
							<?php dynamic_sidebar( 'gateway-menu-sidebar' ); ?>
				<?php } ?>
	</div>

</div>
<?php get_footer(); ?>
