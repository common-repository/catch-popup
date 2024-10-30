<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function catch_popup_border_styles() {
	$border_styles = array(
		'none'   => esc_html__( 'None', 'catch-popup' ),
		'solid'  => esc_html__( 'Solid', 'catch-popup' ),
		'dotted' => esc_html__( 'Dotted', 'catch-popup' ),
		'dashed' => esc_html__( 'Dashed', 'catch-popup' ),
		'double' => esc_html__( 'Double', 'catch-popup' ),
		'groove' => esc_html__( 'Groove', 'catch-popup' ),
		'inset'  => esc_html__( 'Inset (Inner Shadow)', 'catch-popup' ),
		'outset' => esc_html__( 'Outset', 'catch-popup' ),
		'ridge'  => esc_html__( 'Ridge', 'catch-popup' ),
	);
	return $border_styles;
}

function catch_popup_alignment() {
	$border_styles = array(
		'left'    => esc_html__( 'Left', 'catch-popup' ),
		'center'  => esc_html__( 'Center', 'catch-popup' ),
		'right'   => esc_html__( 'Right', 'catch-popup' ),
		'justify' => esc_html__( 'Justify', 'catch-popup' ),
	);
	return $border_styles;
}

function catch_popup_font_style() {
	$text_style = array(
		'normal' => esc_html__( 'Normal', 'catch-popup' ),
		'italic' => esc_html__( 'Italic', 'catch-popup' ),
	);
	return $text_style;
}

function catch_popup_close_location() {
	$location = array(
		'topleft'      => esc_html__( 'Top Left', 'catch-popup' ),
		'topcenter'    => esc_html__( 'Top Center', 'catch-popup' ),
		'topright'     => esc_html__( 'Top Right', 'catch-popup' ),
		'middleleft'   => esc_html__( 'Middle Left', 'catch-popup' ),
		'middlecenter' => esc_html__( 'Middle Center', 'catch-popup' ),
		'middleright'  => esc_html__( 'Middle Right', 'catch-popup' ),
		'bottomleft'   => esc_html__( 'Bottom Left', 'catch-popup' ),
		'bottomcenter' => esc_html__( 'Bottom Center', 'catch-popup' ),
		'bottomright'  => esc_html__( 'Bottom Right', 'catch-popup' ),
	);
	return $location;
}

function catch_popup_inset() {
	$inset = array(
		'no'  => esc_html__( 'No', 'catch-popup' ),
		'yes' => esc_html__( 'Yes', 'catch-popup' ),
	);
	return $inset;
}

function catch_popup_font_weight() {
	$font_weight = array(
		'100' => esc_html__( '100', 'catch-popup' ),
		'200' => esc_html__( '200', 'catch-popup' ),
		'300' => esc_html__( '300', 'catch-popup' ),
		'400' => esc_html__( '400 (Normal)', 'catch-popup' ),
		'500' => esc_html__( '500', 'catch-popup' ),
		'600' => esc_html__( '600', 'catch-popup' ),
		'700' => esc_html__( '700 (Bold)', 'catch-popup' ),
		'800' => esc_html__( '800', 'catch-popup' ),
		'900' => esc_html__( '900', 'catch-popup' ),
	);
	return $font_weight;
}

function catch_popup_size() {
	$size_options = array(
		'nano'    => esc_html__( 'Nano - 10%', 'catch-popup' ),
		'micro'   => esc_html__( 'Micro - 20%', 'catch-popup' ),
		'tiny'    => esc_html__( 'Tiny - 30%', 'catch-popup' ),
		'small'   => esc_html__( 'Small - 40%', 'catch-popup' ),
		'medium'  => esc_html__( 'Medium - 60%', 'catch-popup' ),
		'normal'  => esc_html__( 'Normal - 70%', 'catch-popup' ),
		'large'   => esc_html__( 'Large - 80%', 'catch-popup' ),
		'x-large' => esc_html__( 'X-large - 95%', 'catch-popup' ),
		'auto'    => esc_html__( 'Auto', 'catch-popup' ),
		'custom'  => esc_html__( 'Custom', 'catch-popup' ),

	);
	return $size_options;
}

function catch_popup_unit() {
	$unit_options = array(
		'px'  => esc_html__( 'px', 'catch-popup' ),
		'%'   => esc_html__( '%', 'catch-popup' ),
		'em'  => esc_html__( 'em', 'catch-popup' ),
		'rem' => esc_html__( 'rem', 'catch-popup' ),
	);
	return $unit_options;
}

function catch_popup_animation() {
	$animation_type = array(
		'none'       => esc_html__( 'None', 'catch-popup' ),
		'fade'       => esc_html__( 'Fade', 'catch-popup' ),
		'slide'      => esc_html__( 'Slide', 'catch-popup' ),
		'fade-slide' => esc_html__( 'Fade & Slide', 'catch-popup' ),
	);
	return $animation_type;
}

