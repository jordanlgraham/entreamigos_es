<?php

function post_type_slides() {
	$labels = array(
    	'name' => _x('Slides', 'post type general name'),
    	'singular_name' => _x('Slide', 'post type singular name'),
    	'add_new' => _x('Add New Slide', 'book'),
    	'add_new_item' => __('Add New Slide'),
    	'edit_item' => __('Edit Slide'),
    	'new_item' => __('New Slide'),
    	'view_item' => __('View Slide'),
    	'search_items' => __('Search Slides'),
    	'not_found' =>  __('No slide found'),
    	'not_found_in_trash' => __('No slides found in Trash'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail'),
    	'menu_icon' => get_bloginfo( 'stylesheet_directory' ).'/functions/images/screen.png'
	); 		

	register_post_type( 'slides', $args );
}
add_action('init', 'post_type_slides');

function post_type_home_boxes() {
	$labels = array(
    	'name' => _x('Home Boxes', 'post type general name'),
    	'singular_name' => _x('Home Box', 'post type singular name'),
    	'add_new' => _x('Add New Home Box', 'book'),
    	'add_new_item' => __('Add New Home Box'),
    	'edit_item' => __('Edit Home Box'),
    	'new_item' => __('New Home Box'),
    	'view_item' => __('View Home Box'),
    	'search_items' => __('Search Home Boxes'),
    	'not_found' =>  __('No home box found'),
    	'not_found_in_trash' => __('No home box found in Trash'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail'),
    	'menu_icon' => get_bloginfo( 'stylesheet_directory' ).'/functions/images/sign.png'
	); 		

	register_post_type( 'home_boxes', $args );
}
add_action('init', 'post_type_home_boxes');

function post_type_portfolios() {
	$labels = array(
    	'name' => _x('Portfolios', 'post type general name'),
    	'singular_name' => _x('Portfolio', 'post type singular name'),
    	'add_new' => _x('Add New Portfolio', 'book'),
    	'add_new_item' => __('Add New Portfolio'),
    	'edit_item' => __('Edit Portfolio'),
    	'new_item' => __('New Portfolio'),
    	'view_item' => __('View Portfolio'),
    	'search_items' => __('Search Portfolios'),
    	'not_found' =>  __('No Portfolio found'),
    	'not_found_in_trash' => __('No Portfolios found in Trash'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail'),
    	'menu_icon' => get_bloginfo( 'stylesheet_directory' ).'/functions/images/sign.png'
	); 		

	register_post_type( 'portfolios', $args );
	
  	$labels = array(			  
  	  'name' => _x( 'Sets', 'taxonomy general name' ),
  	  'singular_name' => _x( 'Set', 'taxonomy singular name' ),
  	  'search_items' =>  __( 'Search Sets' ),
  	  'all_items' => __( 'All Sets' ),
  	  'parent_item' => __( 'Parent Set' ),
  	  'parent_item_colon' => __( 'Parent Set:' ),
  	  'edit_item' => __( 'Edit Set' ), 
  	  'update_item' => __( 'Update Set' ),
  	  'add_new_item' => __( 'Add New Set' ),
  	  'new_item_name' => __( 'New Set Name' ),
  	); 							  
  	
  	register_taxonomy(
		'portfoliosets',
		'portfolios',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'portfoliosets',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'portfoliosets', 'with_front' => false ),
		)
	);					  
} 
								  
add_action('init', 'post_type_portfolios');

function post_type_photos() {
	$labels = array(
    	'name' => _x('Photos', 'post type general name'),
    	'singular_name' => _x('Photo', 'post type singular name'),
    	'add_new' => _x('Add New Photo', 'book'),
    	'add_new_item' => __('Add New Photo'),
    	'edit_item' => __('Edit Photo'),
    	'new_item' => __('New Photo'),
    	'view_item' => __('View Photo'),
    	'search_items' => __('Search Photos'),
    	'not_found' =>  __('No Photo found'),
    	'not_found_in_trash' => __('No Photos found in Trash'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail'),
    	'menu_icon' => get_bloginfo( 'stylesheet_directory' ).'/functions/images/sign.png'
	); 		

	register_post_type( 'photos', $args );
	
  	$labels = array(			  
  	  'name' => _x( 'Galleries', 'taxonomy general name' ),
  	  'singular_name' => _x( 'Gallery', 'taxonomy singular name' ),
  	  'search_items' =>  __( 'Search Galleries' ),
  	  'all_items' => __( 'All Galleries' ),
  	  'parent_item' => __( 'Parent Gallery' ),
  	  'parent_item_colon' => __( 'Parent Gallery:' ),
  	  'edit_item' => __( 'Edit Gallery' ), 
  	  'update_item' => __( 'Update Gallery' ),
  	  'add_new_item' => __( 'Add New Gallery' ),
  	  'new_item_name' => __( 'New Gallery Name' ),
  	); 							  
  	
  	register_taxonomy(
		'photos_galleries',
		'photos',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'photos_galleries',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'photos_galleries', 'with_front' => false ),
		)
	);					  
} 
								  
