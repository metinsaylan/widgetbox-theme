<?php 
class stf_blog_title extends WP_Widget {
    /** constructor */
    function stf_blog_title() {
		$widget_ops = array('classname' => 'stf_blog_title', 'description' => __( 'Automatic title widget' ) );
		$this->WP_Widget('stf-blog-title', __('Blog Title'), $widget_ops);
		$this->alt_option_name = 'stf_blog_title';	
		
		$this->widget_defaults = array(
			'title' => '',
			'dynamic' => ''
		);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        global $wp_query;

		extract( $args );
		$widget_options = wp_parse_args( $instance, $this->widget_defaults );
		extract( $widget_options, EXTR_SKIP );
		
		$dynamic = (bool) $dynamic;
		
        //$title = apply_filters('widget_title', $instance['title']);
		
		if(!empty($instance['logo_url'])){
			$logo_url = $instance['logo_url'];	
		}
				
        echo $before_widget;		

		if($dynamic){
		
		$sep = "@ ";
		// Returns the title based on the type of page being viewed
		if( have_posts() ){
			$the_post_ID = $wp_query->post->ID;
		
		if( is_single() ) {
			$the_post = get_post($thePostID);
			$the_permalink = get_permalink( $thePostID );
			$title = apply_filters('the_title', $the_post->post_title);
			$title = '<a href="'. $the_permalink .'">'. $title .'</a>';
			$tagline = $sep . '<a href="'.get_bloginfo('url').'" rel="home">'. get_bloginfo('name') . '</a>'; 
		} elseif ( is_home() || is_front_page() ) {
			$title = '<a href="'.get_bloginfo('url').'">' . get_bloginfo( 'name' ) . '</a>';
			$tagline = get_bloginfo('description');
		} elseif ( is_page() ) {
			$the_post = get_post($thePostID);
			$the_permalink = get_permalink( $thePostID );
			$title = apply_filters('the_title', $the_post->post_title);
			$title = '<a href="'. $the_permalink .'">'. $title .'</a>';
			$tagline = 'on <a href="'.get_bloginfo('url').'" rel="home">'. get_bloginfo( 'name' ) . '</a>'; 
		} elseif ( is_search() ) {
			$title = sprintf( __('Search Results for \'%s\'','k2_domain'), esc_attr( get_search_query() ) );
			$tagline = 'on <a href="'.get_bloginfo('url').'" rel="home">'. get_bloginfo( 'name' ) . '</a>'; 
		} elseif ( is_404() ) {
			$titles = array('Four-O-Four = Not found', 'Oops. Not found!', 'Something is missing..', 'What is that?', 'LOST', 'It never existed!');
			$title = $titles[rand(0, count($titles)-1)];
			$tagline = 'Not found on <a href="'.get_bloginfo('url').'" rel="home">'. get_bloginfo( 'name' ) . '</a>'; 
		} elseif (is_category()){
			$title = wp_title('', false);
			$tagline = 'Category archives on <a href="'.get_bloginfo('url').'" rel="home">'. get_bloginfo( 'name' ) . '</a>'; 
		} elseif ( is_archive() ) {
			if ( is_date() ) {	
				the_post();
				
				if ( is_day() ) {
					$title = get_the_time( __('F jS, Y','k2_domain') );
					$tagline = 'Daily archives on <a href="'.get_bloginfo('url').'" rel="home">'. get_bloginfo( 'name' ) . '</a>'; 
				} elseif ( is_month() ) {
					$title = get_the_time( __('F, Y','k2_domain') );
					$tagline = 'Monthly archives on <a href="'.get_bloginfo('url').'" rel="home">'. get_bloginfo( 'name' ) . '</a>'; 
				} elseif ( is_year() ) {
					$title = get_the_time( __('Y','k2_domain') );
					$tagline = 'Yearly archives on <a href="'.get_bloginfo('url').'" rel="home">'. get_bloginfo( 'name' ) . '</a>'; 
				}
				rewind_posts();			
			} elseif ( is_tag() ) {
				$title = '' . single_tag_title('', false) ;
				$tagline = 'Tag archives on <a href="'.get_bloginfo('url').'" rel="home">'. get_bloginfo( 'name' ) . '</a>'; 
			} elseif ( is_author() ) {
				$title = get_author_name( get_query_var('author') );
				$tagline = 'Author archives on <a href="'.get_bloginfo('url').'" rel="home">'. get_bloginfo( 'name' ) . '</a>';
			}
		} else {
			$title = wp_title('', false);
			$tagline = 'on <a href="'.get_bloginfo('url').'"  rel="home">'. get_bloginfo( 'name' ) . '</a>'; 
		}
		
		} else { // Not found
			$titles = array('This is 404 : Not found');
			$title = $titles[rand(0, count($titles)-1)];
			$tagline = 'Not found on <a href="'.get_bloginfo('url').'" rel="home">'. get_bloginfo( 'name' ) . '</a>'; 
		}
		
		} else {
			$title = '<a href="'.get_bloginfo('url').'">' . get_bloginfo( 'name' ) . '</a>';
			$tagline = get_bloginfo('description');
		}		
		
	?>

	<?php if(!empty($logo_url)){ ?>
	<div class="logo">
		<a href="<?php bloginfo('home') ?>"><img src="<?php echo $logo_url; ?>" title="" alt=""></a>
	</div>
	<?php } ?>

	<div class="title">
		<h1 class="blog-title">
			<?php echo $title; ?>
		</h1>
	
	<div class="description">
		<?php echo $tagline; ?>
	</div>
	</div>


	
		<?php
		echo $after_widget; 
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {	
		$widget_options = wp_parse_args( $instance, $this->widget_defaults );
		extract( $widget_options, EXTR_SKIP );	
		
		$dynamic = (bool) $dynamic;
		$home = (bool) $home;
	
		if(!empty($instance['logo_url']) && strlen($instance['logo_url'])){
			$logo_url = $instance['logo_url'];	
		} else {
			$logo_url = '';
		}
		
        ?>		
		
		<p><label for="<?php echo $this->get_field_id('logo_url'); ?>"><?php _e('Logo URL:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('logo_url'); ?>" name="<?php echo $this->get_field_name('logo_url'); ?>" type="text" value="<?php echo $logo_url; ?>" /></label></p>
		
		<p>
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dynamic'); ?>" name="<?php echo $this->get_field_name('dynamic'); ?>"<?php checked( $dynamic ); ?> />
		<label for="<?php echo $this->get_field_id('dynamic'); ?>"><?php _e( 'Dynamic titles' ); ?></label><br />
		
        <?php 
		
		stf_widget_footer();
    }

} 

// register widget
add_action('widgets_init', create_function('', 'return register_widget("stf_blog_title");'));