<?php 
/** SHAILAN THEME FRAMEWORK 
 File 		: shailan-shortcodes.php
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

/** [tags] : outputs tag cloud */
function stf_tags_shortcode($args) {
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
} 

/** [and] : wraps ampersand to style it better */
function stf_and_shortcode($args) {
	$and = '<span class="amp">&</span>';
	return $and;
} 


/** META SHORTCODES */

/** [ID], [the_ID] */
function stf_the_ID($args){ return '<span class="meta_ID">' . get_the_ID() . '</span>'; } 

/** [author], [the_author] */
function stf_the_author_shortcode($args){
	$defaults = array(
		'before' => '',
		'after' => ''
	); $args = wp_parse_args( $args, $defaults ); extract( $args );
	
	return '<span class="meta_author">' . $before . get_the_author() . $after . '</span>'; } 

/** [authorlink], [the_author_link] */
function stf_the_author_link_shortcode($args){ 
	//'<span class="author vcard"><a class="url fn n" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" title="View all posts by '.get_the_author().'">'.get_the_author().'</a></span>'
	return '<span class="meta_author_posts">' . get_the_author_link() . '</span>'; } 

/** [date], [the_date] */
function stf_the_date($args){ return '<span class="meta_date">' . get_the_date() .'</span>'; } 

/** [category], [the_category] */
function stf_the_category($args){ 
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
	
} 

function stf_categories($args){ 
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
	
} 

function stf_tags($args){ 
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
	
} 

function stf_comments_link($args){
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
} 

function stf_comment_count($args){
	global $post, $id;	
	$link = get_comments_link();
	$number = get_comments_number($id);
	
	return '<span class="comments-count"><a href="'.$link.'" >' . $number . '</a></span>';
} 

// [shortlink text="shortlink" title="twit this" before="Get the " after="!"]
function stf_the_shortlink($args){ 
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

} 

function stf_edit_link_shortcode($atts){
	ob_start();
	edit_post_link( __( 'Edit' ), '<span class="edit-link">', '</span>' );
	$link = ob_get_contents();
	ob_end_clean();
	return $link;
}


// TODO : [permalink]
// TODO : [title]

function stf_queryposts($atts){
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
}

