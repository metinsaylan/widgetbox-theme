<?php 
/**
 * Search Widget Class
 */
class m2_adsense extends WP_Widget {
    /** constructor */
    function m2_adsense() {
		$widget_ops = array('classname' => 'm2-adsense', 'description' => __( 'Google adsense widget' ) );
		$this->WP_Widget('m2-adsense', __('Adsense'), $widget_ops);
		$this->alt_option_name = 'm2_adsense';	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		$type = $instance['type'];
		$msg = '';
		
		$ads_id = get_option('shailan_ads_id');
		if(empty($ads_id)){
			$msg = "<div class='warning'>Please enter your google ads id in M2 options panel.</div>";
			$ads_id = "pub-7680110371269676"; 
		}

		echo $before_widget;		
		if (!empty($instance['title']))
			echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
			
		if(empty($ads_color_scheme)){
			$ads_color_scheme = 'google_color_border = ["CDCDCD","CCCCCC"];
			google_color_link = ["0099CC","0099CC","0099CC", "CC0033"];
			google_color_url = ["444444","555555","666666"];
			google_color_text = ["222222","333333","444444"];
			google_color_bg = ["DDDDDD","EFEFEF","EEEEEE"];';
		} 
			
		switch($type){
			case 'textlinks_blue':
				echo '<div class="adsense textlinks-blue"><script type="text/javascript"><!--
google_ad_client = "'.$ads_id.'";
/* m2-header-links */
google_ad_slot = "6344144678";
google_ad_width = 468;
google_ad_height = 15;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>' . $msg;
						break;
						
						case 'textlinks_white':
							echo '<div class="adsense textlinks-white"><script type="text/javascript"><!--
google_ad_client = "'.$ads_id.'";
/* m2-entry-top */
google_ad_slot = "6472652245";
google_ad_width = 468;
google_ad_height = 15;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>' . $msg;
						break;						
						
						case 'square_200':
							echo '<div class="adsense square-200"><script type="text/javascript"><!--
google_ad_client = "'.$ads_id.'";
/* metinsaylan-sidebar */
google_ad_slot = "5557396930";
google_ad_width = 200;
google_ad_height = 200;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>' . $msg;
						break;
						
						case 'square_300':
						
						echo '<div class="adsense square-300"><script type="text/javascript"><!--
google_ad_client = "'.$ads_id.'";
/* m2-sidebar-300 */
google_ad_slot = "2490814497";
google_ad_width = 300;
google_ad_height = 250;

'.$ads_color_scheme.'

//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>' . $msg;
						break;
					
						case 'square_300x2':
						
						echo '<div class="adsense square-300">
							<div class="alignleft adunit">
						<script type="text/javascript"><!--
google_ad_client = "'.$ads_id.'";
/* m2-sidebar-300 */
google_ad_slot = "2490814497";
google_ad_width = 300;
google_ad_height = 250;

'.$ads_color_scheme.'

//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
							</div><div class="alignright adunit">
							<script type="text/javascript"><!--
google_ad_client = "'.$ads_id.'";
/* m2-sidebar-300 */
google_ad_slot = "2490814497";
google_ad_width = 300;
google_ad_height = 250;

'.$ads_color_scheme.'

//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
							</div>
</div>' . $msg;
						break;
						
						case 'banner':
						default:		
							echo '<div class="adsense banner"><script type="text/javascript"><!--
google_ad_client = "'.$ads_id.'";
/* metinsaylan-banner */
google_ad_slot = "2979957530";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>' . $msg;
					
					}		
				
			echo $after_widget; 
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {  
		if (!empty($instance['title'])) 
			$title = esc_attr($instance['title']);
		if (!empty($instance['type'])):
			$type = $instance['type'];
		else:
			$type = null;
		endif
		
		?>
		
		<p><?php _e('Type:'); ?><br />
			<label for="textlinks_blue">
				<input type="radio" id="textlinks_blue" name="<?php echo $this->get_field_name('type'); ?>" value="textlinks_blue" <?php if($type=='textlinks_blue'){ echo 'checked="checked"'; } ?> /> <?php _e('Text links (Blue Background)'); ?>
			</label> 
			<br /><label for="textlinks_white">
				<input type="radio" id="textlinks_white" name="<?php echo $this->get_field_name('type'); ?>" value="textlinks_white" <?php if($type=='textlinks_white'){ echo 'checked="checked"'; } ?> /> <?php _e('Text links (White Background)'); ?>
			</label> 
			<br /><label for="banner">
				<input type="radio" id="banner" name="<?php echo $this->get_field_name('type'); ?>" value="banner" <?php if($type=='banner'){ echo 'checked="checked"'; } ?> /> <?php _e('Banner (468x60)'); ?>
			</label> 			
			<br /><label for="square_200">
				<input type="radio" id="square_200" name="<?php echo $this->get_field_name('type'); ?>" value="square_200" <?php if($type=='square_200'){ echo 'checked="checked"'; } ?> /> <?php _e('200x200px'); ?>
			</label>
			<br /><label for="square_200x2">
				<input type="radio" id="square_200x2" name="<?php echo $this->get_field_name('type'); ?>" value="square_200x2" <?php if($type=='square_200x2'){ echo 'checked="checked"'; } ?> /> <?php _e('2ads x 200x200px'); ?>
			</label>
			<br /><label for="square_300">
				<input type="radio" id="square_300" name="<?php echo $this->get_field_name('type'); ?>" value="square_300" <?php if($type=='square_300'){ echo 'checked="checked"'; } ?> /> <?php _e('300x250px'); ?>
			</label>
			<br /><label for="square_300x2">
				<input type="radio" id="square_300x2" name="<?php echo $this->get_field_name('type'); ?>" value="square_300x2" <?php if($type=='square_300x2'){ echo 'checked="checked"'; } ?> /> <?php _e('2ads x 300x250px'); ?>
			</label>
		
		<?php
    }

} 

// register widget
add_action('widgets_init', create_function('', 'return register_widget("m2_adsense");'));