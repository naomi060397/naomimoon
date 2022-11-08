<?php
/**
 * Setup widgets.
 *
 * @package naomimoon
 */

namespace NAOMIMOON\Inc;

use NAOMIMOON\Inc\Traits\Singleton;

/**
 * Class Assets
 */
class Widgets {
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
		add_action( 'widgets_init', array( $this, 'naomimoon_widgets_init' ) );
	}

	/**
	 * Register widget area.
	 *
	 * @return void
	 * @since 1.1
	 */
	public function naomimoon_widgets_init() {
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

}
