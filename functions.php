<?php

// ENABLE DEBUG
if(!WP_DEBUG){  define ('WP_DEBUG', true); }
@ini_set('log_errors','On');
@ini_set('display_errors','On');

/** Load Smart layout generator if enabled */
if(!defined('WB_SMARTLAYOUT') || WB_SMARTLAYOUT){ include_once(TEMPLATEPATH . "/app/widgetbox-layout.php"); };

// FRAMEWORK
include_once('framework/shailan-framework.php'); // Load Framework

$image_sizes = array(
	'featured_post_thumbnail' => '125x125',
	'index_thumbnail' => '200x200',
	'post_teaser' => '250x250'
);

$theme_options = array(
	"domain" => "shailan",
	"editor_style" => true,
	"nav_menus" => true,
	"custom_background" => true,
	"post_thumbnails" => true,
	"automatic_feed_links" => true,
	"thumbnail_size" => "200x200",
	"custom_image_sizes" => $image_sizes,
	"localization_directory" => TEMPLATEPATH . '/languages'
);

$framework = new Shailan_Framework();
$framework->setupTheme($theme_options);

// Custom header support
include_once('app/wb_custom_header.php');

function widgetbox_body_class($classes){
	global $wp_query, $wpdb;
	$layout = get_option('widgetbox_active_layout');
	$classes[] = strtolower($layout);
	return $classes;
}; add_filter( 'body_class', 'widgetbox_body_class');

function widgetbox_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'comment' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'widgetbox' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'widgetbox' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'widgetbox' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'widgetbox' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'widgetbox' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'widgetbox'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

/**
 * Returns HTML with meta information for the current post—date/time and author.
 */
function widgetbox_posted_on() {
	return sprintf( __( '<span %1$s>Posted on</span> %2$s by %3$s', 'widgetbox' ),
		'class="meta-prep meta-prep-author"',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a> <span class="meta-sep">',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '</span> <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>', 
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'widgetbox' ), get_the_author() ),
			get_the_author()
		)
	);
	
}

/**
 * Returns HTML with meta information for the current post—category, tags and permalink
 */

function widgetbox_posted_in() {
	$tag_list = get_the_tag_list( '', ', ', '' );
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'widgetbox' );
	} else {
		$utility_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'widgetbox' );
	}
	return sprintf(
		$utility_text,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' ),
		get_post_comments_feed_link()
	);	
}

function widgetbox_init() {
    if(!is_admin()){
		// Load theme scripts
		wp_enqueue_script('jquery'); 
		wp_enqueue_script('cycle', get_bloginfo('template_directory').'/js/jquery.cycle.all.min.js', 'jquery'); 		
		wp_enqueue_script('prototype');  
		wp_enqueue_script('scriptaculous');   //Effect.ScrollTo
		wp_enqueue_script('widgetbox', get_bloginfo('template_directory').'/js/widgetbox.js', 'jquery'); 
	} else {
		// Load admin scripts
	}
}    
add_action('init', 'widgetbox_init');

function get_post_link(){ return "<a href=\"".get_permalink()."\" class=\"post-link\">".get_the_title()."</a>"; }

include_once('app/wb_admin.php'); // ADMIN 

?>