function stf_loop($atts){
	global $wp_query;

  extract(shortcode_atts( array(
   'posts_per_page' => '',
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
   'template' => 'loop.php'
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

	query_posts(
		array_merge(
		array('posts_per_page' => $number_of_posts),
			$wp_query->query
		)
	);
	
	if('' == $template){ $template = "loop.php"; }	
	
	ob_start();
	 locate_template( array($template), true, false );
	 $posts = ob_get_contents();
	ob_end_clean();
    return $posts;  
}

function stf_pagerank($atts){
  function CheckHash($Hashnum){
    $CheckByte = 0;
    $Flag = 0;
    $HashStr = sprintf('%u', $Hashnum) ;
    $length = strlen($HashStr);
    for ($i = $length - 1;  $i >= 0;  $i --) {
      $Re = $HashStr{$i};
      if (1 === ($Flag % 2)) {
        $Re += $Re;
        $Re = (int)($Re / 10) + ($Re % 10);
      }
      $CheckByte += $Re;
      $Flag ++;
    }

    $CheckByte %= 10;
    if (0 !== $CheckByte) {
      $CheckByte = 10 - $CheckByte;
      if (1 === ($Flag % 2) ) {
       if (1 === ($CheckByte % 2)) {
        $CheckByte += 9;
       }
       $CheckByte >>= 1;
      }
     }
    return '7'.$CheckByte.$HashStr;
  }

  function HashURL($String){
    function StrToNum($Str, $Check, $Magic){
      $Int32Unit = 4294967296;  // 2^32
      $length = strlen($Str);
      for ($i = 0; $i < $length; $i++) {
        $Check *= $Magic;
        //If the float is beyond the boundaries of integer (usually +/- 2.15e+9 = 2^31),
        //  the result of converting to integer is undefined
        //  refer to http://www.php.net/manual/en/language.types.integer.php
        if ($Check >= $Int32Unit) {
          $Check = ($Check - $Int32Unit * (int) ($Check / $Int32Unit));
          //if the check less than -2^31
          $Check = ($Check < -2147483648) ? ($Check + $Int32Unit) : $Check;
        }
        $Check += ord($Str{$i});
      }
      return $Check;
    }
    $Check1 = StrToNum($String, 0x1505, 0x21);
    $Check2 = StrToNum($String, 0, 0x1003F);

    $Check1 >>= 2;
    $Check1 = (($Check1 >> 4) & 0x3FFFFC0 ) | ($Check1 & 0x3F);
    $Check1 = (($Check1 >> 4) & 0x3FFC00 ) | ($Check1 & 0x3FF);
    $Check1 = (($Check1 >> 4) & 0x3C000 ) | ($Check1 & 0x3FFF);

    $T1 = (((($Check1 & 0x3C0) << 4) | ($Check1 & 0x3C)) <<2 ) | ($Check2 & 0xF0F );
    $T2 = (((($Check1 & 0xFFFFC000) << 4) | ($Check1 & 0x3C00)) << 0xA) | ($Check2 & 0xF0F0000 );

    return ($T1 | $T2);
  }

  extract(shortcode_atts(array('url' => get_bloginfo('url')), $atts));
  $pagerank = 0;
  if (false === ($pagerank = get_transient('pr_'+md5($url)))):
    $query="http://toolbarqueries.google.com/search?client=navclient-auto&ch=".CheckHash(HashURL($url)). "&features=Rank&q=info:".$url."&num=100&filter=0";
    $request = new WP_Http;
    $result = $request->request($query);
    $pos = strpos($result['body'], "Rank_");
    if($pos === false); else $pagerank = substr($result['body'], $pos + 9);
    set_transient('pr_'+md5($url), $pagerank, 60*60*24); // 24 hours
  endif;

  $output = '<div class="pagerank button" title="Google PageRank &trade;">';
  $output.= sprintf("PR %s", $pagerank);
  $output.= '<div class="pagerank-frame">';
  $output.= '<div class="pagerank-bar" style="width:'.(((int)$pagerank/10)*100).'%"></div>';
  $output.= '</div></div>';
  return $output;

}

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

function stf_wrap_twitter_tag($atts, $content = null ){
	return '<a href="https://twitter.com/search?q=%23'.$content.'" rel="nofollow">#'.$content.'</a>';
}

function stf_dropcap($atts, $content = null ){
	return '<span class="dropcap">'.$content.'</span>';
}

function stf_is_home($atts, $content = null){
	if(is_home()){ return $content; } else { return null; }
}

function stf_is_single($atts, $content = null){
	if(is_single()){ return $content; } else { return null; }
}

function stf_is_search($atts, $content = null){
	if(is_search()){ return $content; } else { return null; }
}

function stf_is_archives($atts, $content = null){
	if(is_archive()){ return $content; } else { return null; }
}

function stf_user_only($atts, $content = null){
	extract(shortcode_atts( array(
		'capability' => 'read',
		'msg' => '<div class="access-denied"><span>[ Member only content ]</span></div>'
	), $atts));
	
	if(current_user_can($capability)){ return $content; } else { return $msg; }
}

function stf_generator_link_shortcode($atts, $content = null){
	extract(shortcode_atts( array(
		'class' => 'generator-link'
	), $atts));
	
	return "<span class=\"" . $class . "\"><a href=\"http://wordpress.org/\" title=\"" . __( 'WordPress', 'stf' ) . "\" rel=\"generator external nofollow\">" . __( 'WordPress', 'stf' ) . "</a></span>";
}

function stf_theme_link_shortcode($atts, $content = null){	
	extract(shortcode_atts( array(
		'class' => 'theme-link'
	), $atts));
	
	return "<span class=\"" . $class . "\"><a href=\"". themeinfo('URI') ."\" rel=\"designer external\">" . themeinfo('Name') . "</a></span>";
}

function stf_site_link_shortcode($atts, $content = null){
	extract(shortcode_atts( array(
		'rel' => 'nofollow',
		'title' => get_bloginfo('description')
	), $atts));

	if(null == $content){ $content = get_bloginfo('name'); }
	
	return "<a href='".get_bloginfo('url')."' rel='".$rel."' title='".$title."'>". $content . "</a>";
}

function stf_latest_tweet_shortcode($atts, $content = null){
	extract(shortcode_atts( array(
		'username' => 'shailancom'
	), $atts));

	$tweet = '<div class="latest_tweet">'. stf_get_latest_tweet($username) . '</div>';
	return $tweet;
}

// source : http://digwp.com/2010/01/custom-query-shortcode/
function custom_query_shortcode($atts) {
   // EXAMPLE USAGE:
   // [loop the_query="showposts=100&post_type=page&post_parent=453"]
   
   // Defaults
   extract(shortcode_atts(array(
      "the_query" => ''
   ), $atts));

   // de-funkify query
   $the_query = preg_replace('~&#x0*([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $the_query);
   $the_query = preg_replace('~&#0*([0-9]+);~e', 'chr(\\1)', $the_query);

   // query is made               
   query_posts($the_query);
   
   // Reset and setup variables
   $output = '';
   $temp_title = '';
   $temp_link = '';
   
   // the loop
   if (have_posts()) : while (have_posts()) : the_post();
   
      $temp_title = get_the_title($post->ID);
      $temp_link = get_permalink($post->ID);
      
      // output all findings - CUSTOMIZE TO YOUR LIKING
      $output .= "<li><a href='$temp_link'>$temp_title</a></li>";
          
   endwhile; else:
   
      $output .= "nothing found.";
      
   endif;
   
   wp_reset_query();
   return $output;
}


/* WIDGETS */
add_shortcode('tag_cloud', 'stf_tags_shortcode');
add_shortcode('query_posts', 'stf_queryposts');
add_shortcode('list_posts', 'custom_query_shortcode');
add_shortcode('loop', 'stf_loop');

/* MISC */
add_shortcode('and', 'stf_and_shortcode');
add_shortcode('dropcap', 'stf_dropcap');
add_shortcode('tag', 'stf_wrap_tag');
add_shortcode('htag', 'stf_wrap_twitter_tag'); 
add_shortcode('hashtag', 'stf_wrap_twitter_tag');
add_shortcode('pagerank', 'stf_pagerank');
add_shortcode('latest_tweet', 'stf_latest_tweet_shortcode');

/* THEME */
add_shortcode('generator', 'stf_generator_link_shortcode');
add_shortcode('wp', 'stf_generator_link_shortcode');
add_shortcode('themelink', 'stf_theme_link_shortcode');
add_shortcode('sitelink', 'stf_site_link_shortcode');

/* POST META */
add_shortcode('the_ID', 'stf_the_ID'); 
add_shortcode('ID', 'stf_the_ID');
add_shortcode('the_author', 'stf_the_author_shortcode'); 
add_shortcode('author', 'stf_the_author_shortcode');
add_shortcode('the_author_link', 'stf_the_author_link_shortcode'); 
add_shortcode('authorlink', 'stf_the_author_link_shortcode');
add_shortcode('the_date', 'stf_the_date'); 
add_shortcode('date', 'stf_the_date');
add_shortcode('the_category', 'stf_the_category'); 
add_shortcode('category', 'stf_the_category');
add_shortcode('the_categories', 'stf_categories'); 
add_shortcode('categories', 'stf_categories');
add_shortcode('the_tags', 'stf_tags'); 
add_shortcode('tags', 'stf_tags');
add_shortcode('comments', 'stf_comments_link'); 
add_shortcode('cmnts', 'stf_comments_link');
add_shortcode('comment_count', 'stf_comment_count');
add_shortcode('the_shortlink', 'stf_the_shortlink'); 
add_shortcode('shortlink', 'stf_the_shortlink');
add_shortcode('edit', 'stf_edit_link_shortcode');

/* CONDITIONALS */
add_shortcode('home', 'stf_is_home');
add_shortcode('single', 'stf_is_single');
add_shortcode('search', 'stf_is_search');
add_shortcode('archive', 'stf_is_archive');

add_shortcode('cloak', 'stf_user_only');

?>