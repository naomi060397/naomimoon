<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package naomimoon
 */

$get_theme_options              = get_option( 'naomimoon_settings' );
$naomimoon_background           = ( isset( $get_theme_options['naomimoon_background'] ) && ! empty( $get_theme_options['naomimoon_background'] ) ? $get_theme_options['naomimoon_background'] : '#282A36' );
$naomimoon_background_secondary = ( isset( $get_theme_options['naomimoon_background_secondary'] ) && ! empty( $get_theme_options['naomimoon_background_secondary'] ) ? $get_theme_options['naomimoon_background_secondary'] : '#21242F' );
$naomimoon_body_font            = ( isset( $get_theme_options['naomimoon_body_font'] ) && ! empty( $get_theme_options['naomimoon_body_font'] ) ? $get_theme_options['naomimoon_body_font'] : '#F8F8F2' );
$naomimoon_header_bg            = ( isset( $get_theme_options['naomimoon_header_bg'] ) && ! empty( $get_theme_options['naomimoon_header_bg'] ) ? $get_theme_options['naomimoon_header_bg'] : '#21242f' );
$naomimoon_accent               = ( isset( $get_theme_options['naomimoon_accent'] ) && ! empty( $get_theme_options['naomimoon_accent'] ) ? $get_theme_options['naomimoon_accent'] : '#BD93F9' );
$naomimoon_header_font          = $get_theme_options['naomimoon_header_font'];
$naomimoon_header_font_active   = $get_theme_options['naomimoon_header_font_active'];

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<style>
		body.home, body.page-template {
			background: <?php echo esc_html( $naomimoon_background ); ?>;
			color: <?php echo esc_html( $naomimoon_body_font ); ?>;
		}
		.project-block .col a {
			color: <?php echo esc_html( $naomimoon_body_font ); ?>;
		}
		header {
			background: <?php echo esc_html( $naomimoon_header_bg ); ?>;
		}
		.naomimoon-homepage__hero .hero-card, .experience-heading, .experience-block .col, .certificate-block .certificate-heading, .certificate-block .col {
			background: <?php echo esc_html( $naomimoon_background ); ?>;
		}
		.project-block .col.content, .experience-block h3, .contact-block .col {
			background: <?php echo esc_html( $naomimoon_background_secondary ); ?>;
		}
		.main-navigation a {
			color: 
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
