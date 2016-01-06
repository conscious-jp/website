<article class="post-list js-post-link clearfix" data-link="<?php the_permalink(); ?>">
	<div>
		<div class="post-list__thumb">
			<?php the_post_thumbnail('thumb_m', array('class'=>'thumb')); ?>
		</div>
		<div class="post-list__body">
			<?php echo get_cat_icon_text(); ?>
			<h2 class="post-list__title">
				<?php the_title(); ?>
			</h2>
			<div class="post-list__excerpt">
				<?php the_excerpt(); ?>
			</div>
			<div class="post__meta clearfix">
				<ul class="post__people people-lists">
					<?php people_list(); ?>
				</ul>
				<p class="post__date"><i class="fa fa-clock-o"></i>
					<?php the_time('Y.m.d'); ?>
				</p>
				
			</div>
		</div>
	</div>
</article>
