<?php get_header() ?>

	<div id="container">
	
		<?php include_once('featured.php'); ?>
	
		<div id="content">
		
		<?php if(!dynamic_sidebar('widgets-content')){
			// No widget here.. Let's put some blog posts..
			the_widget('wb_posts_widget');
			if(is_single()){ the_widget('wb_comments'); };
		}; ?>

		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar() ?>
<?php get_footer() ?>