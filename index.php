<?php get_header() ?>
	<div id="container">
		<?php // include_once('featured.php'); ?>
		<div id="content">
		<?php stf_widgets('content', array('stf_navigation', 'stf_blog_posts', 'stf_navigation') ); ?>
		</div><!-- #content -->
	</div><!-- #container -->
<?php get_sidebar() ?>
<?php get_footer() ?>