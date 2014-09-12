<?php

// to do duan daima

// include options framework
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

/** 
 * Languages Init
 */
function theme_languages_init(){
  load_theme_textdomain('pits', get_template_directory() . '/languages');
}
add_action ('init', 'theme_languages_init');


// nav_menu
if(function_exists('register_nav_menus')){

	register_nav_menus( array(
		'primary' => __( 'primary menu', 'pits' )
	));
  
}


// widget

// hot post
function widget_hot() {
  include(TEMPLATEPATH . "/widget/hot.php");
}

if( function_exists( 'register_sidebar_widget' ) ) {   
  register_sidebar_widget(__( 'Pouplar Posts (1)', 'pits' ), 'widget_hot');   
}  

// author info
function widget_author() {
  include(TEMPLATEPATH . "/widget/author.php");
}

if( function_exists( 'register_sidebar_widget' ) ) {   
  register_sidebar_widget(__( 'Author Infomation (1)', 'pits' ), 'widget_author');   
}

// todo: site social


// sidebar
if (function_exists('register_sidebar')){

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'pits' ),
		'id'            => 'sidebar-index',
		'description'   => __( 'except page of single', 'pits' ),
		'before_widget' => '<aside class="widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'pits' ),
		'id'            => 'sidebar-single',
		'description'   => __( 'for single-content', 'pits' ),
		'before_widget' => '<aside class="widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Author Sidebar', 'pits' ),
		'id'            => 'sidebar-simple',
		'description'   => __( 'for single-simple', 'pits' ),
		'before_widget' => '<aside class="widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );

  register_sidebar( array(
    'name'          => __( 'List Sidebar', 'pits' ),
    'id'            => 'sidebar-list',
    'description'   => __( 'for single-list', 'pits' ),
    'before_widget' => '<aside class="widget">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ) );

}

// remove head
remove_action( 'wp_head',   'wp_generator' ); 
wp_deregister_script( 'l10n' ); 

add_filter('show_admin_bar','hide_admin_bar');
function hide_admin_bar($flag) {
    return false;
}

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


//post_thumbnail
add_theme_support( 'post-thumbnails' );

set_post_thumbnail_size(255, 170, true); 


function post_thumbnail( $width = 255,$height = 170 ) {

    global $post;

    // <img class="lazy" data-src="lazy.jpg" width="100" height="100">
    // '<noscript><img src="lazy.jpg" width="'.$width.'" height="'.$height.'></noscript>'

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
      printf( __( '<h1>Monthly Archives: %s</h1>', 'pits' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );

    elseif ( is_year() ) :
      printf( __( '<h1>Yearly Archives: %s</h1>', 'pits' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );

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


add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
) );


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

      $index = "<aside class=\"widget sidebar-list pin\">\n<div id=\"article-index\">
                     <h3>文章目录</h3>
                     <ul class=\"nav\">\n" . $ul_li . "</ul>
                  </div>\n</aside>";
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


// // custom post type 
// function post_type_words() {
//     register_post_type('invite', 
//         array( 
//             'public' => true,
//             'publicly_queryable' => true,
//             'hierarchical' => false,
//             'labels'=>array(
//                 'name' => _x('words', 'post type general name', 'pits'),
//                 'singular_name' => _x('words', 'post type singular name', 'pits'),
//                 'add_new' => _x('add new words', 'words', 'pits'),
//                 'add_new_item' => __('add new words item', 'pits'),
//                 'edit_item' => __('edit words', 'pits'),
//                 'new_item' => __('new words', 'pits'),
//                 'view_item' => __('view words', 'pits'),
//                 'search_items' => __('search words', 'pits'),
//                 'not_found' =>  __('not found words', 'pits'),
//                 'not_found_in_trash' => __('not_found_in_trash', 'pits'), 
//                 'parent_item_colon' => ''
//                 ),
//             'show_ui' => true,
//             'menu_position'=>5,
//             'supports' => array(
//                 'title',
//                 'author', 
//                 'excerpt',
//                 'thumbnail',
//                 'trackbacks',
//                 'editor', 
//                 'comments',
//                 'custom-fields',
//                 'revisions' ) ,
//             'show_in_nav_menus' => true ,
//             'taxonomies' => array(  
//                 'menutype',
//                 'post_tag')
//             ) 
//         ); 
// } 

// add_action('init', 'post_type_words');


// /* Gavatar 头像缓存 */
// function get_cavatar($source) {
//     $time = 1209600; //The time of cache(seconds)
//     preg_match('/avatar\/([a-z0-9]+)\?s=(\d+)/',$source,$tmp);
//     $abs = ABSPATH.'avatar/'.$tmp[1].'.jpg';
//     $url = get_bloginfo('wpurl').'/avatar/'.$tmp[1].'.jpg';
//     $default = get_bloginfo('wpurl').'/avatar/'.'default.jpg';
//     if (!is_file($abs)||(time()-filemtime($abs))>$time){
//         copy('http://www.gravatar.com/avatar/'.$tmp[1].'?s=64&d='.$default.'&r=G',$abs);
//     }
//     if (filesize($abs)<500) { copy($default,$abs); }
//         return '<img alt="" src="'.$url.'" width="'.$tmp[2].'" height="'.$tmp[2].'" />';
// }

// add_filter('get_avatar','get_cavatar');


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


//获取并输入某个分类的子分类,按分类获取文章的类型时用到
function post_is_in_descendant_category( $cats, $_post = null )
{
  foreach ( (array) $cats as $cat ) {
    // get_term_children() accepts integer ID only
    $descendants = get_term_children( (int) $cat, 'category');
    if ( $descendants && in_category( $descendants, $_post ) )
      return true;
  }
  return false;
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
      // 12 * 30 * 24 * 60 * 60  =>  ' years ago',
      //   30 * 24 * 60 * 60       =>  ' months ago',
      //   7 * 24 * 60 * 60        =>  ' weeks ago',
      //   24 * 60 * 60            =>  ' days ago',
      //   60 * 60                 =>  ' hours ago',
      //   60                      =>  ' minutes ago',
      //   1                       =>  ' seconds ago'
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
            post_thumbnail();
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
    <?php printf( __( '<span class="fn">%s</span>' ), get_comment_author_link() ); ?> • <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
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