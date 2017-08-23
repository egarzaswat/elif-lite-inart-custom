<?php
/**
* Template Name: Full Width
* @package elif-lite
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

    <?php while ( have_posts() ) : the_post(); ?>

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
                                <?php wp_link_pages(
                                    array(
                                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elif-lite' ),
                                        'after'  => '</div>',
                                    )
                                ); ?>
                            </div>

                        </article><!-- #post-## -->

                        <?php // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        } ?>

                    </main><!-- #main -->
                </div><!-- #primary -->

            </div><!-- #content -->
        </div>

    <?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>