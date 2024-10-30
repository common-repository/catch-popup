<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function catch_popup_enqueue_scripts() {
	global $post;
	
	// Register
	wp_register_script( 'catch-popup-admin-js', CATCH_POPUP_URL . 'js/catch-popup-admin.js', array( 'jquery', 'jquery-ui-tooltip' ), '1.0.1', false );
	
	// Localize
	if ( $post ) {
		$cpop_object = array(
			'settings' => catch_popup_get_settings( $post->ID ),
		);
		wp_localize_script( 'catch-popup-admin-js', 'cpop_object', $cpop_object );
	}
	
	// Enqueue
	wp_enqueue_script( 'catch-popup-admin-js' );
	wp_enqueue_script( 'catch-popup-multi-select', CATCH_POPUP_URL . 'js/chosen.jquery.js', array( 'jquery' ), CATCH_POPUP_VERSION, false );
	wp_enqueue_script( 'catch-popup-color-picker', CATCH_POPUP_URL . 'js/wp-color-picker.js', array( 'wp-color-picker', 'jquery' ), CATCH_POPUP_VERSION, false );
}

function catch_popup_enqueue_styles() {
	wp_enqueue_style( 'catch-popup-multi-select', CATCH_POPUP_URL . 'css/chosen.css', array(), CATCH_POPUP_VERSION, 'all' );
	wp_enqueue_style( 'catch-popup' . '-display-dashboard', CATCH_POPUP_URL . 'css/admin-dashboard.css', array(), CATCH_POPUP_VERSION, 'all' );
	wp_enqueue_style( 'catch-popup-admin-fonts', catch_popup_fonts_url(), array(), null );
	wp_enqueue_style( 'wp-color-picker' );
}

function something() {
	global $pagenow;
	global $post;
	if ( ( 'post-new.php' === $pagenow &&
		isset( $_GET['post_type'] ) && ( CATCH_POPUP_THEME_SLUG === $_GET['post_type'] || CATCH_POPUP_SLUG === $_GET['post_type'] )
	) || ( 'post.php' === $pagenow && isset( $post->post_type ) && ( CATCH_POPUP_THEME_SLUG === $post->post_type || CATCH_POPUP_SLUG === $post->post_type ) && isset( $_GET['action'] ) && 'edit' === $_GET['action'] ) ) {
		add_action( 'admin_enqueue_scripts', 'catch_popup_enqueue_scripts', 20 );
		add_action( 'admin_enqueue_scripts', 'catch_popup_enqueue_styles', 20 );
	}
}

add_action( 'admin_enqueue_scripts', 'something', 10 );
