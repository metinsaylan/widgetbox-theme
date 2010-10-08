<?php 

/** SHAILAN THEME FRAMEWORK 
 File 		: shailan-templates.php
 Author		: Matt Say
 Author URL	: http://shailan.com
 Version	: 1.0
 Contact	: metinsaylan (at) gmail (dot) com
*/

/** CONSTANTS */
define('THEME_IMAGES_DIRECTORY', trailingslashit(get_bloginfo('stylesheet_directory')) . 'images');

function get_theme_image($filename, $dimensions=NULL, $classname='', $alt='' ){
	$img = '<img src="' . THEME_IMAGES_DIRECTORY . '/' . $filename . '"';
	
	if(!empty($dimensions)){
		$dimensions = explode('x', $dimensions); 
		$img .= ' width="'.$dimensions[0].'" height="'.$dimensions[1].'"';
	}
	
	if(!empty($classname)){ $img .= ' class="'.$classname.'"';}
	if(!empty($alt)){ $img .= ' alt="'.$alt.'"';}
	
	$img .= ' />';
	return $img;
}

function theme_image($filename, $dimensions=NULL, $classname='', $alt='' ){
	echo get_theme_image($filename, $dimensions, $classname, $alt);
} 

function stf_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'comment' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="arrow"></div>		
		<div class="comment-author-avatar vcard">
			<a href="<?php echo get_comment_author_url( get_comment_ID() ); ?>" rel="external nofollow" title="<?php echo comment_author(); ?>">
				<?php echo get_avatar( $comment, 40 ); ?>
			</a>
		</div><!-- .comment-author .vcard -->
		
		<div class="comment-body">
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'widgetbox' ); ?></em>
			<br />
			<?php endif; ?>
			<div class="comment-meta commentmetadata">
			  <span class="comment-author"><?php printf( sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></a></span>
			  <span class="comment-date"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php
					/* translators: 1: date, 2: time */
					printf( __( '<span title="at %2$s">%1$s</span>', 'widgetbox' ), get_comment_date('M j, Y'),  get_comment_time() ); ?></a></span>
				<span class="comment-edit-link"><?php edit_comment_link( __( 'edit', 'widgetbox' ), ' ' );	?></a>
			</div><!-- .comment-meta .commentmetadata -->
			<div class="comment-text"><?php comment_text(); ?></div>
		</div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
		
		<div class="clear"></div>
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
