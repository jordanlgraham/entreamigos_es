<?php

/**
*	Begin Recent Posts Custom Widgets
**/

class Pleng_Recent_Posts extends WP_Widget {
	function Pleng_Recent_Posts() {
		$widget_ops = array('classname' => 'Pleng_Recent_Posts', 'description' => 'The recent posts with thumbnails' );
		$this->WP_Widget('Pleng_Recent_Posts', 'Pleng Recent Posts', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = 3;
		}
		
		if(!empty($items))
		{
			pp_posts('recent', $items, TRUE);
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '') );
		$items = strip_tags($instance['items']);

?>
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 3): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo attribute_escape($items); ?>" /></label></p>
<?php
	}
}

register_widget('Pleng_Recent_Posts');

/**
*	End Recent Posts Custom Widgets
**/

/**
*	Begin Popular Posts Custom Widgets
**/

class Pleng_Popular_Posts extends WP_Widget {
	function Pleng_Popular_Posts() {
		$widget_ops = array('classname' => 'Pleng_Popular_Posts', 'description' => 'The popular posts with thumbnails' );
		$this->WP_Widget('Pleng_Popular_Posts', 'Pleng Popular Posts', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = 3;
		}
		
		if(!empty($items))
		{
			pp_posts('popular', $items, TRUE);
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '') );
		$items = strip_tags($instance['items']);

?>
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 3): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo attribute_escape($items); ?>" /></label></p>
<?php
	}
}

register_widget('Pleng_Popular_Posts');

/**
*	End Popular Posts Custom Widgets
**/

/**
*	Begin Portfolios Custom Widgets
**/

class Pleng_Portfolios extends WP_Widget {
	function Pleng_Portfolios() {
		$widget_ops = array('classname' => 'Pleng_Portfolios', 'description' => 'Portfolio items widget' );
		$this->WP_Widget('Pleng_Portfolios', 'Pleng Portfolios', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = 3;
		}
		
		if(!empty($items))
		{
			$pp_portfolio_sort = get_option('pp_portfolio_sort'); 
			if(empty($pp_portfolio_sort))
			{
				$pp_portfolio_sort = 'ASC';
			}
				
			$portfolio_items = get_posts('numberposts='.$items.'&order='.$pp_portfolio_sort.'&orderby=date&post_type=portfolios');
			
			if(isset($portfolio_items) && !empty($portfolio_items))
			{
				echo '<h2 class="widgettitle">Portfolio</h2>';
			
				foreach($portfolio_items as $key => $portfolio_item)
				{
					$image_url = '';
								
					if(has_post_thumbnail($portfolio_item->ID, 'large'))
					{
					    $image_id = get_post_thumbnail_id($portfolio_item->ID);
					    $image_url = wp_get_attachment_image_src($image_id, 'large', true);
					}
					
					$permalink_url = get_permalink($portfolio_item->ID);
													
					$word_count = 400;
					if(!empty($image_url[0]))
					{
						$word_count = 100;
					}
?>

					<div class="portfolio_grid">

<?php					
					if(!empty($image_url))
					{
?>					
						<div class="portfolio_image">
							<a href="<?php echo $permalink_url; ?>">
								<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/timthumb.php?src=<?php echo $image_url[0]?>&amp;h=120&amp;w=200&amp;zc=1" alt="" class="frame"/>
							</a>
						</div>
<?php				
					}
?>
						<div class="portfolio_desc">
							<h6 class="cufon"><a href="<?php echo $permalink_url; ?>"><?php echo $portfolio_item->post_title?></a></h6>
							<p><?php echo pp_substr(strip_tags(strip_shortcodes($portfolio_item->post_content)), $word_count); ?></p>
						</div>
					</div>
					<br class="clear"/>

<?php
				}
			}
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '' ) );
		$items = strip_tags($instance['items']);
		$bg_color = strip_tags($instance['bg_color']);
		if(empty($bg_color))
		{
			$bg_color = 'black';
		}

?>
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 3): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo attribute_escape($items); ?>" /></label></p>
<?php
	}
}

register_widget('Pleng_Portfolios');

/**
*	End Portfolios Posts Custom Widgets
**/

/**
*	Begin Twitter Feed Custom Widgets
**/

