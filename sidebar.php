	<div id="primary" class="sidebar">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('widgets-sidebar-1') ) : // begin primary sidebar widgets
		// No widget? Hmm, How about subscribe?
	endif; // end primary sidebar widgets  ?>

	</div><!-- #primary .sidebar -->

	<div id="secondary" class="sidebar">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('widgets-sidebar-2') ) : // begin secondary sidebar widgets ?>
			
<?php endif; // end secondary sidebar widgets  ?>
	</div><!-- #secondary .sidebar -->
