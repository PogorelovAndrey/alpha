<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h6 class="bayside-category"><?php the_category(' '); ?></h6>
	<h2 class="blog-post"><?php the_title(); ?></h2>
	<?php progression_posted_on(); ?><!-- call to /inc/template-tags.php -->
	
	
	<!-- video embed code -->
	<?php if(get_post_meta($post->ID, 'videoembed_videoembed', true)): ?>
		<div class="featured-media <?php if( has_post_format( 'audio' ) ): ?>audio-embed<?php endif; ?>">
			<div class="video-container"><?php echo get_post_meta($post->ID, 'videoembed_videoembed', true) ?></div>
		</div><!-- close .featured-media -->
	<?php endif; ?>
	<!-- end video embed code -->
	
	<!-- if featured image code -->
	<?php if(has_post_thumbnail()): ?>
	<div class="featured-media">
		<?php if( has_post_format( 'gallery' ) ): ?>
			<div class="flexslider">
		      	<ul class="slides">
					<?php
					$args = array(
					    'post_type' => 'attachment',
					    'numberposts' => '-1',
					    'post_status' => null,
					    'post_parent' => $post->ID,
						'orderby' => 'menu_order',
						'order' => 'ASC'
					);
					$attachments = get_posts($args);
					?>
					<?php 
					if($attachments):
					    foreach($attachments as $attachment):
					?>
					<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-single'); ?>
					<?php $image = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
					<li><a href="<?php echo $image[0]; ?>" rel="prettyPhoto[gallery]" class="hover-gradient"><img src="<?php echo $thumbnail[0]; ?>" alt="gallery-image" /></a></li>
					<?php endforeach; endif; ?>
				</ul>
			</div>
		<?php else: ?>
		<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
		<a href="<?php if(get_post_meta($post->ID, 'videoembed_videopopup', true)): ?><?php echo get_post_meta($post->ID, 'videoembed_videopopup', true) ?><?php else: ?><?php echo $image[0]; ?><?php endif; ?>" <?php if(get_post_meta($post->ID, 'videoembed_videopopup', true)): ?>class="video-pop-up"<?php endif; ?> rel="prettyPhoto"><?php the_post_thumbnail('progression-single'); ?></a>
			<?php endif; ?>
	</div>
	<?php endif; ?>
	<!-- end featured image code -->
	
	<div class="social-networks-bayside">
		<script type="text/javascript">var switchTo5x=true;</script>
		<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher: "b779a7d6-8947-431e-8a89-abe575e1b4b0"}); </script>
		<span class='st_facebook' displayText='Facebook'></span>
		<span class='st_twitter' displayText='Tweet'></span>
		<span class='st_pinterest' displayText='Pinterest'></span>
		<span class='st_email' displayText='Email'></span>
		<span class="st_print"><a href="javascript:window.print()">Print</a></span>
		<div class="clearfix"></div>
	</div>

	<?php the_content(); ?>

	
	<div class="clearfix"></div>
	<hr>
</div><!-- #post-<?php the_ID(); ?> -->
