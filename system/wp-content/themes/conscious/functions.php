<?php
/**
 * CONSCIOUS functions and definitions
 */
if ( ! function_exists( 'conscious_setup' ) ) :
    /**
     * 基本設定
     */
    function conscious_setup() {
        add_theme_support('post-thumbnails');
        add_image_size( 'thumb_l', 800, 440, true );
        add_image_size( 'thumb_m', 400, 400, true );
        add_image_size( 'thumb_m2', 400, 240, true );
        add_image_size( 'thumb_s', 160, 160, true );
        add_editor_style('css/editor-style.css');
        remove_action('wp_head', 'feed_links_extra', 3);
        if (function_exists('register_sidebar')) {
            register_sidebar(array(
                'name' => 'サイドバー',
                'id' => 'sidebar',
                'before_widget' => '<dl class="widget"><dt class="widget__head">',
                'after_widget' => '</dd></dl>',
                'before_title' => '<h2 class="widget__title">',
                'after_title' => '</h2></dt><dd class="widget__body">'
            ));
        }
    }
endif;
add_action( 'after_setup_theme', 'conscious_setup' );

require_once( ABSPATH . 'wp-includes/ID3/getid3.php' );

/**
 * カスタムウィジェット
 */
require get_template_directory() . '/class/PostWidget.php';


/**
 * CSS, JSのセットアップ
 */
function conscious_scripts() {
    wp_deregister_script( 'jquery' );
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/vendor/fontawesome/css/font-awesome.min.css');
    wp_enqueue_style('conscious-style', get_template_directory_uri() . '/css/main.min.css');
    wp_enqueue_script('jquery', get_template_directory_uri() . '/vendor/jquery/dist/jquery.min.js');
    wp_enqueue_script('inview', get_template_directory_uri() . '/vendor/protonet/jquery.inview/jquery.inview.min.js');
    wp_enqueue_script('font-plus', '//webfont.fontplus.jp/accessor/script/fontplus.js?KoHlmZp2zZE%3D&t=0&aa=1');
    wp_enqueue_style('google-font', '//fonts.googleapis.com/css?family=Lato:400,700,900');
}
add_action( 'wp_enqueue_scripts', 'conscious_scripts' );

/**
 * ぴーぽタクソノミーの作成
 */
function people_init() {
    register_taxonomy(
        'people',
        'post',
        array(
            'label'         => 'ぴーぽー',
            'hierarchical'  => true,
            'rewrite'       => array(
                'slug'      => 'people'
            )
        )
    );
    flush_rewrite_rules();
}
add_action( 'init', 'people_init' );

/**
 * 対談メンバータクソノミーの作成
 */
function interview_member_init() {
    register_taxonomy(
        'interview-member',
        'post',
        array(
            'label'         => '対談メンバー',
            'hierarchical'  => true,
            'rewrite'       => array(
                'slug'      => 'interview-member'
            )
        )
    );
    flush_rewrite_rules();
}
add_action( 'init', 'interview_member_init' );

/**
 * ポッドキャストフィードの作成
 */
function radio_podcast_rss(){
    require_once( get_template_directory() . '/radio-feed-template.php' );
}
function podcast_rss(){
    add_feed('podcast', 'radio_podcast_rss');
}
add_action('init', 'podcast_rss');


/**
 * ACF Options
 */
function acf_options_page_settings( $settings ){
    $settings['title'] = 'サイト設定';
    $settings['pages'] = array(
        array(
            'title' => 'グローバル',
            'menu'  => 'グローバル',
            'slug'  => 'custom-settings'
        ),
        array(
            'title' => 'ポッドキャスト',
            'menu'  => 'ポッドキャスト',
            'slug'  => 'podcast-settings'
        )
    );
    return $settings;
}
add_filter('acf/options_page/settings', 'acf_options_page_settings');


/**
 * 抜粋の文字数を変更
 *
 * @return int
 */
