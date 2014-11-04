<?php
namespace Widgets;

class WeOffer extends \WP_Widget{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  	                                             
	function __construct() 
	{		
		parent::__construct(
			'we_offer', 
			__('We offer'), 
			array( 
				'description' => __('Add a we offer to sidebar.'), 
				'classname' => 'widget-we-offer'
			)
		);
	}

	function widget($args, $instance) 
	{
		$arr = array(
			'title'   => strlen($instance['title']) ? $args['before_title'].$instance['title'].$args['after_title'] : '',
			'items'   => isset($instance['items']) ? explode("\n", $instance['items']) : array(),
			'count'   => isset($instance['count']) ? intval($instance['count']) : 0
		);
		extract($arr);

		echo $args['before_widget'];
		echo $title;
		if(is_array($items) AND count($items))
		{
			?>
			<ul>
				<?php echo $this->getItems($items, $count); ?>
			</ul>
			<ul>
				<?php echo $this->getItems($items, count($items), $count); ?>
			</ul>
			<?php
		}
		echo $args['after_widget'];
	}

	private function getItems($items, $count, $offset = 0)
	{
		if(count($items) < $count) return '';
		$str = '';
		for ($i=$offset; $i < $count; $i++) 
		{ 
			$str.= sprintf('<li>%s</li>', $items[$i]);
		}
		return $str;
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['items'] = strip_tags($new_instance['items']);
		$instance['count'] = strip_tags($new_instance['count']);
		return $instance;
	}

	function form( $instance ) 
	{
		$arr = array(
			'title' => isset($instance['title']) ? $instance['title'] : '',
			'items' => isset($instance['items']) ? $instance['items'] : '',
			'count' => isset($instance['count']) ? intval($instance['count']) : 0,
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
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count per column:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $count; ?>" />
		</p>
		<?php
	}
}