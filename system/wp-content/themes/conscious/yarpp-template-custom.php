<?php
/*
YARPP Template: Custom
*/
?>
<div class="post-archive">
    <div class="post-archive__head">
        <h2 class="post-archive__title">関連記事</h2>
    </div>
    <?php if (have_posts()):?>
    <ul class="related clearfix">
        <?php while (have_posts()) : the_post(); ?>
        <li class="related__list">
            <a href="<?php the_permalink() ?>">
                <div class="related__thumb">
                    <?php the_post_thumbnail('thumb_m2'); ?>
                </div>
                <h3 class="related__title"><?php the_title(); ?></h3>
            </a>
        </li>
        <?php endwhile; ?>
    </ul>
    <?php else: ?>
    <div class="post-empty">
        <h3 class="post-empty__title">関連記事が見当たらんで。すまんの。</h3>
    </div>
    <?php endif; ?>
</div>
