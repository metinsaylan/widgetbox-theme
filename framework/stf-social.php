<?php

function stf_get_shortlink($id = 0, $context = 'post', $allow_slugs = true){
	global $wp_query, $post;
	
	$post_id = 0;
	
	if(0 == $id && is_object($post)){
		$post_id = $post->ID;
	} elseif ( 'query' == $context && is_single() ) {
		$post_id = $wp_query->get_queried_object_id();
	} elseif ( 'post' == $context ) {
		$post = get_post($id);
		$post_id = $post->ID;
	} 

	$shortlink = '';

	// Return p= link for posts.
	if ( !empty($post_id) && '' != get_option('permalink_structure') ) {
		$post = get_post($post_id);
		if ( isset($post->post_type) && ('post' == $post->post_type || 'page' == $post->post_type))
			$shortlink = home_url('?p=' . $post->ID);
	}

	return $shortlink;
}

// Function to filter out used tags and categories
function hash_filter($var){ global $title; return (strpos($title, "#" . $var) === false); }
	
/* Generate and save a better tweet text & save it to post meta */
function stf_generate_post_tweet($post_ID){
	global $post;
	//echo $post_ID;
	
	$title = get_the_title($post_ID);
	$link = stf_get_shortlink($post_ID);
	$link_length = strlen($link);		
		
	// Create hashtags from categories and tags
	$hashtags = array();
	
	$globalhashtags = get_option('stf_tweet_hashtags');
	if(is_array($globalhashtags)){ 
		$hashtags = array_merge($globalhashtags, $hashtags);
	} else {
		$globalhashtags = explode(",", $globalhashtags);
		$hashtags = array_merge($globalhashtags, $hashtags);
	}
	
	$posthashtags = get_post_meta($post_ID, 'stf_tweet_hashtags', true);
	if(is_array($posthashtags)){ 
		$hashtags = array_merge($posthashtags, $hashtags);
	} else {
		$posthashtags = explode(",", $posthashtags);
		$hashtags = array_merge($posthashtags, $hashtags);
	}
	
	$hashtags = array();
	foreach((get_the_category($post_ID)) as $category) { 
		if($category->cat_name != 'uncategorized'){
			$hashtags[] = $category->cat_name;
		}
	} 		
		
	$posttags = get_the_tags($post_ID);
	if ($posttags) {
		foreach($posttags as $tag) {
			$hashtags[] = $tag->name; 
		}
	}
		
	// Remove duplicate elements
	$hashtags = array_unique($hashtags);
		
	// Create replacement array
	$replacements = array();
	$patterns = array();
	foreach($hashtags as $hash) { 
		$patterns[] = "{" . preg_quote($hash, '{}') . "}i";
		$replacements[] = " #" . $hash . " ";
	} 		
				
	$title = preg_replace($patterns, $replacements, $title);
		
	// Remove already used hashtags
	$hashtags = array_filter($hashtags, 'hash_filter');		
		
	$RT_offset = 35; // Add some space for replies & retweet
	$allowed_length = 140 - $RT_offset - $link_length;
		
	// Add unused hashtags to the end of title
	foreach($hashtags as $hash) {
		$temp = $title . " #" . $hash;
		if(strlen($temp)>$allowed_length){ break; }
		$title = $temp;
	}
	
	$title .= " " . $link;
	
	// Why not save it for later use?
	update_post_meta( $post_ID, 'stf_tweet_text', $title );
	
	return $title;
}

function stf_save_post_tweet($post_ID){
	$tweet = stf_generate_post_tweet($post_ID);
	// Update tweet text of the post
	update_post_meta( $post_ID, 'stf_tweet_text', $tweet );
}
add_action('publish_post', 'stf_save_post_tweet');

function stf_get_tweet($id = 0){
	global $wp_query, $post;
	
	if(0 == $id){
		if(is_object($post)){
			$post_ID = $post->ID;
		} else {
			return FALSE;
		}
	} else {
		$post = get_post($id);
		$post_ID = $post->ID;
	}
	
	if($post_ID){ $tweet_text = get_post_meta($post_ID, 'stf_tweet_text', true); }
		
	if(strlen($tweet_text)>0){
		return $tweet_text;
	} else {		
		$tweet_text =  stf_generate_post_tweet($post_ID);
		return $tweet_text;
	}			
}

function the_tweet($id = 0){ if($id!=0){ return stf_get_tweet($id); } }

require_once(ABSPATH . 'wp-includes/http.php');

// TWITTER
/** Gets latest tweet using json (src:)[http://yoast.com/display-latest-tweet/]*/
function stf_get_latest_tweet($username){
	$tweet = get_option("stf_lasttweet");
	$url  = "http://twitter.com/statuses/user_timeline/".$username.".json?count=20";
	if ($tweet['lastcheck'] < ( mktime() - 60 ) ) {
	  $snoopy = new Snoopy;
	  $result = $snoopy->fetch($url);
	  if ($result) {
		$twitterdata   = json_decode($snoopy->results,true);
		$i = 0;
		while ($twitterdata[$i]['in_reply_to_user_id'] != '') {
		  $i++;
		}
		$pattern  = '/\@([a-zA-Z]+)/';
		$replace  = '<a href="http://twitter.com/'.strtolower('\1').'">@\1</a>';
		$output   = preg_replace($pattern,$replace,$twitterdata[$i]["text"]);  
		$output = make_clickable($output);
	 
		$tweet['lastcheck'] = mktime();
		$tweet['data']    = $output;
		$tweet['rawdata']  = $twitterdata;
		$tweet['followers'] = $twitterdata[0]['user']['followers_count'];
		update_option('stf_lasttweet',$tweet);
	  } else {
		echo "Twitter API not responding.";
	  }
	} else {
	  $output = $tweet['data'];
	}
	echo "<p>\"".$output."\"</p>";
}

// TWITTER ANYWHERE
if(stf_get_setting('shailan_twitter_anywhere') == 'enabled'){
	function install_twitter_anywhere(){
		$twitter_api_key = get_option('shailan_twitter_anywhere_key');
		echo "<script src=\"http://platform.twitter.com/anywhere.js?id=$twitter_api_key&v=1\" type=\"text/javascript\"></script>";
		echo "<script type=\"text/javascript\">
		//<![CDATA[
			twttr.anywhere(function (T) {
				T('.entry-content').hovercards();
				T('.entry-content').linkifyUsers();
			});
		//]]>
		</script>";
	} add_action( 'wp_head', 'install_twitter_anywhere' );
}

// DIGG BUTTON SCRIPT
function install_digg(){
	echo "\n\t<script type=\"text/javascript\">
	//<![CDATA[
	(function() {
	var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
	s.type = 'text/javascript';
	s.async = true;
	s.src = 'http://widgets.digg.com/buttons.js';
	s1.parentNode.insertBefore(s, s1);
	})();
	//]]>
	</script>";
} add_action( 'wp_head', 'install_digg' );
