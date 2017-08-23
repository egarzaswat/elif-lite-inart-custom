<?php
/**
 * Functions and definitions
 *
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers support for various WordPress features.
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'elif_setup' ) ) {
    function elif_setup() {
        /*
         * Sets up theme defaults and registers support for various WordPress features.
         * @since 1.0.0
         */

        // Make theme available for translation.
        load_theme_textdomain( 'elif-lite', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'primary-menu' => esc_attr__( 'Primary Menu', 'elif-lite' ),
                'mobile-menu'  => esc_attr__( 'Mobile Menu', 'elif-lite' ),
            ) 
        );

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support( 'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        // Add Post Thumbnail Support
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'elif_big', 370, 9999, false );	    // Big thumb
        add_image_size( 'elif_tiny', 270, 150, true ); 	    // Tiny thumb
        add_image_size( 'elif_square', 120, 120, true );	// Square thumb

        add_theme_support( 'custom-logo', array(
            'height'      => 300,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ),
        ) );

        add_theme_support( 'custom-background' );

    }
}
add_action( 'after_setup_theme', 'elif_setup' );

/*-----------------------------------------------------------------------------------*/
/*  Theme PHP scripts and libraries
/*-----------------------------------------------------------------------------------*/
require_once ( get_template_directory() . '/functions/defaults.php' );
require_once ( get_template_directory() . '/functions/common.php' );
require_once ( get_template_directory() . '/inc/custom-menu-walker.php' );
require_once ( get_template_directory() . '/inc/customizer/customizer.php');

/*-----------------------------------------------------------------------------------*/
/*  Set the content width based on the theme's design and stylesheet.
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) {
    $content_width = ELIF_CONTENT_WIDTH; /* in Pixels */
}

/*-----------------------------------------------------------------------------------*/
/*  Register Sidebar & Widget-areas 
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'elif_widgets_init' ) ) {
    function elif_widgets_init() {
        /*
         * Register Sidebar & Widget-areas
         * @since 1.0.0
         */

        register_sidebar( array(
            'name'          => esc_attr__( 'Main Sidebar', 'elif-lite' ),
            'id'            => 'main-sidebar',
            'description'   => esc_attr__( 'Theme\'s main sidebar.', 'elif-lite' ),
            'before_widget' => '<aside id="%1$s" class="widget sidebar-widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget-title"><h3>',
            'after_title'   => '</h3></div>',
        ) );
    }
}
add_action( 'widgets_init', 'elif_widgets_init' );

/*-----------------------------------------------------------------------------------*/
/*  Enqueue scripts and styles.
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'elif_scripts' ) ) {
    function elif_scripts() {
        /*
         * Enqueue scripts and styles.
         * @since 1.0.0
         */

        // Load jQuery
        wp_enqueue_script( 'jquery' );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        // Load Masonry JS
        wp_enqueue_script( 'jquery-masonry', array( 'jquery' ) );

        // Load Imagesloaded JS
        wp_enqueue_script( 'imagesloaded' );

        // Load Fonts
        wp_enqueue_style( 'elif-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,400i,700|Playfair+Display', false, null, 'all' );

        // Load Bootstrap JS
        wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js' );

        // Load Slidebars JS
        wp_enqueue_script( 'jquery-slidebars', get_template_directory_uri() . '/js/slidebars.min.js', array( 'jquery' ) );

        // Load Header Custom Scripts
        $theme_layout = esc_attr( get_theme_mod( 'elif_theme_layout', ELIF_THEME_LAYOUT ) );
        $sidebar_layout = esc_attr( get_theme_mod( 'elif_sidebar_layout', ELIF_SIDEBAR_LAYOUT ) );
        $originLeft = ( $sidebar_layout == 'right' && $theme_layout == 'simple' )? 'false': 'true';

        wp_enqueue_script( 'elif-header-scripts', get_template_directory_uri() . '/js/header-scripts.js', array( 'jquery' ), '1.0.0' );
        wp_localize_script( 'elif-header-scripts', 'elifScripts', array(
            'originLeft' => $originLeft,
        ) );

        // Load Custom Scripts
        wp_enqueue_script( 'elif-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.0', true );
        wp_localize_script( 'elif-scripts', 'elifScripts', array(
            'menuside' => elif_mobile_menu_side()
        ) );

        // Load Bootstrap CSS
        wp_enqueue_style( 'bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css' );

        // Load Slidebars CSS
        wp_enqueue_style( 'slidebars', get_template_directory_uri(). '/css/slidebars.min.css' );

        // Load FontAwesome
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', null, '4.7.0' );

        // Load the Stylesheet
        wp_enqueue_style( 'elif-stylesheet', get_stylesheet_uri() );

        $animations = esc_attr( get_theme_mod( 'elif_animations', ELIF_ANIMATIONS ) );
        if ( $animations == 'on' || ( $animations == 'off-on-mobiles' && !wp_is_mobile() ) ) {
            wp_enqueue_style( 'elif-animations', get_template_directory_uri(). '/css/animations.css', false, null, 'all' );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'elif_scripts' );

