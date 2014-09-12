<!-- sidebar -->
<div id="sidebar" class="list" role="complementary">

	<?php include 'widget/list.php'; ?>

	<?php 
		if ( is_active_sidebar( 'sidebar-list' ) ) : 
			dynamic_sidebar( 'sidebar-list' );
		endif;
	?>

	
</div>