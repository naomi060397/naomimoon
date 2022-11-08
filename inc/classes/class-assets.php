<?php
/**
 * Enqueue assets.
 *
 * @package naomimoon
 */

namespace NAOMIMOON\Inc;

use NAOMIMOON\Inc\Traits\Singleton;

/**
 * Class Assets
 */
class Assets {
	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Register action/filter hooks.
	 *
	 * @return void
	 * @since 1.1
	 */
	protected function setup_hooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'naomimoon_scripts' ) );
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @return void
	 * @since 1.1
	 */
	public function naomimoon_scripts() {
		wp_enqueue_style( 'naomimoon-style', THEME_URL . '/assets/build/css/all.css', array(), THEME_VERSION, false );
		wp_enqueue_style( 'dashicons' );
		wp_style_add_data( 'naomimoon-style', 'rtl', 'replace' );

		wp_enqueue_script( 'naomimoon-navigation', THEME_URL . '/js/navigation.js', array(), THEME_VERSION, true );
		wp_enqueue_script( 'jquery', THEME_URL . '/js/jquery.min.js', array(), THEME_VERSION, true );
		wp_enqueue_script( 'naomimoon-scripts', THEME_URL . '/assets/js/naomimoon-scripts.js', array( 'jquery' ), THEME_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

}
