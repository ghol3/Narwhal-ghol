$(function(){

});

$(document).ready(function (){
            $("#totop").click(function (){
                $('html, body').animate({
                    scrollTop: $("#topbar").offset().top
                }, 500);
            });
        });
        
         (function($) {
	  "use strict";
          
	jQuery('a[data-gal]').each(function() {
		jQuery(this).attr('rel', jQuery(this).data('gal'));
	});
		jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({animationSpeed:'slow',slideshow:false,overlay_gallery: false,theme:'light_square',social_tools:false,deeplinking:false});
})(jQuery);