<?php 

/** SHAILAN THEME FRAMEWORK 
 File 		: stf-adsense.php
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.1
 Contact	: metinsaylan (at) gmail (dot) com
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
			'banner' => array(
				'name'=>'Banner',
				'key'=>'banner',
				'classname'=>'banner',
				'script'=>' google_ad_width = 468; google_ad_height = 60; ' ),
			'htext' => array(
				'name'=>'Horizontal Text Links',
				'key'=>'htext',
				'classname'=>'horizontal-links',
				'script'=>' google_ad_width = 468; google_ad_height = 15; ' ),
			'vtext' => array(
				'name'=>'Vertical Text Links',
				'key'=>'vtext',
				'classname'=>'vertical-links',
				'script'=>'' ),
			'square200' => array(
				'name'=>'Square 200x200',
				'key'=>'square200',
				'classname'=>'square_200',
				'script'=>' google_ad_width = 200; google_ad_height = 200; ' ),
			'rectangle300' => array(
				'name'=>'Rectangle 300x250',
				'key'=>'rectangle300',
				'classname'=>'rectangle_300',
				'script'=>' google_ad_width = 300; google_ad_height = 250; ' )
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
		
		
		if(!empty($slot)){
			$ad_slot = ' google_ad_slot = "'.$slot.'"; ';
		} else {
			$ad_slot = "";
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
		<p><small>Powered by <a href="http://shailan.com/wordpress/themes/framework">Shailan Theme Framework</a></small></p>
		</div>
		
		<?php
    }

} // class stf_adsense 

add_action('widgets_init', create_function('', 'return register_widget("stf_adsense");'));

} // class exist check
