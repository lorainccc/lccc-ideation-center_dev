<?php

// if is news archive page
if( is_home() ) :

$blog_archive_id = get_option('page_for_posts');
$intro_heading = get_field('intro_heading', $blog_archive_id);
$intro_subheading = get_field('intro_subheading', $blog_archive_id); 
$intro_paragraph = get_field('intro_paragraph', $blog_archive_id);

// if is events archive page
elseif( is_post_type_archive('lccc_events') ) :

$intro_heading = get_field('events_intro_heading', 'option');
$intro_subheading = get_field('events_intro_subheading', 'option'); 
$intro_paragraph = get_field('events_intro_paragraph', 'option');

else :

$intro_heading = get_field('intro_heading');
$intro_subheading = get_field('intro_subheading'); 
$intro_paragraph = get_field('intro_paragraph');

endif;

if( $intro_heading || $intro_subheading || $intro_paragraph ) :

?>

<div class="row section-title-row">

	<div class="small-12 columns text-center standard-intro">
	
		<?php

		if( $intro_heading ) :
		
			echo '<h2>' . $intro_heading . '</h2>';
		
		endif;
		
		if( $intro_subheading ) :
		
			echo '<h2 class="h2-subheading">' . $intro_subheading . '</h2>';
		
		endif;
		
		if( $intro_paragraph ) :
		
			echo $intro_paragraph;
		
		endif;

		?>
	
	</div>

</div>

<?php get_template_part('template-parts/content', 'shadow-divider'); ?>

<!--<div class="row">

	<div class="small-12 columns">
	
		<div class="intro-divider"></div>
	
	</div>

</div>-->

<?php endif; ?>