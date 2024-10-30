<?php

if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Generate JS cache file.
 */
function catch_popup_cache_js() {
	$upload_dir = catch_popup_upload_dir('basedir');
	if (! is_dir($upload_dir)) {
       mkdir( $upload_dir, 0755 );
    }
	$filename = 'catch-popup.js';

	$js_file = $upload_dir . '/' . $filename;

	$js = "/**\n";
	$js .= " * Do not touch this file! This file created by the Catch Popup plugin using PHP\n";
	$js .= " * Last modifiyed time: " . date( 'M d Y, h:s:i' ) . "\n";
	$js .= " */\n";
	$js .= strip_tags( catch_popup_generate_js() );

	if ( ! catch_popup_cache_file( $js_file, $js ) ) {
	 	update_option( 'catch-popup-has-cached-js', false );
	 } else {
		update_option( 'catch-popup-has-cached-js', strtotime( 'now' ) );
	}
}

add_action('wp_footer', 'catch_popup_cache_css');
add_action('wp_footer', 'catch_popup_cache_js');

function catch_popup_generate_js() {
	global $post;

	$args = array(
		'post_type' => CATCH_POPUP_SLUG
	);

	$popups = get_posts($args, OBJECT);

	$js = '';
	foreach( $popups as $popup ) {
		$post_id           = $popup->ID;
		$settings          = catch_popup_get_settings($post_id);

		$theme_id       = $settings['catch_popup_theme'];
		$theme_data     = catch_popup_get_theme( $theme_id );
		$theme_settings = catch_popup_get_theme_settings( $theme_id );
		$theme_name     = $theme_data[0]->post_name;

		$size           = $settings['catch_popup_size'];
		$auto_height    = $settings['catch_popup_auto_height'];
		$width_unit     = $settings['catch_popup_width_unit'];
		$width          = $settings['catch_popup_width'] . $width_unit;
		$height_unit    = $settings['catch_popup_height_unit'];
		$height         = $settings['catch_popup_height']. $height_unit;
		$min_width      = $settings['catch_popup_min_width'] . '%';
		$max_width      = $settings['catch_popup_max_width'] . '%';

		$style          = $settings['catch_popup_style'];
		$delay          = $settings['catch_popup_delay'];

		$overlay_close  = $settings['catch_popup_overlay_close'];
		$f4_close       = $settings['catch_popup_f4_close'];
		$esc_close      = $settings['catch_popup_esc_close'];

		$condt = true;

		if( isset( $settings['catch_popup_target_value'] ) && ( array() != ( $settings['catch_popup_target_value'] ) ) ){
			$popup->ID;

			$condt      = false;
			$i          = 0;
			$categories = catch_popup_category_array( $post->ID );
			$tags       = catch_popup_tag_array( $post->ID );

			foreach( $settings['catch_popup_target_value'] as $condition ) {
				if( 'home' == $condition && ( is_front_page() || ( is_home() && is_front_page() ) ) ) {
					$condt = true;
				}
				elseif( 'search' == $condition && is_search() ) {
					$condt = true;
				}
				elseif( '404' == $condition && is_404() ) {
					$condt = true;
				}
				elseif( 'all-post' == $condition && is_single() ) {
					$condt = true;
				}elseif( 'select-post' == $condition && is_single() && in_array( $post->ID, explode(',', $settings['catch_popup_target_text'][$i] ) ) ) {
					$condt = true;
				}
				elseif( 'all-page' == $condition && is_page() ) {
					$condt = true;
				}
				elseif( 'select-page' == $condition && is_page() && in_array( $post->ID, explode(',', $settings['catch_popup_target_text'][$i] ) ) ) {
					$condt = true;
				}
				elseif( 'category-post' == $condition && is_single() && array_intersect( $categories, $settings['catch_popup_target_text'][$i] ) ) {
					$condt = true;
				}
				elseif( 'tag-post' == $condition && is_single() && array_intersect( $tags, $settings['catch_popup_target_text'][$i] ) ) {
					$condt = true;
				}

				$i++;
			}
		}

		ob_start();
		?>
		<script>
		jQuery(function($){
			$(window).on('load', function(){
				var popup_counts = $('.catch-popup').length;
				$('.catch-popup-trigger').on('click', function(){
					var id = $(this).data('popup');
					$('#catch-popup-' + id).fadeIn('slow');
					$('#popup-<?php echo $post_id; ?>').css('opacity', '1');
					$('html').removeAttr('class');
					$('html').addClass('catch-popup-open catch-popup-open-overlay catch-popup-open-scrollable');
				});
				<?php if( 'auto' == $style && $condt === true ) : ?>
					if( $('#catch-popup-<?php echo $post_id; ?>').length > 0 ){
						setTimeout(function(){
							$('#catch-popup-<?php echo $post_id; ?>').fadeIn('slow');
							$('#popup-<?php echo $post_id; ?>').css('opacity', '1');
							$('html').removeAttr('class');
							$('html').addClass('catch-popup-open catch-popup-open-overlay catch-popup-open-scrollable');
							var close_html = $('#catch-popup-<?php echo $post_id; ?> .catch-popup-close').html();
							var counter = <?php echo $settings['catch_popup_button_delay']; ?>;
							counter = parseInt(counter/1000);
							if( counter != 0 ) {
								$('#catch-popup-<?php echo $post_id; ?> .catch-popup-close').removeClass('popup-close');
								$('#catch-popup-<?php echo $post_id; ?> .catch-popup-close').text(counter);

								var interval = setInterval(function() {
									if ( document.hidden ) { return; }
									console.log(counter);
								    counter--;
								    // Display 'counter' wherever you want to display it.
								    if(counter == 0) {
								     		clearInterval(interval);
								     		$('#catch-popup-<?php echo $post_id; ?> .catch-popup-close').addClass('popup-close');
								     		catch_popup_close(close_html);
								    }else{
								    	$('#catch-popup-<?php echo $post_id; ?> .catch-popup-close').text(counter);
								    }
								}, 1000);
							}else{
								catch_popup_close(close_html);
							}
						}, <?php echo $delay; ?>);
					}
				<?php else: ?>
						$('#catch-popup-<?php echo $post_id; ?> .catch-popup-close').removeClass('popup-close');
						var close_html = $('#catch-popup-<?php echo $post_id; ?> .catch-popup-close').html();
						var counter = <?php echo $settings['catch_popup_button_delay']; ?>;
						counter = parseInt(counter/1000);
						if( counter != 0 ) {
							$('#catch-popup-<?php echo $post_id; ?> .catch-popup-close').removeClass('popup-close');
							$('#catch-popup-<?php echo $post_id; ?> .catch-popup-close').text(counter);

							var interval = setInterval(function() {
								if ( document.hidden ) { return; }
							    counter--;
							    // Display 'counter' wherever you want to display it.
							    if(counter == 0) {
							     		clearInterval(interval);
							     		$('#catch-popup-<?php echo $post_id; ?> .catch-popup-close').addClass('popup-close');
							     		catch_popup_close(close_html);
							    }else{
							    	$('.catch-popup-close').text(counter);
							    }
							}, 1000);
						} else {
							catch_popup_close(close_html);
						}
				<?php endif; ?>

			});


			function catch_popup_close(close_html) {
				$('#catch-popup-<?php echo $post_id; ?> .catch-popup-close').html(close_html);
			 		$(document).keyup(function(e) {
						<?php if( 1 == $esc_close ): ?>
						    if ( 27 == e.which ) {
						    	$('#catch-popup-<?php echo $post_id; ?>').fadeOut('slow');
								$('.catch-popup-overlay').fadeOut('slow');
						    	$('html').removeAttr('class');
						    }
						<?php endif; ?>
						<?php if( 1 == $f4_close ): ?>
							<?php // f4   (fires when f4 is released) ?>
						    if ( 115 == e.which ) {
						    	$('#catch-popup-<?php echo $post_id; ?>').fadeOut('slow');
								$('.catch-popup-overlay').fadeOut('slow');
						    	$('html').removeAttr('class');
						    }
						<?php endif; ?>
					});

					<?php if( 1 == $overlay_close ): ?>
						$('#catch-popup-<?php echo $post_id; ?>.catch-popup-overlay').on('click', function(event){
							if( 'catch-popup-<?php echo $post_id; ?>' == event.target.id ){
								$(this).fadeOut("slow");
								$('html').removeAttr('class');
							}
						});
					<?php endif; ?>

					$('#catch-popup-<?php echo $post_id; ?> .catch-popup-close').on('click', function(){
						$(this).parents('#catch-popup-<?php echo $post_id; ?>').fadeOut("slow");
						$(this).parents('.catch-popup-overlay').fadeOut("slow");
						$('html').removeAttr('class');
					});
			}
		});
		</script>
		<?php
		$js .= ob_get_clean();
		//endif;
	} // Endforeach
	return $js;
}

