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
$whattodisplay = 'lccc-events';
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
			event_meta_box_get_meta('event_start_date');
		$starteventtime = event_meta_box_get_meta('event_start_time');  
		$endeventdate = event_meta_box_get_meta('event_end_date');
		$endtime = event_meta_box_get_meta('event_end_time');
		

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
										
		
$location = event_meta_box_get_meta('event_meta_box_event_location');  
$cost = event_meta_box_get_meta('event_meta_box_ticket_price_s_');
		$bgcolor = event_meta_box_get_meta('event_meta_box_stoccker_bg_color');
      		$ticketlink = event_meta_box_get_meta('event_meta_box_stocker_ticket_link');	
	$eventsubheading = event_meta_box_get_meta('event_meta_box_sub_heading');	
?>
<article id="post-<?php the_ID(); ?>">
    <div class="small-12 medium-12 large-12 columns">
   <?php the_title( '<h1 class="entry-title indiv-event">', '</h1>' ); ?>
			<?php
					if( $eventsubheading != ''){
						?>
						<h4 class="event-sub-heading"><?php echo $eventsubheading;?> </h4>
					<?php
					}
					?>
    </div>
	<div class="small-12 medium-3 large-2 columns">
	<?php
			echo '<div class="small-12 medium-12 large-12 columns event-date">';
        echo '<div class="small-12 medium-12 large-12 columns calender">';                
										echo '<p class="stocker-month">'.$eventstartmonth.'</p>';
										echo '<p class="stocker-day">'.$eventstartday.'</p>';
						echo '</div>';
			echo '</div>';	
		?>
 </div>
	<div class="small-12 medium-9 large-10 columns nopadding">
	<header class="entry-header">
<div class="taxonomies">
	<?php echo get_the_term_list( $post->ID, 'event_categories','', ' , ' , ''); ?>
</div>
        <p><?php echo 'Date: '.$eventstartmonthfull.' '.$eventstartday.' , '.$eventstartyear; ?></p>
        <p><?php echo 'Time: '.$starttime; ?></p>
          <p><?php echo 'Location: '.$location; ?></p>
       	<?php if($cost != ''){ ?>		
							<p><?php echo 'Cost: '.$cost; ?></p>
							<?php } ?>
							<?php if($ticketlink != ''){ ?>							
								<a href="	<?php echo $ticketlink; ?>" class="buy-ticket-link">Buy Tickets</a>
								<?php } ?>
		</header><!-- .entry-header -->
	</div>
	<div class="small-12 medium-12large-12 columns content-container">
	<div class="entry-content">
        <div class="small-12 medium-12large-12 columns nopadding">
		<?php
			the_content();
?>
        </div>
        <div class="small-12 medium-4 large-4 columns nopadding">
       <?php echo '<br /> <br /> <a class="button" href="'.get_post_type_archive_link( 'lccc_events' ).'">Back To All Events </a>';?>
        </div>
        <div class="small-12 medium-8 large-8 columns">
        <?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lorainccc' ),
				'after'  => '</div>',
			) );
		?>
        </div>
	</div><!-- .entry-content -->
	</div>
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
