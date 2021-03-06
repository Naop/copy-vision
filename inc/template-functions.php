<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Copy_Vision
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function copy_vision_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add page slug to body class.
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_name;
	}

	return $classes;
}
add_filter( 'body_class', 'copy_vision_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function copy_vision_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'copy_vision_pingback_header' );
