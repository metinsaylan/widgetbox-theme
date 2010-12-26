	<div class="clear"></div>
</div><!-- #wrapper .hfeed -->

<div id="footer">
	<div class="widgets columns"> <?php stf_widgets('footer-columns'); ?> <div class="clear"></div></div>
	<div class="widgets wide"> <?php stf_widgets('footer'); ?> <div class="clear"></div></div>
	
	<div class="clear"></div>
	
	<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_class' => 'footer-navigation' ) ); ?>
	
	<div id="footer-links">
		<div id="theme-footer">
			<?php stf_theme_footer(); ?>
		</div>
		
		<div id="theme-link">
			Powered by Wordpress <span class="and">&amp;</span> <a href="http://shailan.com" title="Awesome all widget theme by Shailan">Widgetbox</a>
		</div>
	</div>
</div><!-- #footer -->

<?php wp_footer() ?>

</body>
</html>