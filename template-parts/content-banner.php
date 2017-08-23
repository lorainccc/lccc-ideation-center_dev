<?php

if( has_post_thumbnail() && !is_home() && !is_singular('post') ) :

	$thumb_id = get_post_thumbnail_id();
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
	$background_image = $thumb_url_array[0];
	$background_image_vertical_alignment = get_field('background_image_vertical_alignment');
	$angle_overlay = get_field('angle_overlay');
	$banner_headline = '<h1>' . get_field('banner_headline') . '</h1>';

elseif( has_post_thumbnail( get_option('page_for_posts') ) && is_home() ) :

	$blog_archive_id = get_option('page_for_posts');
	$thumb_id = get_post_thumbnail_id( $blog_archive_id );
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
	$background_image = $thumb_url_array[0];
	$background_image_vertical_alignment = get_field('background_image_vertical_alignment', $blog_archive_id);
	$angle_overlay = get_field('angle_overlay', $blog_archive_id);
	$banner_headline = '<h1>' . get_field('banner_headline', $blog_archive_id) . '</h1>';

elseif( is_home() && !has_post_thumbnail( get_option('page_for_posts') ) ) : 

	$background_image = get_field('news_banner_image', 'option');
	$background_image_vertical_alignment = get_field('news_background_image_vertical_alignment', 'option');
	$angle_overlay = get_field('news_angle_overlay', 'option');
	$banner_headline = '<h1>' . get_field('news_banner_headline', 'option') . '</h1>';

elseif( is_singular('post') ) : 

	if( has_post_thumbnail( get_option('page_for_post') ) ) :

	$blog_archive_id = get_option('page_for_posts');
	$thumb_id = get_post_thumbnail_id( $blog_archive_id );
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
	$background_image = $thumb_url_array[0];
	$background_image_vertical_alignment = get_field('background_image_vertical_alignment', $blog_archive_id);
	$angle_overlay = get_field('angle_overlay', $blog_archive_id);
	$banner_headline = '<div class="fake-h1">' . get_field('banner_headline', $blog_archive_id) . '</div>';

	else :

	$background_image = get_field('news_banner_image', 'option');
	$background_image_vertical_alignment = get_field('news_background_image_vertical_alignment', 'option');
	$angle_overlay = get_field('news_angle_overlay', 'option');
	$banner_headline = '<div class="fake-h1">' . get_field('news_banner_headline', 'option') . '</div>';

	endif;

elseif( is_singular('lccc_events') ) :

	global $post;
	$event_id = $post->ID;

	if( has_post_thumbnail($event_id) ) :

		$thumb_id = get_post_thumbnail_id( $event_id );
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
		$background_image = $thumb_url_array[0];
		$background_image_vertical_alignment = get_field('events_background_image_vertical_alignment', $event_id);
		$angle_overlay = get_field('events_angle_overlay', $event_id);
		$banner_headline = '<div class="fake-h1">' . get_field('events_banner_headline', $event_id) . '</div>';

	else :

		$background_image = get_field('events_banner_image', 'option');
		$background_image_vertical_alignment = get_field('events_background_image_vertical_alignment', 'option');
		$angle_overlay = get_field('events_angle_overlay', 'option');
		$banner_headline = '<div class="fake-h1">' . get_field('events_banner_headline', 'option') . '</div>';

	endif;

elseif( is_search() ) :

	global $post;
	$search_id = $post->ID;

	$background_image = get_field('search_banner_image', 'option');
	$background_image_vertical_alignment = get_field('search_background_image_vertical_alignment', 'option');
	$angle_overlay = get_field('search_angle_overlay', 'option');
	//$banner_headline = '<h1>' . get_field('search_banner_headline', 'option') . '</h1>';
	$banner_headline = '<h1>' . get_the_title($search_id) . '</h1>';

else :

	$background_image = get_field('page_banner_image', 'option');
	$background_image_vertical_alignment = get_field('page_background_image_vertical_alignment', 'option');
	$angle_overlay = get_field('page_angle_overlay', 'option');
	$banner_headline = '<h1>' . get_field('page_banner_headline', 'option') . '</h1>';
	
endif;



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