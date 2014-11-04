<?php
// ==============================================================
// Constants
// ==============================================================
define('TDU', get_bloginfo('template_url'));

if (!isset($content_width)) $content_width = 474; 

// ==============================================================
// Require
// ==============================================================
require_once 'includes/__.php';

// ==============================================================
// Controls collections
// ==============================================================
$ccollection_global_settings = new Controls\ControlsCollection(
	array(		
		new Controls\Textarea(
			'VK plugin code', 
			array('default-value' => ''), 
			array('placeholder' => 'Enter your VK plugin code')
		),
		new Controls\Textarea(
			'Facebook plugin code', 
			array('default-value' => ''), 
			array('placeholder' => 'Enter your facebook plugin code')
		),
		new Controls\Textarea(
			'Address', 
			array('default-value' => 'Slévačská 744/1 , 190 00 Praha 9'),
			array('placeholder' => 'Enter your address')
		),
		new Controls\Textarea(
			'Phone text',
			array('default-value' => '+420 777-642-542'),
			array('placeholder' => 'Enter you phone text')
		)
	)
);

$ccollection_main_slider = new Controls\ControlsCollection(
	array(
		new Controls\Text(
			'Slider delay', 
			array(
				'default-value' => '5',
				'description'   => 'Delay in seconds'
			), 
			array('placeholder' => 'Delay')
		),
		new Controls\Text(
			'Count slides', 
			array('default-value' => '5'), 
			array('placeholder' => 'Count')
		)
	)
);

$ccollection_slider = new Controls\ControlsCollection(
	array(
		new Controls\Text(
			'Sale',
			array(
				'description' => 'Enter you sale text'
			)
		)
	)
);

$ccollection_post = new Controls\ControlsCollection(
	array(
		new Controls\Text(
			'Subtitle',
			array(
				'default-value' => '',
				'description'   => 'Post subtitle'
			)
		),
		new Controls\Checkbox(
			'On front page',
			array(
				'default-value' => '',
				'label'   => 'Post displayed on front page'
			)
		)
	)
);

$ccollection_testimonial = new Controls\ControlsCollection(
	array(
		new Controls\Text(
			'YouTube video URL',
			array(
				'default-value' => '',
				'description'   => 'YouTube video URL'
			)
		),
		new Controls\Media(
			'Video thumbnail',
			array(
				'description' => 'Load your thumbnail image'
			)
		)
	)
);

// ==============================================================
// Sections
// ==============================================================
$section_global_settings = new Admin\Section(
	'Global settings', 
	array(
		'prefix'   => 'gs_',
		'tab_icon' => 'fa-cog'
	), 
	$ccollection_global_settings
);
$section_main_slider = new Admin\Section(
	'Main slider options', 
	array(
		'prefix' => 'mso_',
		'tab_icon' => 'fa-picture-o'
	), 
	$ccollection_main_slider
);

// ==============================================================
// Pages & Post types
// ==============================================================
$post_type_slider = new Admin\PostType(
	'Slider', 
	array(
		'icon_code' => 'f03e', 
		'supports' => array('title', 'editor', 'thumbnail')
	)
);

$post_type_testimonial = new Admin\PostType(
	'Testimonial',
	array(
		'icon_code' => 'f086', 
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies' => array('testimonial_cat') 	
	)
);

$theme_settings = new Admin\Page(
	'Theme settings', 
	array('parent_page' => 'themes.php'), 
	array(
		$section_global_settings,
		$section_main_slider
	)
);

// ==============================================================
// Custom Metaboxes
// ==============================================================
$meta_box_slider = new Admin\MetaBox(
	'Additional Slider options', 
	array(
		'post_type' => 'slider', 
		'prefix' => 'aso_'
	), 
	$ccollection_slider
);

$meta_box_post = new Admin\MetaBox(
	'Additional post options', 
	array(
		'post_type' => 'post', 
		'prefix' => 'apo_'
	), 
	$ccollection_post
);

$meta_box_testimonial = new Admin\MetaBox(
	'Additional testimonial options', 
	array(
		'post_type' => 'testimonial', 
		'prefix' => 'ato_'
	), 
	$ccollection_testimonial
);
// ==============================================================
// Custom Taxonomies
// ==============================================================
$taxonomy_testimonial_cat = new Admin\Taxonomy(
	'Testimonial category',
	array(
		'post_type' => 'testimonial',
		'plural'    => 'Testimonial categories',
		'name'      => 'testimonial_cat'
	),
	null
);