function catch_popup_themes_meta_default() {
	$default_meta_values = array(
		'overlay_color'                               => '#000000',
		'overlay_opacity'                             => 0,
		'overlay_background_image'                    => '',
		'container_padding'                           => 10,
		'container_border_radius'                     => 0,
		'container_background_color'                  => '#ffffff',
		'container_background_opacity'                => 100,
		'container_background_image'                  => '',
		'container_border_style'                      => 'none',
		'container_border_color'                      => '',
		'container_border_thickness'                  => 0,
		'container_dropshadow_horizontal_position'    => 1,
		'container_dropshadow_vertical_position'      => 1,
		'container_dropshadow_blur_radius'            => 3,
		'container_dropshadow_opacity'                => 23,
		'container_dropshadow_color'                  => '#020202',
		'container_dropshadow_spread'                 => 0,
		'container_dropshadow_inset'                  => 'no',
		'title_font_color'                            => '#000000',
		'title_font_family'                           => '',
		'title_line_height'                           => 48,
		'title_font_size'                             => 32,
		'title_font_weight'                           => 400,
		'title_font_style'                            => 'normal',
		'title_alignment'                             => 'left',
		'title_textshadow_horizontal_position'        => 0,
		'title_textshadow_vertical_position'          => 0,
		'title_textshadow_opacity'                    => 23,
		'title_textshadow_blur_radius'                => 1,
		'title_textshadow_color'                      => '',
		'content_color'                               => '#000000',
		'content_font_family'                         => '',
		'content_font_weight'                         => 400,
		'content_font_style'                          => '',
		'close_button_text'                           => esc_html__( 'Close', 'catch-popup' ),
		'close_button_position_outside_container'     => false,
		'close_button_location'                       => 'topright',
		'close_button_top'                            => 0,
		'close_button_right'                          => 0,
		'close_button_bottom'                         => 0,
		'close_button_left'                           => 0,
		'close_button_padding'                        => 5,
		'close_button_width'                          => 32,
		'close_button_height'                         => 32,
		'close_button_border_radius'                  => 5,
		'close_button_background_color'               => '',
		'close_button_opacity'                        => 100,
		'close_button_background_image'               => '',
		'close_button_font_color'                     => '#000000',
		'close_button_font_size'                      => 32,
		'close_button_line_height'                    => 12,
		'close_button_font_family'                    => '',
		'close_button_font_weight'                    => 400,
		'close_button_font_style'                     => 'normal',
		'close_button_border_style'                   => 'none',
		'close_button_border_color'                   => '',
		'close_button_border_thickness'               => 0,
		'close_button_dropshadow_color'               => '',
		'close_button_dropshadow_opacity'             => 23,
		'close_button_dropshadow_horizontal_position' => 0,
		'close_button_dropshadow_vertical_position'   => 0,
		'close_button_dropshadow_blur_radius'         => 0,
		'close_button_dropshadow_spread'              => 0,
		'close_button_dropshadow_inset'               => 0,
		'close_button_textshadow_color'               => '',
		'close_button_textshadow_opacity'             => 23,
		'close_button_textshadow_horizontal_position' => 0,
		'close_button_textshadow_vertical_position'   => 0,
		'close_button_textshadow_blur_radius'         => 0,
	);
	return $default_meta_values;
}

function catch_popup_meta_default() {
	$default_meta_values = array(
		'catch_popup_theme'                 => 'default',
		'catch_popup_style'                 => 'auto',
		'catch_popup_delay'                 => 0,
		'catch_popup_size'                  => 'medium',
		'catch_popup_min_width'             => 0,
		'catch_popup_max_width'             => 100,
		'catch_popup_width'                 => 640,
		'catch_popup_width_unit'            => 'px',
		'catch_popup_auto_height'           => 1,
		'catch_popup_height'                => 0,
		'catch_popup_height_unit'           => 'px',
		'catch_popup_animation_type'        => '',
		'catch_popup_animation_speed'       => '',
		'catch_popup_location'              => 'topcenter',
		'catch_popup_top'                   => 100,
		'catch_popup_right'                 => 0,
		'catch_popup_bottom'                => 0,
		'catch_popup_left'                  => 0,
		'catch_popup_position_from_trigger' => 0,
		'catch_popup_fixed'                 => 0,
		'catch_popup_zindex'                => 10000,
		'catch_popup_button_text'           => '',
		'catch_popup_button_delay'          => 0,
		'catch_popup_overlay_close'         => 0,
		'catch_popup_esc_close'             => 0,
		'catch_popup_f4_close'              => 0,
		'catch_popup_target'                => array(),
		'catch_popup_target_value'          => array(),
		'catch_popup_target_condition'      => array(),
		'catch_popup_target_text'           => array(),

	);
	return $default_meta_values;
}

