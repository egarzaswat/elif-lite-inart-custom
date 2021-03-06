<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>
	<div id="content" class="container">

        <header class="archive-header">
            <div class="row">

                <?php the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>

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

            <?php $theme_layout = esc_attr( get_theme_mod( 'elif_theme_layout', ELIF_THEME_LAYOUT ) );
            if ( $theme_layout != 'simple' ) {
                get_sidebar();
            } ?>

		</div>
	</div><!-- #content -->
<?php get_footer(); ?>