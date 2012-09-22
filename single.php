<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Electric_Self
 * @since Electric Self 1.0
 */

get_header(); ?>
		
		<div id="primary" class="content" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>
								
				<nav id="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr; To %title</span>', 'twentyeleven' ) ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', __( '<span class="meta-nav">To %title &rarr;</span>', 'twentyeleven' ) ); ?></span>
				</nav><!-- #nav-single -->
				
				<?php get_template_part( 'content', 'single' ); ?>
					
				<?php comments_template( '', true ); ?>
				
			<?php endwhile; // end of the loop. ?>
			
		</div><!-- #primary .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>