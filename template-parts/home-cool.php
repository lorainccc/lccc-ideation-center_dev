<?php

$cool_headline = get_field('cool_headline');
$cool_subheading = get_field('cool_subheading');

?>

<section id="cool">
	
	<?php if( $cool_headline || $cool_subheading ) : ?>

	<div class="row section-title-row full-margin">
	
		<div class="small-12 columns text-center">
		
			<?php 
			
			if( $cool_headline ) :
			
				echo '<h2>' . $cool_headline . '</h2>';
			
			endif;
			
			if( $cool_subheading ) : 
			
				echo '<h2 class="h2-subheading">' . $cool_subheading . '</h2>';
			
			endif;
			
			?>
		
		</div>
	
	</div>
	
	<?php endif; ?>
	
	<?php if( have_rows('cool_featured_items') ) : ?>
	
	<div class="row featured-items-row">
	
		<?php 
		
		while( have_rows('cool_featured_items') ) : the_row();
		
		// get repeater sub field values
		$item_title = get_sub_field('item_title');
		$item_icon = get_sub_field('item_icon');
		$item_description = get_sub_field('item_description');
		$item_link_text = get_sub_field('item_link_text');
		$item_link_url = get_sub_field('item_link_url');
		
		?>
		
		<div class="small-12 medium-6 large-3 columns text-center">
		
			<?php if( !empty( $item_icon ) ) : ?>
			
				<img src="<?php echo $item_icon['url']; ?>" alt="<?php echo $item_icon['alt']; ?>" />
			
			<?php endif; ?>
			
			<?php 
			
			if( $item_title ) : 
			
				echo '<h3 class="underlined-title">' . $item_title . '</h3>';
			
			endif; 
			
			if( $item_description ) :
			
				echo '<p>' . $item_description . '</p>';
			
			endif;
			
			if( $item_link_text && $item_link_url ) :
			
				echo '<a href="' . $item_link_url . '" title="Learn more about ' . $item_title . ' at Campana Center of Ideation and Invention">' . $item_link_text . ' &raquo;</a>';
			
			endif;
			
			?>
		
		</div>
		
		<?php endwhile; ?>
	
	</div>
	
	<?php endif; ?>

</section>