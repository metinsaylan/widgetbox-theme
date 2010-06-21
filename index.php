<?php get_header() ?>

	<div id="container">
		<div id="content">
		
		<?php if(!dynamic_sidebar('widgets-content')){
			// No widget here.. Let's put some blog posts..
			the_widget('wb_posts_widget');
		}; ?>

		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar() ?>
<?php get_footer() ?>