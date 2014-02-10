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
					$pp_homepage_button_title = get_option('pp_homepage_button_title');
					if(empty($pp_homepage_button_title))
					{
						$pp_homepage_button_title = 'Learn More';
					}
		?>
		
				<div id="nivo_slider" class="nivoSlider">
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
									$caption_style = '';
						
									if($caption_align != 'No Caption')
									{
										$caption_style = '#caption'.$key;
									}
							?>
							<a href="<?php echo $hyperlink_url;?>">
								<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/timthumb.php?src=<?php echo $image_url[0]; ?>&amp;h=360&amp;w=960&amp;zc=1" alt="" <?php if(!empty($caption_style)) { echo 'title="'.$caption_style.'"'; } ?>/>
							</a>
							
							<?php
								}
							?>
				</div>
				
				<?php
					foreach($slider_arr as $key => $gallery_item)
					{
						$caption_align = get_post_meta($gallery_item->ID, 'caption_align', true);
						$caption_style = '';
						
						if($caption_align != 'No Caption')
						{
						
							switch($caption_align)
							{
								case 'Align Right':
									$caption_style = 'left:560px;';
								break;
								case 'Bottom':
									$caption_style = 'left:0px;bottom:0;width:100%;';
								break;
							}
				?>
				
						<div id="caption<?php echo $key; ?>" class="nivo-html-caption" style="<?php echo $caption_style; ?>">
							<h4><?php echo $gallery_item->post_title; ?></h4>
							<?php echo pp_substr(strip_tags(strip_shortcodes($gallery_item->post_content)), 200); ?>
						</div>
				
				<?php
						}
					}
				?>
		
		<?php 
				}
		?>

<?php
	$pp_homepage_slider_nav = 'false';
	if(get_option('pp_homepage_slider_nav'))
	{
		$pp_homepage_slider_nav = 'true';
	}
?>
		
<script type="text/javascript"> 
$j(window).load(function() {
	$j('#nivo_slider').nivoSlider({ pauseTime: parseInt($j('#slider_timer').val() * 1000), pauseOnHover: false, effect: 'fade', controlNav: true, captionOpacity: 1, directionNavHide: <?php echo $pp_homepage_slider_nav; ?>, controlNavThumbs:false, controlNavThumbsFromRel:false, afterLoad: function(){ 
		$j('#slider_loading').css('display', 'none');
		$j('#slider_wrapper').css('visibility', 'visible');
	} });
});
</script> 