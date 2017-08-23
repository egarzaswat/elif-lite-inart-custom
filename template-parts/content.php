<?php

/**
 * Template part for displaying posts.
 *
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>


<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item grid-item' ); ?>>

    <?php $post_featured = absint( get_theme_mod( 'elif_post_featured', ELIF_POST_FEATURED ) );
    if ( $post_featured == 1 && has_post_thumbnail() ) { ?>
        <div class="post-featured">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <img src="<?php echo elif_get_thumbnail( get_the_ID(), 'elif_big', true ); ?>" class="attachment-featured wp-post-image" alt="<?php the_title_attribute(); ?>">
            </a>
        </div>
    <?php } ?>

    <?php if ( is_sticky() ) { ?>
        <span class="pinned" title="<?php esc_attr_e( 'Featured Post', 'elif-lite' ); ?>"><?php esc_attr_e( 'Featured', 'elif-lite' ); ?></span>
    <?php } ?>

    <div class="cats">
        <?php elif_entry_categories( '' ); ?>
    </div>

    <?php the_title( sprintf( '<h2 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

    <div class="meta-info">
        <span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
        <span class="post-author author vcard"><?php esc_attr_e( 'by', 'elif-lite' ); ?> <?php elif_entry_author(); ?></span>
        <span class="post-comments"><a href="<?php comments_link(); ?>" rel="nofollow"><?php comments_number( '0 '. esc_attr__( 'comments', 'elif-lite' ), '1 '. esc_attr__( 'comment', 'elif-lite' ), '% '. esc_attr__( 'comments', 'elif-lite' ) ); ?></a></span>
    </div>

    <div class="post-excerpt">
        <?php the_excerpt(); ?>
    </div>

    <div class="moretag">
        <a class="button btn-small" href="<?php the_permalink(); ?>">
            <?php echo elif_get_readmore_text(); ?>
        </a>
    </div>

</article><!-- #post-## -->