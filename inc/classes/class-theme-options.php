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
				<li><a id="font" class="options-tab">Font</a></li>
				<li><a id="about" class="options-tab">About</a></li>
			</ul>
			<div class="settings-title">
				<h1>Naomimoon Theme Options</h1>
			</div>
			<span><?php settings_errors(); ?></span>
			<form action='options.php' method='post' id="color-options" class="active options-page colors"> 
				<?php
				settings_fields( 'naomimoon-color-setting' );
				do_settings_sections( 'naomimoon-color' );
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
			<form action='options.php' method='post' id="font-options" class="options-page font"> 
				<?php
				settings_fields( 'naomimoon-font-setting' );
				do_settings_sections( 'naomimoon-font' );
				?>
				<div class="settings-buttons">
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
		register_setting( 'naomimoon-color-setting', 'naomimoon_color_settings' );
		add_settings_section( 'naomimoon-section-color', __( 'Color Options', 'naomimoon' ), false, 'naomimoon-color' );
		add_settings_section( 'naomimoon-section-gradient', __( 'Gradient Options', 'naomimoon' ), array( $this, 'gradient_preview' ), 'naomimoon-color' );

		register_setting( 'naomimoon-font-setting', 'naomimoon_font_settings' );
		add_settings_section( 'naomimoon-section-font', __( 'Font Options', 'naomimoon' ), false, 'naomimoon-font' );

		// Body.
		add_settings_field(
			'naomimoon_background',
			__( 'Body Background', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-color',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_color_settings[naomimoon_background]',
				'value' => 'naomimoon_background',
			)
		);

		add_settings_field(
			'naomimoon_background_secondary',
			__( 'Body Secondary', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-color',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_color_settings[naomimoon_background_secondary]',
				'value' => 'naomimoon_background_secondary',
			)
		);

		add_settings_field(
			'naomimoon_body_font',
			__( 'Body Font', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-color',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_color_settings[naomimoon_body_font]',
				'value' => 'naomimoon_body_font',
			)
		);

		add_settings_field(
			'naomimoon_accent',
			__( 'Theme Accent', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-color',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_color_settings[naomimoon_accent]',
				'value' => 'naomimoon_accent',
			)
		);

		// Header.
		add_settings_field(
			'naomimoon_header_bg',
			__( 'Header Background', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-color',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_color_settings[naomimoon_header_bg]',
				'value' => 'naomimoon_header_bg',
			)
		);

		add_settings_field(
			'naomimoon_header_font',
			__( 'Header Font Color', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-color',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_color_settings[naomimoon_header_font]',
				'value' => 'naomimoon_header_font',
			)
		);

		// Footer.
		add_settings_field(
			'naomimoon_footer_bg',
			__( 'Footer Background', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-color',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_color_settings[naomimoon_footer_bg]',
				'value' => 'naomimoon_footer_bg',
				'class' => 'footer',
			)
		);

		add_settings_field(
			'naomimoon_footer_font',
			__( 'Footer Font', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-color',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_color_settings[naomimoon_footer_font]',
				'value' => 'naomimoon_footer_font',
				'class' => 'footer',
			)
		);

		add_settings_field(
			'naomimoon_link_hover',
			__( 'Link Hover', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-color',
			'naomimoon-section-color',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_color_settings[naomimoon_link_hover]',
				'value' => 'naomimoon_link_hover',
			)
		);

		add_settings_field(
			'naomimoon_gradient_1',
			__( 'Gradient Color 1', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-color',
			'naomimoon-section-gradient',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_color_settings[naomimoon_gradient_1]',
				'value' => 'naomimoon_gradient_1',
				'class' => 'gradient-1',
			)
		);

		add_settings_field(
			'naomimoon_gradient_2',
			__( 'Gradient Color 2', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-color',
			'naomimoon-section-gradient',
			array(
				'type'  => 'color-picker',
				'name'  => 'naomimoon_color_settings[naomimoon_gradient_2]',
				'value' => 'naomimoon_gradient_2',
				'class' => 'gradient-2',
			)
		);

		// Admin side font.
		add_settings_field(
			'naomimoon_admin_font',
			__( 'Dashboard Font:', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-font',
			'naomimoon-section-font',
			array(
				'type'    => 'select',
				'name'    => 'naomimoon_font_settings[naomimoon_admin_font]',
				'value'   => 'naomimoon_admin_font',
				'class'   => 'use-label',
				'options' => array(
					'None',
					'Nunito',
					'Roboto',
					'Ubuntu',
				),
			)
		);

		// Front side font.
		add_settings_field(
			'naomimoon_front_font',
			__( 'Theme Font:', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-font',
			'naomimoon-section-font',
			array(
				'type'    => 'select',
				'name'    => 'naomimoon_font_settings[naomimoon_front_font]',
				'value'   => 'naomimoon_front_font',
				'class'   => 'use-label',
				'options' => array(
					'Nunito',
					'Roboto',
					'Ubuntu',
				),
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
		$options_color = get_option( 'naomimoon_color_settings' );
		$options_font  = get_option( 'naomimoon_font_settings' );
		if ( ! $options_color[ $args['value'] ] ) {
			switch ( $args['value'] ) {
				case 'naomimoon_gradient_1':
					$default = '#ff79c5bd';
					break;
				case 'naomimoon_gradient_2':
					$default = '#bd93f9ac';
					break;
				case 'naomimoon_background':
					$default = '#282a36';
					break;
				case 'naomimoon_background_secondary':
					$default = '#21242f';
					break;
				case 'naomimoon_body_font':
					$default = '#F8F8F2';
					break;
				case 'naomimoon_accent':
					$default = '#BD93F9';
					break;
				case 'naomimoon_header_bg':
					$default = '#21242f';
					break;
				case 'naomimoon_header_font':
					$default = '#F8F8F2';
					break;
				case 'naomimoon_footer_bg':
					$default = '#21242f';
					break;
				case 'naomimoon_footer_font':
					$default = '#F8F8F2';
					break;
				case 'naomimoon_link_hover':
					$default = '#FF79C6';
					break;
			}
		}
		switch ( $args['type'] ) {
			case 'color-picker':
				$this->color_picker_callback( $args, $options_color, $default );
				break;
			case 'select':
				$this->selectbox_callback( $args, $options_font );
				break;
		}
	}

	/**
	 * Generate Color Picker.
	 *
	 * @param  array  $args Field argument.
	 * @param  array  $options option values.
	 * @param  string $default default color.
	 * @return void
	 * @since 1.1
	 */
	public function color_picker_callback( $args, $options, $default ) {
		?>
		<input type="text" class="color-picker" name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo ! empty( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : esc_attr( $default ); ?>" />
		<?php
	}

	/**
	 * Generate Select Box.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 * @since 1.0.0
	 */
	public function selectbox_callback( $args, $options ) {
		$select_options = $args['options'];
		?>
		<select name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>">
			<?php
			foreach ( $select_options as $key => $value ) :
				?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $options[ $args['value'] ], $key ); ?>><?php echo esc_html( $value ); ?></option>
				<?php
				endforeach;
			?>
		</select>
		<?php
	}

	/**
	 * Gradient Preview Callback.
	 *
	 * @return void
	 * @since 1.1
	 */
	public function gradient_preview() {
		?>
		<div class="gradient-preview">
			<h4>Preview</h4>
			<?php
			$get_theme_options    = get_option( 'naomimoon_color_settings' );
			$naomimoon_gradient_1 = ( isset( $get_theme_options['naomimoon_gradient_1'] ) && ! empty( $get_theme_options['naomimoon_gradient_1'] ) ? $get_theme_options['naomimoon_gradient_1'] : '#ff79c5bd' );
			$naomimoon_gradient_2 = ( isset( $get_theme_options['naomimoon_gradient_2'] ) && ! empty( $get_theme_options['naomimoon_gradient_2'] ) ? $get_theme_options['naomimoon_gradient_2'] : '#bd93f9ac' );
			?>
			<div class="preview" style="background: linear-gradient(90deg, <?php echo esc_html( $naomimoon_gradient_1 ); ?>, <?php echo esc_html( $naomimoon_gradient_2 ); ?>)"></div>
		</div>
		<?php
	}
}
