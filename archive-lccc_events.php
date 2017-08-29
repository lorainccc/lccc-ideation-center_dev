<?php get_header(); ?>

<div id="event-content">

	<?php
	
	get_template_part( 'template-parts/content', 'banner' );
	
	get_template_part( 'template-parts/content', 'standard-intro');
	
	?>
	
	<div id="events-archive-inner row">
	
		<main class="small-12 medium-7 medium-push-5 columns" role="main">
		
			<?php
			
			$today = date( 'Y-m-d' );
			
			$event_args = array(
				'post_type'              => array( 'lccc_events' ),
				'post_status'            => array( 'publish' ),
				'nopaging'               => false,
				'posts_per_page' => '10',
				'meta_query'			 => array(
					array(
						'key'		=>	'event_start_date',
						'value'		=>	$today,
						'compare'	=>	'>=',
						'type'		=>	'DATE'
					)
				),
				'meta_key'				 => 'event_start_date',
				'order'                  => 'ASC',
				'orderby'                => 'meta_value',
				'paged' 				=> ( get_query_var('paged') ? get_query_var('paged') : 1 ),
			);

			$events_query = new WP_Query( $event_args );
			
			if( $events_query->have_posts() ) : 
			
				while( $events_query->have_posts() ) : $events_query->the_post();

					get_template_part('template-parts/loop', 'events'); 
			
				endwhile;
			
			endif;
			
			?>
		
		</main>
	
		<aside class="small-12 medium-5 medium-pull-7 columns" role="complementary">
		
			<?php //get_template_part('template-parts/content', 'events-sidebar'); ?>
			sidebar goes here
		
		</aside>
	
	</div>
	
	<?php
		
	get_template_part( 'template-parts/content', 'shadow-divider' );
		
	get_template_part( 'template-parts/content', 'tour' );
		
	?>

</div>

<?php get_footer(); ?>