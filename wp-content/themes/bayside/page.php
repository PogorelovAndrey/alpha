<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
<?php get_sidebar(); ?>
<section id="page-content">

<?php while ( have_posts() ) : the_post(); ?>
	<h1 class="page-title"><?php the_title(); ?></h1>
	<?php the_content(); ?>	
	<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ), 'after' => '</div>' ) ); ?>
<?php endwhile; // end of the loop. ?>

<?php if(of_get_option('page_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>

<!-- section closes in footer -->
<?php get_footer(); ?>