<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'understrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		wp_enqueue_style( 'understrap-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), $css_version );

		wp_enqueue_script( 'jquery' );

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/theme.min.js' );
		wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_register_script( 'search',  get_template_directory_uri() . '/js/search.js', null, null, true );
		wp_enqueue_script( 'search');

		wp_register_script( 'defer',  get_template_directory_uri() . '/js/defer-ads.js', null, null, true );
		wp_enqueue_script( 'defer');

		wp_enqueue_style( 'prism-style', get_stylesheet_directory_uri() . '/css/prism.css');
		wp_enqueue_style('prism-style');

		wp_register_script( 'prism',  get_template_directory_uri() . '/js/prism.js', null, null, true );
		wp_enqueue_script('prism');

		// wp_register_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', null, null, true );
		// wp_enqueue_script('slick');

		// wp_register_style( 'slickstyle', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css' );
		// wp_enqueue_style('slickstyle');

		wp_register_style( 'fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_style('fontawesome');


		
		wp_register_style('fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Source+Sans+Pro:700');
		wp_enqueue_style('fonts');
	}
} // endif function_exists( 'understrap_scripts' ).

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );
