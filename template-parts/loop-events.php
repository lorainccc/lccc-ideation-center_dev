<?php

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
} else {
	$twoDay = $currentDay;
}

$twomonth = '';
$tempmonth = strLen( $month );

if ( $tempmonth < 2 ) {
	$twomonth = '0' . $month;
} else {
	$twomonth = $month;
}

$nextDay = $currentDay + 1;

if ( $temp < 2 ) {
	$nextTwoDay = '0' . $currentDay;
} else {
	$nextTwoDay = $currentDay;
}

$starteventdate = event_meta_box_get_meta( 'event_start_date' );
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
$eventsubheading = event_meta_box_get_meta( 'event_meta_box_sub_heading' );

// convert event date and time to ISO 8601 for schema.org markup 
$event_date_time = $eventstartmonthfull . ' ' . $eventstartday . ', ' . $eventstartyear . ' ' . $starttime;
$event_time = strtotime( $event_date_time );
$iso_8601 = date( 'c', $event_time );

?>


<article id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Event">
	
	<header class="entry-header">

		<h2 itemprop="name" class="entry-title event-title"><?php the_title(); ?></h2>
		
		
		<?php if( has_category() ) : ?>
		
		<div class="event-taxonomy-links">
		
			<?php echo get_the_term_list( $post->ID, 'event_categories','', ' , ' , ''); ?>
		
		</div>
		
		<?php endif; ?>

	</header>
	
	<div class="entry-content">
	
		<div class="event-info">

			<div class="event-date">

				<span class="info-label">Date: </span><span class="info-value" itemprop="startDate" content="<?php echo $iso_8601; ?>"><?php echo $eventstartmonthfull . ' ' . $eventstartday . ', ' . $eventstartyear; ?></span>

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

		</div>
		
		<a class="button" href="<?php the_permalink(); ?>">Read More</a>
	
	</div> <!-- end .entry-content -->

</article>