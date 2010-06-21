<?php 
/**
 * Search Widget Class
 */
class wb_entrymeta extends WP_Widget {
    /** constructor */
    function wb_entrymeta() {
		$widget_ops = array('classname' => 'wb_entrymeta', 'description' => __( 'Entry Meta' ) );
		$this->WP_Widget('wb-entrymeta', __('Entry Meta'), $widget_ops);
		$this->alt_option_name = 'wb_entrymeta';	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );

		echo $before_widget;		
		if (!empty($instance['title']))
			echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
				
				// TODO. finish this code.
				
		echo $after_widget; 
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
		echo "This widget has no options.";
    }

} 

// register widget
add_action('widgets_init', create_function('', 'return register_widget("wb_entrymeta");'));