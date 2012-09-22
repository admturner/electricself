<?php
/**
 * Electric Self functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * @package WordPress
 * @subpackage Electric_Self
 * @since Electric Self 1.0
 */

/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'twentyeleven_setup' );

/**
 * This is a custom version of twentyeleven_setup() for the Electric Photos theme
 *
 * Sets up theme defaults and registers support for various WordPress features.
 * Modification removed custom header option because we didn't need them
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Electric Photos 1.0
 */
function twentyeleven_setup() {
	/* Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use a find and replace
	 * to change 'twentyeleven' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyeleven', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );
	
	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'frontpage-thumb', 300, 185, true );
	add_image_size( 'frontpage-feature', 600, 371, true );
	add_image_size( 'epsmall-square', 75, 75, true );
	add_image_size( 'epsmall', 300, 300 );
	
	// Allow executing shortcodes in widgets
	add_filter( 'widget_text', 'do_shortcode' );
	
	// Remove default twentyeleven widgets to add our own
	remove_action( 'widgets_init', 'twentyeleven_widgets_init' );
	
	// Remove "Continue reading" link on get_the_excerpt() excerpts
	remove_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );
}

/**
 * Get rid of the in-line style from the Gallery shortcode
 *
 * @since Electric Photos 1.0
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Register our sidebars and widgetized areas.
 *
 * @since Electric Photos 1.0
 */
function electricphotos_widgets_init() {
	
	register_sidebar( array(
		'name' => __( 'Primary Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
		
	register_sidebar( array(
		'name' => __( 'Footer Area One', 'twentyeleven' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'twentyeleven' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'twentyeleven' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Site Generator', 'electricself' ),
		'id' => 'sidebar-6',
		'description' => __( 'An optional widget area for below the site footer', 'electricself' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'electricphotos_widgets_init' );

/**
 * Register and enqueue scripts in the footer
 *
 * @since Electric Photos 1.0
 */
function es_scripts() {
	// Manually enqueue the script for the Jetpack sharing plugin
	wp_enqueue_script( 'sharing-js-fe', plugin_dir_url( '/jetpack/modules/sharedaddy/sharing.js' ) . 'sharing.js', array( ), 2, true );
	// Moved the CSS for the Jetpack sharting plugin into my own to make it display how I like
	// wp_enqueue_style( 'sharing', plugin_dir_url( '/jetpack/modules/sharedaddy/sharing.css' ) . 'sharing.css', false );
	// wp_register_script( 'colorbox', get_bloginfo('stylesheet_directory') . '/lib/js/jquery/jquery.colorbox-min.js', '', '', true );
	// wp_register_script( 'hoverintent', get_bloginfo('stylesheet_directory') . '/lib/js/jquery/jquery.hoverIntent.minified.js', '', '', true );
	wp_register_script( 'epscript', get_bloginfo('stylesheet_directory') . '/lib/js/jquery/epscript.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'epscript' );
}
add_action( 'wp_print_styles', 'es_scripts' );

if ( !function_exists('es_header_entry_meta') ) :
	/**
	 * Prints the publication date for posts
	 *
	 * @since Electric Self 1.0
	 */
	function es_header_entry_meta() {
		printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'electricself' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
	}
endif; // End es_header_entry_meta()

if ( !function_exists('es_the_title') ) :
	/**
	 * Prints the title posts and linked title on the Home page
	 *
	 * @since Electric Self 1.0
	 */
	function es_the_title() {
		if ( is_home() ) {
			printf( __( '<a href="%1$s" title="%2$s">%3$s</a>', 'electricself' ),
				esc_url( get_permalink() ),
				esc_attr( get_the_title() ),
				get_the_title()
			);
		} else {
			the_title();
		}
	}
endif; // End es_the_title()

if ( !function_exists('es_footer_entry_meta') ) : 
	/**
	 * Prints the post footer meta
	 *
	 * Footer meta includes Categories, Tags, Author, and Permalink
	 * It is the standard Twenty Eleven function
	 *
	 * @since Electric Self 1.0
	 */
	function es_footer_entry_meta() {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ' &sect; ', 'electricself' ) );
		$tag_list = get_the_tag_list( '', __( ' &sect; ', 'electricself' ) );
		
		if ( '' != $tag_list ) {
			$utility_text = __( '<p class="half alignleft">This entry was posted in %1$s</p><p class="half alignleft last">It was tagged %2$s</p><h6>This was posted by <a href="%6$s">%5$s</a> on <time class="entry-date" datetime="%7$s" pubdate>%8$s</time>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a> if you\'d like to remember it, or <a href="%9$s" title="Comment on %4$s">Say what you think &raquo;</a></h6>', 'electricself' );
		} elseif ( '' != $categories_list ) {
			$utility_text = __( '<p>This entry was posted in %1$s</p><h6>This was posted by <a href="%6$s">%5$s</a> on <time class="entry-date" datetime="%7$s" pubdate>%8$s</time>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a> if you\'d like to remember it, or <a href="%9$s" title="Comment on %4$s">Say what you think &raquo;</a></h6>', 'electricself' );
		} else {
			$utility_text = __( '<h6>This was posted by <a href="%6$s">%5$s</a> on <time class="entry-date" datetime="%7$s" pubdate>%8$s</time>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a> if you\'d like to remember it, or <a href="%9$s" title="Comment on %4$s">Say what you think &raquo;</a></h6>', 'electricself' );
		}
		
		printf(
			$utility_text,
			$categories_list,
			$tag_list,
			esc_url( get_permalink() ),
			the_title_attribute( 'echo=0' ),
			get_the_author(),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_comments_link() )
		);
	}
endif; // End es_footer_entry_meta()

if ( !function_exists('es_comments_number') ) :
	/**
	 * Custom function to display comments count
	 *
	 * Essentially duplicates the functionality of the standard
	 * WordPress comments_number() function, in order to dodge some
	 * of IntenseDebate's hooks.
	 * 
	 * @usage es_comments_number( 'As yet, not a single comment.', 'A sole comment so far.', ' stellar comments.' );
	 * @since Electric Self 1.0
	 */
	function es_comments_number( $zero = false, $one = false, $more = false, $link = false ) {
		$n = get_comments_number();
		if ( $n > 1 ) {
			$output = str_replace('%', number_format_i18n($n), ( false === $more ) ? __('% stellar comments') : '% ' .  $more);
		} elseif ( $n == 0 ) {
			$output = ( false === $zero ) ? __('As yet, not a single comment.') : $zero;
		} else {
			$output = ( false === $one ) ? __('One comment so far.') : $one;
		}
		
		printf ( __('<h5>%1$s</h5><h6><a href="%2$s" title="Post a comment on %3$s">Comment &raquo;</a></h6>', 'electricself' ),
			$output,
			esc_url( get_comments_link() ),
			the_title_attribute( 'echo=0' )
		);
	}
endif; // End es_comments_number()

if ( !function_exists('es_article_divider') ) :
	/**
	 * Prints a decorative utility bar wherever it's called
	 *
	 * Used in this theme after articles. It is a decorated
	 * divider to separate articles and includes a "Back to top"
	 * button and sharing links generated by Jetpack's Share
	 *
	 * @uses Jetpack plugin
	 * @uses sharing_display()
	 *
	 * @since Electric Self 1.0
	 */ 
	function es_article_divider() {
		echo '<div class="utility-divider aligncenter third">';
			echo '<h6 class="alignleft third"><a href="#branding">Back to top</a></h6>';
			// Manually print the sharing buttons generated by the Jetpack Share plugin
			echo sharing_display();
		echo '</div>';
	}
endif; // End es_article_divider()	


if ( !function_exists('electricself_comment') ) : 
	/**
	 * Template for comments, pingbacks, and trackbacks
	 * 
	 * This function (called in comments.php) takes care of
	 * displaying individual comments, pingbacks, and trackbacks.
	 * Modified from the standard Twenty Eleven version of the
	 * same function, called twentyeleven_comment().
	 * 
	 * @since Electric Self 1.0
	 */
	function electricself_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'electricself' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment-item comment">
				<footer class="comment-meta">
					<h6 class="comment-author vcard">
						<?php
							$avatar_size = '0' != $comment->comment_parent ? 42 : 56;
							echo get_avatar( $comment, $avatar_size );
							
							/* translators: 1: comment author, 2: time and date [linked]  */
							printf( __( '%1$s, %2$s, <span class="says">said:</span>', 'electricself' ),
								sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
								sprintf( '<time pubdate datetime="%1$s">%2$s</time>',
									get_comment_time( 'c' ),
									sprintf( __( 'at %2$s on <a href="%3$s" title="Link to this comment">%1$s</a>', 'electricself' ), 
										get_comment_date(), 
										get_comment_time(),
										esc_url( get_comment_link( $comment->comment_ID ) )
									)
								)
							);
						?>
					</h6><!-- .comment-author .vcard -->
					
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is being moderated. Thanks for waiting.', 'electricself' ); ?></em>
						<br />
					<?php endif; ?>
				</footer><!-- .comment-meta -->
				
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>
				
				<div class="reply">
					<?php edit_comment_link( __( 'Edit', 'electricself' ), '<span class="edit-link">', '</span>' ); ?>
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'electricself' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</article><!-- #comment-## -->
		
		<?php
				break;
		endswitch;
	}
endif; // End electricself_comment()


if ( !function_exists('es_more_exif') ) :
	/**
	 * Adds some additional EXIF data to WP default
	 *
	 * Thanks to kristarella's lovely Exifography plugin for this
	 * function. (@see http://www.kristarella.com/exifography)
	 *
	 * @since Electric Photos 1.0
	 */
	function es_more_exif($meta, $file, $sourceImageType) {
		if ( is_callable('exif_read_data') && in_array($sourceImageType, apply_filters('wp_read_image_metadata_types', array(IMAGETYPE_JPEG, IMAGETYPE_TIFF_II, IMAGETYPE_TIFF_MM)) ) ) {
			$exif = @exif_read_data( $file );
				if (!empty($exif['GPSLatitude']))
					$meta['latitude'] = $exif['GPSLatitude'] ;
				if (!empty($exif['GPSLatitudeRef']))
					$meta['latitude_ref'] = trim( $exif['GPSLatitudeRef'] );
				if (!empty($exif['GPSLongitude']))
					$meta['longitude'] = $exif['GPSLongitude'] ;
				if (!empty($exif['GPSLongitudeRef']))
					$meta['longitude_ref'] = trim( $exif['GPSLongitudeRef'] );
				if (!empty($exif['ExposureBiasValue']))
					$meta['exposure_bias'] = trim( $exif['ExposureBiasValue'] );
				if (!empty($exif['Flash']))
					$meta['flash'] = trim( $exif['Flash'] );
		
		return $meta;
		}
	}
	add_filter('wp_read_image_metadata', 'es_more_exif', '', 3);
endif; // End es_more_exif()

/**
 * Prints path of current WP template at top of screen
 *
 * @for Debugging
 *

add_action('wp_head', 'show_template');
function show_template() {
    global $template;
    print_r($template);
}
 */
?>