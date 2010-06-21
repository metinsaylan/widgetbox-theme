<?php ?>
	<div class="post_share_inline">
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
		<div class="clear"></div>
</div>