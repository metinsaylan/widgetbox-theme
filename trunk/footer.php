	<div class="clear"></div>
</div><!-- #wrapper .hfeed -->

<div id="footer">
	<div class="widgets columns"> <?php if(!dynamic_sidebar('footer-columns')){ }; ?> <div class="clear"></div></div>
	<div class="widgets wide"> <?php if(!dynamic_sidebar('footer-wide')){ }; ?> <div class="clear"></div></div>
	
	<div class="clear"></div>
	
	<div id="powered-by">
		Powered by <span id="generator-link"><a href="http://wordpress.org/" title="<?php _e( 'WordPress', 'widgetbox' ) ?>" rel="generator"><?php _e( 'WordPress', 'widgetbox' ) ?></a></span> <span class="amp"> &amp; </span> <span id="theme-link"><a href="http://shailan.com/wordpress/themes/widgetbox" title="<?php _e( 'Excellent all-widget theme for wordpress', 'widgetbox' ) ?>" rel="designer"><?php _e( 'Widgetbox Theme', 'widgetbox' ) ?></a></span>
	</div>

		<div class="alignright">
			<a class="scrollit" href="#wrapper" id="return_to_top" title="Return to top of the page"><div>top of page</div></a>
		</div>

</div><!-- #footer -->

<?php wp_footer() ?>

</body>
</html>