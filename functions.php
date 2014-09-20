<?php

// include options framework
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

if ( ! isset( $content_width ) ) $content_width = 1080;

require get_template_directory() . '/inc/functions/widget.php';

require get_template_directory() . '/inc/functions/articleIndex.php';

// require get_template_directory() . '/inc/functions/postType.php';

require get_template_directory() . '/inc/functions/thumbnail.php';

require get_template_directory() . '/inc/functions/shortCode.php';

// $defaults = array(
//   'default-image'          => '',
//   'random-default'         => false,
//   'width'                  => 0,
//   'height'                 => 0,
//   'flex-height'            => false,
//   'flex-width'             => false,
//   'default-text-color'     => '',
//   'header-text'            => true,
//   'uploads'                => true,
//   'wp-head-callback'       => '',
//   'admin-head-callback'    => '',
//   'admin-preview-callback' => '',
// );
// add_theme_support( 'custom-header', $defaults );

// $defaults = array(
//   'default-color'          => '',
//   'default-image'          => '',
//   'wp-head-callback'       => '_custom_background_cb',
//   'admin-head-callback'    => '',
//   'admin-preview-callback' => ''
// );
// add_theme_support( 'custom-background', $defaults );

add_theme_support( 'html5', array(
  'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
) );

add_theme_support( 'automatic-feed-links' ); 

// add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'quote', 'status') );

add_theme_support( 'post-formats', array( 'link', 'quote', 'status') );

function my_theme_add_editor_styles() {
  add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );

// Languages Init
function theme_languages_init(){
  load_theme_textdomain('pits', get_template_directory() . '/languages');
}
add_action ('init', 'theme_languages_init');

