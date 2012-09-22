<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Electric_Self
 * @since Electric Self 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<h6><?php es_header_entry_meta(); ?></h6>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		<h1 class="entry-title"><?php es_the_title(); ?></h1>
	</header><!-- .entry-header -->
	
	<div class="entry-content">
		<?php
			/* A janky way to remove Jetpack Sharedaddy sharing links
			 * so we can do it manually in functions. Hopefully this'll
			 * be fixed in a later version
			 */
			remove_filter( 'the_content', 'sharing_display', 19 );
			remove_filter( 'the_excerpt', 'sharing_display', 19 );
			
			if ( has_post_thumbnail() ) the_post_thumbnail( 'frontpage-feature' );
			the_content();
			wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) );
		?>
	</div><!-- .entry-content -->
	
	<div class="entry-meta twocolumn alignleft last comment-count">
		<?php es_comments_number(); ?>
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
	
	<footer class="footer-meta entry-meta">
		<?php es_footer_entry_meta(); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php es_article_divider(); ?>