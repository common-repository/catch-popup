<?php 

function catch_popup_block_assets() {
    // Scripts.
    wp_enqueue_script(
        'catch-popup-block-js', // Handle.
        plugins_url( 'catch-popup-block/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
        array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' ), // Dependencies, defined above.
        // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
        false // Enqueue the script in the footer.
    );

    // Styles.
    wp_enqueue_style(
        'catch-popup-block-editor-css', // Handle.
        plugins_url( 'catch-popup-block/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
        array( 'wp-edit-blocks' ) // Dependency to include the CSS after it.
        // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: filemtime — Gets file modification time.
    );
} // End function catch_guten_cgb_editor_assets().

// Hook: Editor assets.
add_action( 'enqueue_block_editor_assets', 'catch_popup_block_assets' );

// Hook the post rendering to the block
if ( function_exists( 'register_block_type' ) ) :
	register_block_type( 'catch-popup-block/catch-popup-block', array(
    	'attributes' => array(
    		'id' => array(
    			'type' => 'string',
    			'default'=> ''
    		),
    		'html_tag' => array(
        		'type' => 'string',
        		'default' => 'span'
    		),
    		'popup_class' => array(
        		'type' => 'string',
        		'default' => 'catch-popup-shortcode'
    		),
    		'content' => array(
        		'type' => 'string',
        		'default' => esc_html__( 'Click Me', 'catch-popup' )
    		),
    	),
        'render_callback' => 'catch_popup_block_render_shortcode',
    ) );
endif;

add_shortcode( 'catch-popup-block', 'catch_popup_block_render_shortcode' );
function catch_popup_block_render_shortcode( $atts ) {
    $instance['id']          = $atts['id'];
    $instance['html_tag']    = $atts['html_tag'];
    $instance['popup_class'] = $atts['popup_class'];
    $instance['content']     = $atts['content'];

    return catch_popup_shortcode($atts, $atts['content']);
}