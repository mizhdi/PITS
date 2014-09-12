<!-- sidebar -->
<div id="sidebar" class="content" role="complementary">

	<?php 
		if ( is_active_sidebar( 'sidebar-single' ) ) : 
			dynamic_sidebar( 'sidebar-single' );
		endif;
	?>

</div>