<?php
/**
 * Theme Footer
 *
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

</div><!--/.main-container -->

<?php $theme_layout = esc_attr( get_theme_mod( 'elif_theme_layout', ELIF_THEME_LAYOUT ) );
if ( $theme_layout != 'simple' ) { ?>
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
            <?php elif_footer_social(); ?>
            <?php elif_footer_logo(); ?>
            <?php elif_footer_copyright(); ?>
        </div>
    </footer>
<?php } ?>

</div><!--/#page -->
<?php if ( $theme_layout != 'simple' ) { ?>
    <div class="sb-slidebar sb-<?php echo elif_mobile_menu_side(); ?> sb-width-custom sb-style-overlay" data-sb-width="250px">
        <?php get_search_form( true ); ?>
        <nav class="mobile-menu-wrap" role="navigation">
            <?php elif_render_menu( 'mobile-menu', array( 'theme_location' => 'mobile-menu', 'walker' => new Elif_Mobile_Menu_Walker() ) ); ?>
        </nav>
    </div>
    <div class="obfuscator sb-toggle sb-toggle-<?php echo elif_mobile_menu_side(); ?>"></div>
<?php } ?>
<?php wp_footer(); ?>

</body>
</html>