/*-----------------------------------------------------------------------------------*/
/*  Load theme Widgets & Functions
/*-----------------------------------------------------------------------------------*/
require_once ( get_template_directory() . '/functions/widget-recentposts.php' );
require_once ( get_template_directory() . '/functions/widget-popularposts.php' );
require_once ( get_template_directory() . '/functions/widget-socialicons.php' );

// Register Theme Widgets
function elif_register_widgets() {
    register_widget( 'Elif_Recent_Posts_Widget' );
    register_widget( 'Elif_Popular_Posts_Widget' );
    register_widget( 'Elif_Social_Icons_Widget' );
}

add_action( 'widgets_init', 'elif_register_widgets' );

/*-----------------------------------------------------------------------------------*/
/*   Header Area
/*-----------------------------------------------------------------------------------*/

// Logo.
if ( ! function_exists( 'elif_logo' ) ) {
    function elif_logo() {
        /*
         * Display Logo
         * @since 1.0.0
         */

        if ( function_exists( 'the_custom_logo' ) ) {
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else { ?>
                <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            <?php }
        } else { ?>
            <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
        <?php } 
    }
}

/*-----------------------------------------------------------------------------------*/
/* Archives & Articles
/*-----------------------------------------------------------------------------------*/

// Display Post Next/Prev links
if ( ! function_exists( 'elif_next_prev_post' ) ) {
    function elif_next_prev_post() {
        /*
         * Display Post Next/Prev links
         * @since 1.0.0
         */

        $post_next_prev = absint( get_theme_mod( 'elif_post_next_prev', ELIF_POST_NEXT_PREV ) );
        if ( $post_next_prev == 1 ) {  ?>
            <div class="next-prev-post">
                <?php $next_post = get_next_post();
                $prev_post = get_previous_post();
                if ( !empty( $prev_post )){ ?>
                    <div class="prev-post">
                        <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                            <span class="txt"><?php esc_attr_e( 'Previous Post', 'elif-lite' ); ?></span>
                            <span class="title"><?php echo $prev_post->post_title; ?></span>
                        </a>
                    </div>
                <?php }
                if ( !empty( $next_post )){ ?>
                    <div class="next-post">
                        <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                            <span class="txt"><?php esc_attr_e( 'Next Post', 'elif-lite' ); ?></span>
                            <span class="title"><?php echo $next_post->post_title; ?></span>
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php }
    }                 
}

// Display Related Posts
if ( ! function_exists( 'elif_related_posts' ) ) {
    function elif_related_posts() {
        /*
         * Display Related Posts
         * @since 1.0.0
         */

        $related_posts = absint( get_theme_mod( 'elif_related_posts', ELIF_RELATED_POSTS ) );
        $related_posts_number = absint( get_theme_mod( 'elif_related_posts_number', ELIF_RELATED_POSTS_NUMBER ) );				
        $related_posts_query = esc_attr( get_theme_mod( 'elif_related_posts_query', ELIF_RELATED_POSTS_QUERY ) );
        $related_posts_meta = absint( get_theme_mod( 'elif_related_posts_meta', ELIF_RELATED_POSTS_META ) );
        $related_posts_excerpt = absint( get_theme_mod( 'elif_related_posts_excerpt', ELIF_RELATED_POSTS_EXCERPT ) );

        if ( $related_posts == 1 && ( intval( $related_posts_number ) > 0 && intval( $related_posts_number ) <= 6 ) && ( $related_posts_query == 'tags' || $related_posts_query == 'categories' ) ) {

            global $post;
            $orig_post = $post;
            $args = array();

            if ( $related_posts_query == 'tags' ) {
                $tags = wp_get_post_tags( $post->ID );
                $tag_ids = array();

                foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;
                $args = array(
                    'tag__in'				=> $tag_ids,
                    'post__not_in'			=> array( $post->ID ),
                    'posts_per_page'		=> $related_posts_number, // Number of related posts.
                    'ignore_sticky_posts'	=> 1,
                    'orderby'				=> 'rand', // Randomize the posts.
                );
            } else if ( $related_posts_query == 'categories' ) {
                $categories = get_the_category($post->ID);
                $category_ids = array();

                foreach( $categories as $individual_category ) $category_ids[] = $individual_category->term_id;
                $args = array(
                    'category__in'			=> $category_ids,
                    'post__not_in'			=> array( $post->ID ),
                    'posts_per_page'		=> $related_posts_number,
                    'ignore_sticky_posts'	=> 1,
                    'orderby'				=> 'rand',
                );
            }

            $my_query = new WP_Query( $args );
            if( $my_query->have_posts() ) { ?>
                <div id="related-posts" class="related-posts">
                    <div class="section-title">
                        <h3><?php esc_attr_e( 'You may also like', 'elif-lite' ); ?></h3>
                    </div>
                    <ul>
                        <?php while( $my_query->have_posts() ) {
                            $my_query->the_post(); ?>
                            <li class="related-item">
                                <div class="thumb">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <img width="270" height="150" src="<?php echo elif_get_thumbnail( $post->ID, 'elif_tiny', false ); ?>" class="attachment-featured wp-post-image" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                </div>
                                <div class="content">
                                    <a class="title" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    <?php if ( $related_posts_meta == 1 ) { ?>
                                        <div class="post-meta">
                                            <span class="post-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php the_time( get_option( 'date_format' ) ); ?></span>
                                            <span class="post-comments"><i class="fa fa-comments" aria-hidden="true"></i><?php comments_number( '0', '1', '%' ); ?></span>
                                        </div>
                                    <?php } ?>
                                    <?php if ( $related_posts_excerpt == 1 ) { ?>
                                        <div class="post-excerpt">
                                            <p><?php echo elif_truncate_string( get_the_excerpt(), 10, 'words' ); ?></p>
                                            <a href="<?php the_permalink( $post->ID ); ?>">
                                                <?php echo elif_get_readmore_text(); ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php }
            wp_reset_postdata();
        }     
    }                 
}

// Display Author Box
if ( ! function_exists( 'elif_author_box' ) ) {
    function elif_author_box() {
        /*
         * Display Author Box
         * @since 1.0.0
         */

        $author_box = absint( get_theme_mod( 'elif_author_box', ELIF_AUTHOR_BOX ) );
        if ( $author_box == 1 ) { ?>
            <div class="author-box">
                <div class="section-title">
                    <h3>
                        <div class="author-box-avatar">
                            <?php if ( function_exists( 'get_avatar' ) ) {
                                echo get_avatar( get_the_author_meta( 'email' ), '85' );
                            } ?>
                        </div>
                    </h3>
                </div>
                <div class="author vcard">
                    <span><?php esc_attr_e( 'Author', 'elif-lite' ) ?></span>
                    <?php echo get_the_author_link(); ?>
                </div>
                <div class="author-box-bio">
                    <?php if( get_the_author_meta( 'description' ) ) { ?>
                        <p><?php the_author_meta( 'description' ) ?></p>
                    <?php }?>
                    <p><a class="button" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php esc_attr_e( 'View Posts', 'elif-lite' ) ?></a></p>
                </div>
            </div>
        <?php }
    }                 
}

/*-----------------------------------------------------------------------------------*/
/*  Custom Comments template
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'elif_custom_comments' ) ) {
    function elif_custom_comments( $comment, $args, $depth ) {
        /*
         * Custom Comments template
         * @since 1.0.0
         */

        global $post, $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-box">
                <div class="comment-header">
                    <div class="comment-avatar"><?php echo get_avatar( $comment->comment_author_email, 80 ); ?></div>
                    <div class="comment-author vcard clearfix">
                        <span class="comment-edit"><?php edit_comment_link( esc_attr__( '(Edit)', 'elif-lite' ),'  ','' ); ?></span>
                    </div>
                </div>
                <div class="comment-body">
                    <div class="commentmetadata">
                        <div class="meta">
                            <?php if( $comment->user_id == $post->post_author ) {
                                printf( '<span class="fn">%s</span><span class="is-author" title="%s"><i class="fa fa-user-circle" aria-hidden="true"></i></span>', get_comment_author_link(), esc_attr__( 'Author', 'elif-lite' ) );
                            } else {
                                printf( '<span class="fn">%s</span>', get_comment_author_link());
                            } ?>
                            <span class="date"><?php comment_date( get_option( 'date_format' ) ); ?></span>
                            <?php $args['reply_text'] = esc_attr__( 'Reply', 'elif-lite' );
                            comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </div>
                        <?php if ($comment->comment_approved == '0') { ?>
                        <em><?php esc_attr_e( 'Your comment is awaiting moderation.', 'elif-lite' ); ?></em>
                        <br />
                        <?php }
                        comment_text() ?>
                    </div>
                </div>
            </div>
        </li>
    <?php }
}

/*-----------------------------------------------------------------------------------*/
/*  Footer Area
/*-----------------------------------------------------------------------------------*/

// Display Footer Social links
if ( ! function_exists( 'elif_footer_social' ) ) {
    function elif_footer_social() {
        /*
         * Display Footer Social links
         * @since 1.0.0
         */
        $footer_social = absint( get_theme_mod( 'elif_footer_social', ELIF_FOOTER_SOCIAL ) );
        if ( $footer_social == 1 ) { ?>
            <div class="footer-social">
                <ul>
                    <?php $footer_fb = esc_url( get_theme_mod( 'elif_footer_fb', ELIF_FOOTER_FB ) );
                    if ( $footer_fb != '' ) { ?>
                        <li class="fb">
                            <a href="<?php echo $footer_fb; ?>" title="<?php esc_attr_e( 'Facebook', 'elif-lite' ); ?>" rel="nofollow" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                    <?php } ?>
                    <?php $footer_tw = esc_url( get_theme_mod( 'elif_footer_tw', ELIF_FOOTER_TW ) );
                    if ( $footer_tw != '' ) { ?>
                        <li class="tw">
                            <a href="<?php echo $footer_tw; ?>" title="<?php esc_attr_e( 'Twitter', 'elif-lite' ); ?>" rel="nofollow" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                    <?php } ?>
                    <?php $footer_gplus = esc_url( get_theme_mod( 'elif_footer_gplus', ELIF_FOOTER_GPLUS ) );
                    if ( $footer_gplus != '' ) { ?>
                        <li class="gplus">
                            <a href="<?php echo $footer_gplus; ?>" title="<?php esc_attr_e( 'Google+', 'elif-lite' ); ?>" rel="nofollow" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php }
    }
}

// Display Footer Logo
if ( ! function_exists( 'elif_footer_logo' ) ) {
    function elif_footer_logo() {
        /*
         * Display Footer Logo
         * @since 1.0.0
         */
        ?>
        <?php $footer_logo = esc_url( get_theme_mod( 'elif_footer_logo', ELIF_FOOTER_LOGO ) );
        if ( $footer_logo != '' ) { ?>
            <div class="footer-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo $footer_logo; ?>" alt="<?php bloginfo( 'name' ); echo ' - '; bloginfo( 'description' ); ?>"/></a>
            </div>
        <?php } ?>
    <?php }
}
//<?php add_theme_support( 'post-thumbnails' );
/*-----------------------------------------------------------------------------------*/
/*  That's All, Bye!
/*-----------------------------------------------------------------------------------*/	