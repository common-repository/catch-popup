<?php

if ( !defined( 'ABSPATH' ) ) exit;

function catch_pop_enqueue_styles() {
	$date = new DateTime();
	$upload_dir = catch_popup_upload_dir('baseurl');
	if (! is_dir($upload_dir)) {
       mkdir( $upload_dir, 0755 );
    }
	$filename = 'catch-popup-styles.css';

	$css_file = $upload_dir . '/' . $filename;
	wp_enqueue_style( 'catch-popup-fonts', catch_popup_fonts_url(), array(), null );
	wp_enqueue_style( 'catch-popup-css', $css_file, array(), $date->getTimestamp(), 'all' );
}
add_action( 'wp_enqueue_scripts', 'catch_pop_enqueue_styles' );


function catch_popup_enqueue_script() {
	$date = new DateTime();
	$upload_dir = catch_popup_upload_dir('baseurl');
	if (! is_dir($upload_dir)) {
       mkdir( $upload_dir, 0755 );
    }
	$filename = 'catch-popup.js';

	$js_file = $upload_dir . '/' . $filename;

	wp_enqueue_script( 'catch-popup-scripts', $js_file, array('jquery'), $date->getTimestamp(), true );
}
add_action( 'wp_enqueue_scripts', 'catch_popup_enqueue_script' );