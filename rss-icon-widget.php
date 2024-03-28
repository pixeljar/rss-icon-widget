<?php
/**
 * Plugin Name: RSS Icons
 * Plugin URI: https://pixeljar.com
 * Description: The idea is to have a widget to display a link to any rss feed with a <a href="http://www.feedicons.com">standard feed icon</a>.
 * Version: 5.3
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Pixel Jar
 * Author URI: http://www.pixeljar.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: rssiw
 * Domain Path: /lang
 *
 * Copyright (C) Mar 15, 2019  Pixel Jar  info@pixeljar.com
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @package WordPress
 */

/**
 * Load internationalization files.
 *
 * @return void
 */
function rssiw_load_textdomain() {
	load_plugin_textdomain( 'rssiw', false, RSSIW_REL );
}
add_action( 'plugins_loaded', 'rssiw_load_textdomain' );

define( 'RSSIW_URL', plugin_dir_url( __FILE__ ) );
define( 'RSSIW_ABS', plugin_dir_path( __FILE__ ) );
define( 'RSSIW_REL', basename( __DIR__ ) );
define( 'RSSIW_SLUG', plugin_basename( __FILE__ ) );
define( 'RSSIW_ASSETS', plugin_dir_url( __FILE__ ) . 'assets/' );
define( 'RSSIW_LANG', RSSIW_ABS . 'i18n/' );
define( 'RSSIW_VERSION', '5.3' );

require_once RSSIW_ABS . 'lib/class-rssiconwidget.php';
require_once RSSIW_ABS . 'lib/class-dynamicrssiconwidget.php';

// Changelog.
if ( ! class_exists( 'RSSIW_Changelog' ) ) {
	require_once RSSIW_ABS . 'lib/class-changelog.php';
}

/**
 * Register RSSIconWidget widget
 */
function register_rss_icon_widget() {
	return register_widget( 'RSSIconWidget' );
}
add_action( 'widgets_init', 'register_rss_icon_widget' );

/**
 * Register DynamicRSSIconWidget widget
 */
function register_dynamic_rss_icon_widget() {
	return register_widget( 'DynamicRSSIconWidget' );
}
add_action( 'widgets_init', 'register_dynamic_rss_icon_widget' );

/**
 * Register scripts for widgets.
 *
 * @param string $hook The current page.
 */
function rss_icon_widget_scripts( $hook ) {

	if ( 'widgets.php' !== $hook ) {
		return;
	}

	wp_enqueue_script(
		'rss-icon-widget',
		RSSIW_ASSETS . 'js/widget.js',
		array( 'jquery', 'wp-color-picker' ),
		RSSIW_VERSION,
		true
	);

	wp_enqueue_style( 'wp-color-picker' );

}

add_action( 'admin_enqueue_scripts', 'rss_icon_widget_scripts' );
