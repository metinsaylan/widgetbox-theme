<?php 

class wb_comments extends WP_Widget {

    function wb_comments() {
		$widget_ops = array('classname' => 'wb_comments', 'description' => __( 'Widgetbox comments widget' ) );
		$this->WP_Widget('wb-comments', __('Comments'), $widget_ops);
		$this->alt_option_name = 'wb_comments';	
    }
	
    function widget($args, $instance) {	
        extract( $args );

		echo $before_widget;		
		if (!empty($instance['title']))
			echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
			
		if(is_single() || is_page()){
			?> 
				<div class="comments">
					<?php comments_template(); ?>
				</div>		
			<?php
		}

		echo $after_widget; 
		
    }

    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    function form($instance) {		
		echo "This widget has no options bro ;) Edit your comments template if you don't like the view.";
    }

} add_action('widgets_init', create_function('', 'return register_widget("wb_comments");'));