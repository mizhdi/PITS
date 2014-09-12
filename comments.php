<?php

	// 系统默认，待修改

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

	<h3>
		<?php
			printf( _n(  __('One thought on %2$s', 'pits'), __('Recent Comments (%1$s)', 'pits'), get_comments_number() ),
				number_format_i18n( get_comments_number() ), get_the_title() );
		?>
	</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'pits' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'pits' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'pits' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<ul class="comment-list">
		<?php
			wp_list_comments('avatar_size=48&type=comment&callback=mytheme_comment');
		?>
	</ul><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'pits' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'pits' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'pits' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'pits' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(array(
    	'fields' => array(
	    	'author' => '<p><label for="author"><span class="iconfont icon-author"></span></label><input type="text" aria-required="true" value="'.$comment_author.'" name="author" placeholder="author" accesskey="n"></p>',
	    	'email' => '<p><label for="email"><span class="iconfont icon-45dianziyoujian"></span></label><input type="text" aria-required="true" value="'.$comment_author_email.'" name="email" id="email" placeholder="email" accesskey="e"></p>',
	    	'url' => '<p><label for="url"><span class="iconfont icon-wangluo"></span></label><input type="text" value="'.$comment_author_url.'" name="url" id="url" placeholder="url" accesskey="u"></p>'
    	),
    	'comment_field' => '<p class="textarea"><textarea id="comment" name="comment" aria-required="true" placeholder="leave a comment..." accesskey="t"></textarea></p>'
    )); ?>

</div><!-- #comments -->
