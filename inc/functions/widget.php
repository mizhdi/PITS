<?php

/**
 * Adds Foo_Widget widget.
 */
class Author_Info extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'author info', // Base ID
			__('Author Info', 'pits'), // Name
			array( 'description' => __( 'Author Info', 'pits' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
?>
		<aside class="widget sidebar-author">
			<div class="sidebar-author-img">
			<?php
				$author_email = get_the_author_meta('email');
				echo get_avatar($author_email, '80');
			?>
			</div>
			
			<span>by <?php the_author_link(); ?></span>
			<p><?php the_author_meta('description'); ?></p>

			<!-- author social -->
			<ul>
				<?php 
					if ( get_the_author_meta( 'user_url' ) ){
						echo '<li><a title="homepage" target="_blank" rel="nofollow" href="'.get_the_author_meta( 'user_url' ).'"><span class="iconfont icon-blhome"></span></a></li>';
					} 

					if ( get_the_author_meta( 'weibo' ) ){
						echo '<li><a title="weibo" target="_blank" rel="nofollow" href="'.get_the_author_meta( 'weibo' ).'"><span class="iconfont icon-iconweibo"></span></a></li>';
					} 

					if ( get_the_author_meta( 'github' ) ){
						echo '<li><a title="github" target="_blank" rel="nofollow" href="'.get_the_author_meta( 'github' ).'"><span class="iconfont icon-github"></span></a></li>';
					} 

					if ( get_the_author_meta( 'twitter' ) ){
						echo '<li><a title="twitter" target="_blank" rel="nofollow" href="'.get_the_author_meta( 'twitter' ).'"><span class="iconfont icon-twitter"></span></a></li>';
					} 

					if ( get_the_author_meta( 'google' ) ){
						echo '<li><a title="google+" target="_blank" rel="nofollow" href="'.get_the_author_meta( 'google' ).'"><span class="iconfont icon-google"></span></a></li>';
					} 

					if ( get_the_author_meta( 'facebook' ) ){
						echo '<li><a title="facebook" target="_blank" rel="nofollow" href="'.get_the_author_meta( 'facebook' ).'"><span class="iconfont icon-facebook"></span></a></li>';
					} 

					if ( get_the_author_meta( 'email' ) ){
						echo '<li><a title="email" target="_blank" href="mailto:'.get_the_author_meta( 'email' ).'"><span class="iconfont icon-email"></span></a></li>';
					}

					if ( get_the_author_meta( 'douban' ) ){
						echo '<li><a title="douban" target="_blank" rel="nofollow" href="'.get_the_author_meta( 'douban' ).'"><span class="iconfont icon-douban"></span></a></li>';
					} 

					if ( get_the_author_meta( 'linkedin' ) ){
						echo '<li><a title="linkedin" target="_blank" rel="nofollow" href="'.get_the_author_meta( 'linkedin' ).'"><span class="iconfont icon-linkedin"></span></a></li>';
					} 

					if ( get_the_author_meta( 'alipay' ) ){
						echo '<li class="dropdown"><span class="iconfont icon-zhifufangshi dropdown-toggle" data-toggle="dropdown"></span><div class="dropdown-menu"><p>' . __( 'Dimensional code scanning alipay funding', 'pits' ) . '</p><img src="'.get_the_author_meta( 'alipay' ).'"></div></li>';
					} 

					if ( get_the_author_meta( 'weixin' ) ){
						echo '<li class="dropdown"><span class="iconfont icon-weibiaoti1 dropdown-toggle" data-toggle="dropdown"></span><div class="dropdown-menu"><p>' . __( 'Dimensional code scanning weixin concern', 'pits' ) .'</p><img src="'.get_the_author_meta( 'weixin' ).'"></div></li>';
					} 
				?>
			</ul>
		</aside>
<?php
		
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Author Info', 'pits' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'pits' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Foo_Widget

// register Foo_Widget widget
function register_author_info() {
    register_widget( 'Author_Info' );
}
add_action( 'widgets_init', 'register_author_info' );

/**
 * Adds random post widget.
 */
class Random_Post extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'random_post', // Base ID
			__('Random Post', 'pits'), // Name
			array( 'description' => __( 'random post', 'pits' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	
     	extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title;
		$number = strip_tags($instance['number']) ? absint( $instance['number'] ) : 5;
?>	
		<ul>

			<?php 

				$args = array ( 
					'orderby' => 'rand', 
					'showposts' => $number,
					'caller_get_posts' => 1);

				$the_query = new WP_Query( $args ); 
			?>

			<?php if ( $the_query->have_posts() ) : ?>

				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			
				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<p><?php _e( 'Sorry, no posts here.', 'pits' ); ?></p>
			<?php endif; ?>

		</ul>

<?php
		echo $after_widget;
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Random Post', 'pits' );
		}

		global $wpdb;
		$instance = wp_parse_args((array) $instance, array('number' => '5'));
		$number = strip_tags($instance['number']);
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'pits' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number:', 'pits' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		if (!isset($new_instance['submit'])) {
			return false;
		}

		$instance = $old_instance;
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags($new_instance['number']);
		return $instance;
	}

} // class Foo_Widget