add_action('init', 'post_type_photos');

function post_type_videos() {
	$labels = array(
    	'name' => _x('Videos', 'post type general name'),
    	'singular_name' => _x('Video', 'post type singular name'),
    	'add_new' => _x('Add New Video', 'book'),
    	'add_new_item' => __('Add New Video'),
    	'edit_item' => __('Edit Video'),
    	'new_item' => __('New Video'),
    	'view_item' => __('View Video'),
    	'search_items' => __('Search Videos'),
    	'not_found' =>  __('No Video found'),
    	'not_found_in_trash' => __('No Videos found in Trash'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail'),
    	'menu_icon' => get_bloginfo( 'stylesheet_directory' ).'/functions/images/sign.png'
	); 		

	register_post_type( 'videos', $args );
	
  	$labels = array(			  
  	  'name' => _x( 'Videos Galleries', 'taxonomy general name' ),
  	  'singular_name' => _x( 'Videos Gallery', 'taxonomy singular name' ),
  	  'search_items' =>  __( 'Search Videos Galleries' ),
  	  'all_items' => __( 'All Videos Galleries' ),
  	  'parent_item' => __( 'Parent Videos Gallery' ),
  	  'parent_item_colon' => __( 'Parent Videos Gallery:' ),
  	  'edit_item' => __( 'Edit Videos Gallery' ), 
  	  'update_item' => __( 'Update Videos Gallery' ),
  	  'add_new_item' => __( 'Add New Videos Gallery' ),
  	  'new_item_name' => __( 'New Videos Gallery Name' ),
  	); 							  
  	
  	register_taxonomy(
		'videos_galleries',
		'videos',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'videos_galleries',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'videos_galleries', 'with_front' => false ),
		)
	);					  
} 
								  
add_action('init', 'post_type_videos');

add_filter( 'manage_posts_columns', 'rt_add_gravatar_col');
function rt_add_gravatar_col($cols) {
	$cols['thumbnail'] = __('Thumbnail');
	return $cols;
}

add_action( 'manage_posts_custom_column', 'rt_get_author_gravatar');
function rt_get_author_gravatar($column_name ) {
	if ( $column_name  == 'thumbnail'  ) {
		echo get_the_post_thumbnail(get_the_ID(), array(100, 100));
	}
}

/*
	Begin creating custom fields
*/

$postmetas = 
	array (
		'slides' => array(
			
			/*
			    Begin Slide Source custom fields
			*/
			array("section" => "Slide Source", "id" => "gallery_link_url", "title" => "Hyperlink URL:"),
			
			array("section" => "Caption Align", "id" => "caption_align", "type" => "select", "title" => "Select Caption style", "items" => array("No Caption", "Align Left", "Align Right", "Bottom")),

			/*
			    End Slide Source custom fields
			*/
		),
		
		'videos' => array(
			
			/*
			    Begin Slide Source custom fields
			*/
			array("section" => "Video Info", "id" => "video_type", "type" => "select", "title" => "Select Video type", "items" => array("Youtube", "Vimeo", "HTML5", "Dailymotion")),
			
			array("section" => "Video Info", "id" => "youtube_id", "title" => "Youtube Video ID (ex. EhkHFenJ3rM):"),
			array("section" => "Video Info", "id" => "vimeo_id", "title" => "Vimeo Video ID (ex. 11334082):"),
			array("section" => "Video Info", "id" => "dailymotion_id", "title" => "Dailymotion Video ID (ex. x9esif):"),
			
			array("section" => "Video Info", "id" => "mp4_url", "title" => "HTML5 Video URL (MP4 format):"),
			array("section" => "Video Info", "id" => "webm_url", "title" => "HTML5 Video URL (WebM format):"),
			array("section" => "Video Info", "id" => "ogg_url", "title" => "HTML5 Video URL (Ogg format):"),

			/*
			    End Slide Source custom fields
			*/
		),
);

/*print '<pre>';
print_r($post_obj);
print '</pre>';*/

function create_meta_box() {

	global $postmetas;
	
	if(!isset($_GET['post_type']) OR empty($_GET['post_type']))
	{
		if(isset($_GET['post']) && !empty($_GET['post']))
		{
			$post_obj = get_post($_GET['post']);
			$_GET['post_type'] = $post_obj->post_type;
		}
		else
		{
			$_GET['post_type'] = 'post';
		}
	}
	
	if ( function_exists('add_meta_box') && isset($postmetas) && count($postmetas) > 0 ) {  
		foreach($postmetas as $key => $postmeta)
		{
			if($_GET['post_type']==$key)
			{
				add_meta_box( 'metabox', ucfirst($key).' Options', 'new_meta_box', $key, 'normal', 'high' );  
			}
		}
	}

}  

function new_meta_box() {
	global $post, $postmetas;
	
	if(!isset($_GET['post_type']) OR empty($_GET['post_type']))
	{
		if(isset($_GET['post']) && !empty($_GET['post']))
		{
			$post_obj = get_post($_GET['post']);
			$_GET['post_type'] = $post_obj->post_type;
		}
		else
		{
			$_GET['post_type'] = 'post';
		}
	}

	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$meta_section = '';

	foreach ( $postmetas as $key => $postmeta ) {
	
		if($_GET['post_type'] == $key)
		{
		
			foreach ( $postmeta as $each_meta ) {
		
				$meta_id = $each_meta['id'];
				$meta_title = $each_meta['title'];
				
				$meta_type = '';
				if(isset($each_meta['type']))
				{
					$meta_type = $each_meta['type'];
				}
				
				if(empty($meta_section) OR $meta_section != $each_meta['section'])
				{
					$meta_section = $each_meta['section'];
					
					echo "<br/><h3>".$meta_section."</h3><br/>";
				}
				$meta_section = $each_meta['section'];
				
				echo "<p><label for='$meta_id'>$meta_title </label>";
				
				if ($meta_type == 'checkbox') {
					$checked = get_post_meta($post->ID, $meta_id, true) == '1' ? "checked" : "";
					echo "<input type='checkbox' name='$meta_id' id='$meta_id' value='1' $checked /></p>";
				}
				else if ($meta_type == 'select') {
					echo "<p><select name='$meta_id' id='$meta_id'>";
					
					if(!empty($each_meta['items']))
					{
						foreach ($each_meta['items'] as $item)
						{
							echo '<option value="'.$item.'"';
							
							if($item == get_post_meta($post->ID, $meta_id, true))
							{
								echo ' selected ';
							}
							
							echo '>'.$item.'</option>';
						}
					}
					
					echo "</select></p>";
				}
				else if ($meta_type == 'textarea') {
					echo "<p><textarea name='$meta_id' id='$meta_id' class='code' style='width:100%' rows='7'>".get_post_meta($post->ID, $meta_id, true)."</textarea></p>";
				}			
				else {
					echo "<input type='text' name='$meta_id' id='$meta_id' class='code' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:99%' /></p>";
				}
			}
		}
	}
	
	echo '<br/>';

}

function save_postdata( $post_id ) {

	global $postmetas;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	// Check permissions

	if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated

	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}

	foreach ( $postmetas as $postmeta ) {
		foreach ( $postmeta as $each_meta ) {
	
			if ($_POST[$each_meta['id']]) {
				update_custom_meta($post_id, $_POST[$each_meta['id']], $each_meta['id']);
			}
			
			if ($_POST[$each_meta['id']] == "") {
				delete_post_meta($post_id, $each_meta['id']);
			}
		
		}
	}

}

function update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}

//init

add_action('admin_menu', 'create_meta_box'); 
add_action('save_post', 'save_postdata'); 

/*
	End creating custom fields
*/

?>