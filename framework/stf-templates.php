<?php 

/** SHAILAN THEME FRAMEWORK 
 File 		: shailan-templates.php
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

global $stf;
global $theme_data;

/** CONSTANTS */
define('THEME_IMAGES_DIRECTORY', trailingslashit(get_bloginfo('stylesheet_directory')) . 'images');

/**
 * Returns theme info if exists. 
 *
 * @since 1.0.0
 * @uses get_theme_data() to get theme information.
 */
function themeinfo($key){
	global $theme_data;
	
	if(empty($theme_data)){
		$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );	
	}
	
	if(array_key_exists($key, $theme_data)){
		return $theme_data[$key];
	} else {
		trigger_error("Key '" . $key . "' for themeinfo doesn't exist"  , E_USER_ERROR);
		return FALSE;
	}
}

function stf_css_960gs(){ 
	?><!-- 960 Grid System -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/framework/css/960/reset.css'; ?>" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/framework/css/960/text.css'; ?>" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/framework/css/960/960.css'; ?>" media="screen" />
	<!--/ 960 Grid System --><?php
	
}

function stf_css_common(){
	?><link rel="stylesheet" id="framework-common"  href="<?php echo get_template_directory_uri(); ?>/framework/css/common.css" type="text/css" media="all" /><?php
}

/**
 * An extension for dynamic_sidebar(). If no widgets exist it shows default widgets
 * given by an array or a callback.
 *
 * @since 1.0.0
 * @uses the_widget() to show widgets.
 */
function stf_widgets( $id, $default_widgets = array(), $callback = null ){
	if(!dynamic_sidebar($id)){ // If widget area has no widgets
		if(is_array($default_widgets)){
			foreach($default_widgets as $widget_callback)
				the_widget($widget_callback);
		} elseif (!empty($default_widgets)){
			the_widget($default_widgets);
		} elseif (null != $callback){
			call_user_func($callback);
		}
	}
}

/**
 * Return a set of default sidebar widgets. Can be used to fill in default sidebars.
 *
 * @since 1.0.0
 * @uses the_widget() to show widgets.
 */
if(!function_exists('default_sidebar_widgets')){
function default_sidebar_widgets(){
	// SEARCH
	the_widget('WP_Widget_Search', 'title=&');
	// RECENT POSTS
	the_widget('WP_Widget_Recent_Posts', array(
		'widget_id' => null,
		'title' => __('Recent Posts'),
		'number' => '7'));
	// COMMENTS
	the_widget('WP_Widget_Recent_Comments', array(
		'widget_id' => null,
		'title' => __('Recent Comments'),
		'number' => '7'));
	// ARCHIVES
	the_widget('WP_Widget_Archives', array(
		'widget_id' => null,
		'count' => 1,
		'dropdown' => 0));
	// TAG CLOUD
	the_widget('WP_Widget_Tag_Cloud');
	// LINKS
	the_widget('WP_Widget_Links');
}}

/**
 * Returns entry header. Entry header can be changed via options.
 *
 * @since 1.0.0
 * @uses do_shortcode() to parse shortcodes in header.
 */
function stf_entry_header(){
	$meta = stf_get_setting('stf_entry_header_meta');
	if(FALSE !== $meta){
		echo do_shortcode($meta);
	}
}

/**
 * Returns entry footer. Entry footer can be changed via options.
 *
 * @since 1.0.0
 * @uses do_shortcode() to parse shortcodes in the footer.
 */
function stf_entry_footer(){
	$meta = stf_get_setting('stf_entry_footer_meta');
	if(FALSE !== $meta){
		echo do_shortcode(stripslashes($meta));
	}
}

/**
 * Returns entry thumbnail. Size can be changed via options panel.
 *
 * @since 1.0.0
 * @uses do_shortcode() to parse shortcodes in the footer.
 */
function stf_entry_thumbnail( $size = null ){
	global $post;
	
	$title = get_the_title(get_the_ID());
	
	$thumb_attr = array(
		'alt'	=> trim(strip_tags( $title )),
		'title'	=> trim(strip_tags( $title )),
	);
	
	if(function_exists('has_post_thumbnail') && has_post_thumbnail( $post->ID )) {
		echo '<div class="entry-thumbnail"><a href="'.get_permalink( $post->ID ).'" title="' . get_the_title( $post->ID ) . '">';
		echo get_the_post_thumbnail( $post->ID, $size, $thumb_attr );
		echo '</a></div>';
	} else {
		echo '<div class="entry-thumbnail"><a href="'.get_permalink( $post->ID ).'" title="' . get_the_title( $post->ID ) . '">';
		echo '<div class="entry-thumbnail-default"></div>';
		echo '</a></div>';
	}
}

function stf_get_templates(){
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
	
	return $templates;
	
}

