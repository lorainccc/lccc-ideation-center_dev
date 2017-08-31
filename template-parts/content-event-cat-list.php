<?php

$event_cats = get_terms('event_categories');

if( $event_cats && !is_wp_error( $event_cats ) ) :

?>

<ul>

<?php 
	
foreach( $event_cats as $cat ) : 
	
	if( $cat->count > 0 ) :
	
	?>
	
	<li><a href="<?php echo get_term_link( $cat->slug, 'event_categories'); ?>"><?php echo $cat->name; ?></li>
	
<?php endif; endforeach; ?>

</ul>

<?php endif; ?>