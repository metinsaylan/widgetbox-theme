<?php 

/** DEFAULT FRAMEWORK OPTIONS */

$font_families = array(
	'"Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;',
	'Futura, Century Gothic, AppleGothic, sans-serif;',
	'DejaVu Sans, Bitstream Vera Sans, Segoe UI, Lucida Grande, Verdana, Tahoma, Arial, sans-serif;'
);

/*$css_frameworks = array( 
	'None',
	'960.gs 12Column',
	'960.gs 16Column', 
	'Blueprint CSS' 
);*/

$options = array (
/*
array( "name" => "Elements",
	"type" => "section"),
array( "type" => "open"),

array(  "name" => "Header height",
	"desc" => "px Height of the header.",
	"id" => "stf_header_height",
	"std" => "190",
	"type" => "text"),

array( "type" => "close"),
*/
array( "name" => "Theme Options",
	"type" => "section"),
array( "type" => "open"),

	array(  "name" => "Logo url",
		"desc" => "URL of your logo image. (Eg:" . trailingslashit(get_bloginfo('template_directory')) . "images/logo.png)",
		"id" => "stf_logo_url",
		"std" => "",
		"type" => "text"),

	array(  "name" => "Entry header",
		"desc" => "Entry header meta, shows right under the post title.",
		"id" => "stf_entry_header_meta",
		"std" => "By [author] on [date] | [cmnts]",
		"type" => "text"),
		
	array(  "name" => "Entry footer",
		"desc" => "Entry footer meta, shows below the post content.",
		"id" => "stf_entry_footer_meta",
		"std" => "Filed in [categories] | [tags]",
		"type" => "text"),
		
	array(  "name" => "Theme footer",
		"desc" => "Displays at the bottom of site. You can use various shortcodes here.",
		"id" => "stf_theme_footer",
		"std" => "&copy; " . get_bloginfo('name'),
		"type" => "text"),
		
	array(  "name" => "Feed footer",
		"desc" => "Displays after every post in the feed.",
		"id" => "stf_feed_footer",
		"std" => '<p><strong><em>This post is originally posted on <a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a>. <br />Visit <a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a> for more..</em></strong></p>',
		"type" => "text"),

	

array( "type" => "close"),

array( "name" => "Framework Options",
	"type" => "section"),
array( "type" => "open"),
	/* Not needed anymore 
	array(  "name" => "Google Ads Unique ID",
		"desc" => " Your unique adsense ID.",
		"id" => "shailan_adsense_id",
		"std" => "",
		"type" => "text"), */
	
	array(  "name" => "Google Analytics Code",
		"desc" => " Google Analytics Code. Will be automatically put in your <strong><em>header</em></strong>.",
		"id" => "shailan_analytics_code",
		"std" => "",
		"type" => "textarea"),
	
	array( "name" => "Custom Favicon",
		"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
		"id" => "stf_favicon",
		"type" => "text",
		"std" => get_bloginfo('url') ."/favicon.ico"),	
	
	array( "name" => "Feedburner URL",
		"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website",
		"id" => "stf_feedburner",
		"type" => "text",
		"std" => get_bloginfo('rss2_url')),
	
array( "type" => "close")

);

?>