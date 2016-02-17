<?php
/**
 * The Header for our theme.
 *
 * @package progression
 * @since progression 1.0
 */
?><!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>  <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">

	<?php if(is_front_page() && of_get_option('home_title')): ?>
	<title><?php echo of_get_option('home_title'); ?></title>
	<?php else: ?>
	<title><?php global $page, $paged;  wp_title( '|', true, 'right' ); bloginfo( 'name' );
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' ); if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', 'progression' ), max( $paged, $page ) ); ?></title>
	<?php endif; ?>

	<?php if(is_front_page() && of_get_option('home_meta')): ?>
	<meta name="description" content="<?php echo of_get_option('home_meta'); ?>" /> 
	<?php endif; ?>

	<?php if(of_get_option('favicon')): ?><link href="<?php echo of_get_option('favicon'); ?>" rel="shortcut icon" /> <?php endif; ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if(of_get_option('page_fixed_header', '0')): ?><div id="sticky-navigation-spacer"></div><?php endif; ?>
<header<?php if(of_get_option('page_fixed_header', '0')): ?> id="sticky-navigation-bayside"<?php endif; ?>>	
	<div class="header-top">
		<div class="grid2column">
			<?php wp_nav_menu( array('theme_location' => 'header', 'depth' => 1, 'menu_class' => 'header-menu') ); ?>
		</div>
		<div class="grid2column lastcolumn">
			<div class="social-icons">
					<?php if(of_get_option('rss_link')): ?>
					<a class="rss" href="<?php echo of_get_option('rss_link'); ?>" target="_blank">r</a>
					<?php endif; ?>
					<?php if(of_get_option('facebook_link')): ?>
					<a class="facebook" href="<?php echo of_get_option('facebook_link'); ?>" target="_blank">F</a>
					<?php endif; ?>
					<?php if(of_get_option('twitter_link')): ?>
					<a class="twitter" href="<?php echo of_get_option('twitter_link'); ?>" target="_blank">t</a>
					<?php endif; ?>
					<?php if(of_get_option('skype_link')): ?>
					<a class="skype" href="<?php echo of_get_option('skype_link'); ?>" target="_blank">s</a>
					<?php endif; ?>
					<?php if(of_get_option('vimeo_link')): ?>
					<a class="vimeo" href="<?php echo of_get_option('vimeo_link'); ?>" target="_blank">v</a>
					<?php endif; ?>
					<?php if(of_get_option('linkedin_link')): ?>
					<a class="linkedin" href="<?php echo of_get_option('linkedin_link'); ?>" target="_blank">l</a>
					<?php endif; ?>
					<?php if(of_get_option('dribbble_link')): ?>
					<a class="dribbble" href="<?php echo of_get_option('dribbble_link'); ?>" target="_blank">d</a>
					<?php endif; ?>
					<?php if(of_get_option('forrst_link')): ?>
					<a class="forrst" href="<?php echo of_get_option('forrst_link'); ?>" target="_blank">f</a>
					<?php endif; ?>
					<?php if(of_get_option('flickr_link')): ?>
					<a class="flickr" href="<?php echo of_get_option('flickr_link'); ?>" target="_blank">n</a>
					<?php endif; ?>
					<?php if(of_get_option('google_link')): ?>
					<a class="google" href="<?php echo of_get_option('google_link'); ?>" target="_blank">g</a>
					<?php endif; ?>
					<?php if(of_get_option('youtube_link')): ?>
					<a class="youtube" href="<?php echo of_get_option('youtube_link'); ?>" target="_blank">y</a>
					<?php endif; ?>
			</div><!-- close .social-icons -->
		</div>
		<div class="clearfix"></div>
	</div><!-- close .header-top-->	
	<h1 id="logo"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo of_get_option('logo', get_template_directory_uri() . '/images/logo.png'); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo of_get_option('logo_width'); ?>" /></a></h1>
	<nav>
		<?php wp_nav_menu( array('theme_location' => 'primary', 'depth' => 4, 'menu_class' => 'sf-menu') ); ?>
	</nav>
	<div class="clearfix"></div>
</header>


<div id="main" class="site-main">