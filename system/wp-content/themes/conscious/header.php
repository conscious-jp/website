<?php
/**
 * The template for displaying the header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/icon/favicon.ico">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WCMLVP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WCMLVP');</script>
<!-- End Google Tag Manager -->

<div id="fb-root"></div>

<header class="header">
    <div class="header__top js-header-top container">
        <button class="h-menu js-mobile-menu"><i class="fa fa-bars"></i></button>
        <button class="h-mb-social js-mobile-social"><i class="fa fa-share-alt"></i></button>
        <div class="site-name">
            <a href="<?php echo home_url('/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo_black.svg" alt="<?php bloginfo('name'); ?>"></a>
        </div>
        <h2 class="header__description"><?php bloginfo('description'); ?></h2>
        <ul class="h-share">
            <?php
                $headerSocial = get_field('header_social', 'option');
                foreach ( $headerSocial as $account ) :
                $accountName  = $account['social_name'];
                $accountClass = $account['fa_class'];
                $accountURL   = $account['account_url'];
            ?>
            <li class="h-share__list"><a href="<?php echo $accountURL; ?>" target="_blank"><i class="fa <?php echo $accountClass; ?>"></i></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <nav class="gnav js-gnav">
        <ul class="gnav__container container">
            <?php
                $activeClass    = ' is-active';
                $homeActive     = '';
                $readActive     = '';
                $radioActive    = '';
                $watchActive    = '';
                $specialActive  = '';
                $peopleActive   = '';
                $readCatID = get_category_by_slug('read')->cat_ID;
                $radioCatID = get_category_by_slug('radios')->cat_ID;
                $watchCatID = get_category_by_slug('watch')->cat_ID;
                $specialCatID = get_category_by_slug('special')->cat_ID;
                if( is_home() ) {
                    $homeActive = $activeClass;
                }elseif( is_category() ) {
                    $catID = get_query_var('cat');
                    $archiveCat = get_term($catID, 'category');
                    $currentCatID = $archiveCat->term_id;
                    $currentCat = get_category($currentCatID);
                    if( $currentCatID === $readCatID || $currentCat->category_parent === $readCatID ) {
                        $readActive = $activeClass;
                    }elseif( $currentCatID === $radioCatID || $currentCat->category_parent === $radioCatID ) {
                        $radioActive = $activeClass;
                    }elseif( $currentCatID === $watchCatID || $currentCat->category_parent === $watchCatID ) {
                        $watchActive = $activeClass;
                    }elseif( $currentCatID === $specialCatID || $currentCat->category_parent === $specialCatID ) {
                        $specialActive = $activeClass;
                    }
                }elseif( is_page('peoples') || is_tax('people') ){
                    $peopleActive = $activeClass;
                }elseif(is_single()){
                    $sCats = get_the_category();
                    $sCatID = 0;
                    foreach($sCats as $sCat) {
                        if(!($sCat->category_parent)) {
                            $sCatID = $sCat->term_id;
                        }
                    }
                    if($sCatID===$readCatID){
                        $readActive = $activeClass;
                    }elseif($sCatID===$radioCatID){
                        $radioActive = $activeClass;
                    }elseif($sCatID===$watchCatID){
                        $watchActive = $activeClass;
                    }
                }
            ?>
            <li class="gnav__list nav--home<?php echo $homeActive; ?>"><a href="<?php echo home_url('/'); ?>"><i class="fa fa-home"></i></a></li>
            <li class="gnav__list nav--read<?php echo $readActive; ?>"><a href="<?php echo home_url('/'); ?>read"><i class="fa fa-book"></i>よむコン</a></li>
            <li class="gnav__list nav--radio<?php echo $radioActive; ?>"><a href="<?php echo home_url('/'); ?>radios"><i class="fa fa-headphones"></i>きくコン</a></li>
            <li class="gnav__list nav--watch<?php echo $watchActive; ?>"><a href="<?php echo home_url('/'); ?>watch"><i class="fa fa-eye"></i>みるコン</a></li>
            <li class="gnav__list nav--special<?php echo $specialActive; ?>"><a href="<?php echo home_url('/'); ?>special"><i class="fa fa-gift"></i>すぺコン</a></li>
            <li class="gnav__list nav--people<?php echo $peopleActive; ?>"><a href="<?php echo home_url('/'); ?>peoples"><i class="fa fa-smile-o"></i>ぴーぽー</a></li>
        </ul>
    </nav>
</header>

<?php if ( function_exists('yoast_breadcrumb') && !is_home() ): ?>
  <?php if ( is_tax('people')) : ?>
    <div class="breadcrumbs container">
      <span xmlns:v="http://rdf.data-vocabulary.org/#">
        <span typeof="v:Breadcrumb">
          <a href="<?php echo home_url(); ?>" rel="v:url" property="v:title">ホーム</a>
          <i class="fa fa-caret-right"></i>
          <span rel="v:child" typeof="v:Breadcrumb">
            <a href="<?php echo home_url('/'); ?>peoples" rel="v:url" property="v:title">ぴーぽー</a>
            <i class="fa fa-caret-right"></i>
            <strong class="breadcrumb_last"><?php single_term_title(); ?></strong>
          </span>
        </span>
      </span>
    </div>
  <?php else: ?>
    <?php yoast_breadcrumb('<div class="breadcrumbs container">','</div>'); ?>
  <?php endif; ?>
<?php endif; ?>

<div class="contents container clearfix">
    <div class="main">
