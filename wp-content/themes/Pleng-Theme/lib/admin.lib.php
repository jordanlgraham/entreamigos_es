<?php
/*
	Begin creating admin options
*/

$themename = THEMENAME;
$shortname = SHORTNAME;

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array(
	0		=> "Choose a category"
);
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}

$pages = get_pages(array('parent' => -1));
$wp_pages = array(
	0		=> "Choose a page"
);
foreach ($pages as $page_list ) {
       $wp_pages[$page_list->ID] = $page_list->post_title;
}


$pp_handle = opendir(TEMPLATEPATH.'/fonts');
$pp_font_arr = array();

while (false!==($pp_file = readdir($pp_handle))) {
	if ($pp_file != "." && $pp_file != ".." && $pp_file != ".DS_Store") {
		$pp_file_name = basename($pp_file, '.js');
		
		if($pp_file_name != 'Quicksand_300.font')
		{
			$pp_name = explode('_', $pp_file_name);
		
			$pp_font_arr[$pp_file_name] = $pp_name[0];
		}
	}
}
closedir($pp_handle);
asort($pp_font_arr);


$options = array (
 
//Begin admin header
array( 
		"name" => $themename." Options",
		"type" => "title"
),
//End admin header
 

//Begin first tab "General"
array( 
		"name" => "General",
		"type" => "section"
)
,

array( "type" => "open"),

array( "name" => "Your Logo (Image URL)",
	"desc" => "Enter the URL of image that you want to use as the logo",
	"id" => $shortname."_logo",
	"type" => "text",
	"std" => "",
),
array( "name" => "Google Analytics Domain ID ",
	"desc" => "Get analytics on your site. Simply give us your Google Analytics Domain ID (something like UA-123456-1)",
	"id" => $shortname."_ga_id",
	"type" => "text",
	"std" => ""

),
array( "name" => "Google Maps API key ",
	"desc" => "Get maps on your site. Simply give us your Google Maps API key (<a href=\"http://code.google.com/apis/maps/signup.html\">You can get it here</a>)",
	"id" => $shortname."_gm_key",
	"type" => "text",
	"std" => ""

),
array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "text",
	"std" => "",
),

array( "name" => "Footer text",
	"desc" => "Enter footer text ex. copyright description",
	"id" => $shortname."_footer_text",
	"type" => "textarea",
	"std" => ""
),

array( "name" => "Your email address",
	"desc" => "Enter which email address will be sent from contact form",
	"id" => $shortname."_contact_email",
	"type" => "text",
	"std" => ""
),

array( "name" => "Custom CSS",
	"desc" => "You can add your custom CSS here",
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" => ""

),
	
array( "type" => "close"),
//End first tab "General"


//Begin first tab "Font"
array( 
		"name" => "Font",
		"type" => "section"
)
,

array( "type" => "open"),

