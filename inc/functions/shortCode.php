<?php

  function infobox($atts, $content=null, $code="") {
    $return = '<div class="text-info">';
    $return .= $content;
    $return .= '</div>';
    return $return;
  }
  add_shortcode('info' , 'infobox' );

  function warningbox($atts, $content=null, $code="") {
    $return = '<div class="text-warning">';
    $return .= $content;
    $return .= '</div>';
    return $return;
  }
  add_shortcode('warning' , 'warningbox' );

  function validbox($atts, $content=null, $code="") {
    $return = '<div class="text-valid">';
    $return .= $content;
    $return .= '</div>';
    return $return;
  }
  add_shortcode('valid' , 'validbox' );

  function errorbox($atts, $content=null, $code="") {
    $return = '<div class="text-error">';
    $return .= $content;
    $return .= '</div>';
    return $return;
  }
  add_shortcode('error' , 'errorbox' );

  function defaultbtn($atts, $content=null, $code="") {
    $return = '<div class="default-btn">';
    $return .= $content;
    $return .= '</div>';
    return $return;
  }
  add_shortcode('btn' , 'defaultbtn' );

  function colorbtn($atts, $content=null, $code="") {
    $return = '<div class="color-btn">';
    $return .= $content;
    $return .= '</div>';
    return $return;
  }
  add_shortcode('btn-c' , 'colorbtn' );

  // add more buttons to the html editor
  function appthemes_add_quicktags() {
    if (wp_script_is('quicktags')){
  ?>

    <script type="text/javascript">
      QTags.addButton( 'infobox', 'info', '[info]', '[/info]' );
      QTags.addButton( 'warningbox', 'warning', '[warning]', '[/warning]' );
      QTags.addButton( 'validbox', 'valid', '[valid]', '[/valid]' );
      QTags.addButton( 'errorbox', 'error', '[error]', '[/error]' );
      QTags.addButton( 'defaultbtn', 'btn', '[btn]', '[/btn]' );
      QTags.addButton( 'colorbtn', 'colorbtn', '[btn-c]', '[/btn-c]' );
    </script>

  <?php
    }
  }
  add_action( 'admin_print_footer_scripts', 'appthemes_add_quicktags' );

?>
