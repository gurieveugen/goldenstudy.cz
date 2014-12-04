<?php
namespace Widgets;

class PromoImage extends \WP_Widget{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  	                                             
	function __construct() 
	{		
		parent::__construct(
			'promo_image', 
			__('Promo image'), 
			array( 
				'description' => __('Add a image to sidebar.'), 
				'classname' => 'widget-promo-image'
			)
		);
	}

	function widget($args, $instance) 
	{
		$arr = array(
			'image' => isset($instance['image']) ? $instance['image'] : 'http://placehold.it/301x306',	
			'url' => isset($instance['url']) ? $instance['url'] : '#',	
		);
		extract($arr);

		echo $args['before_widget'];
		?>
		<a href="<?php echo $url; ?>"><img src="<?php echo $image; ?>" alt="Promo image"></a>
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['url'] = strip_tags($new_instance['url']);
		return $instance;
	}

	function form( $instance ) 
	{
		$arr = array(
			'image' => isset($instance['image']) ? $instance['image'] : '',
			'url' => isset($instance['url']) ? $instance['url'] : '',	
		);
		

		extract($arr);

		?>
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>" style="display: block"><?php _e('Image:') ?></label>
			<input type="text" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" />
			<button id="<?php echo $this->get_field_id('image'); ?>-btn" type="button" class="button" onclick="loadImage(event, this)">Load</button>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('url'); ?>" style="display: block"><?php _e('URL:') ?></label>
			<input type="text" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $url; ?>" />
		</p>
		<?php
	}
}