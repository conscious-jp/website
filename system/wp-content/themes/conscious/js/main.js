(function($) {
  'use strict';

  var $body              = $('body');
  var $navPos            = 0;
  var $mbWidth           = 780;
  var $timer             = false;
  var $agent             = navigator.userAgent;
  var $sidebarH          = 0;
  var $mainH             = 0;
  var $headerH           = 0;
  var $footerH           = 0;
  var $windowH           = $(window).height();
  var $pageH             = $('body').height();
  var $fixedPoint        = 0;
  var $scrollBottomPoint = 0;

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
    },

    getMainHeight: function () {
      var $height = $('.js-main').outerHeight();
      return $height;
    },

    getSidebarHeight: function () {
      var $height = $('.js-sidebar').outerHeight();
      return $height;
    },

    getHeaderHeight: function () {
      var $height = $('.js-header').outerHeight();
      return $height;
    },

    getFooterHeight: function () {
      var $height = $('.js-footer').outerHeight();
      return $height;
    },

    fixedSidebar: function () {
      var $scrollTop = $(window).scrollTop();
      $sidebarH = this.getSidebarHeight();
      $mainH = this.getMainHeight();
      $headerH = this.getHeaderHeight();
      $footerH = this.getFooterHeight();
      $fixedPoint = $headerH + $sidebarH - $windowH + 60;
      $scrollBottomPoint = $headerH + $mainH - $windowH + 60;

      if ($(window).width() > 980 && $mainH > $sidebarH) {
        if ($scrollTop > $fixedPoint) {
          $('.js-sidebar').addClass('is-fixed');
        } else {
          $('.js-sidebar').removeClass('is-fixed');
        }

        if ($scrollTop > $scrollBottomPoint) {
          $('.js-sidebar').removeClass('is-fixed');
          $('.js-sidebar').addClass('is-bottomed');
        } else {
          $('.js-sidebar').removeClass('is-bottomed');
        }
      }
    }
  }


  $(window).on({
    'load': function () {
      _conscious.initialize();
    },

    'resize': function () {
      if ($timer !== false) {
        clearTimeout($timer);
      }
      $timer = setTimeout(function() {
        _conscious.setGlobalNaviPosition();
        _conscious.setGlobalNavigation();
        _conscious.fixedSidebar();
      }, 100);
    },

    'scroll': function () {
      _conscious.setGlobalNavigation();
      _conscious.fixedSidebar();
    }
  });

})(jQuery);
