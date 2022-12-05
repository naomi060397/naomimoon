<?php
/**
 * Template Name: Blog
 *
 * @package naomimoon
 */

get_header();
?>

	<main id="primary" class="site-main naomimoon-blog">
		<!-- Content from Editor -->
		<div class="entry-content">

			<div class="naomimoon-blog__header">
				<h1>Naomi Moon: Blog</h1>
			</div>

			<?php

			$args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => 3,
			);

			$naomimoon_posts = new WP_Query( $args );
			?>
			<div class="naomimoon-blog__post container">
				<?php
				if ( $naomimoon_posts->have_posts() ) :
					while ( $naomimoon_posts->have_posts() ) :
						$naomimoon_posts->the_post();
						?>
						<div class="flex">
							<h2><?php the_title(); ?></h2>
							<span><?php the_date(); ?></span>
						</div>
						<p><?php the_content(); ?></p>
					<?php endwhile; ?>
					<?php
					the_posts_pagination();
					?>
				<?php else : ?>
					<p><?php echo esc_html( 'There are no posts to display at the moment' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="seperator"></div>
	</main>
