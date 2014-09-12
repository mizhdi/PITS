<!-- article -->
<article id="post-<?php the_ID(); ?>">

	<?php if ( is_home() ) : index_thumbnail();	endif; ?>

	<header>

		<?php
			if ( is_single() ) :
				the_title( '<h2>', '</h2>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		?>

		<ul class="entry-meta">

			<li class="pull-right"><span class="iconfont icon-pinglun"></span><?php comments_popup_link( __( 'Leave a comment', 'pits' ), __( '1 Comment', 'pits' ), __( '% Comments', 'pits' ) ); ?></li>
			<?php if ( is_home() ) : ?>
				<li><span class="iconfont icon-shijian"></span><?php the_time( 'Y-m-d' ); ?></li>
				<li><span class="iconfont icon-yonghu"></span><?php the_author_link(); ?></li>
				<li><span class="iconfont icon-liebiao"></span><?php the_category(', '); ?></li>
			<?php endif; ?>

			<?php if ( is_single() ) : ?>
				<li class="pull-right dropdown"><span class="iconfont icon-fenxiang dropdown-toggle" data-toggle="dropdown"></span><?php _e( 'share', 'pits' ); ?><div class="dropdown-menu"><?php include('modules/share.php'); ?></div></li>
				<li><span class="iconfont icon-shijian"></span><?php the_time( 'Y-m-d' ); ?></li>
				<li><span class="iconfont icon-fatie"></span><?php edit_post_link(); ?></li>
			<?php endif; ?>

			<?php if ( is_category() ): ?>
				<li><span class="iconfont icon-shijian"></span><?php the_time( 'Y-m-d' ); ?></li>
				<li><span class="iconfont icon-yonghu"></span><?php the_author_link(); ?></li>
			<?php endif; ?>

			<?php if ( is_author() ): ?>
				<li><span class="iconfont icon-shijian"></span><?php the_time( 'Y-m-d' ); ?></li>
				<li><span class="iconfont icon-liebiao"></span><?php the_category(', '); ?></li>
			<?php endif; ?>

			<?php if ( is_date() ): ?>
				<li><span class="iconfont icon-yonghu"></span><?php the_author_link(); ?></li>
				<li><span class="iconfont icon-liebiao"></span><?php the_category(', '); ?></li>
			<?php endif; ?>

			<?php if ( is_tag() ): ?>
				<li><span class="iconfont icon-shijian"></span><?php the_time( 'Y-m-d' ); ?></li>
				<li><span class="iconfont icon-yonghu"></span><?php the_author_link(); ?></li>
			<?php endif; ?>

			<li><span class="iconfont icon-liulanliang"></span><?php if(function_exists('the_views')) { the_views(); } ?></li>
		
		</ul>

	</header>
	
	<div class="entry-content">
		
		<?php 
			if ( is_single() ) :
				echo '<div class="arty">';
				the_content();
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'pits' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );

				echo '</div>';
				
			else :
		
			echo '<p class="excerpt">';

				if ( has_excerpt() ) :
					the_excerpt(); 
				else: 
					echo wp_trim_words( get_the_content(), 200 );
				endif;
			
			echo '</p>';

			endif;
		?>

	</div>
		
	<?php the_tags( '<footer>', '', '</footer>' ); ?>

</article>