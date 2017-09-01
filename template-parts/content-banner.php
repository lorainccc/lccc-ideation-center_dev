<?php

// for any page that isn't the news or events, and has a featured image set
if( has_post_thumbnail() && !is_home() && !is_singular('post') && !is_singular('lccc_events') && !is_archive() ) :

	$thumb_id = get_post_thumbnail_id();
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
	$background_image = $thumb_url_array[0];
	$background_image_vertical_alignment = get_field('background_image_vertical_alignment');
	$angle_overlay = get_field('angle_overlay');
	$banner_headline = '<h1>' . get_field('banner_headline') . '</h1>';

// if is news archive page and has featured image set
elseif( has_post_thumbnail( get_option('page_for_posts') ) && is_home() ) :

	$blog_archive_id = get_option('page_for_posts');
	$thumb_id = get_post_thumbnail_id( $blog_archive_id );
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
	$background_image = $thumb_url_array[0];
	$background_image_vertical_alignment = get_field('background_image_vertical_alignment', $blog_archive_id);
	$angle_overlay = get_field('angle_overlay', $blog_archive_id);
	$banner_headline = '<h1>' . get_field('banner_headline', $blog_archive_id) . '</h1>';

// if is news archive and doesn't have a featued image set, use news default (theme options)
elseif( is_home() && !has_post_thumbnail( get_option('page_for_posts') ) ) : 

	$background_image = get_field('news_banner_image', 'option');
	$background_image_vertical_alignment = get_field('news_background_image_vertical_alignment', 'option');
	$angle_overlay = get_field('news_angle_overlay', 'option');
	$banner_headline = '<h1>' . get_field('news_banner_headline', 'option') . '</h1>';

// if is category or tag archive page
elseif( is_category() || is_tag() ) :

	$blog_archive_id = get_option('page_for_posts');
	$thumb_id = get_post_thumbnail_id( $blog_archive_id );
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
	$background_image = $thumb_url_array[0];
	$background_image_vertical_alignment = get_field('background_image_vertical_alignment', $blog_archive_id);
	$angle_overlay = get_field('angle_overlay', $blog_archive_id);

	if( is_category() ) :

		$banner_headline = '<h1 class="tax-title">' . get_the_archive_title() . '</h1>';

	elseif( is_tag() ) :

		$banner_headline = '<h1 class="tax-title">' . get_the_archive_title() . '</h1>';

	endif;

// if is single news artice. 
elseif( is_singular('post') ) : 

	// if featured image is set on news archive page, use on-page options, otherwise use news default banner (theme options)
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

// if is single event
elseif( is_singular('lccc_events') ) :

	// if single event has a featued image set, use on-page options, otherwise use default for events (theme options)
	if( has_post_thumbnail() ) :

		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
		$background_image = $thumb_url_array[0];
		$background_image_vertical_alignment = get_field('events_background_image_vertical_alignment');
		$angle_overlay = get_field('events_angle_overlay');
		$banner_headline = '<div class="fake-h1">' . get_field('events_banner_headline') . '</div>';

	else :

		$background_image = get_field('events_banner_image', 'option');
		$background_image_vertical_alignment = get_field('events_background_image_vertical_alignment', 'option');
		$angle_overlay = get_field('events_angle_overlay', 'option');
		$banner_headline = '<div class="fake-h1">' . get_field('events_banner_headline', 'option') . '</div>';

	endif;

// if is events or event category archive page, use default banner options (theme options)
elseif( is_post_type_archive('lccc_events') || is_tax('event_categories') ) :

		$background_image = get_field('events_banner_image', 'option');
		$background_image_vertical_alignment = get_field('events_background_image_vertical_alignment', 'option');
		$angle_overlay = get_field('events_angle_overlay', 'option');

		if( is_tax('event_categories') ) :

			$event_cat = single_cat_title( '', false);
			$banner_headline = '<h1>' . $event_cat . '</h1>';		

		else :

			$banner_headline = '<h1>' . get_field('events_banner_headline', 'option') . '</h1>';

		endif;

// if is 404 page, get banner values from Fallbacks/Defaults option page
elseif( is_404() ) :

		$background_image = get_field('404_banner_image', 'option');
		$background_image_vertical_alignment = get_field('404_background_image_vertical_alignment', 'option');
		$angle_overlay = get_field('404_angle_overlay', 'option');
		$banner_headline = '<h1>' . get_field('404_banner_headline', 'option') . '</h1>';

// final else, if all other conditional checks return false, use the page default banner options (theme options)
else :

	global $post;
	$page_id = $post->ID;

	$background_image = get_field('page_banner_image', 'option');
	$background_image_vertical_alignment = get_field('page_background_image_vertical_alignment', 'option');
	$angle_overlay = get_field('page_angle_overlay', 'option');
	$banner_headline = '<h1>' . get_the_title($page_id) . '</h1>';
	
endif;


// set which banner overlay color to use

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