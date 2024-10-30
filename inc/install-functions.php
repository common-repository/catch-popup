<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Install Functions
 *
 * @package     Catch Popup
 * @subpackage  Functions/Install
 * @copyright   Copyright (c) 2019, Catch Plugins
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * @param bool $network_wide
 */
function catch_poup_install_built_in_themes( $network_wide = false ) {
	delete_option( '_catch_popup_installed_themes' );
	$installed_themes = get_option( '_catch_popup_installed_themes', array() );

	$built_in_themes = array(
		'default'      => array(
			'post_title' => __( 'Default', 'catch-popup' ),
			'meta_input' => array(
				'catch_popup_theme_settings' => 'a:69:{s:13:"overlay_color";s:4:"#000";s:15:"overlay_opacity";s:2:"50";s:24:"overlay_background_image";s:0:"";s:17:"container_padding";s:2:"35";s:23:"container_border_radius";s:1:"0";s:26:"container_background_color";s:4:"#fff";s:28:"container_background_opacity";s:3:"100";s:26:"container_background_image";s:0:"";s:22:"container_border_style";s:4:"none";s:22:"container_border_color";s:0:"";s:26:"container_border_thickness";s:1:"0";s:40:"container_dropshadow_horizontal_position";s:1:"1";s:38:"container_dropshadow_vertical_position";s:1:"1";s:32:"container_dropshadow_blur_radius";s:1:"3";s:28:"container_dropshadow_opacity";s:2:"23";s:26:"container_dropshadow_color";s:7:"#020202";s:27:"container_dropshadow_spread";s:1:"0";s:26:"container_dropshadow_inset";s:2:"no";s:16:"title_font_color";s:4:"#000";s:17:"title_font_family";s:9:"open-sans";s:17:"title_line_height";s:2:"54";s:15:"title_font_size";s:2:"42";s:17:"title_font_weight";s:3:"400";s:16:"title_font_style";s:6:"normal";s:15:"title_alignment";s:4:"left";s:36:"title_textshadow_horizontal_position";s:1:"0";s:34:"title_textshadow_vertical_position";s:1:"0";s:24:"title_textshadow_opacity";s:2:"23";s:28:"title_textshadow_blur_radius";s:1:"1";s:22:"title_textshadow_color";s:0:"";s:13:"content_color";s:7:"#666666";s:19:"content_font_family";s:9:"open-sans";s:19:"content_font_weight";s:3:"400";s:18:"content_font_style";s:0:"";s:17:"close_button_text";s:0:"";s:39:"close_button_position_outside_container";b:0;s:21:"close_button_location";s:8:"topright";s:16:"close_button_top";s:3:"-15";s:18:"close_button_right";s:3:"-15";s:19:"close_button_bottom";s:1:"0";s:17:"close_button_left";s:1:"0";s:20:"close_button_padding";s:1:"5";s:18:"close_button_width";s:2:"32";s:19:"close_button_height";s:2:"32";s:26:"close_button_border_radius";s:2:"28";s:29:"close_button_background_color";s:7:"#333333";s:20:"close_button_opacity";s:3:"100";s:29:"close_button_background_image";s:0:"";s:23:"close_button_font_color";s:7:"#ffffff";s:22:"close_button_font_size";s:2:"32";s:24:"close_button_line_height";s:2:"18";s:24:"close_button_font_family";s:13:"theme_default";s:24:"close_button_font_weight";s:3:"400";s:23:"close_button_font_style";s:6:"normal";s:25:"close_button_border_style";s:5:"solid";s:25:"close_button_border_color";s:0:"";s:29:"close_button_border_thickness";s:1:"1";s:29:"close_button_dropshadow_color";s:0:"";s:31:"close_button_dropshadow_opacity";s:2:"23";s:43:"close_button_dropshadow_horizontal_position";s:2:"-1";s:41:"close_button_dropshadow_vertical_position";s:1:"0";s:35:"close_button_dropshadow_blur_radius";s:1:"3";s:30:"close_button_dropshadow_spread";s:1:"3";s:29:"close_button_dropshadow_inset";s:2:"no";s:29:"close_button_textshadow_color";s:0:"";s:31:"close_button_textshadow_opacity";s:2:"23";s:43:"close_button_textshadow_horizontal_position";s:1:"0";s:41:"close_button_textshadow_vertical_position";s:1:"0";s:35:"close_button_textshadow_blur_radius";s:1:"0";',
				'popup_theme_data_version'   => 3,
			),
		),
		'theme-border' => array(
			'post_title' => __( 'Theme Border', 'catch-popup' ),
			'meta_input' => array(
				'catch_popup_theme_settings' => 'a:69:{s:13:"overlay_color";s:7:"#666666";s:15:"overlay_opacity";s:2:"45";s:24:"overlay_background_image";s:0:"";s:17:"container_padding";s:2:"35";s:23:"container_border_radius";s:1:"0";s:26:"container_background_color";s:7:"#ddae68";s:28:"container_background_opacity";s:3:"100";s:26:"container_background_image";s:0:"";s:22:"container_border_style";s:5:"solid";s:22:"container_border_color";s:7:"#ffffff";s:26:"container_border_thickness";s:2:"15";s:40:"container_dropshadow_horizontal_position";s:1:"1";s:38:"container_dropshadow_vertical_position";s:1:"1";s:32:"container_dropshadow_blur_radius";s:1:"3";s:28:"container_dropshadow_opacity";s:2:"23";s:26:"container_dropshadow_color";s:7:"#020202";s:27:"container_dropshadow_spread";s:1:"0";s:26:"container_dropshadow_inset";s:2:"no";s:16:"title_font_color";s:4:"#000";s:17:"title_font_family";s:6:"oswald";s:17:"title_line_height";s:2:"54";s:15:"title_font_size";s:2:"42";s:17:"title_font_weight";s:3:"400";s:16:"title_font_style";s:6:"normal";s:15:"title_alignment";s:4:"left";s:36:"title_textshadow_horizontal_position";s:1:"0";s:34:"title_textshadow_vertical_position";s:1:"0";s:24:"title_textshadow_opacity";s:2:"23";s:28:"title_textshadow_blur_radius";s:1:"1";s:22:"title_textshadow_color";s:0:"";s:13:"content_color";s:4:"#000";s:19:"content_font_family";s:9:"open-sans";s:19:"content_font_weight";s:3:"400";s:18:"content_font_style";s:0:"";s:17:"close_button_text";s:0:"";s:39:"close_button_position_outside_container";b:0;s:21:"close_button_location";s:8:"topright";s:16:"close_button_top";s:1:"0";s:18:"close_button_right";s:1:"0";s:19:"close_button_bottom";s:1:"0";s:17:"close_button_left";s:1:"0";s:20:"close_button_padding";s:1:"5";s:18:"close_button_width";s:2:"32";s:19:"close_button_height";s:2:"32";s:26:"close_button_border_radius";s:1:"1";s:29:"close_button_background_color";s:7:"#ffffff";s:20:"close_button_opacity";s:3:"100";s:29:"close_button_background_image";s:0:"";s:23:"close_button_font_color";s:7:"#020202";s:22:"close_button_font_size";s:2:"32";s:24:"close_button_line_height";s:2:"18";s:24:"close_button_font_family";s:13:"theme_default";s:24:"close_button_font_weight";s:3:"400";s:23:"close_button_font_style";s:6:"normal";s:25:"close_button_border_style";s:4:"none";s:25:"close_button_border_color";s:0:"";s:29:"close_button_border_thickness";s:1:"0";s:29:"close_button_dropshadow_color";s:0:"";s:31:"close_button_dropshadow_opacity";s:2:"23";s:43:"close_button_dropshadow_horizontal_position";s:1:"0";s:41:"close_button_dropshadow_vertical_position";s:1:"0";s:35:"close_button_dropshadow_blur_radius";s:1:"0";s:30:"close_button_dropshadow_spread";s:1:"0";s:29:"close_button_dropshadow_inset";s:2:"no";s:29:"close_button_textshadow_color";s:0:"";s:31:"close_button_textshadow_opacity";s:2:"23";s:43:"close_button_textshadow_horizontal_position";s:1:"0";s:41:"close_button_textshadow_vertical_position";s:1:"0";s:35:"close_button_textshadow_blur_radius";s:1:"0";}',
				'popup_theme_data_version'   => 3,
			),
		),
		'theme-blue'   => array(
			'post_title' => __( 'Theme Blue', 'catch-popup' ),
			'meta_input' => array(
				'catch_popup_theme_settings' => 'a:69:{s:13:"overlay_color";s:7:"#1e73be";s:15:"overlay_opacity";s:1:"0";s:24:"overlay_background_image";s:0:"";s:17:"container_padding";s:2:"35";s:23:"container_border_radius";s:2:"16";s:26:"container_background_color";s:7:"#2877ff";s:28:"container_background_opacity";s:3:"100";s:26:"container_background_image";s:0:"";s:22:"container_border_style";s:4:"none";s:22:"container_border_color";s:0:"";s:26:"container_border_thickness";s:1:"0";s:40:"container_dropshadow_horizontal_position";s:1:"1";s:38:"container_dropshadow_vertical_position";s:1:"1";s:32:"container_dropshadow_blur_radius";s:1:"3";s:28:"container_dropshadow_opacity";s:2:"23";s:26:"container_dropshadow_color";s:7:"#020202";s:27:"container_dropshadow_spread";s:1:"0";s:26:"container_dropshadow_inset";s:2:"no";s:16:"title_font_color";s:7:"#ffffff";s:17:"title_font_family";s:0:"";s:17:"title_line_height";s:2:"48";s:15:"title_font_size";s:2:"32";s:17:"title_font_weight";s:3:"400";s:16:"title_font_style";s:6:"normal";s:15:"title_alignment";s:4:"left";s:36:"title_textshadow_horizontal_position";s:1:"0";s:34:"title_textshadow_vertical_position";s:1:"0";s:24:"title_textshadow_opacity";s:2:"23";s:28:"title_textshadow_blur_radius";s:1:"1";s:22:"title_textshadow_color";s:0:"";s:13:"content_color";s:7:"#ffffff";s:19:"content_font_family";s:13:"theme_default";s:19:"content_font_weight";i:400;s:18:"content_font_style";s:0:"";s:17:"close_button_text";s:5:"Close";s:39:"close_button_position_outside_container";b:0;s:21:"close_button_location";s:8:"topright";s:16:"close_button_top";s:3:"-28";s:18:"close_button_right";s:3:"-28";s:19:"close_button_bottom";s:1:"0";s:17:"close_button_left";s:1:"0";s:20:"close_button_padding";s:1:"5";s:18:"close_button_width";s:2:"32";s:19:"close_button_height";s:2:"32";s:26:"close_button_border_radius";s:2:"28";s:29:"close_button_background_color";s:7:"#00d8e8";s:20:"close_button_opacity";s:3:"100";s:29:"close_button_background_image";s:0:"";s:23:"close_button_font_color";s:7:"#ffffff";s:22:"close_button_font_size";s:2:"42";s:24:"close_button_line_height";s:2:"18";s:24:"close_button_font_family";s:13:"theme_default";s:24:"close_button_font_weight";s:3:"400";s:23:"close_button_font_style";s:6:"normal";s:25:"close_button_border_style";s:4:"none";s:25:"close_button_border_color";s:0:"";s:29:"close_button_border_thickness";s:1:"0";s:29:"close_button_dropshadow_color";s:0:"";s:31:"close_button_dropshadow_opacity";s:2:"23";s:43:"close_button_dropshadow_horizontal_position";s:2:"-1";s:41:"close_button_dropshadow_vertical_position";s:1:"0";s:35:"close_button_dropshadow_blur_radius";s:1:"3";s:30:"close_button_dropshadow_spread";s:1:"3";s:29:"close_button_dropshadow_inset";s:2:"no";s:29:"close_button_textshadow_color";s:0:"";s:31:"close_button_textshadow_opacity";s:2:"23";s:43:"close_button_textshadow_horizontal_position";s:1:"0";s:41:"close_button_textshadow_vertical_position";s:1:"0";s:35:"close_button_textshadow_blur_radius";s:1:"0";}',
				'popup_theme_data_version'   => 3,
			),
		),
		'theme-light'  => array(
			'post_title' => __( 'Theme Light', 'catch-popup' ),
			'meta_input' => array(
				'catch_popup_theme_settings' => 'a:69:{s:13:"overlay_color";s:7:"#f4f4f4";s:15:"overlay_opacity";s:2:"60";s:24:"overlay_background_image";s:0:"";s:17:"container_padding";s:2:"35";s:23:"container_border_radius";s:1:"0";s:26:"container_background_color";s:7:"#e2e2e2";s:28:"container_background_opacity";s:3:"100";s:26:"container_background_image";s:0:"";s:22:"container_border_style";s:4:"none";s:22:"container_border_color";s:0:"";s:26:"container_border_thickness";s:1:"0";s:40:"container_dropshadow_horizontal_position";s:1:"1";s:38:"container_dropshadow_vertical_position";s:1:"1";s:32:"container_dropshadow_blur_radius";s:1:"3";s:28:"container_dropshadow_opacity";s:2:"23";s:26:"container_dropshadow_color";s:7:"#020202";s:27:"container_dropshadow_spread";s:1:"0";s:26:"container_dropshadow_inset";s:2:"no";s:16:"title_font_color";s:7:"#050505";s:17:"title_font_family";s:13:"theme_default";s:17:"title_line_height";s:2:"48";s:15:"title_font_size";s:2:"32";s:17:"title_font_weight";s:3:"400";s:16:"title_font_style";s:6:"normal";s:15:"title_alignment";s:4:"left";s:36:"title_textshadow_horizontal_position";s:1:"0";s:34:"title_textshadow_vertical_position";s:1:"0";s:24:"title_textshadow_opacity";s:2:"23";s:28:"title_textshadow_blur_radius";s:1:"1";s:22:"title_textshadow_color";s:0:"";s:13:"content_color";s:7:"#3a3a3a";s:19:"content_font_family";s:13:"theme_default";s:19:"content_font_weight";s:3:"400";s:18:"content_font_style";s:0:"";s:17:"close_button_text";s:5:"Close";s:39:"close_button_position_outside_container";b:0;s:21:"close_button_location";s:8:"topright";s:16:"close_button_top";s:1:"0";s:18:"close_button_right";s:1:"0";s:19:"close_button_bottom";s:1:"0";s:17:"close_button_left";s:1:"0";s:20:"close_button_padding";s:1:"5";s:18:"close_button_width";s:2:"32";s:19:"close_button_height";s:2:"32";s:26:"close_button_border_radius";s:1:"5";s:29:"close_button_background_color";s:7:"#eeee22";s:20:"close_button_opacity";s:3:"100";s:29:"close_button_background_image";s:0:"";s:23:"close_button_font_color";s:4:"#000";s:22:"close_button_font_size";s:2:"32";s:24:"close_button_line_height";s:2:"18";s:24:"close_button_font_family";s:13:"theme_default";s:24:"close_button_font_weight";s:3:"400";s:23:"close_button_font_style";s:6:"normal";s:25:"close_button_border_style";s:4:"none";s:25:"close_button_border_color";s:0:"";s:29:"close_button_border_thickness";s:1:"0";s:29:"close_button_dropshadow_color";s:0:"";s:31:"close_button_dropshadow_opacity";s:2:"23";s:43:"close_button_dropshadow_horizontal_position";s:1:"0";s:41:"close_button_dropshadow_vertical_position";s:1:"0";s:35:"close_button_dropshadow_blur_radius";s:1:"0";s:30:"close_button_dropshadow_spread";s:1:"0";s:29:"close_button_dropshadow_inset";s:2:"no";s:29:"close_button_textshadow_color";s:0:"";s:31:"close_button_textshadow_opacity";s:2:"23";s:43:"close_button_textshadow_horizontal_position";s:1:"0";s:41:"close_button_textshadow_vertical_position";s:1:"0";s:35:"close_button_textshadow_blur_radius";s:1:"0";}',
				'popup_theme_data_version'   => 3,
			),
		),
		'theme-round'  => array(
			'post_title' => __( 'Theme Round', 'catch-popup' ),
			'meta_input' => array(
				'catch_popup_theme_settings' => 'a:69:{s:13:"overlay_color";s:7:"#020202";s:15:"overlay_opacity";s:1:"0";s:24:"overlay_background_image";s:0:"";s:17:"container_padding";s:2:"35";s:23:"container_border_radius";s:2:"35";s:26:"container_background_color";s:7:"#4fad35";s:28:"container_background_opacity";s:2:"85";s:26:"container_background_image";s:0:"";s:22:"container_border_style";s:4:"none";s:22:"container_border_color";s:0:"";s:26:"container_border_thickness";s:1:"0";s:40:"container_dropshadow_horizontal_position";s:1:"1";s:38:"container_dropshadow_vertical_position";s:1:"1";s:32:"container_dropshadow_blur_radius";s:1:"3";s:28:"container_dropshadow_opacity";s:2:"23";s:26:"container_dropshadow_color";s:7:"#020202";s:27:"container_dropshadow_spread";s:1:"0";s:26:"container_dropshadow_inset";s:2:"no";s:16:"title_font_color";s:7:"#dd3333";s:17:"title_font_family";s:14:"dancing-script";s:17:"title_line_height";s:2:"40";s:15:"title_font_size";s:2:"40";s:17:"title_font_weight";s:3:"400";s:16:"title_font_style";s:6:"normal";s:15:"title_alignment";s:6:"center";s:36:"title_textshadow_horizontal_position";s:1:"0";s:34:"title_textshadow_vertical_position";s:1:"0";s:24:"title_textshadow_opacity";s:2:"23";s:28:"title_textshadow_blur_radius";s:1:"1";s:22:"title_textshadow_color";s:0:"";s:13:"content_color";s:7:"#eeee22";s:19:"content_font_family";s:14:"dancing-script";s:19:"content_font_weight";i:400;s:18:"content_font_style";s:0:"";s:17:"close_button_text";s:0:"";s:39:"close_button_position_outside_container";b:0;s:21:"close_button_location";s:8:"topright";s:16:"close_button_top";s:2:"16";s:18:"close_button_right";s:2:"16";s:19:"close_button_bottom";s:1:"0";s:17:"close_button_left";s:1:"0";s:20:"close_button_padding";s:1:"5";s:18:"close_button_width";s:2:"32";s:19:"close_button_height";s:2:"32";s:26:"close_button_border_radius";s:2:"28";s:29:"close_button_background_color";s:7:"#9c9c02";s:20:"close_button_opacity";s:3:"100";s:29:"close_button_background_image";s:0:"";s:23:"close_button_font_color";s:7:"#f9f9f9";s:22:"close_button_font_size";s:2:"32";s:24:"close_button_line_height";s:2:"18";s:24:"close_button_font_family";s:13:"theme_default";s:24:"close_button_font_weight";s:3:"400";s:23:"close_button_font_style";s:6:"normal";s:25:"close_button_border_style";s:4:"none";s:25:"close_button_border_color";s:0:"";s:29:"close_button_border_thickness";s:1:"0";s:29:"close_button_dropshadow_color";s:0:"";s:31:"close_button_dropshadow_opacity";s:2:"23";s:43:"close_button_dropshadow_horizontal_position";s:2:"-1";s:41:"close_button_dropshadow_vertical_position";s:1:"0";s:35:"close_button_dropshadow_blur_radius";s:1:"3";s:30:"close_button_dropshadow_spread";s:1:"3";s:29:"close_button_dropshadow_inset";s:2:"no";s:29:"close_button_textshadow_color";s:0:"";s:31:"close_button_textshadow_opacity";s:2:"23";s:43:"close_button_textshadow_horizontal_position";s:1:"0";s:41:"close_button_textshadow_vertical_position";s:1:"0";s:35:"close_button_textshadow_blur_radius";s:1:"0";}',
				'popup_theme_data_version'   => 3,
			),
		),
	);

	$new_theme_installed = false;

	foreach ( $built_in_themes as $post_name => $_theme ) {

		if ( ! in_array( $post_name, $installed_themes ) ) {
			$_theme['post_name']                          = $post_name;
			$_theme['post_type']                          = 'catch_popup_theme';
			$_theme['post_status']                        = 'publish';
			$_theme['meta_input']['_catch_poup_built_in'] = $post_name;

			foreach ( $_theme['meta_input'] as $key => $value ) {
				$_theme['meta_input'][ $key ] = maybe_unserialize( $value );
			}
			wp_insert_post( $_theme );

			$installed_themes[] = $post_name;

			$new_theme_installed = true;
		}
	}

	if ( $new_theme_installed ) {
		update_option( '_catch_popup_installed_themes', $installed_themes );
	}

}
