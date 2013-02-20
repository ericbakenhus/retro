<?php
/**
* Displays everything in the <head> tag and the part of the page that constitutes the "header".
* Most of this is "borrowed" strait from Twenty Eleven.
*/
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html class="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html class="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title( ' | ', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="container">
			<header class="site-header sixteen columns">
				<hgroup>
					<h1><a href="<?php echo home_url( '/' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
			</header><!--#header-->
			
			<nav class="main-nav sixteen columns row">
				<h3 class="assistive-text">Main navigation</h3>
				<?php wp_nav_menu( array( 'theme_location' => 'main' ) ); ?>
			</nav>
			
			<div class="main row">