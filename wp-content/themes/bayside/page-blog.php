<?php
// Template Name: Blog Page
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
<?php get_sidebar(); ?>


<section id="page-content">
	
	<?php while(have_posts()): the_post(); ?>
		<?php $cc = get_the_title(); if($cc != '') { ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php } ?>
		
		<?php $cc = get_the_content(); if($cc != '') { ?>
			<div id="home-page-content">
				<?php the_content(); ?>	
			</div>
		<?php } ?>
	<?php endwhile; ?>
	
	

	<?php 
	global $more;    // Declare global $more (before the loop).
	?>
	
	<?php
	if ( get_query_var('paged') ) {
	    $paged = get_query_var('paged');
	} else if ( get_query_var('page') ) {
	    $paged = get_query_var('page');
	} else {
	    $paged = 1;
	}
	
	
	$postIds = get_post_meta($post->ID, 'pageoptions_blog_category', true); // get custom field value
	    $arrayIds = explode(',', $postIds); // explode value into an array of ids
	    if(count($arrayIds) <= 1) // if array contains one element or less, there's spaces after comma's, or you only entered one id
	    {
	        if( strpos($arrayIds[0], ',') !== false )// if the first array value has commas, there were spaces after ids entered
	        {
	            $arrayIds = array(); // reset array
	            $arrayIds = explode(', ', $postIds); // explode ids with space after comma's
	        }

	    }

	$postspage = get_post_meta($post->ID, 'pageoptions_pstsperpage', true);
	
	query_posts( array( 'posts_per_page'=> $postspage, 'paged' => $paged, 'tax_query' => array(
		array('taxonomy' => 'category',
	     					'terms' => $arrayIds,
	     					'field' => 'slug'
	   ))
	 ) );
	// begin the loop
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	global $post; 
	?>
	
	
	<?php 
	$more = 0;       // Set (inside the loop) to display content above the more tag.
	?>
	
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php if(get_post_meta($post->ID, 'links_advertising', true)): ?>
		<?php echo get_post_meta($post->ID, 'links_advertising', true) ?>
		<?php else: ?>

		<h6 class="bayside-category"><?php the_category(' '); ?></h6>
		<h2 class="blog-post"><a href="<?php if(get_post_meta($post->ID, 'links_link_custom', true)): ?><?php echo get_post_meta($post->ID, 'links_link_custom', true) ?><?php else: ?><?php the_permalink(); ?><?php endif; ?>"><?php the_title(); ?></a></h2>
		<?php progression_posted_on(); ?><!-- call to /inc/template-tags.php -->

		
		
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
						<li><a href="<?php echo $image[0]; ?>" rel="prettyPhoto[gallery]" class="hover-gradient"><img src="<?php echo $thumbnail[0]; ?>" /></a></li>
						<?php endforeach; endif; ?>
					</ul>
				</div>
			<?php else: ?>
				<a href="<?php if(get_post_meta($post->ID, 'links_link_custom', true)): ?><?php echo get_post_meta($post->ID, 'links_link_custom', true) ?><?php else: ?><?php if(get_post_meta($post->ID, 'videoembed_videopopup', true)): ?><?php echo get_post_meta($post->ID, 'videoembed_videopopup', true) ?><?php else: ?><?php the_permalink(); ?><?php endif; ?><?php endif; ?>" <?php if(get_post_meta($post->ID, 'videoembed_videopopup', true)): ?>class="video-pop-up<?php endif; ?>" <?php if(get_post_meta($post->ID, 'videoembed_videopopup', true)): ?>rel="prettyPhoto[gallery]"<?php endif; ?>><?php the_post_thumbnail('progression-single'); ?></a>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php if( has_post_format( 'quote' ) ): ?>
		<?php the_content('',FALSE,''); ?>
		<?php else: ?>	
			<?php if( has_post_format( 'audio' ) ): ?>
			<?php the_content('',FALSE,''); ?>
			<?php else: ?>
		<?php the_excerpt(); ?>
		<?php endif; ?>
		<?php endif; ?>

		<?php endif; ?>

		<hr>

	</div><!-- #post-<?php the_ID(); ?> -->

	<?php endwhile; ?>
	
	
	<div class="clearfix"></div>
	<?php kriesi_pagination($pages = '', $range = 2); ?>


<?php endif; ?>


<?php get_footer(); ?>