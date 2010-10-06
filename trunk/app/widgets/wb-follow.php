<?php 

class wb_follow extends WP_Widget {

    function wb_follow() {
		$widget_ops = array('classname' => 'wb_follow', 'description' => __( 'Widgetbox follow me widget' ) );
		$this->WP_Widget('wb-follow', __('Follow'), $widget_ops);
		$this->alt_option_name = 'wb_follow';	
		$this->follow_options = array(
			'rss',
			'twitter',
			'facebook'			
		);
		
    }

	
    function widget($args, $instance) {		
        extract( $args );

		echo $before_widget;		
		if (!empty($instance['title']))
			echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
			
		?> <div id="wb-follow-container"> <?php
			
			foreach($this->follow_options as $key){
				if(!empty($instance[$key])){
					echo "\n<div id=\"". $key . "\"><a href=\"". $instance[$key] ."\" rel=\"nofollow\" ></a></div>";
				}
			}
				
		?> </div> <?php

		echo $after_widget; 
		
    }

    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    function form($instance) {		

		foreach($this->follow_options as $key){
			echo '<p><label for="'.$key.'">'.ucfirst($key).':</label><input type="text" name="'. $this->get_field_name($key).'" id="'.$this->get_field_id($key).'" value="'.$instance[$key].'" class="widefat" /></p>';
		}
	
    }

} add_action('widgets_init', create_function('', 'return register_widget("wb_follow");'));