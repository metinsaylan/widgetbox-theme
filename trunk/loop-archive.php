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
	
	<?php if ( has_post_thumbnail() ) { ?>
	
	<div class="entry-thumb">
		<a href="<?php the_permalink(); ?>" rel="bookmark" >
			<?php // the current post has a thumbnail
				the_post_thumbnail(array(150,125)); ?>
		</a>
	</div>	
				
	<?php } else { /* the current post lacks a thumbnail */  } ?>

	
		<div class="entry-header">
			<div class="entry-header-top"></div>
			<div class="entry-header-middle">
			
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php /*k2_permalink_title(); */ ?>"><?php the_title(); ?></a>
			</h3>

			<div class="entry-meta">
				<span>by</span> <a href="http://twitter.com/<?php the_author_meta('twitter'); ?>" rel="nofollow" class="twitter-link">@<?php the_author_meta('twitter'); ?></a> (<a href="<?php global $authordata; echo get_author_posts_url( $authordata->ID, $authordata->user_nicename ); ?>" title="">see all posts</a>) <span>|</span> <span class="date"><?php the_date(); ?></span>
			
			</div>
			
			<?php do_action('template_entry_head'); ?>
			</div>
			<div class="entry-header-bottom"></div>
		</div><!-- .entry-head -->

		<div class="entry-excerpt">
			<div class=""></div>
			<?php the_excerpt( sprintf( __('Continue reading \'%s\'', 'k2_domain'), the_title('', '', false) ) ); ?>
			
			<div class="entry-content-bottom"></div>
		</div><!-- .entry-content -->		
		
		<div class="entry-footer">
			<?php wp_link_pages( array('before' => '<div class="entry-pages"><span>' . __('Pages:','k2_domain') . '</span>', 'after' => '</div>' ) ); ?>

			<?php do_action('template_entry_foot'); ?>
			
			
			
			<div class="entry-meta">
				<span class="categories"><?php _e('Categories') ?>: <?php the_category(' &bull; '); ?></span><br />
				<span class="tags"><?php _e('Tags') ?>: <?php the_tags('<span class="hash">#</span>',', <span class="hash">#</span>',''); ?></span>
			</div>
			<div class="entry-footer-bottom"></div>
		</div><!-- .entry-foot -->		
		
		<div class="clear"></div>		
	</div><!-- #post-ID -->

<?php endwhile; /* End The Loop */ ?>
