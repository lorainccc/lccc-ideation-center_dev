<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lorainccc
 */

?>
<?php 
				$today = getdate();
				$currentDay = $today['mday'];
				$month = $today['mon'];
				$year = $today['year'];
				$firsteventdate ='';
    $nexteventdate ='';
				$todaysevents = '';
				$temp = strLen($currentDay);            
				$twoDay = '';
	   $nextTwoDay = '';
    if ($temp < 2){
							$twoDay = '0' . $currentDay;
				}else{
							$twoDay = $currentDay;
				}
				$twomonth = '';
    $tempmonth = strLen($month);
    if ($tempmonth < 2){
							$twomonth = '0' . $month;
				}else{
							$twomonth = $month;
				}
			 $nextDay = $currentDay + 1;
				if ($temp < 2){
							$nextTwoDay = '0' . $currentDay;
				}else{
							$nextTwoDay = $currentDay;
				}
		$starteventdate = 
			event_meta_box_get_meta('announcement_start_date');
		$starteventtime = event_meta_box_get_meta('announcement_start_time');  
		$endeventdate = event_meta_box_get_meta('announcement_end_date');
		$endtime = event_meta_box_get_meta('announcement_end_time');
		

										$starttimevar=strtotime($starteventtime);
										$starttime=	date("h:i a",$starttimevar);
										$starteventtimehours = date("G",$starttimevar);
										$starteventtimeminutes = date("i",$starttimevar);
		
          $startdate=strtotime($starteventdate);
										$eventstartdate=date("Y-m-d",$startdate);
										$eventstartmonth=date("M",$startdate);
                                        $eventstartmonthfull=date("F",$startdate);
										$eventstartday =date("j",$startdate);
                                        $eventstartyear =date("Y",$startdate);
										
										$endeventtimevar=strtotime($endtime);
										$endeventtime = date("h:i a",$endeventtimevar);
										$endeventtimehours = date("G",$endeventtimevar);
										$endeventtimeminutes = date("i",$endeventtimevar);
		
										$enddate=strtotime($endeventdate);
										$endeventdate = date("Y-m-d",$enddate);
		
										
		$duration = '';
		if($endeventtimehours == 0){
			$endeventtimehours =24;
		}
		$durationhours =	$endeventtimehours - $starteventtimehours;
		if($durationhours > 0){
				if($durationhours == 24){
				$duration .= '1 day';
				}else{
				$duration .= $durationhours.'hrs'; 
				}
		}
		$durationminutes = $endeventtimeminutes - $starteventtimeminutes;
		if($durationminutes > 0){
			$duration .= $durationminutes.'mins';
		}
										
		
$location = event_meta_box_get_meta('announcement_meta_box_event_location');  
$cost = event_meta_box_get_meta('announcement_meta_box_ticket_price_s_');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php	if ( has_post_thumbnail() ) { ?>
	<div class="small-12 medium-3 large-4 columns">
	<?php the_post_thumbnail();?>
 </div>
	<div class="small-12 medium-9 large-8 columns nopadding">
		<div class="small-12 medium-12 large-12 columns">
		<header class="entry-header">
        <a href="<?php the_permalink();?>"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></a>
					<?php if ( get_edit_post_link() ) : ?>

			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit This Announcement', 'lorainccc' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
	<?php endif; ?>
        <?php the_category( ', ' ); ?>
	</header><!-- .entry-header -->
		</div>
	<div class="small-12 medium-12 large-12 columns">
	<div class="entry-content">
		<?php
			the_excerpt();
		?>
 <a href="<?php the_permalink();?>">Read More...</a>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lorainccc' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
		<div class="column row">
        <hr>
      </div>
	</div>
	</div>
	<?php }else{ ?>
		<div class="small-12 medium-12 large-12 columns nopadding">
		<div class="small-12 medium-12 large-12 columns">
		<header class="entry-header">
        <a href="<?php the_permalink();?>"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></a>
					<?php if ( get_edit_post_link() ) : ?>

			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit This Announcement', 'lorainccc' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
	<?php endif; ?>
        <?php the_category( ', ' ); ?>
	</header><!-- .entry-header -->
		</div>
	<div class="small-12 medium-12 large-12 columns">
	<div class="entry-content">
		<?php
			the_excerpt();
		?>
 <a href="<?php the_permalink();?>">Read More...</a>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lorainccc' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
		<div class="column row">
        <hr>
      </div>
	</div>
	</div>
	
	<?php
}
	?>
</article><!-- #post-## -->

