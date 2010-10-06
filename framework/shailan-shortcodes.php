<?php 
/** SHAILAN THEME FRAMEWORK 
 File 		: shailan-shortcodes.php
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

/** [tags] : outputs tag cloud */
function shailan_tags_shortcode($args) {
	global $post;

	$defaults = array(
		'echo' => false,
		'number' => 7
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$tags = '<span class="tag-list">';
	$tags .= wp_tag_cloud($args);
	$tags .= '</span>';
	
	return $tags;
} add_shortcode('tag_cloud', 'shailan_tags_shortcode');

/** [and] : wraps ampersand to style it better */
function shailan_and_shortcode($args) {
	$and = '<span class="amp">&</span>';
	return $and;
} add_shortcode('and', 'shailan_and_shortcode');


/** META SHORTCODES */

/** [ID], [the_ID] */
function shailan_the_ID($args){ return '<span class="meta_ID">' . get_the_ID() . '</span>'; } add_shortcode('the_ID', 'shailan_the_ID'); add_shortcode('ID', 'shailan_the_ID');

/** [author], [the_author] */
function shailan_the_author_shortcode($args){
	$defaults = array(
		'before' => '',
		'after' => ''
	); $args = wp_parse_args( $args, $defaults ); extract( $args );
	
	return '<span class="meta_author">' . $before . get_the_author() . $after . '</span>'; } add_shortcode('the_author', 'shailan_the_author_shortcode'); add_shortcode('author', 'shailan_the_author_shortcode');

/** [authorlink], [the_author_link] */
function shailan_the_author_link_shortcode($args){ 
	//'<span class="author vcard"><a class="url fn n" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" title="View all posts by '.get_the_author().'">'.get_the_author().'</a></span>'
	return '<span class="meta_author_posts">' . get_the_author_link() . '</span>'; } add_shortcode('the_author_link', 'shailan_the_author_link_shortcode'); add_shortcode('authorlink', 'shailan_the_author_link_shortcode');

/** [date], [the_date] */
function shailan_the_date($args){ return '<span class="meta_date">' . get_the_date() .'</span>'; } add_shortcode('the_date', 'shailan_the_date'); add_shortcode('date', 'shailan_the_date');

/** [category], [the_category] */
function shailan_the_category($args){ 
	global $post;
	
	$defaults = array(
		'separator' => ', ',
		'single' => true
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	if($post->post_type == 'post'){
		
		$cats = get_the_category($post->ID);
		$single_cat = $cats[0]->cat_name;
		$single_link = '<a href="'.get_category_link( $cats[0]->cat_ID ) .'" title="'.$single_cat.'">'.$single_cat.'</a>';	
	
		if($single){
			return '<span class="meta_category">' . $single_link . '</span>';
		} else {
			$categories = '<span class="meta_category">';
			foreach((get_the_category($post->ID)) as $category) { 
				$cat_link = '<a href="'.get_category_link( $category->cat_ID ) .'" title="'.$category->cat_name.'">'.$category->cat_name.'</a>';
				$categories .= $cat_link . $separator; 
			} 
			$categories .= '</span>';
			return $categories;
	}
	
	} else {
		return __('No categories.');
	}
	
} add_shortcode('the_category', 'shailan_the_category'); add_shortcode('category', 'shailan_the_category');

function shailan_categories($args){ 
	global $post;
	
	$defaults = array(
		'separator' => ', ',
		'lastseparator' => ' ' . __('and') . ' '
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	if($post->post_type == 'post'){
	
		$cats = get_the_category($post->ID);
		
		$categories = '<span class="meta_category">';
		$last = count($cats);
		$current = 0;
		
		foreach($cats as $category) { 
			$current += 1; 
			$cat_link = '<a href="'.get_category_link( $category->cat_ID ) .'" title="'.$category->cat_name.'">'.$category->cat_name.'</a>';
			$categories .= ( $current==$last ? $cat_link : ( $current==$last-1 ? $cat_link . $lastseparator : $cat_link . $separator) );
		} 
		
		$categories .= '</span>';
		return $categories;
	
	} else {
		return __('No categories.');
	}
	
} add_shortcode('the_categories', 'shailan_categories'); add_shortcode('categories', 'shailan_categories');

function shailan_tags($args){ 
	global $post;
	
	$defaults = array(
		'before' => '',
		'after' => '',
		'separator' => ', ',
		'lastseparator' => ' ' . __('and') . ' '
	);	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );	
	
	if($post->post_type == 'post'){
		$tag_list = get_the_tag_list( $before, $separator, $after );
		return '<span class="meta_tags">' . $tag_list . '</span>';
	} else {
		return __('No tags.');
	}
	
} add_shortcode('the_tags', 'shailan_tags'); add_shortcode('tags', 'shailan_tags');

function shailan_comments_link($args){
	global $post, $id;
	
	$defaults = array(
		'zero' => __('Leave Comment'),
		'one' => __('1 Comment'),
		'more' => __('% Comments')
	);	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );	
	
	$link = get_comments_link();
	$number = get_comments_number($id);

        if ( $number > 1 )
                $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('% Comments') : $more);
        elseif ( $number == 0 )
                $output = ( false === $zero ) ? __('No Comments') : $zero;
        else // must be one
                $output = ( false === $one ) ? __('1 Comment') : $one;
	
	return '<span class="comments-link"><a href="'.$link.'" >' . $output . '</a></span>';
} add_shortcode('comments', 'shailan_comments_link'); add_shortcode('cmnts', 'shailan_comments_link');

