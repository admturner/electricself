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
					<header class="entry-header">
						<?php if ( 'post' == get_post_type() ) : ?>
							<div class="entry-meta">
								<h6><?php es_header_entry_meta(); ?></h6>
							</div><!-- .entry-meta -->
						<?php endif; ?>
						<h1 class="entry-title"><?php es_the_title(); ?></h1>
					</header><!-- .entry-header -->
					
					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div><!-- .entry-content -->
					
					<div class="entry-meta twocolumn alignleft last comment-count">
						<?php es_comments_number(); ?>
						<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
					
					<footer class="footer-meta entry-meta">
						<?php es_footer_entry_meta(); ?>
					</footer><!-- .entry-meta -->
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
