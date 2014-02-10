<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/


get_header(); 

if($post->post_type == 'portfolios')
{
	include (TEMPLATEPATH . "/templates/template-portfolio-single.php");
    exit;
}

$pp_blog_page = get_option('pp_blog_page');
$page_sidebar = get_post_meta($pp_blog_page, 'page_sidebar', true);

if(empty($page_sidebar))
{
	$page_sidebar = 'Blog Sidebar';
}

$caption_class = "page_caption";

$pp_title = get_option('pp_blog_title');

if(empty($pp_title))
{
	$pp_title = 'Blog';
}

//Make blog menu active
if(!empty($pp_blog_page))
{
?>

<script>
$('ul#main_menu li.page-item-<?php echo $pp_blog_page; ?>').addClass('current_page_item');
</script>

<?php
}
?>
		<br class="clear"/>

		<div class="<?php echo $caption_class?>">
				<div class="caption_inner">
					<?php
						if(!empty($pp_title))
						{
					?>
					
						<div class="caption_header">
						<h1 class="cufon"><?php echo $pp_title; ?></h1>
					</div>
					<?php
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
				
					<div class="sidebar_content">
					
<?php

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
									<img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/timthumb.php?src=<?php echo $image_thumb[0]; ?>&h=<?php echo $pp_blog_image_height; ?>&w=<?php echo $pp_blog_image_width; ?>&zc=1" alt="" class="frame"/>
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
							
							<?php echo the_content(); ?>
							
						</div>
						<!-- End each blog post -->
						
						<?php
							$pp_blog_display_author = get_option('pp_blog_display_author');

							if(!empty($pp_blog_display_author))
							{
						?>
						
						<h4 class="cufon">About the author</h4>
							
						<div id="about_the_author">
							<div class="thumb"><?php echo get_avatar( get_the_author_email(), '50' ); ?></div>
							<div class="description">
								<strong><?php the_author_link(); ?></strong><br/>
								<?php the_author_description(); ?>
							</div>
						</div>
						
						<?php 
							}
						?>
						
						<?php
							$pp_blog_display_related = get_option('pp_blog_display_related');

							if(!empty($pp_blog_display_related))
							{
						?>
						
						<?php
						//for use in the loop, list 5 post titles related to first tag on current post
						$tags = wp_get_post_tags($post->ID);
						if ($tags) {
						  $first_tag = $tags[0]->term_id;
						  $args=array(
						    'tag__in' => array($first_tag),
						    'post__not_in' => array($post->ID),
						    'showposts'=>3,
						    'caller_get_posts'=>1
						   );
						  $my_query = new WP_Query($args);
						  if( $my_query->have_posts() ) {
						  	echo '<br class="clear"/><br/><br/><h4 class="cufon">Related Posts</h4><br class="clear"/>';
						 ?>
						  
						  <div class="related_posts">
						  
						 <?php
						    while ($my_query->have_posts()) : $my_query->the_post(); 
						    	$image_thumb = '';
								
								if(has_post_thumbnail($post->ID, 'large'))
								{
								    $image_id = get_post_thumbnail_id($post->ID);
								    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
								}
						    ?>
						    	
						    	<?php
						    		if(!empty($image_thumb))
						    		{
						    	?>
						    		<div class="one_third">
						    			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/timthumb.php?src=<?php echo $image_thumb[0]; ?>&h=100&w=165&zc=1" alt="" class="frame" />
						    			</a>
						    		</div>
						    	<?php
						    		}
						    	?>
						    		
						    	
						    		<div class="two_third last">
						      			<h6><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6><br/><?php echo pp_substr(strip_tags(strip_shortcodes($post->post_content)), 220); ?>
						      		</div>
						      		
						    	<br class="clear"/><br/><br/>

						      <?php
								    endwhile;
								    
								    wp_reset_query();
						    	?>
						    	</div>
						    	<br class="clear"/>
						<?php
						  }
						}
						?>
						
						<br class="clear"/><br/><br/>
						
						<?php
							}
						?>


						<?php comments_template( '' ); ?>
						

<?php endwhile; endif; ?>

						</div>
					
					<div class="sidebar_wrapper">
						<div class="sidebar_top"></div>
					
						<div class="sidebar">
							
							<div class="content">
							
								<ul class="sidebar_widget">
									<?php dynamic_sidebar($page_sidebar); ?>
								</ul>
								
							</div>
						
						</div>
						
						<div class="sidebar_bottom"></div>
						<br class="clear"/>
					
					</div>
					
				</div>
				<!-- End main content -->
				
				<br class="clear"/>
			</div>
			
		</div>
		<!-- End content -->

				

<?php get_footer(); ?>