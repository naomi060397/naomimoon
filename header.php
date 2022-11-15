<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package naomimoon
 */

$get_theme_options              = get_option( 'naomimoon_color_settings' );
$naomimoon_background           = ( isset( $get_theme_options['naomimoon_background'] ) && ! empty( $get_theme_options['naomimoon_background'] ) ? $get_theme_options['naomimoon_background'] : '#282A36' );
$naomimoon_background_secondary = ( isset( $get_theme_options['naomimoon_background_secondary'] ) && ! empty( $get_theme_options['naomimoon_background_secondary'] ) ? $get_theme_options['naomimoon_background_secondary'] : '#21242F' );
$naomimoon_body_font            = ( isset( $get_theme_options['naomimoon_body_font'] ) && ! empty( $get_theme_options['naomimoon_body_font'] ) ? $get_theme_options['naomimoon_body_font'] : '#F8F8F2' );
$naomimoon_header_bg            = ( isset( $get_theme_options['naomimoon_header_bg'] ) && ! empty( $get_theme_options['naomimoon_header_bg'] ) ? $get_theme_options['naomimoon_header_bg'] : '#21242f' );
$naomimoon_accent               = ( isset( $get_theme_options['naomimoon_accent'] ) && ! empty( $get_theme_options['naomimoon_accent'] ) ? $get_theme_options['naomimoon_accent'] : '#BD93F9' );
$naomimoon_header_font          = ( isset( $get_theme_options['naomimoon_header_font'] ) && ! empty( $get_theme_options['naomimoon_header_font'] ) ? $get_theme_options['naomimoon_header_font'] : '#FFF' );
$naomimoon_footer_bg            = ( isset( $get_theme_options['naomimoon_footer_bg'] ) && ! empty( $get_theme_options['naomimoon_footer_bg'] ) ? $get_theme_options['naomimoon_footer_bg'] : '#21242f' );
$naomimoon_footer_font          = ( isset( $get_theme_options['naomimoon_footer_font'] ) && ! empty( $get_theme_options['naomimoon_footer_font'] ) ? $get_theme_options['naomimoon_footer_font'] : '#FFF' );
$naomimoon_link_hover           = ( isset( $get_theme_options['naomimoon_link_hover'] ) && ! empty( $get_theme_options['naomimoon_link_hover'] ) ? $get_theme_options['naomimoon_link_hover'] : '#FF79C6' );
$naomimoon_gradient_1           = ( isset( $get_theme_options['naomimoon_gradient_1'] ) && ! empty( $get_theme_options['naomimoon_gradient_1'] ) ? $get_theme_options['naomimoon_gradient_1'] : '#ff79c5bd' );
$naomimoon_gradient_2           = ( isset( $get_theme_options['naomimoon_gradient_2'] ) && ! empty( $get_theme_options['naomimoon_gradient_2'] ) ? $get_theme_options['naomimoon_gradient_2'] : '#bd93f9ac' );

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<style>
		/* Body and Blocks */
		body.home, body.page-template {
			background: <?php echo esc_html( $naomimoon_background ); ?>;
			color: <?php echo esc_html( $naomimoon_body_font ); ?>;
		}
		.naomimoon-homepage__hero .hero-card,
		.experience-heading, .experience-block .col,
		.certificate-block .certificate-heading,
		.certificate-block .col {
			background: <?php echo esc_html( $naomimoon_background ); ?>;
		}
		.project-block .col.content,
		.experience-block h3,
		.contact-block .col {
			background: <?php echo esc_html( $naomimoon_background_secondary ); ?>;
		}
		/* Links */
		.project-block .col a,
		.certificate-block .col p a,
		.contact-block a h4 {
			color: <?php echo esc_html( $naomimoon_body_font ); ?>;
		}
		body.home a:hover,
		body.page-template a:hover,
		.certificate-block .col:hover p a,
		.contact-block a h4:hover,
		.naomimoon-header .main-navigation ul a:hover,
		.site-header .main-navigation ul a:hover {
			color: <?php echo esc_html( $naomimoon_link_hover ); ?>;
		}
		.project-block .col h4:hover {
			border-bottom: 1px solid <?php echo esc_html( $naomimoon_link_hover ); ?>;
		}
		.menu-item:after,
		.link-hover-animation:after {
			background-color: <?php echo esc_html( $naomimoon_link_hover ); ?>;
		}
		/* Header */
		header {
			background: <?php echo esc_html( $naomimoon_header_bg ); ?>;
		}
		.naomimoon-header .main-navigation ul a,
		.site-header .main-navigation ul a,
		.naomimoon-header__logo h5 a,
		.site-header__logo h5 a {
			color: <?php echo esc_html( $naomimoon_header_font ); ?>;
		}
		/* Footer */
		.site-footer, .site-footer a {
			background: <?php echo esc_html( $naomimoon_footer_bg ); ?>;
			color: <?php echo esc_html( $naomimoon_footer_font ); ?>;
		}
		/* Accent Design */
		.naomimoon-border-bottom {
			background: <?php echo esc_html( $naomimoon_accent ); ?>;
		}
		.naomimoon-homepage__about .square-border {
			border: 2px solid <?php echo esc_html( $naomimoon_accent ); ?>;
		}
		.contact-block img {
			border-bottom: 2px solid <?php echo esc_html( $naomimoon_accent ); ?>;
		}
		.site-footer .site-info .sep {
			color: <?php echo esc_html( $naomimoon_accent ); ?>;
		}
		.naomimoon-homepage .seperator {
			background: <?php echo esc_html( $naomimoon_accent ); ?>;
		}
		/* Gradient */
		.naomimoon-homepage__hero {
			background: linear-gradient(180deg, <?php echo esc_html( $naomimoon_gradient_1 ); ?> -20%, <?php echo esc_html( $naomimoon_gradient_2 ); ?> 70%)
		}
		.experience-block {
			background: linear-gradient(180deg, <?php echo esc_html( $naomimoon_gradient_2 ); ?> 0%, <?php echo esc_html( $naomimoon_gradient_1 ); ?> 90% );
		}
		.certificate-block {
			background: linear-gradient(180deg, <?php echo esc_html( $naomimoon_gradient_1 ); ?> -20%, <?php echo esc_html( $naomimoon_gradient_2 ); ?> 70%);
		}
	</style>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="masthead" class="site-header naomimoon-header">
		<div class="container row">
			<div class="naomimoon-header__logo">
				<h5 class="link-hover-animation"><a href="/">naomi keller</a></h5>
			</div>

			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'menu' => 'primary',
					)
				);
				?>
			</nav>

			<div class="naomimoon-header__hamburger">
				<img src="<?php echo esc_html( get_template_directory_uri() . '/assets/images/hamburger-icon.svg' ); ?>" alt="hamburger-icon" />
			</div>

		</div>
	</header>

	<div class="naomimoon-header__hamburger-menu">
		<?php
		wp_nav_menu(
			array(
				'menu' => 'primary',
			)
		);
		?>
	</div>

	<div class="dim-background"></div>
