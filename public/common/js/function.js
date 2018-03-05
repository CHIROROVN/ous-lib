jQuery(function() {

//scroll-------------------------------------------------

  jQuery('a[href*=#]').click(function() {		
      var $target = jQuery(this.hash);
      $target = $target.length && $target || jQuery('[name=' + this.hash.slice(1) +']');
      if ($target.length) {
        var targetOffset = $target.offset().top;
        jQuery((navigator.userAgent.indexOf("Opera") != -1) ? document.compatMode == 'BackCompat' ? 'body' : 'html' :'html,body').animate({scrollTop: targetOffset}, 1000);
       return false;
      }

  });

/*    jQuery("a[href*=#], area[href*=#]").not(".noScroll").click(function() {

        var speed = 1000,
            href = jQuery(this).prop("href"),
            hrefPageUrl = href.split("#")[0],
            currentUrl = location.href,
            currentUrl = currentUrl.split("#")[0];

        if(hrefPageUrl == currentUrl){

            href = href.split("#");
            href = href.pop();
            href = "#" + href;

            var target = jQuery(href == "#" || href == "" ? 'html' : href),
                position = target.offset().top,
                body = 'body',
                userAgent = window.navigator.userAgent.toLowerCase();
            if (userAgent.indexOf('msie') > -1 || userAgent.indexOf('trident') > -1 || userAgent.indexOf("firefox") > -1 ) {
                body = 'html';
            }
            jQuery(body).animate({
                scrollTop: position
            }, speed, 'swing', function() {
            });

            return false;
        }

    });
*/
//gnavi-------------------------------------------------
		var ddmenu = '#gnavi';

		jQuery('>ul>li',ddmenu).each(function(){

			jQuery(this).hover(
				function(){
					jQuery('>ul',this).stop(true,true).slideDown(100);
					jQuery('img',this).stop(true,true).attr('src', jQuery('img',this).attr("src").replace("_off.", "_on."));
				},
				function(){
					jQuery('>ul',this).stop(true,true).slideUp(200);
					 if (!jQuery('img',this).hasClass('now')) { 
					   jQuery('img',this).stop(true,true).attr('src', jQuery('img',this).attr("src").replace("_on.", "_off."));
						}
				}
			);
			
		});


});