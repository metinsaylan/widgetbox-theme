<?php get_header() ?>
	<!-- Content wrap -->
	<div id="content_wrap" class="clearfix">
		<!-- Content -->
		<div id="content" class="container_12">
		
			<!-- Page -->
			<div id="page" class="grid_8">
				<?php stf_widgets( 'home', array('stf_navigation', 'stf_blog_posts', 'stf_navigation') ); ?>
			</div>
			<!-- [END] Page -->
			
			<!-- Sidebar -->
			<div id="sidebar_wrapper" class="grid_4">
				<div id="sidebar">
					<?php get_sidebar() ?>
				</div>
			</div>	
			<!-- [END] Sidebar -->

		</div><!-- [END] Content -->
	</div><!-- [END] Content wrap -->
<?php get_footer() ?>