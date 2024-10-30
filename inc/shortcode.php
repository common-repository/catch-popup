<?php

if ( !defined( 'ABSPATH' ) ) exit;

add_shortcode( 'catch-popup', 'catch_popup_shortcode' );
function catch_popup_shortcode( $atts, $content ) {
	/*echo '<pre>'; 
	print_r($content); 
	echo '</pre>'; 
	die();*/
	$a = shortcode_atts( array(
		'id'          => '',
		'html_tag'    => '',
		//'content'     => '',
		'popup_class' => ''
	), $atts );

	return '<' . $a['html_tag'] . ' class="catch-popup-trigger catch-popup-' . $a['id'] . ' ' . $a['popup_class'] . '" style="cursor: pointer;" data-popup="' . $a['id'] . '">' . do_shortcode( $content ) . '</' . $a['html_tag'] . '>';
}

function catch_popup_display_popups() {
	global $post;

	$args = array(
		'post_type' => CATCH_POPUP_SLUG
	);
	$popups = get_posts($args, OBJECT);

	foreach( $popups as $popup ) {
		$settings = catch_popup_get_settings($popup->ID);

		$theme_id       = $settings['catch_popup_theme'];
		$theme_data     = catch_popup_get_theme( $theme_id );
		$theme_settings = catch_popup_get_theme_settings( $theme_id );
		$theme_name     = $theme_data[0]->post_name;
		if( 'custom' == $settings['catch_popup_size'] ) {
			$width_class = 'catch-popup-custom-size';

		} elseif( 'auto' == $settings['catch_popup_size'] ) {
			$width_class = 'catch-popup-auto-size';
		} else {
			switch( $settings['catch_popup_size'] ) {
				case 'nano':
					$width_class = 'catch-popup-responsive catch-popup-responsive-nano';
					break;
				case 'micro':
					$width_class = 'catch-popup-responsive catch-popup-responsive-micro';
					break;
				case 'tiny':
					$width_class = 'catch-popup-responsive catch-popup-responsive-tiny';
					break;
				case 'small':
					$width_class = 'catch-popup-responsive catch-popup-responsive-small';
					break;
				case 'medium':
					$width_class = 'catch-popup-responsive catch-popup-responsive-medium';
					break;
				case 'normal':
					$width_class = 'catch-popup-responsive catch-popup-responsive-normal';
					break;
				case 'large':
					$width_class = 'catch-popup-responsive catch-popup-responsive-large';
					break;
				case 'x-large':
					$width_class = 'catch-popup-responsive catch-popup-responsive-x-large';
					break;
			}
		}
		?>

		<?php
			$condt = true;

			if( isset( $settings['catch_popup_target_value'] ) && ( array() != ( $settings['catch_popup_target_value'] ) ) ){
				$popup->ID;

				$condt      = false;
				$i          = 0;
				$categories = catch_popup_category_array( $post->ID );
				$tags       = catch_popup_tag_array( $post->ID );

				foreach( $settings['catch_popup_target_value'] as $condition ) {
					if( 'home' == $condition && is_home() ) {
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
			
			//if( $condt && 'auto' === $settings['catch_popup_style'] ) :
		?>

				<div id="catch-popup-<?php echo $popup->ID; ?>" class="catch-modal catch-modal-one catch-popup catch-popup-overlay catch-popup-theme-<?php echo $theme_id; ?> catch-popup-theme-<?php echo $theme_name; ?> popup-overlay">
					<div id="popup-<?php echo $popup->ID; ?>" class="catch-modal-content catch-popup-container popup theme-<?php echo $theme_id; ?> <?php echo $width_class; ?> custom-position">
						<article>

							<?php if( has_post_thumbnail( $popup ) ) : ?>
							<div class="post-thumbnail">
								<?php
								echo wp_get_attachment_image( get_post_thumbnail_id( $popup->ID ), 'full' ); ?>
							</div>
							<?php endif; ?>
							<div class="entry-container">
								<div class="entry-header">
									<h2 class="entry-title catch-popup-title"><?php echo $popup->post_title; ?></h2>
								</div>
								<div class="entry-summary catch-popup-content">
									<?php echo do_shortcode( $popup->post_content ); ?>
								</div> <!-- .entry-summary -->
							</div> <!-- .entry-container -->
						</article>
						<a href="#" class="catch-popup-close popup-close"><span>&times;</span><?php 
						if( isset( $settings['catch_popup_button_text'] ) && '' != $settings['catch_popup_button_text'] ) {
							echo '<span class="close-label">' . esc_html__( $settings['catch_popup_button_text'] ) . '</span>';
						} elseif( isset( $theme_settings['close_button_text'] ) && '' != $theme_settings['close_button_text'] ) {
							echo '<span class="close-label">' . esc_html__( $theme_settings['close_button_text'] ) . '</span>';
						}?></a>
					</div>
				</div>
		<?php
			//endif;
	} // foreach
	//die;
}

add_action('wp_footer', 'catch_popup_display_popups');
