<?php
namespace Widgets;

class Testimonials extends \WP_Widget{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  	                                             
	function __construct() 
	{		
		parent::__construct(
			'testimonials_box', 
			__('Testimonials'), 
			array( 
				'description' => __('Add a testimonials to sidebar.'), 
				'classname' => 'widget-testimonials'
			)
		);
	}

	function widget($args, $instance) 
	{
		$arr = array(
			'title' => strlen($instance['title']) ? $args['before_title'].$instance['title'].$args['after_title'] : '',
		);
		extract($arr);

		echo $args['before_widget'];
		echo $title;
		$testimonials = $this->getTestimonials();
		if(count($testimonials))
		{
			echo '<ul>';
			foreach ($testimonials as $testimonial) 
			{
				echo $this->wrapTestimonial($testimonial);
			}
			echo '</ul>';
		}
		echo $args['after_widget'];
	}

	private function wrapTestimonial($testimonial)
	{
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($testimonial->ID), 'testimonial-author');
	    $thumb = is_array($thumb) ? $thumb[0] : 'http://placehold.it/57x57';
		ob_start();
		?>
		<li>
			<div class="description">
				<?php echo $testimonial->post_content; ?>
			</div>
			<figure class="author">
				<img src="<?php echo $thumb; ?>" alt="<?php echo \__::attribute($testimonial->post_title); ?>">
				<figcaption>
					<span class="name"><?php echo $testimonial->post_title; ?></span>
					<small class="date"><?php echo date('m.d.Y', strtotime($testimonial->post_date)); ?></small>	
				</figcaption>
			</figure>
		</li>
		<?php
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}

	/**
	 * Get testimonials
	 * @return array --- testimonials
	 */
	private function getTestimonials()
	{
		$args = array(
			'posts_per_page'   => 4,
			'offset'           => 0,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'testimonial',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true,
			'tax_query'        => array(
				array(
					'taxonomy' => 'testimonial_cat',
					'terms'    => 3
				)
			)
		);
		
		return get_posts($args);
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance['title'] = $new_instance['title'];
		return $instance;
	}

	function form( $instance ) 
	{
		$arr = array(
			'title' => isset($instance['title']) ? $instance['title'] : '',
		);
		
		extract($arr);

		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<?php
	}
}