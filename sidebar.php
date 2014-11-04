<?php
if(is_active_sidebar('sidebar_front_page'))
{
	?>
	<div class="sidebar-front-page">
	<?php
	dynamic_sidebar('sidebar_front_page'); 	
	?>
	</div><!-- /.sidebar-front-page -->
	<?php
} 
