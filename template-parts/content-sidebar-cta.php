<?php

if( is_home() || is_single() || is_tag() || is_category() ) :

	$blog_archive_id = get_option('page_for_posts');
	$cta_to_display = get_field('cta_to_display', $blog_archive_id);

else :

	$cta_to_display = get_field('cta_to_display');

endif;



if( $cta_to_display == 'default' ) :

	$cta_title = get_field('cta_title', 'option');
	$cta_content = get_field('cta_content', 'option');
	$button_link_text = get_field('button_link_text', 'option');
	$button_link_type = get_field('button_link_type', 'option');

	if( $button_link_type == 'internal' ) :

		$cta_link = get_field('button_page_link', 'option');
		$cta_target = '';

	elseif( $button_link_type == 'external' ) :

		$cta_link = get_field('button_link_url', 'option');
		$cta_target = 'target="_blank"';

	endif;

elseif( $cta_to_display == 'custom' && ( !is_home() || !is_single() || !is_tag() || !is_category()  ) ) :

	$cta_title = get_field('cta_title');
	$cta_content = get_field('cta_content');
	$button_link_text = get_field('button_link_text');
	$button_link_type = get_field('button_link_type');

	if( $button_link_type == 'internal' ) :

		$cta_link = get_field('button_page_link');
		$cta_target = ' target="_self"';

	elseif( $button_link_type == 'external' ) :

		$cta_link = get_field('button_link_url');
		$cta_target = ' target="_blank"';

	endif;

elseif( $cta_to_diplay == 'custom' && ( is_home() || is_single() || is_tag() || is_category() )) :

	$cta_title = get_field('cta_title', $blog_archive_id);
	$cta_content = get_field('cta_content', $blog_archive_id);
	$button_link_text = get_field('button_link_text', $blog_archive_id);
	$button_link_type = get_field('button_link_type', $blog_archive_id);

	if( $button_link_type == 'internal' ) :

		$cta_link_page_id = get_field('button_page_link', $blog_archive_id, false);
		$cta_link = get_the_permalink( $cta_link_page_id);
		$cta_target = '';

	elseif( $button_link_type == 'external' ) :

		$cta_link = get_field('button_link_url', $blog_archive_id);
		$cta_target = ' target="_blank"';

	endif;

endif;

if( $cta_to_display == 'default' || $cta_to_display == 'custom' ) :

	echo '<div class="sidebar-cta sidebar-widget">';

		if( $cta_title ) :

			echo '<h2 class="widgettitle">' . $cta_title . '</h2>';

		endif;

		if( $cta_content ) :

			echo $cta_content;

		endif;

		if( $button_link_text && $cta_link ) :

			echo '<a href="' . $cta_link . '" class="button"' . $cta_target . '>' . $button_link_text . '</a>';

		endif;

	echo '</div>';

endif;

?>