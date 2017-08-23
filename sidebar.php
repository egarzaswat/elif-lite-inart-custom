<?php

/**
 * The sidebar containing the main widget area.
 *
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$sidebar_layout = esc_attr( get_theme_mod( 'elif_sidebar_layout', ELIF_SIDEBAR_LAYOUT ) );
if ( !is_active_sidebar( 'main-sidebar' ) || $sidebar_layout == 'none' ) {
	return;
} ?>

<div id="secondary" class="widget-area col-md-4 col-sm-12 col-xs-12" role="complementary">
	<div class="sidebar">
		<?php dynamic_sidebar( 'main-sidebar' ); ?>
	</div>
</div><!-- #secondary -->