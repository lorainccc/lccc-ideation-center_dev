<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package MyLCCC_Theme
 */

get_header(); 

?>

<div id="event-content">

	<?php 
	
	get_template_part( 'template-parts/content', 'banner' );
	
	if( have_posts() ) :
	
	?>
	
	<div class="single-event-inner row">
	
		<main id="main" role="main" class="small-12 medium-8 large-9 columns">
		
			<?php
			
			while( have_posts() ) : the_post();
			
				get_template_part( 'template-parts/content', 'lccc-event' );
			
			endwhile;
			
			?>
		
		</main>
		
		<aside role="complementary" class="small-12 medium-4 large-3 columns">
		
			<?php
			
			get_template_part( 'template-parts/content', 'event-cat-list' );
			
			get_template_part( 'template-parts/content', 'sidebar-quick-links' );
			
			?>
		
		</aside>
	
	</div>
	
	<?php
		
	get_template_part( 'template-parts/content', 'shadow-divider' );
		
	get_template_part( 'template-parts/content', 'tour' );
		
	?>

	
	<?php
	
	else :
	
		get_template_part( 'template-parts/content', 'missing' );
	
	endif;
	
	?>

</div>

<?php get_footer(); ?>