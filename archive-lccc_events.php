<?php get_header(); ?>

<div id="event-archive-content">

	<?php
	
	get_template_part( 'template-parts/content', 'banner' );
	
	get_template_part( 'template-parts/content', 'standard-intro');
	
	?>
	
	<div class="events-archive-inner row">
	
		<main class="small-12 medium-8 large-9 columns" role="main">
		
			<?php
			
			$today = date( 'Y-m-d' );
			
			// get all events that have an end date that equals today's date or later, then order by the start date
			$event_args = array(
				'post_type'              => array( 'lccc_events' ),
				'post_status'            => array( 'publish' ),
				//'nopaging'               => false,
				'posts_per_page' => '3',
				'meta_query'			 => array(
					array(
						'key'		=>	'event_end_date',
						'value'		=>	$today,
						'compare'	=>	'>=',
						'type'		=>	'DATE'
					)
				),
				'meta_key'				 => 'event_start_date',
				'order'                  => 'ASC',
				'orderby'                => 'meta_value',
				//'paged' 				=> ( get_query_var('paged') ? get_query_var('paged') : 1 ),
			);

			$events_query = new WP_Query( $event_args );
			
			if( $events_query->have_posts() ) : 
			
				while( $events_query->have_posts() ) : $events_query->the_post();

					get_template_part('template-parts/loop', 'events'); 
			
				endwhile;
			
				the_posts_pagination( array(
					'mid_size'  => 2,
					'prev_text' => 'Previous',
					'next_text' => 'Next',
				) );
						
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