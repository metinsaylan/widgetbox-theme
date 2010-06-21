<?php 

// WIDGETBOX SIDEBARS

if ( function_exists('register_sidebar') ) {

			register_sidebar(array(
		        'id' 			=>	'widgets-header',
		        'name'			=>	'Header',
		        'description'	=>	'Header widgets come here. (Blog title, Navigation, Adsense..)',
		        'before_widget'	=>	'<div id="%1$s" class="widget header-widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));	
			
			register_sidebar(array(
		        'id' 			=>	'widgets-entry-top',
		        'name'			=>	'Entry top widgets',
		        'description'	=>	'Entry top widgets come here: Entry Meta, Ads etc.',
		        'before_widget'	=>	'<div id="%1$s" class="widget entry-widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));	
			
			register_sidebar(array(
		        'id' 			=>	'widgets-entry-bottom',
		        'name'			=>	'Entry bottom widgets',
		        'description'	=>	'Entry bottom widgets come here.',
		        'before_widget'	=>	'<div id="%1$s" class="widget entry-widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));	

		    register_sidebar(array(
		        'id' 			=>	'widgets-sidebar-1',
		        'name'			=>	'Sidebar 1',
		        'description'	=>	'Top sidebar widgets',
		        'before_widget'	=>	'<div id="%1$s" class="widget sidebar-widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));		
			
			register_sidebar(array(
		        'id' 			=>	'widgets-sidebar-2',
		        'name'			=>	'Sidebar 2',
		        'description'	=>	'Lower widgets on sidebar',
		        'before_widget'	=>	'<div id="%1$s" class="widget sidebar-widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));	
			
			register_sidebar(array(
		        'id' 			=>	'widgets-footer-columns',
		        'name'			=>	'Footer columns',
		        'description'	=>	'Footer with a column layout. Automatically resizes column widths.',
		        'before_widget'	=>	'<div id="%1$s" class="widget footer-widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));	
			
			register_sidebar(array(
		        'id' 			=>	'widgets-footer',
		        'name'			=>	'Footer wide',
		        'description'	=>	'Wide, center aligned footer.',
		        'before_widget'	=>	'<div id="%1$s" class="widget footer-widget %2$s"><div class="widget-inner">',
		        'after_widget'	=>	'</div></div>',
		        'before_title'	=>	'<h4 class="widget-title"><span>',
		        'after_title'	=>	'</span></h4>'
		    ));	

}

?>