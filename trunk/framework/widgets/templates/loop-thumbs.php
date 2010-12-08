<ul id="featured-posts">
	<?php while ( have_posts() ) : the_post(); ?>				
	<li class="fpost">		
	<div class="fpost-thumbnail">
		<a href="<?php the_permalink(); ?>" rel="bookmark" >
			<?php /* the current post has a thumbnail */
				if( has_post_thumbnail() ){
					$thumb_id = get_post_thumbnail_id();
					$alt = the_title('','',false);
					/* $src = wp_get_attachment_url($thumb_id);	*/
					echo get_image_tag($thumb_id, $alt, $alt, $thumbnail_align, $thumbnail_size);
				} else {
					echo '<img src="'.get_bloginfo('template_directory').'/images/default-'.$thumbnail_size.'.png" title="'.the_title('','',false).'" width="'.$w.'" height="'.$h.'" class="align'.$thumbnail_align.' size-'.$thumbnail_size.'" />';
				} ?>
		</a>
	</div>
	<span class="fpost-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
	</li>
	<?php endwhile; ?>
</ul>
<div class="clear"></div>