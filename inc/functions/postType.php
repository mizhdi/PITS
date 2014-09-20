<?php 

  // custom post type 
	function post_type_words() {
    register_post_type('invite', 
      array( 
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => false,
        'labels'=>array(
          'name' => _x('words', 'post type general name', 'pits'),
          'singular_name' => _x('words', 'post type singular name', 'pits'),
          'add_new' => _x('add new words', 'words', 'pits'),
          'add_new_item' => __('add new words item', 'pits'),
          'edit_item' => __('edit words', 'pits'),
          'new_item' => __('new words', 'pits'),
          'view_item' => __('view words', 'pits'),
          'search_items' => __('search words', 'pits'),
          'not_found' =>  __('not found words', 'pits'),
          'not_found_in_trash' => __('not_found_in_trash', 'pits'), 
          'parent_item_colon' => ''),
        'show_ui' => true,
        'menu_position'=>5,
        'supports' => array(
          'title',
          'author', 
          'excerpt',
          'thumbnail',
          'trackbacks',
          'editor', 
          'comments',
          'custom-fields',
          'revisions' ) ,
        'show_in_nav_menus' => true ,
        'taxonomies' => array(  
          'menutype',
          'post_tag')
      ) 
    ); 
	} 

  add_action('init', 'post_type_words');

?>