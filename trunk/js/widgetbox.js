if (!window.console) console = {};
console.log = console.log || function(){};
console.warn = console.warn || function(){};
console.error = console.error || function(){};
console.info = console.info || function(){};

// Animated Scrolling
jQuery(document).ready(function() {
    jQuery("a.scrollit").anchorAnimate()
	
	jQuery('.slides').cycle({
        fx:     'scrollHorz',
        speed:  'fast',
        timeout: 0,
        pager:  '#nav',
		prev:    '#prev',
        next:    '#next',
		slideExpr: 'ul li',
		pagerEvent: 'mouseover'
	});
	
	/*jQuery('#featured').hover(
        function() { jQuery('#controls').fadeIn(); },
        function() { jQuery('#controls').fadeOut(); }
    );*/
	
	
	// Single page post share box
    if( jQuery('.hentry .post_share').length > 0 && !(jQuery.browser.msie && parseInt(jQuery.browser.version) < 7) ) {
        var descripY = parseInt(jQuery('.hentry .entry-content').offset().top) - 60;
        var $postShare = jQuery('.hentry .post_share');
        var pullX = $postShare.css('margin-left');
        
        jQuery(window).data('scrollBound', false);
        
        function positionShareScroll() {
            var scrollY = jQuery(window).scrollTop();
            var fixedShare = $postShare.css('position') == 'fixed';
			var wrapper_width = jQuery('#wrapper').outerWidth();
			var box_width = 60;
			var box_margin = 5; 
			
			var margin_left = Math.round(-1*((wrapper_width /2) + (box_width - box_margin)))-1;
			
            if ( scrollY > descripY && !fixedShare ) {
                $postShare.stop().css({
                    position: 'fixed',
                    left: '50%',
					top: 60,
                    marginLeft: margin_left //-515 // Page width / 2 + box width - box margin : 994/2 + 60 - 5 (+- 1px)
                });
            } else if ( scrollY < descripY && fixedShare ) {
                $postShare.css({
                    position: 'relative',
                    left: 0,
                    top: 0,
                    marginLeft: pullX
                });
            }
        }
        
        jQuery(window).resize(function(){
            var windowW = jQuery(window).width();
            var pulledOutside = $postShare.css('margin-left') == pullX;
            if ( windowW >= 1137 ) {
                if ( !jQuery(window).data('scrollBound') ) {
                    if ( !pulledOutside ) {
                        $postShare.animate({ marginLeft: pullX });
                        //Make block horizontal
                        jQuery('.small-buttons').hide();
                        jQuery('.wdt_button').show();
                        jQuery('.large-buttons').show();
                        /*$postShare.css('border-width', '2px');*/
                        $postShare.width('auto');
                        $postShare.css({
                            marginRight: 7,
                            marginTop: 0
                        });
                    }
                    jQuery(window)
                        .data('scrollBound', true)
                        .bind('scroll.positionShare', function(){
                            positionShareScroll()
                        })
                    ;
                    positionShareScroll();
                }
            } else {
                if ( pulledOutside || jQuery(window).data('scrollBound') ) {
                    $postShare.css({ position: 'relative', left: 0, top: 0 }).animate({marginLeft: 0});
                    jQuery('.large-buttons').hide();
                    jQuery('.wdt_button').hide();
                    
                    jQuery('.small-buttons').show();
					jQuery('.wdt_button_min').show();
					
                    $postShare.css({
                        marginTop: -16,
                        marginBottom: 4
                    });
                    $postShare.css('border-width', 0);
                    
                    var content_width = jQuery('.hentry').width();
                    if (content_width == 'undefined') content_width = 560;
                    if ( $postShare.attr('_width') ) {
                        $postShare.width($postShare.attr('_width'));
                        var block_width = $postShare.attr('_width');
                    } else {
                        $postShare.attr('_width', $postShare.width() );
                        var block_width = $postShare.width();
                    }
                    $postShare.width(content_width);
					
					console.log("Content: "+content_width);
					console.log("Block: "+block_width);
                    var add_padding = (content_width - block_width) / ($postShare.find('.wdt_button_min').length * 2) ;
                    
                    $postShare.find('.wdt_button_min').css({
                        paddingLeft: add_padding,
                        paddingRight: add_padding
                    });
                    
                    jQuery(window)
                        .data('scrollBound', false)
                        .unbind('scroll.positionShare')
                    ;
                }
            }
        });
        jQuery(window).resize();
    }
	
	/* FOOTER COLUMN WIDTHS */
	// get footer width
	footer_width = jQuery('.columns').width();	
	// get column widget count
	column_count = jQuery('.columns').find('.widget').length
	column_padding = 15; 		
	columns_width = Math.round((footer_width - (column_count * 2 * column_padding))/column_count)-3;	
	jQuery('.columns').find('.widget').css({
		width: columns_width,
		paddingLeft: column_padding,
        paddingRight: column_padding
	});
	
	
	if(jQuery('.post_share_inline')){
		column_totals = 380;
		jQuery('.post_share_inline').each(function(){
			w = jQuery(this).width();
			cn = jQuery(this).find('.wdt_button_min').length;
			pad = (w - 380) / (2*cn);
			jQuery(this).find('.wdt_button_min').css({
				paddingLeft: pad,
				paddingRight: pad
			});
		});	
	}	
});

/* Animated scrolling */
jQuery.fn.anchorAnimate = function(settings) {
    settings = jQuery.extend({
        speed : 400
    }, settings);   
    
    return this.each(function(){
        var caller = this
        jQuery(caller).click(function (event) { 
            event.preventDefault()
            var locationHref = window.location.href
            var elementClick = jQuery(caller).attr("href")
            
            var destination = jQuery(elementClick).offset().top;
            jQuery("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination}, settings.speed, function() {
                window.location.hash = elementClick
            });
            return false;
        })
    })
}

/** Prototype */
document.observe("dom:loaded", function() {
	// Return to Top elevator 
	setInterval(function(){
	if (document.viewport.getScrollOffsets().top >= 600 && $('return_to_top').getOpacity() == 0 ) {
		new Effect.Opacity('return_to_top', { to:1, duration:0.50 });
	} else if ( document.viewport.getScrollOffsets().top < 600 && $('return_to_top').getOpacity() == 1 ) {
		new Effect.Opacity('return_to_top', { to:0, duration:0.50 });
	} }, 200);	
});




