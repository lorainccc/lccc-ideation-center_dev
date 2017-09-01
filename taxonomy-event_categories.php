<?php get_header(); ?>

<div id="event-archive-content">

	<?php
	
	get_template_part( 'template-parts/content', 'banner' );
	
	get_template_part( 'template-parts/content', 'standard-intro');
	
	?>
	
	<div class="events-archive-inner row">
	
		<main class="small-12 medium-8 large-9 columns" role="main">
		
			<?php
			
			$event_cat_term = get_queried_object();
			//global $event_cat_term;
			/*
			$args = array(
				'post_type' => 'lccc_events',
				'event_categories' => $term->slug,
				'post_status' => 'publish',
				'order'=> 'ASC',
				'orderby'=> 'meta_value',
				'meta_key' => 'event_start_date',
				'meta_query' => array(
					array(
						'key'		=>	'event_end_date',
						'value'		=>	$today,
						'compare'	=>	'>=',
						'type'		=>	'DATE'
					)
				)
			);
			
			$query = new WP_Query( $args );
						*/
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