		<?php
				$pp_slider_items = get_option('pp_slider_items');
				
				if(empty($pp_slider_items))
				{
					$pp_slider_items = 5;
				}

				$pp_slider_sort = get_option('pp_slider_sort'); 
				if(empty($pp_slider_sort))
				{
					$pp_slider_sort = 'ASC';
				}
			
				$slider_arr = get_posts('numberposts='.$pp_slider_items.'&order='.$pp_slider_sort.'&orderby=date&post_type=slides');

				if(!empty($slider_arr))
				{
		?>
		
				<div id="anything_slider">
					<div class="wrapper">
						<ul>
							<?php
								foreach($slider_arr as $key => $gallery_item)
								{		
									$image_url = '';
								
									if(has_post_thumbnail($gallery_item->ID, 'large'))
									{
										$image_id = get_post_thumbnail_id($gallery_item->ID);
										$image_url = wp_get_attachment_image_src($image_id, 'large', true);
									}
									$hyperlink_url = get_post_meta($gallery_item->ID, 'gallery_link_url', true);
									
									$caption_align = get_post_meta($gallery_item->ID, 'caption_align', true);
									$caption_style = 'left';
									
									switch($caption_align)
									{
										case 'Align Right':
											$caption_style = 'right';
										break;
										case 'Bottom':
											$caption_style = 'bottom';
										break;
										case 'No Caption':
											$caption_style = 'hide';
										break;
									}
							?>
							<li id="anythingslide<?php echo $key+1; ?>">
								<a href="<?php echo $hyperlink_url;?>">
									<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/timthumb.php?src=<?php echo $image_url[0]; ?>&amp;h=360&amp;w=960&amp;zc=1" alt=""/>
								</a>
								<div class="caption-<?php echo $caption_style; ?>">
									<h3 class="cufon"><?php echo $gallery_item->post_title; ?></h3>
									<p><?php echo pp_substr(strip_tags(strip_shortcodes($gallery_item->post_content)), 100); ?></p>
								</div>
							</li>
							<?php
								}
							?>
						</ul>
					</div>
				</div>
		
		<?php 
				}
		?>
		
<?php
	$pp_homepage_slider_nav = false;
	if(get_option('pp_homepage_slider_nav'))
	{
		$pp_homepage_slider_nav = true;
	}
?>
		
<script type="text/javascript"> 
    $j(function () {

    	$j('#anything_slider').anythingSlider({
    	        easing: "easeInOutExpo",
    	        autoPlay: true,
    	        delay: parseInt($j('#slider_timer').val() * 1000),
    	        startStopped: false,
    	        animationTime: 600,
    	        hashTags: true,
    	        buildNavigation: true,
    	        buildArrows: true,
    			pauseOnHover: true,
    			startText: "Go",
    	        stopText: "Stop"
    	    });
    	    
    	<?php
    		if($pp_homepage_slider_nav)
    		{
    	?>
    			$j('#anything_slider').hover(function()
				{	
					$j(this).find('.arrow').css('visibility', 'visible');
				},
				function()
				{	
					$j(this).find('.arrow').css('visibility', 'hidden');
				});
    	<?php
    		}
    	?>
    });				
</script>