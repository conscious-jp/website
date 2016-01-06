<?php
header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
$podcastDescription = get_field('podcast_description', 'option');
$podcastImage = get_field('podcast_image', 'option');
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
  <channel>
    <title>コンシャスラジオ</title>
    <link><?php echo get_bloginfo('url'); ?></link>
    <language><?php echo get_bloginfo ( 'language' ); ?></language>
    <copyright><?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?></copyright>
    <itunes:author><?php echo get_bloginfo('name'); ?></itunes:author>
    <itunes:summary><?php echo $podcastDescription; ?></itunes:summary>
    <description><?php echo get_bloginfo('url'); ?></description>
    <itunes:owner>
      <itunes:name><?php echo get_bloginfo('name'); ?></itunes:name>
      <itunes:email>info@cons-cious.jp</itunes:email>
    </itunes:owner>
    <itunes:image href="<?php echo $podcastImage; ?>" />
    <itunes:category text="Comedy"/>
    <itunes:category text="Music"/>
    <?php
        $radios = new WP_Query(array(
            'post_type'     => 'post',
            'post_per_page' => 20,
            'tax_query' => array(
                array(
                    'taxonomy'  => 'category',
                    'terms'     => 'radios',
                    'field'     => 'slug',
                    'operator'  => 'IN'
                ),
                'relation'      => 'AND'
            )
        ));
        if ($radios->have_posts()) : while($radios->have_posts()) : $radios->the_post();
        $audioFile = get_field('audio_file');
        $audioURL = $audioFile['url'];
        $audioID = $audioFile['id'];
        $audioMeta = wp_get_attachment_metadata($audioID);
        $filesize = filesize( get_attached_file( $attachment_id ) );
    ?>
    <item>
      <title><?php the_title_rss(); ?></title>
      <itunes:author><?php echo get_bloginfo('name'); ?></itunes:author>
      <itunes:summary><![CDATA[<?php the_excerpt_rss(); ?>]]></itunes:summary>
      <guid isPermaLink="false"><?php the_permalink_rss(); ?></guid>
      <enclosure url="<?php echo $audioURL; ?>" length="<?php echo $audioMeta['filesize']; ?>" type="audio/mpeg" />
      <guid><?php the_guid; ?></guid>
      <pubDate><?php echo get_post_time('D, d M Y G:i:s T') ?></pubDate>
      <itunes:duration><?php echo $audioMeta['length_formatted']; ?></itunes:duration>
    </item>
    <?php endwhile; endif; wp_reset_query(); ?>
  </channel>
</rss>