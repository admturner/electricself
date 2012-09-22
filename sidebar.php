<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Electric_Self
 * @since Electric Self 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
			
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : 
				
				// What to do if there are no Primary Sidebar widgets
				
			endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->