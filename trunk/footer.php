	<div class="clear"></div>
</div><!-- #wrapper .hfeed -->

<div id="footer">
	<div class="widgets columns"> <?php stf_widgets('footer-columns'); ?> <div class="clear"></div></div>
	<div class="widgets wide"> <?php stf_widgets('footer'); ?> <div class="clear"></div></div>
	
	<div class="clear"></div>
	
	<div id="powered-by">
		Powered by <span id="generator-link"><a href="http://wordpress.org/" title="<?php _e( 'WordPress', 'widgetbox' ) ?>" rel="generator external nofollow"><?php _e( 'WordPress', 'widgetbox' ) ?></a></span> <span class="amp"> &amp; </span> <span id="theme-link"><a href="http://shailan.com/wordpress/themes/widgetbox" title="<?php _e( 'Excellent all-widget theme for wordpress', 'widgetbox' ) ?>" rel="designer external"><?php echo get_theme_name(); ?></a></span>
	</div>

		<div class="alignright">
			<a class="scrollit" href="#wrapper" id="return_to_top" title="Return to top of the page"><div>top of page</div></a>
		</div>

</div><!-- #footer -->

<?php wp_footer() ?>

</body>
</html>