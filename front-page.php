<?php get_header(); ?>
<section class="main-section">
	<?php 
	$featured = new Featured();
	$f = $featured->getFeatured();
	echo $featured->wrapFeatured($f);
	get_sidebar(); 
	get_sidebar('bottom-left');
	get_sidebar('bottom-right');
	?>	
</section>
<?php get_footer(); ?>
