<?php
/**
 * Theme Header
 *
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>

<?php $theme_layout = esc_attr( get_theme_mod( 'elif_theme_layout', ELIF_THEME_LAYOUT ) );
$sidebar_layout = esc_attr( get_theme_mod( 'elif_sidebar_layout', ELIF_SIDEBAR_LAYOUT ) );
$box_border = esc_attr( get_theme_mod( 'elif_box_border', ELIF_BOX_BORDER ) );

$header_bg = esc_url( get_theme_mod( 'elif_header_bg', ELIF_HEADER_BG ) );
$header_bg_attachment = absint( get_theme_mod( 'elif_header_bg_attachment', ELIF_HEADER_BG_ATTACHMENT ) );

$class = 'layout-'. $theme_layout .' sidebar-'. $sidebar_layout .' box-'. $box_border;

$class .= ( $header_bg != '' )? ' hd-bg-active': '';
$class .= ( $header_bg != '' && $header_bg_attachment == 1 )? ' hd-parallax': ''; ?>

<body <?php body_class( $class ); ?>>
    <div id="page" class="hfeed sb-slide">

        <header id="masthead" class="site-header" role="banner">
            <div class="h-overlay"></div>
            <div class="container clearfix">

                <div class="site-logo"><?php elif_logo(); ?></div>
                <?php $tagline_toggle = absint( get_theme_mod( 'elif_tagline_toggle', ELIF_TAGLINE_TOGGLE ) );
                if ( $tagline_toggle == 1 ) { ?>
                    <div class="site-tagline"><span><?php bloginfo( 'description' ); ?></span></div>
                <?php } ?>

                <?php if ( $theme_layout == 'simple' ) { ?>

                    <div class="sb-toggle sb-toggle-<?php echo elif_mobile_menu_side(); ?> visible-xs-inline-block">
                        <i class="fa fa-bars" aria-hidden="true"></i><?php esc_attr_e( 'Menu', 'elif-lite' ); ?>
                    </div>
                
                    <div class="header-sidebar" data-sb-width="280px">
                        <nav class="mobile-menu-wrap" role="navigation">
                            <?php elif_render_menu( 'primary-menu', array( 'theme_location' => 'primary-menu', 'walker' => new Elif_Mobile_Menu_Walker() ) ); ?>
                        </nav>

                        <?php get_sidebar();
                        elif_footer_social();
                        elif_footer_copyright(); ?>

                    </div>
                
                <div class="obfuscator sb-toggle sb-toggle-<?php echo elif_mobile_menu_side(); ?>"></div>

                <?php } ?>

            </div>
        </header>

        <div class="content-wrap sb-slide">
            <?php if ( $theme_layout != 'simple') { ?>
                <div class="navigation-container container clearfix">
                    <div class="main-navigation hidden-xs" role="navigation">
                        <?php elif_render_menu( 'primary-menu', array( 'theme_location' => 'primary-menu' ) ); ?>
                    </div>

                    <div class="sb-toggle sb-toggle-<?php echo elif_mobile_menu_side(); ?> visible-xs-inline-block">
                        <i class="fa fa-bars" aria-hidden="true"></i><?php esc_attr_e( 'Menu', 'elif-lite' ); ?>
                    </div>
                </div>
            <?php } ?>