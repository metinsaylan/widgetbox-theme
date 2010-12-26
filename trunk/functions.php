<?php
// LOAD FRAMEWORK
include_once('framework/stf-framework.php');

// SIDEBARS
$stf->add_widget_area('Topbar', 'topbar', '', '');
$stf->add_widget_area('Header', 'header', '', '');
$stf->add_widget_area('Home page', 'home', '', '');
$stf->add_widget_area('Inner page', 'inner', '', '');
$stf->add_widget_area('Sidebar Top', 'sidebar1', '', '');
$stf->add_widget_area('Sidebar Bottom', 'sidebar2', '', '');
$stf->add_widget_area('Footer Column1', 'column1', '', '');
$stf->add_widget_area('Footer Column2', 'column2', '', '');
$stf->add_widget_area('Footer Column3', 'column3', '', '');
$stf->add_widget_area('Footer', 'footer', '', '');

function register_menus() {
  register_nav_menus(array( 
	'top-navigation' => __( 'Top' ),
	'header-bottom' => __('Header Navigation'),
	'footer' => __('Footer')
  ));
} add_action( 'init', 'register_menus' );


// THUMB SIZES
$image_sizes = array(
	'featured' => '125x125',
	'frontpage' => '200x200',
	'teaser' => '250x250'
);

// THEME OPTIONS
$theme_options = array(
	"shortname" => "widgetbox",  // For options
	"domain" => "shailan", // For translations
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
function get_post_link(){ return "<a href=\"".get_permalink()."\" class=\"post-link\">".get_the_title()."</a>"; }

?>