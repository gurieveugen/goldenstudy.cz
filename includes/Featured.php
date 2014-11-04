<?php

class Featured{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{

	}

	/**
	 * Get featured post
	 * @param  array  $args --- query arguments
	 * @return array --- featured post
	 */
	public function getFeatured($args = array())
	{
		$defaults = array(
			'posts_per_page'   => 1,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'post_type'        => 'post',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true,
			'meta_query' => array(
				array(
					'key'   => 'apo_on_front_page',
					'value' => 'on',
				)
			)
		);

		$args  = array_merge($defaults, $args);
		$posts = get_posts($args);
		if(count($posts) == 1) return $posts[0]; 
		return $posts;
	}

	/**
	 * Wrap featured post
	 * @param  object $f --- featured post object
	 * @return string --- HTML code
	 */
	public function wrapFeatured($f)
	{
		$thumb = 'http://placehold.it/232x192';
		if(has_post_thumbnail($f->ID))
		{
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($f->ID), 'featured');
			$thumb = is_array($thumb) ? $thumb[0] : 'http://placehold.it/232x192';
		}
	    $sub   = (string) get_post_meta($f->ID, 'apo_subtitle', true);
	    ob_start();
	    ?>
	    	<article class="featured">
	    		<h1><?php echo $f->post_title; ?></h1>
	    		<div class="subtitle">
	    			<span class="titile"><?php echo $sub; ?></span>
	    			<span class="date"><?php echo date('d.m.Y', strtotime($f->post_date)); ?></span>
	    		</div>
	    		<div class="featured-holder">
	    			<img src="<?php echo $thumb; ?>" class="thumbnail" alt="<?php echo \__::attribute($f->post_title); ?>">
	    			<div class="txt">
	    				<?php echo $f->post_content; ?>	
	    			</div>
	    		</div>
	    	</article>
	    <?php
	    $var = ob_get_contents();
	    ob_end_clean();
	    return $var;
	}

}