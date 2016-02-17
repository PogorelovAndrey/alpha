<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
<?php get_sidebar(); ?>


<section id="content">
<?php if ( have_posts() ) : ?>


		<h1 class="page-title">
			<?php
				if ( is_category() ) {
					printf( __( '%s', 'progression' ), '<span>' . single_cat_title( '', false ) . '</span>' );

				} elseif ( is_tag() ) {
					printf( __( 'Tag Archives: %s', 'progression' ), '<span>' . single_tag_title( '', false ) . '</span>' );

				} elseif ( is_author() ) {
					/* Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					*/
					the_post();
					printf( __( 'Author Archives: %s', 'progression' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();

				} elseif ( is_day() ) {
					printf( __( 'Daily Archives: %s', 'progression' ), '<span>' . get_the_date() . '</span>' );

				} elseif ( is_month() ) {
					printf( __( 'Monthly Archives: %s', 'progression' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

				} elseif ( is_year() ) {
					printf( __( 'Yearly Archives: %s', 'progression' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

				} 	elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
					 _e( 'Video Archives', 'progression' );
				}
				elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
					 _e( 'Gallery Archives', 'progression' );
				}
				elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
					 _e( 'Audio Archives', 'progression' );
				}
				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
					 _e( 'Quote Archives', 'progression' );
				}
				elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
					 _e( 'Link Archives', 'progression' );
				}
				else {
					_e( 'Archives ', 'progression' );

				}
			?>
		</h1>
		
		<?php
			if ( is_category() ) {
				// show an optional category description
				$category_description = category_description();
				if ( ! empty( $category_description ) )
					echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

			} elseif ( is_tag() ) {
				// show an optional tag description
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) )
					echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
			}
		?>

		
		<div id="mason-layout" class="transitions-enabled fluid">		
		
		
		
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'blog' ); ?>

		<?php endwhile; ?>	
		<div class="clearfix"></div>
		</div><!-- close #mason-layout -->
		
		<?php get_template_part( 'pagination', 'blog' ); ?>
				


		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>
		
		
<?php get_footer(); ?>