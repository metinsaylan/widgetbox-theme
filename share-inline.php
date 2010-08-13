<?php ?>
<div class="share wide">
	<div class="button">
		<a href="http://twitter.com/share?url=http://www.labnol.org/internet/twitter-links-for-wordpress-and-blogger/7995/&text=Twitter%20Tip:%20Add%20a%20%E2%80%98Tweet%20This%E2%80%99%20Link%20to%20your%20Blog%20on%20WordPress%20or%20Blogger&via=labnol_BLOG&related=labnol" class="tweet">tweet</a>
	</div>
				
	<div class="button">

	</div>
			
	<div class="button">
		<a title="Post to Google Buzz" class="buzz" href="http://www.google.com/buzz/post" data-button-style="small-count" data-url="<?php echo get_permalink(); ?>" data-imageurl="<?php if(has_post_thumbnail()){ $image = wp_get_attachment_image_src(get_post_thumbnail_id()); echo $image[0]; } ?>">buzz</a>
	</div>
				
	<div class="button">
		<a class="digg" href="http://digg.com/submit?url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" rev="design, news, tech_news">digg</a>
	</div>
	<div class="clear"></div>
</div>