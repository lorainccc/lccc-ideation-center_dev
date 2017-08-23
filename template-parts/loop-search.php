<article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?> role="article" itemscope itemtype="http://schema.org/Article">

	<header class="article-header">
	
		<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><span itemprop="name"><?php the_title(); ?></span></a></h2>
	
	</header>
	
	<section class="entry-content" itemprop="articleBody">
	
		<?php the_excerpt(); ?>
		
	</section>

</article>