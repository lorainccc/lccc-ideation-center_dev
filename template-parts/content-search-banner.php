<?php


global $post;
$search_id = $post->ID;

$background_image = get_field('search_banner_image', 'option');
$background_image_vertical_alignment = get_field('search_background_image_vertical_alignment', 'option');
$angle_overlay = get_field('search_angle_overlay', 'option');
$banner_headline = '<h1>' . get_field('search_banner_headline', 'option') . '</h1>';



if( $angle_overlay == 'lightBlue' ) :
	$angle = 'angle-light-blue.png';
	$color_class = 'small-light-blue';
elseif( $angle_overlay == 'mediumBlue' ) :
	$angle = 'angle-medium-blue.png';
	$color_class = 'small-medium-blue';
elseif( $angle_overlay == 'darkBlue' ) :
	$angle = 'angle-dark-blue.png';
	$color_class = 'small-dark-blue';
elseif( $angle_overlay == 'purple' ) :
	$angle = 'angle-purple.png';
	$color_class = 'small-purple';
elseif( $angle_overlay == 'orange' ) :
	$angle = 'angle-orange.png';
	$color_class = 'small-orange';
elseif( $angle_overlay == 'green' ) :
	$angle = 'angle-green.png';
	$color_class = 'small-green';
elseif( $angle_overlay == 'yellow' ) :
	$angle = 'angle-yellow.png';
	$color_class = 'small-yellow';
elseif( $angle_overlay == 'teal' ) :
	$angle = 'angle-teal.png';
	$color_class = 'small-teal';
endif;
	

if( $background_image ) :

?>


<div class="page-banner" style="background-image: url(<?php echo $background_image; ?>); background-position: center <?php echo $background_image_vertical_alignment; ?>;">
	
	<div class="page-banner-inner <?php echo $color_class; ?>">

		<div class="angle-overlay show-for-medium" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/images/angled-overlays/' . $angle; ?>)"></div>

		<div class="row banner-headline-row">

			<div class="small-12 medium-7 large-6 columns end">
				
				<div class="banner-headline-wrapper">

					<?php echo $banner_headline; ?>
				
				</div>

			</div>

		</div>
	
	</div>

</div>


<?php endif; ?>