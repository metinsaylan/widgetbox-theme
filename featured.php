<?php if (is_home()) { // show the popular posts and slider if(is_home() ?>

<!-- Begin Home page Slider -->
<div id="slider_wrap">

<div class="popular-post">
	<?php // ADD YOUR POPULAR POSTS SCRIPT HERE, OR OTHERWISE WIDGETIZE THIS SECTION ?>
</div>

<div id="featured">

	<div class="slides">
		<ul>
			<?php
			$featuredPosts = new WP_Query('showposts=5&cat=1');
			
				while ($featuredPosts->have_posts()) : $featuredPosts->the_post(); // loop for posts
			?>
				<li id="slide-<?php echo $i++; ?>" class="featured-slide clearfix">

					<div class="postsnip">
					
					<div class="thumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" >
							<?php // the current post has a thumbnail
								the_post_thumbnail(array(200,200)); ?>
						</a>
					</div>
					
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo substr($post->post_title,0,30); // short title ?>...</a></h2>
						<?php the_excerpt(); // show shortened excerpt ?>...
					</div>
				
					

					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/read-more.png" alt="<?php the_title(); ?>" title="Read more: <?php the_title(); ?>" id="readmore" /></a>

				</li>

				<?php endwhile; ?>
	  </ul>
	</div>
	
	<div id="controls" style="text-align:center;margin:auto;width:300px"> 
        <a href="#"><span id="prev">Prev</span></a> <ul id="nav"></ul> <a href="#"><span id="next">Next</span></a> 
    </div> 
</div>

</div>

<!--/End homepage Slider-->
<?php } // end if(is_home() ?>