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
			'image' => $instance['image'] ? $instance['image'] : 'http://placehold.it/301x306',	
		);
		extract($arr);

		echo $args['before_widget'];
		?>
		<img src="<?php echo $image; ?>" alt="Promo image">
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance['image'] = strip_tags($new_instance['image']);
		return $instance;
	}

	function form( $instance ) 
	{
		$arr = array(
			'image' => isset($instance['image']) ? $instance['image'] : '',	
		);
		

		extract($arr);

		?>
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>" style="display: block"><?php _e('Image:') ?></label>
			<input type="text" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" />
			<button id="<?php echo $this->get_field_id('image'); ?>-btn" type="button" class="button" onclick="loadImage(event, this)">Load</button>
		</p>
		<?php
	}
}