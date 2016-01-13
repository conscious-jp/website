<?php
/**
 * The template for displaying the footer
 */
?>
</div>
<?php get_sidebar(); ?>
</div>

<footer class="footer">
    <div class="container clearfix">
        <div class="footer__col">
            <h2 class="footer__title">コンテンツ</h2>
            <ul class="footer__menu">
                <li class="footer__list"><a href="<?php echo home_url('/'); ?>read"><i class="fa fa-chevron-circle-right"></i>よむコン</a></li>
                <li class="footer__list"><a href="<?php echo home_url('/'); ?>radios"><i class="fa fa-chevron-circle-right"></i>きくコン</a></li>
                <li class="footer__list"><a href="<?php echo home_url('/'); ?>watch"><i class="fa fa-chevron-circle-right"></i>みるコン</a></li>
                <li class="footer__list"><a href="<?php echo home_url('/'); ?>special"><i class="fa fa-chevron-circle-right"></i>すぺコン</a></li>
            </ul>
        </div>
        <div class="footer__col">
            <h2 class="footer__title">コンシャスについて</h2>
            <ul class="footer__menu">
                <li class="footer__list"><a href="<?php echo home_url('/'); ?>peoples"><i class="fa fa-chevron-circle-right"></i>ぴーぽー</a></li>
                <li class="footer__list"><a href="<?php echo home_url('/'); ?>about"><i class="fa fa-chevron-circle-right"></i>コンシャスって何？</a></li>
                <li class="footer__list"><a href="<?php echo home_url('/'); ?>contact"><i class="fa fa-chevron-circle-right"></i>お問い合わせ</a></li>
            </ul>
        </div>
        <div class="footer__col">
            <h3 class="footer__catch"><?php bloginfo('description'); ?></h3>
            <div class="footer__logo">
                <a href="<?php echo home_url('/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo_white.svg" alt="<?php bloginfo('name'); ?>"></a>
            </div>
            <?php $siteDescription = get_field('site_description', 'option'); ?>
            <p class="footer__description"><?php echo $siteDescription; ?></p>
            <p class="footer__copyright">&copy;Copyright <?php echo date('Y'); ?> CONSCIOUS. All Rights Reserved. </p>
        </div>
    </div>
</footer>

<?php if( is_single() || is_page() ): ?>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5&appId=630489573760323";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<script type="text/javascript" src="//b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<script type="text/javascript">
    window.___gcfg = {lang: 'ja'};
    (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/platform.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
</script>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'cons-cious-jp'; // required: replace example with your forum shortname
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<?php endif; ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.min.js"></script>

<?php wp_footer(); ?>

</body>
</html>
