<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package LCCC Framework
 */


$footer_contact_section_heading = get_field('footer_contact_section_heading', 'option');
$street_address = get_field('street_address', 'option');
$city = get_field('city', 'option');
$state = get_field('state', 'option');
$zipcode = get_field('zipcode', 'option');
$phone_number = get_field('phone_number', 'option');
$email = get_field('email', 'option');
$map_and_directions_label = get_field('map_and_directions_label', 'option');
$google_maps_link = get_field('google_maps_link', 'option');
$twitter_handle = get_field('twitter_handle', 'option');
$twitter_url = get_field('twitter_url', 'option');
$instagram_handle = get_field('instagram_handle', 'option');
$instagram_url = get_field('instagram_url', 'option');
$facebook_handle = get_field('facebook_handle', 'option');
$facebook_url = get_field('facebook_url', 'option');


?>

					</div><!-- #content -->

					<footer role="contentinfo">
					
						<div class="footer-inner row text-center medium-text-left">
						
							<div class="small-12 medium-4 columns">
							
								<img class="footer-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/LCCC-Campana-logo-white.png" alt="Campana Center for Ideation adn Invention of Lorain County Community College" />
								
								<?php if( $twitter_url || $instagram_url || $facebook_url ) : ?>
								
								<h2>Connect with Campana</h2>
								
								<ul class="footer-sm-links menu">
								
									<?php if( $twitter_url ) : ?>
									
									<li><a href="<?php echo $facebook_url; ?>" title="Follow Campana Center of Ideation and Invention on Facebook" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/facebook_white.svg" alt="Facebook icon" height="30" width="30" /></a></li>
									
									<li><a href="<?php echo $twitter_url; ?>" title="Follow Campana Center of Ideation and Invention on Twitter" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/twitter_white.svg" alt="Twitter icon" height="30" width="30" /></a></li>
									
									<li><a href="<?php echo $instagram_url; ?>" title="Follow Campana Center of Ideation and Invention on Instagram" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/instagram_white.svg" alt="Instagram icon" height="30" width="30" /></a></li>
									
									<?php endif; ?>
									
								</ul>
								
								<?php endif; ?>
							
							</div>
							
							<div class="small-12 medium-4 columns">
							
								<h2><?php echo $footer_contact_section_heading; ?></h2>
								
								<div class="footer-contact-info">
								
									<div class="street-address"><?php echo $street_address; ?></div>
									
									<div class="locale-region"><?php echo $city . ', ' . $state . ' ' . $zipcode; ?></div>
									
									<div class="phone"><?php echo $phone_number; ?></div>
									
									<div class="email"><a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a></div>
									
									<div class="map-link"><a href="<?php echo $google_maps_link; ?>" target="_blank" title="Get Direction to <?php echo $footer_contact_section_heading; ?>"><?php echo $map_and_directions_label; ?></a></div>
								
								</div>
								
							</div>
							
							<div class="small-12 medium-4 columns">
							
								<h2>Quick Links</h2>
								
								<?php campana_footer_nav(); ?>
							
							</div>
							
						</div> <!-- end .footer-inner -->

					</footer>

				</div><!-- #page -->
				
			</div> <!-- end .off-canvas-content -->
			
		</div> <!-- end .off-canvas-wrapper-inner -->
		
	</div> <!-- end .off-canvas-wrapper -->
	
<?php wp_footer(); ?>

</body>
</html>
