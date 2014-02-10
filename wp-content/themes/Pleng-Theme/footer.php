<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 */
?>

		<div class="bottom_shadow"></div>
		<div class="bottom_line"></div>

		<!-- Begin footer -->
		<div id="footer">
			<ul class="sidebar_widget">
				<?php dynamic_sidebar('Footer Sidebar'); ?>
			</ul>
			
			<br class="clear"/>
		
			<div id="copyright">
				<?php
					/**
					 * Get footer text
					 */
	
					$pp_footer_text = get_option('pp_footer_text');
	
					if(empty($pp_footer_text))
					{
						$pp_footer_text = 'Copyright © 2010 Peerapong. Remove this once after purchase from the ThemeForest.net';
					}
					
					echo $pp_footer_text;
				?>
			</div>
			
		</div>
		<!-- End footer -->
		

<?php
		/**
    	*	Setup Google Analyric Code
    	**/
    	include (TEMPLATEPATH . "/google-analytic.php");
?>

</div></div>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
