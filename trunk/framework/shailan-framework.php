<?php
/** SHAILAN THEME FRAMEWORK 
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

global $stf;
global $theme_data;

class Shailan_Framework{

	/** Constructor */
	function Shailan_Framework(){
	
		$this->version = "1.0";
		
		// Get theme data once
		$this->stylesheet = get_stylesheet();
		$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );		
		$this->theme = $theme_data;
		
		// Load shortcodes, widgets, template tags
		require_once("shailan-loader.php");
		
		require_once("stf-options.php");
		$this->default_options = $options;
		
		$this->widget_areas = array();
		$this->settings = $this->get_settings();
		
		add_action( 'admin_init', array(&$this, 'theme_admin_init') );
		add_action( 'admin_menu', array(&$this, 'theme_admin_header') );
		add_action( 'widgets_init', array(&$this, 'theme_register_sidebars') );
	}
	
	function get_settings(){
		// Get settings
		$settings = get_option('stf_settings');		
		
		if(FALSE === $settings){ // Options doesn't exist, install standard settings
			// Create settings array
			$settings = array();
			// Set default values
			foreach($this->default_options as $option){
				$settings[$option['id']] = $option['std'];
			}
			$settings['stf_version'] = $this->version;
			// Save the settings
			update_option('stf_settings', $settings);
		} else { // Options exist, update if necessary
			$ver = $settings['stf_version'];
			
			if($ver != $this->version){ // Update needed
				// TODO : add updates here.
				
				return $settings;				
			} else { // Everythings gonna be alright. Return.
				return $settings;
			} 
		}		
	}
	
	/** Setup theme */
	function setupTheme($args){
		$defaults = array(
			"name" => "Shailan Theme Framework",
			"shortname" => "stf",
			"domain" => "",
			"editor_style" => false,
			"nav_menus" => false,
			"custom_background" => true,
			"post_thumbnails" => true,
			"automatic_feed_links" => true,
			"thumbnail_size" => "200x200",
			"custom_image_sizes" => "",
			"localization_directory" => TEMPLATEPATH
		);
		
		$setup_options = wp_parse_args( $args, $defaults );
		extract( $setup_options, EXTR_SKIP );
		
		$this->name = $name;
		$this->shortname = $shortname;
		
		if ( function_exists( 'add_editor_style' ) && $editor_style ) { add_editor_style(); }
		if ( function_exists( 'add_theme_support' )) {	
			if($post_thumbnails){
				add_theme_support( 'post-thumbnails' );
				$size = explode("x", $thumbnail_size);
				set_post_thumbnail_size( $size[0], $size[1], true ); 
				
				if(is_array($custom_image_sizes)){
					foreach($custom_image_sizes as $tag=>$size){
						$size = explode( "x" , $size );
						add_image_size( $tag, $size[0], $size[1], true );
					}
				}
			}
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
	
	function register_theme_options($options){
		$this->default_options = $options;
	}
	
	function extend_options($options){
		$this->default_options = array_merge((array)$options, (array)$this->default_options);
	}
	
	function theme_admin_init(){
		$file_dir=get_bloginfo('template_directory');
		
		wp_enqueue_style("options-page", $file_dir . "/framework/css/options.css", false, "1.0", "all");
		wp_enqueue_style("widgets-mod", $file_dir . "/framework/css/widgets.css", false, "1.0", "all");
	}
	
	function theme_admin_header(){
	
		if ( @$_GET['page'] == "theme-options" ) {
		
			if ( @$_REQUEST['action'] && 'save' == $_REQUEST['action'] ) {
				// Save settings
				// Get settings array
				$settings = get_option('stf_settings'); 
				
				if(FALSE === $settings){ $settings = array(); }
				
				// Set updated values
				foreach($this->default_options as $option){
					$settings[ $option['id'] ] = $_REQUEST[ $option['id'] ]; }
				
				// Save the settings
				update_option('stf_settings', $settings);
				
				// Update instance settings array
				$this->settings = $settings;
									
				header("Location: admin.php?page=theme-options&saved=true");
				die;
			} else if( @$_REQUEST['action'] && 'reset' == $_REQUEST['action'] ) {
				
				// Start a new settings array
				$settings = array();
				
				// Set standart values
				foreach($this->default_options as $option){
					$settings[$option['id']] = $option['std']; }
				
				// Save the settings
				update_option('stf_settings', $settings);
				
				// Update instance settings array
				$this->settings = $settings;
				
				header("Location: admin.php?page=theme-options&reset=true");
				die;
			}
		}
		
		add_menu_page( $this->name, $this->name, 'administrator', "theme-options", array(&$this, 'theme_admin_page') );	
	}
	
	function theme_admin_page(){
		$options = $this->default_options;
		$current = $this->get_settings();
		$title = $this->name . ' Theme Settings';		
		
		$navigation = "";
		$footer_text = "<p><small>Powered by <a href=\"http://shailan.com/wordpress/themes/framework\">Shailan Theme Framework</a></small></p>";
		
		// Render theme options page
		include_once("stf-page-options.php");
	}
	
	function add_widget_area( $name, $id, $description='', $default_widgets='' ){
		$widget_area = array(
			'name'=>$name,
			'id'=>$id,
			'description'=>$description,
			'default_widgets'=>$default_widgets
		);
		
		array_push($this->widget_areas, $widget_area);		
	}
	
	function theme_register_sidebars(){
		foreach($this->widget_areas as $widget_area){	
			register_sidebar( array(
			'name' => $widget_area['name'],
			'id' => $widget_area['id'],
			'description' => $widget_area['description'],
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) );
		}
	}
	
};

$stf = new Shailan_Framework();

function stf_get_setting($key){
	$settings = get_option('stf_settings');
	
	if(isset($settings[$key])){
		$value = $settings[$key];
		return $value;
	} else {
		return FALSE;
	}
}

function stf_remove_widget_areas(){
	// Remove all the widget areas
	$stf->widget_areas = array();
}

function stf_container_class(){
	$css_framework = stf_get_setting('stf_css_framework');
	
	$cclasses = array( 
		'None'=>'',
		'960.gs 12Column'=>'container_12',
		'960.gs 16Column'=>'container_16', 
		'Blueprint CSS'=>'container'
	);	
	
	$container_class = $cclasses[$css_framework];
	
	// if( current_user_can( 'create_users' ) ){
		$container_class .= " " . "showgrid";
	// }

	echo " class=\"" . $container_class . "\"";
}

