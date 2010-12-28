<?php get_header() ?>
	<div id="content_wrap" class="clearfix">
		<div id="content-wrapper" class="grid_8">
			<div id="content">
			<?php stf_widgets( 'home', array('stf_navigation', 'stf_blog_posts', 'stf_navigation') ); ?>
			</div>
		</div><!-- #content -->
		
		<div id="sidebar-wrapper" class="grid_4">
			<div id="sidebar">
				<?php get_sidebar() ?>
			</div>
		</div>	

		<div class="clear"></div>
	</div><!-- #container -->
<?php get_footer() ?>