class Pleng_Twitter extends WP_Widget {
	function Pleng_Twitter() {
		$widget_ops = array('classname' => 'Pleng_Twitter', 'description' => 'Display your recent Twitter feed' );
		$this->WP_Widget('Pleng_Twitter', 'Pleng Twitter', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$twitter_username = empty($instance['twitter_username']) ? ' ' : apply_filters('widget_title', $instance['twitter_username']);
		$title = $instance['title'];
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = 5;
		}
		
		if(empty($title))
		{
			$title = 'Recent Tweets';
		}
		
		if(!empty($items) && !empty($twitter_username))
		{
			// Begin get user timeline
			include_once (TEMPLATEPATH . "/lib/twitter.lib.php");
			$obj_twitter = new Twitter($twitter_username); 
			$tweets = $obj_twitter->get($items);

			if(!empty($tweets))
			{
				echo '<h2 class="widgettitle">'.$title.'</h2><br/>';
				echo '<ul class="twitter">';
				
				foreach($tweets as $tweet)
				{
					echo '<li>';
					
					if(isset($tweet[0]))
					{
						echo '<a href="'.$tweet[2][0].'">'.$tweet[0].'</a>';
					}
					
					echo '</li>';
				}
				
				echo '</ul>';
			}
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_username'] = strip_tags($new_instance['twitter_username']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'twitter_username' => '', 'title' => '') );
		$items = strip_tags($instance['items']);
		$twitter_username = strip_tags($instance['twitter_username']);
		$title = strip_tags($instance['title']);

?>
			<p><label for="<?php echo $this->get_field_id('twitter_username'); ?>">Twitter Username: <input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo attribute_escape($twitter_username); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 5): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo attribute_escape($items); ?>" /></label></p>
<?php
	}
}

register_widget('Pleng_Twitter');

/**
*	End Twitter Feed Custom Widgets
**/

/**
*	Begin Contact Form Custom Widgets
**/

class Pleng_Contact_Form extends WP_Widget {
	function Pleng_Contact_Form() {
		$widget_ops = array('classname' => 'Pleng_Contact_Form', 'description' => 'Display contact form' );
		$this->WP_Widget('Pleng_Contact_Form', 'Pleng Contact Form', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		
		if(empty($title))
		{
			$title = 'Contact Us';
		}
		
		$pp_contact_email = get_option('pp_contact_email');
		
		echo '<h2 class="widgettitle">'.$title.'</h2>';
?>

			<form id="contact_form" method="post" action="<?php bloginfo( 'stylesheet_directory' ); ?>/lib/api.lib.php">
				<input type="hidden" id="contact_email" name="contact_email" value="<?php echo get_option('pp_contact_email'); ?>"/>
				<p>
				    <label for="your_name">Name</label><br/>
				    <input id="your_name" name="your_name" type="text" style="width:94%"/>
				</p>
				<p style="margin-top:20px">
				    <label for="email">Email</label><br/>
				    <input id="email" name="email" type="text" style="width:94%"/>
				</p>
				<p style="margin-top:20px">
				    <label for="message">Message</label><br/>
				    <textarea id="message" name="message" rows="7" cols="10" style="width:94%"></textarea>
				</p>
				<p style="margin-top:20px">
				    <input type="submit" value="Send Message"/><br/>
				</p>
			</form>
			<div id="reponse_msg"></div>
		
<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '') );
		$title = strip_tags($instance['title']);

?>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
	}
}

register_widget('Pleng_Contact_Form');

/**
*	End Contact Form Custom Widgets
**/

/**
*	Begin Map Custom Widgets
**/

