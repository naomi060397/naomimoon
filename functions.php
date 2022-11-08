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
 * Sets up theme defaults and registers support for various WordPress features.
 */
function naomimoon_setup() {

	load_theme_textdomain( 'naomimoon', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'naomimoon' ),
		)
	);

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'naomimoon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function naomimoon_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'naomimoon_content_width', 640 );
}
add_action( 'after_setup_theme', 'naomimoon_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function naomimoon_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'naomimoon' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'naomimoon' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'naomimoon_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function naomimoon_scripts() {
	wp_enqueue_style( 'naomimoon-style', get_template_directory_uri() . '/assets/build/css/all.css', array(), THEME_VERSION, false );
	wp_enqueue_style( 'dashicons' );
	wp_style_add_data( 'naomimoon-style', 'rtl', 'replace' );

	wp_enqueue_script( 'naomimoon-navigation', get_template_directory_uri() . '/js/navigation.js', array(), THEME_VERSION, true );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), THEME_VERSION, true );
	wp_enqueue_script( 'naomimoon-scripts', get_template_directory_uri() . '/assets/js/naomimoon-scripts.js', array( 'jquery' ), THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'naomimoon_scripts' );

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


