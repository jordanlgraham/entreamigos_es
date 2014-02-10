<?php
/**
 * The main template file.
 *
 * @package WordPress
 */

session_start();
$pp_homepage_hide_slider = get_option('pp_homepage_hide_slider');

if(isset($_SESSION['pp_homepage_slider_style']))
{
	$pp_homepage_slider_style = $_SESSION['pp_homepage_slider_style'];
}
else
{
	$pp_homepage_slider_style = get_option('pp_homepage_slider_style');
}

$pp_homepage_hide_blog = get_option('pp_homepage_hide_blog');

if(empty($pp_homepage_slider_style))
{
    $pp_homepage_slider_style = 'nivo_fade';
}

$pp_slider_timer = get_option('pp_slider_timer'); 
				
if(empty($pp_slider_timer))
{
    $pp_slider_timer = 5;
}
				
get_header(); ?>

		<input type="hidden" id="slider_timer" name="slider_timer" value="<?php echo $pp_slider_timer; ?>"/>
	
		<?php
			if(!empty($pp_homepage_hide_slider))
			{
		?>
	
		<br class="clear"/>
		<div id="slider_loading"></div>
		
		<div id="slider_wrapper" class="<?php if($pp_homepage_slider_style != 'accordion') { echo $pp_homepage_slider_style; } ?>">

		<?php
				switch($pp_homepage_slider_style)
				{
					case 'nivo_curtain':
						include (TEMPLATEPATH . "/templates/template-slider-nivo-curtain.php");
					break;
					
					case 'nivo_fade':
						include (TEMPLATEPATH . "/templates/template-slider-nivo-fade.php");
					break;
					
					case 'nivo_fold':
						include (TEMPLATEPATH . "/templates/template-slider-nivo-fold.php");
					break;
					
					case 'anything_slider':
						include (TEMPLATEPATH . "/templates/template-slider-slide.php");
					break;
					
					case 'roundabout_easing':
						include (TEMPLATEPATH . "/templates/template-slider-roundabout-easing.php");
					break;
					
					case 'accordion':
						include (TEMPLATEPATH . "/templates/template-slider-accordion.php");
					break;
					
					case 'coin_swirl':
						include (TEMPLATEPATH . "/templates/template-slider-coin-swirl.php");
					break;
					
					case 'coin_rain':
						include (TEMPLATEPATH . "/templates/template-slider-coin-rain.php");
					break;
					
					case 'coin_straight':
						include (TEMPLATEPATH . "/templates/template-slider-coin-straight.php");
					break;
				}
		?>
		
		</div>
		
		</div>
		<!-- End header -->
		
		<?php
			}
		?>
		
		<div class="home_boxes_wrapper grey" style="padding-bottom:30px">
		
			<?php
				$pp_homepage_hide_tagline = get_option('pp_homepage_hide_tagline');
				
				if(!empty($pp_homepage_hide_tagline))
				{
					$pp_homepage_tagline_title = get_option('pp_homepage_tagline_title');
					if(empty($pp_homepage_tagline_title))
					{
						$pp_homepage_tagline_title = 'Built with the latest Wordpress features';
					}
					
					$pp_homepage_tagline_desc = get_option('pp_homepage_tagline_desc');
					if(empty($pp_homepage_tagline_desc))
					{
						$pp_homepage_tagline_desc = 'with extensive admin panel, customize every parts of the theme so what are you waiting for?';
					}
					
					$pp_tagline_button_title = get_option('pp_tagline_button_title');
					if(empty($pp_tagline_button_title))
					{
						$pp_tagline_button_title = 'Buy Now';
					}
					
					$pp_tagline_button_href = get_option('pp_tagline_button_href');
			?>		
				
			<div class="tagline">
				<div class="tagline_text">
					<h2 class="cufon"><?php echo stripslashes($pp_homepage_tagline_title); ?></h2>
					<p><?php echo stripslashes($pp_homepage_tagline_desc); ?></p>
				</div>
				<div class="tagline_button">
					<a href="<?php echo $pp_tagline_button_href; ?>" class="button medium"><?php echo $pp_tagline_button_title; ?></a>
				</div>
				<br class="clear"/>
			</div>
			
			<br class="clear"/>
			
			<?php
				} //end if hide tagline
			?>
		
			<div class="inner">
		
			<?php
				$pp_homepage_hide_boxes = get_option('pp_homepage_hide_boxes');
				
				if(!empty($pp_homepage_hide_boxes))
				{
			
					//Get home boxes
					$args = array(
						'numberposts' => 6,
						'orderby' => 'date',
						'order' => 'ASC',
						'post_type' => 'home_boxes',
					);	
						
					$box_post_arr = get_posts($args);
					
					//pp_debug($box_post_arr);
			
					if(!empty($box_post_arr))
					{
						foreach($box_post_arr as $key => $box_post)
						{
							$last_class = '';
							if(($key+1) % 3 == 0)
							{	
								$last_class = ' last';
							}
				?>
							<div class="one_third<?php echo $last_class; ?>" style="margin-bottom:40px">
									<h2 class="cufon"><?php echo stripslashes($box_post->post_title); ?></h2><br/>
									<?php echo stripslashes(html_entity_decode(do_shortcode($box_post->post_content))); ?>
							</div>
				<?php
						}
					}
				?>
				</div>
				
				<br class="clear"/>
				<div class="home_shadow_footer"></div>
			<?php
				} //end if hide home boxes
			?>
		
		<?php
		$pp_homepage_hide_portfolio = get_option('pp_homepage_hide_portfolio');
				
		if(!empty($pp_homepage_hide_portfolio))
		{
			
			$pp_home_portfolio_items = get_option('pp_home_portfolio_items');
			if(empty($pp_home_portfolio_items))
			{
				$pp_home_portfolio_items = 5;
			}
			
			//Get latest portfolios
			$args = array(
				'numberposts' => $pp_home_portfolio_items,
				'orderby' => 'date',
				'order' => 'DESC',
				'post_type' => array('portfolios'),
			);	
				
			$page_photo_arr = get_posts($args);
		?>
		
		<?php
			if(isset($page_photo_arr) && !empty($page_photo_arr))
			{				
		?>
		
		<br class="clear"/><br/>
		<div class="home_portfolio">
			<div class="standard_wrapper">
						
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
													
													$last_class = '';
													$line_break = '';
													if(($key+1) % 5 == 0)
													{	
														$last_class = ' last';
														$line_break = '<br class="clear"/><br/>';
													}
													
													$pp_portfolio_view_title = get_option('pp_portfolio_view_title'); 
																			
													if(empty($pp_portfolio_view_title))
													{
														$pp_portfolio_view_title = 'View';
													}
													
											?>
														<div class="home_grid_shadow">
															<div class="home_portfolio_grid <?php echo $last_class; ?>">
																<a href="<?php echo $permalink_url; ?>">
																	<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/timthumb.php?src=<?php echo $image_url[0]?>&amp;h=286&amp;w=176&amp;zc=1" alt=""/>
																</a>																																	<p>
																	<strong><?php echo $portfolio_item->post_title?></strong><br/>
																	<?php echo pp_substr(strip_tags(strip_shortcodes($portfolio_item->post_content)), 70); ?>
																</p>
																<p>
																	<input type="button" value="<?php echo $pp_portfolio_view_title; ?>" onclick="location.href='<?php echo $permalink_url; ?>'"/></p><br/>
															</div>
														</div>
			<?php			echo $line_break;
						}
						//End foreach loop
			?>
			
				</div>
				<br class="clear"/><br/>
			</div>
				
			<?php
					}	
			?>
			
			<?php
				} //end if hide portfolio
			?>
				
		</div>
		
		<br class="clear"/>
		<div class="home_shadow_footer" style="margin-top:-11px"></div>
						
					
		<div class="standard_wrapper">
			<?php
				$pp_home_left_content = get_option('pp_home_left_content');
				$pp_home_right_content = get_option('pp_home_right_content');
			?>
		
			<br class="clear"/><br/>
			
			<div class="two_third">
				<?php echo html_entity_decode(stripslashes($pp_home_left_content)); ?>
			</div>
			
			<div class="one_third last">
				<?php echo html_entity_decode(stripslashes($pp_home_right_content)); ?>
			</div>
			
			<br class="clear"/>
		</div>
		
	</div>
	
	<div><div>

<?php get_footer(); ?>