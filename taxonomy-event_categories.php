<?php get_header(); ?>

<div id="event-archive-content">

	<?php
	
	get_template_part( 'template-parts/content', 'banner' );
	
	get_template_part( 'template-parts/content', 'standard-intro');
	
	?>
	
	<div class="events-archive-inner row">
	
		<main class="small-12 medium-8 large-9 columns" role="main">
		
			<?php
			
			// This query is being modified via modify_events_query() in functions.php
			// Posts are only displayed if end date is greater or equal to current day
			// Posts are ordered by the start date
						
			if( have_posts() ) : 
			
				while( have_posts() ) : the_post();

					get_template_part('template-parts/loop', 'events'); 
			
				endwhile;
			
			?>
			
			<div class="pagination-wrapper text-center">
			
			<?php
				
				the_posts_pagination( array(
					'mid'	=>	3,
					'prev_text'	=> '&laquo; Previous',
					'next_text' => 'Next &raquo;',
					'screen_reader_text' => 'Events navigation'
				)
				);
				
			?>
			
			</div>
			
			<?php
			
				wp_reset_postdata();
						
			endif;
			
			?>
		
		</main>
	
		<aside class="small-12 medium-4 large-3 columns" role="complementary">
		
			<?php 
			
			get_template_part('template-parts/content', 'event-cat-list'); 
			
			get_template_part( 'template-parts/content', 'sidebar-quick-links' );
			
			?>
		
		</aside>
	
	</div>
	
	<?php
		
	get_template_part( 'template-parts/content', 'shadow-divider' );
		
	get_template_part( 'template-parts/content', 'tour' );
		
	?>

</div>

<?php get_footer(); ?>