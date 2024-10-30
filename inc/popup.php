<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function catch_popup_add() {
	add_meta_box(
		'catch-popup-meta', // Metabox ID
		'Popup Settings',
		'catch_popup_show',
		CATCH_POPUP_SLUG, // post_type
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'catch_popup_add' );


function catch_popup_show() {
	global $post;
	$settings = catch_popup_get_settings( $post->ID );
	/*
	echo '<pre>';
	print_r($settings);
	echo '</pre>';
	die();*/

	wp_localize_script( 'catch-popup-admin-js', 'catch_popup', $settings );

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'catch_popup_meta_box_nonce' );
	?>
	<div class="catch-popup-container">
		<div class="vtab">
			<h2 class="nav-tab-wrapper">
				<a class="nav-tab vnav-tab nav-tab-active" id="catch-popup-trigger-tab" href="#catch-popup-trigger"><?php esc_html_e( 'Triggers', 'catch-popup' ); ?></a>
				<a class="nav-tab vnav-tab" id="catch-popup-display-tab" href="#catch-popup-display"><?php esc_html_e( 'Display', 'catch-popup' ); ?></a>
				<a class="nav-tab vnav-tab" id="catch-popup-close-tab" href="#catch-popup-close"><?php esc_html_e( 'Close', 'catch-popup' ); ?></a>
				<a class="nav-tab vnav-tab" id="catch-popup-targeting-tab" href="#catch-popup-targeting"><?php esc_html_e( 'Targeting', 'catch-popup' ); ?></a>
			</h2>
		</div>
		<div class="vtabcontent">
			<div id="catch-popup-trigger" class="verticaltab wpcatchtab nosave active">
				<p>
					<label><?php esc_html_e( 'How to show popup?', 'catch-popup' ); ?></label>
					<select name="popup[catch_popup_style]">
						<option value="click" <?php echo selected( 'click', $settings['catch_popup_style'], false ); ?>><?php esc_html_e( 'Click Open', 'catch-popup' ); ?></option>
						<option value="auto" <?php echo selected( 'auto', $settings['catch_popup_style'], false ); ?>><?php esc_html_e( 'Auto Open/Time delay', 'catch-popup' ); ?></option>
					</select>
					<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Select how you want to display popup, automatically on page load or on click (On click require to use shortcode to show popup.)', 'catch-popup' ); ?>"></span>
				</p>

				<p
				<?php
				if ( 'auto' != $settings['catch_popup_style'] ) {
					echo 'style="display: none;"'; }
				?>
				>
					<label><?php esc_html_e( 'Delay', 'catch-popup' ); ?></label>
					<input type="range" min="0" max="10000" step="500" name="popup[catch_popup_delay]" value="<?php esc_attr_e( $settings['catch_popup_delay'] ); ?>"/>
					<input min="0" max="10000" step="500" type="number" name="popup[catch_popup_delay]" value="<?php esc_attr_e( $settings['catch_popup_delay'] ); ?>"/><span class="range-value-unit"><?php esc_html_e( 'ms', 'catch-popup' ); ?></span>
					<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Adds delay to open popup on page load.', 'catch-popup' ); ?>"></span>
				</p>
			</div><!-- #catch_popup_trigger -->
			<div id="catch-popup-display" class="verticaltab wpcatchtab save">
				<div class="htab">
					<h2 class="nav-tab-wrapper">
						<a class="nav-tab hnav-tab nav-tab-active" id="catch-popup-appearance-tab" href="#catch-popup-appearance"><?php esc_html_e( 'Appearance', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-size-tab" href="#catch-popup-size"><?php esc_html_e( 'Size', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-position-tab" href="#catch-popup-position"><?php esc_html_e( 'Position', 'catch-popup' ); ?></a>

						<a class="nav-tab hnav-tab" id="catch-popup-advanced-tab" href="#catch-popup-advanced"><?php esc_html_e( 'Advanced', 'catch-popup' ); ?></a>
					</h2>
				</div>
				<div class="htabcontent">
					<div id="catch-popup-appearance" class="horizontaltab wpcatchtab nosave active">
						<p>
							<label><?php esc_html_e( 'Popup Theme', 'catch-popup' ); ?></label>
							<select name="popup[catch_popup_theme]">
								<option value=""><?php esc_html_e( 'Select Popup Theme', 'catch-popup' ); ?></option>
								<?php
									$themes = catch_popup_get_all_themes();
								foreach ( $themes as $theme ) {
									echo '<option value="' . esc_attr__( $theme->ID ) . '"' . selected( $theme->ID, esc_html__( $settings['catch_popup_theme'] ), false ) . '>' . esc_html__( $theme->post_title ) . '</option>';
								}
								?>
							</select>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Select the theme you want to use on the popup. Catch Popup comes with 5 inbuilt themes. You can custom these themes and add your own as well.', 'catch-popup' ); ?>"></span>
						</p>
					</div>
					<div id="catch-popup-size" class="horizontaltab wpcatchtab nosave">
						<?php
							$size_options = catch_popup_size();
						?>
						<p>
							<label><?php esc_html_e( 'Window Size', 'catch-popup' ); ?></label>
							<select name="popup[catch_popup_size]">
								<?php
								foreach ( $size_options as $key => $value ) {
									if ( $key == 'nano' ) {
										echo '<optgroup label="' . esc_html__( 'Responsive Sizes', 'catch-popup' ) . '">';
									} elseif ( $key == 'auto' ) {
										echo '<optgroup label="' . esc_html__( 'Other Sizes', 'catch-popup' ) . '">';
									}
											echo '<option value="' . esc_attr__( $key ) . '" ' . selected( $key, esc_html__( $settings['catch_popup_size'] ), false ) . '>' . esc_html__( $value ) . '</option>';
									if ( $key == 'x-large' || $key == 'custom' ) {
										echo '</optgroup>';
									}
								}
								?>
							</select>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Defines the size of the popup.', 'catch-popup' ); ?>"></span>
						</p>

						<p
						<?php
						if ( 'auto' == $settings['catch_popup_size'] ) {
							echo 'style="display: none;"'; }
						?>
						>
							<label><?php esc_html_e( 'Min Width', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" step="1" name="popup[catch_popup_min_width]" value="<?php esc_attr_e( $settings['catch_popup_min_width'] ); ?>"/>
							<input min="0" max="100" step="1" type="number" name="popup[catch_popup_min_width]" value="<?php esc_attr_e( $settings['catch_popup_min_width'] ); ?>"/><span class="range-value-unit"><?php esc_html_e( '%', 'catch-popup' ); ?></span>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Minimum width for the popup. Default is 0.', 'catch-popup' ); ?>"></span>
						</p>

						<p
						<?php
						if ( 'auto' == $settings['catch_popup_size'] ) {
							echo 'style="display: none;"'; }
						?>
						>
							<label><?php esc_html_e( 'Max Width', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="100" step="1" name="popup[catch_popup_max_width]" value="<?php esc_attr_e( $settings['catch_popup_max_width'] ); ?>"/>
							<input min="0" max="100" step="1" type="number" name="popup[catch_popup_max_width]" value="<?php esc_attr_e( $settings['catch_popup_max_width'] ); ?>"/><span class="range-value-unit"><?php esc_html_e( '%', 'catch-popup' ); ?></span>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Maximum width for the popup. Default is 100.', 'catch-popup' ); ?>"></span>
						</p>

						<?php
							$unit_options = catch_popup_unit();
						?>
						<p
						<?php
						if ( 'custom' != $settings['catch_popup_size'] ) {
							echo 'style="display: none;"'; }
						?>
						>
							<label><?php esc_html_e( 'Width', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="1920" step="1" name="popup[catch_popup_width]" value="<?php esc_attr_e( $settings['catch_popup_width'] ); ?>"/>
							<input min="0" max="1920" step="1" type="number" name="popup[catch_popup_width]" value="<?php esc_attr_e( $settings['catch_popup_width'] ); ?>"/>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Adjust custom width for the popup. Default is 640.', 'catch-popup' ); ?>"></span>
							<select name="popup[catch_popup_width_unit]">
								<?php
								foreach ( $unit_options as $unit ) {
									echo '<option value="' . esc_attr__( $unit ) . '" ' . selected( $unit, esc_html( $settings['catch_popup_width_unit'] ), false ) . '>' . esc_html__( $unit ) . '</option>';
								}
								?>
							</select>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Select the unit for custom width. Default is px.', 'catch-popup' ); ?>"></span>
						</p>

						<p
						<?php
						if ( 'custom' != $settings['catch_popup_size'] ) {
							echo 'style="display: none;"'; }
						?>
						>
							<input type="checkbox" value="1" name="popup[catch_popup_auto_height]" value="<?php echo $settings['catch_popup_auto_height']; ?>" <?php echo checked( isset( $settings['catch_popup_auto_height'] ) ? esc_html__( $settings['catch_popup_auto_height'] ) : '', true, false ); ?>/>
							<span><?php esc_html_e( 'Auto adjust height', 'catch-popup' ); ?></span>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Check if you want the popup to have automatic adjustable height.', 'catch-popup' ); ?>"></span>
						</p>

						<p
						<?php
						if ( 'custom' != $settings['catch_popup_size'] || 1 == $settings['catch_popup_auto_height'] ) {
							echo 'style="display: none;"'; }
						?>
						>
							<label><?php esc_html_e( 'Height', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="1080" step="1" name="popup[catch_popup_height]" value="<?php esc_attr_e( $settings['catch_popup_height'] ); ?>"/>
							<input min="0" max="1080" step="1" type="number" name="popup[catch_popup_height]" value="<?php esc_attr_e( $settings['catch_popup_height'] ); ?>"/>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Adjust custom height for the popup. Default is 640.', 'catch-popup' ); ?>"></span>
							<select name="popup[catch_popup_height_unit]">
								<?php
								foreach ( $unit_options as $unit ) {
									echo '<option value="' . esc_attr__( $unit ) . '" ' . selected( $unit, esc_html__( $settings['catch_popup_height_unit'] ), false ) . '>' . esc_html( $unit ) . '</option>';
								}
								?>
							</select>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Select the unit for custom height. Default is px.', 'catch-popup' ); ?>"></span>
						</p>
					</div>
					<div id="catch-popup-position" class="horizontaltab wpcatchtab nosave">
						<?php
							$locations = catch_popup_close_location();
						?>
						<p>
							<label><?php esc_html_e( 'Location', 'catch-popup' ); ?></label>
							<select name="popup[catch_popup_location]">
								<?php
								foreach ( $locations as $key => $value ) {
									echo '<option value="' . esc_attr__( $key ) . '" ' . selected( $key, esc_html__( $settings['catch_popup_location'] ), false ) . '>' . esc_html__( $value ) . '</option>';
								}
								?>
							</select>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Choose position for the popup to be displayed. Default is Top Center', 'catch-popup' ); ?>"></span>
						</p>

						<p
						<?php
						if ( ! preg_match( '/top/i', $settings['catch_popup_location'] ) ) {
							echo 'style="display: none;"'; }
						?>
						 >
							<label><?php esc_html_e( 'Top', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="500" step="1" name="popup[catch_popup_top]" value="<?php esc_attr_e( $settings['catch_popup_top'] ); ?>"/>
							<input min="0" max="500" step="1" type="number" name="popup[catch_popup_top]" value="<?php esc_attr_e( $settings['catch_popup_top'] ); ?>"/>
							<span class="range-value-unit"><?php esc_html_e( 'px', 'catch-popup' ); ?></span>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Adjust the custom distance of popup from Top. Default is 100.', 'catch-popup' ); ?>"></span>
						</p>

						<p
						<?php
						if ( ! preg_match( '/right/i', $settings['catch_popup_location'] ) ) {
							echo 'style="display: none;"'; }
						?>
						>
							<label><?php esc_html_e( 'Right', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="500" step="1" name="popup[catch_popup_right]" value="<?php esc_attr_e( $settings['catch_popup_right'] ); ?>"/>
							<input min="0" max="500" step="1" type="number" name="popup[catch_popup_right]" value="<?php esc_attr_e( $settings['catch_popup_right'] ); ?>"/>
							<span class="range-value-unit"><?php esc_html_e( 'px', 'catch-popup' ); ?></span>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Adjust the custom distance of popup from right. Default is 0.', 'catch-popup' ); ?>"></span>
						</p>

						<p
						<?php
						if ( ! preg_match( '/left/i', $settings['catch_popup_location'] ) ) {
							echo 'style="display: none;"'; }
						?>
						>
							<label><?php esc_html_e( 'Left', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="500" step="1" name="popup[catch_popup_left]" value="<?php esc_attr_e( $settings['catch_popup_left'] ); ?>"/>
							<input min="0" max="500" step="1" type="number" name="popup[catch_popup_left]" value="<?php esc_attr_e( $settings['catch_popup_left'] ); ?>"/>
							<span class="range-value-unit"><?php esc_html_e( 'px', 'catch-popup' ); ?></span>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Adjust the custom distance of popup from left. Default is 0.', 'catch-popup' ); ?>"></span>
						</p>
						<p
						<?php
						if ( ! preg_match( '/bottom/i', $settings['catch_popup_location'] ) ) {
							echo 'style="display: none;"'; }
						?>
						>
							<label><?php esc_html_e( 'Bottom', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="500" step="1" name="popup[catch_popup_bottom]" value="<?php esc_attr_e( $settings['catch_popup_bottom'] ); ?>"/>
							<input min="0" max="500" step="1" type="number" name="popup[catch_popup_bottom]" value="<?php esc_attr_e( $settings['catch_popup_bottom'] ); ?>"/>
							<span class="range-value-unit"><?php esc_html_e( 'px', 'catch-popup' ); ?></span>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Adjust the custom distance of popup from bottom. Default is 0.', 'catch-popup' ); ?>"></span>
						</p>
					</div>
					<div id="catch-popup-advanced" class="horizontaltab wpcatchtab nosave">
						<p>
							<label><?php esc_html_e( 'Z-Index', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="200000" step="1" name="popup[catch_popup_zindex]" value="<?php esc_attr_e( $settings['catch_popup_zindex'] ); ?>"/>
							<input min="0" max="200000" step="1" type="number" name="popup[catch_popup_zindex]" value="<?php esc_attr_e( $settings['catch_popup_zindex'] ); ?>"/>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Adjust the Z-index for the popup. Default is 10000.', 'catch-popup' ); ?>"></span>
						</p>
					</div>
				</div>
			</div>
			<div id="catch-popup-close" class="verticaltab wpcatchtab save">
				<div class="htab">
					<h2 class="nav-tab-wrapper">
						<a class="nav-tab hnav-tab nav-tab-active" id="catch-popup-button-tab" href="#catch-popup-button"><?php esc_html_e( 'Button', 'catch-popup' ); ?></a>
						<a class="nav-tab hnav-tab" id="catch-popup-alternative-tab" href="#catch-popup-alternative"><?php esc_html_e( 'Alternative Methods', 'catch-popup' ); ?></a>
					</h2>
				</div>
				<div class="htabcontent">
					<div id="catch-popup-button" class="horizontaltab wpcatchtab nosave active">
						<p>
							<label><?php esc_html_e( 'Button Text', 'catch-popup' ); ?></label>
							<input type="text" name="popup[catch_popup_button_text]" value="<?php esc_attr_e( $settings['catch_popup_button_text'] ); ?>"/>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Custonm text for popup Close button, shows on hover. Default is blank', 'catch-popup' ); ?>"></span>
						</p>

						<p>
							<label><?php esc_html_e( 'Close button delay', 'catch-popup' ); ?></label>
							<input type="range" min="0" max="10000" step="100" name="popup[catch_popup_button_delay]" value="<?php esc_attr_e( $settings['catch_popup_button_delay'] ); ?>"/>
							<input min="0" max="10000" step="100" type="number" name="popup[catch_popup_button_delay]" value="<?php esc_attr_e( $settings['catch_popup_button_delay'] ); ?>"/><span class="range-value-unit"><?php esc_html_e( 'ms', 'catch-popup' ); ?></span>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Adds delay to the close button to show up. Popup can only be closed after the time set for delay.', 'catch-popup' ); ?>"></span>
						</p>
					</div>
					<div id="catch-popup-alternative" class="horizontaltab wpcatchtab nosave">
						<p>
							<input type="checkbox" value="1" name="popup[catch_popup_overlay_close]" <?php echo checked( isset( $settings['catch_popup_overlay_close'] ) ? $settings['catch_popup_overlay_close'] : '', true, false ); ?>/>
							<span><?php esc_html_e( 'Click overlay to close', 'catch-popup' ); ?></span>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Check to allow to close popup if user clicks away somewhere on overlay beside popup.', 'catch-popup' ); ?>"></span>
						</p>

						<p>
							<input type="checkbox" value="1" name="popup[catch_popup_esc_close]" <?php echo checked( isset( $settings['catch_popup_esc_close'] ) ? esc_html__( $settings['catch_popup_esc_close'] ) : '', true, false ); ?> />
							<span><?php esc_html_e( 'Press ESC to close', 'catch-popup' ); ?></span>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Check to close popup with ESC button on keyboard.', 'catch-popup' ); ?>"></span>
						</p>

						<p>
							<input type="checkbox" value="1" name="popup[catch_popup_f4_close]" <?php echo checked( isset( $settings['catch_popup_f4_close'] ) ? esc_html__( $settings['catch_popup_f4_close'] ) : '', true, false ); ?>/>
							<span><?php esc_html_e( 'Press F4 to close', 'catch-popup' ); ?></span>
							<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Check to close popup with F4 button on keyboard.', 'catch-popup' ); ?>"></span>
						</p>
					</div>
				</div>
			</div>
			<div id="catch-popup-targeting" class="verticaltab wpcatchtab save">
				<h3><?php esc_html_e( 'Show popup on', 'catch-popup' ); ?>
				<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'You can show the popup on the desired pages by adding the conditions below with + Add more button. By default the popup show on all pages.', 'catch-popup' ); ?>"></span>
				</h3>
				<?php $posts = catch_popup_target_options(); ?>
				<div class="conditional-wrap">
				<?php $i = 0; foreach ( $settings['catch_popup_target_value'] as $key1 => $target_value ) : ?>
					<div class="target_value">
					<?php if ( $i > 0 ) : ?>
						<select class="condition" name="popup[catch_popup_target_condition][]">
							<option value="and"
							<?php
							if ( 'and' == $settings['catch_popup_target_condition'][ $i - 1 ] ) {
								echo 'selected';}
							?>
							><?php echo esc_html__( 'And', 'catch-popup' ); ?></option>
							<option value="or"
							<?php
							if ( 'or' == $settings['catch_popup_target_condition'][ $i - 1 ] ) {
								echo 'selected';}
							?>
							><?php echo esc_html__( 'Or', 'catch-popup' ); ?></option>
						</select>
					<?php endif; ?>
					<select class="target-condition" name="popup[catch_popup_target_value][]">
							<?php

							foreach ( $posts as $key => $data ) :
								if ( $data ) :
									?>
									<optgroup label="<?php echo ucwords( $key ); ?>">
									<?php
									foreach ( $data as $post_key => $post_value ) :
										?>
											<option value="<?php esc_attr_e( $post_value['id'] ); ?>"
																			 <?php
																				if ( $post_value['id'] == $target_value ) {
																					echo 'selected';}
																				?>
											><?php esc_html_e( $post_value['post_title'], 'catch-popup' ); ?></option>
										<?php endforeach; ?>
									</optgroup>

									<?php
									endif;
								endforeach;
							?>
						</select>
						<select style="display:none;" class="dynamic-populate" multiple name="popup[catch_popup_target][]">
						</select>
						<textarea style="display: none;" class="target-text" name="popup[catch_popup_target_text][]"><?php esc_html_e( $settings['catch_popup_target_text'][ $i ] ); ?></textarea>
						<span class="remove-conditional"><span class="dashicons dashicons-no"></span><?php esc_html_e( 'Remove', 'catch-popup' ); ?></span><br />
					</div>
					<?php
					$i++;
endforeach;
				?>
				</div>
				<div class="and">
					<div class="or" style="display:none;" rel="placeholder" >
						<select class="target-condition" name="popup[catch_popup_target_value][]">
							<?php

							foreach ( $posts as $key => $data ) :
								if ( $data ) :
									?>
									<optgroup label="<?php echo ucwords( $key ); ?>">
									<?php
									foreach ( $data as $post_key => $post_value ) :
										?>
											<option value="<?php esc_attr_e( $post_value['id'] ); ?>"><?php esc_html_e( $post_value['post_title'], 'catch-popup' ); ?></option>
										<?php endforeach; ?>
									</optgroup>

									<?php
									endif;
								endforeach;
							?>
						</select>
						<select style="display:none;" class="dynamic-populate" multiple name="popup[catch_popup_target][]">
						</select>
						<textarea style="display: none;" class="target-text" name="popup[catch_popup_target_text][]"></textarea>
					</div>
					<div class="condition-wrap" style="display: none;">
						<select class="condition" name="popup[catch_popup_target_condition][]">
							<option value="or"><?php echo esc_html__( 'Or', 'catch-popup' ); ?></option>
							<option value="and"><?php echo esc_html__( 'And', 'catch-popup' ); ?></option>
						</select>
					</div>
					<span class="add_more"><span class="dashicons dashicons-plus"></span><?php echo esc_html__( 'Add more', 'catch-popup' ); ?></span>
				</div>
			</div>
		</div>
	</div>
<?php }


function catch_popup_save( $post_id ) {
	global $post_type;

	$post_type_object = get_post_type_object( $post_type );
	if ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}

	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                      // Check Autosave
	|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )        // Check Revision
	|| ( ! in_array( $post_type, array( 'catch_popup' ) ) )                  // Check if current post type is supported.
	|| ( ! check_admin_referer( basename( __FILE__ ), 'catch_popup_meta_box_nonce' ) )    // Check nonce - Security
	|| ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) ) ) {
		return $post_id;
	}
	$fields   = catch_popup_meta_default();
	$settings = array();
	foreach ( $fields as $field => $default ) {
		if ( 'catch_popup_target_text' === $field ) {
			$arr = array();
			if ( isset( $_POST['popup'][ $field ] ) ) {
				foreach ( $_POST['popup'][ $field ] as $key => $value ) {
					$arr[] = catch_popup_sanitize_post( $_POST['popup'][ $field ][ $key ] );
				}
				$settings[ $field ] = $arr;
			} else {
				$settings[ $field ] = $default;
			}
		} elseif ( 'catch_popup_target' === $field ) {
			$arr = array();
			if ( isset( $_POST['popup'][ $field ] ) ) {
				$settings[ $field ] = catch_popup_sanitize_target( $_POST['popup'][ $field ] );
			} else {
				$settings[ $field ] = $default;
			}
		} elseif ( 'catch_popup_target_value' === $field ) {
			$arr = array();
			if ( isset( $_POST['popup'][ $field ] ) ) {
				foreach ( $_POST['popup'][ $field ] as $key => $value ) {
					$arr[] = catch_popup_sanitize_target_value( $_POST['popup'][ $field ][ $key ] );
				}
				$settings[ $field ] = $arr;
			} else {
				$settings[ $field ] = $default;
			}
		} elseif ( 'catch_popup_target_condition' === $field ) {
			$arr = array();
			if ( isset( $_POST['popup'][ $field ] ) ) {
				foreach ( $_POST['popup'][ $field ] as $key => $value ) {
					$arr[] = catch_popup_sanitize_target_condition( $_POST['popup'][ $field ][ $key ] );
				}
				$settings[ $field ] = $arr;
			} else {
				$settings[ $field ] = $default;
			}
		} elseif ( 'catch_popup_button_text' === $field ) {
			$settings[ $field ] = isset( $_POST['popup'][ $field ] ) ? sanitize_text_field( $_POST['popup'][ $field ] ) : $default;
		} elseif (
			'catch_popup_location' === $field ||
			'catch_popup_size' === $field ||
			'catch_popup_height_unit' === $field ||
			'catch_popup_width_unit' === $field ||
			'catch_popup_theme' === $field ||
			'catch_popup_style' === $field ) {
			$settings[ $field ] = isset( $_POST['popup'][ $field ] ) ? sanitize_key( $_POST['popup'][ $field ] ) : $default;
		} elseif (
			'catch_popup_auto_height' === $field ||
			'catch_popup_fixed' === $field ||
			'catch_popup_overlay_close' === $field ||
			'catch_popup_esc_close' === $field ||
			'catch_popup_f4_close' === $field
		) {
			$settings[ $field ] = isset( $_POST['popup'][ $field ] ) ? catch_popup_sanitize_checkbox( $_POST['popup'][ $field ], $default ) : $default;
		} else {
			$settings[ $field ] = isset( $_POST['popup'][ $field ] ) ? catch_popup_sanitize_number( $_POST['popup'][ $field ], $default ) : $default;
		}
	} // end foreach

	if ( ! update_post_meta( $post_id, 'catch_popup_settings', $settings ) ) {
		add_post_meta( $post_id, 'catch_popup_settings', $settings, true );
	}

}

add_action( 'save_post', 'catch_popup_save' );
?>
