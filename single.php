<?php
/**
 * The template for displaying all single posts.
 *
 * @package LCCC Framework
 */

get_header();

?>

<div class="blog-single-content">

	<?php 
	
	if ( have_posts() ) : while( have_posts() ) : the_post(); 
	
		get_template_part( 'template-parts/content', 'banner' );
	
	?>
	
	<div class="blog-single-inner row">
	
		<main role="main" class="small-12 large-9 columns">
		
			<?php get_template_part('template-parts/loop', 'single'); ?>
		
		</main>
		
		<aside id="blog-sidebar" role="complementary" class="small-12 large-3 columns">
		
			<?php 
			
			if( is_active_sidebar('sidebar-1') ) :

				dynamic_sidebar('sidebar-1');

			endif; 
				
			get_template_part( 'template-parts/content', 'sidebar-quick-links');
				
			get_template_part( 'template-parts/content', 'sidebar-cta');
								
			?>
		
		</aside>
	
	</div>
	
	<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>