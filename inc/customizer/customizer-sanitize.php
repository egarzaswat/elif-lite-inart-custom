<?php

/**
 * @package elif-lite
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Sanitize text
function elif_sanitize_text( $input ) {
    /*
     * Sanitize text
     * @param string
     *
     * @return string
     * @since 1.0.0
     */
    $allowed_html = array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
    );

	return wp_kses( $input, $allowed_html );
}

// Sanitize checkbox
function elif_sanitize_checkbox( $input ) {
    /*
     * Sanitize checkbox
     * @param int
     *
     * @return int/string
     * @since 1.0.0
     */
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

// Sanitize integer
function elif_sanitize_integer( $input ) {
    /*
     * Sanitize integer
     * @param int
     *
     * @return int
     * @since 1.0.0
     */
	return absint( $input );
}

// Sanitize Choices
function elif_sanitize_choices( $input, $setting ) {
    /*
     * Sanitize choices
     * @param string
     * @param object
     *
     * @return object
     * @since 1.0.0
     */

	global $wp_customize;
	$control = $wp_customize->get_control( $setting->id );

	if ( array_key_exists( $input, $control->choices ) ) {
		return $input;
	} else {
		return $setting->default;
	}
}

// Sanitize color ( Validate both HEX & RGBA colors )
function elif_sanitize_color( $input ) {
    /*
     * Sanitize color ( Validate both HEX & RGBA colors )
     * @param string
     *
     * @return string
     * @since 1.0.0
     */

    if ( preg_match( '/^#[a-f0-9]{6}$/i', $input ) || preg_match( '/\A^rgba\(([0]*[0-9]{1,2}|[1][0-9]{2}|[2][0-4][0-9]|[2][5][0-5])\s*,\s*([0]*[0-9]{1,2}|[1][0-9]{2}|[2][0-4][0-9]|[2][5][0-5])\s*,\s*([0]*[0-9]{1,2}|[1][0-9]{2}|[2][0-4][0-9]|[2][5][0-5])\s*,\s*([0-9]*\.?[0-9]+)\)$\z/im', $input ) ) {
        return $input;
    }

    return '';
}