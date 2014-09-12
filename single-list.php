<!-- content -->
<div id="content" class="list">
	<?php
	
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'simple');

			endwhile; 

		else: get_template_part( 'content', 'none');

		endif; 

		comments_template(); 
	?>

</div>

<?php get_sidebar( 'list' ); ?>