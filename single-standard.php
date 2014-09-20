	<?php 

		// breadcrumbs
		$crumb = of_get_option('breadcrumbs');

		if ( $crumb == 'open' ) : 
			breadcrumbs();
		endif;

		get_template_part( 'content' );
	
		//author 
		$author =  of_get_option( 'author_info' );

		if ( $author == 'open' ) {
			get_template_part( 'modules/author' );
		}

		// related
		$type =  of_get_option( 'relate_posts' );

		if ( $type != 'close') {
			if ( $type == "list" ) {
				get_template_part( 'modules/related' );
			} else {
				posts_related();
			}
		}

		// post nav
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

		// comments
		comments_template();

	?>
</div>

<?php get_sidebar( 'standard' ); ?>