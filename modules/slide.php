<?php 

	$slide = of_get_option( 'slide_show' );

	if ( $slide == "open") {

?>
	<div id="slideshow">

	<?php
						
		$sticky = get_option( 'sticky_posts' ); 
		$args = array(
	    	'numberposts' => 5, 
	   		'post__in'  => $sticky   //置顶文章
		);
		query_posts( $args);

		while ( have_posts() ) : the_post();   
							
	?>
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
			<?php post_thumbnail(756,500); ?>
			<p><?php the_title(); ?></p>
		</a>				

	<?php endwhile; wp_reset_query(); ?>

	</div>
<?php } ?>