function stf_posts( $number_of_posts = 0, $template = '',  $reset = false ){
	global $wp_query;
	
	// Reset to default query if needed
	if($reset){ wp_reset_query(); }
	
	// Change number of posts if needed
	if( 0 != $number_of_posts ){
		query_posts(
			array_merge(
				array('posts_per_page' => $number_of_posts),
				$wp_query->query
			)
		); }
	
	// Load template if given
	if('' != $template){
		locate_template( array($template), true, false );
	} else { 
	
		$templates = stf_get_templates();
	
		if ( have_posts() ): 
			locate_template( $templates, true, false ); 
		else: 
			define('PAGE_NOT_FOUND', true); 
			locate_template( array('loop-404.php'), true, false );
		endif; 
	}
}

function stf_random_posts( $number_of_posts = 5, $template = '' ){
	global $posts_displayed;

	$sticky = get_option('sticky_posts');	
	
	// Change query
	$query_arguments = array(
		'ignore_sticky_posts'=>1,
		'post__not_in' => array_merge( $sticky, $posts_displayed ),
		'posts_per_page' => $number_of_posts,
		'orderby'=>'rand'
	);
	
	// Display them
	stf_custom_posts( $query_arguments, $template );
}

function stf_most_viewed_posts( $number_of_posts = 5, $template = '' ){
	global $posts_displayed;

	if(function_exists('the_views')){
	// Change query
	$query_arguments = array(
	   'ignore_sticky_posts'=>1,
	   'post__not_in' => $posts_displayed,
	   'posts_per_page' => $number_of_posts,
	   'v_sortby' => 'views',
	   'v_orderby' => 'desc'
	   );
	
	// Display them
	stf_custom_posts( $query_arguments, $template ); 
	} else { stf_random_posts( $number_of_posts, $template ); }
}

function stf_most_commented_posts( $number_of_posts = 5, $template = '' ){
	global $posts_displayed;
	
	// Change query
	$query_arguments = array(
		'ignore_sticky_posts'=>1,
		'post__not_in' => $posts_displayed,
		'orderby' => 'comment_count',
		'posts_per_page' => $number_of_posts
	);
	
	// Display them
	stf_custom_posts( $query_arguments, $template );
}

function stf_custom_posts( $query_arguments, $template = '' ){

	query_posts( $query_arguments );
	// Display them
	stf_posts( 0, $template );
	// Reset to default query
	wp_reset_query();	
}



function stf_theme_footer(){
	$meta = stf_get_setting('stf_theme_footer');
	if(FALSE !== $meta){
		echo do_shortcode(stripslashes($meta));
	}
}

/**
 * Returns img tag to the image filename given. 
 *
 * @since 1.0.0
 * @uses do_shortcode() to parse shortcodes in the footer.
 * 
 * @param string $filename		filename of the image requested.
 * @param string $dimensions	dimensions of the image with an x in between. Eg: 200x200
 * @param string $classname		class attribute of the image tag
 * @param string $alt 			alternative text attribute of the image.
 */
function get_theme_image($filename, $dimensions=NULL, $classname='', $alt='', $title='' ){
	$img = '<img src="' . THEME_IMAGES_DIRECTORY . '/' . $filename . '"';
	
	if(!empty($dimensions)){
		$dimensions = explode('x', $dimensions); 
		$img .= ' width="'.$dimensions[0].'" height="'.$dimensions[1].'"';
	}
	
	if(!empty($classname)){ $img .= ' class="'.$classname.'"';}
	if(!empty($alt)){ $img .= ' alt="'.$alt.'"';}
	if(!empty($title)){ $img .= ' title="'.$title.'"';}
	
	$img .= ' />';
	return $img;
}

function theme_image($filename, $dimensions=NULL, $classname='', $alt='', $title = '' ){
	echo get_theme_image($filename, $dimensions, $classname, $alt, $title);
} 

function stf_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'comment' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="arrow"></div>		
		<div class="comment-author-avatar vcard">
			<a href="<?php echo get_comment_author_url( get_comment_ID() ); ?>" rel="external nofollow" title="<?php echo comment_author(); ?>">
				<?php echo get_avatar( $comment, 40 ); ?>
			</a>
		</div><!-- .comment-author .vcard -->
		
		<div class="comment-body">
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'widgetbox' ); ?></em>
			<br />
			<?php endif; ?>
			<div class="comment-meta commentmetadata">
			  <span class="comment-author"><?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?></a></span>
			  <span class="comment-date"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php
					/* translators: 1: date, 2: time */
					printf( __( '<span title="at %2$s">%1$s</span>', 'widgetbox' ), get_comment_date('M j, Y'),  get_comment_time() ); ?></a></span>
				<span class="comment-edit-link"><?php edit_comment_link( __( 'edit', 'widgetbox' ), ' ' );	?></a>
			</div><!-- .comment-meta .commentmetadata -->
			<div class="comment-text"><?php comment_text(); ?></div>
		</div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
		
		<div class="clear"></div>
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'widgetbox' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'widgetbox'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
