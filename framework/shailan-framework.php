<?php
/** SHAILAN THEME FRAMEWORK 
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

class Shailan_Framework{

	/** Constructor */
	function Shailan_Framework(){
	
	}
	
	/** Setup theme */
	function setupTheme($args){
		$defaults = array(
			"domain" => "",
			"editor_style" => false,
			"nav_menus" => false,
			"custom_background" => true,
			"post_thumbnails" => true,
			"automatic_feed_links" => true,
			"thumbnail_size" => "200x200",
			"localization_directory" => TEMPLATEPATH
		);
		
		$setup_options = wp_parse_args( $args, $defaults );
		extract( $setup_options, EXTR_SKIP );
		
	if ( function_exists( 'add_editor_style' ) && $editor_style ) { add_editor_style(); }
	if ( function_exists( 'add_theme_support' )) {	
		if($post_thumbnails){
			add_theme_support( 'post-thumbnails' );
			// TODO: split size & set it here
			set_post_thumbnail_size( 200, 200, true ); }
		if( $nav_menus ){ add_theme_support( 'nav-menus' ); }
		if( $automatic_feed_links ){ add_theme_support( 'automatic-feed-links' ); }
	}
	
	/*if( $domain )*/
		load_theme_textdomain( $domain, $localization_directory );
		$locale = get_locale();
		$locale_file = $localization_directory . "/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );

	if ( function_exists( 'add_custom_background' ) && $custom_background ) { add_custom_background(); }
	
	}

};

require_once("shailan-loader.php");