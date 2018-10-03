<?php
/**
 * Plugin Name: WP JS Plugin Starter
 * Plugin URI: https://github.com/youknowriad/wp-js-plugin-starter
 * Description: Just another WordPress plugin starter
 * Version: 1.0.0
 * Author: Riad Benguella
 *
 * @package wp-js-plugin-starter
 */

 /**
 * Retrieves a URL to a file in the plugin's directory.
 *
 * @param  string $path Relative path of the desired file.
 *
 * @return string       Fully qualified URL pointing to the desired file.
 *
 * @since 1.0.0
 */
function wp_js_plugin_starter_url( $path ) {
	return plugins_url( $path, __FILE__ );
}

/**
 * Registers the plugin's block.
 *
 * @since 1.0.0
 */
function wp_js_plugin_starter_register_block() {
	wp_register_script(
		'wp-js-plugin-starter',
		wp_js_plugin_starter_url( 'dist/index.js' ),
		array( 'wp-element' )
	);

	wp_register_style(
        'wp-js-plugin-starter',
        wp_js_plugin_starter_url( 'src/style.css'),
        array(),
        filemtime( plugin_dir_path( __FILE__ ) . 'src/style.css' )
    );

	register_block_type( 'wp-js-plugin-starter/post-author-block', array(
			'editor_script' => 'wp-js-plugin-starter',
			'render_callback' => 'my_plugin_render_block_post_author',
			'style' => 'wp-js-plugin-starter'
	) );
}

/**
 * Trigger the block registration on init.
 */
add_action( 'init', 'wp_js_plugin_starter_register_block' );

function my_plugin_render_block_post_author( $attributes, $content ) {
	$post = get_post();
	$author = new WP_User($post->post_author);
    return sprintf(
		'<div class="wp-block-wp-js-plugin-starter-post-author-block">'.
		'%2$s'.
		'<p>%1$s</p>'.
		'</div>',
		esc_html( $author->display_name ),
		get_avatar($author->ID)
    );
}

