<?php
/**
 * Template Name: Blog
 * The main template file for display blog page.
 *
 * @package WordPress
*/

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

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

$page_style = get_post_meta($current_page_id, 'page_style', true);
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);
$caption_style = get_post_meta($current_page_id, 'caption_style', true);

if(empty($caption_style))
{
	$caption_style = 'Title & Description';
}

if(!isset($sidebar_home))
{
	$sidebar_home = '';
}

if(empty($page_sidebar))
{
	$page_sidebar = 'Blog Sidebar';
}
$caption_class = "page_caption";

if(!isset($add_sidebar))
{
	$add_sidebar = FALSE;
}

$sidebar_class = '';

if($page_style == 'Right Sidebar')
{
	$add_sidebar = TRUE;
	$page_class = 'sidebar_content';
}
elseif($page_style == 'Left Sidebar')
{
	$add_sidebar = TRUE;
	$page_class = 'sidebar_content';
	$sidebar_class = 'left_sidebar';
}
else
{
	$page_class = 'inner_wrapper';
}

$pp_title = get_option('pp_blog_title');

if(empty($pp_title))
{
	$pp_title = 'Blog';
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
							<h1 class="cufon"><?php echo $pp_title; ?></h1>
						</div>
					<?php
							break;
							
							case 'Title & Description':
					?>
						<div class="caption_header">
							<h1 class="cufon"><?php echo $pp_title; ?></h1>
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
				<div class="inner_wrapper"><br class="clear"/>
				
<?php
}
?>

					<?php 
						if($add_sidebar && $page_style == 'Left Sidebar')
						{
					?>
						<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
						
							<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
							
								<div class="content">
							
									<ul class="sidebar_widget">
									<?php dynamic_sidebar($page_sidebar); ?>
									</ul>
								
								</div>
						
							</div>
							<br class="clear"/>
					
							<div class="sidebar_bottom <?php echo $sidebar_class; ?>"></div>
						</div>
					<?php
						}
					?>
				
					<div class="sidebar_content">
					
<?php

global $more; $more = false; # some wordpress wtf logic

$query_string ="post_type=post&paged=$paged";

$cat_id = get_cat_ID(single_cat_title('', false));
if(!empty($cat_id))
{
	$query_string.= '&cat='.$cat_id;
}

query_posts($query_string);

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	    
	    
	  	$pp_blog_image_width = 570;
		$pp_blog_image_height = 260;
	}
?>
						
						
						<!-- Begin each blog post -->
						<div class="post_wrapper">
							<?php
								if(!empty($image_thumb))
								{
							?>
							<div class="post_img img_shadow_536" style="width:<?php echo $pp_blog_image_width+10; ?>px;height:<?php echo $pp_blog_image_height+30; ?>px">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/timthumb.php?src=<?php echo $image_thumb[0]; ?>&amp;h=<?php echo $pp_blog_image_height; ?>&amp;w=<?php echo $pp_blog_image_width; ?>&amp;zc=1" alt="" class="frame"/>
								</a>
							</div>
							
							<br class="clear"/><br/>
							<?php
								}
							?>
							
							
							<div class="post_header">
								<h3 class="cufon">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>								
									</a>
								</h3>
								<div class="post_detail">
									Posted by:&nbsp;<?php the_author(); ?>&nbsp;&nbsp;&nbsp;
									Tags:&nbsp;
									<?php the_tags(''); ?>&nbsp;&nbsp;&nbsp;
									Posted date:&nbsp;
									<?php the_time('F j, Y'); ?> <?php edit_post_link('edit post', ', ', ''); ?>
									&nbsp;|&nbsp;
									<?php comments_number('No comment', 'Comment', '% Comments'); ?>
								</div>
							</div>
							
							<br class="clear"/><br/>
							
							<?php echo get_the_content_with_formatting(); ?>
							
						</div>
						<!-- End each blog post -->
						



<?php endwhile; endif; ?>

						<div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
						
					</div>
					
					<?php
						if($add_sidebar && $page_style == 'Right Sidebar')
						{
					?>
						<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
						
							<div class="sidebar_top <?php echo $sidebar_class; ?>"></div>
						
							<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
							
								<div class="content">
							
									<ul class="sidebar_widget">
									<?php dynamic_sidebar($page_sidebar); ?>
									</ul>
								
								</div>
						
							</div>
							<br class="clear"/>
					
							<div class="sidebar_bottom <?php echo $sidebar_class; ?>"></div>
						</div>
					<?php
						}
					?>
					
				</div>
				<!-- End main content -->
				
				<br class="clear"/>
				
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