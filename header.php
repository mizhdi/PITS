<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
	<?php include "modules/seo.php"; ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>"> 
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>">
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/assets/css/<?php echo of_get_option( 'site_color', 'grey' ); ?>.css">
	<?php if ( of_get_option( 'favicon' ) ) { ?>
	<link rel="icon" href="<?php echo of_get_option( 'favicon' ); ?>">
	<link rel="shortcut icon" href="<?php echo of_get_option( 'favicon' ); ?>">
	<?php } ?>
	<!-- add icon for all include 'module/facicon.php'-->
	<!--[if lte IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>    
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script> 
		<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<noscript>
		<p class="text-warning alignment-center"><?php _e('Hello, your browser is disabled Javascript, in order to protect the browsing effect, please turn Javascript enabled.', 'pits'); ?></p>
	</noscript>
</head>

<body <?php body_class(); body_style(); ?> data-spy="scroll" data-target="#article-index" >
<!-- [if lt IE 9]>
    <p>Your browser version is very old very old, in order to properly access the site, please upgrade your browser <a target="_blank" href="http://browsehappy.com">Upgrade Now</a></p>
<![endif] -->

   	<!-- wrapper -->
	<div id="wrapper" <?php wrap_class();?>>

		<!-- header -->
		<header id="header" role="banner" 
			<?php 
				$bgcolor = of_get_option('content_opacity');
				echo 'style="background-color:'.$bgcolor.'"';
			?>>

			<button class="menu-togggle iconfont icon-iconliebiao"></button>

			<nav id="main-menu" role="navigation">
				<div class="container">
					
					<div class="login">
						<?php if ( is_user_logged_in() ) { ?>
							<?php global $current_user;get_currentuserinfo(); echo get_avatar( $current_user->user_email, 80); ?>
							<a href="<?php bloginfo('url') ?>/wp-admin/"><?php _e('Manage', 'pits'); ?></a>
						<?php } else { ?>

							<?php echo get_avatar( get_the_author_email(), '80' );?>
							<a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('Login', 'pits'); ?></a>

						<?php } ?>
					</div>

					<?php wp_nav_menu( array( 
						'theme_location' => 'primary', 
						'menu_class'     => 'nav-menu',
						'container'      => false ) ); 
					?>

				</div>
			</nav>

			<div class="container">

				<hgroup>
					<h1><a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?>" <?php logo_style(); ?>><?php bloginfo( 'name' ); ?></a></h1>
					<p><?php bloginfo( 'description' ); ?></p>
				</hgroup>

				<div class="search-box">
					<?php get_search_form(); ?>
				</div>

			</div>

		</header> <!-- header end -->

		<!-- main content -->
		<div id="main">

			<div id="flex-box" class="container" 
			<?php 
				$bgcolor = of_get_option('content_opacity');
				echo 'style="background-color:'.$bgcolor.'"';
			?>> 