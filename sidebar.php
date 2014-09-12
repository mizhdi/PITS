<!-- sidebar -->
<div id="sidebar" role="complementary">

	<?php 
		if ( is_single() ) : 
			if ( is_active_sidebar( 'sidebar-single' ) ) : 
				dynamic_sidebar( 'sidebar-single' );
			endif;
		else : 
			if ( is_active_sidebar( 'sidebar-index' ) ) : 
				dynamic_sidebar( 'sidebar-index' );
			endif;
		endif;
	?>

</div>