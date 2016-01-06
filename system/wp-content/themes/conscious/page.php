<?php
/**
 * The template
 */
get_header();

if (have_posts()) : while(have_posts()) : the_post(); ?>

<article class="post-detail">
    <div class="post-detail__head">
        <h1 class="post-detail__title title--page"><?php the_title(); ?></h1>
    </div>
    <?php get_template_part('includes/share'); ?>
    <div class="post-detail__thumb">
        <?php the_post_thumbnail('full'); ?>
    </div>
    <div class="post-detail__content">
        <?php the_content(); ?>
    </div>
    <?php get_template_part('includes/share'); ?>
    <div id="disqus_thread"></div>
</article>

<?php
endwhile; endif;
get_footer(); ?>
