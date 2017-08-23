<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Themient: Social Icons
	Description: This widget shows social icons.
	Version: 1.0.0

-----------------------------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Elif_Social_Icons_Widget extends WP_Widget {

	protected $defaults;
	protected $sizes;
	protected $profiles;

	function __construct() {

		$this->defaults = array(
			'title'			=> '',
			'new_tab'		=> 0,
			'size'			=> 32,
			'facebook'		=> '',
			'twitter'		=> '',			
			'gplus'			=> '',	
			'youtube'		=> '',		
			'rss'			=> '',			
			'pinterest'		=> '',
			'linkedin'		=> '',
			'email'			=> '',
			'stumbleupon'	=> '',			
			'reddit'		=> '',			
			'tumblr'		=> '',			
			'instagram'		=> '',			
			'vimeo'			=> '',
			'foursquare'	=> '',	
			'soundcloud'	=> '',		
			'github'		=> '',			
			'flickr'		=> '',							
			'skype'			=> '',			
			'behance'		=> '',
			'dribbble'		=> '',
			'dropbox'		=> '',
            
			'amazon'		=> '',
			'apple'		    => '',
			'snapchat'		=> '',
			'bitbucket'		=> '',
			'stack-overflow'=> '',
			'stack-exchange'=> '',
			'slack'		    => '',
			'codepen'		=> '',
			'digg'		    => '',
			'deviantart'    => '',
			'paypal'		=> '',
			'btc'		    => '',
			'odnoklassniki' => '',
			'vk'     		=> '',
			'whatsapp'		=> '',
			'weixin'		=> '',
			'vine'   		=> '',
			'weibo'  		=> '',
			'yelp'   		=> '',
			'lastfm'		=> '',
			'steam'  		=> '',
			'twitch'		=> '',
		);

		$this->sizes = array( '32' );

		$this->profiles = array(
			'facebook' => array(
				'label'	  => esc_attr__( 'Facebook', 'elif-lite' ),
				'pattern' => '<li class="social-facebook"><a title="%s" href="%s" %s><i class="fa fa-facebook"></i></a></li>',
			),
			'twitter' => array(
				'label'	  => esc_attr__( 'Twitter', 'elif-lite' ),
				'pattern' => '<li class="social-twitter"><a title="%s" href="%s" %s><i class="fa fa-twitter"></i></a></li>',
			),
			'gplus' => array(
				'label'	  => esc_attr__( 'Google+', 'elif-lite' ),
				'pattern' => '<li class="social-gplus"><a title="%s" href="%s" %s><i class="fa fa-google-plus"></i></a></li>',
			),
			'youtube' => array(
				'label'	  => esc_attr__( 'YouTube', 'elif-lite' ),
				'pattern' => '<li class="social-youtube"><a title="%s" href="%s" %s><i class="fa fa-youtube"></i></a></li>',
			),			
			'rss' => array(
				'label'	  => esc_attr__( 'RSS', 'elif-lite' ),
				'pattern' => '<li class="social-rss"><a title="%s" href="%s" %s><i class="fa fa-rss"></i></a></li>',
			),
			'pinterest' => array(
				'label'	  => esc_attr__( 'Pinterest', 'elif-lite' ),
				'pattern' => '<li class="social-pinterest"><a title="%s" href="%s" %s><i class="fa fa-pinterest"></i></a></li>',
			),			
			'linkedin' => array(
				'label'	  => esc_attr__( 'LinkedIn', 'elif-lite' ),
				'pattern' => '<li class="social-linkedin"><a title="%s" href="%s" %s><i class="fa fa-linkedin"></i></a></li>',
			),
			'email' => array(
				'label'	  => esc_attr__( 'Email', 'elif-lite' ),
				'pattern' => '<li class="social-email"><a title="%s" href="%s" %s><i class="fa fa-envelope"></i></a></li>',
			),
			'stumbleupon' => array(
				'label'	  => esc_attr__( 'StumbleUpon', 'elif-lite' ),
				'pattern' => '<li class="social-stumbleupon"><a title="%s" href="%s" %s><i class="fa fa-stumbleupon"></i></a></li>',
			),
			'reddit' => array(
				'label'	  => esc_attr__( 'Reddit', 'elif-lite' ),
				'pattern' => '<li class="social-reddit"><a title="%s" href="%s" %s><i class="fa fa-reddit"></i></a></li>',
			),			
			'tumblr' => array(
				'label'	  => esc_attr__( 'Tumblr', 'elif-lite' ),
				'pattern' => '<li class="social-tumblr"><a title="%s" href="%s" %s><i class="fa fa-tumblr"></i></a></li>',
			),			
			'instagram' => array(
				'label'	  => esc_attr__( 'Instagram', 'elif-lite' ),
				'pattern' => '<li class="social-instagram"><a title="%s" href="%s" %s><i class="fa fa-instagram"></i></a></li>',
			),			
			'vimeo' => array(
				'label'	  => esc_attr__( 'Vimeo', 'elif-lite' ),
				'pattern' => '<li class="social-vimeo"><a title="%s" href="%s" %s><i class="fa fa-vimeo"></i></a></li>',
			),
			'foursquare' => array(
				'label'	  => esc_attr__( 'FourSquare', 'elif-lite' ),
				'pattern' => '<li class="social-foursquare"><a title="%s" href="%s" %s><i class="fa fa-foursquare"></i></a></li>',
			),	
			'soundcloud' => array(
				'label'	  => esc_attr__( 'Soundcloud', 'elif-lite' ),
				'pattern' => '<li class="social-soundcloud"><a title="%s" href="%s" %s><i class="fa fa-soundcloud"></i></a></li>',
			),						
			'github' => array(
				'label'	  => esc_attr__( 'GitHub', 'elif-lite' ),
				'pattern' => '<li class="social-github"><a title="%s" href="%s" %s><i class="fa fa-github"></i></a></li>',
			),
			'flickr' => array(
				'label'	  => esc_attr__( 'Flickr', 'elif-lite' ),
				'pattern' => '<li class="social-flickr"><a title="%s" href="%s" %s><i class="fa fa-flickr"></i></a></li>',
			),			
			'skype' => array(
				'label'	  => esc_attr__( 'Skype', 'elif-lite' ),
				'pattern' => '<li class="social-skype"><a title="%s" href="%s" %s><i class="fa fa-skype"></i></a></li>',
			),						
					
			'behance' => array(
				'label'	  => esc_attr__( 'Behance', 'elif-lite' ),
				'pattern' => '<li class="social-behance"><a title="%s" href="%s" %s><i class="fa fa-behance"></i></a></li>',
			),
			'dribbble' => array(
				'label'	  => esc_attr__( 'Dribbble', 'elif-lite' ),
				'pattern' => '<li class="social-dribbble"><a title="%s" href="%s" %s><i class="fa fa-dribbble"></i></a></li>',
			),
			'dropbox' => array(
				'label'	  => esc_attr__( 'Dropbox', 'elif-lite' ),
				'pattern' => '<li class="social-dropbox"><a title="%s" href="%s" %s><i class="fa fa-dropbox"></i></a></li>',
			),
			'amazon' => array(
				'label'	  => esc_attr__( 'Amazon', 'elif-lite' ),
				'pattern' => '<li class="social-amazon"><a title="%s" href="%s" %s><i class="fa fa-amazon"></i></a></li>',
			),
			'apple' => array(
				'label'	  => esc_attr__( 'Apple', 'elif-lite' ),
				'pattern' => '<li class="social-apple"><a title="%s" href="%s" %s><i class="fa fa-apple"></i></a></li>',
			),
			'snapchat' => array(
				'label'	  => esc_attr__( 'Snapchat', 'elif-lite' ),
				'pattern' => '<li class="social-snapchat"><a title="%s" href="%s" %s><i class="fa fa-snapchat"></i></a></li>',
			),
			'bitbucket' => array(
				'label'	  => esc_attr__( 'Bitbucket', 'elif-lite' ),
				'pattern' => '<li class="social-bitbucket"><a title="%s" href="%s" %s><i class="fa fa-bitbucket"></i></a></li>',
			),
			'stack-overflow' => array(
				'label'	  => esc_attr__( 'Stack Overflow', 'elif-lite' ),
				'pattern' => '<li class="social-stack-overflow"><a title="%s" href="%s" %s><i class="fa fa-stack-overflow"></i></a></li>',
			),
			'stack-exchange' => array(
				'label'	  => esc_attr__( 'Stack Exchange', 'elif-lite' ),
				'pattern' => '<li class="social-stack-exchange"><a title="%s" href="%s" %s><i class="fa fa-stack-exchange"></i></a></li>',
			),
			'slack' => array(
				'label'	  => esc_attr__( 'Slack', 'elif-lite' ),
				'pattern' => '<li class="social-slack"><a title="%s" href="%s" %s><i class="fa fa-slack"></i></a></li>',
			),
			'codepen' => array(
				'label'	  => esc_attr__( 'CodePen', 'elif-lite' ),
				'pattern' => '<li class="social-codepen"><a title="%s" href="%s" %s><i class="fa fa-codepen"></i></a></li>',
			),
			'digg' => array(
				'label'	  => esc_attr__( 'Digg', 'elif-lite' ),
				'pattern' => '<li class="social-digg"><a title="%s" href="%s" %s><i class="fa fa-digg"></i></a></li>',
			),
			'deviantart' => array(
				'label'	  => esc_attr__( 'Deviantart', 'elif-lite' ),
				'pattern' => '<li class="social-"><a title="%s" href="%s" %s><i class="fa fa-deviantart"></i></a></li>',
			),
			'paypal' => array(
				'label'	  => esc_attr__( 'PayPal', 'elif-lite' ),
				'pattern' => '<li class="social-paypal"><a title="%s" href="%s" %s><i class="fa fa-paypal"></i></a></li>',
			),
			'btc' => array(
				'label'	  => esc_attr__( 'Bitcoin', 'elif-lite' ),
				'pattern' => '<li class="social-btc"><a title="%s" href="%s" %s><i class="fa fa-btc"></i></a></li>',
			),
			'odnoklassniki' => array(
				'label'	  => esc_attr__( 'Odnoklassniki', 'elif-lite' ),
				'pattern' => '<li class="social-odnoklassniki"><a title="%s" href="%s" %s><i class="fa fa-odnoklassniki"></i></a></li>',
			),
			'vk' => array(
				'label'	  => esc_attr__( 'Vk', 'elif-lite' ),
				'pattern' => '<li class="social-vk"><a title="%s" href="%s" %s><i class="fa fa-vk"></i></a></li>',
			),
			'whatsapp' => array(
				'label'	  => esc_attr__( 'Whatsapp', 'elif-lite' ),
				'pattern' => '<li class="social-whatsapp"><a title="%s" href="%s" %s><i class="fa fa-whatsapp"></i></a></li>',
			),
			'weixin' => array(
				'label'	  => esc_attr__( 'Weixin', 'elif-lite' ),
				'pattern' => '<li class="social-weixin"><a title="%s" href="%s" %s><i class="fa fa-weixin"></i></a></li>',
			),
			'vine' => array(
				'label'	  => esc_attr__( 'Vine', 'elif-lite' ),
				'pattern' => '<li class="social-vine"><a title="%s" href="%s" %s><i class="fa fa-vine"></i></a></li>',
			),
			'weibo' => array(
				'label'	  => esc_attr__( 'Weibo', 'elif-lite' ),
				'pattern' => '<li class="social-weibo"><a title="%s" href="%s" %s><i class="fa fa-weibo"></i></a></li>',
			),
			'yelp' => array(
				'label'	  => esc_attr__( 'Yelp', 'elif-lite' ),
				'pattern' => '<li class="social-yelp"><a title="%s" href="%s" %s><i class="fa fa-yelp"></i></a></li>',
			),
			'lastfm' => array(
				'label'	  => esc_attr__( 'LastFM', 'elif-lite' ),
				'pattern' => '<li class="social-lastfm"><a title="%s" href="%s" %s><i class="fa fa-lastfm"></i></a></li>',
			),
			'steam' => array(
				'label'	  => esc_attr__( 'Steam', 'elif-lite' ),
				'pattern' => '<li class="social-steam"><a title="%s" href="%s" %s><i class="fa fa-steam"></i></a></li>',
			),
			'twitch' => array(
				'label'	  => esc_attr__( 'Twitch', 'elif-lite' ),
				'pattern' => '<li class="social-twitch"><a title="%s" href="%s" %s><i class="fa fa-twitch"></i></a></li>',
			),
		);  

		$widget_ops = array(
			'classname'      => 'Elif_Social_Icons_Widget',
			'description'    => esc_attr__( 'Show social icons.', 'elif-lite' ),
		);
		$control_ops = array(
			'id_base' => 'social-icons',
		);

		parent::__construct ( 'social-icons', esc_attr__( 'Themient: Social Icons', 'elif-lite' ), $widget_ops, $control_ops );

	}

	function form( $instance ) {

		/* Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e( 'Title:', 'elif-lite' ); ?></label> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>

		<p><label><input id="<?php echo $this->get_field_id( 'new_tab' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" value="1" <?php checked( 1, $instance['new_tab'] ); ?>/> <?php esc_html_e( 'Open links in a new tab?', 'elif-lite' ); ?></label></p>

		<hr style="background: #ccc; border: 0; height: 1px; margin: 20px 0;" />

		<?php
		foreach ( (array) $this->profiles as $profile => $data ) {

			printf( '<p><label for="%s">%s:</label>', esc_attr( $this->get_field_id( $profile ) ), esc_attr( $data['label'] ) );
			printf( '<input type="text" id="%s" class="widefat" name="%s" value="%s" /></p>', esc_attr( $this->get_field_id( $profile ) ), esc_attr( $this->get_field_name( $profile ) ), esc_url( $instance[$profile] ) );

		}

	}

	function update( $newinstance, $oldinstance ) {

		foreach ( $newinstance as $key => $value ) {

			/* Sanitize Profile URIs */
			if ( array_key_exists( $key, (array) $this->profiles ) ) {
				$newinstance[$key] = esc_url_raw( $newinstance[$key] );
			}

		}

		return $newinstance;
	}

	function widget( $args, $instance ) {

		extract( $args );

		/* Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget;

		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;

		$output = '';

		$new_tab = $instance['new_tab'] ? 'target="_blank"' : '';

		foreach ( (array) $this->profiles as $profile => $data ) {
			if ( ! empty( $instance[$profile] ) )
				$output .= sprintf( $data['pattern'], esc_attr( $data['label'] ), esc_url( $instance[$profile] ), $new_tab );
		}

		if ( $output ) {
            printf( '<div class="widget-container social-icons"><ul class="%s">%s</ul></div>', '', $output );
        }

		echo $after_widget;
	}
	
}