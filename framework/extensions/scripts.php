<?php
/**
 * Scripts
 * WordPress will add these scripts to the theme
 *
 * You'll notice this file has the same file name as the scripts file in the parent
 * Inti Foundation. This causes this child theme version to override the parent theme
 * version in its entirety. Because of this, we redeclare the parent theme functions here.
 *
 * An alternative way to do this is to name the child theme scripts file 'child-scripts.php',
 * include it in functions.php and then deregister any parent theme scripts you don't need.
 *
 * @package Inti
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/wp_register_script
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @see wp_register_script
 * @see wp_enqueue_script
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

add_action('wp_enqueue_scripts', 'inti_register_scripts', 1);
add_action('wp_enqueue_scripts', 'inti_enqueue_scripts');
 
function inti_register_scripts() {
	// register scripts
	wp_register_script('modernizr-js', get_template_directory_uri() . '/library/js/modernizr-min.js', array(), filemtime(get_template_directory() . '/library/js/modernizr-min.js'), false);
	wp_register_script('foundation-js', get_template_directory_uri() . '/library/js/foundation-min.js', array(), filemtime(get_template_directory() . '/library/js/foundation-min.js'), true);
	wp_register_script('what-input-js', get_template_directory_uri() . '/library/js/what-input-min.js', array(), filemtime(get_template_directory() . '/library/js/what-input-min.js'), true);
	wp_register_script('toastr-js', get_template_directory_uri() . '/library/js/toastr-min.js', array(), filemtime(get_template_directory() . '/library/js/toastr-min.js'), true);
	wp_register_script('slick-js', get_template_directory_uri() . '/library/js/slick-min.js', array(), filemtime(get_template_directory() . '/library/js/slick-min.js'), true);
	wp_register_script('flexverticalcenter-js', get_template_directory_uri() . '/library/js/jquery.flexverticalcenter-min.js', array(), filemtime(get_template_directory() . '/library/js/jquery.flexverticalcenter-min.js'), true);
	wp_register_script('motion-ui-js', get_template_directory_uri() . '/library/js/motion-ui-min.js', array(), filemtime(get_template_directory() . '/library/js/motion-ui-min.js'), true);
	wp_register_script('jquery-cookie-js', get_template_directory_uri() . '/library/js/jquery.cookie-min.js', array(), filemtime(get_template_directory() . '/library/js/jquery.cookie-min.js'), true);
	wp_register_script('inti-js', get_template_directory_uri() . '/library/js/inti-min.js', array(), filemtime(get_template_directory() . '/library/js/inti-min.js'), true);

}

function inti_enqueue_scripts() {
	if ( !is_admin() ) { 
		// enqueue scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('modernizr-js');
		wp_enqueue_script('foundation-js');
		wp_enqueue_script('what-input-js');
		wp_enqueue_script('toastr-js');
		wp_enqueue_script('slick-js');
		wp_enqueue_script('flexverticalcenter-js');
		wp_enqueue_script('motion-ui-js');
		wp_enqueue_script('jquery-cookie-js');
		wp_enqueue_script('inti-js');

		// comment reply script for threaded comments
		if ( is_singular() && comments_open() && get_option('thread_comments') ) {
			wp_enqueue_script('comment-reply'); 
		}
	}
}

add_action('wp_enqueue_scripts', 'child_register_scripts', 1);
add_action('wp_enqueue_scripts', 'child_enqueue_scripts');
 
function child_register_scripts() {
	wp_register_script('inti-child-js', get_stylesheet_directory_uri() . '/library/js/inti-child-min.js', array(), filemtime(get_stylesheet_directory() . '/library/js/inti-child-min.js'), true);

}

function child_enqueue_scripts() {
	if ( !is_admin() ) { 
		// enqueued scripts from parent...
		// wp_enqueue_script('jquery');
		// wp_enqueue_script('modernizr-js');
		// wp_enqueue_script('foundation-js');
		// wp_enqueue_script('what-input-js');
		// wp_enqueue_script('toastr-js');
		// wp_enqueue_script('slick-js');
		// wp_enqueue_script('flexverticalcenter-js');
		// wp_enqueue_script('motion-ui-js');
		// wp_enqueue_script('jquery-cookie-js');
		// wp_enqueue_script('inti-js');

		// enqueue scripts for child
		wp_enqueue_script('inti-child-js');

		// comment reply script for threaded comments
		if ( is_singular() && comments_open() && get_option('thread_comments') ) {
			wp_enqueue_script('comment-reply'); 
		}
	}
}