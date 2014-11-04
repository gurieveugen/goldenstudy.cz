<?php
$options = __::getOptions(
	array(
		'gs_address',
		'gs_phone_text'
	)
);
extract($options);
?>
	<footer class="main-footer">
		<div id="map-canvas"></div>
		<h1>Контакты</h1>
		<div class="description">
			<h2>Адрес офиса: <?php echo $gs_address; ?></h2>
			<h2>Тел.: <?php echo $gs_phone_text; ?></h2>	
		</div>
	</footer>
</div><!-- #main -->
	<?php wp_footer(); ?>
</body>
</html>