<?php 

/** DEFAULT FRAMEWORK OPTIONS */

$font_families = array(
	'"Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;',
	'Futura, Century Gothic, AppleGothic, sans-serif;',
	'DejaVu Sans, Bitstream Vera Sans, Segoe UI, Lucida Grande, Verdana, Tahoma, Arial, sans-serif;'
);

$options = array (

array( "name" => "Elements",
	"type" => "section"),
array( "type" => "open"),

array(  "name" => "Header height",
	"desc" => "px Height of the header.",
	"id" => "stf_header_height",
	"std" => "190",
	"type" => "text"),

array( "type" => "close")

array( "name" => "Framework Options",
	"type" => "section"),
array( "type" => "open"),
	
	array(  "name" => "Google Ads Unique ID",
		"desc" => " Your unique adsense ID.",
		"id" => "shailan_adsense_id",
		"std" => "",
		"type" => "text"),
	
	array(  "name" => "Google Analytics Code",
		"desc" => " Google Analytics Code. Will be automatically put in your <strong><em>header</em></strong>.",
		"id" => "shailan_analytics_code",
		"std" => "",
		"type" => "textarea"),
	
array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => "shailan_favicon",
	"type" => "text",
	"std" => get_bloginfo('url') ."/favicon.ico"),	
	
array( "name" => "Feedburner URL",
	"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website",
	"id" => "shailan_feedburner",
	"type" => "text",
	"std" => get_bloginfo('rss2_url')),
	
array( "type" => "close")

);

?>