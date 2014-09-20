<!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'pits' ), admin_url( 'post-new.php' ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'pits' ); ?></p>
	<?php get_search_form(); ?>

	<p><?php _e( 'Are you ready for some popular tags?', 'pits' ); ?></p>
	<?php wp_tag_cloud('unit=px&number=10&smallest=14&largest=14&orderby=count&order=DESC'); ?>

	<?php else : ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'pits' ); ?></p>
	<?php get_search_form(); ?>

	<?php endif; ?>
</article>