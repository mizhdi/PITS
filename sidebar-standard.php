<!-- sidebar -->
<div id="sidebar" class="standard" role="complementary">

	<?php 
		if ( is_active_sidebar( 'sidebar-standard' ) ) : 
			dynamic_sidebar( 'sidebar-standard' );
		endif;
	?>

</div>