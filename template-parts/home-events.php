<?php

$today = date( 'Y-m-d' );
			
// get all events that have an end date that equals today's date or later
$event_args = array(
	'post_type'              => array( 'lccc_events' ),
	'post_status'            => array( 'publish' ),
	'nopaging'               => false,
	'posts_per_page' 		 => '3',
	'meta_query'			 => array(
		array(
			'key'		=>	'event_end_date',
			'value'		=>	$today,
			'compare'	=>	'>=',
			'type'		=>	'DATE'
				)
			),
	'meta_key'				 => 'event_start_date',
	'order'                  => 'ASC',
	'orderby'                => 'meta_value',
);

$events_query = new WP_Query( $event_args );
$event_count = $events_query->post_count;
$events_subheading = get_field('events_subheading');

?>
	

<div class="row section-title-row full-margin">

	<div class="small-12 columns text-center">
	
		<h2 class="h2-subheading"><?php echo $events_subheading; ?></h2>
	
	</div>

</div>


<?php if( $events_query->have_posts() ) : ?>

<div class="current-events row">

	<?php 
	
	while( $events_query->have_posts() ) : $events_query->the_post(); 
	
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
	
		if( ( $events_query->current_post + 1 ) == $event_count ) :

			$end = ' end';

		else :

			$end = '';

		endif;


	
	?>
	
	<div class="small-12 medium-4 columns single-event<?php echo $end; ?>">
	
		<div class="row single-event-inner">
		
			<div class="small-2 medium-12 large-3 columns calendar-column">
			
				<div class="calendar-icon">
				
					<div class="calendar-month"><?php echo $eventstartmonth; ?></div>
				
					<div class="calendar-day"><?php echo $eventstartday; ?></div>
				
				</div>
			
			</div>
			
			<div class="small-10 medium-12 large-9 columns event-info-column">
			
				<h3><?php the_title(); ?></h3>
				
				<div class="event-title-underline"></div>
				
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

					<div class="event-description">
					
						<span class="info-label">Description: </span><span class="info-value"><?php the_excerpt(); ?></span>
					
					</div>
					
					<a class="read-more" href="<?php the_permalink(); ?>">Read More &raquo;</a>

				</div>
			
			</div>
		
		</div>
	
	</div>
	
	<?php endwhile; ?>

</div>

<?php endif; ?>