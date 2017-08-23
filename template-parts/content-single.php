<?php

/**
 * Template part for displaying single posts.
 *
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<div class="row">

    <div id="content" class="container clearfix">

        <div id="primary" class="content-area col-md-9 col-sm-12 col-xs-12">
            <main id="main" class="site-main" role="main">

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <header class="single-header">

                        <?php the_title( '<h1 class="entry-title single-post-title">', '</h1>' ); ?>

                        <div class="meta-info">
                            <span class="cats">
                                <?php elif_entry_categories( ', ' ); ?>
                            </span>
                            <span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                            <span class="post-author author vcard"><?php _e( 'by', 'elif-lite' ); ?> <?php elif_entry_author(); ?></span>
                            <span class="post-comments"><a href="<?php comments_link(); ?>" rel="nofollow"><?php comments_number( '0 '. esc_attr__( 'comments', 'elif-lite' ), '1 '. esc_attr__( 'comment', 'elif-lite' ), '% '. esc_attr__( 'comments', 'elif-lite' ) ); ?></a></span>
                        </div>

                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                    <?php wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elif-lite' ),
                            'after'  => '</div>',
                        )
                    ); ?>

                    <div class="tags">
                        <?php elif_entry_tags( '' ); ?>
                    </div>

                    <?php elif_next_prev_post(); ?>

                </article><!-- #post-## -->

                <?php elif_related_posts(); ?>

                <?php elif_author_box(); ?>

                <?php // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                } ?>

            </main><!-- #main -->
        </div><!-- #primary -->

        <?php $theme_layout = esc_attr( get_theme_mod( 'elif_theme_layout', ELIF_THEME_LAYOUT ) );
        if ( $theme_layout != 'simple' ) {
            get_sidebar();
        } ?>

    </div><!-- #content -->

</div>