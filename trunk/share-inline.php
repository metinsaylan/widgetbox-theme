<?php ?>
<div class="share wide">
	<div class="button">
		<a href="http://twitter.com/share?url=<?php echo get_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>&via=shailan.com&related=shailan.com" class="tweet">tweet</a>
	</div>
			
	<div class="button">
		<a title="Post to Google Buzz" class="buzz" href="http://www.google.com/buzz/post" data-button-style="small-count" data-url="<?php echo get_permalink(); ?>" data-imageurl="<?php if(has_post_thumbnail()){ $image = wp_get_attachment_image_src(get_post_thumbnail_id()); echo $image[0]; } ?>">buzz</a>
	</div>
				
	<div class="button">
		<a class="digg" href="http://digg.com/submit?url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" rev="design, news, tech_news">digg</a>
	</div>
	<div class="clear"></div>
</div>