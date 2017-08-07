<div data-sticky-container class="sticky-container">
	<div data-sticky data-sticky-on="large" data-margin-top='0' data-top-anchor="50">
		<div class="column row">
			<div class="top-bar topbar-sticky-shrink">
				<div class="top-bar-title">
					<a href="<?php echo home_url(); ?>" title="Link to Homepage"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/LCCC-Campana-logo.svg" alt="Campana Center for Ideation and Invention of Lorain County Community College" height="71" width="282" /></a>
				</div>
				<div class="top-bar-right show-for-large">
					<div class="top-nav-container clearfix">
						<div class="float-right">
						<?php campana_top_nav(); ?>
						</div>
					</div>
					<div class="main-nav-container clearfix">
					<div class="float-right">
						<?php campana_main_nav(); ?>
						</div>
					</div>
				</div>
				<div class="top-bar-right float-right hide-for-large">
					<button class="menu-icon dark" type="button" data-toggle="offCanvas"></button>
				</div>
			</div>
		</div>
	</div>
</div>
