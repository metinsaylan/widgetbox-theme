<?php get_header() ?>
	<div id="container" class="container_12">
		<div id="content-wrapper" class="grid_8">
			<div id="content">
			<?php stf_widgets('content', array('stf_navigation', 'stf_blog_posts', 'stf_navigation') ); ?>
			</div>
		</div><!-- #content -->
		
		<div id="sidebar-wrapper" class="grid_4">
			<?php get_sidebar() ?>
		</div>		
	</div><!-- #container -->
<?php get_footer() ?>