<?php

$whattodisplay = 'lccc-events';
$today = getdate();
$currentDay = $today[ 'mday' ];
$month = $today[ 'mon' ];
$year = $today[ 'year' ];
$firsteventdate = '';
$nexteventdate = '';
$todaysevents = '';
$temp = strLen( $currentDay );
$twoDay = '';
$nextTwoDay = '';

if ( $temp < 2 ) {
	$twoDay = '0' . $currentDay;
} 
else {
	$twoDay = $currentDay;
}

$twomonth = '';
$tempmonth = strLen( $month );

if ( $tempmonth < 2 ) {
	$twomonth = '0' . $month;
} 
else {
	$twomonth = $month;
}
$nextDay = $currentDay + 1;
if ( $temp < 2 ) {
	$nextTwoDay = '0' . $currentDay;
} else {
	$nextTwoDay = $currentDay;
}
$starteventdate =
	event_meta_box_get_meta( 'event_start_date' );
$starteventtime = event_meta_box_get_meta( 'event_start_time' );
$endeventdate = event_meta_box_get_meta( 'event_end_date' );
$endtime = event_meta_box_get_meta( 'event_end_time' );


$starttimevar = strtotime( $starteventtime );
$starttime = date( "h:i a", $starttimevar );
$starteventtimehours = date( "G", $starttimevar );
$starteventtimeminutes = date( "i", $starttimevar );

$startdate = strtotime( $starteventdate );
$eventstartdate = date( "Y-m-d", $startdate );
$eventstartmonth = date( "M", $startdate );
$eventstartmonthfull = date( "F", $startdate );
$eventstartday = date( "j", $startdate );
$eventstartyear = date( "Y", $startdate );

$endeventtimevar = strtotime( $endtime );
$endeventtime = date( "h:i a", $endeventtimevar );
$endeventtimehours = date( "G", $endeventtimevar );
$endeventtimeminutes = date( "i", $endeventtimevar );

$enddate = strtotime( $endeventdate );
$endeventdate = date( "Y-m-d", $enddate );
$event_end_month = date( 'F', $enddate );
$event_end_day = date( 'j', $enddate );


$duration = '';
if ( $endeventtimehours == 0 ) {
	$endeventtimehours = 24;
}
$durationhours = $endeventtimehours - $starteventtimehours;
if ( $durationhours > 0 ) {
	if ( $durationhours == 24 ) {
		$duration .= '1 day';
	} else {
		$duration .= $durationhours . 'hrs';
	}
}
$durationminutes = $endeventtimeminutes - $starteventtimeminutes;
if ( $durationminutes > 0 ) {
	$duration .= $durationminutes . 'mins';
}


$location = event_meta_box_get_meta( 'event_meta_box_event_location' );
$cost = event_meta_box_get_meta( 'event_meta_box_ticket_price_s_' );
$bgcolor = event_meta_box_get_meta( 'event_meta_box_stoccker_bg_color' );
$ticketlink = event_meta_box_get_meta( 'event_meta_box_stocker_ticket_link' );
$eventsubheading = event_meta_box_get_meta( 'event_meta_box_sub_heading' );

// Events Date String - if is one day event, display full date, if event last for more than one day, display start and end date

if( $endeventdate === $eventstartdate ) :
	
	$event_date_string = $eventstartmonthfull . ' ' . $eventstartday . ', ' . $eventstartyear;

else :

	$event_date_string = $eventstartmonthfull . ' ' . $eventstartday . ' - ' . $event_end_month . ' ' . $event_end_day;

endif;


// convert event date and time to ISO 8601 for schema.org markup 

$event_date_time = $eventstartmonthfull . ' ' . $eventstartday . ', ' . $eventstartyear . ' ' . $starttime;
$event_time = strtotime( $event_date_time );
$iso_8601 = date( 'c', $event_time );


/* Social Sharing Buttons */

// Get current page URL 
$eventURL = urlencode(get_permalink());
 
// Get current page title
$eventTitle = str_replace( ' ', '%20', get_the_title());
		
// Get Post Thumbnail for pinterest
$eventThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
 
// Construct sharing URL without using any script
$twitterURL = 'https://twitter.com/intent/tweet?text='.$eventTitle.'&amp;url='.$crunchifyURL.'&amp;via=Campana';
$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$eventURL;
$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$eventURL.'&amp;title='.$eventTitle;
  
?>


<article id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Event">
	
	<header class="entry-header">

		<h1 itemprop="name" class="entry-title event-title"><?php the_title(); ?></h1>
		
		<?php 
		
		if ( !empty($eventsubheading) ): 
		
			echo '<h2 class="subheading">' . $eventsubheading . '</h2>'; 
		
		endif; 
		
		?>
		
		
		<?php if( has_term('', 'event_categories', $post->ID) ) : ?>
		
		<div class="event-taxonomy-links">
		
			<?php echo get_the_term_list( $post->ID, 'event_categories','', ' , ' , ''); ?>
		
		</div>
		
		<?php endif; ?>

		<div class="event-info">

			<div class="event-date">

				<span class="info-label">Date: </span><span class="info-value" itemprop="startDate" content="<?php echo $iso_8601; ?>"><?php echo $event_date_string; ?></span>

			</div>

			<div class="event-time">

				<span class="info-label">Time: </span><span class="info-value"><?php echo $starttime; ?></span>

			</div>

			<div class="event-location" itemprop="location" itemscope itemtype="http://schema.org/Place">

				<span class="info-label">Location: </span><span class="info-value" itemprop="name"><?php echo $location; ?></span>

			</div>

			<?php if( !empty( $cost ) ) : ?>

			<div class="event-cost">

				<span class="info-label">Cost: </span><span class="info-value" itemprop="price"><?php echo $cost; ?></span>

			</div>

			<?php endif; ?>

			<?php if( !empty( $ticketlink ) ) : ?>

			<div class="event-tickets">

				<a href="<?php echo $ticketlink; ?>" title="Buy tickets for <?php the_title(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/tickets.svg" alt="buy tickets link icon" height="30" width="30"/> <span>Buy Tickets</span></a>

			</div>

			<?php endif; ?>

		</div>
	
	</header>
	
	<div class="entry-content">
	
		<?php the_content(); ?>
		
		<div class="event-social-sharing text-center medium-text-left">
		
			<div class="share-label">Share on:</div>
			
			<ul class="menu">
			
				<li>
				
					<a href="<?php echo $facebookURL; ?>" title="Share this event on Facebook" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/facebook-icon-blue.svg" alt="Facebook share icon" height="36" width="36" /></a>
					
				</li>
				
				<li>
				
					<a href="<?php echo $twitterURL; ?>" title="Share this event on Twitter" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/twitter-icon-blue.svg" alt="Twitter share icon" height="36" width="36" /></a>
					
				</li>
				
				<li>
				
					<a href="<?php echo $linkedInURL; ?>" title="Share this event on LinkedIn" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/linkedin-icon-blue.svg" alt="LinkedIn share icon" height="36" width="36" /></a>
					
				</li>
			
			</ul>
		
		</div>
	
	</div> <!-- end .entry-content -->

</article>