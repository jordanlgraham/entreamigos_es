<?php
/**
 * The main template file for display error page.
 *
 * @package WordPress
*/


get_header(); 

?>

		<br class="clear"/>
		
		<div class="page_caption">
				<div class="caption_inner">
					
						<div class="caption_header">
						<h2 class="cufon">404 Not Found</h2>
					</div>

					<br class="clear"/>
				</div>
			</div>
		
		<div class="home_boxes_footer"></div>

		<!-- Begin content -->
		<div id="content_wrapper">
		
			<div class="line_shadow">&nbsp;</div>
		
			<div class="breadcrumbs"><div class="inner"><?php echo pp_breadcrumbs(); ?></div></div>
			
			<div class="inner">
				
				<!-- Begin main content -->
				<div class="inner_wrapper">
					
					<div class="sidebar_content">
						<h2 class="cufon"><?php _e( 'Oops!', 'Soon' ); ?></h2>
						<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'Soon' ); ?></p>
					</div>
					
				</div>
				<!-- End main content -->
				
				<br class="clear"/><br/><br/><br/><br/><br/><br/>
			</div>
			
		</div>
		<!-- End content -->

<?php get_footer(); ?>