<?php
/**
 * Template Name: Video Gallery
 * The main template file for display video gallery page.
 *
 * @package WordPress
*/

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

$caption_class = "page_caption";
$portfolio_sets_query = '';
$custom_title = '';

if(!empty($term))
{
	$portfolio_sets_query.= $term;
	
	$obj_term = get_term_by('slug', $term, 'videos_galleries');
	$custom_title = $obj_term->name;
}
else
{
	$custom_title = get_the_title();
}

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

$caption_style = get_post_meta($current_page_id, 'caption_style', true);

if(empty($caption_style))
{
	$caption_style = 'Title & Description';
}

if(!isset($hide_header) OR !$hide_header)
{
?>				
		<br class="clear"/>

		<div class="<?php echo $caption_class?>">
				<div class="caption_inner">
					<?php
						$page_desc = get_post_meta($current_page_id, 'page_desc', true);
						
						switch($caption_style)
						{
							case 'Description Only':
						
							if(!empty($page_desc))
							{
					?>
					
						<div class="caption_header">
							<h2 class="cufon"><?php echo $page_desc; ?></h2>
						</div>
					<?php
							}
							break;
							
							case 'Title Only':
					?>
						<div class="caption_header">
							<h1 class="cufon"><?php echo $custom_title; ?></h1>
						</div>
					<?php
							break;
							
							case 'Title & Description':
					?>
						<div class="caption_header">
							<h1 class="cufon"><?php echo $custom_title; ?></h1>
						</div>
						<div class="caption_desc">
							<?php echo $page_desc; ?>
						</div>
					<?php
							break;
						}
					?>
					<br class="clear"/>
				</div>
			</div>
		
		<div class="home_boxes_footer"></div>	
				
		<!-- Begin content -->
		<div id="content_wrapper">
			
			<div class="line_shadow">&nbsp;</div>
			
			<div class="breadcrumbs"><div class="inner"><?php if(empty($term)) { echo pp_breadcrumbs(); } ?></div></div>
			
			<div class="inner">
			
				<!-- Begin main content -->
				<div id="video_gallery_wrapper" class="inner_wrapper portfolio"><br class="clear"/>
				
<?php
}
else
{
	echo '<br class="clear"/>';
}
?>	
						
						<!-- Begin portfolio content -->
						
						<?php
							$menu_sets_query = '';

							$portfolio_items = get_option('pp_gallery_items'); 
							if(empty($portfolio_items))
							{
								$portfolio_items = 12;
							}
							
							$portfolio_sort = get_option('pp_gallery_sort'); 
							if(empty($portfolio_sort))
							{
								$portfolio_sort = 'DESC';
							}
							
							//prepare data for pagintion
							$offset_query = '';
							if(!isset($_GET['page']) OR empty($_GET['page']) OR $_GET['page'] == 1)
							{
							    $current_page = 1;
							}
							else
							{ 
							    $current_page = $_GET['page'];
							    $offset = (($current_page-1) * $portfolio_items);
							}
							
							$args = array(
								'numberposts' => $portfolio_items,
								'order' => $portfolio_sort,
								'orderby' => 'date',
								'post_type' => array('videos'),
								'offset' => $offset,
							);
							if(!empty($term))
							{
								$args['videos_galleries'].= $term;
							}
							
							$page_photo_arr = get_posts($args);
							
							
							//Get all portfolio items for paging
							
							$args = array(
								'numberposts' => -1,
								'order' => $portfolio_sort,
								'orderby' => 'date',
								'post_type' => array('videos'),
							);
							if(!empty($term))
							{
								$args['videos_galleries'].= $term;
							}
							
							$all_photo_arr = get_posts($args);
							$total = count($all_photo_arr);
		
							if(isset($page_photo_arr) && !empty($page_photo_arr))
							{
								
						?>
						
											<?php

												foreach($page_photo_arr as $key => $portfolio_item)
												{
													
													$image_url = '';
								
													if(has_post_thumbnail($portfolio_item->ID, 'large'))
													{
														$image_id = get_post_thumbnail_id($portfolio_item->ID);
														$image_url = wp_get_attachment_image_src($image_id, 'large', true);
													}
													
													$last_class = '';
													$line_break = '';
													if(($key+1) % 4 == 0)
													{	
														$last_class = ' last';
														
														if(isset($page_photo_arr[$key+1]))
														{
															$line_break = '<br class="clear"/><br/>';
														}
														else
														{
															$line_break = '<br class="clear"/>';
														}
													}
													
											?>
															<div class="one_fourth<?php echo $last_class?>">
																<div class="portfolio_image img_shadow_160">
																	<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/timthumb.php?src=<?php echo $image_url[0]?>&h=131&w=180&zc=1" alt="" class="frame"/>
																	
																	<span class="portfolio4_hover">
																		<a title="<?php echo $portfolio_item->post_title; ?>"  href="#video_<?php echo $key; ?>" onclick="$j('#video_<?php echo $key; ?> .video-js-box').attr('style','position:none');$j('#video_<?php echo $key; ?> .video-js-box video').attr('style', 'height:<?php echo $height; ?>px');" class="portfolio_image">
																			<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/icon_play.png" alt=""/>
																		</a>
																	</span>
																</div>
																
																<br class="clear"/>
																
																<div class="portfolio_desc" style="margin-left:5px;text-align:center">
																	<br/>
																	<strong><?php echo $portfolio_item->post_title?></strong>
																</div>
															</div>
															
															<div style="display:none">
																<div id="video_<?php echo $key; ?>">
																<?php
																	$video_type = get_post_meta($portfolio_item->ID, 'video_type', true);
																	$mp4_url = get_post_meta($portfolio_item->ID, 'mp4_url', true);
																	$webm_url = get_post_meta($portfolio_item->ID, 'webm_url', true);
																	$ogg_url = get_post_meta($portfolio_item->ID, 'ogg_url', true); 
																	$vimeo_id = get_post_meta($portfolio_item->ID, 'vimeo_id', true);
																	$youtube_id = get_post_meta($portfolio_item->ID, 'youtube_id', true);
																	$dailymotion_id = get_post_meta($portfolio_item->ID, 'dailymotion_id', true);
																	
																	$width = 600;
																	$height = 350;
																	
																	switch($video_type)
																	{
																		case 'HTML5':
$return_html = '<div class="video-js-box vim-css" style="width:600px;height:'.$height.'px"> 
    <video id="example_video_1" class="video-js" width="'.$width.'" height="'.$height.'" controls="controls" preload="auto" poster="'.$image_url[0].'"> 
      <source src="'.$mp4_url.'" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\' /> 
      <source src="'.$webm_url.'" type=\'video/webm; codecs="vp8, vorbis"\' /> 
      <source src="'.$ogg_url.'" type=\'video/ogg; codecs="theora, vorbis"\' /> 
      <object id="flash_fallback_1" class="vjs-flash-fallback" width="640" height="264" type="application/x-shockwave-flash"
        data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf"> 
        <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" /> 
        <param name="allowfullscreen" value="true" /> 
        <param name="flashvars" value=\'config={"playlist":["'.$image_url[0].'", {"url": "'.$mp4_url.'","autoPlay":false,"autoBuffering":true}]}\' /> 
        <img src="'.$image_url[0].'" width="640" height="264" alt="Poster Image"
          title="No video playback capabilities." /> 
      </object> 
    </video> 
  </div> ';
																		echo $return_html;
																		break;
																		
																		case 'Vimeo':
$return_html = '<div style="width:'.$width.'px;height:'.$height.'px">
							        <object width="'.$width.'" height="'.$height.'" data="http://vimeo.com/moogaloop.swf?clip_id='.$vimeo_id.'&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ffffff&amp;fullscreen=1" type="application/x-shockwave-flash">
			  				    		<param name="allowfullscreen" value="true" />
			  				    		<param name="allowscriptaccess" value="always" />
			  				    		<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id='.$vimeo_id.'&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ffffff&amp;fullscreen=1" />
							    	</object>
							        
							    </div>';				
																		echo $return_html;
																		break;
																		
																		case 'Youtube':
$return_html = '<div id="video_'.$youtube_id.'" style="width:'.$width.'px;height:'.$height.'px">
							        
							        <object type="application/x-shockwave-flash" data="http://www.youtube.com/v/'.$youtube_id.'" style="width:'.$width.'px;height:'.$height.'px">
			        		    		<param name="movie" value="http://www.youtube.com/v/'.$youtube_id.'" />
			    			    	</object>
							        
							    </div>';
							    										echo $return_html;
																		break;
																		
																		
																		case 'Dailymotion':
$return_html = '<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="http://www.dailymotion.com/embed/video/'.$dailymotion_id.'?width=560&theme=default&foreground=%23F7FFFD&highlight=%23FFC300&background=%23171D1B&start=&animatedTitle=&iframe=1&additionalInfos=0&autoPlay=0&hideInfos=0"></iframe>';
							    										echo $return_html;
																		break;
																	}
																?>
																</div>
															</div>
										    
										    <?php
												
													echo $line_break;
												}
												//End foreach loop
												
										    ?>
								
							<?php
								$base_link = get_permalink($post->ID);
								
								echo gen_pagination($total, $current_page, $base_link, TRUE, $portfolio_items);
								
							}
							//End if have portfolio items
							?>
						
						    
						</div>
						<!-- End main content -->
					
					<br class="clear"/><br/>
				
				</div>
				
<?php
if(!isset($hide_header) OR !$hide_header)
{
?>				
			
		</div>
		<!-- End content -->
				

<?php get_footer(); ?>
<?php
}
?>