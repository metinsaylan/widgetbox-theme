<?php $post_index = 1; while ( have_posts() ): the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="entry-header">
				<?php edit_post_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

		<div class="entry-content">
			<?php the_content( sprintf( __('Continue reading \'%s\'', 'widgetbox'), the_title('', '', false) ) ); ?>
		</div><!-- .entry-content -->		
		
		<div class="entry-footer">
			<?php wp_link_pages( array('before' => '<div class="entry-pages"><span>' . __('Pages:','widgetbox') . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-foot -->		
		
		<div class="clear"></div>		
	</div><!-- #post-ID -->

<?php endwhile; ?>