// ==============================================================
// Action & Filters
// ==============================================================
add_action('after_setup_theme', 'themeSetup');
add_action('widgets_init', 'widgetsInit');
add_action('wp_enqueue_scripts', 'themeScriptsAndStyles');
add_action('admin_enqueue_scripts', 'adminScriptsAndStyles');

/**
 * Setup Theme
 */
function themeSetup() 
{
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'full', 9999, 569, true );
	add_image_size( 'featured', 232, 192, true );
	add_image_size( 'widget-small', 301, 306, true );
	add_image_size( 'widget-large', 1292, 548, true );
	add_image_size( 'testimonial-author', 57, 57, true );
	add_image_size( 'testimonial', 409, 245, true );
	add_image_size( 'medium', 765, 340, true );

	register_nav_menus( 
		array(
			'primary'      => __( 'Top primary menu', 'goldenstudy' ),
			'secondary'    => __( 'Secondary menu in left sidebar', 'goldenstudy' ),
		) 
	);
}


/**
 * Register three Twenty Fourteen widget areas.
 *
 * @since Twenty Fourteen 1.0
 */
function widgetsInit() 
{
	register_sidebar( 
		array(
			'name'          => __('Front page Sidebar', 'goldenstudy'),
			'id'            => 'sidebar_front_page',
			'description'   => __('Sidebar on the front page.', 'goldenstudy'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		) 
	);

	register_sidebar( 
		array(
			'name'          => __('Bottom front page left Sidebar', 'goldenstudy'),
			'id'            => 'sidebar_bottom_left',
			'description'   => __('Sidebar on the front page in the bottom, left part of the site.', 'goldenstudy'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		) 
	);

	register_sidebar( 
		array(
			'name'          => __('Bottom front page right Sidebar', 'goldenstudy'),
			'id'            => 'sidebar_bottom_right',
			'description'   => __('Sidebar on the front page in the bottom, right part of the site.', 'goldenstudy'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		) 
	);

	register_sidebar( 
		array(
			'name'          => __('Internal page right Sidebar', 'goldenstudy'),
			'id'            => 'sidebar_internal_right',
			'description'   => __('Sidebar on the internal page in right part of the site.', 'goldenstudy'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		) 
	);

	register_widget('\Widgets\PromoSmallBox');
	register_widget('\Widgets\PromoBigBox');
	register_widget('\Widgets\PromoImage');
	register_widget('\Widgets\WeOffer');
	register_widget('\Widgets\Testimonials');
	register_widget('\Widgets\TestimonialVideos');
	register_widget('\Widgets\WNZH');
}



/**
 * Add some scripts and style to Theme
 */
function themeScriptsAndStyles() 
{
	// ==============================================================
	// Scripts
	// ==============================================================
	wp_enqueue_script('jquery');
	wp_enqueue_script('main', TDU.'/js/main.js', array('jquery'));
	wp_enqueue_script('flexslider', TDU.'/js/jquery.flexslider-min.js', array('jquery'));
	wp_enqueue_script('boxer', TDU.'/js/jquery.fs.boxer.min.js', array('jquery'));
	wp_enqueue_script('selecter', TDU.'/js/jquery.fs.selecter.min.js', array('jquery'));
	wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp');

	// ==============================================================
	// Localize variables
	// ==============================================================
	wp_localize_script(
		'main', 
		'l10n_main',  
		__::getOptions(
			array(
				'mso_slider_delay',
				'mso_count_slides'
			)
		)
	);
	// ==============================================================
	// Styles
	// ==============================================================
	wp_enqueue_style('main', TDU.'/style.css');
	wp_enqueue_style('fonts', TDU.'/css/fonts/stylesheet.css');
	wp_enqueue_style('boxer', TDU.'/css/jquery.fs.boxer.min.css');
	wp_enqueue_style('selecter', TDU.'/css/jquery.fs.selecter.css');
}

/**
 * Add some scripts and style to Admin Panel
 */
function adminScriptsAndStyles()
{
	// ==============================================================
	// Scripts
	// ==============================================================
	wp_enqueue_script('main-admin', TDU.'/js/main-admin.js', array('jquery'));
}


