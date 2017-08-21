<?php

$who_we_help_headline = get_field('who_we_help_headline');
$who_we_help_description = get_field('who_we_help_description');

?>


<section id="who-we-help">
	
	<?php if( $who_we_help_headline || $who_we_help_description ) : ?>

	<div class="row section-title-row full-margin">
		
		<div class="small-12 columns text-center">
		
			<?php
			
			if( $who_we_help_headline ) :
			
				echo '<h2>' . $who_we_help_headline . '</h2>';
			
			endif;
			
			if( $who_we_help_description ) :
			
				echo '<p>' . $who_we_help_description . '</p>';
			
			endif;
			
			?>
		
		</div>
	
	</div>
	
	<?php endif; ?>
	
	<?php if( have_rows('flip_cards') ) : ?>
	
	<div class="row small-up-1 medium-up-2 large-up-3" data-equalizer id="home-cards">
	
		<?php 
		
		while( have_rows('flip_cards') ) : the_row(); 
		
			$card_image = get_sub_field('card_image');
			$card_image_vertical_alignment = get_sub_field('card_image_vertical_alignment');
			$card_color = get_sub_field('card_color');
			$card_title = get_sub_field('card_title');
			$card_description = get_sub_field('card_description');
			$card_button_text = get_sub_field('card_button_text');
			$card_button_link = get_sub_field('card_button_link');
		
		
		?>
		
		<div class="column">
		
			<div class="card text-center" data-equalizer-watch>
			
				<div class="front" style="background-image: url(<?php echo $card_image; ?>); background-position: center <?php echo $card_image_vertical_alignment; ?>;">
				
					<div class="front-title" style="background-color: <?php color_convert($card_color, .8); ?>">
					
						<div class="card-front-title"><?php echo $card_title; ?></div>
					
					</div>
				
				</div>
				
				<div class="back" style="background-image: url(<?php echo $card_image; ?>); background-position: center <?php echo $card_image_vertical_alignment; ?>;">
				
					<div class="back-inner" style="background-color: <?php color_convert($card_color, .8); ?>">
					
						<h3 class="card-h3"><?php echo $card_title; ?></h3>
						
						<p><?php echo $card_description; ?></p>
						
						<a href="<?php echo $card_button_link; ?>" title="Learn more about how we help <?php echo $card_title; ?>" class="hollow button white-hollow"><?php echo $card_button_text; ?></a>
					
					</div>
				
				</div>
			
			</div>
		
		</div>
		
		<?php endwhile; ?>
	
	</div>
	
	<?php endif; ?>

</section>