<?php
// ENABLE DEBUG
/* if(!WP_DEBUG){  define ('WP_DEBUG', true); }
@ini_set('log_errors','On');
@ini_set('display_errors','On'); */

/* Theme name */
if(TEMPLATEPATH !== STYLESHEETPATH){ $themename = ucfirst(get_stylesheet()); } 
	else { $themename = "Widgetbox"; }

/* Load Smart layout generator if enabled */
if(!defined('WB_SMARTLAYOUT') || WB_SMARTLAYOUT){ include_once(TEMPLATEPATH . "/app/wb_layout.php"); };

/* Init framework */
include_once('framework/shailan-framework.php'); // Load Framework

// Load options (automattic options page)
if(TEMPLATEPATH !== STYLESHEETPATH && file_exists(trailingslashit(get_stylesheet_directory()) . 'options.php')){
	include_once(trailingslashit(get_stylesheet_directory()) . 'options.php');
} else {
	include_once(trailingslashit(get_template_directory()) . 'options.php');
}
$stf->extend_options($options);

// Add sidebars (automatically register)
$stf->add_widget_area('Topbar', 'topbar', '', '');
$stf->add_widget_area('Header', 'header', '', '');
$stf->add_widget_area('Content', 'content', '', '');
$stf->add_widget_area('Sidebar1', 'sidebar1', '', '');
$stf->add_widget_area('Sidebar2', 'sidebar2', '', '');
$stf->add_widget_area('Footer Columns', 'footer-columns', '', '');
$stf->add_widget_area('Footer Wide', 'footer-wide', '', '');

// Define image sizes
$image_sizes = array(
	'featured_post_thumbnail' => '125x125',
	'index_thumbnail' => '200x200',
	'post_teaser' => '250x250'
);

$theme_options = array(
	"name" => $themename,
	"shortname" => "widgetbox", 
	"domain" => "shailan",
	"editor_style" => true,
	"nav_menus" => true,
	"custom_background" => true,
	"post_thumbnails" => true,
	"automatic_feed_links" => true,
	"thumbnail_size" => "200x200",
	"custom_image_sizes" => $image_sizes,
	"localization_directory" => TEMPLATEPATH . '/languages'
);
$stf->setupTheme($theme_options);

// Custom header support
include_once('app/wb_custom_header.php');

function widgetbox_body_class($classes){
	global $wp_query, $wpdb;
	$layout = get_option('widgetbox_active_layout');
	$classes[] = strtolower($layout);
	return $classes;
}; add_filter( 'body_class', 'widgetbox_body_class');

function get_post_link(){ return "<a href=\"".get_permalink()."\" class=\"post-link\">".get_the_title()."</a>"; }


?>