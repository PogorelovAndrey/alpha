<?php
// Template Name: HomePage
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
<?php get_sidebar(); ?>

<section id="content">
	
	<!-- this code pull in the homepage content -->
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
	<div id="mason-layout" class="transitions-enabled fluid">
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
	
	<?php get_template_part( 'content', 'blog' ); ?>
	
	<?php endwhile; ?>
	<div class="clearfix"></div>
	</div><!-- close #mason-layout -->
	
	
	<?php get_template_part( 'pagination', 'blog' ); ?>
	
	

<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
	<?php get_template_part( 'no-results', 'index' ); ?>
	<?php endif; ?>

<?php get_footer(); ?>