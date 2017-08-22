<div class="column row no-js">

	<div class="top-bar">
	
		<div class="top-bar-title">
		
			<a href="<?php echo home_url(); ?>" title="Link to Homepage"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/LCCC-Campana-logo.svg" alt="Campana Center for Ideation and Invention of Lorain County Community College" class="logo" height="64" width="254" /></a>
			
		</div>
		
		<div class="top-bar-right full-top-bar show-for-large">
		
			<div class="top-nav-container clearfix">
			
				<div class="float-right">
				
					<?php campana_top_nav(); ?>
					
				</div>
				
				<?php if( is_active_sidebar('lccc-search-sidebar') ) : ?>
				
				<div class="float-right search-container">
				
					<?php dynamic_sidebar('lccc-search-sidebar'); ?>
				
				</div>
				
				<?php endif; ?>

				
			</div>
			
			<div class="main-nav-container clearfix">
			
				<div class="float-right">
				
					<?php campana_main_nav(); ?>
					
					<?php echo do_shortcode('[do_widget id=cgs-widget-2]'); ?>
					
				</div>
							
			</div>
			
		</div>
		
		<div class="top-bar-right float-right offcanvas-top-bar hide-for-large text-right">
		
			<button class="menu-icon dark" type="button" data-toggle="offCanvas"></button>
			
		</div>
		
	</div>
</div>