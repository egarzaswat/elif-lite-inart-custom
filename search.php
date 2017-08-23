<?php

/**
 * The template for displaying search results pages.
 *
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>
    <div id="content" class="container">
        <header class="search-header">
            <div class="row">

                <h1 class="page-title margin-8"><?php printf( esc_html__( 'Search Results for: %s', 'elif-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

            </div>
        </header>

        <div class="row">

            <div id="primary" class="content-area col-md-8 col-sm-12 col-xs-12">

                <main id="main" class="site-main grid" role="main">
                    <div class="grid-sizer"></div>
                    <div class="gutter-sizer"></div>

                    <?php if ( have_posts() ) : ?>
                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php
                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'template-parts/content', get_post_format() );
                            ?>
                        <?php endwhile; ?>

                    <?php else : ?>

                        <?php get_template_part( 'template-parts/content', 'none' ); ?>

                    <?php endif; ?>

                </main><!-- #main -->

                <?php elif_navigation(); ?>

            </div><!-- #primary -->

            <?php $theme_layout = esc_attr( get_theme_mod( 'theme_layout', ELIF_THEME_LAYOUT ) );
            if ( $theme_layout != 'simple' ) {
                get_sidebar();
            } ?>
        </div>
    </div><!-- #content -->
<?php get_footer(); ?>