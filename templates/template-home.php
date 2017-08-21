<?php
/*
Template Name: Home
*/
?>


<?php get_header(); ?>

<div id="home-content">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<?php get_template_part( 'template-parts/home', 'banner' ); ?>
	
	<main id="main" role="main">
	
		<?php 
		
		get_template_part( 'template-parts/home', 'cards' ); 
		
		get_template_part( 'template-parts/content', 'shadow-divider' );
		
		get_template_part( 'template-parts/home', 'cool' );
		
		get_template_part( 'template-parts/content', 'shadow-divider' );
		
		get_template_part( 'template-parts/home', 'connect' );
		
		get_template_part( 'template-parts/home', 'events' );
		
		get_template_part( 'template-parts/content', 'shadow-divider' );
		
		get_template_part( 'template-parts/home', 'news' );
		
		?>
	
	</main> <!-- end #main -->
	
	<?php endwhile; endif; ?>

</div> <!-- end #home-content -->

<?php get_footer(); ?>