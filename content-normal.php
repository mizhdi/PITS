<!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header>

		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

		<p class="entry-meta">
			<?php _e('Post On: ', 'pits'); ?>  <?php the_time( 'Y-m-d' ) ?> 
		</p>

	</header>

	<div class="entry-content arty">
		
		<?php 
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'pits' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>

	</div>
		

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>

</article>
