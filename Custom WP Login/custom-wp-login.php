<?php

/**
   Plugin Name: Custom WP Login
   Version: 0.1
   Author: Teo Vala
   License: GPL2+
   Text Domain: cwpl
*/

add_action('login_enqueue_scripts', 'cwpl_login_stylesheet');

function cwpl_login_stylesheet() {
    // Load stylesheet
    wp_enqueue_style('cwpl-custom-stylesheet', plugin_dir_url(__FILE__) . 'login-styles.css');
}

add_filter('login_errors', 'cwpl_error_message');
function cwpl_error_message() {
    // Return custom error message
    return 'Well, that was not it!';
}

add_action('login_head', 'cwpl_remove_shake');
function cwpl_remove_shake(){
    remove_action( 'login_footer', 'wp_shake_js', 12 );
}