<?php
/**
 * Setup blocks.
 *
 * @package naomimoon
 */

namespace NAOMIMOON\Inc;

use NAOMIMOON\Inc\Traits\Singleton;

/**
 * Class Assets
 */
class Blocks {
	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {
		$this->setup_hooks();

		$this->blocks = array(
			'naomimoon/project',
			'naomimoon/certificate',
			'naomimoon/contact',
			'naomimoon/hero',
			'naomimoon/about',
			'naomimoon/experience',
		);
	}

	/**
	 * Register action/filter hooks.
	 *
	 * @return void
	 * @since 1.1
	 */
	protected function setup_hooks() {
		add_action( 'init', array( $this, 'naomimoon_register_blocks' ) );
	}

	/**
	 * Register blocks.
	 *
	 * @return void
	 * @since 1.1
	 */
	public function naomimoon_register_blocks() {
		wp_register_script( 'naomimoon-block-script', get_template_directory_uri() . '/assets/js/block.js', array( 'jquery' ), THEME_VERSION, true );
		wp_enqueue_style( 'naomimoon-style-editor', get_template_directory_uri() . '/assets/build/css/all.css', array(), THEME_VERSION, false );

		foreach ( $this->blocks as $block ) {
			register_block_type(
				$block,
				array(
					'editor_script' => 'naomimoon-block-script',
					'editor_style'  => 'naomimoon-style-editor',
				)
			);
		}
	}

}
