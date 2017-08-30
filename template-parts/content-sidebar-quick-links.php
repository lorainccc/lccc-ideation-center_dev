<?php

/* If is Blog archive or single post, get ACF values from Blog archive page, else get from current page (for standard sub template) */
if( is_home() || is_singular('post') || is_tag() || is_category() ) :

	$blog_archive_id = get_option( 'page_for_posts' );
	$quick_links_title = get_field( 'quick_links_title', $blog_archive_id );
	$links_ids = get_field('links', $blog_archive_id, false);

else :

	$quick_links_title = get_field('quick_links_title');
	$links_ids = get_field('links', false, false);

endif;

if( $links_ids ) :

	echo '<div class="sidebar-quick-links sidebar-widget">';

		if( $quick_links_title ) :

			echo '<h2 class="widgettitle">' . $quick_links_title . '</h2>';

		endif;

		echo '<ul class="quick-links-menu">';

		foreach( $links_ids as $id ) :

			echo '<li><a href="' . get_the_permalink( $id ) . '">' . get_the_title( $id ) . '</a></li>';

		endforeach;

		echo '</ul>';

	echo '</div>';

endif;

?>