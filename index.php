<?php get_header(); ?>

<!-- content -->
<div id="content">

	<?php 
		if ( is_home() ):
			include 'modules/slide.php';
		endif;
	?>

	<!-- post loop -->
	<?php

		include 'modules/sticky.php'; 

		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'content' );

			endwhile; 
			
		else: get_template_part( 'content', 'none' );

		endif; 

		//page nav 
		include 'modules/pagenav.php';
	?>

</div> <!-- content end -->

<?php get_sidebar(); 
	  get_footer(); ?>

			