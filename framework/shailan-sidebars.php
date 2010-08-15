<?php 

// SHAILAN ALL WIDGET SIDEBARS

if ( function_exists('register_sidebar') ) {

function shailan_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Top widget area', 'shailan' ),
		'id' => 'top-bar',
		'description' => __( 'Will be displayed on top of everything.', 'shailan' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Header', 'shailan' ),
		'id' => 'header-widgets',
		'description' => __( 'Header widgets.', 'shailan' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Content', 'shailan' ),
		'id' => 'content-widgets',
		'description' => 'You must have at least one blog posts widget here. Leave blank if not sure.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Singular top', 'shailan' ),
		'id' => 'single-widgets-top',
		'description' => __( 'Will be displayed before posts and pages.', 'shailan' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Singular bottom', 'shailan' ),
		'id' => 'single-widgets-bottom',
		'description' => __( 'Will be displayed after post or page content.', 'shailan' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Primary Sidebar', 'shailan' ),
		'id' => 'primary-sidebar',
		'description' => __( 'Your primary sidebar.', 'shailan' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', 'shailan' ),
		'id' => 'secondary-sidebar',
		'description' => __( 'Secondary sidebar.', 'shailan' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Columns', 'shailan' ),
		'id' => 'footer-columns',
		'description' => __( 'Four column widget area', 'shailan' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Wide', 'shailan' ),
		'id' => 'footer-wide',
		'description' => __( 'Single column footer. You can also add your footer scripts here ;)', 'shailan' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'shailan_widgets_init' );

}



?>