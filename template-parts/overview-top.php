<?php 

$overview_top_headline = get_field('overview_top_headline');
$overview_top_description = get_field('overview_top_description');
$description_button_text = get_field('description_button_text');
$description_button_url = get_field('description_button_url');

$features_headline = get_field('features_headline');

?>

<section id="overview-top">
	
	<?php if( $overview_top_headline ) : ?>

	<div class="row overview-top section-title-row">
	
		<div class="small-12 columns">
	
			<h2><?php echo $overview_top_headline; ?></h2>
		
		</div>
	
	</div>
	
	<?php endif; ?>
	
	<div class="row overveiw-top-content">
	
		<div class="small-12 medium-6 columns">
		
			<?php
			
			echo $overview_top_description;
			
			if( $description_button_text && $description_button_url ) :
			
				echo '<a href="' . $description_button_url . '" class="button">' . $description_button_text . '</a>';
			
			endif;
			
			?>
		
		</div>
		
		<div class="small-12 medium-5 columns overview-features">
		
			<?php 
			
			if( $features_headline ) : 
			
				echo '<h3>' . $features_headline . '</h3>';
			
			endif;
			
			if( have_rows('features') ) :
			
				while( have_rows('features') ) : the_row();
			
				$feature_title = get_sub_field('feature_title');
				$feature_description = get_sub_field('feature_description');
			
				?>
				
				<div class="feature">
				
					<?php 
					
					if( $feature_title ) :
					
						echo '<h4>' . $feature_title . '</h4>';
					
					endif;
					
					if( $feature_description ) : 
					
						echo $feature_description;
					
					endif;
					
					?>
				
				</div>
				
				<?php
			
				endwhile;
			
			endif;
			
			?>
		
		</div>
	
	</div>

</section>