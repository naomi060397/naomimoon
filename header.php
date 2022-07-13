<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package naomimoon
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">

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
