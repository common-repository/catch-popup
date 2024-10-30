<?php

if ( !defined( 'ABSPATH' ) ) exit;

add_action( 'init', 'catch_popup_init' );
/**
 * Register a popup post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function catch_popup_init() {
	$labels = array(
		'name'               => _x( 'Popup', 'post type general name', 'catch-popup' ),
		'singular_name'      => _x( 'Popup', 'post type singular name', 'catch-popup' ),
		'menu_name'          => _x( 'Popup', 'admin menu', 'catch-popup' ),
		'name_admin_bar'     => _x( 'Popup', 'add new on admin bar', 'catch-popup' ),
		'add_new'            => _x( 'Add New', 'popup', 'catch-popup' ),
		'add_new_item'       => __( 'Add New Popup', 'catch-popup' ),
		'new_item'           => __( 'New Popup', 'catch-popup' ),
		'edit_item'          => __( 'Edit Popup', 'catch-popup' ),
		'view_item'          => __( 'View Popup', 'catch-popup' ),
		'all_items'          => __( 'All Popup', 'catch-popup' ),
		'search_items'       => __( 'Search Popup', 'catch-popup' ),
		'parent_item_colon'  => __( 'Parent Popup:', 'catch-popup' ),
		'not_found'          => __( 'No popups found.', 'catch-popup' ),
		'not_found_in_trash' => __( 'No popups found in Trash.', 'catch-popup' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'catch-popup' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => CATCH_POPUP_SLUG ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'			 => 'dashicons-format-status',
		'show_in_rest'		 => true,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( CATCH_POPUP_SLUG, $args );
}


add_action( 'init', 'catch_popup_themes_init' );
/**
 * Register a popup_themes post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function catch_popup_themes_init() {
	$labels = array(
		'name'               => _x( 'Popup Themes', 'post type general name', 'catch-popup' ),
		'singular_name'      => _x( 'Popup Theme', 'post type singular name', 'catch-popup' ),
		'menu_name'          => _x( 'Popup Themes', 'admin menu', 'catch-popup' ),
		'name_admin_bar'     => _x( 'Popup Theme', 'add new on admin bar', 'catch-popup' ),
		'add_new'            => _x( 'Add New', 'popup themes', 'catch-popup' ),
		'add_new_item'       => __( 'Add New Popup Theme', 'catch-popup' ),
		'new_item'           => __( 'New Popup Theme', 'catch-popup' ),
		'edit_item'          => __( 'Edit Popup Theme', 'catch-popup' ),
		'view_item'          => __( 'View Popup Theme', 'catch-popup' ),
		'all_items'          => __( 'All Popup Themes', 'catch-popup' ),
		'search_items'       => __( 'Search Popup Themes', 'catch-popup' ),
		'parent_item_colon'  => __( 'Parent Popup Themes:', 'catch-popup' ),
		'not_found'          => __( 'No popup themes found.', 'catch-popup' ),
		'not_found_in_trash' => __( 'No popup themes found in Trash.', 'catch-popup' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'catch-popup' ),
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => 'edit.php?post_type=' . CATCH_POPUP_SLUG,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => CATCH_POPUP_THEME_SLUG ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title' )
	);

	register_post_type( CATCH_POPUP_THEME_SLUG, $args );
}

//add_action( 'admin_menu', 'catch_popup_add_custom_link_into_appearnace_menu' );
function catch_popup_add_custom_link_into_appearnace_menu() {
    global $submenu;
    $permalink = admin_url( '/post-new.php?post_type=' . CATCH_POPUP_THEME_SLUG );
    $submenu['edit.php?post_type=' . CATCH_POPUP_SLUG][] = array( 'Add New Popup Theme', 'manage_options', $permalink );
}

// Add the custom columns to the book post type:
add_filter( 'manage_catch_popup_posts_columns', 'catch_popup_set_custom_edit_catch_popup_columns' );
function catch_popup_set_custom_edit_catch_popup_columns($columns) {
	$columns['catch_popup_theme']        = __( 'Theme', 'your_text_domain' );
	//$columns['catch_popup_shortcode_id'] = __( 'Shortcode ID', 'your_text_domain' );

    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_catch_popup_posts_custom_column' , 'catch_popup_custom_catch_popup_column', 10, 2 );
function catch_popup_custom_catch_popup_column( $column, $post_id ) {
    switch ( $column ) {

        case 'catch_popup_theme' :

        	$theme_id = catch_popup_get_setting( $post_id, 'catch_popup_theme',false );
        	if( '' != $theme_id ) {
        		$theme = catch_popup_get_theme( $theme_id );
	        	echo $theme[0]->post_title;
	        } else {
	        	esc_html_e( 'No theme selected', 'catch-popup' );
        	}
            break;
    }
}