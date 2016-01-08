<?php
/**
 * The template
 */
get_header();

$peopleParents = get_terms('people', array(
  'hide_empty' => false,
  'orderby' => 'order',
  'parent' => 0
));
?>

<div class="post-archive">
  <div class="post-archive__head">
    <h1 class="post-archive__title"><?php the_title(); ?></h1>
  </div>

  <?php foreach($peopleParents as $parents): ?>
  <div class="members">
    <h2 class="members__title"><?php echo $parents->name; ?></h2>
    <div class="clearfix">
    <?php
      $excludeID = array(
        get_term_by('slug', 'honda', 'people')->term_id,
        get_term_by('slug', 'genki', 'people')->term_id,
        get_term_by('slug', 'qmoto', 'people')->term_id,
        get_term_by('slug', 'miyamoto', 'people')->term_id,
        get_term_by('slug', 'ariup', 'people')->term_id,
      );

      $peoples = get_terms('people', array(
        'hide_empty' => false,
        'orderby' => 'order',
        'parent' => $parents->term_id,
        'exclude' => $excludeID
      ));
      foreach($peoples as $person):
      $pThumb = get_field('people_avatar', 'people'.'_'.$person->term_id);
      $pURL = get_term_link($person);
      $pslug = $person->slug;
    ?>
    <div class="members__list">
      <a href="<?php echo $pURL; ?>">
        <div class="members__thumb">
          <img src="<?php echo $pThumb; ?>" alt="<?php echo $person->name; ?>">
        </div>
        <h2 class="members__name"><?php echo $person->name; ?></h2>
      </a>
    </div>
    <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<?php get_footer(); ?>
