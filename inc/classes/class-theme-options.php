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

		$this->footer_fields = array(
			'Footer Link 1' => 'footer_link_1',
			'Footer Link 2' => 'footer_link_2',
			'Footer Link 3' => 'footer_link_3',
		);

		$this->footer_text = array(
			'Footer Link 1 Text' => 'footer_link_1_text',
			'Footer Link 2 Text' => 'footer_link_2_text',
			'Footer Link 3 Text' => 'footer_link_3_text',
		);

		$this->color_fields = array(
			'naomimoon_gradient_1'           => array(
				'label'   => 'Gradient Color 1',
				'default' => '#ff79c5bd',
			),
			'naomimoon_gradient_2'           => array(
				'label'   => 'Gradient Color 2',
				'default' => '#bd93f9ac',
			),
			'naomimoon_background'           => array(
				'label'   => 'Body Background',
				'default' => '#282a36',
			),
			'naomimoon_background_secondary' => array(
				'label'   => 'Body Secondary',
				'default' => '#21242f',
			),
			'naomimoon_body_font'            => array(
				'label'   => 'Body Font',
				'default' => '#F8F8F2',
			),
			'naomimoon_accent'               => array(
				'label'   => 'Theme Accent',
				'default' => '#BD93F9',
			),
			'naomimoon_header_bg'            => array(
				'label'   => 'Header Background',
				'default' => '#21242f',
			),
			'naomimoon_header_font'          => array(
				'label'   => 'Header Font Color',
				'default' => '#F8F8F2',
			),
			'naomimoon_footer_bg'            => array(
				'label'   => 'Footer Background',
				'default' => '#21242f',
			),
			'naomimoon_footer_font'          => array(
				'label'   => 'Footer Font',
				'default' => '#F8F8F2',
			),
			'naomimoon_link_hover'           => array(
				'label'   => 'Link Hover',
				'default' => '#FF79C6',
			),
		);

		$this->settings_sections = array(
			'naomimoon-section-color'    => array(
				'title'       => 'Color Scheme',
				'callback'    => 'section_description_callback',
				'page'        => 'naomimoon-color',
				'description' => "Customize theme's block and page colors.",

			),
			'naomimoon-section-gradient' => array(
				'title'    => 'Background Gradient',
				'callback' => 'section_gradient_callback',
				'page'     => 'naomimoon-color',
			),
			'naomimoon-section-font'     => array(
				'title'       => 'Fonts',
				'callback'    => 'section_description_callback',
				'page'        => 'naomimoon-font',
				'description' => 'Change the font of the Dashboard and Front-end design.',
			),
			'naomimoon-section-header'   => array(
				'title'       => 'Header',
				'callback'    => 'section_description_callback',
				'page'        => 'naomimoon-general',
				'description' => 'Change the text of the logo on the left side of the header.',
			),
			'naomimoon-section-footer'   => array(
				'title'       => 'Footer',
				'callback'    => 'section_description_callback',
				'page'        => 'naomimoon-general',
				'description' => 'Add custom links to the footer.',
			),
		);
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
				<li><a id="general" class="options-tab active">General</a></li>
				<li><a id="colors" class="options-tab">Colors</a></li>
				<li><a id="font" class="options-tab">Font</a></li>
				<li><a id="about" class="options-tab">About</a></li>
			</ul>
			<div class="settings-title">
				<h1>Naomimoon Theme Options</h1>
			</div>
			<span><?php settings_errors(); ?></span>
			<?php
			$this->general_form();
			$this->color_form();
			$this->font_form();
			$this->about_page();
			?>
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
		register_setting( 'naomimoon-font-setting', 'naomimoon_font_settings' );
		register_setting( 'naomimoon-general-setting', 'naomimoon_general_settings' );

		foreach ( $this->settings_sections as $id => $args ) {
			add_settings_section( $id, $args['title'], array( $this, $args['callback'] ), $args['page'], array( 'section_content' => $args['description'] ) );
		}

		// Header logo text.
		add_settings_field(
			'naomimoon_header_logo',
			__( 'Header Logo Text', 'naomimoon' ),
			array( $this, 'add_field' ),
			'naomimoon-general',
			'naomimoon-section-header',
			array(
				'type'  => 'text',
				'name'  => 'naomimoon_general_settings[naomimoon_header_logo]',
				'value' => 'naomimoon_header_logo',
				'class' => 'use-label',
			)
		);

		// Footer links.
		foreach ( $this->footer_fields as $label => $field ) {
			add_settings_field(
				$field,
				$label,
				array( $this, 'add_field' ),
				'naomimoon-general',
				'naomimoon-section-footer',
				array(
					'type'  => 'text',
					'name'  => 'naomimoon_general_settings[' . $field . ']',
					'value' => $field,
					'class' => 'use-label',
				)
			);
		}

		// Footer link text.
		foreach ( $this->footer_text as $label => $field ) {
			add_settings_field(
				$field,
				$label,
				array( $this, 'add_field' ),
				'naomimoon-general',
				'naomimoon-section-footer',
				array(
					'type'  => 'text',
					'name'  => 'naomimoon_general_settings[' . $field . ']',
					'value' => $field,
					'class' => 'use-label',
				)
			);
		}

		// Color fields.
		foreach ( $this->color_fields as $field => $args ) {
			if ( 'naomimoon_gradient_1' !== $field && 'naomimoon_gradient_2' !== $field ) {
				add_settings_field(
					$field,
					$args['label'],
					array( $this, 'add_field' ),
					'naomimoon-color',
					'naomimoon-section-color',
					array(
						'type'  => 'color-picker',
						'name'  => 'naomimoon_color_settings[' . $field . ']',
						'value' => $field,
					)
				);
			}
		}

		// Gradient fields.
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
		$options_color   = get_option( 'naomimoon_color_settings' );
		$options_font    = get_option( 'naomimoon_font_settings' );
		$options_general = get_option( 'naomimoon_general_settings' );

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
			case 'text':
				$this->text_callback( $args, $options_general );
				break;
		}
	}

	/**
	 * Generate textbox.
	 *
	 * @param  array $args Field argument.
	 * @param  array $options option values.
	 * @return void
	 * @since 1.0.0
	 */
	public function text_callback( $args, $options ) {
		?>
		<input
			type="<?php echo esc_attr( $args['type'] ); ?>"
			name="<?php echo esc_attr( $args['name'] ); ?>"
			value="<?php echo isset( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : ''; ?>"
		/>
		<?php
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
		<input
			type="text" class="color-picker"
			name="<?php echo esc_attr( $args['name'] ); ?>"
			value="<?php echo ! empty( $options[ $args['value'] ] ) ? esc_attr( $options[ $args['value'] ] ) : esc_attr( $default ); ?>"
		/>
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
	 * Render General Form.
	 */
	public function general_form() {
		?>
		<form action='options.php' method='post' id="general-options" class="active options-page general"> 
			<?php
			settings_fields( 'naomimoon-general-setting' );
			do_settings_sections( 'naomimoon-general' );
			?>
			<div class="settings-buttons">
				<?php submit_button(); ?>
			</div>
		</form>
		<?php
	}

	/**
	 * Render Color Form.
	 */
	public function color_form() {
		?>
		<form action='options.php' method='post' id="color-options" class="options-page colors"> 
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
		<?php
	}

	/**
	 * Render Font Form.
	 */
	public function font_form() {
		?>
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
		<?php
	}

	/**
	 * Render About Page.
	 */
	public function about_page() {
		global $wp_version;
		?>
		<div class="options-page about">
			<h2>About</h2>
			<div class="version-info">
				<span>Theme Version: <?php echo esc_html( THEME_VERSION ); ?></span>
				<span>WordPress Version: <?php echo esc_html( $wp_version ); ?></span>
				<span>Tested up to WordPress 6.1.1</span>
			</div>
			<p>
				With this theme you can put your skills on display and easlily customize the appearance to reflect your style!
			</p>
			<p>
				This theme is made of six Gutenberg blocks, which you can find under the Naomi Moon block category. Each block's content is fully editable, 
				and you can change the color scheme of the theme using the color settings here in the Theme Options.
			</p>
			<p>
				Additionally, you can change the look of your Dashboard and site content with the font options also here in the Theme Options.
			</p>
		</div>
		<?php
	}

	/**
	 * Section Color Callback.
	 *
	 * @return void
	 * @since 1.1
	 * @param array $args passing description text data.
	 */
	public function section_description_callback( $args ) {
		?>
		<div class="section-description">
			<p>
				<?php echo esc_html( $args['section_content'] ); ?>
			</p>
		</div>
		<?php
	}

	/**
	 * Section Gradient Callback.
	 *
	 * @return void
	 * @since 1.1
	 */
	public function section_gradient_callback() {
		?>
		<div class="gradient-preview">
			<div class="section-description">
				<p>
					Customize background gradient used in some blocks.
				</p>
			</div>
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
