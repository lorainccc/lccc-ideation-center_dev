<?php
/* 
This template is for mainly used for the blog/news archive page (Settings > Reading > Front page dispalys > Posts page). 
But will be used as a fallback if other various templates are not found.

*/

get_header();

?>

<div id="blog-archive-content">
	
	<?php 
	
	if (have_posts()) :  
	
		get_template_part( 'template-parts/content', 'banner' );
		
		get_template_part( 'template-parts/content', 'standard-intro');
		
	?>
	
	<div class="blog-archive-inner row">
	
		<main id="main" role="main" class="small-12 large-9 columns">
			
			<?php 
			
			while (have_posts()) : the_post();
			
				get_template_part( 'template-parts/loop', 'archive');
				
			endwhile;
				
			?>

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
	
	<?php  endif; ?>
	
</div>

<?php get_footer(); ?>


