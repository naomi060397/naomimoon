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

			$paged = max( 1, get_query_var( 'paged' ) ); //phpcs:ignore

			$posts_per_page = 4;
			$offset_start   = 0;
			$offset         = $paged ? ( $paged - 1 ) * $posts_per_page + $offset_start : $offset_start;

			$args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $posts_per_page,
				'offset'         => $offset,
			);

			$naomimoon_posts = new WP_Query( $args );

			$naomimoon_posts->found_posts   = max( 0, $naomimoon_posts->found_posts - $offset_start );
			$naomimoon_posts->max_num_pages = ceil( $naomimoon_posts->found_posts / $posts_per_page );

			?>
			<div class="naomimoon-blog__post container">
				<?php
				if ( $naomimoon_posts->have_posts() ) :
					while ( $naomimoon_posts->have_posts() ) :
						$naomimoon_posts->the_post();
						?>
						<div class="flex">
							<h2><?php the_title(); ?></h2>
							<span><?php echo get_the_date(); ?></span>
						</div>
						<p><?php the_content(); ?></p>
					<?php endwhile; ?>
					<div class="pagination">
						<?php
						echo paginate_links( //phpcs:ignore
							array(
								'current' => $paged,
								'total'   => $naomimoon_posts->max_num_pages,
							)
						);
						?>
					</div>
				</div>
				<?php else : ?>
					<p><?php echo esc_html( 'There are no posts to display at the moment' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="seperator"></div>
	</main>
