<?php
/**
 * Functions and definitions for the naomimoon theme!
 *
 * @package naomimoon
 */

/**
 * Define constants
 */
if ( ! defined( 'THEME_VERSION' ) ) {
	define( 'THEME_VERSION', '1.5' );
}

if ( ! defined( 'THEME_PATH' ) ) {
	define( 'THEME_PATH', __DIR__ );
}

if ( ! defined( 'THEME_URL' ) ) {
	define( 'THEME_URL', get_template_directory_uri() );
}

if ( ! defined( 'BUILD_URI' ) ) {
	define( 'BUILD_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build' );
}

if ( ! defined( 'BUILD_PATH' ) ) {
	define( 'BUILD_PATH', untrailingslashit( get_template_directory() ) . '/assets/build' );
}

if ( ! defined( 'BUILD_CSS_URI' ) ) {
	define( 'BUILD_CSS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/css' );
}

if ( ! defined( 'BUILD_CSS_DIR_PATH' ) ) {
	define( 'BUILD_CSS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/assets/build/css' );
}

if ( ! defined( 'ASSETS_DIR_PATH' ) ) {
	define( 'ASSETS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/assets' );
}

if ( ! defined( 'ASSETS_URI' ) ) {
	define( 'ASSETS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets' );
}

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/underscores-extras/jetpack.php';
}

/**
 * Import files
 */
require get_template_directory() . '/inc/underscores-extras/custom-header.php';
require get_template_directory() . '/inc/underscores-extras/template-tags.php';
require get_template_directory() . '/inc/underscores-extras/template-functions.php';
require get_template_directory() . '/inc/underscores-extras/customizer.php';

/**
 * Load class autoloader.
 */
require_once THEME_PATH . '/inc/helpers/autoloader.php';

/**
 * Theme Init
 *
 * Sets up the theme.
 *
 * @return void
 * @since 1.1
 */
function naomimoon_get_theme_instance() {
	\NAOMIMOON\Inc\Naomimoon::get_instance();
}

naomimoon_get_theme_instance();
