<?php get_header(); ?>

<div id="event-archive-content">

	<?php
	
	get_template_part( 'template-parts/content', 'banner' );
	
	get_template_part( 'template-parts/content', 'standard-intro');
	
	?>
	
	<div class="events-archive-inner row">
	
		<main class="small-12 medium-8 large-9 columns" role="main">
		
			<?php
			
			$term = get_queried_object();
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged') : 1;
			
			$args = array(
				'post_type' => 'lccc_events',
				'event_categories' => $term->slug,
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'order'=> 'ASC',
				'orderby'=> 'meta_value',
				'paged' => $paged,
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
			
			// pagination fix
			
			$temp_query = $wp_query;
			$wp_query = NULL;
			$wp_query = $query;			
						
			if( $query->have_posts() ) : 
			
				while( $query->have_posts() ) : $query->the_post();

					get_template_part('template-parts/loop', 'events'); 
			
				endwhile;
			
			endif; 
			
			wp_reset_postdata();
			
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