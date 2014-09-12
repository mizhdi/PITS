<?php get_header(); ?>

<!-- content -->
<div id="content">

	<div class="page-title"> <?php page_title(); ?> </div>

	<!-- post loop -->
	<?php

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

			