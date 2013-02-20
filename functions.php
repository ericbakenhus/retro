<?php

/********************
 * A good chunk of how this theme handles options
 * was inspired by Chip Bennett's awesome tutorial:
 * http://www.chipbennett.net/2011/02/17/incorporating-the-settings-api-in-wordpress-themes/
********************/

if ( ! isset( $content_width ) )
	$content_width = 679;


add_action( 'after_setup_theme', 'retro_options_init', 1 );

function retro_options_init() {
	global $retro_options;
	$retro_options = get_option( 'retro_options' );
	$defaults = retro_get_defaults();
	
	if ( empty( $retro_options ) ) {
		update_option( 'retro_options', $defaults );
		$retro_options = $defaults;
	} elseif ( version_compare( $defaults['version'], $retro_options['version'] ) > 0 ) {
		$merged = wp_parse_args( $retro_options, $defaults );
		update_option( 'retro_options', $merged );
		$retro_options = $merged;
	}
}


add_action( 'after_setup_theme', 'retro_after_setup_theme_hook' );

if ( ! function_exists( 'retro_after_theme_setup_hook' ) ) {
/**
* Hook after_theme_setup
*/
function retro_after_setup_theme_hook() {
	global $retro_options;

	if ( $retro_options['rsd_link'] ) {
		remove_action( 'wp_head', 'rsd_link' );
	}
	
	if ( $retro_options['wlwm_link'] ) {
		remove_action( 'wp_head', 'wlwmanifest_link' );
	}
	
	if ( $retro_options['wp_gen'] ) {
		add_filter( 'the_generator', 'retro_the_generator_filter' );
	}
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );
	
	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'main', 'Main Menu' );
	
	// Add support for custom backgrounds
	add_theme_support( 'custom-background' );
	
	// The default header text color
	if ( $retro_options['layout'] == 1 ) {
		define( 'HEADER_TEXTCOLOR', '66B366' );
	} else {
		define( 'HEADER_TEXTCOLOR', '000' );
	}

	// By leaving empty, we allow for random image rotation.
	define( 'HEADER_IMAGE', '' );

	// The height and width of your custom header.
	// Add a filter to twentyeleven_header_image_width and twentyeleven_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'retro_header_image_width', $retro_options['header_width'] ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'retro_header_image_height', $retro_options['header_height'] ) );
	
	add_theme_support( 'custom-header', array(
		'wp-head-callback' => 'retro_header_style',
		'admin-head-callback' => 'retro_admin_header_style'
	) );
}
}

if ( ! function_exists( 'retro_header_style' ) ) {
function retro_header_style() {
?>
<style type="text/css">
.site-header {
	background: url(<?php header_image(); ?>)  no-repeat;
	height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
}
.site-header hgroup h1 a{color: #<?php header_textcolor(); ?>;}
</style>
<?php
}
}

if ( ! function_exists( 'retro_admin_header_style' ) ) {
function retro_admin_header_style() {
?>
<style type="text/css">
#headimg {
	width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
	height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	background: no-repeat;
}
</style>
<?php
}
}


add_action( 'init', 'retro_init_hook' );

if ( ! function_exists( 'retro_init_hook' ) ) {
/**
* Hook init
*/
function retro_init_hook() {

	/* Add sidebars */
	$sidebars = array(
		'simple-canvas-main' => array( 'Main', 'Main sidebar.' )
	);
		
	foreach ( $sidebars as $sidebar => $details ) register_sidebar( array( 'id' => $sidebar, 'name' => $details[ 0 ], 'description' => $details[ 1 ], 'before_widget' => '<aside id="%s" class="widget %s">', 'after_widget' => '</aside>', 'before_title' => '<h3>', 'after_title' => '</h3>' ) );
}
}


add_action( 'wp_enqueue_scripts', 'retro_wp_enqueue_scripts_hook' );

if ( ! function_exists( 'retro_wp_enqueue_scripts_hook' ) ) {
/**
* Hook template_redirct
*/
function retro_wp_enqueue_scripts_hook() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply', '', '', '', true );
	}
}	
}


add_filter( 'wp_title', 'retro_wp_title_filter', 10, 3 );

if ( ! function_exists( 'retro_wp_title_filter' ) ) {
function retro_wp_title_filter( $title, $sep, $seplocation ) {
	global $page, $paged;

	if ( is_home() || is_front_page() ) {
		$output = get_bloginfo( 'name', 'display' ) . $sep . get_bloginfo( 'description', 'display' );
	} else {
		$output = $title . get_bloginfo( 'name', 'display' );
	}
	
	if ( $paged >= 2 || $page >= 2 ) {
		$output .= $sep . max( $paged, $page );
	}
	
	return $output;
}
}


if ( ! function_exists( 'retro_content_nav' ) ) {
/**
* Display navigation to next/previous pages when applicable
*/
function retro_content_nav( $nav_id = '' ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) { ?>
		<nav class="content-nav <?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php echo 'Post navigation'; ?></h3>
			<div class="nav-previous"><?php next_posts_link( '<< Older posts' ); ?></div>
			<div class="nav-next"><?php previous_posts_link( 'Newer posts >>' ); ?></div>
		</nav><!-- #nav-above -->
	<?php }
}
}


/* Utilities */
function retro_get_defaults() {
	$options = array(
		'version' => 0.964,
		'layout' => 1,
		'show_credits' => 1,
		'avatar_size' => 64,
		'header_width' => 1000,
		'header_height' => 100,
		'rsd_link' => 1,
		'wlwm_link' => 1,
		'wp_gen' => 0,
		'webcomic_dynamic_images' => 1,
		'webcomic_comic_link' => 1
	);
	
	return $options;
}

function retro_get_settings_page_tabs() {
	$tabs = array(
		'general' => 'General',
		'webcomic' => 'Webcomic'
	);
	
	return $tabs;
}

function retro_the_generator_filter() {
	return '';
}

function retro_webcomic_classes() {
	global $retro_options;

	$classes = 'webcomic full';
	
	if ( $retro_options[ 'webcomic_dynamic_images' ] ) {
		$classes .= ' dynamic';
	}
	
	echo esc_attr( $classes );
}

function retro_comic_link() {
	global $retro_options;
	$link = false;
	
	switch ( $retro_options['webcomic_comic_link'] ) {
		case 1:
			$link = false;
			break;
		case 2:
			$link = 'previous';
			break;
		case 3:
			$link = 'next';
			break;
		case 4:
			$link = 'random';
			break;
		case 5:
			$link = 'self';
			break;
	}
	
	return $link;
}

if ( ! function_exists( 'is_a_webcomic' ) ) {
function is_a_webcomic( $p = false ) {

	if ( is_post_type_archive( 'webcomic_post' ) ) {
		return true;
	}

	if ( 'webcomic_post' == get_post_type( $p ) ) {
		return true;
	} else {
		return false;
	}
	
}
}

/* Admin Stuffs */
if ( is_admin() ) {
	require( dirname( __FILE__ ) . '/inc/admin-options.php' );
}
?>