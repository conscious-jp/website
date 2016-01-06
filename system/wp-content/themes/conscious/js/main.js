/**
 * メニューを開く
 */
var $body = $('body');
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


/**
 * メニューの固定化
 */
var $navPos = 0;
var $mbWidth = 780;
var $timer = false;
setGNavPosition();
setGNavi();
$(window).on('resize', function(){
    if ($timer !== false) {
        clearTimeout(timer);
    }
    timer = setTimeout(function() {
        setGNavPosition();
        setGNavi();
    }, 100);
});
$(window).on('scroll', function(){
    setGNavi();
});
function setGNavPosition() {
    $navPos = $('.js-header-top').outerHeight();
}
function setGNavi() {
    var $scrollTop = $(window).scrollTop();
    if( $scrollTop >= $navPos && $(window).width() >= $mbWidth ) {
        $('.js-gnav').addClass('is-fixed');
    }else{
        $('.js-gnav').removeClass('is-fixed');
    }
}


/**
 * 記事一覧のリンク設定
 */
$('.js-post-link').on('click', function(e){
    e.preventDefault();
    $link = $(this).attr('data-link');
    location.href = $link;
    return false;
});
$('.js-people-link, .js-cat-link').on('click', function(e){
    e.preventDefault();
    $link = $(this).attr('href');
    location.href = $link;
    return false;
});

//$(function() {
//	$(".post-list>div").css("margin-left","-3000px");
//	$(".post-list>div").stop().delay(0).animate({marginLeft: 0}, 1000, 'linear');
//});

$(function() {
	var agent = navigator.userAgent;
	if(agent.search(/iPhone/) != -1 || agent.search(/iPod/) != -1 || agent.search(/Android/) != -1){
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
});

$(function() {
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
});
