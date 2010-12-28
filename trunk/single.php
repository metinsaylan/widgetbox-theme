<?php get_header() ?>
	<!-- Content wrap -->
	<div id="content_wrap" class="clearfix">
		<!-- Content -->
		<div id="content" class="container_12">
		
			<!-- Page -->
			<div id="page" class="grid_8">
				<?php $post_index = 1; while ( have_posts() ): the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<span class="entry-title"><?php the_title(); ?></span>
				
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
			</div>
			<!-- [END] Page -->
			
			<!-- Sidebar -->
			<div id="sidebar_wrapper" class="grid_4">
				<div id="sidebar">
					<?php get_sidebar() ?>
				</div>
			</div>	
			<!-- [END] Sidebar -->

		</div><!-- [END] Content -->
	</div><!-- [END] Content wrap -->
<?php get_footer() ?>