// register Foo_Widget widget
function register_random_post() {
    register_widget( 'Random_Post' );
}
add_action( 'widgets_init', 'register_random_post' );


/**
 * Adds random post widget.
 */
class Popular_Post extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'popular_post', // Base ID
			__('Popular Post', 'pits'), // Name
			array( 'description' => __( 'popular post', 'pits' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	
     	extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title;
		$number = strip_tags($instance['number']) ? absint( $instance['number'] ) : 5;
?>	
		<ul>

			<?php 

				$args = array ( 
					'orderby' => 'comment_count', 
					'showposts' => $number,
					'caller_get_posts' => 1);

				$the_query = new WP_Query( $args ); 
			?>

			<?php if ( $the_query->have_posts() ) : ?>

				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			
				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<p><?php _e( 'Sorry, no posts here.', 'pits' ); ?></p>
			<?php endif; ?>

		</ul>

<?php
		echo $after_widget;
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Popular Post', 'pits' );
		}

		global $wpdb;
		$instance = wp_parse_args((array) $instance, array('number' => '5'));
		$number = strip_tags($instance['number']);
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'pits' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number:', 'pits' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		if (!isset($new_instance['submit'])) {
			return false;
		}

		$instance = $old_instance;
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags($new_instance['number']);
		return $instance;
	}

} // class Foo_Widget

// register Foo_Widget widget
function register_popular_post() {
    register_widget( 'Popular_Post' );
}
add_action( 'widgets_init', 'register_popular_post' );


// sidebar
if (function_exists('register_sidebar')) {

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'pits' ),
		'id'            => 'sidebar-index',
		'description'   => __( 'except page of single', 'pits' ),
		'before_widget' => '<aside class="widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	) );

	register_sidebar( array(
		'name'          => __( 'Standard Sidebar', 'pits' ),
		'id'            => 'sidebar-standard',
		'description'   => __( 'Standard Sidebar', 'pits' ),
		'before_widget' => '<aside class="widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	) );

	register_sidebar( array(
		'name'          => __( 'Quote Sidebar', 'pits' ),
		'id'            => 'sidebar-quote',
		'description'   => __( 'Quote Sidebar', 'pits' ),
		'before_widget' => '<aside class="widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	) );

	register_sidebar( array(
		'name'          => __( 'Link Sidebar', 'pits' ),
		'id'            => 'sidebar-link',
		'description'   => __( 'Link Sidebar', 'pits' ),
		'before_widget' => '<aside class="widget">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	) );

}

	// hot post
	// function widget_hot() {
	// 	get_template_part( 'widget/hot.php' );
	// }

	// wp_register_sidebar_widget(
	//     'pits-hot',        // your unique widget id
	//     'Pouplar Posts (1)',          // widget name
	//     'widget_hot',  // callback function
	//     array(                  // options
	//         'description' => 'hot posts'
	//     )
	// );

	// // author info
	// function widget_author() {
	// 	get_template_part( 'widget/author.php' );
	// }

	// wp_register_sidebar_widget(
	//     'pits-author',        // your unique widget id
	//     __( 'Author Info (1)', 'pits' ),          // widget name
	//     'widget_author',  // callback function
	//     array(                  // options
	//         'description' => 'a widget author infomation'
	//     )
	// );


?>