<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function catch_popup_theme_add() {
	add_meta_box(
		'catch-popup-theme-meta', // Metabox ID
		'Popup Theme Settings',
		'catch_popup_theme_show',
		CATCH_POPUP_THEME_SLUG, // post_type
		'advanced',
		'high'
	);
}

function catch_popup_theme_show() {
	global $post;
	$settings = catch_popup_get_theme_settings( $post->ID );

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'catch_popup_theme_meta_box_nonce' );

	?>
	<div class="catch-popup-container">
		<div class="vtab">
			<h2 class="nav-tab-wrapper">
				<a class="nav-tab vnav-tab nav-tab-active" id="catch-popup-overlay-tab" href="#catch_popup_overlay"><?php esc_html_e( 'Overlay', 'catch-popup' ); ?></a>
				<a class="nav-tab vnav-tab" id="catch-popup-container-tab" href="#catch_popup_container"><?php esc_html_e( 'Container', 'catch-popup' ); ?></a>
				<a class="nav-tab vnav-tab" id="catch-popup-title-tab" href="#catch_popup_title"><?php esc_html_e( 'Title', 'catch-popup' ); ?></a>
				<a class="nav-tab vnav-tab" id="catch-popup-content-tab" href="#catch_popup_content"><?php esc_html_e( 'Content', 'catch-popup' ); ?></a>
				<a class="nav-tab vnav-tab" id="catch-popup-close-tab" href="#catch_popup_close"><?php esc_html_e( 'Close', 'catch-popup' ); ?></a>
			</h2>
		</div>
		<div class="vtabcontent">
			<div id="catch_popup_overlay" class="verticaltab wpcatchtab nosave active">
				<p>
					<label><?php esc_html_e( 'Color', 'catch-popup' ); ?></label>
					<input type="text" class="colorpicker" name="popup_theme[overlay_color]" value="<?php esc_attr_e( $settings['overlay_color'] ); ?>" />
				</p>
				<p>
					<label><?php esc_html_e( 'Opacity', 'catch-popup' ); ?></label>
					<input type="range" name="popup_theme[overlay_opacity]" min="0" max="100" value="<?php esc_attr_e( $settings['overlay_opacity'] ); ?>">
					<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['overlay_opacity'] ); ?>">
				</p>
			</div><!-- .dashboard -->
			<div id="catch_popup_container" class="verticaltab wpcatchtab save">
				<div class="htab">
					<h2 class="nav-tab-wrapper">
						<a class="nav-tab hnav-tab nav-tab-active" id="catch-popup-container-tab" href="#catch-popup-container"><?php esc_html_e( 'Container', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-background-tab" href="#catch-popup-background"><?php esc_html_e( 'Background', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-border-tab" href="#catch-popup-border"><?php esc_html_e( 'Border', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-dropshadow-tab" href="#catch-popup-dropshadow"><?php esc_html_e( 'Dropshadow', 'catch-popup' ); ?></a>
					</h2>
				</div>
				<div class="htabcontent">
					<div id="catch-popup-container" class="horizontaltab wpcatchtab nosave active">
						<p>
							<label><?php esc_html_e( 'Padding', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[container_padding]" value="<?php esc_attr_e( $settings['container_padding'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['container_padding'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Border Radius', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="80" name="popup_theme[container_border_radius]" value="<?php esc_attr_e( $settings['container_border_radius'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="80" step="1" value="<?php esc_attr_e( $settings['container_border_radius'] ); ?>">
						</p>
					</div>
					<div id="catch-popup-background" class="horizontaltab wpcatchtab nosave">
						<p>
							<label><?php esc_html_e( 'Color', 'catch-popup' ); ?></label>
							<input type="text" class="colorpicker" name="popup_theme[container_background_color]" value="<?php esc_attr_e( $settings['container_background_color'] ); ?>"/>
						</p>
						<p>
							<label><?php esc_html_e( 'Opacity', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[container_background_opacity]" value="<?php esc_attr_e( $settings['container_background_opacity'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['container_background_opacity'] ); ?>">
						</p>
					</div>
					<div id="catch-popup-border" class="horizontaltab wpcatchtab nosave">
						<p>
							<label><?php esc_html_e( 'Style', 'catch-popup' ); ?></label>
							<select name="popup_theme[container_border_style]">
								<?php
									$border_styles = catch_popup_border_styles();
								foreach ( $border_styles as $key => $value ) {
									echo '<option value="' . esc_html__( $key ) . '"' . selected( $key, esc_html( $settings['container_border_style'] ), false ) . '>' . esc_html( $value ) . '</option>';
								}
								?>
							</select>
						</p>
						<p>
							<label><?php esc_html_e( 'Color', 'catch-popup' ); ?></label>
							<input type="text" class="colorpicker" name="popup_theme[container_border_color]" value="<?php esc_attr_e( $settings['container_border_color'] ); ?>"/>
						</p>
						<p>
							<label><?php esc_html_e( 'Thickness', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="15" name="popup_theme[container_border_thickness]" value="<?php esc_attr_e( $settings['container_border_thickness'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="15" step="1" value="<?php esc_attr_e( $settings['container_border_thickness'] ); ?>">
						</p>
					</div>
					<div id="catch-popup-dropshadow" class="horizontaltab wpcatchtab nosave">
						<p>
							<label><?php esc_html_e( 'Color', 'catch-popup' ); ?></label>
							<input type="text" class="colorpicker" name="popup_theme[container_dropshadow_color]" value="<?php esc_attr_e( $settings['container_dropshadow_color'] ); ?>"/>
						</p>
						<p>
							<label><?php esc_html_e( 'Opacity', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[container_dropshadow_opacity]" value="<?php esc_attr_e( $settings['container_dropshadow_opacity'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['container_dropshadow_opacity'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Horizontal Position', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="50" name="popup_theme[container_dropshadow_horizontal_position]" value="<?php esc_attr_e( $settings['container_dropshadow_horizontal_position'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="50" step="1" value="<?php esc_attr_e( $settings['container_dropshadow_horizontal_position'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Vertical Position', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="50" name="popup_theme[container_dropshadow_vertical_position]" value="<?php esc_attr_e( $settings['container_dropshadow_vertical_position'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="50" step="1" value="<?php esc_attr_e( $settings['container_dropshadow_vertical_position'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Blur Radius', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="50" name="popup_theme[container_dropshadow_blur_radius]" value="<?php esc_attr_e( $settings['container_dropshadow_blur_radius'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="50" step="1" value="<?php esc_attr_e( $settings['container_dropshadow_blur_radius'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Spread', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[container_dropshadow_spread]" value="<?php esc_attr_e( $settings['container_dropshadow_spread'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['container_dropshadow_spread'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Inset', 'catch-popup' ); ?></label>
							<select name="popup_theme[container_dropshadow_inset]">
								<?php
									$inset = catch_popup_inset();
								foreach ( $inset as $key => $value ) {
									echo '<option value="' . esc_attr__( $key ) . '"' . selected( $key, esc_html__( $settings['container_dropshadow_inset'] ), false ) . '>' . esc_html__( $value ) . '</option>';
								}
								?>
							</select>
						</p>
					</div>
				</div>
			</div>

			<div id="catch_popup_title" class="verticaltab wpcatchtab save">
				<div class="htab">
					<h2 class="nav-tab-wrapper">
						<a class="nav-tab hnav-tab nav-tab-active" id="catch-popup-title-font-tab" href="#catch-popup-title-font"><?php esc_html_e( 'Font', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-title-text-shadow-tab" href="#catch-popup-title-text-shadow"><?php esc_html_e( 'Text Shadow', 'catch-popup' ); ?></a>
					</h2>
				</div>
				<div class="htabcontent">
					<div id="catch-popup-title-font" class="horizontaltab wpcatchtab nosave active">
						<p>
							<label><?php esc_html_e( 'Font Color', 'catch-popup' ); ?></label>
							<input type="text" class="colorpicker" name="popup_theme[title_font_color]" value="<?php esc_attr_e( $settings['title_font_color'] ); ?>"/>
						</p>
						<p>
							<label><?php esc_html_e( 'Font Size', 'catch-popup' ); ?></label>
							<input type="range" min="18" max="72" name="popup_theme[title_font_size]" value="<?php esc_attr_e( $settings['title_font_size'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="18" max="72" step="1" value="<?php esc_attr_e( $settings['title_font_size'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Line Height', 'catch-popup' ); ?></label>
							<input type="range" min="30" max="96" name="popup_theme[title_line_height]" value="<?php esc_attr_e( $settings['title_line_height'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="30" max="96" step="1" value="<?php esc_attr_e( $settings['title_line_height'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Font Family', 'catch-popup' ); ?></label>
							<select name="popup_theme[title_font_family]">
								<option value=""><?php esc_html_e( 'Use theme fonts', 'catch-popup' ); ?></option>
								<?php
									$font_family = catch_popup_font_family();
								foreach ( $font_family as $key => $value ) {
									echo '<option value="' . esc_attr__( $key ) . '"' . selected( $key, esc_html__( $settings['title_font_family'] ), false ) . ' style="font-family: ' . esc_attr__( $value ) . '">' . esc_html__( $value ) . '</option>';
								}
								?>
							</select>
						</p>
						<p>
							<label><?php esc_html_e( 'Font Weight', 'catch-popup' ); ?></label>
							<select name="popup_theme[title_font_weight]">
								<?php
									$font_weight = catch_popup_font_weight();
								foreach ( $font_weight as $key => $value ) {
									echo '<option value="' . esc_attr( $key ) . '"' . selected( $key, esc_html__( $settings['title_font_weight'] ), false ) . '>' . esc_html__( $value ) . '</option>';
								}
								?>
							</select>
						</p>
						<p>
							<label><?php esc_html_e( 'Style', 'catch-popup' ); ?></label>
							<select name="popup_theme[title_font_style]">
								<?php
									$font_style = catch_popup_font_style();
								foreach ( $font_style as $key => $value ) {
									echo '<option value="' . esc_attr__( $key ) . '"' . selected( $key, esc_html__( $settings['title_font_style'] ), false ) . '>' . esc_html__( $value ) . '</option>';
								}
								?>
							</select>
						</p>
						<p>
							<label><?php esc_html_e( 'Alignment', 'catch-popup' ); ?></label>
							<select name="popup_theme[title_alignment]">
								<?php
									$alignment = catch_popup_alignment();
								foreach ( $alignment as $key => $value ) {
									echo '<option value="' . esc_attr__( $key ) . '"' . selected( $key, esc_html__( $settings['title_alignment'] ), false ) . '>' . esc_html__( $value ) . '</option>';
								}
								?>
							</select>
						</p>
					</div>
					<div id="catch-popup-title-text-shadow" class="horizontaltab wpcatchtab nosave">
						<p>
							<label><?php esc_html_e( 'Color', 'catch-popup' ); ?></label>
							<input type="text" class="colorpicker" name="popup_theme[title_textshadow_color]" value="<?php esc_attr_e( $settings['title_textshadow_color'] ); ?>"/>
						</p>
						<p>
							<label><?php esc_html_e( 'Opacity', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[title_textshadow_opacity]" value="<?php esc_attr_e( $settings['title_textshadow_opacity'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['title_textshadow_opacity'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Horizontal Position', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[title_textshadow_horizontal_position]" value="<?php esc_attr_e( $settings['title_textshadow_horizontal_position'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['title_textshadow_horizontal_position'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Vertical Position', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[title_textshadow_vertical_position]" value="<?php esc_attr_e( $settings['title_textshadow_vertical_position'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['title_textshadow_vertical_position'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Blur Radius', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="28" name="popup_theme[title_textshadow_blur_radius]" value="<?php esc_attr_e( $settings['title_textshadow_blur_radius'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="28" step="1" value="<?php esc_attr_e( $settings['title_textshadow_blur_radius'] ); ?>">
						</p>
					</div>
				</div>
			</div>
			<div id="catch_popup_content" class="verticaltab wpcatchtab save">
				<p>
					<label><?php esc_html_e( 'Color', 'catch-popup' ); ?></label>
					<input type="text" class="colorpicker" name="popup_theme[content_color]" value="<?php esc_attr_e( $settings['content_color'] ); ?>"/>
				</p>
				<p>
					<label><?php esc_html_e( 'Font Family', 'catch-popup' ); ?></label>
					<select name="popup_theme[content_font_family]">
						<option value="theme_default"><?php esc_html_e( 'Use theme fonts', 'catch-popup' ); ?></option>
						<?php
							$font_family = catch_popup_font_family();
						foreach ( $font_family as $key => $value ) {
							echo '<option value="' . esc_attr__( $key ) . '"' . selected( $key, esc_html__( $settings['content_font_family'] ), false ) . ' style="font-family: ' . esc_attr__( $value ) . '">' . esc_html( $value ) . '</option>';
						}
						?>
					</select>
				</p>
			</div>
			<div id="catch_popup_close" class="verticaltab wpcatchtab save">
				<div class="htab">
					<h2 class="nav-tab-wrapper">
						<a class="nav-tab hnav-tab nav-tab-active" id="catch-popup-close-general-tab" href="#catch-popup-close-general"><?php esc_html_e( 'General', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-close-size-tab" href="#catch-popup-close-size"><?php esc_html_e( 'Size', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-close-background-tab" href="#catch-popup-close-background"><?php esc_html_e( 'Background', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-close-font-tab" href="#catch-popup-close-font"><?php esc_html_e( 'Font', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-close-border-tab" href="#catch-popup-close-border"><?php esc_html_e( 'Border', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-close-dropshadow-tab" href="#catch-popup-close-dropshadow"><?php esc_html_e( 'Dropshadow', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-close-textshadow-tab" href="#catch-popup-close-textshadow"><?php esc_html_e( 'Textshadow', 'catch-popup' ); ?></a>
					</h2>
				</div>
				<div class="htabcontent">
					<div id="catch-popup-close-general" class="horizontaltab wpcatchtab nosave active">
						<p>
							<label><?php esc_html_e( 'Button Text', 'catch-popup' ); ?></label>
							<input type="text" name="popup_theme[close_button_text]" value="<?php esc_attr_e( $settings['close_button_text'] ); ?>"/>
						</p>
						<p>
							<label><?php esc_html_e( 'Position Outside Container', 'catch-popup' ); ?></label>
							<input type="checkbox" value="1" name="popup_theme[close_button_position_outside_container]" <?php echo checked( isset( $settings['close_button_position_outside_container'] ) ? esc_html__( $settings['close_button_position_outside_container'] ) : '', true, false ); ?> />
						</p>
						<p>
							<label><?php esc_html_e( 'Location', 'catch-popup' ); ?></label>
							<select name="popup_theme[close_button_location]">
								<?php
									$location = catch_popup_close_location();
								foreach ( $location as $key => $value ) {
									echo '<option value="' . esc_attr__( $key ) . '"' . selected( $key, esc_html__( $settings['close_button_location'] ), false ) . '>' . esc_html__( $value ) . '</option>';
								}
								?>
							</select>
						</p>
						<p
						<?php
						if ( ! preg_match( '/top/i', $settings['close_button_location'] ) ) {
							echo 'style="display: none;"'; }
						?>
						 >
							<label><?php esc_html_e( 'Top', 'catch-popup' ); ?></label>
							<input type="range" min="-100" max="100" name="popup_theme[close_button_top]" value="<?php esc_attr_e( $settings['close_button_top'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="-100" max="100" step="1" value="<?php esc_attr_e( $settings['close_button_top'] ); ?>">
						</p>
						<p
						<?php
						if ( ! preg_match( '/right/i', $settings['close_button_location'] ) ) {
							echo 'style="display: none;"'; }
						?>
						 >
							<label><?php esc_html_e( 'Right', 'catch-popup' ); ?></label>
							<input type="range" min="-100" max="100" name="popup_theme[close_button_right]" value="<?php esc_attr_e( $settings['close_button_right'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="-100" max="100" step="1" value="<?php esc_attr_e( $settings['close_button_right'] ); ?>">
						</p>
						<p
						<?php
						if ( ! preg_match( '/bottom/i', $settings['close_button_location'] ) ) {
							echo 'style="display: none;"'; }
						?>
						 >
							<label><?php esc_html_e( 'Bottom', 'catch-popup' ); ?></label>
							<input type="range" min="-100" max="100" name="popup_theme[close_button_bottom]" value="<?php esc_attr_e( $settings['close_button_bottom'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="-100" max="100" step="1" value="<?php esc_attr_e( $settings['close_button_bottom'] ); ?>">
						</p>
						<p
						<?php
						if ( ! preg_match( '/left/i', $settings['close_button_location'] ) ) {
							echo 'style="display: none;"'; }
						?>
						 >
							<label><?php esc_html_e( 'Left', 'catch-popup' ); ?></label>
							<input type="range" min="-100" max="100" name="popup_theme[close_button_left]" value="<?php esc_attr_e( $settings['close_button_left'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="-100" max="100" step="1" value="<?php esc_attr_e( $settings['close_button_left'] ); ?>">
						</p>
					</div>
					<div id="catch-popup-close-size" class="horizontaltab wpcatchtab nosave">
						<p>
							<label><?php esc_html_e( 'Padding', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[close_button_padding]" value="<?php esc_attr_e( $settings['close_button_padding'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['close_button_padding'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Height', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[close_button_height]" value="<?php esc_attr_e( $settings['close_button_height'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['close_button_height'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Width', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[close_button_width]" value="<?php esc_attr_e( $settings['close_button_width'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['close_button_width'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Border Radius', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="28" name="popup_theme[close_button_border_radius]" value="<?php esc_attr_e( $settings['close_button_border_radius'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="1" max="28" step="1" value="<?php esc_attr_e( $settings['close_button_border_radius'] ); ?>">
						</p>
					</div>
					<div id="catch-popup-close-background" class="horizontaltab wpcatchtab nosave">
						<p>
							<label><?php esc_html_e( 'Color', 'catch-popup' ); ?></label>
							<input type="text" class="colorpicker" name="popup_theme[close_button_background_color]" value="<?php esc_attr_e( $settings['close_button_background_color'] ); ?>"/>
						</p>
						<p>
							<label><?php esc_html_e( 'Opacity', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[close_button_opacity]" value="<?php esc_attr_e( $settings['close_button_opacity'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['close_button_opacity'] ); ?>">
						</p>
					</div>
					<div id="catch-popup-close-font" class="horizontaltab wpcatchtab nosave">
						<p>
							<label><?php esc_html_e( 'Color', 'catch-popup' ); ?></label>
							<input type="text" class="colorpicker" name="popup_theme[close_button_font_color]" value="<?php esc_attr_e( $settings['close_button_font_color'] ); ?>"/>
						</p>
						<p>
							<label><?php esc_html_e( 'Font Size', 'catch-popup' ); ?></label>
							<input type="range" min="18" max="72" name="popup_theme[close_button_font_size]" value="<?php esc_attr_e( $settings['close_button_font_size'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="18" max="72" step="1" value="<?php esc_attr_e( $settings['close_button_font_size'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Line Height', 'catch-popup' ); ?></label>
							<input type="range" min="12" max="72" name="popup_theme[close_button_line_height]" value="<?php esc_attr_e( $settings['close_button_line_height'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="12" max="72" step="1" value="<?php esc_attr_e( $settings['close_button_line_height'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Font Family', 'catch-popup' ); ?></label>
							<select name="popup_theme[close_button_font_family]">
								<option value="theme_default"><?php esc_html_e( 'Use theme fonts', 'catch-popup' ); ?></option>
								<?php
									$font_family = catch_popup_font_family();
								foreach ( $font_family as $key => $value ) {
									echo '<option value="' . esc_attr__( $key ) . '"' . selected( $key, esc_html__( $settings['close_button_font_family'] ), false ) . ' style="font-family: ' . esc_attr__( $value ) . '">' . esc_html__( $value ) . '</option>';
								}
								?>
							</select>
						</p>
						<p>
							<label><?php esc_html_e( 'Font Weight', 'catch-popup' ); ?></label>
							<select name="popup_theme[close_button_font_weight]">
								<?php
									$font_weight = catch_popup_font_weight();
								foreach ( $font_weight as $key => $value ) {
									echo '<option value="' . esc_attr( $key ) . '"' . selected( $key, esc_html__( $settings['close_button_font_weight'] ), false ) . '>' . esc_html__( $value ) . '</option>';
								}
								?>
							</select>
						</p>
						<p>
							<label><?php esc_html_e( 'Font Style', 'catch-popup' ); ?></label>
							<select name="popup_theme[close_button_font_style]">
								<?php
									$font_style = catch_popup_font_style();
								foreach ( $font_style as $key => $value ) {
									echo '<option value="' . esc_attr__( $key ) . '"' . selected( $key, esc_html__( $settings['close_button_font_style'] ), false ) . '>' . esc_html__( $value ) . '</option>';
								}
								?>
							</select>
						</p>
					</div>
					<div id="catch-popup-close-border" class="horizontaltab wpcatchtab nosave">
						<p>
							<label><?php esc_html_e( 'Style', 'catch-popup' ); ?></label>
							<select name="popup_theme[close_button_border_style]">
								<?php
									$border_styles = catch_popup_border_styles();
								foreach ( $border_styles as $key => $value ) {
									echo '<option value="' . esc_attr__( $key ) . '"' . selected( $key, esc_html__( $settings['close_button_border_style'] ), false ) . '>' . esc_html__( $value ) . '</option>';
								}
								?>
							</select>
						</p>
						<p>
							<label><?php esc_html_e( 'Color', 'catch-popup' ); ?></label>
							<input type="text" class="colorpicker" name="popup_theme[close_button_border_color]" value="<?php esc_attr_e( $settings['close_button_border_color'] ); ?>"/>
						</p>
						<p>
							<label><?php esc_html_e( 'Thickness', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="5" name="popup_theme[close_button_border_thickness]" value="<?php esc_attr_e( $settings['close_button_border_thickness'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="5" step="1" value="<?php esc_attr_e( $settings['close_button_border_thickness'] ); ?>">
						</p>
					</div>
					<div id="catch-popup-close-dropshadow" class="horizontaltab wpcatchtab nosave">
						<p>
							<label><?php esc_html_e( 'Color', 'catch-popup' ); ?></label>
							<input type="text" class="colorpicker" name="popup_theme[close_button_dropshadow_color]" value="<?php esc_attr_e( $settings['close_button_dropshadow_color'] ); ?>"/>
						</p>
						<p>
							<label><?php esc_html_e( 'Opacity', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[close_button_dropshadow_opacity]" value="<?php esc_attr_e( $settings['close_button_dropshadow_opacity'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['close_button_dropshadow_opacity'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Horizontal Position', 'catch-popup' ); ?></label>
							<input type="range" min="-50" max="50" name="popup_theme[close_button_dropshadow_horizontal_position]" value="<?php esc_attr_e( $settings['close_button_dropshadow_horizontal_position'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="-50" max="50" step="1" value="<?php esc_attr_e( $settings['close_button_dropshadow_horizontal_position'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Vertical Position', 'catch-popup' ); ?></label>
							<input type="range" min="-50" max="50" name="popup_theme[close_button_dropshadow_vertical_position]" value="<?php esc_attr_e( $settings['close_button_dropshadow_vertical_position'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="-50" max="50" step="1" value="<?php esc_attr_e( $settings['close_button_dropshadow_vertical_position'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Blur Radius', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="50" name="popup_theme[close_button_dropshadow_blur_radius]" value="<?php esc_attr_e( $settings['close_button_dropshadow_blur_radius'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="50" step="1" value="<?php esc_attr_e( $settings['close_button_dropshadow_blur_radius'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Spread', 'catch-popup' ); ?></label>
							<input type="range" min="-100" max="100" name="popup_theme[close_button_dropshadow_spread]" value="<?php esc_attr_e( $settings['close_button_dropshadow_spread'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="-100" max="100" step="1" value="<?php esc_attr_e( $settings['close_button_dropshadow_spread'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Inset', 'catch-popup' ); ?></label>
							<select name="popup_theme[close_button_dropshadow_inset]">
								<?php
									$inset = catch_popup_inset();
								foreach ( $inset as $key => $value ) {
									echo '<option value="' . esc_attr__( $key ) . '"' . selected( $key, esc_html__( $settings['close_button_dropshadow_inset'] ), false ) . '>' . esc_html__( $value ) . '</option>';
								}
								?>
							</select>
						</p>
					</div>
					<div id="catch-popup-close-textshadow" class="horizontaltab wpcatchtab nosave">
						<p>
							<label><?php esc_html_e( 'Color', 'catch-popup' ); ?></label>
							<input type="text" class="colorpicker" name="popup_theme[close_button_textshadow_color]" value="<?php esc_attr_e( $settings['close_button_textshadow_color'] ); ?>"/>
						</p>
						<p>
							<label><?php esc_html_e( 'Opacity', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[close_button_textshadow_opacity]" value="<?php esc_attr_e( $settings['close_button_textshadow_opacity'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['close_button_textshadow_opacity'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Horizontal Position', 'catch-popup' ); ?></label>
							<input type="range" min="-50" max="50" name="popup_theme[close_button_textshadow_horizontal_position]" value="<?php esc_attr_e( $settings['close_button_textshadow_horizontal_position'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="-50" max="50" step="1" value="<?php esc_attr_e( $settings['close_button_textshadow_horizontal_position'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Vertical Position', 'catch-popup' ); ?></label>
							<input type="range" min="-50" max="50" name="popup_theme[close_button_textshadow_vertical_position]" value="<?php esc_attr_e( $settings['close_button_textshadow_vertical_position'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="-50" max="50" step="1" value="<?php esc_attr_e( $settings['close_button_textshadow_vertical_position'] ); ?>">
						</p>
						<p>
							<label><?php esc_html_e( 'Blur Radius', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" name="popup_theme[close_button_textshadow_blur_radius]" value="<?php esc_attr_e( $settings['close_button_textshadow_blur_radius'] ); ?>"/>
							<input style="width: 55px; vertical-align: top;" type="number" min="0" max="100" step="1" value="<?php esc_attr_e( $settings['close_button_textshadow_blur_radius'] ); ?>">
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
}


add_action( 'add_meta_boxes', 'catch_popup_theme_add' );

function catch_popup_theme_save( $post_id ) {
	if ( $_POST ) {
		global $post_type;

		$post_type_object = get_post_type_object( $post_type );

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                      // Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )        // Check Revision
		|| ( ! in_array( $post_type, array( 'catch_popup_theme' ) ) )                  // Check if current post type is supported.
		|| ( ! check_admin_referer( basename( __FILE__ ), 'catch_popup_theme_meta_box_nonce' ) )    // Check nonce - Security
		|| ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) ) ) {
			return $post_id;
		}
		$fields   = catch_popup_themes_meta_default();
		$settings = array();
		foreach ( $fields as $field => $default ) {
			if ( strpos( $field, 'color' ) !== false ) {
				$settings[ $field ] = isset( $_POST['popup_theme'][ $field ] ) ? sanitize_hex_color( $_POST['popup_theme'][ $field ] ) : $default;
			} elseif (
				'container_border_style' === $field ||
				'container_dropshadow_inset' === $field ||
				'title_alignment' === $field ||
				'title_font_family' === $field ||
				'title_font_style' === $field ||
				'title_font_weight' === $field ||
				'content_font_family' === $field ||
				'close_button_location' === $field ||
				'close_button_font_style' === $field ||
				'close_button_font_family' === $field ||
				'close_button_dropshadow_inset' === $field ||
				'close_button_border_style' === $field ||
				'close_button_font_weight' === $field ) {
				$settings[ $field ] = isset( $_POST['popup_theme'][ $field ] ) ? sanitize_key( $_POST['popup_theme'][ $field ] ) : $default;
			} elseif ( 'close_button_text' === $field ) {
				$settings[ $field ] = isset( $_POST['popup_theme'][ $field ] ) ? sanitize_text_field( $_POST['popup_theme'][ $field ] ) : $default;
			} else {
				$settings[ $field ] = isset( $_POST['popup_theme'][ $field ] ) ? catch_popup_sanitize_number( $_POST['popup_theme'][ $field ], $default ) : $default;
			}
		} // end foreach

		// delete_post_meta( $post_id, 'catch_popup_theme_settings' );
		if ( ! update_post_meta( $post_id, 'catch_popup_theme_settings', $settings ) ) {
			add_post_meta( $post_id, 'catch_popup_theme_settings', $settings, true );
		}
	}
}

add_action( 'save_post', 'catch_popup_theme_save' );
