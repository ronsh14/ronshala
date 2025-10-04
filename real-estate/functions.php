<?php
function real_estate_enqueue_scripts() {
    wp_enqueue_style('real-estate-style', get_stylesheet_uri());
    // Add Google Fonts or other styles/scripts here if needed
}
add_action('wp_enqueue_scripts', 'real_estate_enqueue_scripts');

function real_estate_setup() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'real-estate-theme'),
    ));
}
add_action('after_setup_theme', 'real_estate_setup');

function real_estate_custom_post_type() {
    $labels = array(
        'name' => __('Properties'),
        'singular_name' => __('Property'),
        'add_new' => __('Add New Property'),
        'add_new_item' => __('Add New Property'),
        'edit_item' => __('Edit Property'),
        'new_item' => __('New Property'),
        'view_item' => __('View Property'),
        'search_items' => __('Search Properties'),
        'not_found' => __('No Properties found'),
        'not_found_in_trash' => __('No Properties found in Trash'),
        'all_items' => __('All Properties'),
        'menu_name' => __('Properties'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'properties'),
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon' => 'dashicons-admin-home',
    );
    
    register_post_type('property', $args);
}
add_action('init', 'real_estate_custom_post_type');
