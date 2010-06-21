var CTAB_COOKIE = 'current_tab';
var options = { path: '/', expires: 10 };

currentTab = jQuery.cookie(CTAB_COOKIE) ? jQuery.cookie(CTAB_COOKIE) : 1;
	
jQuery(function () {
	var tabContainers = jQuery('div.tabs > div');
	
	jQuery('div.tabs ul.tabNavigation a').click(function () {
		tabContainers.hide().filter(this.hash).show();
		
		jQuery('div.tabs ul.tabNavigation a').removeClass('selected');
		jQuery(this).addClass('selected');
		
		//alert(jQuery(this).attr("id"));
		
		jQuery.cookie(CTAB_COOKIE, jQuery(this).attr("id"), options);
		
		return false;
	}).filter(':first').click();
	
	// SELECT CURRENT TAB
	
	jQuery('div.tabs ul.tabNavigation a').filter(function (index) {
			  return jQuery(this).attr("id") == currentTab;
			}).click();
	
});