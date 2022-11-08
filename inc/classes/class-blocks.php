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
		add_filter( 'block_categories_all', array( $this, 'naomimoon_add_block_category' ) );
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

	/**
	 * Adding a new (custom) block category.
	 *
	 * @param array                   $block_categories Get categories.
	 * @param WP_Block_Editor_Context $block_editor_context Get context.
	 */
	public function naomimoon_add_block_category( $block_categories, $block_editor_context = null ) {

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

}
