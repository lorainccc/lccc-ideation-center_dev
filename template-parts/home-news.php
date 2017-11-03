<section id="home-news">

	<div class="row section-title-row full-margin">
	
		<div class="small-12 columns text-center">
		
			<h2>In the news</h2>
		
		</div>
	
	</div>
	
	<div class="row home-news-row">
	
		<?php
			
		// WP_Query arguments
		$featured_args = array(
			'post_type'              => array( 'post' ),
			'post_status'            => array( 'publish' ),
			'order'                  => 'DESC',
			'orderby'                => 'date',
			'category_name'			 => 'featured',
			'posts_per_page'		 => '1',
			'nopaging'				 => true,
		);

		// The Query
		$featured_query = new WP_Query( $featured_args );
			
		if( $featured_query->have_posts() ) :
		
		?>
	
		<div class="small-12 large-6 columns home-featured-post">
		
		<?php
		
			while( $featured_query->have_posts() ) : $featured_query->the_post();
				
				// Grab the ID of the featured post to exlude from the recent posts query
				$exclude_post_id = get_the_ID();
			
				if( has_post_thumbnail() ) :
			
					the_post_thumbnail( 'full' );
			
				endif;
			
				echo '<h3>' . get_the_title() . '</h3>';
			
				the_excerpt();
			
				echo '<a href="' . get_the_permalink() . '" class="button" title="Read Full Article">Read More</a>';
			
			endwhile;
			
			wp_reset_postdata();
			
		?>
		
		</div>
		
		<?php 
		
			$has_featured = true; 
		
		else : 
		
			$has_featured = false;
		
		endif; 
		
		//wp_reset_postdata();
		
		
		if( $has_featured == true ) :
		
			echo '<div class="small-12 large-6 columns home-recent-posts">';
		
		endif;
		
		
		//if featured post is not set, create exclude_post_id variable for recent query
		if( !isset( $exclude_post_id ) ) :
		
			$exclude_post_id = '';
		
		endif;
		
		// WP_Query arguments
		$recent_args = array(
			'post_type'              => array( 'post' ),
			'post_status'            => array( 'publish' ),
			'order'                  => 'DESC',
			'orderby'                => 'date',
			'post__not_in'		     => array( $exclude_post_id ),
			'posts_per_page'		 => '3',
			//'nopaging'				 => false,
			//'ignore_sticky_posts'	 => true
		);

		// The Query
		$recent_query = new WP_Query( $recent_args );
			
		if( $recent_query->have_posts() ) :
		
			$counter = 1;
			
			while( $recent_query->have_posts() ) : $recent_query->the_post();
		
				if( $has_featured == true ) :
					
				?>
				
				<div class="row home-recent-posts-row">
				
					<?php 
					
					if( has_post_thumbnail() ) : 
					
						$column_class = "small-12 medium-6 columns";
					
					?>
				
					<div class="small-12 medium-6 columns">
					
						<?php the_post_thumbnail('full'); ?>
					
					</div>
					
					<?php 
					
					else :
					
						$column_class = "small-12 medium-12 columns";
					
					endif; 
					
					?>
					
					<div class="<?php echo $column_class; ?>">
					
						<h3><?php the_title(); ?></h3>
						
						<?php the_excerpt(); ?>
						
						<a class="read-more" href="<?php the_permalink(); ?>" title="Read full post">Read More &raquo;</a>
					
					</div>
				
				</div>
				
				<?php
		
					if( $counter < 3 ) :

						echo '<div class="column row"><div class="news-divider"></div></div>';

					endif;
		
				else :
		
				?>
				
				<div class="small-12 medium-4 columns home-recent-posts-column">
				
					<?php 
					
					if( has_post_thumbnail() ) :
					
						the_post_thumbnail('full');
					
					endif;
					
					echo '<h3>' . the_title() . '</h3>';
					
					the_excerpt();
					
					?>
					
					<a class="read-more" href="<?php the_permalink(); ?>" title="Read full post">Read More &raquo;</a>
				
				</div>
				
				<?php	
		
				endif; // end if has featured = true
		
			$counter++;
			
			endwhile; // end while has recent posts
			
		endif; // end if has recent post
		
		echo '<div class="text-center small-12 columns home-news-view-all"><a href="' . get_permalink( get_option('page_for_posts' ) ) . '" class="button">View All News</a></div>';
			
		wp_reset_postdata();
		
		if( $has_featured == true ) :
		
			echo '</div>';
		
		endif;
			
		?>
			
	</div>

</section>


