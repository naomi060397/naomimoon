<?php
/**
 * Template Name: Homepage
 *
 * @package naomimoon
 */

get_header();
?>

	<main id="primary" class="site-main naomimoon-homepage">
		<!-- Content from Editor -->
		<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'naomimoon' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'naomimoon' ),
				'after'  => '</div>',
			)
		);
		?>
		</div>
		<div class="seperator"></div>
	</main>
