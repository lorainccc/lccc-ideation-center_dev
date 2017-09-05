<?php

$visit_section_heading = get_field('visit_section_heading', 'option');
$map_embed_code = get_field('map_embed_code', 'option');
$location_heading = get_field('location_heading', 'option');
$street_address = get_field('street_address', 'option');
$city = get_field('city', 'option');
$state = get_field('state', 'option');
$zipcode = get_field('zipcode', 'option');
$phone_number = get_field('phone_number', 'option');
$center_hours_heading = get_field('center_hours_heading', 'option');
$form_heading = get_field('form_heading');
$form_shortcode = get_field('form_shortcode');

?>


<section id="contact" class="row" data-equalizer data-equalize-on="medium">

	<div class="small-12 medium-6 medium-push-6 columns contact-form" data-equalizer-watch>
	
		<?php 
		
		if( $form_heading ) :
		
			echo '<h2>' . $form_heading . '</h2>';
		
		endif;
		
		if( $form_shortcode ) :
		
			echo '<div class="form-container">' . do_shortcode( $form_shortcode ) . '</div>';
		
		endif;
		
		?>

	</div>
	
	<div class="small-12 medium-6 medium-pull-6 columns location-info" data-equalizer-watch>
	
		<?php
		
		if( $visit_section_heading ) :
			
			echo '<h2>' . $visit_section_heading . '</h2>';
			
		endif;
		
		if( $map_embed_code ) :
			
			echo '<div class="map-container">' . $map_embed_code . '</div>';
		
		endif;
		
		?>
		
		<div class="row" itemscope itemtype="http://schema.org/Place">
			
			<div class="small-6 columns">
								
				<?php 
					
				if( $location_heading ) :
					
					echo '<h3 itemprop="name">' . $location_heading . '</h3>';
					
				endif;
					
				?>
					
				<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						
					<span class="span-block" itemprop="streetAddress"><?php echo $street_address; ?></span>
							
					<span class="span-block">
							
						<span itemprop="addressLocality"><?php echo $city; ?></span>, <span itemprop="addressRegion"><?php echo $state; ?></span> <span itemprop="zipcode"><?php echo $zipcode; ?></span>
							
					</span>
						
				</div>
						
				<div itemprop="telephone" content="+<?php preg_replace('/[^0-9/]', '', $phone_number); ?>"><?php echo $phone_number; ?></div>
					
			</div>
				
			<div class="small-6 columns">
				
				<?php

				if( $center_hours_heading ) :

					echo '<h3>' . $center_hours_heading . '</h3>';

				endif;
					
				if( have_rows('center_hours', 'option') ) :
					
					while( have_rows('center_hours', 'option') ) : the_row();
					
						$center_hours_label = get_sub_field('center_hours_label');
						$center_hours_value = get_sub_field('center_hours_value');
					
						echo '<div class="hours-line"><span class="hours-label">' . $center_hours_label . '</span> <span class="hours-value">' . $center_hours_value . '</span></div>';
					
					endwhile;
					
				endif;

				?>
				
			</div>
			
		</div>
	
	</div>

</section>