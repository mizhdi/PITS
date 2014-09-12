<?php get_header(); ?>

<!-- content -->
<div id="content" class="content">

	<?php 

		// breadcrumbs
		$crumb = of_get_option('breadcrumbs');

		if ( $crumb == 'open' ) : 
			breadcrumbs();
		endif;
	
		// post loop
		if ( have_posts() ) :
		while ( have_posts() ) : the_post();
	
			get_template_part( 'content' );
	 
		endwhile; 
		
		else: get_template_part( 'content', 'none');

		endif; 


		//author 
		$author =  of_get_option( 'author_info' );

		if ( $author == 'open' ) {
			include 'modules/author.php';
		}

		// related
		$type =  of_get_option( 'relate_posts' );

		if ( $type != 'close') {
			if ( $type == "list" ) {
				include 'modules/related.php';
			} else {
				posts_related();
			}
		}

		$nav = of_get_option( 'posts_nav' );
		
		if ( $nav == 'open' ) {
			echo '<div class="post-nav">';
			// pre-next-post
			if (get_previous_post()) :
				previous_post_link('<p>%link</p>');
			else : 
				echo '<p class="disabled">'. __( 'No, this is the last article', 'pits') .'</p>';
			endif;

			if (get_next_post()) :
				next_post_link('<p>%link</p>'); 
			else :
				echo '<p class="disabled">'. __( 'No, already the latest articles', 'pits') .'</p>';
			endif;

			echo '</div>';
		}

		// comment form
		comments_template();
	?>

</div>

<?php get_sidebar( 'content' );
	  get_footer(); ?>