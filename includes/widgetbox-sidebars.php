<?php 

// WIDGETBOX SIDEBARS

if ( function_exists('register_sidebar') ) {

			register_sidebar(array(
		        'id' 			=>	'widgets-header',
		        'name'			=>	'Header',
		        'description'	=>	'Header widgets come here. (Blog title, Navigation, Adsense..)',
		        'before_widget'	=>	'<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));	
			
			register_sidebar(array(
		        'id' 			=>	'widgets-content',
		        'name'			=>	'Content',
		        'description'	=>	'Main content area widgets. Remember to put at least one Blog posts widget here. Otherwise your blog posts won\'t appear on your site.',
		        'before_widget'	=>	'<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));	

		    register_sidebar(array(
		        'id' 			=>	'widgets-sidebar-1',
		        'name'			=>	'Sidebar 1',
		        'description'	=>	'Top sidebar widgets',
		        'before_widget'	=>	'<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));		
			
			register_sidebar(array(
		        'id' 			=>	'widgets-sidebar-2',
		        'name'			=>	'Sidebar 2',
		        'description'	=>	'Lower widgets on sidebar',
		        'before_widget'	=>	'<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));	
			
			register_sidebar(array(
		        'id' 			=>	'widgets-footer-columns',
		        'name'			=>	'Footer columns',
		        'description'	=>	'Footer with a column layout. Automatically resizes column widths.',
		        'before_widget'	=>	'<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));	
			
			register_sidebar(array(
		        'id' 			=>	'widgets-footer',
		        'name'			=>	'Footer wide',
		        'description'	=>	'Wide, center aligned footer.',
		        'before_widget'	=>	'<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));	

}

?>