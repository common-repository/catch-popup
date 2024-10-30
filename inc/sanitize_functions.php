<?php 

if ( !defined( 'ABSPATH' ) ) exit;

function catch_popup_sanitize_checkbox( $input ) {
	return ( $input ) ? true : false;
}

function catch_popup_sanitize_post( $input ) {
	$valid_posts_array = array();
	$post_id_array = explode( ',', (string) $input );
	foreach( $post_id_array as $id ) {
		$id = absint( $id );
		if( 'publish' == get_post_status( $id ) ) {
			$valid_posts_array[] = $id;
		}elseif( term_exists( $id, 'post_tag' ) ){
			$valid_posts_array[] = $id;
		}elseif( category_exists( $id ) ){
			$valid_posts_array[] = $id;
		}
	}
	return ( implode( ',', $valid_posts_array ) );
}

function catch_popup_sanitize_target( $input ) {
	$valid_posts_array = array();
	foreach( $input as $id ) {
		$id = absint( $id );
		if( 'publish' == get_post_status( $id ) ) {
			$valid_posts_array[] = $id;
		}elseif( term_exists( $id, 'post_tag' ) ){
			$valid_posts_array[] = $id;
		}elseif( category_exists( $id ) ){
			$valid_posts_array[] = $id;
		}
	}
	return $valid_posts_array;
}

function catch_popup_sanitize_target_condition( $input ) {
    $choices = array( 'and', 'or' );
    return ( in_array( $input, $choices ) ) ? $input : '';
}

function catch_popup_sanitize_number( $value, $default ) {
	return ( is_numeric( $value ) ) ? $value : $default;
}

function catch_popup_sanitize_target_value( $input ) {
    $target_options = catch_popup_target_options();

    $choices = array();
    foreach( $target_options as $arr ) {
    	foreach( $arr as $key => $value ) {
    		$choices[] = $value['id'];
    	}
    }
    return ( in_array( $input, $choices ) ) ? $input : '';
}