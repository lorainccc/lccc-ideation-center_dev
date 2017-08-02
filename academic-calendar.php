<?php
/**
 * Template Name: Academic Calendar
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
	<div class="small-12 medium-12 large-12 columns academic-calender-content">		
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="small-12 medium-12 columns acevents-header">
				<?php $spring_start = get_option( 'lccc_spring_semester_startdate', '' ); 
				$spring_start_var = strtotime($spring_start);
				$spring_start = date("Y-m-d",$spring_start_var); 	
				$spring_start_display = date("F d",$spring_start_var);
				$spring_start_year = date("Y",$spring_start_var);
				?>
				<?php $spring_end = get_option( 'lccc_spring_semester_enddate', '' ); 
				$spring_end_var = strtotime($spring_end);
				$spring_end = date("Y-m-d",$spring_end_var); 
				$spring_end_display = date("F d, Y",$spring_end_var);
				$spring_end_year = date("Y",$spring_end_var);

				if($spring_start_year == $spring_end_year){
					$spring_start_year = $spring_start_year - 1; 
				}
				?>
				<?php $summer_start = get_option( 'lccc_summer_semester_startdate', '' ); 
				$summer_start_var = strtotime($summer_start);
				$summer_start = date("Y-m-d",$summer_start_var); 	
				$summer_start_display = date("F d",$summer_start_var);
				$summer_start_year = date("Y",$summer_start_var);
				?>
				<?php $summer_end = get_option( 'lccc_summer_semester_enddate', '' ); 
				$summer_end_var = strtotime($summer_end);
				$summer_end = date("Y-m-d",$summer_end_var); 
				$summer_end_display = date("F d, Y",$summer_end_var); 
				$summer_end_year = date("Y",$summer_end_var); 
				if($summer_start_year == $summer_end_year){
					$summer_end_year = $summer_end_year + 1; 
				}
				?>
				<?php $fall_start = get_option( 'lccc_fall_semester_startdate', '' ); 
				$fall_start_var = strtotime($fall_start);
				$fall_start = date("Y-m-d",$fall_start_var);
				$fall_start_display = date("F d",$fall_start_var);
				$fall_start_year = date("Y",$fall_start_var);
				?>
				<?php $fall_end = get_option( 'lccc_fall_semester_enddate', '' ); 
				$fall_end_var = strtotime($fall_end);
				$fallend = date("Y-m-d",$fall_end_var); 
				$fall_end_display = date("F d, Y",$fall_end_var); 
					$fall_end_year = date("Y",$fall_end_var); 
				if($fall_start_year == $fall_end_year){
					$fall_end_year = $fall_end_year + 1; 
				}
				?>
				<?php
				$today = date("Y-m-d");
				$today_var = strtotime($today);
				$today_year = date("Y",$today_var);
				
				if ($today >= $spring_start && $today < $summer_start){
				$activesemster = 'spring';
				}elseif($today >= $summer_start && $today < $fall_start){
				$activesemster = 'summer';
				}elseif($today >= $fall_start){
				$activesemster = 'fall';
				}
				?>
				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // end of the loop.
					?>
			</div>
			<div class="small-12 medium-12 columns">
		<?php
				$springactive = '';
				$summeractive = '';
				$fallactive ='';
					switch ( $activesemster ){
										case 'spring':
										$springactive = 'is-active';
										break;
										case 'summer':
										$summeractive = 'is-active';
										break;
										case 'fall':
										$fallactive = 'is-active';
										break;					
					}
							?>
								<ul class="tabs" data-tabs id="academic-calendar-tabs">
								
									<?php if($fallactive == 'is-active'){ 
													?>
													<li class="button tabs-title <?php echo $fallactive; ?>"><a href="#fall-semester-calendar"><?php echo 'Fall Semester '.$fall_start_year.' - '.$fall_end_year; ?></a></li>
									
													<li class="button tabs-title <?php echo $springactive; ?>"><a href="#spring-semester-calendar" aria-selected="true"><?php echo 'Spring Semester '.$spring_start_year.' - '.$spring_end_year; ?></a>				
													</li>
													<?php if( $today_year != $summer_end_year && $today_year < $summer_end_year){?>
													<li class="button tabs-title <?php echo $summeractive; ?>"><a href="#summer-semester-calendar"><?php echo 'Summer Semester '.$summer_start_year.' - '.$summer_end_year; ?></a></li>
													<?php } ?>
								<?php
									}elseif( $springactive == 'is-active' ){ ?>
												<li class="button tabs-title <?php echo $springactive; ?>"><a href="#spring-semester-calendar" aria-selected="true"><?php echo 'Spring Semester '.$spring_start_year.' - '.$spring_end_year; ?></a>				
												</li>
												<li class="button tabs-title <?php echo $summeractive; ?>"><a href="#summer-semester-calendar"><?php echo 'Summer Semester '.$summer_start_year.' - '.$summer_end_year; ?></a></li>	
												<?php if( $today_year != $fall_end_year && $today_year < $fall_end_year){?>
												<li class="button tabs-title <?php echo $fallactive; ?>"><a href="#fall-semester-calendar"><?php echo 'Fall Semester '.$fall_start_year.' - '.$fall_end_year; ?></a></li>
												<?php } ?>
									<?php }elseif( $summeractive = 'is-active' ){ ?>					
									<li class="button tabs-title <?php echo $summeractive; ?>"><a href="#summer-semester-calendar"><?php echo 'Summer Semester '.$summer_start_year.' - '.$summer_end_year; ?></a></li>
						
									<li class="button tabs-title <?php echo $fallactive; ?>"><a href="#fall-semester-calendar"><?php echo 'Fall Semester '.$fall_start_year.' - '.$fall_end_year; ?></a></li>
									<?php if( $today_year != $spring_end_year && $today_year < $spring_end_year){?>
									<li class="button tabs-title <?php echo $springactive; ?>"><a href="#spring-semester-calendar" aria-selected="true"><?php echo 'Spring Semester '.$spring_start_year.' - '.$spring_end_year; ?></a>				
										<?php } ?>
								</li>
								<?php }else{ ?>
								<li class="button tabs-title <?php echo $springactive; ?>"><a href="#spring-semester-calendar" aria-selected="true"><?php echo 'Spring Semester '.$spring_start_year.' - '.$spring_end_year; ?></a>				
								</li>
						
									<li class="button tabs-title <?php echo $summeractive; ?>"><a href="#summer-semester-calendar"><?php echo 'Summer Semester '.$summer_start_year.' - '.$summer_end_year; ?></a></li>
						
									<li class="button tabs-title <?php echo $fallactive; ?>"><a href="#fall-semester-calendar"><?php echo 'Fall Semester '.$fall_start_year.' - '.$fall_end_year; ?></a></li>

								<?php } ?>
									
							
						
									
							<div class="tabs-content" data-tabs-content="academic-calendar-tabs">
						 <div class="tabs-panel <?php echo $springactive; ?>" id="spring-semester-calendar">
									<div class="small-12 medium-12 columns nopadding">
										<?php echo '<h2>'.'Spring Semester '.$spring_start_year.' - '.$spring_end_year.'</h2>'; ?>
								<?php
								echo '<h3>'.$spring_start_display.' to '.$spring_end_display.'</h3>';?>
								</div>
																						<table>
							<tbody>
								<?php

								$springcat = 'spring-semester-'.$spring_start_year.'-'.$spring_end_year;

								$summercat = 'summer-semester-'.$summer_start_year.'-'.$summer_end_year;
								$fallcat = 'fall-semester-'.$fall_start_year.'-'.$fall_end_year;
							
										$springeventargs=array(
            'post_type' => 'lccc_academicevent',
		    						'posts_per_page' => -1,
		    						'order' => 'ASC',
												'event_categories' => $springcat,
    		    		'orderby'=> 'meta_value',
    		    		'meta_key' => 'event_start_date',
          );
					
					$spring_wp_query = new WP_Query($springeventargs);
					if ( $spring_wp_query->have_posts() ) :
								while ( $spring_wp_query->have_posts() ) : $spring_wp_query->the_post();
								$spdate = academic_event_metabox_get_meta('event_start_date');
								$spdatevar = strtotime($spdate);
								$spdayofweek =	date("l",$spdatevar);
								$spdisplaydate = date("F d, Y",$spdatevar);
								$spdatewithoutyear =	date("F d ",$spdatevar);
								$spenddate = academic_event_metabox_get_meta('event_end_date');
								$spenddatevar = strtotime($spenddate);
								$spenddayofweek =	date("l",$spenddatevar);
							 $spenddisplaydate = date("F d, Y",$spenddatevar);
								$spendwithoutmonth = date("d, Y",$spenddatevar);
								?>
													<tr>
														<td><?php the_content(); ?></td>  
														<td><?php echo $spdayofweek; ?></td>
														<?php if($spenddate != ''){?>
														<td><?php echo $spdatewithoutyear.'- '.$spendwithoutmonth; ?></td>
														<?php }else{ ?>
														<td><?php echo $spdisplaydate; ?></td>
												  <?php } ?>
													</tr>
										<?php
								
								endwhile;
					wp_reset_postdata();
								endif;
								?>
						</tbody>
					</table>
	
  </div>
						  <div class="tabs-panel  <?php echo $summeractive; ?>" id="summer-semester-calendar">
										<div class="small-12 medium-12 columns nopadding">
									<?php echo '<h2>'.'Summer Semester '.$summer_start_year.' - '.$summer_end_year.'</h2>'; ?>
											<?php
								echo '<h3>'.$summer_start_display.' to '.$summer_end_display.'</h3>';?>
									</div>
																			<table>
							<tbody>
								<?php
										$summereventargs=array(
            'post_type' => 'lccc_academicevent',
		    						'posts_per_page' => -1,
		    						'order'=> 'ASC',
												'event_categories' => $summercat,
    		    		'orderby'=> 'meta_value',
    		    		'meta_key' => 'event_start_date',
          );
					$summer_wp_query = new WP_Query($summereventargs);
					if ( $summer_wp_query->have_posts() ) :
								while ( $summer_wp_query->have_posts() ) : $summer_wp_query->the_post();
								$sudate = academic_event_metabox_get_meta('event_start_date');
								$sudatevar = strtotime($sudate);
								$sudayofweek =	date("l",$sudatevar);
								$sudisplaydate = date("F d, Y",$sudatevar);
								$sudatewithoutyear =	date("F d ",$sudatevar);
								$suenddate = academic_event_metabox_get_meta('event_end_date');
								$suenddatevar = strtotime($suenddate);
								$suenddayofweek =	date("l",$suenddatevar);
							 $suenddisplaydate = date(" d, Y",$suenddatevar);
								?>
													<tr>
														<td><?php echo the_content(); ?></td>  
														<td><?php echo $sudayofweek; ?></td>
														<?php if($suenddate != ''){ ?>
														<td><?php echo $sudisplaydate.'- '.$suenddisplaydate; ?></td>
														<?php }else{ ?>
														<td><?php echo $sudisplaydate; ?></td>
													<?php } ?>
										</tr>
										<?php
								endwhile;
					wp_reset_postdata();
								endif;
								?>
						</tbody>
					</table>
  </div>
						 <div class="tabs-panel  <?php echo $fallactive; ?>" id="fall-semester-calendar">
								<div class="small-12 medium-12 columns nopadding">
									<?php echo '<h2>'.'Fall Semester '.$fall_start_year.' - '.$fall_end_year.'</h2>'; ?>								
									<?php
								echo '<h3>'.$fall_start_display.' to '.$fall_end_display.'</h3>';?>
  					</div>
							<table>
							<tbody>
								<?php
										$eventargs=array(
            'post_type' => 'lccc_academicevent',
		    						'posts_per_page' => -1,
		    						'order' => 'ASC',
												'event_categories' => $fallcat,
    		    		'orderby'=> 'meta_value',
    		    		'meta_key' => 'event_start_date',
          );
					$wp_query = new WP_Query($eventargs);
					if ( $wp_query->have_posts() ) :
								while ( $wp_query->have_posts() ) : $wp_query->the_post();
								$fadate = academic_event_metabox_get_meta( 'event_start_date' );
								$fadatevar = strtotime($fadate);
								$fadayofweek =	date("l",$fadatevar);
								$fadisplaydate = date("F d, Y",$fadatevar);
								$fadatewithoutyear =	date("F d ",$fadatevar);
								$fadateyear = date("Y",$fadatevar);
								$faenddate = academic_event_metabox_get_meta( 'event_end_date' );
								$faenddatevar = strtotime($faenddate);
								$faenddayofweek =	date("l", $faenddatevar);
							 $faenddisplaydate = date("F d, Y", $faenddatevar);
							 $faenddatewithoutmonth = date("d, Y", $faenddatevar);
								$faenddateyear = date("Y", $faenddatevar); 
								?>
													<tr>
														<td><?php echo the_content(); ?></td>  
														<td><?php echo $fadayofweek; ?></td>
														<?php if( $faenddate != ''){ ?>
														<?php if( $fadateyear != $faenddateyear ){?>
														<td><?php 	echo $fadatewithoutyear.'- '.$faenddisplaydate; ?></td>
														<?php }else{ ?>
														<td><?php 	echo $fadatewithoutyear.'- '.$faenddatewithoutmonth; ?></td>
														<?php } ?>
														<?php }else{ ?>
														<td><?php echo $fadisplaydate; ?></td>
													<?php } ?>
										</tr>
										<?php
								endwhile;
								wp_reset_postdata();
							endif;
								?>
						</tbody>
					</table>
  			</div>
						
						</div>
						</ul>
			</div>
			<div class="small-12 medium-12 columns events-table-glossary">
			
<p>
* Instructional fees are waived for qualified older adults when they register for
credit classes on an audit (no credit received) basis. Students must be at least 60
years old and have lived in Ohio for at least one year. Refer to the Credit Class
Schedule for sub-term Senior Citizen registration dates. Tuition fee waivers on
credit courses for qualifying older adults are processed on a space available first come, first served basis.
</p>
<p>				
** Schedule adjustment and add/drop for a given course must be completed prior
to the second meeting of that course but before the end of the schedule adjustment
period.
</p>
<p>				
*** Audit means to take a course without receiving college credit or a grade.
Courses taken on this basis are not included in the computation of cumulative
grade point average and are not applicable to graduation requirements. An audit
cannot be reversed once the semester is in session. Courses taken for audit are not covered by Financial Aid or used for calculating course load.
</p>
<p>				
**** A student may elect the S/U grading option in no more than three courses for
the associate’s degree and not more than one course a semester. The S/U option cannot be reversed to a letter grade once the semester is in session. The S/U option for credit may be used only for electives within a degree or certificate program. S means satisfactory and indicates credit was earned. U means unsatisfactory and indicates no credit was earned.
</p>
<p>				
****** Failure to withdraw from a course or courses will result in an F grade(s).
</p>
<p>				
Registration schedule may be staggered to allow easy access for all students.
</p>
<p>				
University Partnership colleges and universities follow the academic calendar of their institution found in their individual college Catalog and website.
</p>	
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>	
</div>
<?php get_footer(); ?>
