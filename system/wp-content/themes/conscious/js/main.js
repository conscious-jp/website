(function($) {
  'use strict';

  var $body     = $('body');
  var $navPos   = 0;
  var $mbWidth  = 780;
  var $timer    = false;
  var $agent    = navigator.userAgent;

  var _conscious = {
    // Initialize
    initialize: function () {
      this.globalMenu();
      this.socialMenu();
      this.setPostPermalink();
      this.setPostAnimation();
      this.setTabNavigation();
      this.setGlobalNaviPosition();
      this.setGlobalNavigation();
    },

    // Open global menu in mobile
    globalMenu: function () {
      $('.js-mobile-menu').on('click', function(){
        var $menuClass = 'is-menu-open';
        if($body.hasClass($menuClass)){
          $body.removeClass($menuClass);
        }else{
          $body.addClass($menuClass);
        }
        if($body.hasClass('is-share-open')){
          $body.removeClass('is-share-open');
        }
      });
    },

    // Open social menu in mobile
    socialMenu: function () {
      $('.js-mobile-social').on('click', function(){
        var $menuClass = 'is-share-open';
        if($body.hasClass($menuClass)){
          $body.removeClass($menuClass);
        }else{
          $body.addClass($menuClass);
        }
        if($body.hasClass('is-menu-open')){
          $body.removeClass('is-menu-open');
        }
      });
    },

    setPostPermalink: function () {
      $('.js-post-link').on('click', function(e){
        e.preventDefault();
        var $link = $(this).attr('data-link');
        location.href = $link;
        return false;
      });
      $('.js-people-link, .js-cat-link').on('click', function(e){
        e.preventDefault();
        var $link = $(this).attr('href');
        location.href = $link;
        return false;
      });
    },

    setTabNavigation: function () {
      $('.tab-link a').on('click', function(){
        var $target = $(this).attr('href');
        var $contents = $(this).parents('.tab-link').next('.tab-contents');
        $($contents).children('.tab-contents-child').hide();
        $($target).show();

        var $tab = $(this).parents('.tab-link').children('li');
        $($tab).removeClass('current');
        $(this).parent('li').addClass('current');
        return false;
      });
    },

    setPostAnimation: function () {
      if($agent.search(/iPhone/) != -1 || $agent.search(/iPod/) != -1 || $agent.search(/Android/) != -1){
				$(".post-list>div").stop().animate({opacity: 1,marginTop:0}, 700);
    	}else{
    		$(".post-list>div").on('inview', function(event, isInView, visiblePartX, visiblePartY) {
    			if (isInView) {
    				if (visiblePartY == 'top' || visiblePartY == 'bottom' || visiblePartY == 'both' ) {
    					$(this).stop().animate({opacity: 1,marginTop:0}, 700);
    				}
    			}
    			else {
    				$(this).stop().animate({opacity: 0,marginTop:0}, 700);
    			}
    		});
    	}
    },

    setGlobalNaviPosition: function () {
      $navPos = $('.js-header-top').outerHeight();
    },

    setGlobalNavigation: function () {
      var $scrollTop = $(window).scrollTop();
      if( $scrollTop >= $navPos && $(window).width() >= $mbWidth ) {
        $('.js-gnav').addClass('is-fixed');
      }else{
        $('.js-gnav').removeClass('is-fixed');
      }
    }
  }


  $(window).on({
    'load': function () {
      _conscious.initialize();
    },

    'resize': function () {
      if ($timer !== false) {
        clearTimeout(timer);
      }
      timer = setTimeout(function() {
        _conscious.setGlobalNaviPosition();
        _conscious.setGlobalNavigation();
      }, 100);
    },

    'scroll': function () {
      _conscious.setGlobalNavigation();
    }
  });

})(jQuery);
