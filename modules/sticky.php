<!-- sitcky post -->
<?php 

	$switch = of_get_option( 'sticky_posts' );

	if ( $switch == 'open' ) {

		// var_dump($switch); exit();

	 	$sticky = get_option( 'sticky_posts' );

		$args = array(
		    'numberposts' => 1,
		    'post__in'  => $sticky
		);
		
		$postQuery = get_posts($args);

		foreach( $postQuery as $post ) : setup_postdata($post);
?>

<article id="post-<?php the_ID(); ?>" class="sticky-post">
	<div class="entry-thumb"><?php index_thumbnail(); ?></div>
	<header>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<span class="entry-meta"><i><?php _e('stick post', 'pits'); ?></i><?php _e('Posted on: ', 'pits'); ?> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></span>
	</header>
	<div class="entry-content">
	<p><?php 
			if ( has_excerpt() ) :
	 			the_excerpt(); 
			else: 
				echo wp_trim_words( get_the_content(), 180 );
			endif;
		?>
		<a href="<?php the_permalink(); ?>" rel="nofollow"><?php _e( 'Continue reading &rarr;', 'pits' ); ?></a>
	</p>
	</div>
</article>
	    
<?php  endforeach; } ?>
<!-- sitcky post end -->