<?php
/**
 * The template used to display Tag Archive pages
 *
 * @package WordPress
 * @subpackage Electric_Self
 * @since Electric Self 1.1
 */

get_header(); ?>
		
		<div id="primary" class="content" role="main">
			
			<?php if ( have_posts() ) : ?>
				
				<header class="page-header">
					<h1 class="page-title"><?php
						printf( __( 'Tag Archives: %s', 'twentyeleven' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					?></h1>
					
					<?php
						$tag_description = tag_description();
						if ( ! empty( $tag_description ) )
							echo apply_filters( 'tag_archive_meta', '<div class="entry-meta tag-archive-meta">' . $tag_description . '</div>' );
					?>
				</header>
				
				<?php twentyeleven_content_nav( 'nav-above' ); ?>
				
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_excerpt(); ?>
				<?php endwhile; ?>
				
				<?php twentyeleven_content_nav( 'nav-below' ); ?>
				
			<?php else : ?>
				
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
			
		</div><!-- #primary .content -->
<?php get_footer(); ?>