/**
 * Generate CSS cache file.
 */
function catch_popup_cache_css() {
	$upload_dir = catch_popup_upload_dir('basedir');
	if (! is_dir($upload_dir)) {
       mkdir( $upload_dir, 0755 );
    }
	$filename = 'catch-popup-styles.css';

	$css_file = $upload_dir . '/' . $filename;

	$css = "/**\n";
	$css .= " * Do not touch this file! This file created by the Catch Popup plugin using PHP\n";
	$css .= " * Last modifiyed time: " . date( 'M d Y, h:s:i' ) . "\n";
	$css .= " */\n\n\n";
	$css .= catch_popup_generate_css();

	if ( ! catch_popup_cache_file( $css_file, $css ) ) {
	 	update_option( 'catch-popup-has-cached-css', false );
	 } else {
		update_option( 'catch-popup-has-cached-css', strtotime( 'now' ) );
	}
}

/**
 * Cache file contents.
 *
 * @param $file
 * @param $contents
 *
 * @return bool
 */
function catch_popup_cache_file( $file, $contents ) {
	if ( ! function_exists( 'WP_Filesystem' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
	}

	WP_Filesystem();

	/** @var WP_Filesystem_Base $wp_filesystem */
	global $wp_filesystem;

	return $wp_filesystem->put_contents( $file, $contents, defined( 'FS_CHMOD_FILE' ) ? FS_CHMOD_FILE : false );
}

/**
 * Reset the cache to force regeneration.
 */
function catch_popup_reset_cache() {
	update_option( 'catch-popup-has-cached-css', false );
	update_option( 'catch-popup-has-cached-js', false );
}

add_action('catch_popup_theme_save', 'catch_popup_reset_cache');
add_action('catch_popup_save', 'catch_popup_reset_cache');

/**
 * Generate Custom Styles
 *
 * @return string
 */
function catch_popup_generate_css() {
	// Include core styles so we can eliminate another stylesheet.
	$core_css = file_get_contents( CATCH_POPUP_PATH . 'css/style' . '.css' );

	/**
	 *  0 Core
	 *  1 Popup Themes
	 *  5 Extensions
	 * 15 Per Popup CSS
	 */
	$css = array(
		'core'    => array(
			'content'  => $core_css,
			'priority' => 0,
		),
		'themes'  => array(
			'content'  => catch_popup_generate_popup_theme_styles(),
			'priority' => 1,
		),
		'popups'  => array(
			'content'  => catch_popup_generate_popup_styles(),
			'priority' => 15,
		),
	);

	$css = apply_filters( 'generated_css', $css );

	foreach ( $css as $key => $code ) {
		$css[ $key ] = wp_parse_args( $code, array(
			'content'  => '',
			'priority' => 10,
		) );
	}

	$css_code = '';
	foreach ( $css as $key => $code ) {
		if ( ! empty( $code['content'] ) ) {
			$css_code .= $code['content'] . "\n\n";
		}
	}

	return $css_code;
}

/**
 * @return array
 */
function catch_popup_get_generated_styles($theme_id) {
	$styles = array(
		'overlay'   => array(),
		'container' => array(),
		'title'     => array(),
		'content'   => array(),
		'close'     => array()
	);

	$catch_popup_font_family = catch_popup_font_family();

	/*
	 * Overlay Styles
	 */
	if ( catch_popup_get_theme_setting( $theme_id, 'overlay_color' ) ) {
		$styles['overlay']['background-color'] = catch_popup_hex2rgba( catch_popup_get_theme_setting( $theme_id, 'overlay_color' ), catch_popup_get_theme_setting( $theme_id, 'overlay_opacity' ) );
	}

	/*
	 * Container Styles
	 */
	$styles['container'] = array(
		'padding'       => catch_popup_get_theme_setting( $theme_id, 'container_padding' ) . "px",
		'border-radius' => catch_popup_get_theme_setting( $theme_id, 'container_border_radius' ) . "px",
		'border'        => catch_popup_border_style( catch_popup_get_theme_setting( $theme_id, 'container_border_thickness' ), catch_popup_get_theme_setting( $theme_id, 'container_border_style' ), catch_popup_get_theme_setting( $theme_id, 'container_border_color' ) ),
		'box-shadow'    => catch_popup_box_shadow_style( catch_popup_get_theme_setting( $theme_id, 'container_dropshadow_horizontal_position' ), catch_popup_get_theme_setting( $theme_id, 'container_dropshadow_vertical_position' ), catch_popup_get_theme_setting( $theme_id, 'container_dropshadow_blur_radius' ), catch_popup_get_theme_setting( $theme_id, 'container_dropshadow_spread' ), catch_popup_get_theme_setting( $theme_id, 'container_dropshadow_color' ), catch_popup_get_theme_setting( $theme_id, 'container_dropshadow_opacity' ), catch_popup_get_theme_setting( $theme_id, 'container_dropshadow_inset' ) ),
	);

	if ( catch_popup_get_theme_setting( $theme_id, 'container_background_color' ) ) {
		$styles['container']['background-color'] = catch_popup_hex2rgba( catch_popup_get_theme_setting( $theme_id, 'container_background_color' ), catch_popup_get_theme_setting( $theme_id, 'container_background_opacity' ) );
	}

	/*
	 * Title Styles
	 */
	$styles['title'] = array(
		'color'       => catch_popup_get_theme_setting( $theme_id, 'title_font_color' ),
		'text-align'  => catch_popup_get_theme_setting( $theme_id, 'title_alignment' ),
		'text-shadow' => catch_popup_text_shadow_style( catch_popup_get_theme_setting( $theme_id, 'title_textshadow_horizontal_position' ), catch_popup_get_theme_setting( $theme_id, 'title_textshadow_vertical_position' ), catch_popup_get_theme_setting( $theme_id, 'title_textshadow_blur_radius' ), catch_popup_get_theme_setting( $theme_id, 'title_textshadow_color' ), catch_popup_get_theme_setting( $theme_id, 'title_textshadow_opacity' ) ),
		'font-weight' => catch_popup_get_theme_setting( $theme_id, 'title_font_weight' ),
		'font-size'   => catch_popup_get_theme_setting( $theme_id, 'title_font_size' ) . "px",
		'font-style'  => catch_popup_get_theme_setting( $theme_id, 'title_font_style' ),
		'line-height' => catch_popup_get_theme_setting( $theme_id, 'title_line_height' ) . "px",
	);

	if( isset( $catch_popup_font_family[catch_popup_get_theme_setting( $theme_id, 'title_font_family' )] ) ) {
		$styles['title']['font-family'] = $catch_popup_font_family[ catch_popup_get_theme_setting( $theme_id, 'title_font_family' ) ];
	}

	/*
	 * Content Styles
	 */
	$styles['content'] = array(
		'color'       => catch_popup_get_theme_setting( $theme_id, 'content_color' ),
		'font-weight' => catch_popup_get_theme_setting( $theme_id, 'content_font_weight' ),
		'font-style'  => catch_popup_get_theme_setting( $theme_id, 'content_font_style' ),
	);

	if( isset( $catch_popup_font_family[ catch_popup_get_theme_setting( $theme_id, 'content_font_family' ) ] ) ) {
		$styles['content']['font-family'] = $catch_popup_font_family[ catch_popup_get_theme_setting( $theme_id, 'content_font_family' ) ];
	}

	/*
	 * Close Styles
	 */
	$styles['close'] = array(
		'position'      => catch_popup_get_theme_setting( $theme_id, 'close_button_position_outside_container' ) ? 'fixed' : 'absolute',
		'height'        => ! catch_popup_get_theme_setting( $theme_id, 'close_button_height' ) || catch_popup_get_theme_setting( $theme_id, 'close_button_height' ) <= 0 ? 'auto' : catch_popup_get_theme_setting($theme_id, 'close_button_height') . "px",
		'width'         => ! catch_popup_get_theme_setting( $theme_id, 'close_button_width' ) || catch_popup_get_theme_setting( $theme_id, 'close_button_width' ) <= 0 ? 'auto' : catch_popup_get_theme_setting($theme_id, 'close_button_width') . "px",
		'left'          => 'auto',
		'right'         => 'auto',
		'bottom'        => 'auto',
		'top'           => 'auto',
		'padding'       => catch_popup_get_theme_setting($theme_id, 'close_button_padding') . "px",
		'color'         => catch_popup_get_theme_setting( $theme_id, 'close_button_font_color' ),
		'font-family'   => isset( $catch_popup_font_family[ catch_popup_get_theme_setting( $theme_id, 'close_button_font_family' ) ] ),
		'font-weight'   => catch_popup_get_theme_setting( $theme_id, 'close_button_font_weight' ),
		'font-size'     => catch_popup_get_theme_setting($theme_id, 'close_button_font_size') . "px",
		'font-style'    => catch_popup_get_theme_setting( $theme_id, 'close_button_font_style' ),
		'line-height'   => catch_popup_get_theme_setting($theme_id, 'close_button_line_height') . "px",
		'border'        => catch_popup_border_style( catch_popup_get_theme_setting( $theme_id, 'close_button_border_thickness' ), catch_popup_get_theme_setting( $theme_id, 'close_button_border_style' ), catch_popup_get_theme_setting( $theme_id, 'close_button_border_color' ) ),
		'border-radius' => catch_popup_get_theme_setting($theme_id, 'close_button_border_radius') . "px",
		'box-shadow'    => catch_popup_box_shadow_style( catch_popup_get_theme_setting( $theme_id, 'close_button_dropshadow_horizontal_position' ), catch_popup_get_theme_setting( $theme_id, 'close_button_dropshadow_vertical_position' ), catch_popup_get_theme_setting( $theme_id, 'close_button_dropshadow_blur_radius' ), catch_popup_get_theme_setting( $theme_id, 'close_button_dropshadow_spread' ), catch_popup_get_theme_setting( $theme_id, 'close_button_dropshadow_color' ), catch_popup_get_theme_setting( $theme_id, 'close_button_dropshadow_opacity' ), catch_popup_get_theme_setting( $theme_id, 'close_button_dropshadow_inset' ) ),
		'text-shadow'   => catch_popup_text_shadow_style( catch_popup_get_theme_setting( $theme_id, 'close_button_dropshadow_horizontal_position' ), catch_popup_get_theme_setting( $theme_id, 'close_button_dropshadow_vertical_position' ), catch_popup_get_theme_setting( $theme_id, 'close_button_dropshadow_blur_radius' ), catch_popup_get_theme_setting( $theme_id, 'close_button_textshadow_color' ), catch_popup_get_theme_setting( $theme_id, 'close_button_textshadow_opacity' ) ),
	);

	if( isset( $catch_popup_font_family[ catch_popup_get_theme_setting( $theme_id, 'close_button_font_family' ) ] ) ) {
		$styles['close']['font-family'] = $catch_popup_font_family[ catch_popup_get_theme_setting( $theme_id, 'close_button_font_family' ) ];
	}

	if ( catch_popup_get_theme_setting( $theme_id, 'close_button_background_color' ) ) {
		$styles['close']['background-color'] = catch_popup_hex2rgba( catch_popup_get_theme_setting( $theme_id, 'close_button_background_color' ), catch_popup_get_theme_setting( $theme_id, 'close_button_opacity' ) );
	}

	$top    = catch_popup_get_theme_setting($theme_id, 'close_button_top') . "px";
	$left   = catch_popup_get_theme_setting($theme_id, 'close_button_left') . "px";
	$right  = catch_popup_get_theme_setting($theme_id, 'close_button_right') . "px";
	$bottom = catch_popup_get_theme_setting($theme_id, 'close_button_bottom') . "px";

	switch ( catch_popup_get_theme_setting( $theme_id, 'close_button_location' ) ) {
		case "topleft":
			$styles['close']['top']  = $top;
			$styles['close']['left'] = $left;
			break;
		case "topcenter":
			$styles['close']['top']       = $top;
			$styles['close']['left']      = "50%";
			$styles['close']['transform'] = "translateX(-50%)";
			break;
		case "topright":
			$styles['close']['top']   = $top;
			$styles['close']['right'] = $right;
			break;
		case 'middleleft':
			$styles['close']['top']       = "50%";
			$styles['close']['left']      = $left;
			$styles['close']['transform'] = "translate(0, -50%)";
			break;
		case 'middleright':
			$styles['close']['top']       = "50%";
			$styles['close']['right']     = $right;
			$styles['close']['transform'] = "translate(0, -50%)";
			break;
		case "bottomleft":
			$styles['close']['bottom'] = $bottom;
			$styles['close']['left']   = $left;
			break;
		case "bottomcenter":
			$styles['close']['bottom']    = $bottom;
			$styles['close']['left']      = "50%";
			$styles['close']['transform'] = "translateX(-50%)";
			break;
		case "bottomright":
			$styles['close']['bottom'] = $bottom;
			$styles['close']['right']  = $right;
			break;
	}

	return (array) apply_filters( 'theme_get_generated_styles', (array) $styles, $theme_id );
}

function catch_popup_font_options(){
	$themes       = catch_popup_get_all_themes();
	$font_options = array();

	foreach ( $themes as $theme ) {
		$font_options[] = catch_popup_get_theme_setting( $theme->ID, 'title_font_family' );
		$font_options[] = catch_popup_get_theme_setting( $theme->ID, 'content_font_family' );
		$font_options[] = catch_popup_get_theme_setting( $theme->ID, 'close_button_font_family' );
		/*echo '<pre>';
		print_r($font_options);
		echo '</pre>'; */
		//die();
	}
	return $font_options;
}

function catch_popup_generate_popup_theme_styles() {
	$styles = '';

	$themes = catch_popup_get_all_themes();

	foreach ( $themes as $theme ) {

		$theme_styles = catch_popup_get_rendered_theme_styles( $theme->ID );

		if ( $theme_styles != '' ) {
			$styles .= "/* Popup Theme " . $theme->ID . ": " . $theme->post_title . " */\r\n";
			$styles .= $theme_styles . "\r\n";
		}
	}

	$styles = apply_filters( 'catch_popup_theme_styles', $styles );

	$styles = apply_filters( 'generate_popup_theme_styles', $styles );

	return $styles;
}

/**
 * @param $theme_id
 *
 * @return string
 */
function catch_popup_get_rendered_theme_styles( $theme_id ) {
	$styles = '';

	$theme = catch_popup_get_theme( $theme_id );

	$slug = $theme[0]->post_name;

	$theme_styles = catch_popup_get_generated_styles($theme_id);

	if ( empty( $theme_styles ) ) {
		return $styles;
	}

	foreach ( $theme_styles as $element => $element_rules ) {
		switch ( $element ) {

			case 'overlay':
				$css_selector = ".catch-popup-theme-{$theme_id}.catch-popup-overlay";
				if ( $slug ) {
					$css_selector .= ", .catch-popup-theme-{$slug}.catch-popup-overlay";
				}
				break;

			case 'container':
				$css_selector = ".catch-popup-theme-{$theme_id} .catch-popup-container";
				if ( $slug ) {
					$css_selector .= ", .catch-popup-theme-{$slug} .catch-popup-container";
				}
				break;

			case 'close':
				$css_selector = ".catch-popup-theme-{$theme_id} .catch-popup-close";
				$admin_bar_selector = "body.admin-bar .catch-popup-theme-{$theme_id} .catch-popup-close";
				if ( $slug ) {
					$css_selector .= ", .catch-popup-theme-{$slug} .catch-popup-close";
					$admin_bar_selector .= ", body.admin-bar .catch-popup-theme-{$slug} .catch-popup-close";
				}
				break;

			default:
				$css_selector = ".catch-popup-theme-{$theme_id} .catch-popup-{$element}";
				if ( $slug ) {
					$css_selector .= ", .catch-popup-theme-{$slug} .catch-popup-{$element}";
				}
				break;

		}

		$rule_set = $sep = '';
		foreach ( $element_rules as $property => $value ) {
			if ( ! empty( $value ) ) {
				$rule_set .= $sep . $property . ': ' . $value;
				$sep      = '; ';
			}
		}

		$styles .= "$css_selector { $rule_set } \r\n";

		if ( $element === 'close' && ! empty( $admin_bar_selector ) && catch_popup_get_theme_setting( $theme_id, 'close_position_outside' ) && strpos( catch_popup_get_theme_setting( $theme_id, 'close_location' ), 'top' ) !== false ) {
			$top = ! empty( $element_rules['top'] ) ? (int) str_replace( 'px', '', $element_rules['top'] ) : 0;
			// Move it down to compensate for admin bar height.
			$top += 32;
			$styles .= "$admin_bar_selector { top: {$top}px }";
		}

	}

	return $styles;
}

function catch_popup_generate_popup_styles(){
	$styles = '';

	$popups = catch_popup_get_all_popups();

	foreach ( $popups as $popup ) {

		$popup_styles = catch_popup_get_rendered_popup_styles( $popup->ID );

		if ( $popup_styles != '' ) {
			$styles .= "/* Popup Styles " . $popup->ID . ": " . $popup->post_title . " */\r\n";
			$styles .= $popup_styles . "\r\n";
		}
	}

	$styles = apply_filters( 'catch_popup_styles', $styles );

	$styles = apply_filters( 'generate_popup_styles', $styles );

	return $styles;
}

function catch_popup_get_rendered_popup_styles( $popup_id ) {

	$styles = array();

	$popup_style = '';

	$top    = catch_popup_get_setting( $popup_id, 'catch_popup_top' ) . "px";
	$left   = catch_popup_get_setting( $popup_id, 'catch_popup_left' ) . "px";
	$right  = catch_popup_get_setting( $popup_id, 'catch_popup_right' ) . "px";
	$bottom = catch_popup_get_setting( $popup_id, 'catch_popup_bottom' ) . "px";

	switch ( catch_popup_get_setting( $popup_id, 'catch_popup_location' ) ) {
		case "topleft":
			$styles['container']['top']  = $top;
			$styles['container']['left'] = $left;
			break;
		case "topcenter":
			$styles['container']['top']       = $top;
			$styles['container']['left']      = "50%";
			$styles['container']['transform'] = "translateX(-50%)";
			break;
		case "topright":
			$styles['container']['top']   = $top;
			$styles['container']['right'] = $right;
			break;
		case 'middleleft':
			$styles['container']['top']       = "50%";
			$styles['container']['left']      = $left;
			$styles['container']['transform'] = "translate(0, -50%)";
			break;
		case 'middlecenter':
			$styles['container']['position']  = "relative";
			break;
		case 'middleright':
			$styles['container']['top']       = "50%";
			$styles['container']['right']     = $right;
			$styles['container']['transform'] = "translate(0, -50%)";
			break;
		case "bottomleft":
			$styles['container']['bottom'] = $bottom;
			$styles['container']['left']   = $left;
			break;
		case "bottomcenter":
			$styles['container']['bottom']    = $bottom;
			$styles['container']['left']      = "50%";
			$styles['container']['transform'] = "translateX(-50%)";
			break;
		case "bottomright":
			$styles['container']['bottom'] = $bottom;
			$styles['container']['right']  = $right;
			break;
	}

	$size            = catch_popup_get_setting( $popup_id, 'catch_popup_size' );
	$auto_height     = catch_popup_get_setting( $popup_id, 'catch_popup_auto_height' );
	$width_unit      = catch_popup_get_setting( $popup_id, 'catch_popup_width_unit' );
	$width           = catch_popup_get_setting( $popup_id, 'catch_popup_width' ) . $width_unit;
	$height_unit     = catch_popup_get_setting( $popup_id, 'catch_popup_height_unit' );
	$height          = catch_popup_get_setting( $popup_id, 'catch_popup_height' ) . $height_unit;
	$min_width       = catch_popup_get_setting( $popup_id, 'catch_popup_min_width' ) . '%';
	$max_width       = catch_popup_get_setting( $popup_id, 'catch_popup_max_width' ) . '%';
	$animation_type  = catch_popup_get_setting( $popup_id, 'catch_popup_animation_type' );
	$animation_speed = catch_popup_get_setting( $popup_id, 'catch_popup_animation_speed' );

	if( 'custom' == $size ){
		$styles['container']['width'] = $width;
	}

	if( 'auto' == $size ) {
		$styles['container']['max-width'] = $max_width;
		$styles['container']['min-width'] = $min_width;
	}

	if( 1 != $auto_height && 'auto' != $size ) {
		$styles['container']['height'] = $height;
	}

	$zindex = catch_popup_get_setting( $popup_id, 'catch_popup_zindex' );

	if( $zindex ) {
		$styles['overlay']['z-index'] = $zindex;
	}

	foreach ( $styles as $element => $element_rules ) {
		switch ( $element ) {

			case 'overlay':
				$css_selector = "#catch-popup-{$popup_id}";
				break;

			case 'container':
				$css_selector = "#popup-{$popup_id}";
				break;

			case 'close':
				$css_selector = ".catch-popup-theme-{$theme_id} .catch-popup-close";
				$admin_bar_selector = "body.admin-bar .catch-popup-theme-{$theme_id} .catch-popup-close";
				if ( $slug ) {
					$css_selector .= ", .catch-popup-theme-{$slug} .catch-popup-close";
					$admin_bar_selector .= ", body.admin-bar .catch-popup-theme-{$slug} .catch-popup-close";
				}
				break;

			default:
				$css_selector = ".catch-popup-theme-{$theme_id} .catch-popup-{$element}";
				if ( $slug ) {
					$css_selector .= ", .catch-popup-theme-{$slug} .catch-popup-{$element}";
				}
				break;

		}

		$rule_set = $sep = '';

		foreach ( $element_rules as $property => $value ) {
			if ( ! empty( $value ) ) {
				$rule_set .= $sep . $property . ': ' . $value;
				$sep      = '; ';
			}
		}

		$popup_style .= "$css_selector { $rule_set } \r\n";

	}

	return $popup_style;
}


function catch_popup_hex2rgb( $hex = '#ffffff', $return_type = 'rgb' ) {
	if ( is_array( $hex ) ) {
		$hex = implode( '', $hex );
	}
	$hex = str_replace( "#", "", $hex );

	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}

	$rgb = array( $r, $g, $b );

	if ( $return_type === 'array' ) {
		return $rgb; // returns an array with the rgb values
	}

	return 'rgb(' . implode( ",", $rgb ) . ')'; // returns the rgb values separated by commas
}

