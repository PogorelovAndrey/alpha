<div class="boxed-mason col2">
	<div class="content-container <?php if(get_post_meta($post->ID, 'links_advertising', true)): ?>advertisement-bayside<?php endif; ?>">
	<?php if(get_post_meta($post->ID, 'links_advertising', true)): ?>
	<?php echo get_post_meta($post->ID, 'links_advertising', true) ?>
	<?php else: ?>
		
		<!-- video embed code -->
		<?php if(get_post_meta($post->ID, 'videoembed_videoembed', true)): ?>
		<div class="featured-media <?php if( has_post_format( 'audio' ) ): ?>audio-embed<?php endif; ?>">
			<div class="video-container"><?php echo get_post_meta($post->ID, 'videoembed_videoembed', true) ?></div>
			<div class="media-overlay">
				<span class="category-index"><?php the_category(' '); ?></span>
				<?php if( has_post_format( 'video' ) ): ?>	
				<span class="post-type-icon"><a href="<?php echo get_post_format_link('video'); ?>" class="video-icon">Article</a></span>
				<?php endif; ?>
				<?php if( has_post_format( 'audio' ) ): ?>
				<span class="post-type-icon"><a href="<?php echo get_post_format_link('audio'); ?>" class="audio-icon">audio-icon</a></span>
				<?php endif; ?>
			</div><!-- close .media-overlay -->
			<div class="gradient-overlay"></div>
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
						<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-thumb-retina'); ?>
						<?php $image = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
						<li><a href="<?php echo $image[0]; ?>" rel="prettyPhoto[gallery]" class="hover-gradient"><img src="<?php echo $thumbnail[0]; ?>" alt="gallery-blog" /></a></li>
						<?php endforeach; endif; ?>
					</ul>
				</div>
			<?php else: ?>	

			<a href="<?php if(get_post_meta($post->ID, 'links_link_custom', true)): ?><?php echo get_post_meta($post->ID, 'links_link_custom', true) ?><?php else: ?><?php if(get_post_meta($post->ID, 'videoembed_videopopup', true)): ?><?php echo get_post_meta($post->ID, 'videoembed_videopopup', true) ?><?php else: ?><?php the_permalink(); ?><?php endif; ?><?php endif; ?>" class="hover-gradient <?php if(get_post_meta($post->ID, 'videoembed_videopopup', true)): ?>video-pop-up<?php endif; ?>" <?php if(get_post_meta($post->ID, 'videoembed_videopopup', true)): ?>rel="prettyPhoto[gallery]"<?php endif; ?>><?php the_post_thumbnail('progression-thumb-retina'); ?></a><?php endif; ?>
			
		

			<div class="media-overlay">
				<span class="category-index"><?php the_category(' '); ?></span>
				<?php if( has_post_format( 'gallery' ) ): ?>
				<span class="post-type-icon"><a href="<?php echo get_post_format_link('gallery'); ?>" class="photo-icon">photo-icon</a></span>
				<?php endif; ?>
				<?php if( has_post_format( 'video' ) ): ?>
				<span class="post-type-icon"><a href="<?php echo get_post_format_link('video'); ?>" class="video-icon">video-icon</a></span>
				<?php endif; ?>
				<?php if( has_post_format( 'link' ) ): ?>
				<span class="post-type-icon"><a href="<?php echo get_post_format_link('link'); ?>" class="link-icon">link-icon</a></span>
				<?php endif; ?>
				<?php if( has_post_format( 'audio' ) ): ?>
				<span class="post-type-icon"><a href="<?php echo get_post_format_link('audio'); ?>" class="audio-icon">audio-icon</a></span>
				<?php endif; ?>
				<?php if( has_post_format( 'quote' ) ): ?>
				<span class="post-type-icon"><a href="<?php echo get_post_format_link('quote'); ?>" class="quote-icon">quote-icon</a></span>
				<?php endif; ?>
				<?php 
				$format = get_post_format();
				if ( false === $format ) {
				?>
				<?php
				$the_cat = get_the_category();
				$category_name = $the_cat[0]->cat_name;
				$category_link = get_category_link( $the_cat[0]->cat_ID );
				?>
				<span class="post-type-icon"><a href="<?php echo $category_link ?>" class="article-icon">article-icon</a></span>
				<?php 
				}
				?>	
			</div><!-- close .media-overlay (Icon and link to post type) -->
			<div class="gradient-overlay"></div>
		</div><!-- close .featured-media -->
		<?php endif; ?>
		<!-- end featured image code -->
		
		<div class="featured-summary">
			<h2><a href="<?php if(get_post_meta($post->ID, 'links_link_custom', true)): ?><?php echo get_post_meta($post->ID, 'links_link_custom', true) ?><?php else: ?><?php the_permalink(); ?><?php endif; ?>"><?php the_title(); ?></a></h2>
			
			<?php if( has_post_format( 'quote' ) ): ?>
			<?php the_content('',FALSE,''); ?>
			<?php else: ?>	
				<?php if( has_post_format( 'audio' ) ): ?>
				<?php the_content('',FALSE,''); ?>
				<?php else: ?>
			<?php the_excerpt(); ?>
			<?php endif; ?>
			<?php endif; ?>
			
			<div class="meta-data-index">
				<span class="time-posted-mini"><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?> <?php _e('ago','progression'); ?></a></span><span class="comments-mini"><?php comments_popup_link( '<span class="leave-reply">' . __( '0', 'progression' ) . '</span>', _x( '1', 'comments number', 'progression' ), _x( '%', 'comments number', 'progression' ) ); ?></span>
			</div>
			
		</div><!-- close .featured-summary -->
		<?php endif; ?>	
	</div><!-- close .content-container -->
</div><!-- close boxed-mason-->