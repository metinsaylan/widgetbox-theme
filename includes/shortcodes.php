<?php 

/**
 *
 * Shortcodes
 *	Version		:	1.0
 * 
 *	Author		:	Matt Say (http://shailan.com)
 *	Author URI	:	http://shailan.com
 *
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
} add_shortcode('and', 'shailan_tags_shortcode');


/** META SHORTCODES */

/** [ID], [the_ID] */
function shailan_the_ID($args){ return '<span class="meta_ID">' . get_the_ID() . '</span>'; } add_shortcode('the_ID', 'shailan_the_ID'); add_shortcode('ID', 'shailan_the_ID');

/** [author], [the_author] */
function shailan_the_author($args){ return '<span class="meta_author">' . get_the_author() . '</span>'; } add_shortcode('the_author', 'shailan_the_author'); add_shortcode('author', 'shailan_the_author');

/** [authorlink], [the_author_link] */
function shailan_the_author_link($args){ return '<span class="meta_author_posts">' . get_the_author_link() . '</span>'; } add_shortcode('the_author_link', 'shailan_the_author_link'); add_shortcode('authorlink', 'shailan_the_author_link');

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
} add_shortcode('the_category', 'shailan_the_category'); add_shortcode('category', 'shailan_the_category');

function shailan_categories($args){ 
	global $post;
	
	$defaults = array(
		'separator' => ', ',
		'lastseparator' => ' ' . __('and') . ' '
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
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
	$tag_list = get_the_tag_list( $before, $separator, $after );
	
	return '<span class="meta_tags">' . $tag_list . '</span>';
	
} add_shortcode('the_tags', 'shailan_tags'); add_shortcode('tags', 'shailan_tags');








?>