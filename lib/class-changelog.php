<?php
/**
 * RSS Icon Widget Changelog
 *
 * @package WordPress
 */

namespace RSSIW;

/**
 * RSSIW_Changelog
 */
class Changelog {

	/**
	 * Constructor.
	 */
	public function __construct() {}

	/**
	 * The transient name
	 *
	 * @var string
	 */
	private static $transient_name = '_rssiw_activation';

	/**
	 * The admin page slug
	 *
	 * @var string
	 */
	private static $page_slug = 'rssiw-changelog';

	/**
	 * The hooks for this class
	 */
	public static function hooks() {

		register_activation_hook( plugin_dir_path( __DIR__ ) . 'rss-icon-widget.php', [ __CLASS__, 'welcome_transient' ] );
		add_action( 'admin_init', [ __CLASS__, 'welcome_redirect' ] );
		add_action( 'admin_menu', [ __CLASS__, 'admin_page' ] );
		add_action( 'admin_enqueue_scripts', [ __CLASS__, 'enqueue_style' ], 10, 1 );
		add_filter( 'plugin_action_links_rss-icon-widget/rss-icon-widget.php', [ __CLASS__, 'plugin_link' ], 10, 1 );

	}

	/**
	 * Set a transient when this plugin is activated.
	 */
	public static function welcome_transient() {

		set_transient( self::$transient_name, true, 30 );

	}

	/**
	 * Redirect to changelog when plugin is activated.
	 */
	public static function welcome_redirect() {

		// If no transient set, return.
		if ( ! get_transient( self::$transient_name ) ) {
			return;
		}

		// Delete the transient to prevent multiple redirects.
		delete_transient( self::$transient_name );

		// Do not redirect on network activate or bulk activate.
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			return;
		}

		// Redirect to the changelog.
		wp_safe_redirect(
			add_query_arg( 'page', self::$page_slug, admin_url( 'admin.php' ) )
		);

	}

	/**
	 * Adds admin page
	 */
	public static function admin_page() {

		add_submenu_page(
			'admin.php',
			__( 'RSS Icon Widget Changelog', 'rssiw' ),
			__( 'RSS Icon Widget Changelog', 'rssiw' ),
			'manage_options',
			self::$page_slug,
			array( __CLASS__, 'render_admin_page' )
		);

	}

	/**
	 * Renders admin page
	 */
	public static function render_admin_page() {

		require_once plugin_dir_path( __DIR__ ) . 'views/changelog.php';

	}

	/**
	 * Enqueue style to changelog page.
	 *
	 * @param string $hook The current page.
	 */
	public static function enqueue_style( $hook ) {

		if ( 'admin_page_rssiw-changelog' !== $hook ) {
			return;
		}

		wp_enqueue_style(
			'rssiw-changelog',
			RSSIW_ASSETS . 'css/changelog.css',
			array(),
			RSSIW_VERSION,
			'all'
		);

	}

	/**
	 * Add Changelog link to plugins page.
	 *
	 * @param array $links The plugin action links.
	 */
	public static function plugin_link( $links ) {

		$links['changelog'] = sprintf(
			'<a href="%s" aria-label="%s">%s</a>',
			add_query_arg( 'page', self::$page_slug, admin_url( 'admin.php' ) ),
			esc_attr__( 'RSS Icon Widget Changelog', 'rssiw' ),
			esc_html__( 'Changelog', 'rssiw' )
		);
		return $links;

	}

}

Changelog::hooks();
