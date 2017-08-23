<?php

/**
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*-----------------------------------------------------------------------------------*/
/*  Custom Customizer Controls
/*-----------------------------------------------------------------------------------*/
add_action( 'customize_register', 'elif_custom_controls_register' );

function elif_custom_controls_register( $wp_customize ) {
    
    // Switcher control class
	class Elif_Customizer_Switcher_Control extends WP_Customize_Control {
		public $type = 'switcher';
		public function render_content() { ?>

			<label>

                <?php if ( !empty( $this->label ) ) { ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php } ?>
                <?php if ( !empty( $this->description ) ) { ?>
                    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php } ?>

                <input type="checkbox" id="input_<?php echo $this->id; ?>" class="switcher-toggle" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
                <label class="switcher-viewport" for="input_<?php echo $this->id; ?>">
                    <div class="switcher">
                        <div class="switcher-button">&nbsp;</div>
                        <div class="switcher-content left"><span><?php esc_attr_e( 'On', 'elif-lite' ); ?></span></div>
                        <div class="switcher-content right"><span><?php esc_attr_e( 'Off', 'elif-lite' ); ?></span></div>
                    </div>
                </label>

			</label>				
		<?php }
	}

    // Radio-Image control class
	class Elif_Customizer_Radio_Image_Control extends WP_Customize_Control {
		public $type = 'radio-image';

		public function enqueue() {
			wp_enqueue_script( 'jquery-ui-button' );
		}
			
		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}
			$name = '_customize-radio-' . $this->id; ?>

            <?php if ( !empty( $this->label ) ) { ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php } ?>
            <?php if ( !empty( $this->description ) ) { ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php } ?>

			<div id="input_<?php echo $this->id; ?>" class="image">
				<?php foreach ( $this->choices as $value => $label ) : ?>
					<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . esc_attr( $value ); ?>" <?php $this->link(); checked( $this->value(), esc_attr( $value ) ); ?>>
						<label for="<?php echo $this->id . esc_attr( $value ); ?>">
							<img src="<?php echo esc_html( $label ); ?>">
						</label>
					</input>
				<?php endforeach; ?>
			</div>
			<script>jQuery(document).ready(function($) { $( '[id="input_<?php echo $this->id; ?>"]' ).buttonset(); });</script>
		<?php }
    }

    // Radio-Button control class
	class Elif_Customizer_Radio_Button_Control extends WP_Customize_Control {
		public $type = 'radio-button';

		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}
			$name = '_customize-radio-' . $this->id; ?>

            <?php if ( !empty( $this->label ) ) { ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php } ?>
            <?php if ( !empty( $this->description ) ) { ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php } ?>

			<div id="input_<?php echo $this->id; ?>" class="radio-button">
				<?php foreach ( $this->choices as $value => $label ) : ?>
					<input class="button-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id .'-'. esc_attr( $value ); ?>" <?php $this->link(); checked( $this->value(), esc_attr( $value ) ); ?>>
                    <label for="<?php echo $this->id .'-'. esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></label>
				<?php endforeach; ?>
			</div>
		<?php }
    }

    //  Alpha Color Control class
    class Elif_Customizer_Alpha_Color_Control extends WP_Customize_Control {

        public $type = 'alpha-color';

        public $palette;

        public $show_opacity;

        public function enqueue() {
            wp_enqueue_script(
                'elif-lite-alpha-color-picker',
                get_template_directory_uri() . '/inc/customizer/customizer-alpha-color-picker.js',
                array( 'jquery', 'wp-color-picker' ),
                '1.0.0',
                true
            );
            wp_enqueue_style(
                'elif-lite-alpha-color-picker',
                get_template_directory_uri() . '/inc/customizer/customizer-alpha-color-picker.css',
                array( 'wp-color-picker' ),
                '1.0.0'
            );
        }

        public function render_content() {

            // Process the palette
            if ( is_array( $this->palette ) ) {
                $palette = implode( '|', $this->palette );
            } else {
                // Default to true.
                $palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
            }

            // Support passing show_opacity as string or boolean. Default to true.
            $show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
            // Begin the output. ?>

            <label>

                <?php if ( !empty( $this->label ) ) { ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php } ?>
                <?php if ( !empty( $this->description ) ) { ?>
                    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php } ?>

                <input class="alpha-color-control" type="text" data-show-opacity="<?php echo $show_opacity; ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>  />

            </label>

            <?php
        }
    }

}