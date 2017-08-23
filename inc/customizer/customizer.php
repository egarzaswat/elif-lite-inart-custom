<?php
/**
 * Theme Customizer
 *
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*-----------------------------------------------------------------------------------*/
/* Require Classes & Functions
/*-----------------------------------------------------------------------------------*/
require_once( get_template_directory() . '/inc/customizer/customizer-render.php' );
require_once( get_template_directory() . '/inc/customizer/customizer-output.php' );
require_once( get_template_directory() . '/inc/customizer/customizer-sanitize.php' );
require_once( get_template_directory() . '/inc/customizer/customizer-controls.php' );

/*-----------------------------------------------------------------------------------*/
/*  Registering the Customizer Settings
/*-----------------------------------------------------------------------------------*/
function elif_options_theme_customizer_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Header
	elif_customizer_render_section ( 'elif_header', esc_attr__( 'Header', 'elif-lite' ), '', 20 );

			// Hide Site Tagline
			elif_customizer_render_switcher ( 'elif_tagline_toggle', 'elif_header', esc_attr__( 'Site Tagline', 'elif-lite' ), 1, ELIF_TAGLINE_TOGGLE, '' );

			// Menu Position
			elif_customizer_render_radio_button ( 'elif_mobile_menu_side', 'elif_header', esc_attr__( 'Off-canvas Menu Side', 'elif-lite' ), array(
                'left' => esc_attr__( 'Left', 'elif-lite' ),
                'right' => esc_attr__( 'Right', 'elif-lite' ),
            ), 2, ELIF_MOBILE_MENU_SIDE, '' );

			// Text Color
            elif_customizer_render_alpha_color( 'elif_header_color', 'elif_header', esc_attr__( 'Text Color', 'elif-lite' ), 3, ELIF_HEADER_COLOR, '' );

			// Background Color
			elif_customizer_render_alpha_color( 'elif_header_bg_color', 'elif_header', esc_attr__( 'Background Color', 'elif-lite' ), 4, ELIF_HEADER_BG_COLOR, '' );

			// Background Image
			elif_customizer_render_uploader ( 'elif_header_bg', 'elif_header', esc_attr__( 'Background Image', 'elif-lite' ), 5, ELIF_HEADER_BG, '' );

			// Background Overlay
			elif_customizer_render_range ( 'elif_header_bg_overlay', 'elif_header', esc_attr__( 'Background Overlay', 'elif-lite' ), 6, ELIF_HEADER_BG_OVERLAY, 0, 100, esc_html__( 'Header background overlay, from 0 to 100.', 'elif-lite' ) );

            // Fixed Background
			elif_customizer_render_checkbox ( 'elif_header_bg_attachment', 'elif_header', esc_attr__( 'Fixed Background', 'elif-lite' ), 7, ELIF_HEADER_BG_ATTACHMENT, '' );

	// Blog Settings
	elif_customizer_render_section ( 'elif_archives', esc_attr__( 'Blog & Archives', 'elif-lite' ), '', 30 );
    
            // Featured Image
			elif_customizer_render_switcher ( 'elif_post_featured', 'elif_archives', esc_attr__( 'Featured Image', 'elif-lite' ), 1, ELIF_POST_FEATURED, '' );

			// ReadMore Text
			elif_customizer_render_textfield ( 'elif_article_link_text', 'elif_archives', esc_attr__( 'ReadMore Text', 'elif-lite' ), 2, ELIF_ARTICLE_TEXT, '', 'elif_sanitize_text' );

			// Background Type
			elif_customizer_render_radio_button ( 'elif_navigation_type', 'elif_archives', esc_attr__( 'Navigation Type', 'elif-lite' ), array( 
                'simple' => esc_attr__( 'Simple', 'elif-lite' ),
                'numbered' => esc_attr__( 'Numbered', 'elif-lite' ),
            ), 3, ELIF_NAVIGATION_TYPE, '' );

	// Post Settings
	elif_customizer_render_section ( 'elif_articles', esc_attr__( 'Article Settings', 'elif-lite' ), '', 40 );

			// Next/Prev Post
			elif_customizer_render_switcher ( 'elif_post_next_prev', 'elif_articles', esc_attr__( 'Next/Prev Links', 'elif-lite' ), 1, ELIF_POST_NEXT_PREV, esc_html__( 'Show or hide next post and previous post links on single post page.', 'elif-lite' ) );

			// Related Posts
			elif_customizer_render_switcher ( 'elif_related_posts', 'elif_articles', esc_attr__( 'Related Posts', 'elif-lite' ), 2, ELIF_RELATED_POSTS, esc_html__( 'Show or hide related posts on single post page.', 'elif-lite' ) );			

			// Related Posts Number
			elif_customizer_render_number ( 'elif_related_posts_number', 'elif_articles', esc_attr__( 'Related Posts Number', 'elif-lite' ), 3, ELIF_RELATED_POSTS_NUMBER, 1, 6, '' );
			
			// Related Posts Query
			elif_customizer_render_radio_button ( 'elif_related_posts_query', 'elif_articles', esc_attr__( 'Related Posts Query', 'elif-lite' ), array( 
                'tags' => esc_attr__( 'By Tags', 'elif-lite' ), 
                'categories' => esc_attr__( 'By Categories', 'elif-lite' ), 
            ), 4, ELIF_RELATED_POSTS_QUERY, esc_html__( 'Query related posts either by tags or categories.', 'elif-lite' ) );
    
			// Related Posts Meta
			elif_customizer_render_switcher ( 'elif_related_posts_meta', 'elif_articles', esc_attr__( 'Related Posts Meta', 'elif-lite' ), 5, ELIF_RELATED_POSTS_META, '' );

			// Related Posts Excerpt
			elif_customizer_render_switcher ( 'elif_related_posts_excerpt', 'elif_articles', esc_attr__( 'Related Posts Excerpt', 'elif-lite' ), 6, ELIF_RELATED_POSTS_EXCERPT, '' );
			
			// Author Box
			elif_customizer_render_switcher ( 'elif_author_box', 'elif_articles', esc_attr__( 'Author Box', 'elif-lite' ), 7, ELIF_AUTHOR_BOX, '' );

	// Design & Layout
	elif_customizer_render_section ( 'elif_design', esc_attr__( 'Design & Layout', 'elif-lite' ), '', 50 );

            // Theme Color
			elif_customizer_render_color( 'elif_theme_color', 'elif_design', esc_attr__( 'Theme Color', 'elif-lite' ), 1, ELIF_THEME_COLOR, '' );

            // Theme Layout
			elif_customizer_render_radio_button ( 'elif_theme_layout', 'elif_design', esc_attr__( 'Theme Layout', 'elif-lite' ), array( 
                'default' => esc_attr__( 'Default', 'elif-lite' ),
                'simple' => esc_attr__( 'Simple', 'elif-lite' ),
            ), 2, ELIF_THEME_LAYOUT, '' );

			// Sidebar Layout
			elif_customizer_render_radio_image ( 'elif_sidebar_layout', 'elif_design', esc_attr__( 'Sidebar Layout', 'elif-lite' ), array( 
                'right' => get_template_directory_uri() .'/images/customizer/sidebar_right.png',
                'left' => get_template_directory_uri() .'/images/customizer/sidebar_left.png',
                'none' => get_template_directory_uri() .'/images/customizer/sidebar_no.png',
            ), 3, ELIF_SIDEBAR_LAYOUT, '' );

            // Box Border Style
			elif_customizer_render_radio_button ( 'elif_box_border', 'elif_design', esc_attr__( 'Box Border Style', 'elif-lite' ), array(
                'none' => esc_attr__( 'None', 'elif-lite' ),
                'solid' => esc_attr__( 'Solid', 'elif-lite' ),
                'shadow' => esc_attr__( 'Shadow', 'elif-lite' ),
            ), 4, ELIF_BOX_BORDER, '' );

            // Animations
			elif_customizer_render_radio_button ( 'elif_animations', 'elif_design', esc_attr__( 'Animation Settings', 'elif-lite' ), array( 
                'on' => esc_attr__( 'Enabled', 'elif-lite' ),
                'off' => esc_attr__( 'Disabled', 'elif-lite' ),
                'off-on-mobiles' => esc_attr__( 'Desktop Only', 'elif-lite' ),
            ), 5, ELIF_ANIMATIONS, '' );

	// Footer
	elif_customizer_render_section ( 'elif_footer', esc_attr__( 'Footer', 'elif-lite' ), '', 80 );

			// Social Links
			elif_customizer_render_switcher ( 'elif_footer_social', 'elif_footer', esc_attr__( 'Social Links', 'elif-lite' ), 1, ELIF_FOOTER_SOCIAL, esc_html__( 'Show or hide social links in footer.', 'elif-lite' ) );
			
			// Facebook
			elif_customizer_render_textfield ( 'elif_footer_fb', 'elif_footer', esc_attr__( 'Facebook URL', 'elif-lite' ), 2, ELIF_FOOTER_FB, '', 'esc_url_raw' );
			
			// Twitter
			elif_customizer_render_textfield ( 'elif_footer_tw', 'elif_footer', esc_attr__( 'Twitter URL', 'elif-lite' ), 3, ELIF_FOOTER_TW, '', 'esc_url_raw' );
			
			// Google+
			elif_customizer_render_textfield ( 'elif_footer_gplus', 'elif_footer', esc_attr__( 'Google+ URL', 'elif-lite' ), 4, ELIF_FOOTER_GPLUS, '', 'esc_url_raw' );

			// Footer Logo
			elif_customizer_render_uploader ( 'elif_footer_logo', 'elif_footer', esc_attr__( 'Footer Logo', 'elif-lite' ), 5, ELIF_FOOTER_LOGO, '' );

			// Copyright Text
			elif_customizer_render_textarea ( 'elif_footer_text', 'elif_footer', esc_attr__( 'Copyright Text', 'elif-lite' ), 6, ELIF_FOOTER_TEXT, '', 'elif_sanitize_text' );

}
add_action( 'customize_register', 'elif_options_theme_customizer_register' );

// Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
function elif_options_theme_customizer_preview_js() {
	wp_enqueue_script( 'elif-options-theme-customizer', get_template_directory_uri() .'/inc/customizer/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'elif_options_theme_customizer_preview_js' );