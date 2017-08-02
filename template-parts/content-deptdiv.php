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
 <?php

  $contactargs = array(
    'post_type' => 'lc_contact_info',
				'post_status' => 'publish',
  		'posts_per_page' => 1,
  );

  $contactinfo = new WP_Query($contactargs);
  if ( $contactinfo->have_posts() ) :
        while ( $contactinfo->have_posts() ) : $contactinfo->the_post();
  	 $post_id = get_the_ID();
  	 $dept_extension = get_post_meta( $post_id, 'lc_dept_extension_field', true );
  	 $dept_email = get_post_meta( $post_id, 'lc_dept_email_field', true );
  	 $dept_faxnumber = get_post_meta( $post_id, 'lc_dept_fax_number_field', true );
  	 $dept_building = get_post_meta( $post_id, 'lc_building_field', true );
	 $dept_roomnumber = get_post_meta( $post_id, 'lc_room_field', true );
  	 $dept_monday_hours = get_post_meta( $post_id, 'lc_dept_office_hours_monday_field', true );
 	 $dept_tuesday_hours = get_post_meta( $post_id, 'lc_dept_office_hours_tuesday_field', true );
	 $dept_wednesday_hours = get_post_meta( $post_id, 'lc_dept_office_hours_wednesday_field', true );
	 $dept_thursday_hours = get_post_meta( $post_id, 'lc_dept_office_hours_thursday_field', true );
	 $dept_friday_hours = get_post_meta( $post_id, 'lc_dept_office_hours_friday_field', true );
	 $dept_saturday_hours = get_post_meta( $post_id, 'lc_dept_office_hours_saturday_field', true );
  $dept_sunday_hours = get_post_meta( $post_id, 'lc_dept_office_hours_sunday_field', true );
	 $dept_social_facebook = get_post_meta( $post_id, 'lc_social_media_facebook_field', true );
	 $dept_social_twitter = get_post_meta( $post_id, 'lc_social_media_twitter_field', true );
 ?>
<div class="row">
   <div class="columns small-12 medium-8 large-8 callout">
    <h2>Contact Information</h2>
    <div class="row">
     <div class="small-12 medium-6 large-6 columns callout-contact-info">
      <p><?php
       if($dept_building != ''){
       echo $dept_building . ', Room ' . $dept_roomnumber . '<br />';
       }?> 
      <strong>Phone:</strong> (440) 366-<?php echo $dept_extension; ?><br />
      <?php if ($dept_faxnumber !== '') { ?>
      <strong>Fax Number:</strong> (440) 366-<?php echo $dept_faxnumber; ?><br />
      <?php } ?>
      <strong>Email:</strong> <?php echo $dept_email; ?></p>
     </div>
     <div class="small-12 medium-6 large-6 columns callout-contact-info">
      <p class="hours"><b>Office Hours</b> <br />
						<?php if ($dept_monday_hours !== '') { 
									echo 'Monday: ' . $dept_monday_hours . '<br />';
						}
						if ($dept_tuesday_hours !== '') { 
									echo 'Tuesday: ' . $dept_tuesday_hours . '<br />';
						}
						if ($dept_wednesday_hours !== '') { 
									echo 'Wednesday: ' . $dept_wednesday_hours . '<br />';
						}
						if ($dept_thursday_hours !== '') { 
									echo 'Thursday: ' . $dept_thursday_hours . '<br />';
						}
						if ($dept_friday_hours !== '') { 
									echo 'Friday: ' . $dept_friday_hours . '<br />';
						}	
						if ($dept_saturday_hours !== '') { 
									echo 'Saturday: ' . $dept_saturday_hours . '<br />';
						}			
						if ($dept_sunday_hours !== '') { 
									echo 'Sunday: ' . $dept_sunday_hours . '<br />';
						}	
							?>							
						</p>						
     </div>
    <div class="small-12 medium-12 large-12 columns callout-contact-info">
	<?php 
		if ($dept_social_facebook !== '') {
			echo '<a href="https://www.facebook.com/' . str_replace('/', '', $dept_social_facebook) . '" target="_blank" alt="Follow us on Facebook" title="Follow us on Facebook"><i class="fi-social-facebook" style="font-size:36pt; color:#0C3B78;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		} 
		if ($dept_social_twitter !== '') {
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.twitter.com/' . str_replace('/', '', $dept_social_twitter) . '" target="_blank" alt="Follow us on Twitter" title="Follow us on Twitter"><i class="fi-social-twitter" style="font-size:36pt; "></i></a>';
		}
	?> 
     </div>
    </div>
   </div>
</div>
 <?php
 
	endwhile;
 wp_reset_query();
endif;
?>
	<div class="entry-content">
		<?php
			the_content();

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