class Pleng_Map extends WP_Widget {
	function Pleng_Map() {
		$widget_ops = array('classname' => 'Pleng_Map', 'description' => 'Display map' );
		$this->WP_Widget('Pleng_Map', 'Pleng Map', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? 'Map' : $instance['title'];
		$width = empty($instance['width']) ? 240 : $instance['width'];
		$height = empty($instance['height']) ? 240 : $instance['height'];
		$lat = empty($instance['lat']) ? 0 : $instance['lat'];
		$long = empty($instance['long']) ? 0 : $instance['long'];
		
		$custom_id = time().rand();
		
		echo '<h2 class="widgettitle">'.$title.'</h2><br/>';
		
		$marker = '';
		if(!empty($lat) && !empty($long))
		{
			$marker = '{ zoom: 12, markers: [ { latitude: '.$lat.', longitude: '.$long.' } ] }';
		}
?>

			<div id="map<?php echo $custom_id; ?>" style="width:<?php echo $width; ?>px;height:<?php echo $height; ?>px;margin-bottom:15px"></div>
			<script>
				$j(document).ready(function(){ 
					$j("#map<?php echo $custom_id; ?>").gMap(<?php echo $marker; ?>);
				});
			</script>
		
<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['width'] = strip_tags($new_instance['width']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['lat'] = strip_tags($new_instance['lat']);
		$instance['long'] = strip_tags($new_instance['long']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'title' => '', 'width' => '', 'height' => '', 'lat' => '', 'long' => '') );
		$title = strip_tags($instance['title']);
		$width = strip_tags($instance['width']);
		$height = strip_tags($instance['height']);
		$lat = strip_tags($instance['lat']);
		$long = strip_tags($instance['long']);

?>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('width'); ?>">Width: <input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo attribute_escape($width); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('height'); ?>">Height: <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo attribute_escape($height); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('lat'); ?>">Latitude (<a href="http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/">Find here</a>): <input class="widefat" id="<?php echo $this->get_field_id('lat'); ?>" name="<?php echo $this->get_field_name('lat'); ?>" type="text" value="<?php echo attribute_escape($lat); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('long'); ?>">Longitude (<a href="http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/">Find here</a>): <input class="widefat" id="<?php echo $this->get_field_id('long'); ?>" name="<?php echo $this->get_field_name('long'); ?>" type="text" value="<?php echo attribute_escape($long); ?>" /></label></p>
<?php
	}
}

register_widget('Pleng_Map');

/**
*	End Map Custom Widgets
**/

/**
*	Begin Youtube Video Custom Widgets
**/

class Pleng_Youtube extends WP_Widget {
	function Pleng_Youtube() {
		$widget_ops = array('classname' => 'Pleng_Youtube', 'description' => 'Display Youtube Video' );
		$this->WP_Widget('Pleng_Youtube', 'Pleng Youtube Video', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$youtube_id = empty($instance['youtube_id']) ? 0 : $instance['youtube_id'];
		
		if(!empty($title))
		{
			echo '<h2 class="widgettitle">'.$title.'</h2><br/>';
		}
?>

<object type="application/x-shockwave-flash" data="http://www.youtube.com/v/<?php echo $youtube_id; ?>&hd=1" style="width:240px;height:180px"><param name="wmode" value="opaque"><param name="movie" value="http://www.youtube.com/v/<?php echo $youtube_id; ?>&hd=1" /></object>
		
<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['youtube_id'] = strip_tags($new_instance['youtube_id']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'youtube_id' => '') );
		$title = strip_tags($instance['title']);
		$youtube_id = strip_tags($instance['youtube_id']);

?>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('youtube_id'); ?>">Video_id: <input class="widefat" id="<?php echo $this->get_field_id('youtube_id'); ?>" name="<?php echo $this->get_field_name('youtube_id'); ?>" type="text" value="<?php echo attribute_escape($youtube_id); ?>" /></label></p>
<?php
	}
}

register_widget('Pleng_Youtube');

/**
*	End Youtube Video Custom Widgets
**/

/**
*	Begin Vimeo Video Custom Widgets
**/

class Pleng_Vimeo extends WP_Widget {
	function Pleng_Vimeo() {
		$widget_ops = array('classname' => 'Pleng_Vimeo', 'description' => 'Display Vimeo Video' );
		$this->WP_Widget('Pleng_Vimeo', 'Pleng Vimeo Video', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$vimeo_id = empty($instance['vimeo_id']) ? 0 : $instance['vimeo_id'];
		
		if(!empty($title))
		{
			echo '<h2 class="widgettitle">'.$title.'</h2><br/>';
		}
?>

<object width="240" height="180"><param name="allowfullscreen" value="true" /><param name="wmode" value="opaque"><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeo_id; ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" /><embed src="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeo_id; ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="240" height="180" wmode="transparent"></embed></object><br/><br/>
		
<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['vimeo_id'] = strip_tags($new_instance['vimeo_id']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'vimeo_id' => '') );
		$title = strip_tags($instance['title']);
		$vimeo_id = strip_tags($instance['vimeo_id']);

?>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('vimeo_id'); ?>">Video_id: <input class="widefat" id="<?php echo $this->get_field_id('vimeo_id'); ?>" name="<?php echo $this->get_field_name('vimeo_id'); ?>" type="text" value="<?php echo attribute_escape($vimeo_id); ?>" /></label></p>
<?php
	}
}

register_widget('Pleng_Vimeo');

/**
*	End Vimeo Video Custom Widgets
**/


/**
*	Begin Social Media Icon Custom Widgets
**/

class Pleng_Social_Icon extends WP_Widget {
	function Pleng_Social_Icon() {
		$widget_ops = array('classname' => 'Pleng_Social_Icon', 'description' => 'Display social media icon' );
		$this->WP_Widget('Pleng_Social_Icon', 'Pleng Social Media Icon', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$twitter = empty($instance['twitter']) ? '' : $instance['twitter'];
		$facebook = empty($instance['facebook']) ? '' : $instance['facebook'];
		$flickr = empty($instance['flickr']) ? '' : $instance['flickr'];
		$youtube = empty($instance['youtube']) ? '' : $instance['youtube'];
		$linkedin = empty($instance['linkedin']) ? '' : $instance['linkedin'];
		
		if(!empty($title))
		{
			echo '<h2 class="widgettitle">'.$title.'</h2>';
		}
?>

<ul class="social_media">
	<?php
		if(!empty($twitter))
		{
	?>
		<li><a href="http://twitter.com/<?php echo $twitter; ?>" title="Twitter"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/icon_twitter.png"></a></li>
	<?php
		}
	?>
	
	<?php
		if(!empty($facebook))
		{
	?>
		<li><a href="http://facebook.com/<?php echo $facebook; ?>" title="Facebook"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/icon_facebook.png"></a></li>
	<?php
		}
	?>
	
	<?php
		if(!empty($flickr))
		{
	?>
		<li><a href="http://flickr.com/photos/<?php echo $flickr; ?>" title="Flickr"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/icon_flickr.png"></a></li>
	<?php
		}
	?>
	
	<?php
		if(!empty($youtube))
		{
	?>
		<li><a href="http://youtube.com/user/<?php echo $youtube; ?>" title="Youtube"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/icon_youtube.png"></a></li>
	<?php
		}
	?>
	
	<?php
		if(!empty($linkedin))
		{
	?>
		<li><a href="<?php echo $linkedin; ?>" title="Linkedin"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/icon_linkedin.png"></a></li>
	<?php
		}
	?>
</ul>
<br class="clear"/>
		
<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['flickr'] = strip_tags($new_instance['flickr']);
		$instance['youtube'] = strip_tags($new_instance['youtube']);
		$instance['linkedin'] = strip_tags($new_instance['linkedin']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'twitter' => '', 'facebook' => '', 'flickr' => '', 'youtube' => '', 'linkedin' => '') );
		$title = strip_tags($instance['title']);
		$twitter = strip_tags($instance['twitter']);
		$facebook = strip_tags($instance['facebook']);
		$flickr = strip_tags($instance['flickr']);
		$youtube = strip_tags($instance['youtube']);
		$linkedin = strip_tags($instance['linkedin']);

?>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('twitter'); ?>">Twitter Username: <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo attribute_escape($twitter); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('facebook'); ?>">Facebook Username: <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo attribute_escape($facebook); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('flickr'); ?>">Flickr Username: <input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo attribute_escape($flickr); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('youtube'); ?>">Youtube Username: <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo attribute_escape($youtube); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('linkedin'); ?>">Linkedin URL: <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo attribute_escape($linkedin); ?>" /></label></p>
<?php
	}
}

register_widget('Pleng_Social_Icon');

/**
*	End Social Media Icon Custom Widgets
**/

/**
*	Begin Flickr Feed Custom Widgets
**/

class Pleng_Flickr extends WP_Widget {
	function Pleng_Flickr() {
		$widget_ops = array('classname' => 'Pleng_Flickr', 'description' => 'Display your recent Flickr photos' );
		$this->WP_Widget('Pleng_Flickr', 'Pleng Flickr', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$flickr_id = empty($instance['flickr_id']) ? ' ' : apply_filters('widget_title', $instance['flickr_id']);
		$title = $instance['title'];
		$items = $instance['items'];
		
		if(!is_numeric($items))
		{
			$items = 9;
		}
		
		if(empty($title))
		{
			$title = 'Photostream';
		}
		
		if(!empty($items) && !empty($flickr_id))
		{
			$photos_arr = get_flickr(array('type' => 'user', 'id' => $flickr_id, 'items' => $items));
			
			if(!empty($photos_arr))
			{
				echo '<h2 class="widgettitle">'.$title.'</h2>';
				echo '<ul class="flickr">';
				
				foreach($photos_arr as $photo)
				{
					echo '<li>';
					echo '<a href="'.$photo['url'].'" title="'.$photo['title'].'"><img src="'.$photo['thumb_url'].'" alt="" class="frame" /></a>';
					echo '</li>';
				}
				
				echo '</ul><br class="clear"/>';
			}
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'flickr_id' => '', 'title' => '') );
		$items = strip_tags($instance['items']);
		$flickr_id = strip_tags($instance['flickr_id']);
		$title = strip_tags($instance['title']);

?>
			<p><label for="<?php echo $this->get_field_id('flickr_id'); ?>">Flickr ID <a href="http://idgettr.com/">Find your Flickr ID here</a>: <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo attribute_escape($flickr_id); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 9): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo attribute_escape($items); ?>" /></label></p>
<?php
	}
}

register_widget('Pleng_Flickr');

/**
*	End Flickr Feed Custom Widgets
**/

?>