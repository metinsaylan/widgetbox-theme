<?php get_header() ?>

	<div id="container">
		<div id="single-widgets-top"><?php dynamic_sidebar('single-widgets-top'); ?></div>
		<div id="content">
		
<?php $post_index = 1; while ( have_posts() ): the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="entry-header">
				<?php edit_post_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-header -->

		<?php //include_once('share-inline.php'); ?>
		
		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->		
		
		<div class="entry-footer">
			<?php wp_link_pages( array('before' => '<div class="entry-pages"><span>' . __('Pages:','widgetbox') . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-footer -->		
		
		<div class="clear"></div>		
	</div><!-- #post-ID -->
	
		<?php comments_template( '', true ); ?>

<?php endwhile; ?>

		<div id="single-widgets-bottom"><?php dynamic_sidebar('single-widgets-bottom'); ?></div>
		
		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar() ?>
<?php get_footer() ?>