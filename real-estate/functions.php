<?php
// --- Real Estate Theme functions.php (safe test version) ---

// 1. Setup theme support
if ( ! function_exists('ret_setup_theme') ) :
    function ret_setup_theme() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array('search-form', 'gallery', 'caption'));
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'real-estate-theme'),
        ));
    }
    add_action('after_setup_theme', 'ret_setup_theme');
endif;

// 2. Register Property custom post type
function ret_register_property_cpt() {
    $labels = array(
        'name' => 'Properties',
        'singular_name' => 'Property'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'property'),
        'supports' => array('title','editor','thumbnail','custom-fields','excerpt'),
        'show_in_rest' => true,
    );
    register_post_type('property', $args);
}
add_action('init', 'ret_register_property_cpt');
