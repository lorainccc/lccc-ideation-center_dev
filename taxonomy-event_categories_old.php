<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package LCCC Framework
 */
get_header(); ?>
<div class="row page-content">
<div class="small-12 medium-12 large-12 columns nopadding show-for-small-only">
  <div class="row show-for-small-only sub-mobile-menu-row" style="background:#000;">
 <div class="small-2 columns" style="padding-top: 0.5rem;padding-left: 1.625rem;"> <span data-responsive-toggle="sub-responsive-menu" data-hide-for="medium">
      <button class="menu-icon" type="button" data-toggle></button>
      </span> </div>
    <div class="small-10 columns nopadding"><h3 class="sub-mobile-menu-header" style="color:#ffffff;">Events Menu</h3></div>
  </div>
  <div id="sub-responsive-menu" class="show-for-small-only">
    <ul class="vertical menu" data-drilldown data-parent-link="true">

					<?php 	wp_nav_menu(array(
													'container' => false,
													'menu' => __( 'Drill Menu', 'textdomain' ),
													'menu_class' => 'vertical menu',
										'theme_location' => 'left-nav',
													'menu_id' => 'sub-mobile-primary-menu',
														//Recommend setting this to false, but if you need a fallback...
													'fallback_cb' => 'lc_drill_menu_fallback',
													'walker' => new lc_drill_menu_walker(),
												));
					?>

    </ul>
  </div>
</div>
<div class="small-12 medium-12 large-12 columns breadcrumb-container">
   <?php get_template_part( 'template-parts/content', 'breadcrumb' ); ?>
</div>
<div class="medium-4 large-4 columns hide-for-small-only">
	<div class="small-12 medium-12 large-12 columns sidebar-widget">
		<div class="small-12 medium-12 large-12 columns sidebar-menu-header">
<h3><?php echo bloginfo('the-title'); ?></h3>
		</div>
	<?php	if ( has_nav_menu( 'left-nav' ) ) : ?>
<div id="secondary" class="medium-12 columns secondary nopadding">
		<?php if ( has_nav_menu( 'left-nav' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php
					// Primary navigation menu.
					wp_nav_menu( array(
						'menu_class'     => 'nav-menu',
						'theme_location' => 'left-nav',
					) );
				?> 
			</nav><!-- .main-navigation -->
				<?php endif; ?>
		</div> 
		<?php endif; ?>
	</div>
	</div>
	<div class="small-12 medium-8 large-8 columns page-container">		
<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<?php 
			// get the currently queried taxonomy term, for use later in the template file
$term = get_queried_object();
			$args = array(
    'post_type' => 'lccc_events',
    'event_categories' => $term->slug,
    'post_status' => 'publish',
    'order'=> 'ASC',
    'orderby'=> 'meta_value',
    'meta_key' => 'event_start_date',
);
$query = new WP_Query( $args );
	if ($query->have_posts()):
         
    // output the term name in a heading tag                
    echo '<h1>' . $term->name . ' Events </h1>';
			
				// output the term descriptopn in a paragraph tag
     echo '<p>' . $term->description . '</p>';

			// output the link to the page that contains the Category Description
			$siteurl= get_site_url();
			echo '<a class="button" href="'.$siteurl.'/' . $term->slug .'">'. 'Learn More</a>';
			
     
        // Start the Loop
        while ( $query->have_posts() ) : $query->the_post(); 
 
  $starteventdate = 
			event_meta_box_get_meta('event_start_date');
		$starteventtime = event_meta_box_get_meta('event_start_time');  
		$endeventdate = event_meta_box_get_meta('event_end_date');
		$endtime = event_meta_box_get_meta('event_end_time');
		

										$starttimevar=strtotime($starteventtime);
										$starttime=	date("g:i a",$starttimevar);
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
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="small-12 medium-2 large-2 columns">
	<?php
			echo '<div class="small-12 medium-12 large-12 columns event-date">';
         echo '<div class="small-12 medium-12 large-12 columns calender">';                
										echo '<p class="stocker-month">'.$eventstartmonth.'</p>';
										echo '<p class="stocker-day">'.$eventstartday.'</p>';
						echo '</div>';
			echo '</div>';	
		?>
 </div>
	<div class="small-12 medium-10 large-10 columns nopadding">
	<div class="small-12 medium-12 large-12 columns nopadding">
		<header class="entry-header">
        <a href="<?php the_permalink();?>"><?php the_title( '<h2 class="entry-title">', '</h2>' ); ?></a>
       <div class="taxonomies">
	<?php echo get_the_term_list( $post->ID, 'event_categories', '', ' , ' , ''); ?>
</div>
        <p><?php echo 'Date: '.$eventstartmonthfull.' '.$eventstartday.', '.$eventstartyear; ?></p>
        <p><?php echo 'Time: '.$starttime; ?></p>
          <p><?php echo 'Location: '.$location; ?></p>
        <p><?php echo 'Cost: '.$cost; ?></p>
        <p>&nbsp;</p>
 
	</header><!-- .entry-header -->
	</div>
	<div class="small-12 medium-12 large-12 columns nopadding">
	<div class="entry-content">
		<?php
			the_excerpt();
		?>
	<a class="button" href="<?php the_permalink();?>">More Information</a>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lorainccc' ),
				'after'  => '</div>',
			) );
		?>
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
</div>
	</article><!-- #post-## -->
<div class="column row event-list-row">
    <hr>
  </div>
         
        <?php endwhile;
            
endif; // end of check for query having posts
     
// use reset postdata to restore orginal query
wp_reset_postdata();		
			
			?>
		
	</main><!-- #main -->
	</div><!-- #primary -->
</div>	
	
</div>
<?php get_footer(); ?>