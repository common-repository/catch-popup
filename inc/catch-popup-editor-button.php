<?php 

if ( !defined( 'ABSPATH' ) ) exit;

/* Custom Button to editor */
// hooks your functions into the correct filters
function catch_popup_add_mce_button() {
    // check user permissions
    if ( !current_user_can( 'edit_posts' ) &&  !current_user_can( 'edit_pages' ) ) {
               return;
       }
   // check if WYSIWYG is enabled
   if ( 'true' == get_user_option( 'rich_editing' ) ) {
       add_filter( 'mce_external_plugins', 'catch_popup_add_tinymce_plugin' );
       add_filter( 'mce_buttons', 'catch_popup_register_mce_button' );
       }
}
add_action('admin_head', 'catch_popup_add_mce_button');

// register new button in the editor
function catch_popup_register_mce_button( $buttons ) {
            array_push( $buttons, 'wdm_mce_button' );
            return $buttons;
}


// declare a script for the new button
// the script will insert the shortcode on the click event
function catch_popup_add_tinymce_plugin( $plugin_array ) {
          $plugin_array['wdm_mce_button'] = CATCH_POPUP_URL .'js/custom-menu-button.js';
          return $plugin_array;
}




foreach ( array('post.php','post-new.php') as $hook ) {
     add_action( "admin_head-$hook", 'catch_popup_admin_head' );
}

/**
 * Localize Script
 */
function catch_popup_admin_head() {
	$args = array(
		'post_type' => CATCH_POPUP_THEME_SLUG
	);
	$popup_themes = get_posts( $args, OBJECT );
	$themes       = array();
	foreach($popup_themes as $theme) {
		$text  = $theme->post_title;
		$value = $theme->ID;

		$themes[] = array(
			'text'  => $text,
			'value' => $value
		);
	}

	$args = array(
		'post_type' => CATCH_POPUP_SLUG
	);
	$popups     = get_posts( $args, OBJECT );
	$popup_list = array();
	foreach($popups as $popup) {
		$text  = $popup->post_title;
		$value = $popup->ID;

		$popup_list[] = array(
			'text'  => $text,
			'value' => $value
		);
	}
    ?>
<!-- TinyMCE Shortcode Plugin -->
<script type='text/javascript'>
var my_plugin = {
    'themes': '<?php echo json_encode( $themes ); ?>',
    'popups': '<?php echo json_encode( $popup_list ); ?>',
};
</script>
<!-- TinyMCE Shortcode Plugin -->
    <?php
}