<?php

$event_cat_list_heading = get_field('event_cat_list_heading', 'option');
$event_cats = get_terms('event_categories');

if( $event_cats && !is_wp_error( $event_cats ) ) :

?>
	
<div class="sidebar-widget">

	<?php

		if( $event_cat_list_heading ) :

			echo '<h2 class="widget-title">' . $event_cat_list_heading . '</h2>';

		endif;

	?>

	<ul>

	<?php 

	foreach( $event_cats as $cat ) : 

		if( $cat->count > 0 ) :

		?>

		<li><a href="<?php echo get_term_link( $cat->slug, 'event_categories'); ?>"><?php echo $cat->name; ?></li>

	<?php endif; endforeach; ?>

	</ul>
	
</div>

<?php endif; ?>