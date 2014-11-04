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
			<a href="/" class="logo"><img src="<?php echo TDU.'/images/hedaer_logo.png'; ?>" alt="Logo"></a>	
			<?php
				wp_nav_menu( 
					array( 
						'theme_location' => 'primary', 
						'container'      => false 
					) 
				);
			?>
			<!-- <ul class="menu-lang" id="menu-main-lang">
				<li class="active menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-35" id="menu-item-35">
					<a href="/">RU</a>
				</li>
				<li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-36" id="menu-item-36">
					<a href="/">EN</a>
				</li>
			</ul> -->
		</div>
		<?php echo $slider->getHTML(array('posts_per_page' => $count)); ?>
	</header>
