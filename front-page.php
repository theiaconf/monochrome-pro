<?php
/**
 * Monochrome Pro.
 *
 * This file adds functions to the Monochrome Pro Theme.
 *
 * @package Monochrome
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/monochrome/
 */

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Monochrome Pro');
define( 'CHILD_THEME_URL', 'https://github.com/theiaconf/monochrome-pro');
define( 'CHILD_THEME_VERSION', '1.0.0');

add_action( 'genesis_meta', 'monochrome_front_page_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 * @since 1.0.0
 */
function monochrome_front_page_genesis_meta() {

	if ( is_active_sidebar( 'front-page-1' ) || is_active_sidebar( 'front-page-2' ) || 
	     is_active_sidebar( 'front-page-3' ) || is_active_sidebar( 'front-page-4' ) || 
	     is_active_sidebar( 'front-page-5' ) || is_active_sidebar( 'front-page-6' ) || 
	     is_active_sidebar( 'front-page-7' ) ) {

        // Remove default Genesis Child Theme Stylesheet
        remove_action('genesis_meta', 'genesis_load_stylesheet');

		// Enqueue scripts and styles.
		add_action('wp_enqueue_scripts', 'monochrome_enqueue_front_script_styles', 1);

		// Add front-page body class.
		add_filter( 'body_class', 'monochrome_body_class' );

		// Force full width content layout.
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

		// Remove breadcrumbs.
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		// Remove the default Genesis loop.
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Add front page widgets.
		add_action( 'genesis_before_loop', 'monochrome_front_page_widgets' );
	}
}

/*
 * Define scripts and styles
 *
 * Uses cache busting techniques so updates will refresh immediately without any
 * additional steps needing to be taken
 */
function monochrome_enqueue_front_script_styles() {
    /**
	wp_enqueue_script( 'monochrome-front-script', get_stylesheet_directory_uri() . '/js/front-page.js', array( 'jquery' ), CHILD_THEME_VERSION);

    $theme_name = 'monochrome-front-style';
    //$version = date( "njYHi", filemtime(get_stylesheet_directory() . '/style-front.css' ));

    wp_enqueue_style($theme_name, get_template_directory_uri() . "/style-front.css");
    //wp_enqueue_style($theme_name, get_stylesheet_directory_uri(), array(), $version);
    */
    
 	wp_enqueue_script( 'monochrome-front-script', get_stylesheet_directory_uri() . '/js/front-page.js', array( 'jquery' ), '1.0.0' );

    $theme_name = 'monochrome-front-styles';
    $version = date( "njYHi", filemtime(get_stylesheet_directory() . 
      '/style-front.css' ));
    wp_enqueue_style($theme_name, 
      get_stylesheet_directory_uri() . "/style-front.css",
      array(),
      $version);
}

// Add front-page body class.
function monochrome_body_class( $classes ) {

	$classes[] = 'front-page';

	return $classes;

}

// Add markup for front page widgets.
function monochrome_front_page_widgets() {

	echo '<h2 class="screen-reader-text">' . __( 'Main Content', 'monochrome-pro' ) . '</h2>';

	genesis_widget_area( 'front-page-1', array(
		'before' => '<div class="front-page-1 image-section"><div class="flexible-widgets widget-area fadeup-effect' . monochrome_widget_area_class( 'front-page-1' ) . '"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-2', array(
		'before' => '<div class="front-page-2 solid-section"><div class="flexible-widgets widget-area fadeup-effect' . monochrome_widget_area_class( 'front-page-2' ) . '"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-3', array(
		'before' => '<div class="front-page-3 solid-section"><div class="flexible-widgets widget-area fadeup-effect' . monochrome_widget_area_class( 'front-page-3' ) . '"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-4', array(
		'before' => '<div class="front-page-4 solid-section"><div class="flexible-widgets widget-area fadeup-effect' . monochrome_widget_area_class( 'front-page-4' ) . '"><div class="wrap">',
		'after'  => '</div></div></div>'
	) );


	genesis_widget_area( 'front-page-5', array(
		'before' => '<div class="front-page-5 image-section"><div class="flexible-widgets widget-area fadeup-effect' . monochrome_widget_area_class( 'front-page-5' ) . '"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-6', array(
		'before' => '<div class="front-page-1 image-section"><div class="flexible-widgets widget-area fadeup-effect' . monochrome_widget_area_class( 'front-page-6' ) . '"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

	genesis_widget_area( 'front-page-7', array(
		'before' => '<div class="front-page-7 solid-section"><div class="flexible-widgets widget-area fadeup-effect' . monochrome_widget_area_class( 'front-page-7' ) . '"><div class="wrap">',
		'after'  => '</div></div></div>',
	) );

}

// Run the Genesis loop.
genesis();
