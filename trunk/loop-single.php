<?php
$post_index = 1;

while ( have_posts() ): the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="entry-header">
			<div class="entry-header-top"></div>
			<div class="entry-header-middle">
				<?php edit_post_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
				
				<?php dynamic_sidebar(); ?>
			</div>
			<div class="entry-header-bottom"></div>
		</div><!-- .entry-head -->

		<?php include_once('share.php'); ?>
		
		<div class="entry-content">
			<div class=""></div>
			<?php the_content( sprintf( __('Continue reading \'%s\'', 'k2_domain'), the_title('', '', false) ) ); ?>
			
			<div class="entry-content-bottom"></div>
		</div><!-- .entry-content -->		
		
		<div class="entry-footer">
			<?php wp_link_pages( array('before' => '<div class="entry-pages"><span>' . __('Pages:','k2_domain') . '</span>', 'after' => '</div>' ) ); ?>


			
			<div class="entry-footer-bottom"></div>
		</div><!-- .entry-foot -->		
		
		<div class="clear"></div>		
	</div><!-- #post-ID -->

<?php endwhile; /* End The Loop */ ?>

<?php dynamic_sidebar('single-widgets-bottom'); ?>
