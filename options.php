<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Background Defaults
	$background_defaults = array(
		'color' => '#fff',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll',
		'size'=>'auto' );

	$test_array  = array(
		'open' => __('open', 'pits'),
		'close' => __('close', 'pits'));

	$type_array  = array(
		'content' => 'content',
		'list' => 'list',
		'full' => 'full',
		'simple' => 'simple' );

	$related_array  = array(
		'close' => __('close', 'pits'),
		'list' => __('list', 'pits'),
		'thumb' => __('thumb', 'pits'));

	$typography_defaults = array(
		'size' => '20px',
		'face' => 'sans-serif',
		'style' => 'normal',
		'color' => '#lalala' );

	$thumb_array  = array(
		'business' => __('business', 'pits'),
		'fashion' => __('fashion', 'pits'),
		'life' => __('life', 'pits'),
		'nature' => __('nature', 'pits'),
		'technic' => __('technic', 'pits'),
		'wide' => __('wide', 'pits'),
		'close' => __('close', 'pits'));

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20','25','30'),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','500' => '500','bold' => 'Bold','bolder' => 'Bolder' ),
		'color' => true
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/assets/images/admin/';

	$options = array();

	// 网站相关
	$options[] = array(
		'name' => __('Site', 'pits'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Description', 'pits'),
		'desc' => __('site description for seo', 'pits'),
		'id' => 'site_description',
		'std' => 'this is a wordpress theme ',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Keyword', 'pits'),
		'desc' => __('site keywords for seo', 'pits'),
		'id' => 'site_keyword',
		'std' => 'blog,whilte,wordpress',
		'type' => 'textarea');

	$options[] = array(
		'name' => __("Site color", 'pits'),
		'desc' => __("almost five color", 'pits'),
		'id' => "site_color",
		'std' => "grey",
		'type' => "images",
		'options' => array(
			'pink' => $imagepath . 'pink.jpg',
			'orange' => $imagepath . 'orange.jpg',
			'green' => $imagepath . 'green.jpg',
			'lime' => $imagepath . 'lime.jpg',
			'blue' => $imagepath . 'blue.jpg',
			'brown' => $imagepath . 'brown.jpg',
			'grey' => $imagepath . 'grey.jpg',
			'black' => $imagepath . 'black.jpg'));

	$options[] = array(
		'name' =>  __('Site background', 'pits'),
		'desc' => __('just a white background, if you don\'t set up', 'pits' ),
		'id' => 'body_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => __('Content opacity', 'pits'),
		'desc' => __('set up content opacity', 'pits'),
		'id' => 'content_opacity',
		'std' => 'rgba(255,255,255,1)',
		'class' => 'large',
		'type' => 'text');

	$options[] = array(
		'name' => __('Site logo', 'pits'),
		'desc' => __('set color, font', 'pits'),
		'id' => "logo_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options );

	$options[] = array(
		'name' => __('Favicon', 'pits'),
		'desc' => __('upload site favicon image', 'pits'),
		'id' => 'favicon',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Site Statistics', 'pits'),
		'desc' => __('Statistics code, no script, copy the contet in <script>', 'pits'),
		'id' => 'site_tongji',
		// 'std' => 'example: use baidu code',
		'type' => 'textarea');

	//首页配置
	$options[] = array(
		'name' => __('Home', 'pits'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Slideshow', 'pits'),
		'desc' => __('all sticky posts', 'pits'),
		'id' => 'slide_show',
		'std' => 'close',
		'type' => 'radio',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Stiky post', 'pits'),
		'desc' => __('show one of stiky posts', 'pits'),
		'id' => 'sticky_posts',
		'std' => 'close',
		'type' => 'radio',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Index post thumb', 'pits'),
		'desc' => __('carefully open this', 'pits'),
		'id' => 'index_thumbnail',
		'std' => 'close',
		'type' => 'radio',
		'options' => $thumb_array);

	$options[] = array(
		'name' => __('Infinitescroll', 'pits'),
		'desc' => __('next page buttun', 'pits'),
		'id' => 'infinite_scroll',
		'std' => 'close',
		'type' => 'radio',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Footer Menu', 'pits'),
		'desc' => __('show or hide footer menu', 'pits'),
		'id' => 'footer_menu',
		'std' => 'close',
		'type' => 'radio',
		'options' => $test_array);

	// 高级设置
	$options[] = array(
		'name' => __('Function', 'pits'),
		'type' => 'heading');

	// $options[] = array(
	// 	'name' => __("Article template", 'pits'),
	// 	'desc' => __("four single page model, one of them configurable", 'pits'),
	// 	'id' => "single-module",
	// 	'std' => "single-simple",
	// 	'type' => "images",
	// 	'options' => array(
	// 		'single-simple' => $imagepath . 'simple.png',
	// 		'single-content' => $imagepath . 'content.png',
	// 		'single-full' => $imagepath . 'full.png',
	// 		'single-list' => $imagepath . 'list.png'));

	// if ( $options_categories ) {
	// $options[] = array(
	// 	'name' => __('Select category', 'pits'),
	// 	'desc' => __('select category and select template', 'pits'),
	// 	'id' => 'select-category',
	// 	'type' => 'select',
	// 	'options' => $options_categories);
	// }

	// $options[] = array(
	// 	'name' => __('Select template', 'pits'),
	// 	'desc' => __('choose a single template for a category', 'pits'),
	// 	'id' => 'select-template',
	// 	'std' => 'content',
	// 	'type' => 'select',
	// 	'options' => $type_array);

	$options[] = array(
		'name' => __("Sidebar Module", 'pits'),
		'desc' => __("choose left-sidebar or right-sidebar", 'pits'),
		'id' => "sidebar-module",
		'std' => "right-sidebar",
		'type' => "images",
		'options' => array(
			'left-sidebar' => $imagepath . 'left.png',
			'right-sidebar' => $imagepath . 'right.png'));

	$options[] = array(
		'name' => __('Breadcrumbs', 'pits'),
		'desc' => __('open or close, close by default', 'pits'),
		'id' => 'breadcrumbs',
		'std' => 'close',
		'type' => 'radio',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Post Nav', 'pits'),
		'desc' => __('open or close previous and next post links', 'pits'),
		'id' => 'posts_nav',
		'std' => 'close',
		'type' => 'radio',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Author Info', 'pits'),
		'desc' => __('open or close', 'pits'),
		'id' => 'author_info',
		'std' => 'close',
		'type' => 'radio',
		'options' => $test_array);

	$options[] = array(
		'name' => __('Related', 'pits'),
		'desc' => __('none, list or thunb', 'pits'),
		'id' => 'relate_posts',
		'std' => 'close',
		'type' => 'radio',
		'options' => $related_array);

	// 社交设置
	$options[] = array(
		'name' => __('Social', 'pits'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Weibo', 'pits'),
		'desc' => __('weibo url', 'pits'),
		'id' => 'social_weibo',
		'class' => 'large',
		'type' => 'text');

	$options[] = array(
		'name' => __('RSS', 'pits'),
		'desc' => __('rss url', 'pits'),
		'id' => 'social_rss',
		'class' => 'large',
		'type' => 'text');

	// $options[] = array(
	// 	'name' => __('weixin_qrcode', 'pits'),
	// 	'desc' => __('upload weixin qrcode image', 'pits'),
	// 	'id' => 'weixin_qrcode',
	// 	'type' => 'upload');

	// $options[] = array(
	// 	'name' => __('alipay', 'pits'),
	// 	'desc' => __('upload alipay qrcode image', 'pits'),
	// 	'id' => 'alipay_qrcode',
	// 	'type' => 'upload');
	
	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	// $wp_editor_settings = array(
	// 	'wpautop' => true, // Default
	// 	'textarea_rows' => 5,
	// 	'tinymce' => array( 'plugins' => 'wordpress' )
	// );

	// $options[] = array(
	// 	'name' => __('Default Text Editor', 'options_framework_theme'),
	// 	'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'options_framework_theme' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
	// 	'id' => 'example_editor',
	// 	'type' => 'editor',
	// 	'settings' => $wp_editor_settings );

	return $options;
}