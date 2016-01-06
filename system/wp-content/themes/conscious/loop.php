<?php
/**
 * The post archive template
 */

$termList       = null;
$ppp = get_option('posts_per_page');
if(is_home()){
    $termList = array( 'read', 'radios', 'watch' );
}elseif(is_category()){
    $catID = get_query_var('cat');
    $archiveCat = get_term($catID, 'category');
    $termList = $archiveCat->slug;
}

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$loopPost = new WP_Query(array(
    'post_type'         => 'post',
    'paged'             => $paged,
    'posts_per_page'    => $ppp,
    'tax_query' => array(
        array(
            'taxonomy'  => 'category',
            'terms'     => $termList,
            'field'     => 'slug',
            'operator'  => 'IN'
        ),
        'relation'      => 'AND'
    )
));
?>
<div class="post-archive">
    <div class="post-archive__head">
        <h1 class="post-archive__title">
        <?php if(is_home()): ?>
            新着記事
        <?php elseif(is_category()): ?>
            <?php single_cat_title(); ?>
        <?php endif; ?>
        </h1>
    </div>
<?php if ($loopPost->have_posts()) : while($loopPost->have_posts()) : $loopPost->the_post(); ?>
    <?php if(is_custom('first', $loopPost) && is_home() && $paged === 1) : ?>
        <?php
            $fThumbURL = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumb_l');
        ?>
        <article class="post-list post-list--feature js-post-link" data-link="<?php the_permalink(); ?>" style="background-image:url('<?php echo $fThumbURL[0]; ?>')">
            <div class="post-list__smoke"></div>
            <div class="post__meta clearfix">
                <ul class="post__people people-lists">
                    <?php people_list(); ?>
                </ul>
            </div>
            <div class="post-list__fwrap">
                <?php echo get_cat_icon_text(); ?>
                <p class="post__date"><i class="fa fa-clock-o"></i><?php the_time('Y.m.d'); ?></p>
                <h2 class="post-list__title"><?php the_title(); ?></h2>
            </div>
        </article>
    <?php else: ?>
        <?php get_template_part('list'); ?>
    <?php endif; ?>
<?php endwhile; ?>
<?php else: ?>
    <div class="post-empty">
        <h2 class="post-empty__title">記事がありゃせんで。すまんの。</h2>
    </div>
<?php endif; wp_reset_query(); ?>
</div>
<?php
if( function_exists('wp_pagenavi') ) {
    wp_pagenavi(array('query' => $loopPost));
}
?>
