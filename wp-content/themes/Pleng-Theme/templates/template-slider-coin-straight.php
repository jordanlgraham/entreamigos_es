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
		
				<div id="coin_slider">
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
									
									switch($caption_align)
									{
										case 'Align Left':
											$caption_style = 'width:300px;left:0px;top:200px';
										break;
										case 'Align Right':
											$caption_style = 'width:300px;left:630px;top:200px';
										break;
										case 'Bottom':
											$caption_style = 'left:0px;top:260px;width:98%;';
										break;
									}
							?>
							<a href="<?php echo $hyperlink_url;?>">
								<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/timthumb.php?src=<?php echo $image_url[0]; ?>&amp;h=360&amp;w=960&amp;zc=1" alt="" <?php if(!empty($caption_style)) { echo 'title="'.$caption_style.'"'; } ?>/>
								
								<?php
									if($caption_align != 'No Caption')
									{
								?>
								
								<span rel="<?php echo $caption_style; ?>;z-index:99">
									<h4><?php echo $gallery_item->post_title; ?></h4>
									<?php echo pp_substr(strip_tags(strip_shortcodes($gallery_item->post_content)), 200); ?>
								</span>
								
								<?php
									}
								?>
								
							</a>
							
							<?php
								}
							?>
				</div>
		
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
	$j('#coin_slider').coinslider({width: 960, height: 360, effect: 'straight', opacity: 1, delay: parseInt($j('#slider_timer').val() * 1000), navigation: <?php echo $pp_homepage_slider_nav; ?>});
});
</script> 