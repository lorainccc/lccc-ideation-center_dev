<?php

   //LCCC Custom Breadcrumb Display Code
  if (function_exists('lccc_breadcrumb')){
    if (is_home() || is_front_page()) {
     echo lccc_breadcrumb() . get_bloginfo('name') ;
    } elseif ( is_category() ) {
    	echo lccc_breadcrumb() . "<a href='" . get_bloginfo('url') . "' title='Return to " . get_bloginfo('name') . " home'>" . get_bloginfo('name') . "</a> > " . single_cat_title() ;
    }elseif ( is_archive() ) {
	echo lccc_breadcrumb() . "<a href='" . get_bloginfo('url') . "' title='Return to " . get_bloginfo('name') . " home'>" . get_bloginfo('name') . "</a> > " . single_cat_title( '', false ) ;
    } elseif ( is_tax() ) {
        echo lccc_breadcrumb() . "<a href='" . get_bloginfo('url') . "' title='Return to " . get_bloginfo('name') . " home'>" . get_bloginfo('name') . "</a> > " . single_cat_title( '', false ) ;
    }elseif ( is_page() && $post->post_parent != 0 ) {
     // Page is a Subpage
     echo lccc_breadcrumb() . "<a href='" . get_bloginfo('url') . "' title='Return to " . get_bloginfo('name') . " home'>" . get_bloginfo('name') . "</a> > " . "<a href='" . get_permalink( $post->post_parent ) ."' title='Return to " . get_the_title( $post->post_parent ) . "'>" . get_the_title( $post->post_parent ) . "</a>" . " > " . get_the_title() ;
    }elseif ( is_page() && $post->post_parent > 0 ) {
 echo lccc_breadcrumb() . "<a href='" . get_bloginfo('url') . "' title='Return to " . get_bloginfo('name') . " home'>" . get_bloginfo('name') . "</a> > ";
     }elseif ( is_single() ) {
	echo lccc_breadcrumb() . "<a href='" . get_bloginfo('url') . "' title='Return to " . get_bloginfo('name') . " home'>" . get_bloginfo('name') . "</a> > " . get_the_term_list( $post->ID, 'event_categories','', ' , ' , '') . " > " . get_the_title()  ;
    }else {
    	echo lccc_breadcrumb() . "<a href='" . get_bloginfo('url') . "' title='Return to " . get_bloginfo('name') . " home'>" . get_bloginfo('name') . "</a> > " . get_the_title() ;
    };
   };
  ?>