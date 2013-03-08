// DOM Ready
$(function() {

    // SVG custom feature detection and svg to png fallback
    (function fallbackSVG() {
        // toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script#update
        function supportsSVG() {
            return !! document.createElementNS && !! document.createElementNS('http://www.w3.org/2000/svg','svg').createSVGRect && ! $.browser.msie;
        }

        if (supportsSVG()) {
            $('html').addClass('svg');
        } else {
            $('html').addClass('no-svg');
            $('img').each(function() {
                var newURL;
                if($(this).attr('src') && $(this).attr('src').match(/.*\.svg$/)) {
                    newURL = $(this).attr('src').replace(/\.svg$/, '.png');
                    $(this).attr('src', newURL);
                } else if ($(this).data('lazy-src') && $(this).data('lazy-src').match(/.*\.svg$/)) {
                    newURL = $(this).data('lazy-src').replace(/\.svg$/, '.png');
                    $(this).data('lazy-src', newURL);
                }
            });
        }
    })();
    // allow any svgs that are 

    // iPhone Safari URL bar hides itself on pageload
    (function hideURLbar() {
        function hideURLbar() { window.scrollTo(0, 0); }

        if (navigator.userAgent.indexOf('iPhone') != -1) {
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);
        }
    })();

    // set a baseline
    if(typeof $.fn.baseline !== 'undefined') {
        $('.content img').baseline(26);
    }

    (function ulToSelect () {
        // http://css-tricks.com/convert-menu-to-dropdown/
        var $nav    = $('.nav'), 
        $nav__list = $('.nav__list'),
        $select = $('<select />', {
            'class': 'nav__mobile-list'
        }).appendTo($nav);

        //create a default navigation item
        $('<option />', {
            'selected': 'selected',
            'value'   : '',
            'text'    : '-- Navigation --'
        }).appendTo($select);

        $nav__list.children('.menu-item').children('a').each(function() {
            var $this = $(this);
            $('<option />', {
                'value'   : $this.attr('href'),
                'text'    : $this.text()
            }).appendTo($select);
        });

        $select.change(function () {
            window.location = $(this).find('option:selected').val();
        });
    })();

    (function createFooterToggle() {
        function toggleFooter (elem) { $(elem).toggleClass('footer__section--state-collapsed'); }
        $('.footer__section').each(function () {
            toggleFooter(this);
            $(this).find('.footer__section__title')
            .click(function () { toggleFooter($(this).parent()); });
        });
    })();

    (function searchBarInteraction() {
        var $search = $('.search-bar');
        console.log($search)
        $search.click(function(e) { 
            var $this = $(this);
            e.preventDefault();
            $this
            .addClass('search-bar--state-active')
            .find('input')
            .focus();
        });

        $search.find('input').blur(function(e) {
            $search.removeClass('search-bar--state-active');
        });
    })();

    $('.gallery--type-slider').nivoSlider({
        effect: 'random',
        pauseTime: 5000
    });
    $('.gallery--type-header').nivoSlider({
        effect: 'random',
        directionNav: true,
        controlNav: false,
        pauseTime: 2000
    });
    // http://www.leachcreative.com/snippets/adding-touch-navigation-to-nivo-slider/
	$('.gallery--type-slider').bind( 'swipeleft', function( e ) {
		$('a.nivo-nextNav').trigger('click');
		e.stopImmediatePropagation();
		return false;
	 } );  
	 $('.gallery--type-slider').bind( 'swiperight', function( e ) {
		$('a.nivo-prevNav').trigger('click');
		e.stopImmediatePropagation();
		return false;
	 }); 
     $('document').keydown(function(e) {
         switch (e.which) {
             case 37: // ←
                $('a.nivo-prevNav').trigger('click');
             case 39: // →
                $('a.nivo-nextNav').trigger('click');
         }
     });

    $('.tiled-gallery a').touchTouch();

    $('.gce-list').equalize({ reset: true });
});

/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
  
  // This fix addresses an iOS bug, so return early if the UA claims it's something else.
  if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){
    return;
  }
  
    var doc = w.document;

    if( !doc.querySelector ){ return; }

    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
    x, y, z, aig;

    if( !meta ){ return; }

    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true;
    }

    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false;
    }
  
    function checkTilt( e ){
    aig = e.accelerationIncludingGravity;
    x = Math.abs( aig.x );
    y = Math.abs( aig.y );
    z = Math.abs( aig.z );
        
    // If portrait orientation and in one of the danger zones
        if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
      if( enabled ){
        disableZoom();
      }          
        }
    else if( !enabled ){
      restoreZoom();
        }
    }
  
  w.addEventListener( "orientationchange", restoreZoom, false );
  w.addEventListener( "devicemotion", checkTilt, false );

})(this);
