<?php


$prefix = 'pageoptions_';

$fields = array(
	array( // Taxonomy Select box
			'label'	=> 'Blog Page Template Category', // <label>
			'desc'  => 'Choose what blog categories you want to pull into the Homepage & Blog page templates.  Type in the blog slugs separated by a comma with NO spaces.  ',// the description is created in the callback function with a link to Manage the taxonomy terms
			'id'	=> $prefix.'blog_category', // field id and name, needs to be the exact name of the taxonomy
			'type'	=> 'text' // type of field
	),
	array( // Taxonomy Select box
			'label'	=> 'Blog Page Template Posts Per Page', // <label>
			'desc'  => 'Choose how many posts per page on your Homepage & Blog page templates.  All other category templates posts per page are controlled under Settings > Reading.  ',// the description is created in the callback function with a link to Manage the taxonomy terms
			'id'	=> $prefix.'pstsperpage', // field id and name, needs to be the exact name of the taxonomy
			'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$pageoptions_box = new custom_add_meta_box( 'pageoptions_box', 'Page Options', $fields, 'page', false );



$prefix = 'contactpage_';

$fields = array(
	array( // Text Input
		'label'	=> 'Map Address for Contact page', // <label>
		'desc'	=> 'Add your map address here.  Latitude and Longitude also work.', // description
		'id'	=> $prefix.'mapaddress', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Contact Page Email Address', // <label>
		'desc'	=> 'Add the e-mail address you want to use for your e-mails using the default contact form. Alternatively you can use the "Contact Form 7 Plugin" from wordpress.org', // description
		'id'	=> $prefix.'emailaddress', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$contactpage_box = new custom_add_meta_box( 'contactpage_box', 'Contact Page Options', $fields, 'page', false );




$prefix = 'videoembed_';

$fields = array(
	array( // Text Input
		'label'	=> 'Video Embed Code', // <label>
		'desc'	=> 'Add your video embed code here.', // description
		'id'	=> $prefix.'videoembed', // field id and name
		'type'	=> 'textarea' // type of field
	),
	array( // Text Input
		'label'	=> 'Video Lightbox Code', // <label>
		'desc'	=> 'Link to a video for a lightbox pop-up.  You will need upload a featured image. Example link:  http://vimeo.com/56262423', // description
		'id'	=> $prefix.'videopopup', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$videoembed_box = new custom_add_meta_box( 'videoembed_box', 'Video Embed', $fields, 'post', false );





$prefix = 'links_';

$fields = array(
	array( // Text Input
		'label'	=> 'Custom Post Link', // <label>
		'desc'	=> 'Add a custom link for your post (Use Link Format).', // description
		'id'	=> $prefix.'link_custom', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Advertisement Post', // <label>
		'desc'	=> 'Add an advertisement image and link here.  This will over-ride all other post options', // description
		'id'	=> $prefix.'advertising', // field id and name
		'type'	=> 'textarea' // type of field
	)
);
/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$videoembed_box = new custom_add_meta_box( 'links_box', 'Custom Links & Advertisement', $fields, 'post', false );


