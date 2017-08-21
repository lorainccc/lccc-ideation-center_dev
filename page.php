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
?>

<?php get_header(); ?>

<div id="page-content">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<main id="main" role="main">
	
		<?php 
		
		get_template_part( 'template-parts/content', 'banner' );
		
		get_template_part( 'template-parts/content', 'standard-intro');
		
		?>
		
		<div class="row page-two-columns">
		
			<div class="small-12 large-9 large-push-3 columns ss-content">
			
				<?php get_template_part( 'template-parts/content', 'flexible'); ?>
			
			</div>
		
			<div class="small-12 large-3 large-pull-9 columns ss-sidebar" role="complementary">
			
				<?php 
				
				get_template_part( 'template-parts/content', 'sidebar-quick-links');
				
				get_template_part( 'template-parts/content', 'sidebar-cta');
				
				$include_recent_news_widget = get_field('include_recent_news_widget');

				if( $include_recent_news_widget == 1 ) :

					if( is_active_sidebar('ss_recent_posts') ) :

						dynamic_sidebar('ss_recent_posts');

					endif; 

				endif; 
				
				?>
			
			</div>
					
		</div>
		
		<?php
		
		get_template_part( 'template-parts/content', 'shadow-divider' );
		
		get_template_part( 'template-parts/content', 'tour' );
		
		?>
	
	</main> <!-- end #main -->
	
	<?php endwhile; endif; ?>

</div> <!-- end #page-content -->

<?php get_footer(); ?>