function shailan_comment_count($args){
	global $post, $id;	
	$link = get_comments_link();
	$number = get_comments_number($id);
	
	return '<span class="comments-count"><a href="'.$link.'" >' . $number . '</a></span>';
} add_shortcode('comment_count', 'shailan_comment_count');

// [shortlink text="shortlink" title="twit this" before="Get the " after="!"]
function shailan_the_shortlink($args){ 
	global $post;

	$defaults = array(
		'text' => _e('Shortlink'),
		'title' => ''
	);	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );	
	
	$shortlink = wp_get_shortlink( $post->ID );
	
	if ( !empty( $shortlink ) ) {
		$link = '<a rel="shortlink" href="' . esc_url( $shortlink ) . '" title="' . $title . '">' . $text . '</a>';
		$link = apply_filters( 'the_shortlink', $link, $shortlink, $text, $title );
		
		return $link;
	} 

} add_shortcode('the_shortlink', 'shailan_the_shortlink'); add_shortcode('shortlink', 'shailan_the_shortlink');

// TODO : [permalink]
// TODO : [title]

function shailan_queryposts($atts){
  extract(shortcode_atts( array(
   'category_id' => '',
   'category_name' => '',
   'tag' => '',
   'day' => '',
   'month' => '',
   'year' => '',
   'count' => '5',
   'author_id' => '',
   'author_name' => '',
   'order_by' => 'date',
  ), $atts));

  $output = '';
  $query = array();

  if ($category_id != '') $query[] = 'cat=' .$category_id;
  if ($category_name != '') $query[] = 'category_name=' .$category_name;
  if ($tag != '') $query[] = 'tag=' . $tag;
  if ($day != '') $query[] = 'day=' . $day;
  if ($month != '') $query[] = 'monthnum=' . $month;
  if ($year != '') $query[] = 'year=' . $year;
  if ($count) $query[] = 'posts_per_page=' .$count;
  if ($author_id != '') $query[] = 'author=' . $author_id;
  if ($author_name != '') $query[] = 'author_name=' . $author_name;
  if ($order_by) $query[] = 'orderby=' . $order_by;

  //ob_start();

  $backup = $post;
  $posts = new WP_Query(implode('&',$query));
  
  $output = '';
  $temp_title = '';
  $temp_link = '';
  
  if ($posts->have_posts()):
   while ($posts->have_posts()):
    $posts->the_post();
    
	$temp_title = get_the_title($post->ID);
    $temp_link = get_permalink($post->ID);
    $output .= "<li><a href='$temp_link'>$temp_title</a></li>";
	
   endwhile;
   
  else:
   $output .= '<p class="error">[query] '.__("No posts found matching the arguments", "widgetbox").'</p>';
  endif;

  $post = $backup;
  wp_reset_query();

  //$output = ob_get_contents();
  //ob_end_clean();

  return $output;
}; add_shortcode('query_posts', 'shailan_queryposts');

function stf_wrap_tag($atts, $content = null ){
$permalink_structure = get_option('permalink_structure');
$tag_base = get_option( 'tag_base' );
if($tag_base == '')	$tag_base = 'tag';

	if ( $permalink_structure != '' ) { //permalinks enabled
		$url = trailingslashit(get_bloginfo('url')).$tag_base.'/'.$content;
	} else {
		$url = trailingslashit(get_bloginfo('url')).'?tag='.$content;
	}
	return '<a href="'.$url.'" rel="tag">' . $content . '</a>';
}
add_shortcode('tag', 'stf_wrap_tag');

function stf_wrap_twitter_tag($atts, $content = null ){
	return '<a href="https://twitter.com/search?q=%23'.$content.'" rel="nofollow">#'.$content.'</a>';
}; add_shortcode('htag', 'stf_wrap_twitter_tag'); add_shortcode('hashtag', 'stf_wrap_twitter_tag');

function stf_dropcap($atts, $content = null ){
	return '<span class="dropcap">'.$content.'</span>';
}; add_shortcode('dropcap', 'stf_dropcap');

?>