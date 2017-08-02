<?php
/**
 * Template Name: Individual Event Feed
 *
 * @package WordPress
 * @subpackage lorainccc
 * @since Lorainccc 1.0
 */
get_header(); ?>
	<div class="row main">
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
	$eventsubheading = event_meta_box_get_meta('event_meta_box_sub_heading');

?>
<div class="small-12 medium-12 large-12 columns contentdiv">
	<div class="small-12 medium-12 large columns noapadding">
				<header class="page-header">
				<h1 class="page-title"> Events</h1>
				<?php
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
			</header><!-- .page-header -->
	</div>
		<div class="small-12 columns show-for-small-only">	

	</div>
	<div class="small-12 medium-8 large-8 columns nopadding">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="small-12 medium-12 large-12 columns">
			<?php
					//Defining variables for endpoints
						$lcccevents = '';
						$stockerevents = '';
						$athleticevents = '';
						
					//defining the domain variable
				 //	$domain = 'http://' . $_SERVER['SERVER_NAME'];
							$domain = 'http://www.lorainccc.edu';
					//Defining the endpoints
							$lcccevents = new Endpoint( $domain . '/mylccc/wp-json/wp/v2/lccc_events?per_page=100' );
							$athleticevents = new Endpoint( $domain . '/athletics/wp-json/wp/v2/lccc_events?per_page=100' );
							$stockerevents = new Endpoint( 'http://sites.lorainccc.edu/stocker/wp-json/wp/v2/lccc_events?per_page=100' );
						
						//Create instance
							$multi = new MultiBlog( 1 );
				
				//setting page slug variable to allow the template to load feed based upon page slug
						$page_title = basename(get_permalink());
						switch($page_title){
									case 'lccc-events':
														//Adding endpoints to multi array
														$multi->add_endpoint ( $lcccevents );
									break;
									case 'athletic-events':
														//Adding endpoints to multi array
														$multi->add_endpoint ( $athleticevents );
									break;
									case 'stocker-events':
														//Adding endpoints to multi array
														$multi->add_endpoint ( $stockerevents );
									break;
							default:
							//Adding endpoints to multi array
							$multi->add_endpoint ( $lcccevents );
				
						//Adding endpoints to multi array
						$multi->add_endpoint ( $athleticevents );
				
						//Adding endpoints to multi array
						$multi->add_endpoint ( $stockerevents );
						}
				
							
						//Fetch Posts from Endpoints
							$posts = $multi->get_posts();
						    $count = count($posts);
						//Test to see if any events exist 
							if(empty($posts)){
									echo 'No Posts Found!';
							}
							$icounter = 0;
							$pagecounter = 1;						
							$posts_per_page = 10;
   				            $currentdate = date("Y-m-d");
							$currentday = date("d");
							$currentmonth = date("m");
							$currentmonthname = date("M");

