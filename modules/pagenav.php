<?php 
	$nav = of_get_option( 'infinite_scroll' );
	if ( $nav == 'open' ):
?>
	<div id="navigation">	
	<?php next_posts_link( __( 'Older Entries &raquo;', 'pits' ), 0 ); ?>
	</div>

<?php 
	else:
?>
	<!-- index page nav -->
	<nav class="page-nav">

		<?php previous_posts_link( __( '&laquo; Newer Entries', 'pits' ), 0 ); ?>

		<?php next_posts_link( __( 'Older Entries &raquo;', 'pits' ), 0 ); ?>

	</nav>

<?php endif; ?>





