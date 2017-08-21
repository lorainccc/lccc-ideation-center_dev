<?php
/*
Template Name: Audience
*/
?>


<?php get_header(); ?>

<div id="audience-content">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<main id="main" role="main">
	
		<?php 
		
		get_template_part( 'template-parts/content', 'banner' );
		
		get_template_part( 'template-parts/audience', 'overview' ); 
		
		get_template_part( 'template-parts/content', 'shadow-divider' );
		
		get_template_part( 'template-parts/audience', 'programs' );
		
		get_template_part( 'template-parts/content', 'shadow-divider' );
		
		get_template_part( 'template-parts/audience', 'creating');
		
		get_template_part( 'template-parts/content', 'shadow-divider' );
		
		get_template_part( 'template-parts/content', 'tour' );
		
		?>
	
	</main> <!-- end #main -->
	
	<?php endwhile; endif; ?>

</div> <!-- end #overview-content -->

<?php get_footer(); ?>