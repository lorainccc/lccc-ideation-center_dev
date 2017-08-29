<?php get_header(); ?>

<div id="page-content">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<main id="main" role="main">
	
		<?php get_template_part( 'template-parts/content', 'banner' ); ?>
		
		<div class="row">
		
			<div class="small-12 columns">
			
				<?php get_template_part( 'template-parts/content', 'flexible' ); ?>
				
			</div>
					
		</div>
	
	</main> <!-- end #main -->
	
	<?php
		
	get_template_part( 'template-parts/content', 'shadow-divider' );
		
	get_template_part( 'template-parts/content', 'tour' );
		
	?>
	
	<?php endwhile; endif; ?>

</div> <!-- end #page-content -->

<?php get_footer(); ?>

