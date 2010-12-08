<ul id="featured-posts">
	<?php while ( have_posts() ) : the_post(); ?>				
	<li class="fpost"><span class="fpost-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></li>
	<?php endwhile; ?>
</ul>
<div class="clear"></div>