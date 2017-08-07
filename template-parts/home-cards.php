<?php

$who_we_help_headline = get_field('who_we_help_headline');
$who_we_help_description = get_field('who_we_help_description');

?>


<section id="who-we-help">

	<div class="row section-title-row">
	
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
	
	<?php if( have_rows('flip_cards') ) : ?>
	
	<div class="row small-up-1 medium-up-3 large-up-3">
	
		<?php while( have_rows('flip_cards') ) : the_row(); ?>
		
		<div class="column">
		
			<div class="card">
			
				<div class="front">
				
				</div>
				
				<div class="back">
				
				</div>
			
			</div>
		
		</div>
		
		<?php endwhile; ?>
	
	</div>
	
	<?php endif; ?>

</section>