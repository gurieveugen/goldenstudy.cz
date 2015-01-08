<?php

$slider = new Slider();
$count  = intval(get_option('mso_count_slides'));

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( ' ', true, 'right' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo TDU; ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="main" class="main">
	<header>
		<div class="menu-wrap">
			<div class="address">
				<?php echo (string) get_option('gs_header_address'); ?>
			</div>
			<a href="#" class="toggle-menu mobile" data-menu-id="menu-main"><i class="fa fa-bars"></i></a>
			<div class="contact-mobile mobile">
				<?php echo (string) get_option('gs_phone_text'); ?>, <a href="mailto:<?php echo (string) get_option('gs_contact_email'); ?>"><?php echo (string) get_option('gs_contact_email'); ?></a>
			</div>
			<a href="/" class="logo">
				<img src="<?php echo TDU.'/images/hedaer_logo.png'; ?>" alt="Logo">
			</a>
				
			<?php
				wp_nav_menu( 
					array( 
						'theme_location' => 'primary', 
						'container'      => false 
					) 
				);
			?>
		</div>
		<?php echo $slider->getHTML(array('posts_per_page' => $count)); ?>
	</header>