if ( ! function_exists( 'catch_popup_font_family' ) ) :
	function catch_popup_font_family() {

		$avaliable_fonts = array(
			'aerial-black'        => esc_html__( 'Arial Black, Gadget, sans-serif', 'catch-breadcrumb-pro' ),
			'allan'               => esc_html__( 'Allan, sans-serif', 'catch-breadcrumb-pro' ),
			'allerta'             => esc_html__( 'Allerta, sans-serif', 'catch-breadcrumb-pro' ),
			'amaranth'            => esc_html__( 'Amaranth, sans-serif', 'catch-breadcrumb-pro' ),
			'amatic-sc'           => esc_html__( 'Amatic SC, cursive', 'catch-breadcrumb-pro' ),
			'aerial'              => esc_html__( 'Arial, Helvetica, sans-serif', 'catch-breadcrumb-pro' ),
			'amatic-sc'           => esc_html__( 'Amatic SC, cursive', 'catch-breadcrumb-pro' ),
			'bitter'              => esc_html__( 'Bitter, sans-serif', 'catch-breadcrumb-pro' ),
			'cabin'               => esc_html__( 'Cabin, sans-serif', 'catch-breadcrumb-pro' ),
			'cantarell'           => esc_html__( 'Cantarell, sans-serif', 'catch-breadcrumb-pro' ),
			'century-gothic'      => esc_html__( 'Century Gothic, sans-serif', 'catch-breadcrumb-pro' ),
			'courier-new'         => esc_html__( 'Courier New, Courier, monospace', 'catch-breadcrumb-pro' ),
			'crimson-text'        => esc_html__( 'Crimson Text, sans-serif', 'catch-breadcrumb-pro' ),
			'cuprum'              => esc_html__( 'Cuprum, sans-serif', 'catch-breadcrumb-pro' ),
			'dancing-script'      => esc_html__( 'Dancing Script, sans-serif', 'catch-breadcrumb-pro' ),
			'droid-sans'          => esc_html__( 'Droid Sans, sans-serif', 'catch-breadcrumb-pro' ),
			'exo'                 => esc_html__( 'Exo, sans-serif', 'catch-breadcrumb-pro' ),
			'exo-2'               => esc_html__( 'Exo 2, sans-serif', 'catch-breadcrumb-pro' ),
			'georgia'             => esc_html__( 'Georgia, Times New Roman, Times, serif', 'catch-breadcrumb-pro' ),
			'helvetica'           => esc_html__( 'Helvetica Neue,Helvetica,Arial,sans-serif', 'catch-breadcrumb-pro' ),
			'istok-web'           => esc_html__( 'Istok Web, sans-serif', 'catch-breadcrumb-pro' ),
			'droid-serif'         => esc_html__( 'Droid Serif, sans-serif', 'catch-breadcrumb-pro' ),
			'impact'              => esc_html__( 'Impact, Charcoal, sans-serif', 'catch-breadcrumb-pro' ),
			'josefin-sans'        => esc_html__( 'Josefin Sans, sans-serif', 'catch-breadcrumb-pro' ),
			'lucida-sans-unicode' => esc_html__( 'Lucida Sans Unicode, Lucida Grande, sans-serif', 'catch-breadcrumb-pro' ),
			'lucida-grande'       => esc_html__( 'Lucida Grande, Lucida Sans Unicode, sans-serif', 'catch-breadcrumb-pro' ),
			'lobster'             => esc_html__( 'Lobster, sans-serif', 'catch-breadcrumb-pro' ),
			'lora'                => esc_html__( 'Lora, serif', 'catch-breadcrumb-pro' ),
			'onaco'               => esc_html__( 'Monaco, Consolas, Lucida Console, monospace, sans-serif', 'catch-breadcrumb-pro' ),
			'muli'                => esc_html__( 'Muli, sans-serif', 'catch-breadcrumb-pro' ),
			'montserrat'          => esc_html__( 'Montserrat, sans-serif', 'catch-breadcrumb-pro' ),
			'nobile'              => esc_html__( 'Nobile, sans-serif', 'catch-breadcrumb-pro' ),
			'noto-serif'          => esc_html__( 'Noto Serif, serif', 'catch-breadcrumb-pro' ),
			'neuton'              => esc_html__( 'Neuton, serifNeuton, serif', 'catch-breadcrumb-pro' ),
			'open-sans'           => esc_html__( 'Open Sans, sans-serif', 'catch-breadcrumb-pro' ),
			'oswald'              => esc_html__( 'Oswald, sans-serif', 'catch-breadcrumb-pro' ),
			'palatinov'           => esc_html__( 'Palatino, Palatino Linotype, Book Antiqua, serif', 'catch-breadcrumb-pro' ),
			'patua-one'           => esc_html__( 'Patua One, sans-serif', 'catch-breadcrumb-pro' ),
			'poppins'             => esc_html__( 'Poppins, sans-serif', 'catch-breadcrumb-pro' ),
			'playfair-display'    => esc_html__( 'Playfair Display, sans-serif', 'catch-breadcrumb-pro' ),
			'pt-sans'             => esc_html__( 'PT Sans, sans-serif', 'catch-breadcrumb-pro' ),
			'pt-serif'            => esc_html__( 'PT Serif, serif', 'catch-breadcrumb-pro' ),
			'quattrocento-sans'   => esc_html__( 'Quattrocento Sans, sans-serif', 'catch-breadcrumb-pro' ),
			'roboto'              => esc_html__( 'Roboto Slab, serif', 'catch-breadcrumb-pro' ),
			'rubik'               => esc_html__( 'Rubik, serif', 'catch-breadcrumb-pro' ),
			'sans-serif'          => esc_html__( 'Sans Serif, Arial', 'catch-breadcrumb-pro' ),
			'source-sans-pro'     => esc_html__( 'Source Sans Pro, sans-serif', 'catch-breadcrumb-pro' ),
			'tahoma'              => esc_html__( 'Tahoma, Geneva, sans-serif', 'catch-breadcrumb-pro' ),
			'trebuchet-ms'        => esc_html__( 'Trebuchet MS, Helvetica, sans-serif', 'catch-breadcrumb-pro' ),
			'times-new-roman'     => esc_html__( 'Times New Roman, Times, serif', 'catch-breadcrumb-pro' ),
			'varela'              => esc_html__( 'Varela, sans-serif', 'catch-breadcrumb-pro' ),
			'verdana'             => esc_html__( 'Verdana, Geneva, sans-serif', 'catch-breadcrumb-pro' ),
			'yanone-kaffeesatz'   => esc_html__( 'Yanone Kaffeesatz, sans-serif', 'catch-breadcrumb-pro' ),
		);
		return $avaliable_fonts;
	}
