<?php
/**
 * Template Name: Campus Security Crime Log Template
 *
 * @package WordPress
 * @subpackage lorainccc
 * @since Lorainccc 1.0
 */
get_header(); ?>
<div class="row page-content">
<div class="small-12 medium-12 large-12 columns breadcrumb-container">
   <?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
</div>
			
	<div class="small-12 medium-12 large-12 columns">	
		<div class="small-12 medium-12 large-12 columns nopadding">
				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>
		
		</div>
		<div class="row">
  <div class="small-6 medium-4 large-4 columns">
			<h4>Select Report Month:</h4>
			<select name="report_month" class="postform" onchange="location = this.options[this.selectedIndex].value;">
				<option value="/security/daily-crime-log/">Select</option>
								<option value="/security/report-month/january">January</option>			
								<option value="/security/report-month/february">February</option>
								<option value="/security/report-month/march">March</option>				
								<option value="/security/report-month/april">April</option>
								<option value="/security/report-month/may">May</option>
								<option value="/security/report-month/june">June</option>
								<option value="/security/report-month/july">July</option>				
								<option value="/security/report-month/august">August</option>
								<option value="/security/report-month/september">September</option>
								<option value="/security/report-month/october">October</option>
								<option value="/security/report-month/november">November</option>				
								<option value="/security/report-month/december">December</option>
			</select>
		</div>
  <div class="medium-4 large-4 columns show-for-medium">
						<!-- ... -->	
		</div>
  <div class="small-6 medium-4 large-4 columns">
			<h4>Select Report Year:</h4>
					<?php lccc_custom_taxonomy_dropdown( 'report_year' ); ?>	
	</div>
