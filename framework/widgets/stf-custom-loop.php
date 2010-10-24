<?php 

/** SHAILAN THEME FRAMEWORK 
 File 		: stf-loop.php
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

class stf_loop extends WP_Widget {
    function stf_loop() {
		$widget_ops = array('classname' => 'stf-loop', 'description' => __( 'Custom loop widget', 'stf' ) );
		$this->WP_Widget('stf-loop', __('Custom Loop'), $widget_ops);
		$this->alt_option_name = 'stf_loop';	
    }

    function widget($args, $instance) {		
		global $wp_query;
        extract( $args );
		
		if ( $wp_query->max_num_pages > 1 ) :
		echo $before_widget;
		
		?>
		
		
		

		
		<?php 
		
		echo $after_widget; 		
		endif;
    }

    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    function form($instance) {  
		if (!empty($instance['title'])) 
			$title = esc_attr($instance['title']);
		
		?>
		
		<p>Displays simple post loop. This widget has no options. Yet.</p>
		
		<?php
		
		stf_widget_footer();
		
    }

} 
add_action('widgets_init', create_function('', 'return register_widget("stf_loop");'));