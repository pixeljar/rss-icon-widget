<?php
/**
 * Creates a shortcode to use in content areas.
 *
 * @package WordPress
 */

namespace RSSIW;

/**
 * Shortcode class.
 */
class Shortcode {

	/**
	 * Hooks into WordPress.
	 */
	public static function hooks() {

		add_shortcode( 'rssiw', [ __CLASS__, 'shortcode' ] );

	}

	/**
	 * The shortcode callback.
	 *
	 * @param array $atts The shortcode attributes.
	 * @return string
	 */
	public static function shortcode( $atts = [] ) {

		$output = '';

		$widget_defaults = [
			'image_size' => '10',
			'link_text'  => __( 'Subscribe via RSS', 'rssiw' ),
			'link_color' => '#ff0000',
			'new_window' => '0',
			'feed_url'   => trailingslashit( get_bloginfo( 'rss2_url' ) ),
		];

		$instance = shortcode_atts( $widget_defaults, $atts, 'rssiw' );

		// Open the RSS Link.
		$output .= sprintf(
			'<a href="%s" ',
			esc_attr( sanitize_url( $instance['feed_url'] ) )
		);

			// Open in a new window?
			echo ( isset( $instance['new_window'] ) && 1 === intval( $instance['new_window'] ) ? 'target="_blank" ' : '' );

			// Styles.
			printf(
				'style="color: %s; padding: %s; background: %s no-repeat 0 50%%;">',
				esc_attr( $instance['link_color'] ),
				esc_attr( ( $instance['image_size'] / 2 ) . 'px 0px ' . ( $instance['image_size'] / 2 ) . 'px ' . ( $instance['image_size'] + 5 ) . 'px' ),
				esc_attr( 'url(\'' . RSSIW_URL . 'icons/feed-icon-' . $instance['image_size'] . 'x' . $instance['image_size'] . '.png\')' )
			);

			// The link Text.
			echo esc_html( $instance['link_text'] );

		// Close the RSS Link.
		echo '</a>';

		// After widget arguments are defined by themes.
		echo $args['after_widget']; // TODO: Look into the best way to escape this data.

		$output = '';

		return $output;

	}

}
