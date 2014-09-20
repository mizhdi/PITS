<!-- sidebar -->
<div id="sidebar" role="complementary">

	<?php 
		if ( is_single() ) : 
			if ( is_active_sidebar( 'sidebar-standard' ) ) : 
				dynamic_sidebar( 'sidebar-standard' );
			endif;
		else : 
			if ( is_active_sidebar( 'sidebar-index' ) ) : 
				dynamic_sidebar( 'sidebar-index' );
			endif;
		endif;
	?>

</div>