endif;


if ( ! function_exists( 'catch_popup_fonts_url' ) ) :
	function catch_popup_fonts_url() {

		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';
		if ( is_admin() ) {
			$font_values = catch_popup_font_family();
			$fonts       = array();
			foreach ( $font_values as $key => $font ) {
				$fonts[] = $key;
			}
			$font_values = $fonts;
		} else {
			$font_values = catch_popup_font_options();
		}

		$web_fonts = array(
			'allan'             => 'Allan',
			'allerta'           => 'Allerta',
			'amaranth'          => 'Amaranth',
			'amatic-sc'         => 'Amatic SC',
			'bitter'            => 'Bitter',
			'cabin'             => 'Cabin',
			'cantarell'         => 'Cantarell',
			'crimson-text'      => 'Crimson+Text',
			'cuprum'            => 'Cuprum',
			'dancing-script'    => 'Dancing Script',
			'droid-sans'        => 'Droid Sans',
			'droid-serif'       => 'Droid Serif',
			'exo'               => 'Exo',
			'exo-2'             => 'Exo 2',
			'istok-web'         => 'Istok Web',
			'josefin-sans'      => 'Josefin Sans',
			'lato'              => 'Lato',
			'lobster'           => 'Lobster',
			'lora'              => 'Lora',
			'montserrat'        => 'Montserrat',
			'muli'              => 'Muli',
			'nobile'            => 'Nobile',
			'noto-serif'        => 'Noto Serif',
			'neuton'            => 'Neuton',
			'open-sans'         => 'Open Sans',
			'oswald'            => 'Oswald',
			'patua-one'         => 'Patua One',
			'poppins'           => 'Poppins',
			'playfair-display'  => 'Playfair Display',
			'pt-sans'           => 'PT Sans',
			'pt-serif'          => 'PT Serif',
			'rubik'             => 'Rubik',
			'quattrocento-sans' => 'Quattrocento Sans',
			'roboto'            => 'Roboto',
			'roboto-slab'       => 'Roboto Slab',
			'source-sans-pro'   => 'Source Sans Pro',
			'ubuntu'            => 'Ubuntu',
			'varela'            => 'Varela',
			'yanone-kaffeesatz' => 'Yanone Kaffeesatz',
		);

		$font_values = array_intersect( $font_values, array_keys( $web_fonts ) );

		foreach ( $font_values as $font_value ) {
			$fonts[] = $web_fonts[ $font_value ] . ':300,400,500,600,700,800,900,400italic,700italic,800italic,900italic';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return esc_url( $fonts_url );
	}
endif;

function catch_popup_upload_dir( $type ) {
	$wp_upload_dir = wp_upload_dir();
	$upload_dir    = $wp_upload_dir[ $type ];
	$upload_dir    = trailingslashit( $upload_dir ) . 'catch-popup';
	return $upload_dir;
}
