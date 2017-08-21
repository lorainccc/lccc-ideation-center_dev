<?php

$connect_heading = get_field('connect_heading');
$connect_subheading = get_field('connect_subheading');
$instagram_feed_shortcode = get_field('instagram_feed_shortcode');
$twitter_handle = get_field('twitter_handle', 'option');
$twitter_url = get_field('twitter_url', 'option');
$instagram_handle = get_field('instagram_handle', 'option');
$instagram_url = get_field('instagram_url', 'option');
$facebook_handle = get_field('facebook_handle', 'option');
$facebook_url = get_field('facebook_url', 'option');

?>

<section id="connect-with-us">

	<?php if( $connect_heading || $connect_subheading ) : ?>
	
	<div class="row section-title-row quarter-margin">
	
		<div class="small-12 columns text-center">
		
			<?php 
			
			if( $connect_heading ) :
			
				echo '<h2>' . $connect_heading . '</h2>';
			
			endif;
			
			if( $connect_subheading ) :
			
				echo '<h2 class="h2-subheading">' . $connect_subheading . '</h2>';
			
			endif;
			
			?>
		
		</div>
	
	</div>
	
	<?php endif; ?>
	
	<?php if( $instagram_feed_shortcode ) : ?>
	
	<div class="row instagram-feed-row">
	
		<div class="small-12 columns">
		
			<?php echo do_shortcode( $instagram_feed_shortcode ); ?>
		
		</div>
	
	</div>
	
	<?php endif; ?>
	
	<?php if( $twitter_url || $instagram_url || $facebook_url ) : ?>
	
	<div class="row home-sm-links text-center">
	
		<div class="small-12 columns">
		
			<ul class="vertical medium-horizontal menu home-sm-links-list align-center">
			
				<?php if( $twitter_url ) : ?>
				
				<li>
				
					<a href="<?php echo $twitter_url; ?>" target="_blank" title="Connect with Campana Center of Ideation and Invention on Twitter">
					
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/twitter-icon-blue.svg" alt="Twitter" height="36" width="36" />
						
						<?php if( $twitter_handle ) :
						
							echo $twitter_handle; 
						
						endif; ?>
						
					</a>
					
				</li>
				
				<?php endif; ?>
				
				<?php if( $instagram_url ) : ?>
				
				<li>
				
					<a href="<?php echo $instagram_url; ?>" target="_blank" title="Connect with Campana Center of Ideation and Invention on Instagram">
					
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/instagram-icon-blue.svg" alt="Instagram" height="36" width="36" />
						
						<?php if( $instagram_handle ) :
						
							echo $instagram_handle; 
						
						endif; ?>
						
					</a>
					
				</li>
				
				<?php endif; ?>
				
				<?php if( $facebook_url ) : ?>
				
				<li>
				
					<a href="<?php echo $facebook_url; ?>" target="_blank" title="Connect with Campana Center of Ideation and Invention on Facebook">
					
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/facebook-icon-blue.svg" alt="Facebook" height="36" width="36" />
						
						<?php if( $facebook_handle ) :
						
							echo $facebook_handle; 
						
						endif; ?>
						
					</a>
					
				</li>
				
				<?php endif; ?>
			
			</ul>
		
		</div>
	
	</div>
	
	<?php endif; ?>

</section>