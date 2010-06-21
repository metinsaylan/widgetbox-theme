<?php 
/**
 * Search Widget Class
 */
class wb_entrymeta extends WP_Widget {
    /** constructor */
    function wb_entrymeta() {
		$widget_ops = array('classname' => 'wb_entrymeta entry-meta', 'description' => __( 'Entry Meta' ) );
		$this->WP_Widget('wb-entrymeta', __('Entry Meta'), $widget_ops);
		$this->alt_option_name = 'wb_entrymeta';	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		
		if(array_key_exists('text', $instance)){
		$meta = $instance['text'];
		echo $before_widget;
			echo apply_filters('widget_text', $meta);
		echo $after_widget; 
		} else { ?>
		
		<span>by</span> <a href="http://twitter.com/<?php the_author_meta('twitter'); ?>" rel="nofollow" class="twitter-link">@<?php the_author_meta('twitter'); ?></a> (<a href="<?php global $authordata; echo get_author_posts_url( $authordata->ID, $authordata->user_nicename ); ?>" title="">see all posts</a>) <span>|</span> <span class="date"><?php the_date(); ?></span>
		
		<?php }
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) { 
		$text = $instance['text'] ? $instance['text'] : 'by [author] on [date] | [comments] <br />Categories : [categories]';
	
	?>	
		
		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Meta:'); ?><textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" rows="5"><?php echo $text; ?></textarea>
		</label><br /> 
			<small>Enter entry meta here. You can use shortcodes. You can see a <a href="http://shailan.com/wordpress/themes/widgetbox/shortcodes">list of available shortcodes here</a>.</small></p>
		
		<?php
    }

} 

// register widget
add_action('widgets_init', create_function('', 'return register_widget("wb_entrymeta");'));