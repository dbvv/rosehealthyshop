<?php
/**
 * Rosehealthyshop Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rosehealthyshop
 */

add_action( 'wp_enqueue_scripts', 'storefront_parent_theme_enqueue_styles' );

/**
 * Enqueue scripts and styles.
 */
function storefront_parent_theme_enqueue_styles() {
	wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'rosehealthyshop-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'storefront-style' )
	);
}

/**
 * Header
 */
require get_stylesheet_directory() . '/inc/header.php';

/**
 * Woocommerce settings
 */
require get_stylesheet_directory() . '/inc/woocommerce-loop.php';
