<?php
/**
* Theme Common functions
*
* @package elif-lite
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*-----------------------------------------------------------------------------------*/
/*  Template Tags
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'elif_entry_author' ) ) {
    function elif_entry_author() {
        /*
         * Display post author
         * @since 1.0.0
         */
        if ( 'post' == get_post_type() ) {
            $byline = '<span class="url fn"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
            echo $byline;
        }
    }
}

// Display Post Categories.
if ( !function_exists( 'elif_entry_categories' ) ) {
    function elif_entry_categories( $sep = ',' ) {
        /*
         * Display all Post categories.
         * @param string
         * @since 1.0.0
         */
        if ( 'post' == get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( $sep );
            if ( $categories_list != '' ) {
                echo $categories_list;
            }
        }
    }
}

if ( !function_exists( 'elif_entry_category' ) ) {
    function elif_entry_category() {
        /*
         * Display post first category
         * @since 1.0.0
         */
        $categories = get_the_category();
        if ( !empty( $categories ) ) {
                echo $categories[0]->name;
        }
    }
}

// Display Post Tags
if ( !function_exists( 'elif_entry_tags' ) ) {
    function elif_entry_tags( $sep = ',' ) {
        /*
         * Display post tags
         * @param string
         * @since 1.0.0
         */
        if ( 'post' == get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', $sep );
            if ( $tags_list != '' ) {
                echo $tags_list;
            }
        }
    }
}

// Get Blog page title
if ( !function_exists( 'elif_get_blog_title' ) ) {
    function elif_get_blog_title() {
        /*
         * Return Blog Page Title ( static posts page must be set )
         * @return string
         * @since 1.0.0
         */
        $blog_title = ( 'page' === get_option( 'show_on_front' ) )? get_the_title( get_option( 'page_for_posts' ) ): '';
        return $blog_title;
    }
}

/*-----------------------------------------------------------------------------------*/
/*  Common functions
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'elif_get_thumbnail' ) ) {
    function elif_get_thumbnail( $post_id, $size = 'elif_big', $could_be_empty = true ) {
        /*
         * Return Thumbnail/Featured image URL
         * @param int
         * @param string
         * @param boolean
         *
         * @return string
         * @since 1.0.0
         */		

        if ( has_post_thumbnail( $post_id ) ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
            $image = $image[0];
        } else {
            if ( $could_be_empty == true ) {
                $image = '';
            } else {
                $image = get_template_directory_uri() . '/images/nothumb-'. $size .'.jpg';
            }
        }

        return esc_url( $image );
    }
}

if ( !function_exists( 'elif_truncate_string' ) ) {
    function elif_truncate_string( $str, $length = 40, $units = 'letters', $ellipsis = '&nbsp;&hellip;' ) {
        /*
         * Truncate string to x letters/words
         * @param string
         * @param int
         * @param string
         * @param string
         *
         * @return string
         * @since 1.0.0
         */
        if ( $units == 'letters' ) {
            if ( mb_strlen( $str ) > $length ) {
                $str = mb_substr( $str, 0, $length ) . $ellipsis;
            }
        } else {
            $words = explode( ' ', $str );
            if ( count( $words ) > $length ) {
                $str = implode( " ", array_slice( $words, 0, $length ) ) . $ellipsis;
            }
        }

        return esc_html( $str );
    }
}

if ( !function_exists( 'elif_hex_to_rgba' ) ) {
    function elif_hex_to_rgba( $color, $opacity = false ) {
        /*
         * Convert Hex color to RGB/RGBA
         * @param string
         * @param boolean
         *
         * @return string
         * @since 1.0.0
         */
        $default = 'rgb(0,0,0)';

        // Return default if no color provided
        if ( empty( $color ) )
              return $default;

       // Sanitize $color if "#" is provided 
        if ( $color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        // Check if color has 6 or 3 characters and get values
        if ( strlen( $color ) == 6 ) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        // Convert hexadec to rgb
        $rgb = array_map( 'hexdec', $hex );

        // Check if opacity is set(rgba or rgb)
        if ( $opacity ){
            if( abs( $opacity ) > 1 )
                $opacity = 1.0;
            $output = 'rgba('.implode( ",", $rgb ).','.$opacity.')';
        } else {
            $output = 'rgb('.implode( ",", $rgb ).')';
        }

        // Return rgb(a) color string
        return esc_attr( $output );
    }
}

if ( !function_exists( 'elif_get_post_format_icon' ) ) {
    function elif_get_post_format_icon( $post_id ) {
        /*
         * Return Post format Icon
         * @param int
         *
         * @return string
         * @since 1.0.0
         */
        $format = get_post_format( $post_id );
        $icon = '<i class="fa fa-file-text" aria-hidden="true"></i>';
        return $icon;
    }
}

if ( ! function_exists( 'elif_footer_copyright' ) ) {
    function elif_footer_copyright() {
        /*
         * Display Footer Copyright text
         * @since 1.0.0
         */
        ?>
        <div class="copyright">
            <?php $footer_text = elif_sanitize_text( get_theme_mod( 'elif_footer_text', ELIF_FOOTER_TEXT ) );
            echo $footer_text .' | '. elif_sanitize_text( ELIF_FOOTER_THEMIENT ); ?>
        </div>
    <?php }
}

if ( !function_exists( 'elif_get_readmore_text' ) ) {
    function elif_get_readmore_text() {
        /*
         * Return ReadMore text
         *
         * @return string
         * @since 1.0.0
         */
        $readmore = get_theme_mod( 'elif_article_link_text', ELIF_ARTICLE_TEXT );
        return esc_attr( $readmore );
    }
}

if ( !function_exists( 'elif_navigation' ) ) {
    function elif_navigation() {
        /*
         * Display Pagination
         * @since 1.0.0
         */
        $navigation_type = esc_attr( get_theme_mod( 'elif_navigation_type', ELIF_NAVIGATION_TYPE ) );
        if ( $navigation_type == 'simple' ) { ?>
            <div class="post-navigation">
                <?php if ( get_next_posts_link() ) { ?>
                    <div class="alignleft"><?php next_posts_link( esc_attr__( 'Older Posts', 'elif-lite' ) ); ?></div>
                <?php }
                if ( get_previous_posts_link() ) { ?>
                    <div class="alignright"><?php previous_posts_link( esc_attr__( 'Newer Posts', 'elif-lite' ) ); ?></div>
                <?php } ?>
            </div>
        <?php } else {
            the_posts_pagination(
                array(
                    'mid_size'  => 2,
                    'prev_text' => esc_attr__( '&#8249; Previous', 'elif-lite' ),
                    'next_text' => esc_attr__( 'Next &#8250;', 'elif-lite' ),
                )
            );
        }

    }
}

if ( !function_exists( 'elif_render_menu' ) ) {
    function elif_render_menu( $location = '', $args ) {
        /*
         * Display Navigation menu
         * @param string
         * @param array
         * @since 1.0.0
         */
        wp_nav_menu( $args );
    }
}

if ( !function_exists( 'elif_mobile_menu_side' ) ) {
	function elif_mobile_menu_side() {
        /*
         * Return Mobile menu Side
         *
         * @return string
         * @since 1.0.0
         */
		$menu_side = get_theme_mod( 'elif_mobile_menu_side', ELIF_MOBILE_MENU_SIDE );
		return esc_attr( $menu_side );
	}
}