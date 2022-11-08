<?php
/**
 * Bootstraps the Theme.
 *
 * @package naomimoon
 */

namespace NAOMIMOON\Inc;

use NAOMIMOON\Inc\Traits\Singleton;

/**
 * Main Theme Class
 */
class Naomimoon {
	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {
		/**
		 * Load classes.
		 */
		Assets::get_instance();

		$this->setup_hooks();
	}

	/**
	 * Register action/filter hooks.
	 *
	 * @return void
	 * @since 1.1
	 */
	protected function setup_hooks() {
		add_action( 'after_setup_theme', array( $this, 'naomimoon_setup' ) );
		add_action( 'after_setup_theme', array( $this, 'naomimoon_content_width' ), 0 );
	}

	/**
	 * Setup theme configuration.
	 *
	 * @return void
	 * @since 1.1
	 */
	public function naomimoon_setup() {
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

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * @global int $content_width
	 */
	public function naomimoon_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'naomimoon_content_width', 640 );
	}

}
