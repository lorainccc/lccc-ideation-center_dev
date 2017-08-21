<article id="post-<?php the_ID(); ?>" <?php post_class('blog-archive-item'); ?> role="article" itemscope itemtype="http://schema.org/Article">

	<header class="article-header">
	
		<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><span itemprop="name"><?php the_title(); ?></span></a></h2>
		
		<?php get_template_part( 'template-parts/content', 'taxonomy-links' ); ?>
	
	</header>
	
	<section class="entry-content" itemprop="articleBody">
	
		<?php the_excerpt(); ?>
		
		<a class="read-more" href="<?php the_permalink(); ?>" title="Read full post">Read More &raquo;</a>
	
	</section>

</article>