<?php get_header(); ?>

<div id="page-content">
	
	<main id="main" role="main">
	
		<?php get_template_part( 'template-parts/content', 'banner' ); ?>
		
		<div class="row">
		
			<div class="small-12 columns">
			
				<?php get_template_part( 'template-parts/content', '404' ); ?>
				
			</div>
					
		</div>
	
	</main> <!-- end #main -->
	
	<?php
		
	get_template_part( 'template-parts/content', 'shadow-divider' );
		
	get_template_part( 'template-parts/content', 'tour' );
		
	?>
	
</div> <!-- end #page-content -->

<?php get_footer(); ?>