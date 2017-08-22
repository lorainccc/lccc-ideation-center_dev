<?php

// Loop through ACF Flexible Content Layouts

if( have_rows('flexible_content_layouts') ) :

	echo '<div class="flexible-content-area">';

	while( have_rows('flexible_content_layouts') ) : the_row();

		// Regular old WYSIWYG editor
		if( get_row_layout() == 'text_content_block' ) :

		?>
       
       		<div class="row layout-row content-block-row">
       		
       			<div class="small-12 columns">
       			
       				<?php the_sub_field('content_editor'); ?>
       			
				</div>
       		
			</div>
        
        <?php
		
		// Two Column Layout
        elseif( get_row_layout() == 'two_column_layout' ) : 

			$column_layout = get_sub_field('column_layout');
			$column_1_content = get_sub_field('column_1_content');
			$column_2_content = get_sub_field('column_2_content');

			if( $column_layout == '1' ) :

				$column_1_class = 'medium-3';
				$column_2_class = 'medium-9';

			elseif( $column_layout == '2' ) :

				$column_1_class = 'medium-4';
				$column_2_class = 'medium-8';

			elseif( $column_layout == '3' ) :

				$column_1_class = 'medium-5';
				$column_2_class = 'medium-7';

			elseif( $column_layout == '4' ) :

				$column_1_class = 'medium-6';
				$column_2_class = 'medium-6';

			elseif( $column_layout == '5' ) :

				$column_1_class = 'medium-7';
				$column_2_class = 'medium-5';

			elseif( $column_layout == '6' ) :

				$column_1_class = 'medium-8';
				$column_2_class = 'medium-4';

			elseif( $column_layout == '7' ) :

				$column_1_class = 'medium-9';
				$column_2_class = 'medium-3';

			endif;

		?>
		
			<div class="row layout-row two-column-layout-row">
			
				<div class="small-12 <?php echo $column_1_class; ?> columns">
				
					<?php echo $column_1_content; ?>
				
				</div>
				
				<div class="small-12 <?php echo $column_2_class; ?> columns">
				
					<?php echo $column_2_content; ?>
				
				</div>
			
			</div>
		
		<?php

		// Orbit Slider
		elseif( get_row_layout() == 'orbit_slider' ) :

			$gallery = get_sub_field('slider_images');
			$orbit_desc = get_sub_field('slider_description');
			$auto_play = get_sub_field('auto_play');
			$slide_transition = get_sub_field('slide_transition');
			$slide_timer = get_sub_field('slide_timer');

			// set value for data-auto-play
			if( $auto_play ) :

				$auto = 'true';

			else : 

				$auto = 'false';

			endif;

			if( $slide_transition == 'slide' ) :

				$in_right = 'slide-in-right';
				$in_left = 'slide-in-left';
				$out_right = 'slide-out-right';
				$out_left = 'slide-out-left';

			elseif ( $slide_transition == 'fade' ) :

				$in_right = 'fade-in';
				$in_left = 'fade-in';
				$out_right = 'fade-out';
				$out_left = 'fade-out';


			endif;

			// set timer delay in MS
			if( $slide_timer ) :

				$delay = $slide_timer * 1000;

			else :

				$delay = 5000;

			endif;

			// used to print .is-active on first slide
			$slide_counter = 1;

			// used to print .is-active and data-slide=""
			$bullet_counter = 0;

			if( $gallery ) :

			?>
			
			<div class="row layout-row orbit-row">
			
				<div class="small-12 columns">
					
					<div class="orbit" role="region" aria-label="<?php echo $orbit_desc; ?>" data-options="animInFromLeft:<?php echo $in_left; ?>; animInFromRight:<?php echo $in_right; ?>; animOutToLeft:<?php echo $out_left; ?>; animOutToRight:<?php echo $out_right; ?>;" data-auto-play="<?php echo $auto; ?>" data-timer-delay="<?php echo $delay ?>" data-orbit>
					
						<div class="orbit-wrapper">
						
							<div class="orbit-controls">
							
								<button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
      							<button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
							
							</div>
							
							<ul class="orbit-container">
							
								<?php foreach( $gallery as $image ) : ?>
								
								<li class="orbit-slide<?php if( $slide_counter == 1 ) : echo ' is-active'; endif; ?>">
								
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="orbit-image" />
								
								</li>
								
								<?php $slide_counter++; endforeach; ?>
							
							</ul>
						
						</div>
						
						<nav class="orbit-bullets">
						
							<?php foreach( $gallery as $image ) : ?>
							
							<button <?php if( $bullet_counter == 0 ) : echo 'class="is-active" '; endif; ?>data-slide="<?php echo $bullet_counter; ?>"><span class="show-for-sr">Slide #<?php echo $bullet_counter + 1; ?></span></button>
							
							<?php $bullet_counter++; endforeach; ?>
						
						</nav>
					
					</div>
				
				</div>
			
			</div>
			
			<?php

			endif;

		elseif( get_row_layout() == 'accordion' ) :

			if( have_rows('accordion_group') ) :

			?>
			
			<div class="row layout-row accordion-layout-row">
			
				<div class="small-12 columns">
				
					<ul class="accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true">
					
					<?php while( have_rows('accordion_group') ) : the_row(); ?>
					
						<li class="accordion-item" data-accordion-item>
						
							<a href="#" class="accordion-title"><?php the_sub_field('accordion_item_title'); ?></a>
							
							<div class="accordion-content" data-tab-content>
							
								<?php the_sub_field('accordion_item_content'); ?>
							
							</div>
						
						</li>
					
					<?php endwhile; ?>
					
					</ul>
				
				</div>
			
			</div>
			
			<?php	

			endif;

		elseif( get_row_layout() == 'tabs' ) :

			if( have_rows('tab_group') ) :

				$tabs_counter = 1;

				$tabs_ID = rand(1, 100);

			?>
			
			<div class="row layout-row tabs-layout-row">
			
				<div class="small-12 columns">
				
					<ul class="tabs" data-tabs id="tabs-<?php echo $tabs_ID; ?>">
					
					<?php while( have_rows('tab_group') ) : the_row(); ?>
					
						<li class="tabs-title<?php if( $tabs_counter == 1 ) : echo ' is-active'; endif; ?>">
							
							<a href="#panel-<?php echo $tabs_counter; ?>"<?php if( $tabs_counter == 1 ) : echo ' aria-selected="true"'; endif; ?>><?php the_sub_field('tab_item_title'); ?></a>
							
						</li>
					
					<?php $tabs_counter++; endwhile; $tabs_counter = 1; ?>
					
					</ul>
					
					<div class="tabs-content" data-tabs-content="tabs-<?php echo $tabs_ID; ?>">
					
					<?php while( have_rows('tab_group') ) : the_row(); ?>
					
						<div class="tabs-panel<?php if( $tabs_counter == 1 ) : echo ' is-active'; endif; ?>" id="panel-<?php echo $tabs_counter; ?>">
						
							<?php the_sub_field('tab_item_content'); ?>
						
						</div>
					
					<?php $tabs_counter++; endwhile; ?>
					
					</div>
				
				</div>
			
			</div>
			
			<?php

			endif;

		elseif( get_row_layout() == 'callout' ) :

			$callout_color = get_sub_field('callout_color');
			$callout_title = get_sub_field('callout_title');
			$callout_text = get_sub_field('callout_text');
			$callout_button_text = get_sub_field('callout_button_text');
			$callout_link_type = get_sub_field('callout_link_type');

			if( $callout_link_type == 'internal' ) :

				$link = get_sub_field('callout_button_link');
				$target= '';

			elseif( $callout_link_type == 'external' ) : 

				$link = get_sub_field('callout_button_url');
				$target = 'target="_blank" ';

			endif;

		?>
		
			<div class="row layout-row callout-layout-row">
			
				<div class="small-12 columns">
				
					<div class="callout" style="background-color: <?php echo $callout_color; ?>">
					
						<?php 
						
						if( $callout_title ) : 
						
							echo '<h3>' . $callout_title . '</h3>';
						
						endif;
						
						if( $callout_text ) :
						
							echo $callout_text;
						
						endif;
						
						if( $callout_button_text && isset( $link ) ) :
						
							echo '<a href="' . $link . '" class="button hollow white" ' . $target . '>' . $callout_button_text . '</a>';
						
						endif;
						
						?>
					
					</div>
				
				</div>
			
			</div>
			
		<?php

		elseif( get_row_layout() == 'responsive_embed' ) :

		?>
      	
      		<div class="row layout-row embed-layout-row">
      		
      			<div class="small-12 medium-9 large-6 columns end">
      			
      				<div class="flex-video">
      				
      					<?php the_sub_field('embed_code'); ?>
      				
					</div>
      			
				</div>
      		
			</div>
       	
       	<?php
        	
        endif;

	endwhile;

	echo '</div>';

endif;

?>