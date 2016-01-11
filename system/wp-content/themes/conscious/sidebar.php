<div class="sidebar">

    <div class="org-banner">
      <?php
        $org_banners = get_field('org_banner', 'option');
        $banner_key = array_rand($org_banners, 1);
        $banner = $org_banners[$banner_key];
      ?>
      <a href="<?php echo $banner['banner_url']; ?>" target="_blank" class="org-bnr-link" title="<?php echo $banner['banner_title']; ?>"><img src="<?php echo $banner['banner_desktop_img']; ?>"></a>
    </div>

    <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar' ); ?>
    <?php endif; ?>

    <dl class="widget">
      <dt class="widget__head">
        <h2 class="widget__title">人気記事ランキング</h2>
      </dt>
      <dd class="widget__body">
        <ul class="side-tab tab-link">
          <li class="current"><a href="#post-weekly">今週</a></li>
          <li><a href="#post-monthly">今月</a></li>
          <li><a href="#post-all">全て</a></li>
        </ul>
        <div class="tab-contents">
          <div id="post-weekly" class="tab-contents-child">
            <?php wpp_get_mostpopular(array(
              'order_by' => 'views',
              'limit' => 5,
              'post_type' => 'post',
              'range' => 'weekly',
              'thumbnail_width' => 160,
              'thumbnail_height' => 160,
              'wpp_start' => '<ul class="widget-post widget-post--ranking">',
              'post_html' => "<li class='widget-post__list'><a href=\'{url}\' class='clearfix'><div class='widget-post__thumb'>{thumb_img}</div><div class='widget-post__body'><h3 class='widget-post__title'>{text_title}</h3></div></a></li>"
            )); ?>
          </div>
          <div id="post-monthly" class="tab-contents-child" style="display:none;">
            <?php wpp_get_mostpopular(array(
              'order_by' => 'views',
              'limit' => 5,
              'post_type' => 'post',
              'range' => 'monthly',
              'thumbnail_width' => 160,
              'thumbnail_height' => 160,
              'wpp_start' => '<ul class="widget-post widget-post--ranking">',
              'post_html' => "<li class='widget-post__list'><a href=\'{url}\' class='clearfix'><div class='widget-post__thumb'>{thumb_img}</div><div class='widget-post__body'><h3 class='widget-post__title'>{text_title}</h3></div></a></li>"
            )); ?>
          </div>
          <div id="post-all" class="tab-contents-child" style="display:none;">
            <?php wpp_get_mostpopular(array(
              'order_by' => 'views',
              'limit' => 5,
              'post_type' => 'post',
              'range' => 'all',
              'thumbnail_width' => 160,
              'thumbnail_height' => 160,
              'wpp_start' => '<ul class="widget-post widget-post--ranking">',
              'post_html' => "<li class='widget-post__list'><a href=\'{url}\' class='clearfix'><div class='widget-post__thumb'>{thumb_img}</div><div class='widget-post__body'><h3 class='widget-post__title'>{text_title}</h3></div></a></li>"
            )); ?>
          </div>
        </div>
      </dd>
    </dl>

    <dl class="widget">
      <dt class="widget__head">
        <h2 class="widget__title">人気ぴーぽーランキング</h2>
      </dt>
      <dd class="widget__body">
        <ul class="side-tab tab-link">
          <li class="current"><a href="#people-weekly">今週</a></li>
          <li><a href="#people-monthly">今月</a></li>
          <li><a href="#people-all">全て</a></li>
        </ul>
        <div class="tab-contents">
          <div id="people-weekly" class="tab-contents-child">
            <?php get_people_ranking('weekly'); ?>
          </div>
          <div id="people-monthly" class="tab-contents-child" style="display:none;">
            <?php get_people_ranking('monthly'); ?>
          </div>
          <div id="people-all" class="tab-contents-child" style="display:none;">
            <?php get_people_ranking(); ?>
          </div>
        </div>
      </dd>
    </dl>

    <dl class="widget">
      <dt class="widget__head">
        <h2 class="widget__title">タグ</h2>
      </dt>
      <dd class="widget__body">
        <div class="tagcloud">
          <?php
            wp_tag_cloud(array(
              'smallest' => 10,
              'largest' => 23,
              'unit' => 'px',
              'number' => 30,
              'orderby' => 'count',
              'order' => 'DESC'
            ));
          ?>
        </div>
      </dd>
    </dl>

    <div class="search-bar clearfix">
        <form method="get" action="<?php echo home_url('/'); ?>">
        <div class="search-bar__btn">
            <button type="submit" class="btn"><i class="fa fa-search"></i></button>
        </div>
        <div class="search-bar__input">
            <input type="text" name="s" class="full" placeholder="検索キーワードを入力">
        </div>
        </form>
    </div>
    <div class="g-ad-wrap">
        <div class="g-ad">
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- sidebar1 -->
          <ins class="adsbygoogle"
               style="display:inline-block;width:300px;height:250px"
               data-ad-client="ca-pub-6309908964254814"
               data-ad-slot="3556783283"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
        </div>
        <div class="g-ad">
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- sidebar2 -->
          <ins class="adsbygoogle"
               style="display:inline-block;width:300px;height:250px"
               data-ad-client="ca-pub-6309908964254814"
               data-ad-slot="7398226885"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
        </div>
    </div>
</div>
