<?php
/**
 * The main template file for display portfolio page.
 *
 * @package WordPress
*/

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

$caption_class = "page_caption";
$portfolio_sets_query = '';

if(!empty($term))
{
	$portfolio_sets_query.= $term;
	
	$obj_term = get_term_by('slug', $term, 'portfolio_sets');
	$custom_title = $obj_term->name;
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

if(!empty($term))
{
	$portfolio_sets_query.= $term;
	
	$obj_term = get_term_by('slug', $term, 'portfoliosets');
	$custom_title = $obj_term->name;
}
else
{
	$custom_title = get_the_title();
}

//if show header
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
			
			<div class="breadcrumbs"><div class="inner"><?php if(!$is_front_page) { echo pp_breadcrumbs(); } ?></div></div>
			
			<div class="inner">		
				
				<!-- Begin main content -->
				<div class="inner_wrapper portfolio">
						
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

							$portfolio_items = get_option('pp_portfolio_items'); 
							if(empty($portfolio_items))
							{
								$portfolio_items = 12;
							}
							
							$portfolio_sort = get_option('pp_portfolio_sort'); 
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
								'post_type' => array('portfolios'),
								'offset' => $offset,
							);
							if(!empty($term))
							{
								$args['portfoliosets'].= $term;
							}
							
							$page_photo_arr = get_posts($args);
							
							
							//Get all portfolio items for paging
							
							$args = array(
								'numberposts' => -1,
								'order' => $portfolio_sort,
								'orderby' => 'date',
								'post_type' => array('portfolios'),
							);
							if(!empty($term))
							{
								$args['portfoliosets'].= $term;
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
													
													$permalink_url = get_permalink($portfolio_item->ID);
											?>
										
														<div class="two_third portfolio1 img_shadow_536">
															<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/timthumb.php?src=<?php echo $image_url[0]?>&amp;h=250&amp;w=560&amp;zc=1" alt="" class="frame"/>
															
															<span class="portfolio1_hover">
																<a href="<?php echo $permalink_url; ?>" class="portfolio_image">
																	<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/icon_zoom.png" alt=""/>
																</a>
															</span>
														</div>
														
														<div class="one_third last">
															<br/><br/>
															<h2 class="cufon"><?php echo $portfolio_item->post_title?></h2><br/>
															<?php echo pp_substr(strip_tags(strip_shortcodes($portfolio_item->post_content)), 140); ?>
															
															<?php
																$pp_portfolio_hide_view = get_option('pp_portfolio_hide_view'); 
																
																if(!empty($pp_portfolio_hide_view))
																{
																	$pp_portfolio_view_title = get_option('pp_portfolio_view_title'); 
																	
																	if(empty($pp_portfolio_view_title))
																	{
																		$pp_portfolio_view_title = 'View';
																	}
															?>											
																<br/><br/><br/>
																<input type="button" value="<?php echo $pp_portfolio_view_title; ?>" onclick="location.href='<?php echo $permalink_url; ?>'"/>
															<?php
																}
															?>
															
														</div>

											<?php
												
												}
												//End foreach loop
												
										    ?>
								
							<?php
								if(empty($term))
								{
									$base_link = get_permalink($post->ID);
								}
								else
								{
									$base_link = curPageURL();
								}
								
								echo gen_pagination($total, $current_page, $base_link, TRUE, $portfolio_items);
								
							}
							//End if have portfolio items
							?>
						
						    
						</div>
						<!-- End main content -->
					
					<br class="clear"/><br/><br/>
					
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