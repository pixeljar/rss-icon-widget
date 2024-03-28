<?php
/**
 * The RSS Icon Widget.
 *
 * @package PJ_RSS_Icon_Widget
 */

/**
 * RSSIconWidget extends the WP_Widget class.
 */
class RSSIconWidget extends WP_Widget {

	/**
	 * Icon sizes.
	 *
	 * @var array $icon_sizes
	 */
	public $icon_sizes = [
		'10' => '10 x 10',
		'12' => '12 x 12',
		'14' => '14 x 14',
		'16' => '16 x 16',
		'24' => '24 x 24',
		'32' => '32 x 32',
	];

	/**
	 * Widget defaults.
	 *
	 * @var array $widget_defaults
	 */
	public $widget_defaults = null;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_defaults = [
			'image_size' => '10',
			'link_text'  => __( 'Subscribe via RSS', 'rssiw' ),
			'link_color' => '#ff0000',
			'new_window' => '0',
			'feed_url'   => trailingslashit( get_bloginfo( 'rss2_url' ) ),
		];

		parent::__construct(
			false,
			__( 'RSS Icon Widget', 'rssiw' ),
			[
				'description' => __( 'Display a link with the standard RSS Feed Icon linked to an RSS feed of your choice.', 'rssiw' ),
			]
		);

	}

	/**
	 * The widget.
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 *
	 * @see WP_Widget::widget
	 */
	public function widget( $args = [], $instance = [] ) {

		// Before widget arguments are defined by themes.
		echo $args['before_widget']; // TODO: Look into the best way to escape this data.

		// Open the RSS Link.
		printf(
			'<a href="%s" ',
			esc_attr( $instance['feed_url'] )
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

	}

	/**
	 * Update the widget settings.
	 *
	 * @param array $new_instance The new settings for the widget instance.
	 * @param array $old_instance The old settings for the widget instance.
	 *
	 * @return array The updated settings.
	 * @see WP_Widget::update
	 */
	public function update( $new_instance = [], $old_instance = [] ) {

		// Ensure all values are represented.
		$updated_instance = wp_parse_args( $new_instance, $this->widget_defaults );
		foreach ( $updated_instance as $key => $value ) {

			if ( ! array_key_exists( $key, $this->widget_defaults ) ) {

				// Remove unknown keys.
				unset( $updated_instance[ $key ] );

			} else {

				// Sanitize the values.
				$updated_instance[ $key ] = sanitize_text_field( wp_unslash( $value ) );

			}

		}

		return $updated_instance;

	}

	/**
	 * The widget form.
	 *
	 * @param array $instance The settings for the particular instance of the widget.
	 *
	 * @return void
	 * @see WP_Widget::form
	 */
	public function form( $instance = [] ) {

		$settings = wp_parse_args( $instance, $this->widget_defaults );
		?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image_size' ) ); ?>">
					<?php esc_html_e( 'Icon Size:', 'rssiw' ); ?><br />
					<select
						id="<?php echo esc_attr( $this->get_field_id( 'image_size' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'image_size' ) ); ?>"
						style="width: 100%;">
						<?php
						foreach ( $this->icon_sizes as $size_key => $size_name ) {

							printf(
								'<option value="%s" %s>%s</option>',
								esc_attr( $size_key ),
								selected( $settings['image_size'], $size_key, true ),
								esc_html( $size_name )
							);

						}
						?>
					</select>
				</label>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>">
					<?php esc_html_e( 'Link Text:', 'rssiw' ); ?><br />
					<input
						id="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'link_text' ) ); ?>"
						value="<?php echo esc_attr( $settings['link_text'] ); ?>"
						type="text"
						style="width: 100%;" />
				</label>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'link_color' ) ); ?>">
					<?php esc_html_e( 'Link Color:', 'rssiw' ); ?><br />
					<div id="<?php echo esc_attr( $this->get_field_id( 'link_color' ) ); ?>_colorpicker"></div>
					<input
						class="rss-icon-widget-colorpicker"
						id="<?php echo esc_attr( $this->get_field_id( 'link_color' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'link_color' ) ); ?>"
						value="<?php echo esc_attr( $settings['link_color'] ); ?>"
						type="text"
						style="width: 100%;" />
				</label>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'feed_url' ) ); ?>">
					<?php esc_html_e( 'Feed URL:', 'rssiw' ); ?><br />
					<input
						id="<?php echo esc_attr( $this->get_field_id( 'feed_url' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'feed_url' ) ); ?>"
						value="<?php echo esc_attr( $settings['feed_url'] ); ?>"
						type="text"
						style="width: 100%;" />
				</label>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'new_window' ) ); ?>">
					<input
						id="<?php echo esc_attr( $this->get_field_id( 'new_window' ) ); ?>"
						name="<?php echo esc_attr( $this->get_field_name( 'new_window' ) ); ?>"
						value="1"
						type="checkbox"
						<?php checked( 1, intval( $settings['new_window'] ) ); ?> />
					<?php esc_html_e( 'Open in a new window?', 'rssiw' ); ?>
				</label>
			</p>

		<?php

	}

} // class RSSIconWidget