array( "name" => "Header Font",
	"desc" => "Select font for header text",
	"id" => $shortname."_font",
	"type" => "select",
	"options" => $pp_font_arr,
	"std" => "Colaborate"
),
array( "name" => "H1 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h1_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "34",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H2 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h2_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "28",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H3 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h3_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "24",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H4 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h4_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "20",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H5 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h5_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "18",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H6 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h6_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "16",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
	
array( "type" => "close"),
//End first tab "Font"


//Begin first tab "Colors"
array( 
		"name" => "Colors",
		"type" => "section"
)
,

array( "type" => "open"),

array( "name" => "Header and Footer Color",
	"desc" => "Select background style your header and footer",
	"id" => $shortname."_skin_bg_style",
	"type" => "radio",
	"options" => array(
		'blue-040E1F' => '<div style="float:left;width:50px;height:30px;background:#0e254b"></div>',
		'teal-051A1D' => '<div style="float:left;width:50px;height:30px;background:#0e3f47"></div>',
		'purple-0d051b' => '<div style="float:left;width:50px;height:30px;background:#260f4e"></div>',
		'silver-121212' => '<div style="float:left;width:50px;height:30px;background:#2e2e2e"></div>',
		'grey-111517' => '<div style="float:left;width:50px;height:30px;background:#2d373e"></div>',
		'green-051b05' => '<div style="float:left;width:50px;height:30px;background:#0e4d10"></div>',
		'pink-1b0518' => '<div style="float:left;width:50px;height:30px;background:#4d0e44"></div>',
		'egreen-181b05' => '<div style="float:left;width:50px;height:30px;background:#3a430d"></div>',
		'coffee-151004' => '<div style="float:left;width:50px;height:30px;background:#392c0b"></div>',
		'red-180808' => '<div style="float:left;width:50px;height:30px;background:#441717"></div>',
		'gold-1b1806' => '<div style="float:left;width:50px;height:30px;background:#4b4410"></div>',
		'black-070707' => '<div style="float:left;width:50px;height:30px;background:#141414"></div>',
		'strong_red-200900' => '<div style="float:left;width:50px;height:30px;background:#772706"></div>',
		'light_blue-05131b' => '<div style="float:left;width:50px;height:30px;background:#2a5a75"></div>',
		'bronze-1b0e05' => '<div style="float:left;width:50px;height:30px;background:#64381d"></div>',
	),
),

array( "name" => "Font Color",
	"desc" => "Select color for the font (default #6E6E6E)",
	"id" => $shortname."_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#6E6E6E"

),

array( "name" => "Link Color",
	"desc" => "Select color for the link (default #639137)",
	"id" => $shortname."_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#639137"

),

array( "name" => "Hover Link Color",
	"desc" => "Select color for the hover link (default #85c744)",
	"id" => $shortname."_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#85c744"

),

array( "name" => "H1, H2, H3, H4, H5, H6 Color",
	"desc" => "Select color for the H1, H2, H3, H4, H5, H6 (default #639137)",
	"id" => $shortname."_h1_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#639137"

),

array( "name" => "Button Background Color",
	"desc" => "Select color for the button background (default #4f762a)",
	"id" => $shortname."_button_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#4f762a"

),

array( "name" => "Button Font Color",
	"desc" => "Select color for the button font (default #ffffff)",
	"id" => $shortname."_button_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"

),

array( "name" => "Button Border Color",
	"desc" => "Select color for the button border (default #4f762a)",
	"id" => $shortname."_button_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#4f762a"

),

array( "name" => "Footer Font Color",
	"desc" => "Select color for the footer font (default #6e6e6e)",
	"id" => $shortname."_footer_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#6e6e6e"

),

array( "name" => "Footer Link Color",
	"desc" => "Select color for the footer link (default #ffffff)",
	"id" => $shortname."_footer_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"

),

array( "name" => "Footer Hover Link Color",
	"desc" => "Select color for the footer hover link (default #999999)",
	"id" => $shortname."_footer_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#999999"

),

array( "type" => "close"),
//End first tab "Colors"


//Begin second tab "Slider"
array( "name" => "Slider",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Select Slider style",
	"desc" => "Select slider's style on your homepage",
	"id" => $shortname."_homepage_slider_style",
	"type" => "select",
	"options" => array(
		'nivo_curtain' => 'Curtain Effect',
		'nivo_fade' => 'Fade Effect',
		'nivo_fold' => 'Fold Effect',
		'coin_swirl' => 'Swirl Effect',
		'coin_rain' => 'Rain Effect',
		'coin_straight' => 'Straight Effect',
		'anything_slider' => 'Slide Style',
		'accordion' => 'Accordion Style',
	),
	"std" => 'nivo_curtain'
),

array( "name" => "Enable slider navigation button",
	"desc" => "Select if you want to show or hide slider prev/next button",
	"id" => $shortname."_homepage_slider_nav",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Slider sort by",
	"desc" => "Select sorting type for contents in slider",
	"id" => $shortname."_slider_sort",
	"type" => "select",
	"options" => array(
		'DESC' => 'Newest First',
		'ASC' => 'Oldest First',
	),
	"std" => "ASC"
),

array( "name" => "Slider items",
	"desc" => "How many items you want display in slider?",
	"id" => $shortname."_slider_items",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 10,
	"step" => 1,
),

array( "name" => "Slider timer (in second)",
	"desc" => "Enter number of seconds for slider timer",
	"id" => $shortname."_slider_timer",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 10,
	"step" => 1,
),

array( "type" => "close"),
//End second tab "Slider"


//Begin second tab "Homepage"
array( "name" => "Homepage",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Show Slider on Homepage",
	"desc" => "Select if you want to show or hide content slider on homepage",
	"id" => $shortname."_homepage_hide_slider",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Show Tagline on Homepage",
	"desc" => "Select if you want to show or hide tagline on homepage",
	"id" => $shortname."_homepage_hide_tagline",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Tagline title text",
	"desc" => "Enter text to display in homepage tagline header",
	"id" => $shortname."_homepage_tagline_title",
	"type" => "text",
	"std" => "Built with the latest Wordpress features",
),

array( "name" => "Tagline description text",
	"desc" => "Enter text to display in homepage tagline description",
	"id" => $shortname."_homepage_tagline_desc",
	"type" => "text",
	"std" => "with extensive admin panel, customize every parts of the theme so what are you waiting for?",
),

array( "name" => "Tagline button text",
	"desc" => "Enter text to display in button",
	"id" => $shortname."_tagline_button_title",
	"type" => "text",
	"std" => "Buy Now",
),

array( "name" => "Tagline button link URL",
	"desc" => "Enter URL for tagline button",
	"id" => $shortname."_tagline_button_href",
	"type" => "text",
	"std" => "",
),

array( "name" => "Show Home boxes on Homepage",
	"desc" => "Select if you want to show or hide Home boxes on homepage",
	"id" => $shortname."_homepage_hide_boxes",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Show Recent Portfolio on Homepage",
	"desc" => "Select if you want to show or hide Recent Portfolio on homepage",
	"id" => $shortname."_homepage_hide_portfolio",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Recent Portfolio items",
	"desc" => "How many items you want display in recent portfolio?",
	"id" => $shortname."_home_portfolio_items",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 10,
	"step" => 1,
),

array( "name" => "Home Left Content",
	"desc" => "You can text or HTML in here",
	"id" => $shortname."_home_left_content",
	"type" => "textarea",
	"std" => ""

),

array( "name" => "Home Right Content",
	"desc" => "You can text or HTML in here",
	"id" => $shortname."_home_right_content",
	"type" => "textarea",
	"std" => ""

),

array( "type" => "close"),
//End second tab "Homepage"


//Begin second tab "Portfolio"
array( "name" => "Portfolio",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Portfolio styles",
	"desc" => "Select the columns style for the portfolio",
	"id" => $shortname."_portfolio_style",
	"type" => "select",
	"options" => array(
		1 => '1 Column',
		2 => '2 Columns',
		3 => '3 Columns',
		4 => '4 Columns',
		'card' => 'Cards Style',
	),
	"std" => 1
),
array( "name" => "Portfolio sort by",
	"desc" => "Select sorting type for contents in portfolio",
	"id" => $shortname."_portfolio_sort",
	"type" => "select",
	"options" => array(
		'DESC' => 'Newest First',
		'ASC' => 'Oldest First',
	),
	"std" => "ASC"
),
array( "name" => "Portfolio items per page",
	"desc" => "Enter how many items get displayed in portfolio page (default is 12 items)",
	"id" => $shortname."_portfolio_items",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 1,
	"to" => 20,
	"step" => 1,
),
array( "name" => "Show view button",
	"desc" => "Select if you want to show or hide view button on portfolio",
	"id" => $shortname."_portfolio_hide_view",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "View button text",
	"desc" => "Enter text to display in view button",
	"id" => $shortname."_portfolio_view_title",
	"type" => "text",
	"std" => "View",
),

array( "type" => "close"),
//End second tab "Portfolio"


//Begin second tab "Gallery"
array( "name" => "Gallery",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Gallery sort by",
	"desc" => "Select sorting type for contents in gallery",
	"id" => $shortname."_gallery_sort",
	"type" => "select",
	"options" => array(
		'DESC' => 'Newest First',
		'ASC' => 'Oldest First',
	),
	"std" => "ASC"
),
array( "name" => "Gallery items per page",
	"desc" => "Enter how many photos get displayed in gallery page (default is 12 items)",
	"id" => $shortname."_gallery_items",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 1,
	"to" => 20,
	"step" => 1,
),

array( "type" => "close"),
//End second tab "Gallery"


//Begin second tab "Sidebar"
array( "name" => "Sidebar",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Add a new sidebar",
	"desc" => "Enter sidebar name",
	"id" => $shortname."_sidebar0",
	"type" => "text",
	"std" => "",
),
array( "type" => "close"),
//End second tab "Sidebar"


//Begin second tab "Blog"
array( "name" => "Blog",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Custom Blog Page Title",
	"desc" => "Enter title text to display in Blog template",
	"id" => $shortname."_blog_title",
	"type" => "text",
	"std" => "Blog",
),
array( "name" => "Read more button text",
	"desc" => "Enter text to display in Read more button",
	"id" => $shortname."_blog_read_more_title",
	"type" => "text",
	"std" => "Read More",
),
array( "name" => "Show About author module",
	"desc" => "Select display about the author in single blog page ",
	"id" => $shortname."_blog_display_author",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Show Related posts module",
	"desc" => "Select display related posts in single blog page ",
	"id" => $shortname."_blog_display_related",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "type" => "close"),
//End second tab "Blog"

 
array( "type" => "close")
 
);
?>