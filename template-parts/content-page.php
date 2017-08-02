<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lorainccc
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();

  // Display the Shared Content Feed
  
   $sharedcontentsiteurl = get_post_meta( $post->ID, 'lc_shared_content_site_url_field', true );
   $sharedcontentpostslug = get_post_meta( $post->ID, 'lc_shared_content_post_slug_field', true );
    
     if ($sharedcontentsiteurl != ''){
        
    $contenturl = trailingslashit( 'http://' . $_SERVER['SERVER_NAME'] . '/' . $sharedcontentsiteurl ) . 'wp-json/wp/v2/posts?slug=' . $sharedcontentpostslug;
    
    $sharedcontenturl = new lcEndPoints( $contenturl );
    
    $sharedcontent = new lcContent( 1 );
    $sharedcontent->lc_add_endpoint ( $sharedcontenturl );
    $sharedposts = $sharedcontent->lc_get_posts();
        if(empty($sharedposts)){
		   echo 'No Posts Found!';
	   }
    
    foreach ( $sharedposts as $post ){
     echo $post->content->rendered;
    }
   }
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lorainccc' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>

			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'lorainccc' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
	<?php endif; ?>
</article><!-- #post-## -->
