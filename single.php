<?php get_header() ?>

	<div id="container">
	
		<div id="single-widgets-top"><?php dynamic_sidebar('single-widgets-top'); ?></div>
	
		<div id="content">
		
<?php $post_index = 1; while ( have_posts() ): the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="entry-header">
				<?php edit_post_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-header -->

		<?php include_once('share-inline.php'); ?>
		
		<div class="entry-content">
			<?php the_content( sprintf( __('Continue reading \'%s\'', 'k2_domain'), the_title('', '', false) ) ); ?>
		</div><!-- .entry-content -->		
		
		<div class="entry-footer">
			<?php wp_link_pages( array('before' => '<div class="entry-pages"><span>' . __('Pages:','k2_domain') . '</span>', 'after' => '</div>' ) ); ?>
			
			<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink()); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=80&amp;action=recommend&amp;font=segoe+ui&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="1" style="border:none; overflow:hidden; width:80px; height:21px;" allowTransparency="true"></iframe>
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