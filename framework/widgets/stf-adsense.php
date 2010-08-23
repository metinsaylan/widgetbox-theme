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
    }

    function widget($args, $instance) {		
        extract( $args );
		$type = $instance['type'];
		$msg = '';
		
		$ads_id = get_option('shailan_adsense_id');
		if(empty($ads_id)){
			$msg = "<div class='warning'>Please enter your google ads id in your theme options panel.</div>";
			$ads_id = "pub-7680110371269676"; 
		}

		echo $before_widget;		
		if (!empty($instance['title']))
			echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
		
		$ads_color_scheme = get_option('shailan_adsense_colors');
		
		if(empty($ads_color_scheme)){
			$ads_color_scheme = 'google_color_border = ["222222","333333"];
			google_color_link = ["3399CC"];
			google_color_url = ["999999","888888","555555"];
			google_color_text = ["999999", "888888"];
			google_color_bg = ["222222", "333333", "272727", "2D2D2D"];';
		} 
			
		switch($type){
						case 'textlinks':
							echo '<div class="adsense textlinks"><script type="text/javascript"><!--
google_ad_client = "'.$ads_id.'";
/* m2-entry-top */
google_ad_slot = "6472652245";
google_ad_width = 468;
google_ad_height = 15;

'.$ads_color_scheme.'

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

'.$ads_color_scheme.'

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

'.$ads_color_scheme.'

//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>' . $msg;
					
					}		
				
			echo $after_widget; 
    }

    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

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
			
		<div class="widget-control-actions">
		<p><small>Powered by <a href="http://shailan.com/wordpress/themes/exhibit">Exhibit</a></small></p>
		</div>
		
		<?php
    }

} 

add_action('widgets_init', create_function('', 'return register_widget("stf_adsense");'));