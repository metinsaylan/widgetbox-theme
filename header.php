<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php wp_title( '@', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ) ?></title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory'); ?>/css/reset.css" />
	<?php $layout = get_option('widgetbox_active_layout'); if(!empty($layout)){ ?>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/layouts/<?php echo $layout; ?>.css" />
	<?php } ?>
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url') ?>" />
	
		<?php wp_head() // For plugins ?>

	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'widgetbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'widgetbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	
</head>

<body <?php body_class() ?>>

<?php do_action('template_body_top'); ?>

<div id="top-bar">
	<?php dynamic_sidebar('top-bar'); ?>
	
	<div class="clear"></div>
</div>

<div id="wrapper" class="hfeed">
<div id="header">
		<?php		
			if(!dynamic_sidebar('header-widgets')){
				// No widget? Let's use a blog title then..
				the_widget('wb_blog_title', ''); 
			};
		?>
		
		<!-- 
		<div id="header-image-wrapper">
			<?php
			// Check if this is a post or page, if it has a thumbnail, and if it's a big one
			if ( is_singular() && function_exists('has_post_thumbnail') &&
					has_post_thumbnail( $post->ID ) &&
					( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
					$image[1] >= HEADER_IMAGE_WIDTH ) :
				// Houston, we have a new header image!
				echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
			else : ?>
				<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" id="header-image" />
			<?php endif; ?>
		</div>
		-->
</div>