<?php 

/** SHAILAN THEME FRAMEWORK 
 File 		: stf-featuredposts.php
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

class stf_featured extends WP_Widget {
    function stf_featured() {
		$widget_ops = array('classname' => 'stf-featured-posts', 'description' => __( 'Featured posts with thumbs' ) );
		$this->WP_Widget('stf-featured-posts', __('Featured Posts'), $widget_ops);
		$this->alt_option_name = 'stf_featured_posts';	
		
		$this->widget_defaults = array(
			'title' => '',
			'category' => '',
			'number' => 1,
			'thumbnail' => FALSE,
			'thumbnail_size' => 'thumbnail',
			'template' => 'stf-default-template',
			'post_title' => FALSE,
			'content' => 'none'
		);
    }

    function widget($args, $instance) {		
		global $post, $wp_query, $_wp_additional_image_sizes;
		
		extract( $args );
		$widget_options = wp_parse_args( $instance, $this->widget_defaults );
		extract( $widget_options, EXTR_SKIP );
		
		$image_sizes = array('thumbnail', 'medium', 'large'); // Standard sizes
			if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) )
			$image_sizes = array_merge( $image_sizes, array_keys( $_wp_additional_image_sizes ) );
		
		$thumbnail_align = 'left';			
		if($thumbnail_size == 'thumbnail'){
			$w = get_option('thumbnail_size_w');
			$h = get_option('thumbnail_size_h');
		} elseif($thumbnail_size == 'medium'){
			$w = get_option('medium_size_w');
			$h = get_option('medium_size_h');
		} elseif($thumbnail_size == 'large'){
			$w = get_option('large_size_w');
			$h = get_option('large_size_h');
		} else {
			$imgsize = $_wp_additional_image_sizes[$thumbnail_size];			
			$w = $imgsize['width'];
			$h = $imgsize['height'];
		}

		echo $before_widget;		
		if (!empty($instance['title']))
			echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
		
		$fquery = array(
		   'showposts'=> $number,
		   'orderby'=>'rand',
		);
		
		if(is_single()){
			$fquery['post__not_in'] = array($post->ID);
		}
			
		if($category == 'stf-all-categories'){
			// do nothing simply
		} elseif($category == 'stf-get-from-post'){
			if(is_single()){
				$categories = get_the_category($post->ID);
				$fquery['category_name'] = $category[0]->cat_name;
			}
		} elseif($category == 'stf-most-commented'){
			$fquery['orderby']='comment_count';
		} elseif($category == 'stf-sticky-posts'){
			$fquery['post__in'] = get_option('sticky_posts');
			$fquery['caller_get_posts'] = 1;
		} else {
			$fquery['category_name'] = $category;
		}

		echo "\n\t<!-- Featured Posts Query: ";
			print_r($fquery);
		echo " -->\n";
		
		// Query posts
		$temp_query = $wp_query;
		//$featuredPosts = new WP_Query($fquery);
		query_posts($fquery);
		
		echo '<div id="loop-'.$this->number.'" class="">';
		
		// Load template
		if('stf-default-template' != $template && file_exists($template)){
			// Locate template
			include($template); // not once
		
		} else {
			// Default template	
			include('templates/loop-list.php');
		}
		
		echo '</div>';
		
		// Restore default query
		$wp_query = $temp_query;
		wp_reset_query();
		
		echo $after_widget; 
    }

    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    function form($instance) {  
		$widget_options = wp_parse_args( $instance, $this->widget_defaults );
		extract( $widget_options, EXTR_SKIP );
		
		?>
		
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Featured Posts Category:'); ?><select name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>" >	
			<option value="stf-all-categories" <?php if($category == 'stf-all-categories'){ echo ' selected="selected"'; }; ?>>*All categories*</option>
			<option value="stf-get-from-post" <?php if($category == 'stf-get-from-post'){ echo ' selected="selected"'; }; ?>>*Same category as post*</option>
			<option value="stf-most-commented" <?php if($category == 'stf-most-commented'){ echo ' selected="selected"'; }; ?>>*Most commented posts*</option>
			<option value="stf-sticky-posts" <?php if($category == 'stf-sticky-posts'){ echo ' selected="selected"'; }; ?>>*Sticky posts*</option>
		 <?php 
		  $categories = get_categories(''); 
		  foreach ($categories as $cat) {  
			$option = '<option value="'.$cat->category_nicename .'" '. ( $cat->category_nicename == $category ? ' selected="selected"' : '' ) .'>';
			$option .= $cat->cat_name;
			$option .= '</option>\n';
			echo $option;
		  }
		 ?>
		</select></label></p>
		
		<p><label for="<?php echo $this->get_field_id('template'); ?>"><?php _e('Loop Template:'); ?><select name="<?php echo $this->get_field_name('template'); ?>" id="<?php echo $this->get_field_id('template'); ?>" >	
			<option value="stf-default-template" <?php if($category == 'stf-default-template'){ echo ' selected="selected"'; }; ?>>Default Template</option>
		 <?php 
			$path = pathinfo(__FILE__);
			$path = $path['dirname'] . '/templates/';
			$default_templates = GetFileList(BY_EXPRESSION, "{loop-.*?.php}", $path, true);
			$theme_templates = GetFileList(BY_EXPRESSION, "{loop-.*?.php}", get_stylesheet_directory(), true);
			$templates = array_merge( $default_templates, $theme_templates );
		  
		  foreach ($templates as $temp) {  
			$file = pathinfo($temp);
			$filename = $file['filename'] . '.' . $file['extension']; //substr($file['filename'], 5, strlen($file['filename']));
			$option = '<option value="'.$temp .'" '. ( $temp == $template ? ' selected="selected"' : '' ) .'>';
			$option .= $filename;
			$option .= '</option>\n';
			echo $option;
		  }
		 ?>
		</select></label></p>
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of items:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label><br /> 
					<small><?php _e('Number of items to be displayed'); ?></small></p>
				
		<?php
		stf_widget_footer();
    }

} 

add_action('widgets_init', create_function('', 'return register_widget("stf_featured");'));