usort( $posts, function ( $a, $b) {
return strtotime( $a->event_start_date ) - strtotime( $b->event_start_date );
});
				$eventcounter = 0;
				$firstactive = '';
                
				foreach ( $posts as $post ){
							if( $post->event_end_date > $currentdate ){
										$firstactive = $eventcounter;
										break;
							}
							$eventcounter++;
				}
                  
                //See if there is a vriable page in the URL is set or exists
                if (isset($_GET['page'])) {
                    $currentpage = $_GET['page']; 
                    $advamount = $_GET['page'] * $posts_per_page;
                    $activepost = $firstactive + $advamount - $posts_per_page;
                }else{
                    $currentpage = 1;
                }
                
                //Defining Posts array starting point based on current page
                 if (isset($_GET['page'])) {
                     if( $_GET['page'] != 1 ){
                        $posts = array_slice($posts,$activepost);
                     }else{
                        $posts = array_slice($posts,$firstactive);  
                     }
                 }else{
                      $posts = array_slice($posts,$firstactive); 
                 }		  
						//$posts will be an array of all posts sorted by post date
							foreach ( $posts as $post ){
                                if(	$icounter<$posts_per_page){
								?>
								<div class="small-12 medium-12 large-12 columns mylccc-news-container" id="post-<?php echo $post->id->rendered; ?>" >
						
										<header class="entry-header">
												<a href="<?php echo $post->link; ?>">
													<?php echo '<h1 class="entry-title">'.$post->title->rendered.'</h1>'; ?>
											</a>
										</header><!-- .entry-header -->
									<?php
									echo '<div class="small-12 medium-12 large-12 columns nopadding">';
   									
									echo '</div>';	
								?>
										<div class="small-12 medium-12 large-12 columns entry-content nopadding">
												<?php
														//set the variable to see if a featured image exists
														$featured = $post->featured_media;
												
														//Test to see if image exists. If the vaule is equal zero then no image exists
														if($featured != 0){
																echo '<div class="small-12 medium-3 large-3 columns nopadding">';
																	echo '<img src="'.$post->better_featured_image->media_details->sizes->medium->source_url.'" alt="'.$post->better_featured_image->alt_text.'">';
																echo '</div>';
															echo '<div class="small-12 medium-9 large-9 columns">';
												echo '<div class="small-12 medium-12 large-12 columns event-details">';
															$eventdate = $post->event_start_date;
															if($eventdate !=''){
															$newDate = date("F j, Y", strtotime($eventdate));
															echo '<p>'.'Date: '.$newDate.'</p>';
															}
															if($post->event_start_time !=''){
															echo '<p>'.'Time: '.$post->event_start_time.'</p>';	
															}
															$location = $post->event_location;
															if ( $location != ''){
																echo '<p>Location: '.$location.'</p>';
															}
													echo '</div>';
													echo '<div class="small-12 medium-12 large-12 columns">';
														echo '<p>' . $post->excerpt->rendered . '</p>' ;
														echo '<a class="button" href="'.$post->link.'">More Information</a>';
													echo '</div>';
															echo '</div>';
														}else{
															echo '<div class="small-12 medium-12 large-12 columns event-details nopadding">';
															$eventdate = $post->event_start_date;
																	if($eventdate !=''){
															$newDate = date("F j, Y", strtotime($eventdate));
															echo '<p>'.'Date: '.$newDate.'</p>';
															}
															if($post->event_start_time !=''){
															echo '<p>'.'Time: '.$post->event_start_time.'</p>';	
															}
															$location = $post->event_location;
															if ( $location != ''){
																echo '<p>Location: '.$location.'</p>';
															}
													echo '</div>';
															echo '<div class="small-12 medium-12 large-12 columns nopadding">';
															echo ' <p>' . $post->excerpt->rendered . '</p>' ; 	
																echo '<a class="button" href="'.$post->link.'">More Information</a>';
															echo '</div>';	
														}
												?>
										</div>
										<div class="column row">
												<hr>
										</div>
									</div>
									<?php
											$icounter ++;			
										}
								
							}
                            //$count = $count - $firstactive;
							$pagecount = ceil($count/$posts_per_page);
							$pages =  get_query_var('page');
	
							if( $pages == '' ){
										$pages = 1;

							}

							if( $pages != '' ){
								echo '<div class="small-12 medium-12 large-12 columns nopadding event-pagination">';
									echo '<div class="small-up-1 medium-up-3 large-up-3 hide-for-print">';
													if( $pages == 1 ){
														echo '<div class="column column-block">'.str_repeat('&nbsp;', 1).'</div>';
														echo '<div class="column column-block">'.str_repeat('&nbsp;', 1).'</div>';
														$pages++;
														echo '<div class="column column-block">';
																	echo '<a href="/mylccc/lccc_events/?page='.$pages.'">More Events</a>';
														echo '</div>';	
													}elseif( $pages == 2 ){
														$next= $pages+1;
														$prev= $pages-1;
														echo '<div class="column column-block">';
																	echo '<a href="/mylccc/lccc_events/">Previous Events</a>';
														echo '</div>';
														echo '<div class="column column-block">'.str_repeat('&nbsp;', 1).'</div>';
														echo '<div class="column column-block">';
																	echo '<a href="/mylccc/lccc_events/?page='.$next.'">More Events</a>';
														echo '</div>';
														$pages++;
													}elseif( $pages > 2 and $pages < $pagecount){
														$next= $pages+1;
														$prev= $pages-1;
														echo '<div class="column column-block">';
																	echo '<a href="/mylccc/lccc_events/?page='.$prev.'">Previous Events</a>';
														echo '</div>';
														echo '<div class="column column-block">'.str_repeat('&nbsp;', 1).'</div>';
														echo '<div class="column column-block">';
																	echo '<a href="/mylccc/lccc_events/?page='.$next.'">More Events</a>';
														echo '</div>';
														$pages++;
													}elseif( $pages == $pagecount ){
														$pages--;
														echo '<div class="column column-block">';
																	echo '<a href="/mylccc/lccc_events/?page='.$pages.'">Previous Events</a>';
														echo '</div>';	
														echo '<div class="column column-block">'.str_repeat('&nbsp;', 1).'</div>';
														echo '<div class="column column-block">'.str_repeat('&nbsp;', 1).'</div>';
												
													}
										echo '</div>';
								echo '</div>';
							}
		
				?>
				
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
	</div>
	<div class="medium-4 large-4 columns">	
<?php
get_sidebar();
?>
	</div>
</div>		
		<?php
get_footer();
