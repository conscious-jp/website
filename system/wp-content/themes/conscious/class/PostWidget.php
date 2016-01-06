<?php

class PostWidget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'post_widget',
            '投稿',
            array( 'description' => '投稿' )
        );
    }

    public function widget( $args, $instance ) {
        $post_cat = $instance['post_cat'];
        $post_num = $instance['post_num'];
        $post_slug = get_category_by_slug($post_cat);

        echo $args['before_widget'];

        echo $args['before_title'];
        echo $post_slug->name;
        echo $args['after_title'];
        echo '<ul class="widget-post">';
        $widgetPost = new WP_Query(array(
            'post_type' => 'post',
            'category_name' => $post_cat,
            'posts_per_page' => $post_num
        ));
        global $post;
        if ($widgetPost->have_posts()) : while($widgetPost->have_posts()) : $widgetPost->the_post();
        ?>
        <li class="widget-post__list">
            <a href="<?php the_permalink(); ?>" class="clearfix">
                <div class="widget-post__thumb">
                    <?php the_post_thumbnail('thumb_s', array('class'=>'thumb')); ?>
                </div>
                <div class="widget-post__body">
                    <h3 class="widget-post__title">
                        <?php
                            if(mb_strlen($post->post_title)>35) {
                                $title= mb_substr($post->post_title,0,35);
                                echo $title . '...';
                            } else {
                                echo $post->post_title;
                            }
                        ?>
                    </h3>
                </div>
            </a>
        </li>
        <?php
        endwhile;
        echo '</ul>';
        ?>
        <div class="widget-post__more">
            <a href="<?php echo home_url('/').$post_cat; ?>">すべて読む<i class="fa fa-chevron-circle-right"></i></a>
        </div>
        <?php
        else: ?>
        <p>投稿なし</p>
        <?php
        endif; wp_reset_query();
        echo $args['after_widget'];
    }

    public function form( $instance ){
        $post_cat = $instance['post_cat'];
        $post_cat_name = $this->get_field_name('post_cat');
        $post_cat_id = $this->get_field_id('post_cat');
        $post_num = $instance['post_num'];
        $post_num_name = $this->get_field_name('post_num');
        $post_num_id = $this->get_field_id('post_num');
        ?>
        <p>
            <label for="<?php echo $post_cat_id; ?>">投稿カテゴリ:</label>
            <input class="widefat" id="<?php echo $post_cat_id; ?>" name="<?php echo $post_cat_name; ?>" type="text" value="<?php echo esc_attr( $post_cat ); ?>">
        </p>
        <p>
            <label for="<?php echo $post_num_id; ?>">表示数:</label>
            <input class="widefat" id="<?php echo $post_num_id; ?>" name="<?php echo $post_num_name; ?>" type="text" value="<?php echo esc_attr( $post_num ); ?>">
        </p>
    <?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

}
register_widget( 'PostWidget' );