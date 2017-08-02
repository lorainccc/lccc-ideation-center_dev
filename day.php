<?php
/**
 * Template Name: Day
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<div class="row page-content">

<div class="small-12 medium-12 large-12 columns breadcrumb-container">
   <?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
</div>

	<div class="small-12 medium-8 large-8 columns">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<?php $myvar = get_query_var('d');
						
		if($myvar != ''){
	$date=strtotime($myvar);
				$event_month=date("F",$date);
				$event_day=date("j",$date);
				$event_year=date("Y",$date);
	}elseif ($m == ""){  
    $dateComponents = getdate();
    $event_month = $dateComponents['month'];
    $myvar_event_month = $dateComponents['mon'];
				$event_year = $dateComponents['year'];
				$event_day = $dateComponents['mday'];
				$myvar = $event_year.'-'.$myvar_event_month.'-'.$event_day;
   } else {
     $event_month = $m;
     $event_year = $y;
     $event_day =$d;
   }
			
			?>	
				<div class="small-12 columns show-for-small-only">	

	</div>
						<div class="small-12 medium-12 large-12 columns">
							<div class="small-up-1 medium-up-2 large-up-3 hide-for-print">
				<div class="column column-block"><a href="/mylccc/lccc-events/"><--- Back to All Events</a></div>
				<div class="column column-block show-for-large-up"> &nbsp;</div>
					<div class="column column-block show-for-large-up"> &nbsp;</div>
				</div>
				<h1><?php echo $event_month.' '.$event_day.', '.$event_year.' Events'; ?></h1>
				
			<div class="small-12 medium-12 large-12 columns pagediv">
								
										<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'calendarday' );
					endwhile; // End of the loop.
						?>
			</div>


			</div>		

			<div class="small-12 medium-12 large-12 columns events-list">	
						<?php 
				$lcccevents = '';
				$stockerevents = '';
				$athleticevents = '';
	
			//Grab posts (endpoints)
  	//$domain = 'http://' . $_SERVER['SERVER_NAME'];
   $domain = 'https://www.lorainccc.edu';
	   //?filter[posts_per_page]='.$displaynumber.'
			$lcccevents = new Endpoint( $domain . '/mylccc/wp-json/wp/v2/lccc_events?per_page=100' );
			$athleticevents = new Endpoint( $domain . '/athletics/wp-json/wp/v2/lccc_events?per_page=100' );
			$stockerevents = new Endpoint( 'http://sites.lorainccc.edu/stocker/wp-json/wp/v2/lccc_events?per_page=100' );
	
		//Create instance
	$multi = new MultiBlog( 1 );
	
		//Add endpoints to instance
	if ( $lcccacademicevents != ''){
		$multi->add_endpoint ( $lcccacademicevents );
	};
	if ( $lcccevents != ''){
		$multi->add_endpoint ( $lcccevents );
	};
	if ( $athleticevents != ''){
		$multi->add_endpoint ( $athleticevents );
	};

	if ( $stockerevents != ''){
		$multi->add_endpoint ( $stockerevents );
	};
	//Fetch Endpoints
	$posts = $multi->get_posts();
	if(empty($posts)){
		echo 'No Posts Found!';
	}
	
usort( $posts, function ( $a, $b) {
return strtotime( $a->event_start_date ) - strtotime( $b->event_start_date );
});
						if($posts !=''){	
					foreach ( $posts as $post ){
												$featured = $post->featured_media;
									if(strtotime($post->event_start_date) == strtotime($myvar)){
											if($featured != 0){			
												echo '<div class="small-12 medium-12 large-12 columns mylccc-event-listing">';
											echo '<div class="small-12 medium-3 large-3 columns nopadding">';
											echo '<img src="'.$post->better_featured_image->media_details->sizes->medium->source_url.'" alt="'.$post->better_featured_image->alt_text.'">';	
												echo '</div>';
											echo '<div class="small-12 medium-9 large-9 columns">';
											echo '<a href="'.$post->link.'"><h2 class="event-title">'.$post->title->rendered.'</h2></a>';
										 $eventdate = $post->event_start_date;
											if($eventdate !=''){
															$newDate = date("F j, Y", strtotime($eventdate));
															echo '<p>Date: <a class="datelink" href="day/?d='.$date.'">'.$newDate.'</a></p>';
															}
										if($post->event_start_time !=''){
															echo '<p>'.'Time: '.$post->event_start_time.'</p>';	
															}
															$location = $post->event_location;
															if ( $location != ''){
																echo '<p>Location: '.$location.'</p>';
															}	
										if( $post->excerpt->rendered != ''){
										echo '<p>'.$post->excerpt->rendered.'</p>';
												echo '<a class="button" href="'.$post->link.'">Learn More</a>';
									}else{
												echo '<a class="button" href="'.$post->link.'">Learn More</a>';
										}
										
											echo '</div>';
											echo '</div>';
											echo	'<div class="column row event-list-row">';
            			echo '<hr>';
           echo '</div>'; 
												
												
											}else{
											echo '<div class="small-12 medium-12 large-12 columns mylccc-event-listing">';
											echo '<a href="'.$post->link.'"><h2 class="event-title">'.$post->title->rendered.'</h2></a>';
										 $eventdate = $post->event_start_date;
											if($eventdate !=''){
															$newDate = date("F j, Y", strtotime($eventdate));
															echo '<p>Date: <a class="datelink" href="day/?d='.$date.'">'.$newDate.'</a></p>';
															}
										if($post->event_start_time !=''){
															echo '<p>'.'Time: '.$post->event_start_time.'</p>';	
															}
															$location = $post->event_location;
															if ( $location != ''){
																echo '<p>Location: '.$location.'</p>';
															}	
										if( $post->excerpt->rendered != ''){
										echo '<p>'.$post->excerpt->rendered.'</p>';
												echo '<a class="button" href="'.$post->link.'">Learn More</a>';
									}else{
												echo '<a class="button" href="'.$post->link.'">Learn More</a>';
										}
										
											echo '</div>';
											echo	'<div class="column row event-list-row">';
            			echo '<hr>';
           echo '</div>'; 
										}
									}
						}
				}
						?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
		<div class="small-12 medium-4 large-4 columns hide-for-print" style="padding-top: 2.35rem;">
			<?php
						get_sidebar();
			?>
			<?php if ( is_active_sidebar( 'lccc-badges-sidebar' ) ) { ?>
			<div class="small-12 medium-12 large-12 columns hide-for-print">
			<?php dynamic_sidebar( 'lccc-badges-sidebar' ); ?>
			</div>
	<?php } ?>
	</div>
		
		<div class="small-12 columns show-for-small-only">
		
		</div>
<?php
 //Jetpack Sharing Buttons
if ( function_exists( 'sharing_display' ) ) {
    sharing_display( '', true );
}
 ?>
</div>
<?php get_footer(); ?>

