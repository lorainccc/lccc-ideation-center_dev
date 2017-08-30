		<?php if( has_category() || has_tag() ) : ?>
		
		<div class="post-taxonomies">
		
			<?php if( has_category() ) : ?>
		
			<span class="categories"><?php the_category(',', 'multiple'); ?></span>
			
			<?php endif; ?>
			
			<?php if( has_category() && has_tag() ) : echo '<span class="taxonomy-divider">|</span>'; endif; ?>
			
			<?php if( has_tag() ) : ?>
		
			<span class="tags"><?php the_tags('', ', ', ''); ?></span>
			
			<?php endif; ?>
		
		</div>
		
		<?php endif; ?>
