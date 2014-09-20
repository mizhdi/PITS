<?php

  if ( function_exists( 'add_theme_support' ) ) { 

    add_theme_support( 'post-thumbnails' );

    set_post_thumbnail_size( 255, 170, true ); // default Post Thumbnail dimensions (cropped)

    // additional image sizes
    // delete the next line if you do not need additional image sizes
    add_image_size( 'slide-thumb', 756, 9999, true ); //300 pixels wide (and unlimited height)
}


/***
function post_thumbnail( $width = 255,$height = 170 ) {

  global $post;

  if ( has_post_thumbnail() ) {
		$domsxe = simplexml_load_string(get_the_post_thumbnail());
		$thumbnailsrc = $domsxe->attributes()->src;
		echo '<img width="'.$width.'" height="'.$height.'" src="'.$thumbnailsrc.'" alt="'.trim(strip_tags( $post->post_title )).'" />';
 
  } else {
		$content = $post->post_content;
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
		$n = count($strResult[1]);

		if($n > 0){
			echo '<img width="'.$width.'" height="'.$height.'" src="'.$strResult[1][0].'" alt="'.trim(strip_tags( $post->post_title )).'" />';
      
		} else {
			$random = mt_rand(1, 40);
			echo '<img width="'.$width.'" height="'.$height.'" src="'.get_bloginfo('template_url').'/assets/images/random/business/'.$random.'.jpg" alt="'.trim(strip_tags( $post->post_title )).'" />';
     
		}
  }
}

**/

function index_thumbnail( $width = 255,$height = 170 ) {

  global $post;

  $type = of_get_option( 'index_thumbnail' );
  $random = mt_rand(1, 40);

  if ( $type !== 'close' ) {
    echo '<div class="entry-thumb">';
    echo '<img class="lazy" width="'.$width.'" height="'.$height.'" data-src="'.get_bloginfo('template_url').'/assets/images/random/'.$type.'/'.$random.'.jpg" alt="'.trim(strip_tags( $post->post_title )).'" />';
    echo '<noscript><img src="'.get_bloginfo('template_url').'"/assets/images/random/'.$type.'/'.$random.'.jpg width="'.$width.'" height="'.$height.'></noscript>';
    echo '</div>';
  }
}


?>