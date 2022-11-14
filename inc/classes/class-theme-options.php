<?php
/**
 * Setup theme option page.
 *
 * @package naomimoon
 */

namespace NAOMIMOON\Inc;

use NAOMIMOON\Inc\Traits\Singleton;

/**
 * Class Assets
 */
class Theme_Options {
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
		add_action( 'admin_menu', array( $this, 'add_theme_options' ) );
		add_action( 'admin_init', array( $this, 'option_settings_init' ) );
	}

	/**
	 * Register menu page.
	 *
	 * @return void
	 * @since 1.1
	 */
	public function add_theme_options() {
		add_menu_page( 'Theme Options', 'Theme Options', 'manage_options', 'naomimoon', array( $this, 'option_form' ), '', 100 );
	}

	/**
	 * Generate Option form.
	 *
	 * @return void
	 * @since 1.1
	 */
	public function option_form() {
		?>
		<div class="naomimoon-options">
			<ul>
				<li><a id="colors" class="options-tab active">Colors</a></li>
				<li><a id="about" class="options-tab">About</a></li>
			</ul>
			<div class="settings-title">
				<h1>Naomimoon Theme Options</h1>
			</div>
			<span><?php settings_errors(); ?></span>
			<form action='options.php' method='post' id="color-options" class="active options-page colors"> 
				<?php
				settings_fields( 'naomimoon-setting' );
				do_settings_sections( 'naomimoon' );
				?>
				<div class="settings-buttons">
					<p class="submit">
						<button class="button button-primary" id="reset-color-options">Reset to Default</button>
					</p>
					<?php
					submit_button();
					?>
				</div>
			</form>
			<div class="options-page about">
				<h2>About Naomimoon</h2>
				<p>Hello world</p>
			</div>
		</div>
		<?php
	}

	/**
	 * Generate settings sections.
	 *
	 * @return void
	 * @since 1.1
	 */
	public function option_settings_init() {
		register_setting( 'naomimoon-setting', 'naomimoon_settings' );
		add_settings_section( 'naomimoon-section-color', __( 'Color Options', 'naomimoon' ), false, 'naomimoon' );
		add_settings_section( 'naomimoon-section-gradient', __( 'Gradient Options', 'naomimoon' ), array( $this, 'gradient_preview' ), 'naomimoon' );

		// Body.
		add_settings_field(
			'naomimoon_background',
			__( 'Body Background', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_settings[naomimoon_background]',
				'value' => 'naomimoon_background',
				'class' => 'general',
			)
		);

		add_settings_field(
			'naomimoon_background_secondary',
			__( 'Body Secondary', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_settings[naomimoon_background_secondary]',
				'value' => 'naomimoon_background_secondary',
				'class' => 'general',
			)
		);

		add_settings_field(
			'naomimoon_body_font',
			__( 'Body Font Color', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_settings[naomimoon_body_font]',
				'value' => 'naomimoon_body_font',
				'class' => 'general',
			)
		);

		add_settings_field(
			'naomimoon_accent',
			__( 'Theme Accent Color', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_settings[naomimoon_accent]',
				'value' => 'naomimoon_accent',
				'class' => 'general',
			)
		);

		// Header.
		add_settings_field(
			'naomimoon_header_bg',
			__( 'Header Background', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_settings[naomimoon_header_bg]',
				'value' => 'naomimoon_header_bg',
			)
		);

		add_settings_field(
			'naomimoon_header_font',
			__( 'Header Font Color', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_settings[naomimoon_header_font]',
				'value' => 'naomimoon_header_font',
			)
		);

		// Footer.
		add_settings_field(
			'naomimoon_footer_bg',
			__( 'Footer Background', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_settings[naomimoon_footer_bg]',
				'value' => 'naomimoon_footer_bg',
				'class' => 'footer',
			)
		);

		add_settings_field(
			'naomimoon_footer_font',
			__( 'Footer Font Color', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_settings[naomimoon_footer_font]',
				'value' => 'naomimoon_footer_font',
				'class' => 'footer',
			)
		);

		add_settings_field(
			'naomimoon_link_hover',
			__( 'Link Hover Color', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_settings[naomimoon_link_hover]',
				'value' => 'naomimoon_link_hover',
			)
		);

		add_settings_field(
			'naomimoon_gradient_1',
			__( 'Gradient Color 1', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon',
			'naomimoon-section-gradient',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_settings[naomimoon_gradient_1]',
				'value' => 'naomimoon_gradient_1',
				'class' => 'gradient-1',
			)
		);

		add_settings_field(
			'naomimoon_gradient_2',
			__( 'Gradient Color 2', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon',
			'naomimoon-section-gradient',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_settings[naomimoon_gradient_2]',
				'value' => 'naomimoon_gradient_2',
				'class' => 'gradient-2',
			)
		);
	}

	/**
	 * Generate Fields.
	 *
	 * @param  array $args Field argument.
	 * @return void
	 * @since 1.1
	 */
	public function add_field( array $args ) {
		$options = get_option( 'naomimoon_settings' );
		switch ( $args['type'] ) {
			case 'color-picker':
				$this->color_picker_callback( $args, $options );
				break;
		}
	}

	/**
	 * Generate Color Picker.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 * @since 1.1
	 */
	public function color_picker_callback( $args, $options ) {
		?>
		<input type="text" class="color-picker" name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>" />
		<?php
	}

	/**
	 * Generate Gradient Preview.
	 *
	 * @return void
	 * @since 1.1
	 */
	public function gradient_preview() {
		?>
		<div class="gradient-preview">
			<h4>Preview</h4>
			<?php
			$get_theme_options    = get_option( 'naomimoon_settings' );
			$naomimoon_gradient_1 = ( isset( $get_theme_options['naomimoon_gradient_1'] ) && ! empty( $get_theme_options['naomimoon_gradient_1'] ) ? $get_theme_options['naomimoon_gradient_1'] : '#ff79c5bd' );
			$naomimoon_gradient_2 = ( isset( $get_theme_options['naomimoon_gradient_2'] ) && ! empty( $get_theme_options['naomimoon_gradient_2'] ) ? $get_theme_options['naomimoon_gradient_2'] : '#bd93f9ac' );
			?>
			<div class="preview" style="background: linear-gradient(90deg, <?php echo esc_html( $naomimoon_gradient_1 ); ?>, <?php echo esc_html( $naomimoon_gradient_2 ); ?>)"></div>
		</div>
		<?php
	}
}
