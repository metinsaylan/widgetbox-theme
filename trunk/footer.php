	<div class="clear"></div>
</div><!-- #wrapper .hfeed -->

<div id="footer" class="container_12">
	<div class="footer-columns">
		<div class="grid_4">
			<?php stf_widgets('column1'); ?> 
		</div>
		<div class="grid_4">
			<?php stf_widgets('column2'); ?> 
		</div>
		<div class="grid_4">
			<?php stf_widgets('column3'); ?> 
		</div>	
	<div class="clear"></div></div>
	
	<div class="footer-wide"><?php stf_widgets('footer'); ?><div class="clear"></div></div>
	
	<div class="clear"></div>
	<div id="footer-menu">
		<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_class' => 'footer-navigation', 'menu_id' => 'menu-footer' ) ); ?>
	</div>	
	<div class="clear"></div>
	<div id="footer-links">
		<div id="theme-footer" class="grid_6">
			<?php stf_theme_footer(); ?>
		</div>
		
		<div id="theme-link" class="grid_6 right">
			Powered by <a href="http://wordpress.org" title="">Wordpress</a> <span class="and">&amp;</span> <a href="http://shailan.com" title="Awesome all widget theme by Shailan">Widgetbox</a>
		</div>
	</div>
</div><!-- #footer -->

<?php wp_footer() ?>

</body>
</html>