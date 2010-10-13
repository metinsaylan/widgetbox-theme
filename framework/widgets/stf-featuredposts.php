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
		
		$temp_query = $wp_query;
		$featuredPosts = new WP_Query($fquery);
		?>
		<ul id="featured-posts">
				<?php while ($featuredPosts->have_posts()) : $featuredPosts->the_post(); ?>				
				<li class="fpost">				
				<?php if($thumbnail){ ?>
					<div class="fpost-thumbnail">
						<a href="<?php the_permalink(); ?>" rel="bookmark" >
							<?php /* the current post has a thumbnail */
								if( has_post_thumbnail() ){
									$thumb_id = get_post_thumbnail_id();
									$alt = the_title('','',false);
									/* $src = wp_get_attachment_url($thumb_id);	*/
									echo get_image_tag($thumb_id, $alt, $alt, $thumbnail_align, $thumbnail_size);
								} else {
									echo '<img src="'.get_bloginfo('template_directory').'/images/default-'.$thumbnail_size.'.png" title="'.the_title('','',false).'" width="'.$w.'" height="'.$h.'" class="align'.$thumbnail_align.' size-'.$thumbnail_size.'" />';
								} ?>
						</a>
					</div>
				<?php } ?>
				<?php if($post_title): ?>
				<span class="fpost-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
				<?php endif; ?>
				
				<?php if($content == 'post_content'){ ?>
					<div class="fpost-content"><?php the_content(); ?></div>
				<?php }elseif($content == 'post_excerpt'){ ?>
					<div class="fpost-content"><?php the_excerpt(); ?></div>
				<?php } ?>
				</li>
				
				<?php endwhile; ?>
			</ul>
		
		<div class="clear"></div>
		<?php
		// Back to normal..		

		$wp_query = $temp_query;
		wp_reset_query();
		
		echo $after_widget; 
    }

    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    function form($instance) {  
		global $_wp_additional_image_sizes;
		if(isset($instance['thumbnail'])){ $instance['thumbnail'] = (bool) $instance['thumbnail']; }
		if(isset($instance['post_title'])){ $instance['post_title'] = (bool) $instance['post_title']; }
		$widget_options = wp_parse_args( $instance, $this->widget_defaults );
		extract( $widget_options, EXTR_SKIP );
		$post_title = (bool) $post_title;		
		
		$image_sizes = array('thumbnail', 'medium', 'large'); // Standard sizes
			if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) )
			$image_sizes = array_merge( $image_sizes, array_keys( $_wp_additional_image_sizes ) );
		
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
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of items:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label><br /> 
					<small><?php _e('Number of items to be displayed'); ?></small></p>
		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>"<?php checked( $thumbnail ); ?> />
		<label for="<?php echo $this->get_field_id('thumbnail'); ?>"><?php _e( 'Display thumbnail'); ?></label></p>
		
		<p><label for="<?php echo $this->get_field_id('thumbnail_size'); ?>"><?php _e('Thumbnail Size:'); ?><select name="<?php echo $this->get_field_name('thumbnail_size'); ?>" id="<?php echo $this->get_field_id('thumbnail_size'); ?>" >	
		 <?php 
		  foreach ($image_sizes as $image_size) {  
			$option = '<option value="'.$image_size .'" '. ( $image_size == $thumbnail_size ? ' selected="selected"' : '' ) .'>';
			$option .= $image_size;
			$option .= '</option>\n';
			echo $option;
		  }
		 ?>
		</select></label></p>
		
		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('post_title'); ?>" name="<?php echo $this->get_field_name('post_title'); ?>"<?php checked( $post_title ); ?> />
		<label for="<?php echo $this->get_field_id('post_title'); ?>"><?php _e( 'Display post title'); ?></label></p>
		
		<p><label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content display:'); ?><select name="<?php echo $this->get_field_name('content'); ?>" id="<?php echo $this->get_field_id('content'); ?>" >	
			<option value="post_content" <?php if($content == 'post_content'){ echo ' selected="selected"'; } ?> >Post Content</option>
			<option value="post_excerpt" <?php if($content == 'post_excerpt'){ echo ' selected="selected"'; } ?> >Post Excerpt</option>
			<option value="none" <?php if($content == 'none'){ echo ' selected="selected"'; } ?> >None</option>
		</select></label></p>
		
		<?php
		
		stf_widget_footer();
    }

} 

add_action('widgets_init', create_function('', 'return register_widget("stf_featured");'));