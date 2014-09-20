</div> <!-- main end -->
		</div> <!-- flex-box end -->

		<!-- footer -->
		<footer>
			
			<div class="container clearfix">

				<?php 
					$menu = of_get_option( 'footer_menu' );

					if ( close !== $menu ) {
						wp_nav_menu( array( 
							'theme_location' => 'secondary', 
							'menu_class'     => 'footer-menu',
							'container'      => false ) ); 
					}
				?>

				Copyright &copy; <?php echo date('Y'); ?>&nbsp;&nbsp;  
				<?php _e( 'Proudly powered by', 'pits' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" target="_blank"><?php printf( 'WordPress' ); ?></a>.&nbsp;&nbsp;
				<?php _e( 'Theme by', 'pits' ); ?> <a href="<?php echo esc_url( 'http://pits.qdcode.com' ); ?>" target="_blank"><?php printf( 'QDcode' ); ?></a>.&nbsp;&nbsp;<!-- KEEP IT, THANK YOU -->
				
				<?php 
					$rss = of_get_option( 'social_rss' );
					if ( $rss ) { 
						echo '<a href="'.$rss.'" target="_blank"><span class="iconfont icon-dingyue"></span></a>&nbsp;';
					}

					$weibo = of_get_option( 'social_weibo' );
					if ( $weibo ) { 
						echo '<a href="'.$weibo.'" target="_blank"><span class="iconfont icon-gaibanweibo"></span></a>&nbsp;&nbsp;';
					} 
				?>
				
				<?php if ( get_option( 'zh_cn_l10n_icp_num' ) ) { ?>
					<?php echo get_option( 'zh_cn_l10n_icp_num' ); ?>&nbsp;&nbsp;
				<?php } ?>

				<?php if ( of_get_option( 'site_tongji' ) ) { ?>
					<script><?php echo of_get_option( 'site_tongji' ); ?></script>
				<?php } ?>
			</div>

		</footer>
		
	 </div> <!-- wrapper end -->

<script data-main="<?php echo get_template_directory_uri(); ?>/assets/js/main.js" src="<?php echo get_template_directory_uri(); ?>/assets/js/require.js"></script>
<?php wp_footer(); ?> 
</body>
</html>