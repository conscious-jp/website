<?php
/**
 * The single template
 */

$cats = get_the_category();
$catSlug = '';
foreach($cats as $cat) {
    if(!($cat->category_parent)) {
        $catSlug = $cat->slug;
    }else{
        $childCatName = $cat->name;
        $childCatID = $cat->term_id;
    }
}
get_header(); ?>

<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
<article class="post-detail">
    <?php echo get_cat_icon_text(); ?>
    <div class="post-detail__head">
        <h1 class="post-detail__title"><?php the_title(); ?></h1>
    </div>
    <div class="post__meta clearfix">
        <ul class="post__people people-lists">
            <?php people_list(); ?>
        </ul>
        <p class="post__date"><i class="fa fa-clock-o"></i><?php the_time('Y.m.d'); ?></p>
    </div>
    <?php get_template_part('includes/share'); ?>
    <div class="post-detail__thumb">
        <?php the_post_thumbnail('full'); ?>
    </div>

    <?php
      $post_thumbnail_id = get_post_thumbnail_id();
      $img_via_txt = get_field('img_via', $post_thumbnail_id);
      $img_via_url = get_field('img_via_url', $post_thumbnail_id);
      if($img_via_txt):
    ?>
    <p class="post__img-via">
      参照元：
      <?php if($img_via_url): ?>
      <a href="<?php echo $img_via_url; ?>"><?php echo $img_via_txt; ?></a>
      <?php else: ?>
      <?php echo $img_via_txt; ?>
      <?php endif; ?>
    </p>
    <?php endif; ?>

    <?php if( $catSlug==='radios' ): ?>
        <div class="post-detail__audio">
            <?php
                $radioFile = get_field('audio_file');
                $radioURL = $radioFile['url'];
                echo wp_audio_shortcode(array('src'=>$radioURL));
            ?>
        </div>
    <?php endif; ?>
    <div class="post-detail__content">
        <?php the_content(); ?>
    </div>

    <?php
      $interviews = get_field('interviews');
      if( ($catSlug === 'read') && $interviews ):
    ?>
    <div class="interview-box">
      <?php
        foreach($interviews as $interview) :
        $type = $interview['interview_type'];
      ?>
      <?php
        // 通常
        if($type === 'normal'):
        $bgcolor = $interview['interview_bgcolor'];
        $imember = $interview['interview_member'];
        $itext = $interview['interview_text'];
        $imovie = $interview['interview_movie'];
      ?>
        <dl<?php if($bgcolor): echo " style='background-color:".$bgcolor."'";endif; ?>>
          <dt>
            <ul>
            <?php
              foreach($imember as $im):
              $memberThumb = get_field('interviewer_avatar', 'interview-member'.'_'.$im);
            ?>
              <li><img src="<?php echo $memberThumb; ?>"></li>
            <?php endforeach; ?>
            </ul>
          </dt>
          <dd>
            <?php echo $itext; ?>
          </dd>
        </dl>
      <?php
        // 見出し
        elseif($type === 'heading'):
        $iheading = $interview['interview_heading'];
      ?>
      <h3><?php echo $iheading; ?></h3>
      <?php
        // 引用
        elseif($type === 'quote'):
        $iquote = $interview['interview_quote'];
      ?>
      <blockquote><?php echo $iquote; ?></blockquote>
      <?php
        // フリーエリア
        elseif($type === 'movie'):
        $ifree = $interview['interview_movie'];
      ?>
      <div class="interview__movie"><?php echo $ifree; ?></div>
      <?php
        // フリーエリア
        elseif($type === 'free'):
        $ifree = $interview['interview_free'];
      ?>
      <div class="interview__free"><?php echo $ifree; ?></div>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php get_template_part('includes/share'); ?>
    <div id="disqus_thread"></div>
</article>
<?php endwhile; endif; ?>

<?php
    $prevPost = get_previous_post('true');
    $nextPost = get_next_post('true');
    $prevPostURL = get_permalink( $prevPost->ID );
    $nextPostURL = get_permalink( $nextPost->ID );
?>
<?php if($prevPost||$nextPost): ?>
<ul class="bf-link clearfix">
    <?php if($prevPost): ?>
        <li class="bf-link__list list--prev"><a href="<?php echo $prevPostURL; ?>" class="btn"><i class="fa fa-chevron-circle-left"></i>前の記事へ</a></li>
    <?php endif; ?>
    <?php if($nextPost): ?>
        <li class="bf-link__list list--next"><a href="<?php echo $nextPostURL; ?>" class="btn">次の記事へ<i class="fa fa-chevron-circle-right"></i></a></li>
    <?php endif; ?>
</ul>
<?php endif; ?>

<?php
$currentCatPostNo = get_field('post_volume');
$prevCatPostNo = $currentCatPostNo - 1;
$nextCatPostNo = $currentCatPostNo + 1;

$prevCatPost = new WP_Query(array(
  'post_type' => 'post',
  'cat' => $childCatID,
  'meta_query' => array(
    array(
      'key' => 'post_volume',
      'value' => $prevCatPostNo
    )
  )
));
$nextCatPost = new WP_Query(array(
  'post_type' => 'post',
  'cat' => $childCatID,
  'meta_query' => array(
    array(
      'key' => 'post_volume',
      'value' => $nextCatPostNo
    )
  )
));
?>

<div class="post-archive cat-post">
  <div class="post-archive__head">
      <h2 class="post-archive__title"><?php echo $childCatName; ?></h2>
  </div>
  <ul class="cat-post-link clearfix">
    <li class="prev">
      <?php if ($prevCatPost->have_posts()) : ?>
      <?php while($prevCatPost->have_posts()) : $prevCatPost->the_post(); ?>
      <a href="<?php the_permalink() ?>">
        <div class="thumb">
          <?php the_post_thumbnail('thumb_m'); ?>
        </div>
        <h3 class="title">
          <span><i class="fa fa-chevron-circle-left"></i>前の記事はコチラ</span>
          <?php the_title(); ?>
        </h3>
      </a>
      <?php endwhile; ?>
      <?php else: ?>
      <p>これが連載最初の記事</p>
      <?php endif; wp_reset_query(); ?>
    </li>
    <li class="next">
      <?php if ($nextCatPost->have_posts()) : ?>
      <?php while($nextCatPost->have_posts()) : $nextCatPost->the_post(); ?>
      <a href="<?php the_permalink() ?>">
        <div class="thumb">
          <?php the_post_thumbnail('thumb_m'); ?>
        </div>
        <h3 class="title">
          <span><i class="fa fa-chevron-circle-right"></i>次の記事はコチラ</span>
          <?php the_title(); ?>
        </h3>
      </a>
      <?php endwhile; ?>
      <?php else: ?>
      <p>この記事が最新だよ</p>
      <?php endif; wp_reset_query(); ?>
    </li>
  </ul>
</div>

<?php related_posts(); ?>

<?php get_footer(); ?>
