<!-- content -->
<div id="content" class="full">

	<?php
	
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'simple');
						
			endwhile; 

		else: get_template_part( 'content', 'none');

		endif; 

		include 'modules/author.php';
	?>

	<?php comments_template(); ?>
	
</div>

<!-- no sidebar -->