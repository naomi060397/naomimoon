<?php
/**
 * Template Name: Home
 *
 * @package naomimoon
 */

get_header();
?>

	<main id="primary" class="site-main naomimoon-homepage">
		<div class="naomimoon-homepage__content">
			<div class="naomimoon-homepage__experience b-break t-break" id="experience">
				<div class="container">
					<div class="experience-heading">
						<h2 class="home-heading mb-30">Experience</h2>
						<span class="naomimoon-border-bottom"></span>
					</div>
					<div class="row">
						<div class="col">
							<h3>JavaScript</h3>
							<ul>
								<li>ES6</li>
								<li>React.JS</li>
								<li>Node.js</li>
								<li>jQuery</li>
								<li>REST API</li>
								<li>AJAX</li>
								<li>OOP Principles</li>
							</ul>
						</div>
						<div class="col">
							<h3>WordPress</h3>
							<ul>
								<li>Static & Dynamic Blocks</li>
								<li>Plugin Development</li>
								<li>Theme Development</li>
								<li>Custom Post Types & Taxonomies</li>
								<li>ACF Integration with CPT's</li>
								<li>MySQL Database Management</li>
								<li>Site Migrations</li>
								<li>WP_Query</li>
							</ul>
						</div>
						<div class="col">
							<h3>HTML/CSS</h3>
							<ul>
								<li>Sass & LESS</li>
								<li>Bootstrap 5</li>
								<li>Responsive Design</li>
								<li>Mobile First Design</li>
							</ul>
						</div>
						<div class="col">
							<h3>PHP</h3>
							<ul class="php-ul">
								<li>Dynamic Rendering</li>
								<li>OOP Principles</li>
								<li>PHPCS / PHPCBF Standards</li>
							</ul>
						</div>
						<div class="col">
							<h3>Design</h3>
							<ul class="design-ul">
								<li>Figma</li>
								<li>Adobe XD</li>
								<li>Adobe Photoshop</li>
							</ul>
						</div>
						<div class="col">
							<h3>Other</h3>
							<ul class="other-ul">
								<li>GitHub Version Control</li>
								<li>Scrum Methodology</li>
								<li>Discord Bot Dev.</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
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
		</div>
	</main>

<?php
get_footer();
