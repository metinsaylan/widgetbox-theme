<?php 

/** SHAILAN THEME FRAMEWORK 
 File 		: stf-adsense.php
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

class stf_adsense extends WP_Widget {
    function stf_adsense() {
		$widget_ops = array('classname' => 'stf-adsense', 'description' => __( 'Google adsense widget' ) );
		$this->WP_Widget('stf-adsense', __('Adsense'), $widget_ops);
		$this->alt_option_name = 'stf_adsense';	
		
		$this->widget_defaults = array(
			'title' => '',
			'channel'	=> '',
			'type' => 'banner'
		);
		
		$this->ad_types = array(
			'Banner' => '468x60',
			'Horizontal Text Links' => '468x15',
			'Vertical Text Links' => '',
			'Square 200x200' => '200x200',
			'Square 300x250' => '300x250'
		);
    }

    function widget($args, $instance) {		
		extract( $args );
		$widget_options = wp_parse_args( $instance, $this->widget_defaults );
		extract( $widget_options, EXTR_SKIP );
		
		$msg = '';
		
		$ads_id = get_option('shailan_adsense_id');
		if(empty($ads_id)){
			$msg = "<div class='warning'>Please enter your google ads id in your theme options panel.</div>";
			$ads_id = "pub-7680110371269676"; 
		}

		echo $before_widget;		
		if (!empty($instance['title']))
			echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
		
		$ad_colors = get_option('shailan_adsense_colors');
		
		if(empty($ad_colors)){
			$ad_colors = 'google_color_border = ["222222","333333"];
			google_color_link = ["3399CC"];
			google_color_url = ["999999","888888","555555"];
			google_color_text = ["999999", "888888"];
			google_color_bg = ["222222", "333333", "272727", "2D2D2D"];';
		} 
		
		if(!empty($channel)){
			$ad_channel = 'google_ad_channel = "'.$channel.'"';
		} else {
			$ad_channel = "";
		}
			
		// setup class & sizes
		switch($type){
			case 'textlinks':
				$ad_class = "textlinks";
				$ad_size = " google_ad_width = 468; google_ad_height = 15; ";
			break;						
			case 'square_200':
			case '200x200':
				$ad_class = "square-200";
				$ad_size = " google_ad_width = 200; google_ad_height = 200; ";
			break;
			case 'square_300':
			case '300x250':
				$ad_class = "square-300";
				$ad_size = " google_ad_width = 300; google_ad_height = 250; ";
			break;
			case 'banner':
			case '468x60':
			default:		
				$ad_class = "banner";
				$ad_size = " google_ad_width = 468; google_ad_height = 60; ";
		}

		// Echo adsense code
		echo "<div class=\"adsense ".$ad_class."\"><script type=\"text/javascript\"><!--
google_ad_client = \"".$ads_id."\";";
		echo "\n\t" . $ad_size;
		echo "\n\t" . $ad_channel;
		echo "\n\t" . $ad_colors;

		echo "//-->
</script>
<script type=\"text/javascript\"
src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">
</script></div>" . $msg;					
				
			echo $after_widget; 
    }

    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    function form($instance) {  
		$widget_options = wp_parse_args( $instance, $this->widget_defaults );
		extract( $widget_options, EXTR_SKIP );
		if (!empty($instance['title'])) 
			$title = esc_attr($instance['title']);
		if (!empty($instance['type'])):
			$type = $instance['type'];
		else:
			$type = null;
		endif
		
		?>
		
		<p><?php _e('Type:'); ?><br />
			<label for="textlinks">
				<input type="radio" id="textlinks" name="<?php echo $this->get_field_name('type'); ?>" value="textlinks" <?php if($type=='textlinks'){ echo 'checked="checked"'; } ?> /> <?php _e('Text links'); ?>
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
			
			
		<p><label for="<?php echo $this->get_field_id('channel'); ?>"><?php _e('Channel :', 'stf'); ?> <input class="widefat" id="<?php echo $this->get_field_id('channel'); ?>" name="<?php echo $this->get_field_name('channel'); ?>" type="text" value="<?php echo $channel; ?>" /></label><br /> 
			
		<div class="widget-control-actions">
		<p><small>Powered by <a href="http://shailan.com/wordpress/themes/framework">Shailan Theme Framework</a></small></p>
		</div>
		
		<?php
    }

} 

add_action('widgets_init', create_function('', 'return register_widget("stf_adsense");'));