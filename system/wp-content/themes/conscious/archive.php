<?php
/**
 * The archive template
 */

$catID = get_query_var('cat');
$archiveCat = get_term($catID, 'category');
get_header(); ?>

<?php if( !($archiveCat->parent || is_category('creator') || is_category('news') ) ): ?>
    <div class="post-archive">
        <div class="post-archive__head">
            <h1 class="post-archive__title"><?php single_cat_title(); ?></h1>
        </div>
        <?php if(!is_category('special')): ?>
        <ul class="post-cat clearfix">
            <?php
                $cats = get_categories(array(
                  'parent' => $archiveCat->term_id,
                  'orderby' => 'order'
                ));
                foreach($cats as $cat):
                    $catThumb = get_field('cat_thumb', 'category'.'_'.$cat->term_id);
                    $catThumbURL = $catThumb['sizes']['thumb_l'];
                    $catURL = get_category_link($cat->term_id);

            ?>
            <li class="post-cat__list">
                <a href="<?php echo $catURL; ?>">
                    <div class="post-cat__thumb">
                        <img src="<?php echo $catThumbURL; ?>" alt="<?php echo $cat->name; ?>">
                    </div>
                    <h2 class="post-cat__title"><i class="fa fa-chevron-circle-right"></i><?php echo $cat->name; ?></h2>
                </a>
                <?php
                $catPost = new WP_Query(array(
                    'post_type'         => 'post',
                    'posts_per_page'    => 3,
                    'tax_query' => array(
                        array(
                            'taxonomy'  => 'category',
                            'terms'     => $cat->slug,
                            'field'     => 'slug',
                            'operator'  => 'IN'
                        ),
                        'relation'      => 'AND'
                    )
                ));
                if ($catPost->have_posts()) :
                ?>
                <div>
                    <ul class="catin-post">
                    <?php while($catPost->have_posts()) : $catPost->the_post(); ?>
                    <li class="catin-post__list">
                        <h3 class="catin-post__title">
                            <a href="<?php the_permalink(); ?>">
                            <?php
                                if(mb_strlen($post->post_title)>35) {
                                    $title= mb_substr($post->post_title,0,35);
                                    echo $title . '...';
                                } else {
                                    echo $post->post_title;
                                }
                            ?>
                            </a>
                        </h3>
                    </li>
                    <?php endwhile; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <ul class="post-cat clearfix">
            <?php if (have_posts()) : while(have_posts()) : the_post(); ?>
                <?php $spLink = get_field('link_url'); ?>
                <li class="post-cat__list">
                    <a href="<?php echo $spLink; ?>" target="_blank">
                        <div class="post-cat__thumb">
                            <?php the_post_thumbnail('thumb_l'); ?>
                        </div>
                        <h2 class="post-cat__title"><i class="fa fa-chevron-circle-right"></i><?php the_title(); ?></h2>
                    </a>
                </li>
            <?php endwhile; endif; ?>
        </ul>
        <?php endif;?>
    </div>
<?php else: ?>
<?php get_template_part('loop'); ?>
<?php endif; ?>

<?php get_footer(); ?>
