<?php 

$shortname = "widgetbox";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 

// LOAD THEMES
/*$wb_themes = array();
$dirpath =  TEMPLATEPATH.'/css/schemes/';
$dh = opendir($dirpath);

while (false !== ($file = readdir($dh))) {
	//Don't list subdirectories
	if (!is_dir("$dirpath/$file")) {
		//Truncate the file extension and capitalize the first letter
		$wb_themes[] = htmlspecialchars(preg_replace('/\..*$/', '', $file));
	}
}*/

// LOAD LAYOUTS
$wb_layouts = array();
$dirpath =  TEMPLATEPATH.'/css/layouts/';
$dh = opendir($dirpath);

while (false !== ($file = readdir($dh))) {
	//Don't list subdirectories
	if (!is_dir("$dirpath/$file")) {
		//Truncate the file extension and capitalize the first letter
		$wb_layouts[] = htmlspecialchars(preg_replace('/\..*$/', '', $file));
	}
}

$options = array (
 
array( "name" => "General Options",
	"type" => "section"),
array( "type" => "open"),

	array(  "name" => "Featured Posts Category",
		"desc" => "Will be displayed on homepage.",
		"id" => $shortname . "_featured_cat",
		"std" => "",
		"options" => $wp_cats,
		"type" => "select"),

array( "type" => "close"),
 
array( "name" => "Layout & Color Scheme",
	"type" => "section"),
array( "type" => "open"),

	array(  "name" => "Page layout",
		"desc" => "Layout of the containers.",
		"id" => $shortname."_active_layout",
		"std" => "2c-r",
		"options" => $wb_layouts,
		"type" => "select"),
		
	/*array(  "name" => "Color scheme",
		"desc" => " Color scheme for widgetbox.",
		"id" => $shortname."_active_theme",
		"std" => "light",
		"options" => $wb_themes,
		"type" => "select"),*/
			
	array(  "name" => "Page width",
		"desc" => "px. Width of the main container.",
		"id" => $shortname."_page_width",
		"std" => "980",
		"type" => "text"),
		
	array(  "name" => "Sidebar width",
		"desc" => "px. Width of the sidebar.",
		"id" => $shortname."_sidebar_width",
		"std" => "300",
		"type" => "text"),
		
	array(  "name" => "Padding",
		"desc" => "px. Overall theme padding.",
		"id" => $shortname."_padding",
		"std" => "15",
		"type" => "text"),

	array( "name" => "Custom CSS",
		"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
		"id" => $shortname."_custom_css",
		"type" => "textarea",
		"std" => ""),		

array( "type" => "close"),

array( "name" => "Ads & Customization",
	"type" => "section"),
array( "type" => "open"),
	
	array(  "name" => "Google Ads Unique ID",
		"desc" => " Your unique ads ID.",
		"id" => "shailan_ads_id",
		"std" => "",
		"type" => "text"),
	
	array(  "name" => "Google Analytics Code",
		"desc" => " Google Analytics Code. Will be automatically put in your <strong><em>header</em></strong>.<br /> Please update your code to use latest google analytics code that is used in header.",
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

 
array( "type" => "close"),

array( "name" => "Advanced Features",
	"type" => "section"),
array( "type" => "open"),
	
	array(  "name" => "Twitter Anywhere",
		"desc" => "Activate twitter @anywhere",
		"id" => "shailan_twitter_anywhere",
		"std" => "",
		"options" => array('enabled', 'disabled'),
		"type" => "select"),
		
	array(  "name" => "Twitter Anywhere API KEY",
		"desc" => "Please enter your @anywhere api key.",
		"id" => "shailan_twitter_anywhere_key",
		"std" => "",
		"type" => "text"),
 
array( "type" => "close")
 
);

?>