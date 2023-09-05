<?php

/*
Plugin Name: Verus Vue Plugin
Description: This plugin adds an admin dashboard view.
Version: 1.0
Author: Ahmed Shah
*/

function my_admin_menu_page() {
    add_menu_page(
        'Verus Data',  // Page title
        'Staking Rewards', // Menu title
        'manage_options',  // Capability required to access
        'vue-admin-page',   // Menu slug
        'render_content', // Callback function to render content
        //'dashicons-admin-plugins', // Icon URL or dashicon class
        20, // Menu position
    );
}
add_action('admin_menu', 'my_admin_menu_page');


function render_content() {
    ?>
        <h1>Verus Blocks</h1>
        <div id="app">
        </div>
<?php
}

function render_shortcode() {
    ?>
        <h1>Verus Blocks</h1>
        <div id="app">
        </div>
<?php
}

add_shortcode('vue_shortcode', 'render_shortcode');


function admin_enqueue() {

    wp_enqueue_script('admin-script', plugins_url('/verusapi/dist/assets/index-da85dad1.js', __FILE__), array(), null, true);
    wp_enqueue_style('admin-style', plugins_url('/verusapi/dist/assets/index-37970cf5.css', __FILE__));

    wp_localize_script(
        'app-script',
        'vue-params',
        array(
           'ajax_url' => admin_url( 'vue-admin-page.php' ),
           'nonce'    => wp_create_nonce( 'vue_nonce' )
        )
     );
}

function enqueue_vue_script() {

    wp_enqueue_script('fontend-script', plugins_url('/verusapi/dist/assets/index-da85dad1.js', __FILE__), array(), null, true);
    wp_enqueue_style('frontendd-style', plugins_url('/verusapi/dist/assets/index-37970cf5.css', __FILE__));
}

add_action('admin_enqueue_scripts', 'admin_enqueue');
add_action('wp_enqueue_scripts', 'enqueue_vue_script');