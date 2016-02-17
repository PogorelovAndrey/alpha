<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
<?php get_sidebar(); ?>
<section id="page-content">

<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'progression' ); ?></h1>



<p class="page-not-found"><?php _e( 'It looks like nothing was found at this location. ', 'progression' ); ?></p>


<?php get_footer(); ?>