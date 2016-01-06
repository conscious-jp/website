<?php
/**
 * The template
 */
get_header();

$people = get_terms('people', array(
    'hide_empty' => true,
    'orderby' => 'order'
));
//var_dump($people);
?>

<div class="post-archive">
    <div class="post-archive__head">
        <h1 class="post-archive__title"><?php the_title(); ?></h1>
    </div>
    <div class="members clearfix">
        <?php
            foreach($people as $person):
                if($person->parent != 0):
                $pThumb = get_field('people_avatar', 'people'.'_'.$person->term_id);
                $pURL = get_term_link($person);
        ?>
        <div class="members__list">
            <a href="<?php echo $pURL; ?>">
                <div class="members__thumb">
                    <img src="<?php echo $pThumb; ?>" alt="<?php echo $person->name; ?>">
                </div>
                <h2 class="members__name"><?php echo $person->name; ?></h2>
            </a>
        </div>
        <?php endif;endforeach; ?>
    </div>
</div>

<?php get_footer(); ?>
