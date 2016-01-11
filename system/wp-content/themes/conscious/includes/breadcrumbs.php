<?php if ( function_exists('yoast_breadcrumb') && !is_home() ): ?>
  <?php if ( is_tax('people')) : ?>
    <div class="breadcrumbs">
      <span xmlns:v="http://rdf.data-vocabulary.org/#">
        <span typeof="v:Breadcrumb">
          <a href="<?php echo home_url(); ?>" rel="v:url" property="v:title">ホーム</a>
          <i class="fa fa-caret-right"></i>
          <span rel="v:child" typeof="v:Breadcrumb">
            <a href="<?php echo home_url('/'); ?>peoples" rel="v:url" property="v:title">ぴーぽー</a>
            <i class="fa fa-caret-right"></i>
            <strong class="breadcrumb_last"><?php single_term_title(); ?></strong>
          </span>
        </span>
      </span>
    </div>
  <?php else: ?>
    <?php yoast_breadcrumb('<div class="breadcrumbs">','</div>'); ?>
  <?php endif; ?>
<?php endif; ?>