/**
 * @param string $hex
 * @param int    $opacity
 *
 * @return string
 */
function catch_popup_hex2rgba( $hex = '#ffffff', $opacity = 100 ) {
	$rgb     = catch_popup_hex2rgb( $hex, 'array' );
	$opacity = number_format( intval( $opacity ) / 100, 2 );

	return 'rgba( ' . implode( ', ', $rgb ) . ', ' . $opacity . ' )';
}

/**
 * @param int    $thickness
 * @param string $style
 * @param string $color
 *
 * @return string
 */
function catch_popup_border_style( $thickness = 1, $style = 'solid', $color = '#cccccc' ) {
	return "{$thickness}px {$style} {$color}";
}

/**
 * @param int    $horizontal
 * @param int    $vertical
 * @param int    $blur
 * @param int    $spread
 * @param string $hex
 * @param int    $opacity
 * @param string $inset
 *
 * @return string
 */
function catch_popup_box_shadow_style( $horizontal = 0, $vertical = 0, $blur = 0, $spread = 0, $hex = '#000000', $opacity = 50, $inset = 'no' ) {
	return "{$horizontal}px {$vertical}px {$blur}px {$spread}px " . catch_popup_hex2rgba( $hex, $opacity ) . ( $inset == 'yes' ? ' inset' : '' );
}

/**
 * @param int    $horizontal
 * @param int    $vertical
 * @param int    $blur
 * @param string $hex
 * @param int    $opacity
 *
 * @return string
 */
function catch_popup_text_shadow_style( $horizontal = 0, $vertical = 0, $blur = 0, $hex = '#000000', $opacity = 50 ) {
	return "{$horizontal}px {$vertical}px {$blur}px " . catch_popup_hex2rgba( $hex, $opacity );
}