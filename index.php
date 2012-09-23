<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Electric_Self
 * @since Electric Self 1.0
 */

get_header(); ?>
		
		<div id="primary" class="content" role="main">
			
			<?php if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'single' );
				endwhile;
				
			else : ?>
				
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->
					
					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
				
			<?php endif; ?>
			
			<nav id="nav-single">
				<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
				<span class="nav-previousnext"><?php posts_nav_link( ' ', __( '<span class="newer-posts-link threecolumn alignleft meta-nav">&larr; More recently on adamturner.org</span>', 'electricself' ), __( '<span class="older-posts-link threecolumn alignright meta-nav">Previously on adamturner.org &rarr;</span>', 'electricself' ) ); ?></span>
			</nav><!-- #nav-single -->
		</div><!-- #primary .content -->
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>