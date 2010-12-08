<?php
/** SHAILAN THEME FRAMEWORK 
 File 		: shailan-loader.php
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

include_once('stf-utilities.php'); // GENERIC FUNCTIONS
include_once('stf-shortcodes.php'); // SHORTCODES
include_once('stf-templates.php'); // CUSTOM TEMPLATES
include_once('stf-social.php'); // SOCIAL

// WIDGETS
function stf_widget_footer(){
	echo "<div class=\"widget-control-actions\">
		<p><small>Powered by <a href=\"http://shailan.com/wordpress/themes/framework/\">STF</a></small></p>
		</div>";
}

include_once('widgets/stf-blog-posts.php'); // POSTS NAVIGATION
include_once('widgets/stf-blog-title.php'); // BLOG TITLE
include_once('widgets/stf-featuredposts.php'); // POSTS NAVIGATION
include_once('widgets/stf-navigation.php'); // POSTS NAVIGATION
include_once('widgets/stf-pagenavi.php'); // POSTS NAVIGATION

// Other interfaces
include_once('stf-typography.php'); // TYPOGRAPHY





