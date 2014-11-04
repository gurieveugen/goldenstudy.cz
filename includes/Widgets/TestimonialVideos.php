<?php
namespace Widgets;

class TestimonialVideos extends \WP_Widget{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  	                                             
	function __construct() 
	{		
		parent::__construct(
			'testimonial_videos_box', 
			__('Testimonial videos'), 
			array( 
				'description' => __('Add a testimonial videos to sidebar.'), 
				'classname' => 'widget-testimonial-videos'
			)
		);
	}

	function widget($args, $instance) 
	{
		$cats = array();
		$testimonial_cats = get_terms(
			array('testimonial_cat'), 
			array('exclude' => array(3, 5))
		);

		if(is_array($testimonial_cats) AND count($testimonial_cats))
		{
			$columns = array();
			$rows    = array();
			$first   = 'active';
			foreach ($testimonial_cats as $cat) 
			{
				$cats[]  = $this->wrapCat($cat, $first);
				$videos  = $this->getTestimonials($cat->term_id);
				if(is_array($videos) AND count($videos))
				{
					$rows_count = ceil(count($videos)/3);
					for ($i=0; $i < $rows_count; $i++) 
					{ 
						for ($x=0; $x < 3; $x++) 
						{ 
							$current = $x + ($i*3);
							if(isset($videos[$current]))
							{
								$columns[] = $this->wrapVideo($videos[$current]);
							}
						}
						$rows[$cat->term_id][] = $this->wrapVideos($columns);
						$columns = array();
					}
				}
				$first = '';
			}
			echo $args['before_widget'];
			echo $this->wrapCats($cats);
			echo $this->wrapRows($rows);
			echo $args['after_widget'];	
		}
	}


	private function wrapRows($rows)
	{
		if(!is_array($rows) OR !count($rows)) return '';
		$first = '';
		$str   = '';
		foreach ($rows as $cat => $row) 
		{
			if(is_array($row) AND count($row))
			{
				$str.= sprintf(
					'<div class="videoblock %s" id="videoblock-%s">%s</div>', 
					$first, 
					$cat,
					implode('', $row)
				);
			}
			$first = 'hide';
		}
		return $str;
	}

	private function wrapVideos($videos)
	{
		$videos = is_array($videos) ? implode('', $videos) : '';
		return sprintf('<ul>%s</ul>', $videos);
	}

	private function wrapVideo($video)
	{
		$image_id = \__::getAttachmentIDFromSrc($video->thumbnail);
		$image = wp_get_attachment_image_src($image_id, 'testimonial');
		$image = is_array($image) ? $image[0] : 'http://placehold.it/409x245';
		return sprintf(
			'<li><a href="%s" class="boxer" data-gallery="videos"><img src="%s" alt="%s"></a></li>',
			$video->url,
			$image,
			\__::attribute($video->post_title)
		);
	}

	private function wrapCats($cats)
	{
		if(!is_array($cats) OR !count($cats)) return '';
		return sprintf('<nav><ul>%s</ul></nav>', implode('', $cats));
	}

	private function wrapCat($cat, $class = '')
	{
		ob_start();
		?>
		<li class="<?php echo $class; ?>"><a href="#videoblock-<?php echo $cat->term_id; ?>" onclick="showVideoBlock(event, this)"><?php echo $cat->name; ?></a></li>
		<?php
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}

	/**
	 * Get testimonials
	 * @return array --- testimonials
	 */
	private function getTestimonials($cat)
	{
		$args = array(
			'posts_per_page'   => -1,
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
					'terms'    => $cat
				)
			)
		);
		$testimonials = get_posts($args);
		if(count($testimonials))
		{
			foreach ($testimonials as &$testimonial) 
			{
				$testimonial->thumbnail = (string) get_post_meta($testimonial->ID, 'ato_video_thumbnail', true);
				$testimonial->url       = (string) get_post_meta($testimonial->ID, 'ato_youtube_video_url', true);
			}
		}
		return $testimonials;
	}

	function update( $new_instance, $old_instance ) 
	{
		return $instance;
	}

	function form( $instance ) 
	{
		
	}
}