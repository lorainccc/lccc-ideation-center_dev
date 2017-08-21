<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
	<header class="article-header">	
	
		<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
		
		<?php get_template_part( 'template-parts/content', 'taxonomy-links' ); ?>
   
    </header> <!-- end article header -->
					
    <section class="entry-content" itemprop="articleBody">
    
		<?php 
		
		if( has_post_thumbnail() ) : 
		
			the_post_thumbnail('full'); 
		
		endif;
		
		the_content(); 
		
		?>
	</section> <!-- end article section -->
						
	<?php comments_template(); ?>	
													
</article> <!-- end article -->