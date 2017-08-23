<?php

/**
 * The template used for displaying page content in page.php
 *
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<div class="row">
    <div id="content" class="container">
        <div id="primary" class="content-area col-md-8 col-sm-12 col-xs-12">
            <main id="main" class="site-main" role="main">

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <header class="single-header">

                        <?php the_title( '<h1 class="entry-title single-post-title">', '</h1>' ); ?>

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

                </article><!-- #post-## -->

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
	

