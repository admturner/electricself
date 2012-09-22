<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Electric_Self
 * @since Electric Self 1.0
 */

get_header(); ?>

		<div id="primary" class="content" role="main">
			
			<?php while ( have_posts() ) : the_post();
				get_template_part( 'content', 'page' );
				comments_template( '', true );
			endwhile; // end of the loop. ?>
			
		</div><!-- #primary .content -->

<?php get_footer(); ?>