<?php

class Logos{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{
		add_shortcode('logos', array(&$this, 'getHTML'));
	}
	
	/**
	 * Get logos box HTML
	 * @return HTML --- code
	 */
	public function getHTML()
	{
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'logo',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$logos = get_posts($args);
		$result = array();
		if(count($logos))
		{
			foreach ($logos as &$logo) 
			{
				$result[] = $this->wrapLogo($logo);
			}
			return $this->wrapLogos(implode('', $result));
		}
		return '';
	}

	/**
	 * Wrap logos to HTML
	 * @param  string $logos --- logos HTML code
	 * @return string        --- HTML code
	 */
	private function wrapLogos($logos)
	{
		return sprintf('<ul class="logos-bottom">%s</ul>', $logos);
	}

	/**
	 * Wrap single logo to HTML
	 * @param  object $logo --- post object
	 * @return string       --- HTML code
	 */
	private function wrapLogo($logo)
	{
		$img = has_post_thumbnail($logo->ID) ? \__::getThumbnailURL($logo->ID, 'thumbnail') : 'http://placehold.it/100x50';
		$url = (string) get_post_meta($logo->ID, 'alo_external_link', true); 
		$url = strlen($url) ? $url : '#';

		ob_start();
		?>
		<li>
			<a href="<?php echo $url; ?>"><img src="<?php echo $img; ?>" alt="<?php echo $logo->post_title; ?>"></a>
		</li>
		<?php
		
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}
}