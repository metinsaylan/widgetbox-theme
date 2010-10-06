<?php 

$widgetbox_page_width = get_option('widgetbox_page_width');

	if ( function_exists( 'add_custom_image_header' ) ) {
		define( 'HEADER_TEXTCOLOR', '' );
		define( 'HEADER_IMAGE', '%s/headers/header-default.jpg' );
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'widgetbox_header_image_width', $widgetbox_page_width ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'widgetbox_header_image_height', 320 ) );
		define( 'NO_HEADER_TEXT', false );

		add_custom_image_header( '', 'widgetbox_admin_header_style' );

		if(function_exists('register_default_headers')){
		// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
		register_default_headers( array(
			'blue' => array(
				'url' => '%s/headers/blue.jpg',
				'thumbnail_url' => '%s/headers/blue-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Blue background', 'widgetbox' )
			), 
			'slate' => array(
				'url' => '%s/headers/slate.jpg',
				'thumbnail_url' => '%s/headers/slate-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Slate background', 'widgetbox' )
			),
			'grass' => array(
				'url' => '%s/headers/grass.jpg',
				'thumbnail_url' => '%s/headers/grass-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Grass background', 'widgetbox' )
			)
			
		) );	}
	}

if ( ! function_exists( 'widgetbox_admin_header_style' ) ) :
	function widgetbox_admin_header_style() {
	?>
	<style type="text/css">
	#headimg {
		height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
		width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
	}
	#headimg h1, #headimg #desc {
		/*display: none;*/
	}
	</style>
	<?php
	}
endif;