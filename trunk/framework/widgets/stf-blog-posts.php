<?php 
class stf_blog_posts extends WP_Widget {
    /** constructor */
    function stf_blog_posts() {
		$widget_ops = array('classname' => 'blog-posts', 'description' => __( 'Posts on your blog' ) );
		$this->WP_Widget('stf-blog-posts', __('Blog Posts'), $widget_ops);
		$this->alt_option_name = 'stf_blog_posts';	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );

		echo $before_widget;		
		if (!empty($instance['title']))
			echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
		
	global $wp_query;

	// array for loading loop templates
	$templates = array();
	
	if ( is_home() ) {
		$templates[] = 'loop-home.php';

	} elseif(is_single()){
		$templates[] = 'loop-single.php';
	}elseif(is_page()){
		$templates[] = 'loop-page.php';
	}elseif ( is_archive() ) {
		if ( is_date() ) {

			the_post();

			if ( is_day() ) {
				$templates[] = 'loop-archive-day.php';
			} elseif ( is_month() ) {
				$templates[] = 'loop-archive-month.php';
			} elseif ( is_year() ) {
				$templates[] = 'loop-archive-year.php';
			}

			$templates[] = 'loop-archive-date.php';

			rewind_posts();
		} elseif ( is_category() ) {
			$templates[] = 'loop-category-' . absint( get_query_var('cat') ) . '.php';
			$templates[] = 'loop-category.php';
			
		} elseif ( is_tag() ) {
			$templates[] = 'loop-tag-' . get_query_var('tag') . '.php';
			$templates[] = 'loop-tag.php';
			
		} elseif ( is_author() ) {
			$templates[] = 'loop-author.php';
		}
		
		$templates[] = 'loop-archive.php';
	} elseif ( is_search() ) {
		$templates[] = 'loop-search.php';
	}

	$templates[] = 'loop.php';
	
		if ( have_posts() ): 
			locate_template( $templates, true ); 
		else: 
			define('PAGE_NOT_FOUND', true); 
			locate_template( array('loop-404.php'), true );
		endif; 
				
			echo $after_widget; 
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
		if(@$instance['title']){ $title = apply_filters('widget_title', $instance['title']); } else { $title = ''; }
		
		?>
		
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'widgetbox'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label><br /> 
		<small>Title of the widget.</small></p>
		
		<?php 
		
		stf_widget_footer();
		
    }

} 

// register widget
add_action('widgets_init', create_function('', 'return register_widget("stf_blog_posts");'));