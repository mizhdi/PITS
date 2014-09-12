<div class="author-info">
	<?php
		$author_email = get_the_author_email();
		echo get_avatar($author_email, '80');
	?>
	<span><?php _e('Author', 'pits'); ?></span><?php the_author_link(); ?>
	<p><?php the_author_description(); ?></p>
	
</div>