<!-- sidebar -->
<div id="sidebar" class="quote" role="complementary">
	

	<?php get_template_part( 'widget/author' ); ?>

	<?php 
		if ( is_active_sidebar( 'sidebar-quote' ) ) : 
			dynamic_sidebar( 'sidebar-quote' );
		endif;
	?>

</div>