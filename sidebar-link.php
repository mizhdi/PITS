<!-- sidebar -->
<div id="sidebar" class="link" role="complementary">

	<?php get_template_part( 'widget/list' ); ?>

	<?php 
		if ( is_active_sidebar( 'sidebar-link' ) ) : 
			dynamic_sidebar( 'sidebar-link' );
		endif;
	?>

	
</div>