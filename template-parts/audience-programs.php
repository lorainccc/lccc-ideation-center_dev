<?php

$ap_heading = get_field('ap_heading');
$ap_subheading = get_field('ap_subheading');
$ap_description = get_field('ap_description');

?>

<section id="audience-programs">

<?php if( $ap_heading || $ap_subheading ) : ?>

	<div class="row section-title-row full-margin">
	
		<div class="small-12 columns text-center">
		
			<?php
			
			if( $ap_heading ) :
			
				echo '<h2>' . $ap_heading . '</h2>';
			
			endif;
			
			if( $ap_subheading ) : 
			
				echo '<h2 class="h2-subheading">' . $ap_subheading . '</h2>';
			
			endif;
			
			if( $ap_description ) :
			
				echo $ap_description;
			
			endif;
			
			?>
		
		</div>
	
	</div>

<?php endif; ?>

<?php if( have_rows('alternating_sections') ) : $alternating_counter = 1; ?>
	
	<div class="row">
	
		<div class="small-12 medium-11 large-10 medium-centered columns alternating-row-wrapper">
		
				<?php
			
				$alternating_sections = get_field('alternating_sections');
				$sections_count = count( $alternating_sections );

				while( have_rows('alternating_sections') ) : the_row(); 

					$section_title = get_sub_field('section_title');
					$section_description = get_sub_field('section_description');
					$section_image = get_sub_field('section_image');
					$section_button_text = get_sub_field('section_button_text');
					$section_link_type = get_sub_field('section_link_type');

					if( $section_link_type == 'internal' ) :

						$section_link = get_sub_field('section_button_link');
						$button_target = '';

					elseif( $section_link_type == 'external' ) :

						$section_link = get_sub_field('section_button_url');
						$button_target = 'target="_blank"';

					endif;

					if( $alternating_counter % 2 == 0 ) :

						$col_1 = 'small-12 medium-5 medium-push-7 large-6 large-push-6 columns';
						$col_2 = 'small-12 medium-7 medium-pull-5 large-6 large-pull-6 columns';

					else :

						$col_1 = 'small-12 medium-5 large-6 columns';
						$col_2 = 'small-12 medium-7 large-6 columns';

					endif;

			?>

			<div class="row alternating-row">

				<div class="<?php echo $col_1; ?> text-center medium-text-left">

					<?php if( $section_image ) : ?>

					<img src="<?php echo $section_image['url']; ?>" alt="<?php echo $section_image['alt']; ?>" />

					<?php endif; ?>

				</div>

				<div class="<?php echo $col_2; ?>">

					<?php 

					if( $section_title ) :

						echo '<h3>' . $section_title . '</h3>';

					endif;

					if( $section_description ) :

						echo $section_description;

					endif;

					if( $section_link && $section_button_text ) :

						echo '<a href="' . $section_link . '" title="Read more about ' . $section_title . '" class="button" ' . $button_target . '>' . $section_button_text . '</a>';

					endif;

					?>

				</div>

			</div>
			
			<?php if( $alternating_counter < $sections_count ) : ?>
			
			<div class="row">
			
				<div class="small-12 columns">
					
					<div class="section-divider"></div>
				
				</div>
			
			</div>

			<?php endif; $alternating_counter++; endwhile; ?>
			
		</div>
		
	</div>

<?php endif; ?>

</section>