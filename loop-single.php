<?php
/**
 * Default Loop Template
 *
 * This file is loaded by multiple files and used for generating the loop
 *
 */

// Post index for semantic classes
$post_index = 1;

while ( have_posts() ): the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="entry-header">
			<div class="entry-header-top"></div>
			<div class="entry-header-middle">
			
			<!-- <h3 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php /*k2_permalink_title(); */ ?>"><?php the_title(); ?></a>
			</h3> -->

			<?php do_action('template_entry_head'); ?>
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

			<?php do_action('template_entry_foot'); ?>
			
			<div class="entry-footer-bottom"></div>
		</div><!-- .entry-foot -->		
		
		<div class="clear"></div>		
	</div><!-- #post-ID -->

<?php endwhile; /* End The Loop */ ?>
