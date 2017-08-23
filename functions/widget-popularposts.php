<?php
/*-----------------------------------------------------------------------------------

	Plugin Name: Themient: Popular Posts
	Description: A widget that displays popular posts.
	Version: 1.0.0

-----------------------------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Elif_Popular_Posts_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'Elif_Popular_Posts_Widget',
			esc_attr__( 'Themient: Popular Posts', 'elif-lite' ),
			array( 'description' => esc_attr__( 'Displays most Popular Posts with Thumbnail.', 'elif-lite' ) )
		);
	}

 	public function form( $instance ) {
		$defaults = array(
            'qty'           => 5,
			'comments'      => 1,
			'date'          => 1,
			'days'          => 30,
			'show_thumb'    => 1,
            'display_type'  => 'horizontal',
		);

		$instance = wp_parse_args( ( array ) $instance, $defaults );

		$title = isset( $instance[ 'title' ] ) ? sanitize_text_field( $instance[ 'title' ] ) : esc_attr__( 'Popular Posts', 'elif-lite' );
		$qty = isset( $instance[ 'qty' ] ) ? absint( $instance[ 'qty' ] ) : 5;
		$comments = isset( $instance[ 'comments' ] ) ? absint( $instance[ 'comments' ] ) : 1;
		$date = isset( $instance[ 'date' ] ) ? absint( $instance[ 'date' ] ) : 1;
		$days = isset( $instance[ 'days' ] ) ? absint( $instance[ 'days' ] ) : 0;
		$show_thumb = isset( $instance[ 'show_thumb' ] ) ? absint( $instance[ 'show_thumb' ] ) : 1;
        $display_type = isset( $instance[ 'display_type' ] ) ? sanitize_text_field( $instance[ 'display_type' ] ) : 'horizontal'; ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e( 'Title:', 'elif-lite' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
	       <label for="<?php echo $this->get_field_id( 'days' ); ?>"><?php esc_attr_e( 'Popularity limit (days), 0 for No-limit', 'elif-lite' ); ?>
	       <input id="<?php echo $this->get_field_id( 'days' ); ?>" name="<?php echo $this->get_field_name( 'days' ); ?>" type="number" min="1" step="1" value="<?php echo absint( $days ); ?>" />
	       </label>
       </p>
	   
		<p>
			<label for="<?php echo $this->get_field_id( 'qty' ); ?>"><?php esc_attr_e( 'Number of Posts to show', 'elif-lite' ); ?></label> 
			<input id="<?php echo $this->get_field_id( 'qty' ); ?>" name="<?php echo $this->get_field_name( 'qty' ); ?>" type="number" min="1" step="1" value="<?php echo absint( $qty ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" value="1" <?php if ( isset( $instance[ 'show_thumb' ] ) ) { checked( 1, $instance[ 'show_thumb' ], true ); } ?> />
				<?php esc_attr_e( 'Show Thumbnails', 'elif-lite' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'date' ); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" value="1" <?php if ( isset($instance[ 'date' ] ) ) { checked( 1, $instance[ 'date' ], true ); } ?> />
				<?php esc_attr_e( 'Show post date', 'elif-lite' ); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'comments' ); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'comments' ); ?>" name="<?php echo $this->get_field_name( 'comments' ); ?>" value="1" <?php checked( 1, $instance[ 'comments' ], true ); ?> />
				<?php esc_attr_e( 'Show comments number', 'elif-lite' ); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'display_type' ); ?>"><?php esc_attr_e( 'Display Type', 'elif-lite' ); ?>
                <select class="widefat" id="<?php echo $this->get_field_id( 'display_type' ); ?>" name="<?php echo $this->get_field_name( 'display_type' ); ?>">
                    <option value="horizontal" <?php if ( $instance[ 'display_type' ] == 'horizontal' ) echo 'selected="selected"'; ?>><?php esc_attr_e( 'Horizontal', 'elif-lite' ); ?></option>
                    <option value="vertical" <?php if ( $instance[ 'display_type' ] == 'vertical' ) echo 'selected="selected"'; ?>><?php esc_attr_e( 'Vertical', 'elif-lite' ); ?></option>
                </select>
            </label>
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['qty'] = absint( $new_instance['qty'] );
		$instance['comments'] = absint( $new_instance['comments'] );
		$instance['date'] = absint( $new_instance['date'] );
		$instance['days'] = absint( $new_instance['days'] );
		$instance['show_thumb'] = absint( $new_instance['show_thumb'] );
        $instance['display_type'] = sanitize_text_field( $new_instance[ 'display_type' ] );
		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
        $comments = null; $date = null; $days = null; $qty = null; $show_thumb = null; $display_type = null;

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        if (! empty( $instance['comments'] ) ) { $comments = $instance['comments']; }
        if (! empty( $instance['date'] ) ) { $date = $instance['date']; }
        if (! empty( $instance['days'] ) ) { $days = $instance['days']; }
        if (! empty( $instance['qty'] ) ) { $qty = $instance['qty']; }
        if (! empty( $instance['show_thumb'] ) ) { $show_thumb = $instance['show_thumb']; }
        if (! empty( $instance['display_type'] ) ) { $display_type = $instance['display_type']; }

		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		echo self::get_popular_posts( $qty, $comments, $date, $days, $show_thumb, $display_type );
		echo $after_widget;
	}

	public function get_popular_posts( $qty, $comments, $date, $days, $show_thumb, $display_type ) {

        global $post;
        $popular_days = array();
		if ( $days ) {
			$popular_days = array(
        		//set date ranges
        		'after' => "$days day ago",
        		'before' => 'today',
        		//allow exact matches to be returned
        		'inclusive' => true,
        	);
		}
		
		$popular = get_posts( array(
                'suppress_filters' => false,
                'ignore_sticky_posts' => 1,
                'orderby' => 'comment_count',
                'numberposts' => $qty,
                'date_query' => $popular_days,
            )
        );
        
        if ( $display_type == 'horizontal' ) {
            $class = 'horizontal';
            $thumb_size = 'elif_tiny';
            $thumb_width = '250';
            $thumb_height = '100';
        } else {
            $class = 'vertical';
            $thumb_size = 'elif_square';
            $thumb_width = '100';
            $thumb_height = '100';
        }
        
        if ( $display_type == 'vertical' && $show_thumb == 1 ) {
            $css = 'style="width:66%;"';
        } else {
            $css = 'style="width:100%;"';
        }

		echo '<div class="widget-container popular-posts widget-posts-wrap"><ul>';

		foreach( $popular as $post ) {
			setup_postdata( $post ); ?>
            <li class="post-box <?php echo $class; ?>-container">
				<?php if ( $show_thumb == 1 ) { ?>
                    <div class="post-img">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <img width="<?php echo $thumb_width; ?>" height="<?php echo $thumb_height; ?>" src="<?php echo elif_get_thumbnail( $post->ID, $thumb_size, false ); ?>" class="widget-featured wp-post-image" alt="<?php the_title_attribute(); ?>">
                        </a>
                    </div>
				<?php } ?>
				<div class="post-data" <?php echo $css; ?>>
                    <h4 class="title"><a rel="nofollow" href="<?php the_permalink()?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                    <?php if ( $date == 1 || $comments == 1 ) { ?>
                        <div class="post-meta">
                            <?php if ( $date == 1 ) { ?>
                                <span class="post-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php the_time( get_option( 'date_format' ) ); ?></span>
                            <?php } ?>
                            <?php if ( $comments == 1 ) { ?>
                                <span class="post-comments"><i class="fa fa-comments" aria-hidden="true"></i><?php comments_number( '0', '1', '%' ); ?></span>
                            <?php } ?>
                        </div>
                    <?php } ?>
				</div>
            </li>
        <?php }
        wp_reset_postdata();
		echo '</ul></div>'."\r\n";
	}

}