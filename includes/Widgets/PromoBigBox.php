<?php
namespace Widgets;

class PromoBigBox extends \WP_Widget{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  	                                             
	function __construct() 
	{		
		parent::__construct(
			'promo_big_box', 
			__('Promo big box'), 
			array( 
				'description' => __('Add a promotion big box to sidebar.'), 
				'classname' => 'widget-promo-big'
			)
		);
	}

	function widget($args, $instance) 
	{
		$arr = array(
			'title'       => strlen($instance['title']) ? $args['before_title'].$instance['title'].$args['after_title'] : '',
			'description' => strlen($instance['description']) ? sprintf('<span class="description">%s</span>', $instance['description']) : '',
			'url'         => isset($instance['url']) ? $instance['url'] : '#',
			'image'       => $instance['image'] ? $instance['image'] : 'http://placehold.it/1292x548',	
		);
		extract($arr);

		echo $args['before_widget'];
		?>
		
		<figure>
			<img src="<?php echo $image; ?>" alt="Promo big">
			<a href="<?php echo $url; ?>" class="promo-button">читать больше >></a>
			<figcaption>
				<?php echo $title; ?>	
				<?php echo $description; ?>	
			</figcaption>
		</figure>
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance['title']       = $new_instance['title'];
		$instance['description'] = $new_instance['description'];
		$instance['image']       = strip_tags($new_instance['image']);
		$instance['url']         = strip_tags($new_instance['url']);
		return $instance;
	}

	function form( $instance ) 
	{
		$arr = array(
			'title'       => isset($instance['title']) ? $instance['title'] : '',
			'description' => isset($instance['description']) ? $instance['description'] : '',
			'url'         => isset($instance['url']) ? $instance['url'] : '',
			'image'       => isset($instance['image']) ? $instance['image'] : '',	
		);
		

		extract($arr);

		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Title:') ?></label>
			<textarea id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" cols="30" rows="10" class="widefat"><?php echo $description; ?></textarea>
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