<!-- sidebar -->
<div id="sidebar" class="simple" role="complementary">
	

	<?php include 'widget/author.php'; ?>

	<?php 
		if ( is_active_sidebar( 'sidebar-simple' ) ) : 
			dynamic_sidebar( 'sidebar-simple' );
		endif;
	?>

</div>