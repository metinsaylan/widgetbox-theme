<?php 
class wb_post_navigation extends WP_Widget {
    /** constructor */
    function wb_post_navigation() {
		$widget_ops = array('classname' => 'wb-post-navigation', 'description' => __( 'Previous & Next links for home & single pages.' ) );
		$this->WP_Widget('wb-post-navigation', __('Post Navigation'), $widget_ops);
		$this->alt_option_name = 'wb_post_navigation';	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
				
        echo $before_widget;		
			
		if(is_page() || is_single()){
			?>
			
			<div class="navigation">
				<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ) ?></div>
				<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ) ?></div>
			</div>
			
			<?php
		} else {
			?>
			
			<div class="navigation">
				<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', 'sandbox' )) ?></div>
				<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', 'sandbox' )) ?></div>
			</div>
			
			<?php		
		}			
			
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
add_action('widgets_init', create_function('', 'return register_widget("wb_post_navigation");'));