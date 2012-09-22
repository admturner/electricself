<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Electric_Self
 * @since Electric Self 1.0
 */
?>

	</div><!-- #main -->
	
	<footer id="colophon" role="contentinfo">
			<?php get_sidebar( 'footer' ); ?>
			
			<div id="site-generator">
				<?php if ( is_active_sidebar( 'sidebar-6' ) ) {
					dynamic_sidebar( 'sidebar-6' );
				} else { 
					?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyeleven' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentyeleven' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'twentyeleven' ), 'WordPress' ); ?></a><?php 
				} ?>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>