function custom_excerpt_length() {
    return 60;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
 * 抜粋の文末を変更
 *
 * @return string
 */
function new_excerpt_more() {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


/**
 * Twitterツイート数の取得
 *
 * @param $url
 * @return int
 */
function get_twitter_tweet_count($url){
    $json = @file_get_contents('http://urls.api.twitter.com/1/urls/count.json?url='.rawurlencode($url));
    $array = json_decode($json,true);
    if(!isset($array['count'])){
        $count = 0;
    }else{
        $count = $array['count'];
    }
    return $count;
}


/**
 * Facebookいいね数の取得
 *
 * @param $url
 * @return int
 */
function get_facebook_like_count($url){
    $json = @file_get_contents('http://graph.facebook.com/?id='.rawurlencode($url));
    $array = json_decode($json,true);
    if(!isset($array['shares'])){
        $count = 0;
    }else{
        $count = $array['shares'];
    }
    return $count;
}

/**
 * はてぶ数の取得
 *
 * @param $url
 * @return int|string
 */
function get_hatena_hatebu_count($url) {
    $count = @file_get_contents('http://api.b.st-hatena.com/entry.count?url='.rawurlencode($url));
    if(!isset($count) || !$count){
        $count = 0;
    }
    return $count;
}

/**
 * アイコン付きカテゴリの表示
 *
 * @return string
 */
function get_cat_icon_text() {
    $icon = '';
    $cats = get_the_category();
    foreach($cats as $cat) {
        if(!($cat->category_parent)) {
            $catSlug = $cat->slug;
        }else{
            $childCatID = $cat->cat_ID;
            $childCatName = $cat->name;
        }
    }
    switch($catSlug){
        case 'read':
            $icon = '<i class="fa fa-book"></i>';
            break;
        case 'radios':
            $icon = '<i class="fa fa-headphones"></i>';
            break;
        case 'watch':
            $icon = '<i class="fa fa-eye"></i>';
            break;
    }
    $childCatURL = get_category_link($childCatID);
    if($childCatID) {
        $html = '<p class="post__cat cat--'.$catSlug.'"><a href="'.$childCatURL.'" class="js-cat-link">'.$icon.$childCatName.'</a></p>';
    }
    return $html;
}


/**
 * ぴーぽーサムネイルリストの表示
 */
function people_list() {
    global $post;
    $people = wp_get_object_terms($post->ID, 'people', array(
        'orderby' => 'order'
    ));
    foreach($people as $human):
        $humanThumb = get_field('people_avatar', 'people'.'_'.$human->term_id);
        $humanURL = get_term_link($human->term_id, 'people');
    ?>
    <li class="people-lists__list"><a href="<?php echo $humanURL; ?>" class="js-people-link"><img src="<?php echo $humanThumb; ?>" alt="<?php echo $human->name; ?>"></a></li>
    <?php
    endforeach;
}


/**
 * YARPPのスタイルを除外
 */
add_action('wp_print_styles','lm_dequeue_header_styles');
function lm_dequeue_header_styles()
{
    wp_dequeue_style('yarppWidgetCss');
}

add_action('get_footer','lm_dequeue_footer_styles');
function lm_dequeue_footer_styles()
{
    wp_dequeue_style('yarppRelatedCss');
}

/**
 * カスタム条件分岐
 *
 * @param $value
 * @param null $query
 * @return bool
 */
function is_custom($value, $query = null){
    if( !$query ){
        global $wp_query;
        $query = $wp_query;
    }
    switch ($value) {
        case 'first':
            return ($query->current_post === 0);
            break;
        case 'last':
            return ($query->current_post+1 === $query->post_count);
            break;
        case 'odd':
            return ((($query->current_post+1) % 2) === 1);
            break;
        case 'even':
            return ((($query->current_post+1) % 2) === 0);
            break;
    }
}

function get_people_ranking($rang='all'){
  $ame = get_term_by('slug', 'amenomori', 'people')->term_id;
  $people = get_terms('people', array(
    'exclude' => $ame
  ));
  $people_ranking = array();
  foreach($people as $p) {
    if($p->parent != 0){
      $args = array(
        'tax_query' => array(
          array(
            'taxonomy' => 'people',
            'field' => 'slug',
            'terms' => $p->slug
          )
        )
      );
      $ppost = get_posts($args);
      $views = 0;
      foreach($ppost as $pt){
        $views += wpp_get_views($pt->ID, $rang);
      }
      $pThumb = get_field('people_avatar', 'people'.'_'.$p->term_id);
      $ranking = array(
        'term_id' => $p->term_id,
        'term_name' => $p->name,
        'term_thumb' => $pThumb,
        'term_link' => get_term_link($p),
        'view'=>$views
      );
      array_push($people_ranking, $ranking);
    }
  }
  foreach($people_ranking as $key => $value){
    $key_id[$key] = $value['view'];
  }
  array_multisort ( $key_id , SORT_DESC , $people_ranking);
  $html = '';
  $rank = 0;
  foreach($people_ranking as $list){
    $rank = $rank + 1;
    if($rank <= 5){
      $thumb = $list['term_thumb'];
      $name = $list['term_name'];
      $link = $list['term_link'];
      $html .= '<li><a href="'.$link.'"><div class="thumb"><img src="'.$thumb.'"></div><div class="name">'.$name.'</div></a></li>';
    }
  }
  echo '<ul class="people-ranking">'.$html.'</ul>';
}