// nav_menu
function register_my_menus() {
  register_nav_menus(
    array(
      'primary'   => __( 'Top primary menu', 'pits' ),
      'secondary' => __( 'Secondary menu in footer', 'pits' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

// remove head
remove_action( 'wp_head',   'wp_generator' ); 
wp_deregister_script( 'l10n' ); 

add_filter('show_admin_bar','hide_admin_bar');
function hide_admin_bar($flag) {
  return false;
}

// body style custom body img
function body_style() {

  $background = of_get_option('body_background');

  if ($background) {

    if ($background['image']) {

      echo 'style="background-image:url('.$background['image'].');background-position:'.$background['position'].
        ';background-repeat:'.$background['repeat'].';background-attachment:'.$background['attachment'].';background-size:'.$background['size'].';background-color:'.$background['color'].';"';
    }
  }
}


// logo 
function logo_style() {
  $typography = of_get_option('logo_typography');
    if ( $typography ) {
      echo 'style="font-family: '.$typography['face'].'; font-size:'.$typography['size'].'; font-style: '.$typography['style'].'; color:'.$typography['color'].';"';
    }
}

function wrap_class() {
  $background = of_get_option('body_background');

  if ($background) {

    if ($background['image']) {
      echo 'class="thumb-enable"';
    }
  }
}


function page_title() {
  if ( is_tag() ) : 
    printf( __( '<h1>Tag Archives: %s</h1>', 'pits' ), single_tag_title( '', false ) );

    $term_description = term_description();
    if ( ! empty( $term_description ) ) :
      printf( '<p>%s</p>', $term_description );
    endif;

    elseif ( is_author() ) : 
      printf( __( '<h1>All posts by %s</h1>', 'pits' ), get_the_author() );
      if ( get_the_author_meta( 'description' ) ) : 
        echo '<p>'. the_author_meta( 'description' ). '</p>';
      endif;
    
    elseif ( is_day() ) :
      printf( __( '<h1>Daily Archives: %s</h1>', 'pits' ), get_the_date() );

    elseif ( is_month() ) :
      printf( __( '<h1>Monthly Archives: %s</h1>', 'pits' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'pits' ) ) );

    elseif ( is_year() ) :
      printf( __( '<h1>Yearly Archives: %s</h1>', 'pits' ), get_the_date( _x( 'Y', 'yearly archives date format', 'pits' ) ) );

    elseif ( is_category() ) : 
      printf( __( '<h1>Category Archives: %s</h1>', 'pits' ), single_cat_title( '', false ) );
      $term_description = term_description();
      if ( ! empty( $term_description ) ) :
        printf( '<p>%s</p>', $term_description );
      endif;

    elseif ( is_search() ) : 
      printf( __( '<h1>Search Results for: %s</h1>', 'pits' ), get_search_query() );

    elseif ( is_404() ) :
       _e( 'Not Found', 'pits' );
       _e( 'It looks like nothing was found at this location. Maybe try a search?', 'pits' );
    else :
      _e( 'Archives', 'pits' );
  endif;
}
   

//breadcrumbs
function breadcrumbs() {
  $delimiter = ' / '; 
  $before = '<span class="current">'; 
  $after = '</span>'; 
  if ( !is_home() && !is_front_page() || is_paged() ) {
    echo '<div itemscope itemtype="http://schema.org/WebPage" id="crumbs">'.__( '' , 'pis' );
    global $post;
    $homeLink = home_url();
    echo '<span class="iconfont icon-wodezhuye"></span><a itemprop="breadcrumb" href="' . $homeLink . '">' . __( 'Home' , 'pits' ) . '</a> ' . $delimiter . ' ';
    if ( is_category() ) { 
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0){
        $cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
        echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
      }
      echo $before . '' . single_cat_title('', false) . '' . $after;
    } elseif ( is_day() ) { 
      echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a itemprop="breadcrumb"  href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
    } elseif ( is_month() ) { 
      echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
    } elseif ( is_year() ) { 
      echo $before . get_the_time('Y') . $after;
    } elseif ( is_single() && !is_attachment() ) { 
      if ( get_post_type() != 'post' ) { 
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else { 
        $cat = get_the_category(); $cat = $cat[0];
        $cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
        echo $before . get_the_title() . $after;
      }
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
    } elseif ( is_attachment() ) { 
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
    } elseif ( is_page() && !$post->post_parent ) { 
      echo $before . get_the_title() . $after;
    } elseif ( is_page() && $post->post_parent ) { 
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
    } elseif ( is_search() ) { 
      echo $before ;
      printf( __( 'Search Results for: %s', 'pits' ),  get_search_query() );
      echo  $after;
    } elseif ( is_tag() ) { 
      echo $before ;
      printf( __( 'Tag Archives: %s', 'pits' ), single_tag_title( '', false ) );
      echo  $after;
    } elseif ( is_author() ) { 
      global $author;
      $userdata = get_userdata($author);
      echo $before ;
      printf( __( 'Author: %s', 'pits' ),  $userdata->display_name );
      echo  $after;
    } elseif ( is_404() ) { 
      echo $before;
      _e( 'Not Found', 'pits' );
      echo  $after;
    }
    if ( get_query_var('paged') ) { 
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
        echo sprintf( __( '( Page %s )', 'pits' ), get_query_var('paged') );
    }
    echo '</div>';
  }
}

//customer info
add_filter( 'user_contactmethods', 'wpdaxue_add_contact_fields' );
function wpdaxue_add_contact_fields( $contactmethods ) {
  // $contactmethods['qq'] = 'qq';
  $contactmethods['mail'] = 'Mail';
  $contactmethods['weixin'] = 'Weixin(qrcode)';
  $contactmethods['weibo'] = 'Weibo';
  $contactmethods['twitter'] = 'Twitter';
  $contactmethods['github'] = 'Github';
  $contactmethods['google'] = 'Google+';
  $contactmethods['facebook'] = 'Facebook';
  $contactmethods['alipay'] = 'Alipay(qrcode)';
  $contactmethods['linkedin'] = 'Linkedin';
  $contactmethods['douban'] = 'Douban';
  unset( $contactmethods['yim'] );
  unset( $contactmethods['aim'] );
  unset( $contactmethods['jabber'] );
  return $contactmethods;
}


// time ago
function timeago( $ptime ) {
  $ptime = strtotime($ptime);
  $etime = time() - $ptime;
  if($etime < 1) return __(' a moment ago', 'pits');
  $interval = array (
    12 * 30 * 24 * 60 * 60  =>  __(' years ago', 'pits'),
    30 * 24 * 60 * 60       =>  __(' months ago', 'pits'),
    7 * 24 * 60 * 60        =>  __(' weeks ago', 'pits'),
    24 * 60 * 60            =>  __(' days ago', 'pits'),
    60 * 60                 =>  __(' hours ago', 'pits'),
    60                      =>  __(' minutes ago', 'pits'),
    1                       =>  __(' seconds ago', 'pits')
  );

  foreach ($interval as $secs => $str) {
    $d = $etime / $secs;
    if ($d >= 1) {
      $r = round($d);
      return $r . $str;
    }
  };
  
}

//post related
function posts_related(){
    global $post;
    $title='Related Articles';
    $limit=4;
    $exclude_id = $post->ID; 
    $posttags = get_the_tags(); 
    $i = 0;
    echo '<section class="related-thumb"><h3>';
    __( 'Related Articles', 'pits' );
    echo '</h3><ul>';
    if ( $posttags ) { 
        $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->name . ',';
        $args = array(
            'post_status' => 'publish',
            'tag_slug__in' => explode(',', $tags), 
            'post__not_in' => explode(',', $exclude_id), 
            'caller_get_posts' => 1, 
            'orderby' => 'comment_date', 
            'posts_per_page' => $limit
        );
        query_posts($args); 
        while( have_posts() ) { the_post();
            echo '<li><a href="'.get_permalink().'">';
            index_thumbnail();
            echo '<h4>'.get_the_title().'</h4></a></li>';
            $exclude_id .= ',' . $post->ID; $i ++;
        };
        wp_reset_query();
    }
    if ( $i < $limit ) { 
        $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
        $args = array(
            'category__in' => explode(',', $cats), 
            'post__not_in' => explode(',', $exclude_id),
            'caller_get_posts' => 1,
            'orderby' => 'comment_date',
            'posts_per_page' => $limit - $i
        );
        query_posts($args);
        while( have_posts() ) { the_post();
            echo '<li><a href="'.get_permalink().'" rel="bookmark">';
            index_thumbnail();
            echo '<h4>'.get_the_title().'</h4></a></li>';
            $i ++;
        };
        wp_reset_query();
    }
    /*if ( $i == 0 ){
        return false;
    }*/
    
    echo '</ul></section>';
}


//主题相关说明
 add_action('optionsframework_after','options_after_panel', 100);
function options_after_panel() { ?>
    <div class="metabox-holder" id="custom-panel">
       <div class="postbox">
          <h3><span><?php _e( 'Theme instructions', 'pits' ); ?></span></h3>
          <div class="inside">
            <p>本来想做一个简约风格的主题，最简单的博客那种，
            又想做一款适合大众又与众不同的主题，只有你想不到的，
            没有这款主题做不到的，慢慢摸索配置吧，你会喜欢这一切。<br>该主题是终身免费的，如果有人出售该主题对你的利益有损害的，于主题作者无关，当然你也可以通过扫描支付宝二维码捐赠作者。</p>
            <img src="http://pits.qdcode.com/wp-content/uploads/2014/09/下载-1.png" alt="">
          </div>
       </div>
    </div>
<?php
}


// Remove Open Sans that WP adds from frontend
if (!function_exists('remove_wp_open_sans')) :    
function remove_wp_open_sans() {        
  wp_deregister_style( 'open-sans' );        
  wp_register_style( 'open-sans', false );    }    
  add_action('wp_enqueue_scripts', 'remove_wp_open_sans');    
  // Uncomment below to remove from admin    
add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
endif;

//comment list
function mytheme_comment($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
  extract($args, EXTR_SKIP);

  if ( 'div' == $args['style'] ) {
    $tag = 'div';
    $add_below = 'comment';
  } else {
    $tag = 'li';
    $add_below = 'div-comment';
  }
?>
  <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
  <?php if ( 'div' != $args['style'] ) : ?>
  <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
  <?php endif; ?>
 
  <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>

  <div class="comment-time">
    <?php printf( __( '<span class="fn">%s</span>', 'pits' ), get_comment_author_link() ); ?> • <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
    <?php
      /* translators: 1: date, 2: time */
      printf( __('%1$s at %2$s', 'pits'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'pits' ), '  ', '' );
    ?>
  </div>

  <?php if ( $comment->comment_approved == '0' ) : ?>
    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'pits' ); ?></em>
    <br />
  <?php endif; ?>

  <?php comment_text(); ?>

 <!--  <div class="reply">
  <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
  </div> -->
  <?php if ( 'div' != $args['style'] ) : ?>
  </div>
  <?php endif; ?>
<?php
}