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
	define( 'THEME_VERSION', '1.1' );
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

// END OOP CODE.

/**
 * Register Blocks
 */
function naomimoon_register_blocks() {
	wp_register_script( 'project-block-script', get_template_directory_uri() . '/assets/js/block.js', array( 'jquery' ), THEME_VERSION, true );
	wp_enqueue_style( 'naomimoon-style-editor', get_template_directory_uri() . '/assets/build/css/all.css', array(), THEME_VERSION, false );
	wp_register_script( 'naomimoon-scripts', get_template_directory_uri() . '/assets/js/naomimoon-scripts.js', array( 'jquery' ), THEME_VERSION, true );
	register_block_type(
		'naomimoon/project',
		array(
			'editor_script' => 'project-block-script',
			'editor_style'  => 'naomimoon-style-editor',
		)
	);
	register_block_type(
		'naomimoon/certificate',
		array(
			'editor_script' => 'project-block-script',
			'editor_style'  => 'naomimoon-style-editor',
		)
	);
	register_block_type(
		'naomimoon/contact',
		array(
			'editor_script' => 'project-block-script',
			'editor_style'  => 'naomimoon-style-editor',
		)
	);
	register_block_type(
		'naomimoon/hero',
		array(
			'editor_script' => 'project-block-script',
			'editor_style'  => 'naomimoon-style-editor',
		)
	);
	register_block_type(
		'naomimoon/about',
		array(
			'editor_script' => 'project-block-script',
			'editor_style'  => 'naomimoon-style-editor',
		)
	);
	register_block_type(
		'naomimoon/experience',
		array(
			'editor_script' => 'project-block-script',
			'editor_style'  => 'naomimoon-style-editor',
		)
	);
}
add_action( 'init', 'naomimoon_register_blocks' );

/**
 * Adding a new (custom) block category.
 *
 * @param array                   $block_categories Get categories.
 * @param WP_Block_Editor_Context $block_editor_context Get context.
 */
function naomimoon_add_block_category( $block_categories, $block_editor_context = null ) {

	return array_merge(
		$block_categories,
		array(
			array(
				'slug'  => 'naomimoon',
				'title' => esc_html__( 'Naomi Moon', 'text-domain' ),
				'icon'  => 'dashicons dashicons-star-filled',
			),
		)
	);
}

add_filter( 'block_categories_all', 'naomimoon_add_block_category' );

/**
 * Import files
 */
require get_template_directory() . '/inc/underscores-extras/custom-header.php';
require get_template_directory() . '/inc/underscores-extras/template-tags.php';
require get_template_directory() . '/inc/underscores-extras/template-functions.php';
require get_template_directory() . '/inc/underscores-extras/customizer.php';


