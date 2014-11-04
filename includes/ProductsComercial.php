<?php

class ProductsComercial extends Products{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{
		add_shortcode('products_comercial', array(&$this, 'getHTML'));
	}


	/**
	 * Wrap products to HTML
	 * @param  string $products  --- products HTML code
	 * @param  object $term      --- products term
	 * @param  string $css_class --- padding class
	 * @return string            --- HTML code
	 */
	protected function wrapProducts($products, $term, $css_class, $logos)
	{
		$css_class = 'padding-top278';
		ob_start();
		?>

		<div class="<?php echo $css_class; ?> cf">
			<?php echo getLogoProductFromCat($term->slug); ?>
			<article id="post-<?php echo $term->term_id; ?>" class="full-post post-product cf">
				<header class="tit-product">
					<h1><?php echo $term->name; ?></h1>
				</header>
				<?php echo $products; ?>
				<footer>
					<a href="/contact" class="btn-enquiry">Make an enquiry</a>
				</footer>
			</article>
			<?php echo $logos; ?>
		</div>
		<?php
		
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}

	/**
	 * Wrap single product to HTML
	 * @param  object $product --- post object
	 * @return string       --- HTML code
	 */
	protected function wrapProduct($product)
	{
		$img   = has_post_thumbnail($product->ID) ? \__::getThumbnailURL($product->ID, 'thumbnail') : 'http://placehold.it/135x119';
		$logos = $this->getAdditionalLogos($product->ID);
		ob_start();
		?>	
		<div class="img">
			<figure><img src="<?php echo $img; ?>" alt=" "></figure>
			<?php 
			if(count($logos))
			{
				foreach ($logos as $logo) 
				{
					printf('<figure>%s</figure>', $logo);
				}
			}
			?>	
		</div>
		<div class="txt">
			<?php echo $product->post_content; ?>
		</div>	
		<?php
		
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}
}