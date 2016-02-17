<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
<?php get_sidebar(); ?>


<section id="content">


<?php $page_for_posts = get_option('page_for_posts'); ?>




<?php if ( have_posts() ) : ?>
	
	<div id="mason-layout" class="transitions-enabled fluid">
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', 'blog' ); ?>
	<?php endwhile; ?>
	
	<div class="clearfix"></div>
	</div><!-- close #mason-layout -->
	
	<?php get_template_part( 'pagination', 'blog' ); ?>
	<!--div><?php posts_nav_link(); // default tag ?></div-->

<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

	<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>


<?php get_footer(); ?>