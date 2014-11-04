<?php
namespace Widgets;

class WNZH extends \WP_Widget{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  	                                             
	function __construct() 
	{		
		parent::__construct(
			'wnzh', 
			__('Prerequisite for a residence permit'), 
			array( 
				'description' => __('Add a prerequisite for a residence permit to sidebar.'), 
				'classname' => 'widget-wnzh'
			)
		);
	}

	function widget($args, $instance) 
	{
		$arr = array(
			'title'   => strlen($instance['title']) ? $args['before_title'].$instance['title'].$args['after_title'] : '',
			'items'   => isset($instance['items']) ? explode("\n", $instance['items']) : array()
		);
		extract($arr);
		$str = '';

		echo $args['before_widget'];
		echo $title;
		if(is_array($items) AND count($items))
		{
			foreach ($items as $key => $value) 
			{
				$str.= sprintf('<li><b>%d.</b> %s</li>', intval($key+1), $value);		
			}
			printf('<ul>%s</ul>', $str);
		}
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['items'] = strip_tags($new_instance['items']);
		return $instance;
	}

	function form( $instance ) 
	{
		$arr = array(
			'title' => isset($instance['title']) ? $instance['title'] : '',
			'items' => isset($instance['items']) ? $instance['items'] : ''
		);
		

		extract($arr);

		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('items'); ?>"><?php _e('Items:') ?></label>
			<textarea name="<?php echo $this->get_field_name('items'); ?>" class="widefat" id="<?php echo $this->get_field_id('items'); ?>" cols="30" rows="10"><?php echo $items; ?></textarea>
		</p>
		<?php
	}
}