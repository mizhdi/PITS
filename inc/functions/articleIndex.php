<?php

	function article_index() {
    global $post;

    $matches = array();
    $ul_li = '';
    $index = '';
    $content = $post->post_content;

    $r = "/<h3>([^<]+)<\/h3>/im";

    if(preg_match_all($r, $content, $matches)) {

      foreach($matches[1] as $num => $title) {
        $title = trim(strip_tags($title));
        $content = str_replace($matches[0][$num], '<h3 id="title-'.$num.'">'.$title.'</h3>', $content);
        $ul_li .= '<li><a href="#title-'.$num.'" title="'.$title.'">'.$title."</a></li>\n";
      }

      $index = '<aside class="widget sidebar-list pin"><div id="article-index">
                <h3>'.__( 'Post Index', 'pits' ).'</h3><ul class="nav">' . $ul_li . '</ul></div></aside>';
    }

    echo $index;
  }

  function article_miaodian($content) {

    $matches = array();
    $ul_li = '';

    $r = "/<h3>([^<]+)<\/h3>/im";

    if(preg_match_all($r, $content, $matches)) {
      foreach($matches[1] as $num => $title) {
        $title = trim(strip_tags($title));
        $content = str_replace($matches[0][$num], '<h3 id="title-'.$num.'">'.$title.'</h3>', $content);
      }
    }

    return $content;
  }

  add_filter( 'the_content', 'article_miaodian' );
   
?>