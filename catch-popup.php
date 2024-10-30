<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              catchplugins.com
 * @since             1.0.0
 * @package           Popup
 *
 * @wordpress-plugin
 * Plugin Name:       Catch Popup
 * Plugin URI:        https://catchplugins.com/plugins/catch-popup/
 * Description:       Catch Popup is a free versatile popup WordPress plugin that is power-packed with incredible features and customization options to display exciting user-friendly popups.
 * Version:           1.4.4
 * Author:            Catch Plugins
 * Author URI:        catchplugins.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       catch-popup
 * Tags: popup, popups, shortcode
 * Domain Path:       /languages
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// Define Version
define( 'CATCH_POPUP_VERSION', '1.4.4' );

// The URL of the directory that contains the plugin
if ( ! defined( 'CATCH_POPUP_URL' ) ) {
	define( 'CATCH_POPUP_URL', plugin_dir_url( __FILE__ ) );
}


// The absolute path of the directory that contains the file
if ( ! defined( 'CATCH_POPUP_PATH' ) ) {
	define( 'CATCH_POPUP_PATH', plugin_dir_path( __FILE__ ) );
}


// Gets the path to a plugin file or directory, relative to the plugins directory, without the leading and trailing slashes.
if ( ! defined( 'CATCH_POPUP_BASENAME' ) ) {
	define( 'CATCH_POPUP_BASENAME', plugin_basename( __FILE__ ) );
}

define( 'CATCH_POPUP_SLUG', 'catch_popup' );
define( 'CATCH_POPUP_THEME_SLUG', 'catch_popup_theme' );

/**
 * catch_popup_load_textdomain
 *
 * @return [type]
 */
function catch_popup_load_textdomain() {
	load_plugin_textdomain( 'catch-popup', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'catch_popup_load_textdomain' );

/**
 * [Description Catch_Popup]
 */
class Catch_Popup {
	private $plugin_name;


	/**
	 * __construct
	 */

	public function __construct() {
		$this->plugin_name = 'catch-popup';
		require_once CATCH_POPUP_PATH . 'inc/register-post-types.php';
		require_once CATCH_POPUP_PATH . 'inc/admin-enqueue-scripts-styles.php';
		require_once CATCH_POPUP_PATH . 'inc/defaults.php';
		require_once CATCH_POPUP_PATH . 'inc/getters.php';
		require_once CATCH_POPUP_PATH . 'inc/sanitize_functions.php';
		require_once CATCH_POPUP_PATH . 'inc/popup.php';
		require_once CATCH_POPUP_PATH . 'inc/theme.php';
		require_once CATCH_POPUP_PATH . 'inc/generate-css-js.php';
		require_once CATCH_POPUP_PATH . 'inc/install-functions.php';
		require_once CATCH_POPUP_PATH . 'inc/enqueue-scripts-styles.php';
		require_once CATCH_POPUP_PATH . 'inc/shortcode.php';
		require_once CATCH_POPUP_PATH . 'inc/catch-popup-editor-button.php';
		require_once CATCH_POPUP_PATH . 'inc/catch-popup-block/index.php';

		// catch_poup_install_built_in_themes();
		register_activation_hook( __FILE__, 'catch_poup_install_built_in_themes' );
		add_filter( 'plugin_row_meta', array( $this, 'add_plugin_meta_links' ), 10, 2 );
	}

	/**
	 * Add_plugin_meta_links.
	 *
	 * @param mixed $meta_fields Fields.
	 * @param mixed $file Filename.
	 *
	 * @return [type]
	 */
	public function add_plugin_meta_links( $meta_fields, $file ) {
		if ( plugin_basename( __FILE__ ) === $file ) {

			$meta_fields[] = "<a href='https://catchplugins.com/support-forum/forum/catch-popup/' target='_blank'>Support Forum</a>";
			$meta_fields[] = "<a href='https://wordpress.org/support/plugin/catch-popup/reviews#new-post' target='_blank' title='Rate'>
			        <i class='ct-rate-stars'>"
			. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			. "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			. '</i></a>';

			$stars_color = '#ffb900';

			echo '<style>'
				. '.ct-rate-stars{display:inline-block;color:' . esc_html( $stars_color ) . ';position:relative;top:3px;}'
				. '.ct-rate-stars svg{fill:' . esc_html( $stars_color ) . ';}'
				. '.ct-rate-stars svg:hover{fill:' . esc_html( $stars_color ) . '}'
				. '.ct-rate-stars svg:hover ~ svg{fill:none;}'
				. '</style>';
		}

		return $meta_fields;
	}

}

$catch_popup = new Catch_Popup();
