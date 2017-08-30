<?php
/*
Template Name: Contact
*/
?>


<?php get_header(); ?>

<div id="full-width-content">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<main id="main" role="main">
	
		<?php 
		
		get_template_part( 'template-parts/content', 'banner' );
		
		get_template_part( 'template-parts/content', 'standard-intro' );
		
		get_template_part( 'template-parts/content', 'contact' );
		
		?>
	
	</main> <!-- end #main -->
	
	<?php endwhile; endif; ?>

</div> <!-- end #full-width-content -->

<?php get_footer(); ?>