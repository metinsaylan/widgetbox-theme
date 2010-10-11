<?php 

/** SHAILAN THEME FRAMEWORK 
 File 		: stf-navigation.php
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

class stf_navigation extends WP_Widget {
    function stf_navigation() {
		$widget_ops = array('classname' => 'stf-navigation', 'description' => __( 'Older/Newer posts navigation', 'stf' ) );
		$this->WP_Widget('stf-navigation', __('Posts Navigation'), $widget_ops);
		$this->alt_option_name = 'stf_navigation';	
    }

    function widget($args, $instance) {		
		global $wp_query;
        extract( $args );
		
		if ( $wp_query->max_num_pages > 1 ) :
		echo $before_widget;
		
		?>
		
	<div id="nav-<?php echo $this->number; ?>" class="navigation">
		<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'stf' ) ); ?></div>
		<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'stf' ) ); ?></div>
		<div class="clear"></div>
	</div><!-- #nav-above -->
		
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
		
		<p>Displays simple post navigation. This widget has no options. Yet.</p>
		
		<?php
		
		stf_widget_footer();
		
    }

} 
add_action('widgets_init', create_function('', 'return register_widget("stf_navigation");'));