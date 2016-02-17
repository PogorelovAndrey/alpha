<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'progression'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$animations = array(
		'fade' => __('Fade', 'progression'),
		'slide' => __('Slide', 'progression')
	);
	

	
	$animation_true = array(
		'true' => __('On', 'progression'),
		'false' => __('Off', 'progression')
	);
	

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'progression'),
		'two' => __('Pancake', 'progression'),
		'three' => __('Omelette', 'progression'),
		'four' => __('Crepe', 'progression'),
		'five' => __('Waffle', 'progression')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Basic', 'progression'),
		'type' => 'heading');
		
	
	$options[] = array(
		'name' => __('Copyright', 'progression'),
		'desc' => __('Choose your copyright text here. ', 'progression'),
		'id' => 'copyright_textarea',
		'std' => '&copy; 2012 All Rights Reserved.<br>Developed by <a href="http://themeforest.net/user/ProgressionStudios/?ref=ProgressionStudios" target="_blank">Progression Studios</a>.',
		'type' => 'textarea');
	

	$options[] = array(
		'name' => __('Display Fixed Header', 'progression'),
		'desc' => __('Select this checkbox to enable a fixed header.  This will keep the header and navigation regardless of scrolling.', 'progression'),
		'id' => 'page_fixed_header',
		'std' => '0',
		'type' => 'checkbox');
	
	
	$options[] = array(
		'name' => __('Display Comments on Pages', 'progression'),
		'desc' => __('Select this checkbox to enable the comments on pages.  Once selected you can also manually enable/disable comments on a page-by-page basis via the Discussion Screen Option.', 'progression'),
		'id' => 'page_comments_default',
		'std' => '0',
		'type' => 'checkbox');
		
			
	$options[] = array(
		'name' => __('Display Headings on Category Pages', 'progression'),
		'desc' => __('Select this checkbox to disable the category headings on Category and Archives Pgaes.  ', 'progression'),
		'id' => 'page_headings',
		'std' => '0',
		'type' => 'checkbox');
	
	
	
	
	$options[] = array(
		'name' => __('Checkbox to turn off Infinite Scroll (Manual Load More Button)', 'progression'),
		'desc' => __('Select this checkbox to turn off infinite scroll.  When checkbox is unselected, posts will load as the user scroll down infinitely instead of the default button push.', 'progression'),
		'id' => 'homepage_infinite_scroll',
		'std' => '1',
		'type' => 'checkbox');
	
	

	$options[] = array(
		'name' => __('Option to turn on Normal Pagination (Over-rides Infinite Scroll option above)', 'progression'),
		'desc' => __('Select this checkbox to turn on normal pagination instead of the load more pagination.', 'progression'),
		'id' => 'homepage_normal_pagination',
		'std' => '0',
		'type' => 'checkbox');
	
	
	
	$options[] = array(
		'name' => __('Main Post Container Width', 'progression'),
		'desc' => __('Choose your main container width in pixels.  Default is 275.', 'progression'),
		'id' => 'column_width_edit',
		'std' => '275',
		'class' => 'mini',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Social Icons', 'progression'),
		'type' => 'heading');
		
	
	$options[] = array(
		'name' => __('Header Social Icons', 'progression'),
		'desc' => __('These icons will display in the header of your theme.  Leave the text area blank and the icon will disappear automatically.', 'progression'),
		'type' => 'info');
	
	$options[] = array(
		'name' => __('RSS Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'rss_link',
		'std' => '',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('Facebook Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'facebook_link',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Twitter Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'twitter_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Skype Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'skype_link',
		'std' => '',
		'type' => 'text');
		
		
	$options[] = array(
		'name' => __('Vimeo Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'vimeo_link',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('LinkedIn Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'linkedin_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Dribbble Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'dribbble_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Forrst Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'forrst_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Flickr Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'flickr_link',
		'std' => '',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Google Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'google_link',
		'std' => '',
		'type' => 'text');	

	
	$options[] = array(
		'name' => __('Youtube Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'youtube_link',
		'std' => '',
		'type' => 'text');	
	
	
	
	
	$options[] = array(
		'name' => __('Appearance', 'progression'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Logo', 'progression'),
		'desc' => __('Use the upload button to upload your sites logo and then click <strong>Use this image</strong>.', 'progression'),
		'id' => 'logo',
		"std" => get_template_directory_uri() . "/images/logo.png",
		'type' => 'upload');
	
	
	$options[] = array(
		'name' => __('Logo Width', 'progression'),
		'desc' => __('Choose your logo width in pixels.  Default is 40.', 'progression'),
		'id' => 'logo_width',
		'std' => '40',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('FavIcon', 'progression'),
		'desc' => __('Use the upload button to upload your favicon (bookmark icon) and then click <strong>Use this image</strong>.', 'progression'),
		'id' => 'favicon',
		'type' => 'upload');
	
	
	$options[] = array(
		'name' => __('Navigation Height', 'progression'),
		'desc' => __('Choose how tall you want your navigation.  Adjust this if your logo is too tall or short. Default is 50', 'progression'),
		'id' => 'navigation_height',
		'std' => '50',
		'class' => 'mini',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Main Body Font', 'progression'),
		'desc' => __('Choose a Main Navigation Font. Default font is <strong>Helvetica Neue</strong>', 'progression'),
		'id' => 'main_font',
		'std' => 'Helvetica Neue',
		'class' => 'mini',
		'type' => 'text');

	
	$options[] = array(
		'name' => __('Main Custom Font', 'progression'),
		'desc' => __('Choose the main custom font.  This is used on the Navigation.  Default font is <strong>Titillium Web</strong>', 'progression'),
		'id' => 'navigation_font',
		'std' => 'Titillium Web',
		'class' => 'mini',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Secondary Custom Font', 'progression'),
		'desc' => __('Choose the secondary custom font.  This is used on the Headings and Buttons.  Default font is <strong>PT Sans</strong>', 'progression'),
		'id' => 'secondary_font',
		'std' => 'PT Sans',
		'class' => 'mini',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Tools', 'progression'),
		'type' => 'heading');
	
	
	$options[] = array(
		'name' => __('Homepage Title', 'progression'),
		'desc' => __('Enter a title for the homepage, leave blank if you want to use an auto generated one or a third party plugin.', 'progression'),
		'id' => 'home_title',
		'std' => '',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('Homepage Meta Description', 'progression'),
		'desc' => __('Enter a description for the homepage, about 140 characters.', 'progression'),
		'id' => 'home_meta',
		'std' => '',
		'type' => 'text');
		

		
	
	$options[] = array(
		'name' => __('Tracking Code', 'progression'),
		'desc' => __('Paste your tracking code here e.g. Google Analytics etc... without &lt;script&gt; tags.', 'progression'),
		'id' => 'tracking_code',
		'std' => '',
		'type' => 'textarea');
		
	
	$options[] = array(
		'name' => __('Custom CSS Code', 'progression'),
		'desc' => __('Paste custom JavaScript code here without &lt;style&gt;&lt;/style&gt; tags.', 'progression'),
		'id' => 'custom_css',
		'std' => '',
		'type' => 'textarea');
	
	
	$options[] = array(
		'name' => __('Custom Javascript Code', 'progression'),
		'desc' => __('Paste custom JavaScript code here without &lt;script&gt;&lt;s/cript&gt; tags.', 'progression'),
		'id' => 'custom_js',
		'std' => '',
		'type' => 'textarea');
	
	
	
	
		
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>



<?php
}