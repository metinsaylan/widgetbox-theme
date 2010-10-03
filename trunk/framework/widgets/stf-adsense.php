<?php 
/*
Plugin Name: Adsense Widget
Plugin URI: http://shailan.com/wordpress/plugins/adsense-widget
Description: Easy to use google adsense widget. It provides a simple to control interface. You can use it as many times as you like on all sidebar areas in your theme. 
Version: 1.0
Author: Matt Say
Author URI: http://shailan.com
*/

if(!class_exists('stf_adsense')){
class stf_adsense extends WP_Widget {
    function stf_adsense() {
		$widget_ops = array('classname' => 'stf-adsense', 'description' => __( 'Google adsense widget' ) );
		$this->WP_Widget('stf-adsense', __('Adsense'), $widget_ops);
		$this->alt_option_name = 'stf_adsense';	
		
		$this->widget_defaults = array(
			'title' => '',
			'slot' => '',
			'channel'	=> '',
			'type' => 'banner'
		);
		
		$this->ad_types = array(
			'leaderboard' => array(
				'name'=>'Leaderboard (728 x 90)',
				'key'=>'leaderboard',
				'classname'=>'leaderboard',
				'script'=>' google_ad_width = 728; google_ad_height = 90; google_ad_format = "728x90_as"; '
			),
			'banner' => array(
				'name'=>'Banner (468x60)',
				'key'=>'banner',
				'classname'=>'banner',
				'script'=>' google_ad_width = 468; google_ad_height = 60; google_ad_format = "468x60_as"; ' ),
			'half-banner' => array(
				'name'=>'Half Banner (234x60)',
				'key'=>'half-banner',
				'classname'=>'half_banner',
				'script'=>' google_ad_width = 234; google_ad_height = 60; google_ad_format = "234x60_as"; ' ),
			'button' => array(
				'name'=>'Button (125x125)',
				'key'=>'button',
				'classname'=>'button',
				'script'=>' google_ad_width = 125; google_ad_height = 125; google_ad_format = "125x125_as"; ' ),
			'skyscraper' => array(
				'name'=>'Skyscraper (120x600)',
				'key'=>'skyscraper',
				'classname'=>'skyscraper',
				'script'=>' google_ad_width = 120; google_ad_height = 600; google_ad_format = "120x600_as"; ' ),
			'wide-skyscraper' => array(
				'name'=>'Wide Skyscraper (160x600)',
				'key'=>'wide-skyscraper',
				'classname'=>'wide_skyscraper',
				'script'=>' google_ad_width = 160; google_ad_height = 600; google_ad_format = "160x600_as"; ' ),
			'vertical-banner' => array(
				'name'=>'Vertical Banner (120 x 240)',
				'key'=>'vertical-banner',
				'classname'=>'vertical_banner',
				'script'=>' google_ad_width = 120; google_ad_height = 240; google_ad_format = "120x240_as"; ' ),			
			'small-rectangle' => array(
				'name'=>'Small Rectangle (180x150)',
				'key'=>'small-rectangle',
				'classname'=>'small_rectangle',
				'script'=>' google_ad_width = 180; google_ad_height = 150; google_ad_format = "180x150_as"; ' ),			
			'small-square' => array(
				'name'=>'Small Square (200 x 200)',
				'key'=>'small-square',
				'classname'=>'small_square',
				'script'=>' google_ad_width = 200; google_ad_height = 200; google_ad_format = "200x200_as"; ' ),
			'square' => array(
				'name'=>'Square (250 x 250)',
				'key'=>'square',
				'classname'=>'square',
				'script'=>' google_ad_width = 250; google_ad_height = 250; google_ad_format = "250x250_as"; ' ),
			'medium-rectangle' => array(
				'name'=>'Medium Rectangle (300 x 250)',
				'key'=>'medium-rectangle',
				'classname'=>'medium_rectangle',
				'script'=>' google_ad_width = 300; google_ad_height = 250; google_ad_format = "300x250_as"; ' ),
			'large-rectangle' => array(
				'name'=>'Large Rectangle (336 x 280)',
				'key'=>'large-rectangle',
				'classname'=>'large_rectangle',
				'script'=>' google_ad_width = 336; google_ad_height = 280; google_ad_format = "336x280_as"; ' ),
			'links728' => array(
				'name'=>'Link Unit 728x15',
				'key'=>'links728',
				'classname'=>'links_728x15',
				'script'=>' google_ad_width = 728; google_ad_height = 15; google_ad_format = "728x15_0ads_al"; ' ),
			'links468' => array(
				'name'=>'Link Unit 468x15',
				'key'=>'links468',
				'classname'=>'links_468x15',
				'script'=>' google_ad_width = 468; google_ad_height = 15; google_ad_format = "468x15_0ads_al"; ' ),
			'links200' => array(
				'name'=>'Link Unit 200x90',
				'key'=>'links200',
				'classname'=>'links_200x90',
				'script'=>' google_ad_width = 200; google_ad_height = 90; google_ad_format = "200x90_0ads_al"; ' ),
			'links180' => array(
				'name'=>'Link Unit 180x90',
				'key'=>'links180',
				'classname'=>'links_180x90',
				'script'=>' google_ad_width = 180; google_ad_height = 90; google_ad_format = "180x90_0ads_al"; ' ),
			'links160' => array(
				'name'=>'Link Unit 160x90',
				'key'=>'links160',
				'classname'=>'links_160x90',
				'script'=>' google_ad_width = 160; google_ad_height = 90; google_ad_format = "160x90_0ads_al"; ' ),
			'links120' => array(
				'name'=>'Link Unit 120x90',
				'key'=>'links120',
				'classname'=>'links_120x90',
				'script'=>' google_ad_width = 120; google_ad_height = 90; google_ad_format = "120x90_0ads_al"; ' )
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
		
		
		if(!empty($slot) && $slot != ""){
			$ad_slot = ' google_ad_slot = "'.$slot.'"; ';
		} else {
			$ad_slot = "\n\t /* ad slot is empty */ ";
			// If slot is empty use template colors
			$ad_colors = get_option('shailan_adsense_colors');
			if(empty($ad_colors)){
				$ad_colors = "/* adcolors not defined */";
			} 
		}
			
		if(!empty($channel)){
			$ad_channel = ' google_ad_channel = "'.$channel.'"; ';
		} else { $ad_channel = "/* ad channel is empty */"; }
		
		$ad = $this->ad_types[$type];
		$ad_class = $ad['classname'];
		$ad_size = $ad['script'];		

		// Echo adsense code
		echo "<div class=\"adsense ".$ad_class."\"><script type=\"text/javascript\"><!--
google_ad_client = \"".$ads_id."\";";
		echo "\n\t" . $ad_size;
		echo "\n\t" . $ad_slot;
		echo "\n\t" . $ad_channel;
		echo "\n\t" . $ad_colors;
		echo "\n\t //-->
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
		
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title :', 'stf'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label><br /> 
		
		<p><label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Ad type:'); ?><select name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>" >
		 <?php 
		  foreach ($this->ad_types as $key=>$ad) {  
			$option = '<option value="'.$ad['key'] .'" '. ( $ad['key'] == $type ? ' selected="selected"' : '' ) .'>';
			$option .= $ad['name'];
			$option .= '</option>\n';
			echo $option;
		  }
		 ?>
		</select></label></p>	
		
		<p><label for="<?php echo $this->get_field_id('slot'); ?>"><?php _e('Slot ID :', 'stf'); ?> <input class="widefat" id="<?php echo $this->get_field_id('slot'); ?>" name="<?php echo $this->get_field_name('slot'); ?>" type="text" value="<?php echo $slot; ?>" /></label><br /> 
			
		<p><label for="<?php echo $this->get_field_id('channel'); ?>"><?php _e('Channel ID :', 'stf'); ?> <input class="widefat" id="<?php echo $this->get_field_id('channel'); ?>" name="<?php echo $this->get_field_name('channel'); ?>" type="text" value="<?php echo $channel; ?>" /></label><br /> 
			
		<div class="widget-control-actions">
		<p><small>Powered by <a href="http://shailan.com/wordpress/plugins/adsense">Shailan</a></small></p>
		</div>
		
		<?php
    }

} // class stf_adsense 

add_action('widgets_init', create_function('', 'return register_widget("stf_adsense");'));

} // class exist check
