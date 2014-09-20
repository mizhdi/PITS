<?php 

	get_header();

	$format = get_post_format();

	echo '<div id="content" class="'.$format.'">';
	
	if ( have_posts() ):
	
		while ( have_posts() ) : the_post();

			if ( false === $format ) {
				$format = 'standard';
			}

			get_template_part( 'single', $format );

		endwhile; 

	else: get_template_part( 'content', 'none');

	endif;
	
	get_footer();

?>



			