<aside class="widget hot-posts slide">
	<h3><?php _e( 'Hot posts', 'pits' ); ?></h3>
	<ul>
		<?php
			$args = array(
				'orderby'          => 'comment_count',
				'showposts'        => 10,
				'caller_get_posts' => 1
				);
			$query_posts = new WP_Query();
			$query_posts->query($args);
			while ($query_posts->have_posts()) : $query_posts->the_post()
		?>

		<li>
			<a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark"><?php the_title(); ?></a>
		</li>

		<?php endwhile; ?>
	</ul>

</aside>