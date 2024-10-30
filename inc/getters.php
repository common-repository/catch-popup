<?php

if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Returns a specific theme setting with optional default value when not found.
 *
 * @param      $key
 * @param bool $default
 *
 * @return bool|mixed
 */
function catch_popup_get_theme_setting( $theme_id, $key, $default = false ) {
	$settings = catch_popup_get_theme_settings($theme_id);

	return isset( $settings[ $key ] ) ? $settings[ $key ] : $default;
}

function catch_popup_get_theme_settings( $theme_id ) {

	$catch_popup_theme_settings = get_post_meta( $theme_id, 'catch_popup_theme_settings', true );
	$defaults = catch_popup_themes_meta_default();

	return wp_parse_args( $catch_popup_theme_settings, $defaults  );
}

/**
 * Returns a specific theme setting with optional default value when not found.
 *
 * @param      $key
 * @param bool $default
 *
 * @return bool|mixed
 */
function catch_popup_get_setting( $popup_id, $key, $default = false ) {
	$settings = catch_popup_get_settings($popup_id);

	return isset( $settings[ $key ] ) ? $settings[ $key ] : $default;
}

function catch_popup_get_settings($popup_id) {
	$catch_popup_settings = get_post_meta( $popup_id, 'catch_popup_settings', true );
	$defaults = catch_popup_meta_default();
	
	return wp_parse_args( $catch_popup_settings, $defaults  ) ;
}

/**
 * @param      $key
 * @param bool $single
 *
 * @return mixed|false
 */
function catch_popup_get_meta( $theme_id, $key, $single = true ) {
	/**
	 * Checks for remapped meta values. This allows easily adding compatibility layers in the object meta.
	 */
	if ( false !== $remapped_value = catch_popup_remapped_meta( $key ) ) {
		return $remapped_value;
	}

	return get_post_meta( $theme_id, $key, $single );
}

/**
 * Allows for easy backward compatibility layer management in each child class.
 *
 * @param string $key
 *
 * @return bool
 */
function catch_popup_remapped_meta( $key = '' ) {
	return false;
}



function catch_popup_get_all_themes() {
	$themes = get_posts(
		array(
			'post_type'      => CATCH_POPUP_THEME_SLUG,
			'posts_per_page' => -1,
			'status'         => 'published'
		)
	);
	return $themes;
}

function catch_popup_get_theme( $theme_id ) {
	$theme = get_posts(
		array(
			'post_type'      => CATCH_POPUP_THEME_SLUG,
			'p'              => $theme_id,
			'posts_per_page' => 1,
			'status'         => 'published'
		),
		OBJECT
	);
	return $theme;
}

function catch_popup_get_all_popups() {
	$popups = get_posts(
		array(
			'post_type'      => CATCH_POPUP_SLUG,
			'posts_per_page' => -1,
			'status'         => 'published'
		)
	);
	return $popups;
}

function catch_popup_get_popup( $popup_id ) {
	$popup = get_posts(
		array(
			'post_type'      => CATCH_POPUP_SLUG,
			'p'              => $popup_id,
			'posts_per_page' => 1,
			'status'         => 'published'
		),
		OBJECT
	);
	return $popup;
}

function catch_popup_target_options() {

	$post_types = get_post_types( array(
			'public' => true
		) 
	);
	
	$all = array();
	foreach( $post_types as $post_type ) {
		/* Skip catch-popup, catch-popup-theme, attachment post types */
		if( CATCH_POPUP_SLUG == $post_type || CATCH_POPUP_THEME_SLUG == $post_type || 'attachment' == $post_type ) {
			continue;
		}
		$posts = get_posts(
			array( 
				'numberposts' => -1,
				'post_type'   => $post_type
			)
		);

		$post_list = array();
		foreach( $posts as $post ) {
			$post_list[] = array(
				'id'         => $post->ID,
				'post_title' => $post->post_title
			);
		}
		$general = array(
			array(
				'id' => 'home',
				'post_title' => esc_html__( 'Home', 'catch-popup' )
			),
			array(
				'id' => 'search',
				'post_title' => esc_html__( 'Search', 'catch-popup' )
			),
			array(
				'id' => '404',
				'post_title' => esc_html__( '404', 'catch-popup' )
			),
		);
		$page = array(
			array(
				'id' => 'all-page',
				'post_title' => esc_html__( 'All Pages', 'catch-popup' )
			),
			array(
				'id' => 'select-page',
				'post_title' => esc_html__( 'Selected Pages', 'catch-popup' )
			)
		);
		$post = array(
			array(
				'id' => 'all-post',
				'post_title' => esc_html__( 'All Posts', 'catch-popup' )
			),
			array(
				'id' => 'select-post',
				'post_title' => esc_html__( 'Selected Posts', 'catch-popup' )
			),
			array(
				'id' => 'category-post',
				'post_title' => esc_html__( 'With Categories', 'catch-popup' )
			),
			array(
				'id' => 'tag-post',
				'post_title' => esc_html__( 'With Tags', 'catch-popup' )
			),
			array(
				'id' => 'latest-post',
				'post_title' => esc_html__( 'Blog Index', 'catch-popup' )
			),
		);
		$media = array(
			array(
				'id' => 'all-media',
				'post_title' => esc_html__( 'All Media', 'catch-popup' )
			),
			array(
				'id' => 'select-media',
				'post_title' => esc_html__( 'Selected Media', 'catch-popup' )
			),
		);
		$all['general']  = $general;
		$all['post']     = $post;
		$all['page']     = $page;
	}
	
	return $all;
}

function catch_popup_category_array($id){
	$categories = get_the_category( $id );
	$cat = array();
	if( $categories ) {
		foreach( $categories as $category ){
			$cat[] = $category->term_id;
		}
	}
	return $cat;
}

function catch_popup_tag_array($id){
	$tags = get_the_tags( $id );
	$tag_array = array();
	if( $tags ){
		foreach( $tags as $tag ){
			$tag_array[] = $tag->term_id;
		}
	}
	return $tag_array;
}

function catch_popup_get_children($id){
	$args = array(
		'post_parent' => $id,
		'post_type'   => 'page', 
		'numberposts' => -1,
		'post_status' => 'publish' 
	);
	$children = get_children( $args );
	$children_array = array();
	if( $children ){
		foreach( $children as $child ){
			$children_array[] = $child->ID;
		}
	}
	return $children_array;
}


add_action( 'wp_ajax_catch_popup_get_data', 'catch_popup_get_data' );
function catch_popup_get_data(){
	$data = array();
	$target = $_POST['target'];
	if( 'posts' === $target || 'pages' === $target ){
		$args = array(
			'numberposts' => -1,
			'post_type' => 'post'
		);
		if( 'pages' === $target ) {
			$args['post_type'] = 'page';
		}
		$posts = get_posts(
			$args
		);

		foreach($posts as $post){
			$temp          = array();
			$temp['id']    = $post->ID;
			$temp['title'] = $post->post_title;
			$data[] = $temp;
		}
	} elseif( 'categories' === $target ){
		$categories = get_categories();
		foreach($categories as $cat){
			$temp          = array();
			$temp['id']    = $cat->term_id;
			$temp['title'] = $cat->name;
			$data[] = $temp;
		}
	}elseif( 'tags' === $target ){
		$tags = get_tags();
		foreach($tags as $tag){
			$temp          = array();
			$temp['id']    = $tag->term_id;
			$temp['title'] = $tag->post_title;
			$data[] = $temp;
		}
	}
	echo json_encode($data);
	wp_die();
}