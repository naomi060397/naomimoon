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
		add_action( 'admin_enqueue_scripts', array( $this, 'naomimoon_admin_scripts' ) );
	}

	/**
	 * Enqueue front scripts and styles.
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

		// Set front end font.
		$get_font_options = get_option( 'naomimoon_font_settings' );
		$front_font       = ( isset( $get_font_options['naomimoon_front_font'] ) && ! empty( $get_font_options['naomimoon_front_font'] ) ? $get_font_options['naomimoon_front_font'] : false );

		switch ( $front_font ) {
			case '0':
				wp_enqueue_style( 'naomimoon-front-font-style', THEME_URL . '/assets/build/css/fonts/font-nunito.css', array(), THEME_VERSION, false );
				break;
			case '1':
				wp_enqueue_style( 'naomimoon-front-font-style', THEME_URL . '/assets/build/css/fonts/font-roboto.css', array(), THEME_VERSION, false );
				break;
			case '2':
				wp_enqueue_style( 'naomimoon-front-font-style', THEME_URL . '/assets/build/css/fonts/font-ubuntu.css', array(), THEME_VERSION, false );
				break;
		}
	}

	/**
	 * Enqueue admin scripts and styles.
	 *
	 * @return void
	 * @since 1.1
	 */
	public function naomimoon_admin_scripts() {

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'naomimoon-admin-style', THEME_URL . '/assets/build/css/admin.css', array(), THEME_VERSION, false );
		wp_enqueue_script( 'naomimoon-admin-scripts', THEME_URL . '/assets/js/naomimoon-admin-scripts.js', array( 'wp-color-picker' ), THEME_VERSION, true );

		// Set admin side font.
		$get_font_options = get_option( 'naomimoon_font_settings' );
		$admin_font       = ( isset( $get_font_options['naomimoon_admin_font'] ) && ! empty( $get_font_options['naomimoon_admin_font'] ) ? $get_font_options['naomimoon_admin_font'] : false );

		switch ( $admin_font ) {
			case '1':
				wp_enqueue_style( 'naomimoon-admin-font-style', THEME_URL . '/assets/build/css/fonts/font-nunito.css', array(), THEME_VERSION, false );
				break;
			case '2':
				wp_enqueue_style( 'naomimoon-admin-font-style', THEME_URL . '/assets/build/css/fonts/font-roboto.css', array(), THEME_VERSION, false );
				break;
			case '3':
				wp_enqueue_style( 'naomimoon-admin-font-style', THEME_URL . '/assets/build/css/fonts/font-ubuntu.css', array(), THEME_VERSION, false );
				break;
		}
	}
}
