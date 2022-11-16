<?php
/**
 * The template for displaying the footer
 *
 * @package naomimoon
 */

// Set data variables.
$theme_general_options = get_option( 'naomimoon_general_settings' );
$footer_link_1         = ( isset( $theme_general_options['footer_link_1'] ) && ! empty( $theme_general_options['footer_link_1'] ) ? $theme_general_options['footer_link_1'] : '' );
$footer_link_1_text    = ( isset( $theme_general_options['footer_link_1_text'] ) && ! empty( $theme_general_options['footer_link_1_text'] ) ? $theme_general_options['footer_link_1_text'] : '' );
$footer_link_2         = ( isset( $theme_general_options['footer_link_2'] ) && ! empty( $theme_general_options['footer_link_2'] ) ? $theme_general_options['footer_link_2'] : '' );
$footer_link_2_text    = ( isset( $theme_general_options['footer_link_2_text'] ) && ! empty( $theme_general_options['footer_link_2_text'] ) ? $theme_general_options['footer_link_2_text'] : '' );
$footer_link_3         = ( isset( $theme_general_options['footer_link_3'] ) && ! empty( $theme_general_options['footer_link_3'] ) ? $theme_general_options['footer_link_3'] : '' );
$footer_link_3_text    = ( isset( $theme_general_options['footer_link_3_text'] ) && ! empty( $theme_general_options['footer_link_3_text'] ) ? $theme_general_options['footer_link_3_text'] : '' );

?>
	<footer id="colophon" class="site-footer">
		<div class="site-info container">
			<div>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'naomimoon' ) ); ?>">
					Powered by WordPress
				</a>
				<?php if ( $footer_link_1 ) : ?>
					<span class="sep"> &#8226; </span>
					<a href="<?php echo esc_url( $footer_link_1 ); ?>"><?php echo esc_html( $footer_link_1_text ); ?></a>
				<?php endif; ?>
				<?php if ( $footer_link_2 ) : ?>
					<span class="sep"> &#8226; </span>
					<a href="<?php echo esc_url( $footer_link_2 ); ?>"><?php echo esc_html( $footer_link_2_text ); ?></a>
				<?php endif; ?>
				<?php if ( $footer_link_3 ) : ?>
					<span class="sep"> &#8226; </span>
					<a href="<?php echo esc_url( $footer_link_3 ); ?>"><?php echo esc_html( $footer_link_3_text ); ?></a>
				<?php endif; ?>
			</div>
			<div>
				<a class="back-to-top">Back to Top<span class="dashicons dashicons-arrow-up-alt2"></span></a>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
