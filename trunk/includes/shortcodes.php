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
 
 /** 
  * == Available Shortcodes ==
  *
  * [tags] : outputs a tag cloud. Eg. : `[tags number=5]`
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
} add_shortcode('tags', 'shailan_tags_shortcode');

/** [and] : wraps ampersand to style it better */
function shailan_and_shortcode($args) {
	$and = '<span class="amp">&</span>';
	return $and;
} add_shortcode('and', 'shailan_tags_shortcode');

?>