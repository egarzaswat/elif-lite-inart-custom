<?php

/**
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Dynamic CSS
if ( !function_exists( 'elif_dynamic_css' ) ) {
	function elif_dynamic_css() {
		// Header
        $header_color = esc_attr( get_theme_mod( 'elif_header_color', ELIF_HEADER_COLOR ) );
        $header_color_css = ( $header_color != '' )? '.site-header,.site-header a,.site-tagline span,.main-navigation .menu > li > a,.main-navigation .menu > li:hover > a,.main-navigation .no-menu-msg,.main-navigation .no-menu-msg a,.sb-toggle,.site-logo a,.site-header .mobile-menu-wrap .menu a,.layout-simple .site-header .sidebar-widget .widget-title h3, .layout-simple .site-header .sidebar-widget input, .layout-simple .site-header .sidebar-widget  button, .site-header .sidebar-widget .widget-posts-wrap .title a,.layout-simple .footer-social a{color:'.$header_color.';}.site-tagline span:before,.layout-simple .site-header .sidebar-widget .widget-title:after{background-color:'.$header_color.';}.sb-toggle,.main-navigation .menu > li:hover:before,.main-navigation .menu > li:hover:after,.layout-simple .site-header .sidebar-widget input{border-color:'.$header_color.';}.site-header .mobile-menu-wrap .menu a:hover{background-color:'.elif_hex_to_rgba( $header_color, 0.2 ).';}' : '';

		$header_bg_ov = absint( get_theme_mod( 'elif_header_bg_overlay', ELIF_HEADER_BG_OVERLAY ) ) / 100;
		$header_bg_ov_css = ( $header_bg_ov > 0 )? '.h-overlay{background-color:rgba(0, 0, 0, '.$header_bg_ov.');}' : '';

		$header_bg = esc_url( get_theme_mod( 'elif_header_bg', ELIF_HEADER_BG ) );
        $header_bg_color = esc_attr( get_theme_mod( 'elif_header_bg_color', ELIF_HEADER_BG_COLOR ) );
        $header_bg_attachment = absint( get_theme_mod( 'elif_header_bg_attachment', ELIF_HEADER_BG_ATTACHMENT ) );
        $header_bg_css = '';
        if ( $header_bg != '' || $header_bg_color != '' ) {
            $header_bg_css .= '.site-header,.layout-simple .header-sidebar{background-image:url('.$header_bg.');background-repeat: no-repeat;background-position: center center;background-size: cover;';
            if ( $header_bg_color != '' ) {
                $header_bg_css .= 'background-color:'.$header_bg_color.';';
            }
            if ( $header_bg_attachment == 1 ) {
                $header_bg_css .= 'background-attachment:fixed;';
            }
            $header_bg_css .= '}';
        }
        
        $theme_color = esc_attr( get_theme_mod( 'elif_theme_color', ELIF_THEME_COLOR ) );
		$theme_color_css = ( $theme_color != '' )? 'a,a:hover,a:focus,.cats a,input[type="button"],input[type="reset"],input[type="submit"],button,.button,.moretag a,.pagination a,.site-tagline span,.author-box .author span,.post-navigation div:before,.post-navigation div:after,.post-title a:hover, .widget-posts-wrap .title a:hover, .tags a,.main-navigation .menu > li > a,.main-navigation .menu > li:hover > a,blockquote:before,.widget_meta li a:hover,.widget_categories li a:hover, .widget_archive li a:hover, .widget_rss li a:hover, .widget_recent_entries li a:hover,.widget_recent_comments li a:hover{color:'. $theme_color .';}input[type="button"],input[type="reset"],input[type="submit"],button,.button,.moretag a,.pagination a,input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, button:hover, .button:hover, .moretag a:hover, .tags a, .tags a:hover, .pagination a:hover,.sb-toggle, .main-navigation .menu > li:hover:before, .main-navigation .menu > li:hover:after,.scrollToTop:hover{border-color:'. $theme_color .';}.section-title:after,.sidebar-widget .widget-title:after,input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, button:hover, .button:hover, .moretag a:hover, .tags a:hover, .pagination a:hover,.scrollToTop:hover,.site-tagline span:before{background-color:'. $theme_color .';}' : '';

        $theme_selection_css = ( $theme_color != '' )? '::-moz-selection{color: '. $theme_color .';background-color: '. elif_hex_to_rgba( $theme_color, .2 ) .';}::selection{color: '. $theme_color .';background-color: '. elif_hex_to_rgba( $theme_color, .2 ) .';}': '';

        $theme_scrollbar_css = ( $theme_color != '' )? '::-webkit-scrollbar-thumb:hover{border-color:'. $theme_color .';}::-webkit-scrollbar-thumb:hover{background-color:'. $theme_color .';}': '';

        $output = '';
		$output .= $theme_color_css;
        $output .= $theme_selection_css;
        $output .= $theme_scrollbar_css;
        $output .= $header_bg_css;
        $output .= $header_color_css;
        $output .= $header_bg_ov_css; ?>
		<style type="text/css">
            <?php echo $output ?>
		</style>
    <?php }
}
add_action( 'wp_head', 'elif_dynamic_css' );

// Customizer CSS Output
function elif_customizer_assets() {
    wp_enqueue_style( 'elif-customizer', get_template_directory_uri() .'/inc/customizer/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'elif_customizer_assets' );