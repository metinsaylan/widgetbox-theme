<?php

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
