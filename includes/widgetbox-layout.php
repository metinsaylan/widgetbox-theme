<?php 

/** Widgetbox Smart Layout (content widths & paddings) */

/** Set up content width */
if ( ! isset( $content_width ) ){
	$widgetbox_page_width = get_option('widgetbox_page_width');
	$widgetbox_sidebar_width = get_option('widgetbox_sidebar_width');
	$widgetbox_padding = get_option('widgetbox_padding');

	$content_width = $widgetbox_page_width - $widgetbox_sidebar_width - $widgetbox_padding;
}

function wb_layout_styles(){

		$widgetbox_page_width = get_option('widgetbox_page_width');
		$widgetbox_sidebar_width = get_option('widgetbox_sidebar_width');
		$widgetbox_padding = get_option('widgetbox_padding');
		
		$content_width = $widgetbox_page_width - $widgetbox_sidebar_width - $widgetbox_padding * 2;
		$post_width = $content_width - 2*$widgetbox_padding;
		
		$content_margin = $widgetbox_sidebar_width + 2*$widgetbox_padding;
		$secondary_widget_width = ($widgetbox_sidebar_width>250 ? round(($widgetbox_sidebar_width - 2*$widgetbox_padding)/2) : $widgetbox_sidebar_width);
		
		$thumbnail_margin = -90 - $widgetbox_padding;
		
		$indent = "\n\t\t";

		echo "\n<!-- Start of Widgetbox Smart Layout Styles -->";
		echo "\n\t<style type=\"text/css\" media=\"all\">";
		
		echo $indent . "div#wrapper{ width: ".$widgetbox_page_width."px; margin:".$widgetbox_padding."px auto; padding-bottom:".$widgetbox_padding."px }";
		echo $indent . "div#primary .widget, .entry-content, .entry-header{ margin-bottom: ".$widgetbox_padding."px; }";
		echo $indent . "div#container{ padding-top: ".$widgetbox_padding."px; margin:0px -".$content_margin."px 0px 0px; }";
		echo $indent . "#respond{ padding: ".$widgetbox_padding."px; }";
		echo $indent . "#comments-list ol{ margin: ".$widgetbox_padding."px; }";
		echo $indent . "div#content{ margin:0px ".$content_margin."px 0px ".$widgetbox_padding."px; padding:".$widgetbox_padding."px; }";
		echo $indent . "img.size-full{max-width: ".$post_width."px; border:none; padding:0; margin:0px auto ".$widgetbox_padding."px auto; } * html img.size-full{width: ".$post_width."px}";
		echo $indent . ".hentry{ margin-bottom:".$widgetbox_padding."px; padding-bottom:".$widgetbox_padding."px }";
		echo $indent . ".entry-thumb{ float:left; padding:0px; margin-left:".$thumbnail_margin."px; }";
		
		echo $indent . "div#primary{width: ".($widgetbox_sidebar_width)."px; margin:0px; margin-top:".$widgetbox_padding."px; margin-bottom:".$widgetbox_padding."px; margin-right:".$widgetbox_padding."px}";
		echo $indent . "div#secondary{width: ".($widgetbox_sidebar_width)."px; margin:0px; margin-right:".$widgetbox_padding."px}";
		/*echo $indent . "div#secondary .widget{width: ".$secondary_widget_width."px; float:right; }";	*/

		echo $indent . "div#footer{ width: ".$widgetbox_page_width."px; margin:".$widgetbox_padding."px auto; padding-bottom:".$widgetbox_padding."px }";
		
		/** TODO : move header styles out! */
		echo $indent . "div#header{ background-position: bottom center; background-repeat: no-repeat; background-image: url(".get_header_image()."); }";
		
		echo "\n\t</style>";
		echo "\n<!-- End of Widgetbox Layout Styles -->";
		echo "\n ";
}

// Hook it up.
add_action( 'wp_head', 'wb_layout_styles' );
