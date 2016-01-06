<?php
/**
 * The template
 */
get_header();

$term = $wp_query->get_queried_object();
$thumb = get_field('people_avatar', 'people'.'_'.$term->term_id);
$division = get_field('people_division', 'people'.'_'.$term->term_id);
$skill = get_field('people_skill', 'people'.'_'.$term->term_id);
$facebook = get_field('people_facebook', 'people'.'_'.$term->term_id);
$twitter = get_field('people_twitter', 'people'.'_'.$term->term_id);
$instagram = get_field('people_insta', 'people'.'_'.$term->term_id);
$youtube = get_field('people_youtube', 'people'.'_'.$term->term_id);
$soundcloud = get_field('people_soundcloud', 'people'.'_'.$term->term_id);
$relate = get_field('people_relate', 'people'.'_'.$term->term_id);
$participation = get_field('people_participation', 'people'.'_'.$term->term_id);
?>

<article class="post-detail">
    <div class="post-detail__head">
        <h1 class="post-detail__title"><?php single_term_title(); ?></h1>
    </div>
    <div class="people-head">
        <div class="people-head__thumb">
            <img src="<?php echo $thumb; ?>" alt="">
        </div>
        <div class="people-head__info">
            <dl class="people-info">
                <dt class="people-info__head">所属</dt>
                <dd class="people-info__body"><?php echo $division; ?></dd>
            </dl>
            <dl class="people-info">
                <dt class="people-info__head">得意技</dt>
                <dd class="people-info__body"><?php echo $skill; ?></dd>
            </dl>
            <ul class="people-sns">
              <?php if($facebook): ?><li><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
              <?php if($twitter): ?><li><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
              <?php if($instagram): ?><li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li><?php endif; ?>
              <?php if($youtube): ?><li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li><?php endif; ?>
              <?php if($soundcloud): ?><li><a href="<?php echo $soundcloud; ?>" target="_blank"><i class="fa fa-soundcloud"></i></a></li><?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="people-block">
        <h2 class="people__subtitle">自己紹介</h2>
        <div class="people-block__body">
          <?php echo wpautop($term->description); ?>
        </div>
    </div>

    <?php if($participation): ?>
    <div class="people-block">
      <h2 class="people__subtitle">参加コンテンツ</h2>
      <div class="people-block__body">
        <?php
          foreach($participation as $part):
            $type = $part['participation_type'];
            $cat_id = $part['participation_cat'];
            $post = $part['participation_post'];
            $role = $part['participation_role'];
            $thumbURL = '';
            $permalink = '';
            $title = '';
            if($type === "カテゴリ") {
              $cat = get_category($cat_id);
              $catThumb = get_field('cat_thumb', 'category'.'_'.$cat->term_id);
              $thumbURL = $catThumb['sizes']['thumb_l'];
              $permalink = get_category_link($cat->term_id);
              $title = $cat->name;
            }elseif($type === "記事") {
              $title = $post->post_title;
              $permalink = get_permalink($post->ID);
              $thumbID = get_post_thumbnail_id($post->ID);
              $thumbArr = wp_get_attachment_image_src($thumbID, 'thumb_l');
              $thumbURL = $thumbArr[0];
              //var_dump($post);
            }
        ?>
        <dl class="people-part">
          <dt>
            <a href="<?php echo $permalink; ?>"><img src="<?php echo $thumbURL; ?>" alt="<?php echo $title; ?>"></a>
          </dt>
          <dd>
            <h3><a href="<?php echo $permalink; ?>"><i class="fa fa-chevron-circle-right"></i><?php echo $title; ?></a></h3>
            <p><?php echo $role; ?></p>
          </dd>
        </dl>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

    <?php if($relate): ?>
    <div class="people-block">
        <h2 class="people__subtitle"><?php single_term_title(); ?>さんの関連情報</h2>
        <div class="people-block__body">
          <ul class="relate-list">
            <?php foreach($relate as $r): ?>
            <li><i class="fa fa-chevron-circle-right"></i><?php echo $r['relate_child']; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
    </div>
    <?php endif; ?>
</article>

<?php get_footer(); ?>
