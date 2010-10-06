<?php
/** SHAILAN THEME FRAMEWORK 
 File 		: shailan-loader.php
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

//include_once('shailan-sidebars.php'); // ALL WIDGET SIDEBARS
include_once('shailan-utilities.php'); // GENERIC FUNCTIONS
include_once('shailan-shortcodes.php'); // SHORTCODES
include_once('shailan-templates.php'); // CUSTOM TEMPLATES
include_once('shailan-social.php');

// WIDGETS
function stf_widget_footer(){
	echo "<div class=\"widget-control-actions\">
		<p><small>Powered by <a href=\"http://shailan.com\">Shailan</a></small></p>
		</div>";
}
include_once('widgets/stf-blog-posts.php'); // POSTS NAVIGATION
include_once('widgets/stf-blog-title.php'); // BLOG TITLE
include_once('widgets/stf-featuredposts.php'); // POSTS NAVIGATION
include_once('widgets/stf-navigation.php'); // POSTS NAVIGATION
include_once('widgets/stf-pagenavi.php'); // POSTS NAVIGATION





