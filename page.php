<?php get_header(); ?>
<section class="main-section page">
	<div class="page-content">
		<?php 
		the_post();
		$title = get_the_title();
		$title = $title != '' ? sprintf('<h1 class="page-title">%s</h1>', $title) : '';
		echo $title;
		if(has_post_thumbnail())
		{
			echo '<div class="thumbnail">';
			the_post_thumbnail('full');
			echo '</div>';
		}
		the_content();
		
		?>		
	</div>
	<?php get_sidebar('right'); ?>
</section>
<?php get_footer(); ?>
