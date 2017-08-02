<?php
/**
 * Template Name: Week
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

	<div class="small-12 medium-12 large-12 columns">
	<!--<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">-->
	<?php
			//			while ( have_posts() ) : the_post();
					//		get_template_part( 'template-parts/content', 'eventscalendar' );
					//endwhile; // End of the loop.
						?>
	<!--	</main> #main -->
	<!--</div> #primary -->

	<?php 
$myvar = get_query_var('d');
   //parse_str($_SERVER['QUERY_STRING']);  
 if($myvar != ''){
	$date=strtotime($myvar);
				$month=date("m",$date);
				$day=date("j",$date);
				$year=date("Y",$date);
	}elseif ($m == ""){  
    $dateComponents = getdate();
    $month = $dateComponents['mon'];
    $year = $dateComponents['year'];
				$day = $dateComponents['mday'];
   } else {
     $month = $m;
     $year = $y;
     $day =$d;
   }

$monthString = array();
$dateArray = array();

?>
<?php 	$lastdate =  $year.'-'.$month.'-'.$day; ?>
	<div class="small-12 medium-12 large-12 columns nopadding ">
				<?php
				// What is the first day of the month in question?
					$firstDayOfMonth = mktime(0,0,0,$month,1,$year);
	// Retrieve some information about the first day of the
 // month in question.
     $dateComponents = getdate($firstDayOfMonth);			
		// What is the name of the month in question?
  $monthName = $dateComponents['month'];		
		
							echo	'<h1>LCCC Events for the week of '.$monthName.' '.$day.', '.$year.'</h1>';			
				
				?>
				
				
				
			<a class="hide-for-print" href='calendar/?d=<?php echo $lastdate;?>'><-- Back To The Calendar</a><br />	
<div class="small-up-1 medium-up-3 large-up-3 hide-for-print">		
					<div class="column column-block">
							<?php
							 do_action( 'lccc_prev_week',$year, $month, $day);
						?>
	</div>
						<div class="column column-block"><div style='display:inline-block;'>&nbsp;</div><div style='text-align:center;'><a href="week">Today</a></div></div>
	
						<div class="column column-block"><?php do_action( 'lccc_next_week',$year, $month, $day); ?></div>
</div>
</div>
			<div class="small-12 medium-12 large-12 columns nopadding">
<?php
	
	// How many days does this month contain?
					$numberDays = date('t',$firstDayOfMonth);
     $daydisplaycounter = '';
				
//Code for calling functions to generate page
do_action('lccc_week',$month,$year,$day);
	
				
if($day+7 > $numberDays){				
		//Test to see if the week rolls over into the next month
							$nxtmonth = $month+1;	
							$nxtday = 1;
								if ($nxtmonth == 13){
										$nxtyear = $year;
									 $nxtmonth = 1;
										$year ++;
									}			
//If the week rolls over into a new month the below functions generates the list of events starting the 1st of the next month
							do_action('lccc_add_to_list',$nxtmonth,$nxtyear,$nxtday);
}
?>
		</div>
		
</div>
<?php
 //Jetpack Sharing Buttons
if ( function_exists( 'sharing_display' ) ) {
    sharing_display( '', true );
}
 ?>
</div>
<?php get_footer(); ?>