</div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
					<table>
						<thead>
    				<tr>
										<th width="5%">Report Month</th>
										<th width="5%">Report Year</th>
      				<th width="14%">Nature of Offense</th>
      				<th width="17%">ALEIR Report Number</th>
      				<th width="15%">Date/Time Reported</th>
      				<th width="21%">Date/Time Offense Occurred</th>
										<th width="13%">General Location</th>
      				<th width="13%">Dispositon</th>
    				</tr>
  				</thead>
										<tbody>
														<?php
																		$args = array(
																			'post_type' => 'crime_log',
																			'posts_per_page' => -1,
																		);
																$i=1;
																// The Query
																$crime_query = new WP_Query( $args );
																	// The Loop
																	if ( $crime_query->have_posts() ) {
																		while ( $crime_query->have_posts() ) {
																			$crime_query->the_post();
																			$reportyearterms = get_the_terms( $post->ID, 'report-year');
																			$natureoffence = details_of_the_crime_get_meta('details_of_the_crime_nature_of_offense');
																			$reported_date = details_of_the_crime_get_meta('details_of_the_crime_date_reported');
																			$reported_time = details_of_the_crime_get_meta('details_of_the_crime_time_reported');
																			$unkown_dates = details_of_the_crime_get_meta('details_of_the_crime_unknown_incident_date');
																			$various_dates = details_of_the_crime_get_meta('details_of_the_crime_various_incident_dates');	
																			$incident_date_start = details_of_the_crime_get_meta('details_of_the_crime_date_incident_occurred_start');
																			$incident_date_end = details_of_the_crime_get_meta('details_of_the_crime_date_incident_occurred_end');	
																			$incident_time_start = details_of_the_crime_get_meta('details_of_the_crime_time_incident_occurred_start');
																			$incident_time_end = details_of_the_crime_get_meta('details_of_the_crime_time_incident_occurred_end');
																			$secondary_incident_date_start = details_of_the_crime_get_meta('details_of_the_crime_secondary_date_incident_occurred_start');
																			$secondary_incident_date_end = details_of_the_crime_get_meta('details_of_the_crime_secondary_date_incident_occurred_end');
																			$secondary_incident_time_start = details_of_the_crime_get_meta('details_of_the_crime_secondary_time_incident_occurred_start');
																			$secondary_incident_time_end = details_of_the_crime_get_meta('details_of_the_crime_secondary_time_incident_occurred_end_');
																			$general_location = details_of_the_crime_get_meta('details_of_the_crime_general_location');
																			$disposition = details_of_the_crime_get_meta('details_of_the_crime_disposition');	
																			echo '<tr>';
																				echo '<td>';
																							//Returns Array of Term Names for "my_taxonomy"
																							$monthterm_list = wp_get_post_terms($post->ID, 'report_month', array("fields" => "all"));
																							echo '<a href="'.get_bloginfo('url').'/report-month/'.$monthterm_list[0]->slug.'">'.$monthterm_list[0]->name.'</a>';
																			echo '</td>';
																			echo '<td>';
																							//Returns Array of Term Names for "my_taxonomy"
																							$term_list = wp_get_post_terms($post->ID, 'report_year', array("fields" => "all"));
																							echo '<a href="'.get_bloginfo('url').'/report-year/'.$term_list[0]->slug.'">'.$term_list[0]->slug.'</a>';
																			echo '</td>';
																			echo '<td>'.$natureoffence.'</td>';
																			echo '<td>' . get_the_title() . '</td>';
																			echo '<td>'.$reported_date.' '.$reported_time.'</td>';
																			//if unknown date checkbox is checked
																			if( $unkown_dates == 'true' ){
																							echo '<td> Unknown </td>';
																			//if various incident dates checkbox is checked	
																			}elseif( $various_dates == 'true' ){
																							echo '<td> Unknown </td>';
																			//else if neither checkbox is active	
																			}else{
																				echo '<td>';
																							//if secondary date set
																							if( $secondary_incident_date_start != '' ){
																											$startincidentdate = strtotime($incident_date_start);
																											$incident_date_start = date("m/d/Y",$startincidentdate);
																											$endincidentdate = strtotime($incident_date_end);
																											$incident_date_end = date("m/d/Y",$endincidentdate);
																											$secondary_startdate = strtotime($secondary_incident_date_start);
																											$secondary_incident_date_start = date("m/d/Y",$secondary_startdate);
																											$secondary_enddate = strtotime($secondary_incident_date_end);
																											$secondary_incident_date_end = date("m/d/Y",$secondary_enddate);
																																//if scondary date start equals the sames as its end echo the start
																											if( $secondary_incident_date_start == $secondary_incident_date_end ){
																															//if the time is set echo the time
																															if( $secondary_incident_time_start != ''){
																																			if( $secondary_incident_time_start == $secondary_incident_time_end ){
																																			//if the time start equals end is set echo the start time - end time
																																									if( $incident_date_start == $incident_date_end && $incident_time_start == $incident_time_end ){
																																													echo $incident_date_start.' '.$incident_time_start.'</br>';	
																																													echo $secondary_incident_date_start.' '.$secondary_incident_time_start;
																																									}elseif( $incident_date_start == $incident_date_end && $incident_time_start != $incident_time_end ){
																																													echo $incident_date_start.' '.$incident_time_start.'-'.$incident_time_end.'</br>';	
																																													echo $secondary_incident_date_start.' '.$secondary_incident_time_start;
																																									}else{
																																													echo $secondary_incident_date_start.' '.$secondary_incident_time_start;
																																									}
																																			}else{
																																						if( $incident_date_start == $incident_date_end && $incident_time_start == $incident_time_end ){
																																										echo $incident_date_start.' '.$incident_time_start.'</br>';
																																										echo $secondary_incident_date_start.' '.$secondary_incident_time_start.'-'.$secondary_incident_time_end;
																																						}elseif($incident_date_start == $incident_date_end && $secondary_incident_time_end == ''){
																																										echo $incident_date_start.' '.$incident_time_start.'</br>';
																																										echo $secondary_incident_date_start.' '.$secondary_incident_time_start;
																																						}
																																						elseif( $incident_date_start == $incident_date_end && $incident_time_start != $incident_time_end ){
																																										echo $incident_date_start.' '.$incident_time_start.'-'.$incident_time_end.'</br>';	
																																									 echo $secondary_incident_date_start.' '.$secondary_incident_time_start.'-'.$secondary_incident_time_end;
																																						}
																																						else{
																																											//if the time start does not equal end echo the start time	
																																										echo $secondary_incident_date_start.' '.$secondary_incident_time_start.'-'.$secondary_incident_time_end;
																																						}
																																			}//closes the else if time start does not equal end
																															}else{
																															//if the time is not set echo just the date	
																																echo $secondary_incident_date_start;
																															}//closes the time else
																											}else{
																											//else if scondary date start  does not equal the sames as its end echo the start then - the end date	
																												//if the time is set echo the time
																																if( $secondary_incident_time_start != ''){
																																			if( $secondary_incident_time_start == $secondary_incident_time_end ){
																																			//if the time start equals end is set echo the start time - end time
																																					echo $secondary_incident_date_start.'-'.$secondary_incident_date_end.' '.$secondary_incident_time_start;
																																			}else{
																																			//if the time start does not equal end echo the start time	
																																					echo $secondary_incident_date_start.'-'.$secondary_incident_date_end.' '.$secondary_incident_time_start.'-'.$secondary_incident_time_end;
																																			}//closes the else if time start does not equal end																															
																															}else{
																															//if the time is not set echo just the date	
																																echo $secondary_incident_date_start.'-'.$secondary_incident_date_end;			
																															}//closes the time else
																											}//closes the else statement of if scondary date start  does not equal the sames as its end echo the start then - the end date	
																							//else if secondary date is not set		
																							}elseif( 	$incident_date_start != '' ){
																											$startincidentdate = strtotime($incident_date_start);
																													$incident_date_start = date("m/d/Y",$startincidentdate);
																													$endincidentdate = strtotime($incident_date_end);
																													$incident_date_end = date("m/d/Y",$endincidentdate);
																											//if incident date start equals the sames as its end echo the start
																											if( $incident_date_start == $incident_date_end ){
																															//if the time is set echo the time
																															if( $incident_time_start != ''){
																																				if( $incident_time_start == $incident_time_end ){
																																			//if the time start equals end is set echo the start time - end time
																																				echo $incident_date_start.' '.$incident_time_start;
																																			}elseif( $incident_time_end == '' ){
																																					echo $incident_date_start.' '.$incident_time_start;
																																			}
																																			else{
																																			//if the time start does not equal end echo the start time	
																																			echo $incident_date_start.' '.$incident_time_start.'-'.$incident_time_end;
																																			}//closes the else if time start does not equal end	
																															//closes the if statement if time is set	
																															}else{
																															//if the time is not set echo just the date	
																																				echo $incident_date_start;
																															}//closes the else of time is not set	
																												//closes if statement incident date start does equal end
																											}else{
																											//else if incident date start  does not equal the sames as its end echo the start then - the end date	
																															//if the time is set echo the time
																															if( $incident_time_start != '' ){
																																			if( $incident_time_start == $incident_time_end ){
																																			//if the time start equals end is set echo the start time - end time
																																							echo $incident_date_start.'-'.$incident_date_end.' '.$incident_time_start;
																																			}elseif( $incident_time_end == '' ){
																																							echo $incident_date_start.'-'.$incident_date_end.' '.$incident_time_start;
																																			}
																																			else{
																																			//if the time start does not equal end echo the start time	
																																							echo $incident_date_start.'-'.$incident_date_end.' '.$incident_time_start.'-'.$incident_time_end;
																																			}//closes the else if time start does not equal end		
																															}else{
																															//if the time is not set echo just the date	
																																			echo $incident_date_start.'-'.$incident_date_end;
																															}//closes the else if time is not set	
																											}//closes else if  incident date start does not equal end
																								
																							}//closes the else if secondary date not set
																				echo '</td>';
																			}//closes else if neither checkbox is active	
																			
																			echo '<td>'.$general_location.'</td>';
																			echo '<td>'.$disposition.'</td>';
																			echo '</tr>';
																		}
																		/* Restore original Post Data */
																		wp_reset_postdata();
																	} else {
																		// no posts found
																	}
															?>
										</tbody>
					</table>																		
		</main><!-- #main -->
	</div><!-- #primary -->
</div>	
	
</div>
<?php get_footer(); ?>
