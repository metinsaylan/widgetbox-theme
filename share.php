<?php 
if(is_single() || is_page()){
			?> 
			
			<div class="post_share" _width="380">
	<div class="large-buttons">
		<div class="wdt_button"><?php if(function_exists('tweetmeme')){ echo tweetmeme(); } ?></div>
		<div class="wdt_button">
			<a name="fb_share" type="box_count" href="http://www.facebook.com/sharer.php">Share</a>
			<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
		</div>
		<div class="wdt_button">
		<a title="Post to Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="normal-count" data-url="<?php echo get_permalink(); ?>" data-imageurl="<?php if(has_post_thumbnail()){ $image = wp_get_attachment_image_src(get_post_thumbnail_id()); echo $image[0]; } ?>"></a>
<script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
		</div>
		<div class="wdt_button">
			<a class="DiggThisButton DiggMedium" href="http://digg.com/submit?url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" rev="design, news, tech_news">
			</a>
		</div>
	</div>
	
	<div class="small-buttons">
		<div class="wdt_button_min">
			<script type="text/javascript">
			tweetmeme_style = "compact";
			tweetmeme_source = 'mattsay';
			</script>
			<script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"> </script>
		</div>
		
		<div class="wdt_button_min">
<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink()); ?>&amp;layout=button_count&amp;show_faces=true&amp;width=120&amp;action=like&amp;font=segoe+ui&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe>
		</div>
		
		<div class="wdt_button_min">
		<a title="Post to Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="small-count" data-url="<?php echo get_permalink(); ?>" data-imageurl="<?php if(has_post_thumbnail()){ $image = wp_get_attachment_image_src(get_post_thumbnail_id()); echo $image[0]; } ?>"></a>
<script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
		</div>
		
		<div class="wdt_button_min">
			<a class="DiggThisButton DiggCompact" href="http://digg.com/submit?url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" rev="design, news, tech_news">
			</a>
		</div>
		
	</div>
</div>
	
			<?php
}
