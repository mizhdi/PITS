<?php 

	get_header();
	
	$post = $wp_query->post; 

	$cat = of_get_option('select-category');

	$modal = of_get_option('select-template', 'content');
	
	if ( in_category($cat) ) { 

		include(TEMPLATEPATH . '/single-'.$modal.'.php'); 

	} else { 
	
		$module =  of_get_option( 'single-module', 'content');

		get_template_part( $module );

	} 

	get_footer();

?>



			