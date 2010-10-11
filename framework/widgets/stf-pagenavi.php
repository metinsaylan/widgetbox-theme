<?php 
class stf_pagenavi extends WP_Widget {
    /** constructor */
    function stf_pagenavi() {
		$widget_ops = array('classname' => 'stf-pagenavi', 'description' => __( 'Pagination by LesterChan' ) );
		$this->WP_Widget('stf-pagenavi', __('Pagenavi'), $widget_ops);
		$this->alt_option_name = 'stf_page_navi';	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
				
        echo $before_widget;		
		if ( $title )
			echo $before_title . $title . $after_title;
				
			if(function_exists('wp_pagenavi')) {
				wp_pagenavi(); 
			} else { 
				if(current_user_can('edit_plugins')){
					echo "<p class='warning'>You don't have <a href=\"http://wordpress.org/extend/plugins/wp-pagenavi/\">wp-pagenavi</a> installed. Please install it first to use this widget.</p>"; }
			}
				
			echo $after_widget; 
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
		if(function_exists('wp_pagenavi')) {
			echo "This widget has no options.";
		} else { 
			echo "You don't have <a href=\"http://wordpress.org/extend/plugins/wp-pagenavi/\">wp-pagenavi</a> installed. Please install it first to use this widget."; 
		}		
		
		stf_widget_footer();
    }

} 

// register widget
add_action('widgets_init', create_function('', 'return register_widget("stf_pagenavi");'));