<aside class="widget sidebar-author pin">

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