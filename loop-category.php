<?php
/**
 * Default Loop Template
 *
 * This file is loaded by multiple files and used for generating the loop
 *
 * @package K2
 * @subpackage Templates
 */

// Post index for semantic classes
$post_index = 1;

while ( have_posts() ): the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-thumb">
		<a href="<?php the_permalink(); ?>" rel="bookmark" >
			<?php
			/*if ( has_post_thumbnail() ) {
				// the current post has a thumbnail
				the_post_thumbnail();
				
				//if(!is_single()){ the_post_thumbnail(); } else { the_post_thumbnail( 'single-post-thumbnail' ); };
			} else {
				// the current post lacks a thumbnail
			}*/
			?>
		</a>
	</div>
	
		<div class="entry-header">
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php /*k2_permalink_title(); */ ?>"><?php the_title(); ?></a>
			</h3>
		
			<?php if ( 'post' == $post->post_type ): ?>
			<div class="entry-meta">
				<?php //entry_meta(1); ?>
			</div> <!-- .entry-meta -->
			<?php endif; ?>

			<?php do_action('template_entry_head'); ?>
		</div><!-- .entry-head -->

		<div class="entry-content">
			<?php the_content( sprintf( __('Continue reading \'%s\'', 'k2_domain'), the_title('', '', false) ) ); ?>
		</div><!-- .entry-content -->		
		
		<div class="entry-footer">
			<?php wp_link_pages( array('before' => '<div class="entry-pages"><span>' . __('Pages:','k2_domain') . '</span>', 'after' => '</div>' ) ); ?>

			<?php if ( 'post' == $post->post_type ): ?>
			<div class="entry-meta">
				<?php //entry_meta(2); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>

			<?php do_action('template_entry_foot'); ?>
		</div><!-- .entry-foot -->		
		<div class="clear"></div>		
	</div><!-- #post-ID -->

<?php endwhile; /* End The Loop */ ?>
