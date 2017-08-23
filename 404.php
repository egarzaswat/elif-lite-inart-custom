<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

	<div id="content" class="container">
		<div class="row">
            <div class="error-404 not-found">
                <header class="404-header">
                    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'elif-lite' ); ?></h1>
                </header><!-- .page-header -->
            </div>
		</div>
	</div><!-- #content -->

<?php get_footer(); ?>
