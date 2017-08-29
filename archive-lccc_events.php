<?php get_header(); ?>

<div id="event-content">

	<?php
	
	get_template_part( 'template-parts/content', 'banner' );
	
	get_template_part( 'template-parts/content', 'standard-intro');
	
	?>
	
	<div id="events-archive-inner row">
	
		<main class="small-12 medium-7 medium-push-5 columns" role="main">
		
			<?php
			
			$event_args = array(
				'post_type'              => array( 'lccc_events' ),
				'post_status'            => array( 'publish' ),
				'nopaging'               => false,
				'posts_per_archive_page' => '10',
				'meta_key'				 => 'event_start_date',
				'meta_value'			 => current_time('Ymd'),
				'meta_compare'			 => '>=',
				'order'                  => 'ASC',
				'orderby'                => 'meta_value_num',
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