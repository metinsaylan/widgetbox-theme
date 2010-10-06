<?php 

/** SHAILAN THEME FRAMEWORK 
 File 		: shailan-images.php
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

define('THEME_IMAGES_DIRECTORY', trailingslashit(get_bloginfo('template_directory')) . 'images');

function get_theme_image($filename, $dimensions=NULL, $classname='', $alt='' ){
	$img = '<img src="' . THEME_IMAGES_DIRECTORY . '/' . $filename . '"';
	
	if(!empty($dimensions)){
		$dimensions = explode('x', $dimensions); 
		$img .= ' width="'.$dimensions[0].'" height="'.$dimensions[1].'"';
	}
	
	if(!empty($classname)){ $img .= ' class="'.$classname.'"';}
	if(!empty($alt)){ $img .= ' alt="'.$alt.'"';}
	
	$img .= ' />';
	return $img;
}

function theme_image($filename, $dimensions=NULL, $classname='', $alt='' ){
	echo get_theme_image($filename, $dimensions, $classname, $alt);
} 