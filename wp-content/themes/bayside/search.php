<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

<?php get_sidebar(); ?>
<?php if ( have_posts() ) : ?>

		<section id="content">
			
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'progression' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			
			
		<div id="mason-layout" class="transitions-enabled fluid">		
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php get_template_part( 'content', 'blog' ); ?>
			
		<?php endwhile; ?>
		<div class="clearfix"></div>
		</div><!-- close #mason-layout -->
		
		<?php get_template_part( 'pagination', 'blog' ); ?>


		<?php else : ?>	
			<section id="content">
			<?php get_template_part( 'no-results', 'search' ); ?>
		<?php endif; ?>
			
			
			
			
<?php get_footer(); ?>