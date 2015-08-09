<?php
/**
 * This file has the main shortcode functions
 */
if ( ! function_exists( 'pencislider_refresh_mce' ) ) {
	function pencislider_refresh_mce( $ver ) {
		$ver += 3;

		return $ver;
	}
}
// init process for button control
add_filter( 'tiny_mce_version', 'pencislider_refresh_mce' );

add_action( 'init', 'pencislider_pre_add_shortcode_buttons' );
if ( ! function_exists( 'pencislider_pre_add_shortcode_buttons' ) ) {
	function pencislider_pre_add_shortcode_buttons() {
		// Don't bother doing this stuff if the current user lacks permissions
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
			return;

		// Add only in Rich Editor mode
		if ( get_user_option( 'rich_editing' ) == 'true' ) {
			add_filter( "mce_external_plugins", "pencislider_pre_add_shortcodes_tinymce_plugin" );
			add_filter( 'mce_buttons', 'pencislider_pre_register_shortcode_buttons' );
		}
	}
}
if ( ! function_exists( 'pencislider_pre_register_shortcode_buttons' ) ) {
	function pencislider_pre_register_shortcode_buttons( $buttons ) {
		array_push( $buttons, 'pencislider_pre_shortcodes_button' );

		return $buttons;
	}
}
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
if ( ! function_exists( 'pencislider_pre_add_shortcodes_tinymce_plugin' ) ) {
	function pencislider_pre_add_shortcodes_tinymce_plugin( $plugin_array ) {
		$plugin_array['pencislider_pre_shortcodes_button'] = plugin_dir_url( __FILE__ ) . '/js/mce.js';

		return $plugin_array;
	}
}