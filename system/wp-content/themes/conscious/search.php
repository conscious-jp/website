<?php
/**
 * The search template
 */
get_header(); ?>

<div class="post-archive">
    <div class="post-archive__head">
        <h1 class="post-archive__title">検索結果</h1>
    </div>
    <?php if (have_posts()) : while(have_posts()) : the_post(); ?>
        <?php get_template_part('list'); ?>
    <?php endwhile; ?>
    <?php else: ?>
    <div class="post-empty">
        <h2 class="post-empty__title">記事がありゃせんで。すまんの。</h2>
    </div>
    <?php endif; ?>
</div>
<?php
if( function_exists('wp_pagenavi') ) {
    wp_pagenavi();
}
?>

<?php get_footer(); ?>