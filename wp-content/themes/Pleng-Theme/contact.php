<?php
/**
 * Template Name: Contact
 * The main template file for display contact page.
 *
 * @package WordPress
*/


/**
*	if not submit form
**/

if(!isset($_GET['your_name']))
{

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
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

$page_description = get_post_meta($current_page_id, 'page_description', true);
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

if(empty($page_sidebar))
{
	$page_sidebar = 'Contact Sidebar';
}

$caption_class = 'page_caption';

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
							<h1 class="cufon"><?php the_title(); ?></h1>
						</div>
					<?php
							break;
							
							case 'Title & Description':
					?>
						<div class="caption_header">
							<h1 class="cufon"><?php the_title(); ?></h1>
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
			
			<div class="breadcrumbs"><div class="inner"><?php echo pp_breadcrumbs(); ?></div></div>
			
			<div class="inner">

				<!-- Begin main content -->
				<div class="inner_wrapper">
				
<?php
}
?>
				
					<div class="sidebar_content">
						<?php 
							if(!isset($hide_header) OR !$hide_header)
							{
								if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		

									<?php the_content(); break; ?><br/><br/>

						<?php endwhile; 
							}
						?>
						
						<form id="contact_form" method="post" action="<?php echo curPageURL(); ?>" style="margin-top:10px">
						    <p>
						    	<label for="your_name">Name</label><br/>
						    	<input id="your_name" name="your_name" type="text" style="width:94%"/>
						    </p>
						    <p style="margin-top:20px">
						    	<label for="email">Email</label><br/>
						    	<input id="email" name="email" type="text" style="width:94%"/>
						    </p>
						    <p style="margin-top:20px">
						    	<label for="message">Message</label><br/>
						    	<textarea id="message" name="message" rows="7" cols="10" style="width:94%"></textarea>
						    </p>
						    <p style="margin-top:20px">
								<input type="submit" value="Send Message"/><br/>
							</p>
						</form>
						<div id="reponse_msg"></div>
						<br/><br/>
						
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
						<br class="clear"/>
					
						<div class="sidebar_bottom"></div>
					</div>
				
				</div>
				<!-- End main content -->
							
				<br class="clear"/>
				
<?php
if(!isset($hide_header) OR !$hide_header)
{
?>	
			</div>
		</div>
		<!-- End content -->
				

<?php get_footer(); ?>

<?php
}
?>
				
<?php
}

//if submit form
else
{

	/*
	|--------------------------------------------------------------------------
	| Mailer module
	|--------------------------------------------------------------------------
	|
	| These module are used when sending email from contact form
	|
	*/
	
	//Get your email address
	$contact_email = get_option('pp_contact_email');
	
	//Enter your email address, email from contact form will send to this addresss. Please enter inside quotes ('myemail@email.com')
	define('DEST_EMAIL', $contact_email);
	
	//Change email subject to something more meaningful
	define('SUBJECT_EMAIL', 'Email from contact form');
	
	//Thankyou message when message sent
	define('THANKYOU_MESSAGE', 'Thank you! We will get back to you as soon as possible');
	
	//Error message when message can't send
	define('ERROR_MESSAGE', 'Oops! something went wrong, please try to submit later.');
	
	
	/*
	|
	| Begin sending mail
	|
	*/
	
	$from_name = $_GET['your_name'];
	$from_email = $_GET['email'];
	
	$message = 'Name: '.$from_name.PHP_EOL;
	$message.= 'Email: '.$from_email.PHP_EOL.PHP_EOL;
	$message.= 'Message: '.PHP_EOL.$_GET['message'];
	    
	
	if(!empty($from_name) && !empty($from_email) && !empty($message))
	{
		mail(DEST_EMAIL, SUBJECT_EMAIL, $message);
	
		echo THANKYOU_MESSAGE;
		echo '</p>';
		
		exit;
	}
	else
	{
		echo ERROR_MESSAGE;
		
		exit;
	}
	
	/*
	|
	| End sending mail
	|
	*/
}

?>