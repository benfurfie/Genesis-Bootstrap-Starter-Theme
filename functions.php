<?php
// Start the engine
include_once( get_template_directory() . '/lib/init.php' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Inbound Creative Starter Theme' );
define( 'CHILD_THEME_URL', 'http://www.inboundcreative.co.uk/' );
define( 'CHILD_THEME_VERSION', '1.0' );

// Enqueue soft scroll scripts
add_action( 'wp_enqueue_scripts', 'ic_enqueue_scripts' );
function ic_enqueue_scripts() {
	wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array( 'jquery' ), '1.4.5-beta', true );
	wp_enqueue_script( 'localScroll', get_stylesheet_directory_uri() . '/js/jquery.localScroll.min.js', array( 'scrollTo' ), '1.2.8b', true );
	wp_enqueue_script( 'scroll', get_stylesheet_directory_uri() . '/js/scroll.js', array( 'localScroll' ), '', true );
	wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '', true );
	wp_enqueue_style( 'dashicons' );
}

// Add HTML5 markup structure
add_theme_support( 'html5' );

// Remove structural wraps
remove_theme_support( 'genesis-structural-wraps' );

// Remove items from the Genesis admin screen
add_action( 'genesis_admin_before_metaboxes', 'bsg_remove_genesis_theme_metaboxes' );

// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// adding post format support
add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio' ));

// adding support for post format images
add_theme_support( 'genesis-post-format-images' );

// Add support for custom background
add_theme_support( 'custom-background' );

// Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

// Add support for editor stylesheet
add_editor_style( 'style.css' );

// Removes Genesis SEO options
remove_action( 'genesis_site_title', 'genesis_seo_site_title' ); // This is removed because we use Yoast SEO for SEO tools
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' ); // This is removed because we use Yoast SEO for SEO tools
remove_theme_support( 'genesis-seo-settings-menu' ); // This is removed because we use Yoast SEO for SEO tools

// Remove the site title and description
remove_action( 'genesis_site_title', 'genesis_seo_site_title' ); // Title
remove_action( 'genesis_site_description', 'genesis_seo_site_description' ); // Description

// Add support for a clickable logo
add_action( 'genesis_site_title', 'site_logo', 5,1);
function site_logo() {
	?><a id="site-logo" class="site-logo" href="<?php bloginfo( 'url' ); ?>"><img src="<?php bloginfo( 'url' ) ?>/images/logo.png" alt="<?php bloginfo('name')?>" title="<?php bloginfo('name')?>" /></a><?php ;
}

// Genesis Attribute Edits

// Genesis Site Header
add_filter( 'genesis_attr_site-header', 'ic_attr_header' );
function ic_attr_header( $attributes ) {
	// add original plus extra CSS classes
	$attributes['class'] .= ' navbar navbar-default';
	// return the attributes
	return $attributes;
}

// Content
add_filter( 'genesis_attr_site-container', 'ic_attr_container' );
function ic_attr_container( $attributes ) {
	// add original plus extra CSS classes
	$attributes['class'] .= ' container';
	// return the attributes
	return $attributes;
}

// Making jQuery Google API
function modify_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2');
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'modify_jquery');