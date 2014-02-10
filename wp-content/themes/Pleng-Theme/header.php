<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */

$pp_theme_version = '1.6';
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title('&lsaquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
	/**
	*	Get favicon URL
	**/
	$pp_favicon = get_option('pp_favicon');
	
	
	if(!empty($pp_favicon))
	{
?>
		<link rel="shortcut icon" href="<?php echo $pp_favicon; ?>" />
<?php
	}
?>

<!-- Template stylesheet -->
<?php

	wp_enqueue_style("jqueryui_css", get_bloginfo( 'stylesheet_directory' )."/css/jqueryui/custom.css", false, $pp_theme_version, "all");
	wp_enqueue_style("screen_css", get_bloginfo( 'stylesheet_directory' )."/css/screen.css", false, $pp_theme_version, "all");
	wp_enqueue_style("tipsy_css", get_bloginfo( 'stylesheet_directory' )."/css/tipsy.css", false, $pp_theme_version, "all");
	wp_enqueue_style("fancybox_css", get_bloginfo( 'stylesheet_directory' )."/js/fancybox/jquery.fancybox-1.3.0.css", false, $pp_theme_version, "all");
	wp_enqueue_style("videojs_css", get_bloginfo( 'stylesheet_directory' )."/js/video-js.css", false, $pp_theme_version, "all");
	wp_enqueue_style("vim_css", get_bloginfo( 'stylesheet_directory' )."/js/skins/vim.css", false, $pp_theme_version, "all");

?>

<?php

	/**
	*	Check Google Maps key
	**/
	$pp_gm_key = get_option('pp_gm_key');

	if(!empty($pp_gm_key))
	{
	
?>
<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=<?php echo $pp_gm_key; ?>&amp;hl=en"></script>
<?php
	}
?> 

<?php
	wp_enqueue_script("jQuery", get_bloginfo( 'stylesheet_directory' )."/js/jquery.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_UI_js", get_bloginfo( 'stylesheet_directory' )."/js/jquery-ui.js", false, $pp_theme_version);
	wp_enqueue_script("fancybox_js", get_bloginfo( 'stylesheet_directory' )."/js/fancybox/jquery.fancybox-1.3.0.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_easing", get_bloginfo( 'stylesheet_directory' )."/js/jquery.easing.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_nivo", get_bloginfo( 'stylesheet_directory' )."/js/jquery.nivo.slider.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_anything_slider", get_bloginfo( 'stylesheet_directory' )."/js/anythingSlider.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_kwicks", get_bloginfo( 'stylesheet_directory' )."/js/jquery.kwicks.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_coin_slider", get_bloginfo( 'stylesheet_directory' )."/js/coin-slider.js", false, $pp_theme_version);

	/**
	*	Check Google Maps key
	**/
	$pp_gm_key = get_option('pp_gm_key');

	if(!empty($pp_gm_key))
	{
		wp_enqueue_script("jQuery_gmap", get_bloginfo( 'stylesheet_directory' )."/js/gmap.js", false, $pp_theme_version);
	}
	
	wp_enqueue_script("jQuery_validate", get_bloginfo( 'stylesheet_directory' )."/js/jquery.validate.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_cufon", get_bloginfo( 'stylesheet_directory' )."/js/cufon.js", false, $pp_theme_version);
	
	/**
	*	Check selected font
	**/
	$pp_font = get_option('pp_font');
	if(empty($pp_font))
	{
		$pp_font = 'Vegur_400.font';
	}
	
	wp_enqueue_script("cufon_font", get_bloginfo( 'stylesheet_directory' )."/fonts/".$pp_font.".js", false, $pp_theme_version);
	wp_enqueue_script("browser_js", get_bloginfo( 'stylesheet_directory' )."/js/browser.js", false, $pp_theme_version);
	wp_enqueue_script("video_js", get_bloginfo( 'stylesheet_directory' )."/js/video.js", false, $pp_theme_version);
	wp_enqueue_script("custom_js", get_bloginfo( 'stylesheet_directory' )."/js/custom.js", false, $pp_theme_version);
?> 

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

<!--[if lt IE 8]>
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/ie7.css" type="text/css" media="all"/>
<![endif]-->

<style>
<?php
	$pp_h1_font_color = get_option('pp_h1_font_color');
	
	if(!empty($pp_h1_font_color))
	{
?>
h1,h2,h3,h4,h5,h6 { color:<?php echo $pp_h1_font_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_header_textcolor = get_option('pp_header_textcolor');
	
	if(!empty($pp_header_textcolor))
	{
?>
.header_title h2 { color:<?php echo $pp_header_textcolor; ?>; }
<?php
	}
	
?>

<?php
	$pp_h1_size = get_option('pp_h1_size');
	
	if(!empty($pp_h1_size))
	{
?>
h1 { font-size:<?php echo $pp_h1_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h2_size = get_option('pp_h2_size');
	
	if(!empty($pp_h2_size))
	{
?>
h2 { font-size:<?php echo $pp_h2_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h3_size = get_option('pp_h3_size');
	
	if(!empty($pp_h3_size))
	{
?>
h3 { font-size:<?php echo $pp_h3_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h4_size = get_option('pp_h4_size');
	
	if(!empty($pp_h4_size))
	{
?>
h4 { font-size:<?php echo $pp_h4_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h5_size = get_option('pp_h5_size');
	
	if(!empty($pp_h5_size))
	{
?>
h5 { font-size:<?php echo $pp_h5_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h6_size = get_option('pp_h6_size');
	
	if(!empty($pp_h6_size))
	{
?>
h6 { font-size:<?php echo $pp_h6_size; ?>px; }
<?php
	}
	
?>


<?php
	$pp_font_color = get_option('pp_font_color');
	
	if(!empty($pp_font_color))
	{
?>
body, .styled_box_content, blockquote h2 { color:<?php echo $pp_font_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_link_color = get_option('pp_link_color');
	
	if(!empty($pp_link_color))
	{
?>
a { color:<?php echo $pp_link_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_hover_link_color = get_option('pp_hover_link_color');
	
	if(!empty($pp_hover_link_color))
	{
?>
a:hover, a:active { color:<?php echo $pp_hover_link_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_skin_bg_style = explode('-', get_option('pp_skin_bg_style'));
	
	
	if(!empty($pp_skin_bg_style))
	{
?>
body.home #header_wrapper
{
	background: #<?php echo $pp_skin_bg_style[1]; ?> url('<?php echo bloginfo( 'stylesheet_directory' ); ?>/images/skins/<?php echo $pp_skin_bg_style[0]; ?>_header_bg.png') no-repeat center center;
}
#header_wrapper
{
	background: #<?php echo $pp_skin_bg_style[1]; ?> url('<?php echo bloginfo( 'stylesheet_directory' ); ?>/images/skins/<?php echo $pp_skin_bg_style[0]; ?>_menu_bg.png') no-repeat center top;
}
#footer 
{
	background: #<?php echo $pp_skin_bg_style[1]; ?>;
}
<?php
	}
	
?>

<?php
	$pp_button_bg_color = get_option('pp_button_bg_color');
	
	if(!empty($pp_button_bg_color))
	{
		$pp_button_bg_color_light = '#'.hex_lighter(substr($pp_button_bg_color, 1), 20);
?>
input[type=submit], input[type=button], a.button { 
	background: <?php echo $pp_button_bg_color; ?>;
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $pp_button_bg_color_light; ?>), to(<?php echo $pp_button_bg_color; ?>));
	background: -moz-linear-gradient(top,  <?php echo $pp_button_bg_color_light; ?>,  <?php echo $pp_button_bg_color; ?>);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $pp_button_bg_color_light; ?>', endColorstr='<?php echo $pp_button_bg_color; ?>');
}
input[type=submit]:active, input[type=button]:active, a.button:active
{
	background: <?php echo $pp_button_bg_color; ?>;
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $pp_button_bg_color; ?>), to(<?php echo $pp_button_bg_color_light; ?>));
	background: -moz-linear-gradient(top,  <?php echo $pp_button_bg_color; ?>,  <?php echo $pp_button_bg_color_light; ?>);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $pp_button_bg_color_light; ?>', endColorstr='<?php echo $pp_button_bg_color; ?>');
}
<?php
	}
	
?>

<?php
	$pp_button_font_color = get_option('pp_button_font_color');
	
	if(!empty($pp_button_font_color))
	{
?>
input[type=submit], input[type=button], a.button { 
	color: <?php echo $pp_button_font_color; ?>;
}
input[type=submit]:hover, input[type=button]:hover, a.button:hover
{
	color: <?php echo $pp_button_font_color; ?>;
}
<?php
	}
	
?>

<?php
	$pp_button_border_color = get_option('pp_button_border_color');
	
	if(!empty($pp_button_border_color))
	{
?>
input[type=submit], input[type=button], a.button { 
	border: 1px solid <?php echo $pp_button_border_color; ?>;
}
<?php
	}
	
?>

<?php
	$pp_menu_bg_color = get_option('pp_menu_bg_color');
	
	if(!empty($pp_menu_bg_color) && $pp_menu_bg_color != 'gray')
	{
?>
.left_menu_wrapper
{
	background: transparent url('<?php echo bloginfo( 'stylesheet_directory' ); ?>/images/left_menu_wrapper_<?php echo $pp_menu_bg_color; ?>.png') top no-repeat;
}
.right_menu_wrapper
{
	background: transparent url('<?php echo bloginfo( 'stylesheet_directory' ); ?>/images/right_menu_wrapper_<?php echo $pp_menu_bg_color; ?>.png') top no-repeat;
	float: right;
}
#menu_wrapper .nav ul, #menu_wrapper .menu-main-menu-container .nav
{
	background: transparent url('<?php echo bloginfo( 'stylesheet_directory' ); ?>/images/menu_wrapper_<?php echo $pp_menu_bg_color; ?>.png') top repeat-x;
}
#menu_wrapper .nav ul li a, #menu_wrapper .menu-main-menu-container .nav li a
{
	color: #fff;
	text-shadow: 0 -1px 1px #333;
}
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper .menu-main-menu-container .nav li a.hover, #menu_wrapper .menu-main-menu-container .nav li a:hover
{
	border: 1px solid transparent;
	background: transparent url('<?php echo bloginfo( 'stylesheet_directory' ); ?>/images/menu_active_<?php echo $pp_menu_bg_color; ?>.png') top repeat-x;
}

#menu_wrapper .menu-main-menu-container .nav li.current-menu-item a
{
	border: 1px solid transparent;
	background: transparent url('<?php echo bloginfo( 'stylesheet_directory' ); ?>/images/menu_active_<?php echo $pp_menu_bg_color; ?>.png') top repeat-x;
}
#menu_wrapper .menu-main-menu-container .nav li ul li a.hover, #menu_wrapper .nav ul li ul li a.hover
{
	background: transparent url('<?php echo bloginfo( 'stylesheet_directory' ); ?>/images/menu_hover_<?php echo $pp_menu_bg_color; ?>.png') top repeat-x;
}
<?php
		switch($pp_menu_bg_color)
		{
			case 'black':
				$menu_child_bg = '#333333';
				$menu_child_border = '#333333';
				$menu_child_color = '#cccccc';
			break;
			case 'blue':
				$menu_child_bg = '#244487';
				$menu_child_border = '#244487';
				$menu_child_color = '#ffffff';
			break;
			case 'red':
				$menu_child_bg = '#72001a';
				$menu_child_border = '#72001a';
				$menu_child_color = '#ffffff';
			break;
			case 'slate_gray':
				$menu_child_bg = '#424f6d';
				$menu_child_border = '#424f6d';
				$menu_child_color = '#ffffff';
			break;
			case 'yellow':
				$menu_child_bg = '#eba22e';
				$menu_child_border = '#eba22e';
				$menu_child_color = '#ffffff';
			break;
			case 'green':
				$menu_child_bg = '#55a202';
				$menu_child_border = '#55a202';
				$menu_child_color = '#ffffff';
			break;
			case 'pink':
				$menu_child_bg = '#ba4a61';
				$menu_child_border = '#ba4a61';
				$menu_child_color = '#ffffff';
			break;
		}
?>
#menu_wrapper .nav ul li ul, #menu_wrapper .menu-main-menu-container .nav li ul
{
	background: <?php echo $menu_child_bg; ?>;
	border: 1px solid <?php echo $menu_child_border; ?>;
}
#menu_wrapper .menu-main-menu-container .nav li ul li a, #menu_wrapper .menu-main-menu-container .nav li.current-menu-item ul li a, #menu_wrapper .menu-main-menu-container .nav li ul li.current-menu-item a,#menu_wrapper .nav ul li ul li a, #menu_wrapper .nav ul li.current-menu-item ul li a, #menu_wrapper .nav ul li ul li.current-menu-item a
{
	color: <?php echo $menu_child_color; ?>;
}
<?php
	}
	
?>

<?php
	$pp_footer_font_color = get_option('pp_footer_font_color');
	
	if(!empty($pp_footer_font_color))
	{
?>
#footer, #footer ul { color:<?php echo $pp_footer_font_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_footer_link_color = get_option('pp_footer_link_color');
	
	if(!empty($pp_footer_link_color))
	{
?>
#footer a { color:<?php echo $pp_footer_link_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_footer_hover_link_color = get_option('pp_footer_hover_link_color');
	
	if(!empty($pp_footer_hover_link_color))
	{
?>
#footer a:hover, #footer a:active { color:<?php echo $pp_footer_hover_link_color; ?>; }
<?php
	}
	
?>
</style>

<?php
if(is_front_page())
{
?>
<script>
$j(document).ready(function(){ 
	$j('#menu_wrapper .menu-main-menu-container .nav li a[title=Home]').parent('li').addClass('current-menu-item');
});
</script>
<?php
}
?>

<?php
	/**
	*	Get custom CSS
	**/
	$pp_custom_css = get_option('pp_custom_css');
	
	
	if(!empty($pp_custom_css))
	{
		echo '<style>';
		echo $pp_custom_css;
		echo '</style>';
	}
?>

</head>

<?php

/**
*	Get Current page object
**/
$page = get_page($post->ID);


/**
*	Get current page id
**/
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

?>

<body <?php body_class(); ?>>
	
	<!-- Begin template wrapper -->
	<div id="wrapper">
			
		<!-- Begin header -->
		<div id="header_wrapper">
			<div id="top_bar">
					<div class="logo">
						<!-- Begin logo -->
					
						<?php
							//get custom logo
							$pp_logo = get_option('pp_logo');
							
							if(empty($pp_logo))
							{
								$pp_logo = get_bloginfo( 'stylesheet_directory' ).'/images/logo.png';
								
							}

						?>
						
						<a id="custom_logo" href="<?php bloginfo( 'url' ); ?>"><img src="<?php echo $pp_logo?>" alt=""/></a>
						
						<!-- End logo -->
					</div>
					<!-- Begin main nav -->
					<div id="menu_wrapper">
						<div class="left_menu_wrapper"></div>
					
					    <?php 	
					    			//Get page nav
					    			wp_nav_menu( 
					    					array( 
					    						'menu_id'			=> 'main_menu',
					    						'menu_class'		=> 'nav',
					    						'theme_location' 	=> 'primary-menu',
					    					) 
					    			); 
					    ?>
					
						<div class="right_menu_wrapper"></div>
					</div>
					<!-- End main nav -->
				</div>