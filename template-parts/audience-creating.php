<?php

$gallery_headline = get_field('gallery_headline');
$image_gallery = get_field('image_gallery');
$images_per_row_large = get_field('images_per_row_large');
$images_per_row_medium = get_field('images_per_row_medium');
$images_per_row_small = get_field('images_per_row_small');

$gallery_image_size = 'medium_large';
$modal_image_size = 'full';

?>


<section id="image-gallery">

	<?php if( $gallery_headline ) : ?>
	
	<div class="row section-title-row half-margin">
	
		<div class="small-12 columns text-center">
		
			<h2><?php echo $gallery_headline; ?></h2>
		
		</div>
	
	</div>
	
	<?php endif; ?>
	
	<?php if( $image_gallery ) : ?>
	
	<div class="row small-up-<?php echo $images_per_row_small ?> medium-up-<?php echo $images_per_row_medium; ?> large-up-<?php echo $images_per_row_large; ?>">
	
		<?php 
				
		foreach( $image_gallery as $key => $image ) : 
		
			// Get ID for next and previous links in Reveal modal
		
			if( isset( $image_gallery[$key - 1] ) ) :
		
				$previous_id = $image_gallery[$key - 1]['ID'];	
		
			endif;
		
			if( isset( $image_gallery[$key + 1] ) ) :
		
				$next_id = $image_gallery[$key + 1]['ID'];
		
			endif;
		
			$current_id = $image['ID'];
		
			$image_width = $image['width'];
				
		?>
		
		<div class="column column-block text-center">
		
			<a data-open="image-<?php echo $current_id; ?>">
		
				<?php echo wp_get_attachment_image( $current_id, $gallery_image_size ); ?>
			
			</a>
			
			<div class="reveal large text-center" id="image-<?php echo $current_id; ?>" data-reveal>
			
				<div class="image-wrapper" style="max-width: <?php echo $image_width; ?>px; width: 100%;">
				
						<button class="close-modal-button" data-close aria-label="Close Modal" type="button">

							<span aria-hidden="true"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/cancel.svg" alt="close modal" /></span>

						</button>

						<?php echo wp_get_attachment_image( $current_id, $modal_image_size, "", array( "class" => "thumbnail") ); ?>
				
				</div>
				
				<div class="modal-nav">
				
					<div class="previous-modal text-right">
					
					<?php if( isset( $previous_id ) ) : ?>
					
						<a data-open="image-<?php echo $previous_id; ?>"><span class="show-for-sr">Previous Image</span>&laquo; Previous</span></a>
						
					<?php endif; ?>
					
					</div>
					
					<div class="next-modal text-left">
					
					<?php if( isset( $next_id ) &&  $next_id != $current_id ) : ?>
					
						<a data-open="image-<?php echo $next_id; ?>"><span class="show-for-sr">Next Image</span>Next &raquo;</span></a>
						
					<?php endif; ?>
					
					</div>
				
				</div>
			
			</div>
		
		</div>
		
		<?php endforeach; ?>
	
	</div>
	
	<?php endif; ?>

</section>