<?php
namespace Widgets;

class PromoSmallBox extends \WP_Widget{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  	                                             
	function __construct() 
	{		
		parent::__construct(
			'promo_small_box', 
			__('Promo small box'), 
			array( 
				'description' => __('Add a promotion small box to sidebar.'), 
				'classname' => 'widget-promo-small'
			)
		);
	}

	function widget($args, $instance) 
	{
		$arr = array(
			'title' => strlen($instance['title']) ? $args['before_title'].$instance['title'].$args['after_title'] : '',
			'url'   => isset($instance['url']) ? $instance['url'] : '#',
			'image' => $instance['image'] ? $instance['image'] : 'http://placehold.it/301x306',	
		);
		extract($arr);

		echo $args['before_widget'];
		?>
		<figure>
			<img src="<?php echo $image; ?>" alt="Promo small">
			<a href="<?php echo $url; ?>" class="promo-button">читать больше >></a>
			<figcaption>
				<?php echo $title; ?>		
			</figcaption>
		</figure>
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance['title'] = $new_instance['title'];
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['url']   = strip_tags($new_instance['url']);
		return $instance;
	}

	function form( $instance ) 
	{
		$arr = array(
			'title' => isset($instance['title']) ? $instance['title'] : '',
			'url'   => isset($instance['url']) ? $instance['url'] : '',
			'image' => isset($instance['image']) ? $instance['image'] : '',	
		);
		

		extract($arr);

		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $url; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>" style="display: block"><?php _e('Image:') ?></label>
			<input type="text" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" />
			<button id="<?php echo $this->get_field_id('image'); ?>-btn" type="button" class="button" onclick="loadImage(event, this)">Load</button>
		</p>
		<?php
	}
}