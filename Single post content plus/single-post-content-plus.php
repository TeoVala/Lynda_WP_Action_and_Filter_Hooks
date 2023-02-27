<?php

/** 
 * Plugin Name: Single Post Content Plus
 * Description: Adds a sidebar/widget aka to single posts.
 * Version: 0.1.0
 * Author: Me :)
 * Author URI: https://google.gr
 * Text Domain: spcp
 * License: GPL-2.0+
 * Github Plugin URI: :)
 *
 */

//If this file is called directly, abort

if (!defined('ABSPATH')){
    die;
}

add_action('wp_enqueue_scripts', 'spcp_custom_stylesheet');

function spcp_custom_stylesheet() {

    // Added this filter so users can disable styles if they want
    if (apply_filters('spcp_load_styles', true)) {

        // Load stylesheet
        wp_enqueue_style('spcp_custom_stylesheet', plugin_dir_url(__FILE__) . 'spcp-styles.css');
    }
}

// This removes the styles
//add_filter('spcp_load_styles', '__return_false');

add_action( 'widgets_init', 'spcp_register_sidebar');

function spcp_register_sidebar() {
    register_sidebar(array(
        'name'          => __('Post Content Plus', 'spcp'),
        'id'            => 'spcp-sidebar',
        'description'   => __('Widgets in this area display on single posts', 'spcp'),
        'before_widget' => '<div class="widget spcp-sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle spcp-title">',
        'after_title' => '</h2>',
    ));
}

add_filter( 'the_content', 'spcp_diplay_sidebar');
function spcp_diplay_sidebar( $content ) {

    if (is_single() && is_active_sidebar('spcp-sidebar') && is_main_query()){
        dynamic_sidebar('spcp-sidebar');
    }

    return $content;
}