<?php
// functions.php - Clothing Shop Theme

// 1) Register 'clothing' custom post type
add_action('init', 'cs_register_clothing_cpt');
function cs_register_clothing_cpt() {
    $labels = array(
        'name' => 'Clothing',
        'singular_name' => 'Clothing Item',
        'add_new_item' => 'Add New Clothing Item',
        'edit_item' => 'Edit Clothing Item',
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array('title','editor','thumbnail','excerpt'),
        'menu_icon' => 'dashicons-cart',
        'rewrite' => array('slug' => 'shop'),
    );
    register_post_type('clothing', $args);
}

// 2) Enqueue stylesheet
add_action('wp_enqueue_scripts', 'cs_enqueue_assets');
function cs_enqueue_assets() {
    wp_enqueue_style('cs-main-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
}

// 3) Handle public submissions
add_action('admin_post_nopriv_cs_submit_item', 'cs_handle_public_submission');
add_action('admin_post_cs_submit_item', 'cs_handle_public_submission');

function cs_handle_public_submission() {
    if ( empty($_POST['cs_submit_nonce']) || ! wp_verify_nonce($_POST['cs_submit_nonce'], 'cs_submit_action') ) {
        wp_safe_redirect( add_query_arg('submitted','error', home_url('/') ) );
        exit;
    }

    // sanitize inputs
    $title = isset($_POST['item_title']) ? sanitize_text_field($_POST['item_title']) : '';
    $description = isset($_POST['item_description']) ? sanitize_textarea_field($_POST['item_description']) : '';
    $price = isset($_POST['item_price']) ? sanitize_text_field($_POST['item_price']) : '';
    $size = isset($_POST['item_size']) ? sanitize_text_field($_POST['item_size']) : '';
    $color = isset($_POST['item_color']) ? sanitize_text_field($_POST['item_color']) : '';
    $contact = isset($_POST['contact_email']) ? sanitize_email($_POST['contact_email']) : '';

    if ( empty($title) || empty($description) ) {
        wp_safe_redirect( add_query_arg('submitted','missing', home_url('/') ) );
        exit;
    }

    $post_id = wp_insert_post(array(
        'post_title' => $title,
        'post_content' => $description,
        'post_type' => 'clothing',
        'post_status' => 'pending',
    ));

    if ( is_wp_error($post_id) || ! $post_id ) {
        wp_safe_redirect( add_query_arg('submitted','error', home_url('/') ) );
        exit;
    }

    // save meta
    update_post_meta($post_id, 'price', $price);
    update_post_meta($post_id, 'size', $size);
    update_post_meta($post_id, 'color', $color);
    update_post_meta($post_id, 'contact_email', $contact);

    // handle multiple images
    if (!empty($_FILES['item_images']) && !empty($_FILES['item_images']['name'][0])) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        $files = $_FILES['item_images'];
        $image_ids = array();

        foreach ($files['name'] as $index => $name) {
            if (empty($name)) continue;

            $single = array(
                'name' => $files['name'][$index],
                'type' => $files['type'][$index],
                'tmp_name' => $files['tmp_name'][$index],
                'error' => $files['error'][$index],
                'size' => $files['size'][$index],
            );

            $backup = $_FILES;
            $_FILES = array('cs_single_image' => $single);
            $attach_id = media_handle_upload('cs_single_image', $post_id);
            $_FILES = $backup;

            if (! is_wp_error($attach_id)) {
                $image_ids[] = $attach_id;
            } else {
                error_log('Clothing image upload error: ' . $attach_id->get_error_message());
            }
        }

        if (!empty($image_ids)) {
            set_post_thumbnail($post_id, $image_ids[0]);
            update_post_meta($post_id, 'gallery_images', $image_ids);
        }
    }

    // notify admin
    $admin_email = get_option('admin_email');
    wp_mail($admin_email, 'New clothing item submitted', "A new clothing item titled '{$title}' was submitted (Post ID: {$post_id}).");

    wp_safe_redirect( add_query_arg('submitted','true', home_url('/') ) );
    exit;
}

// 4) Shortcode for submission messages
add_shortcode('cs_submission_message', 'cs_submission_message_shortcode');
function cs_submission_message_shortcode() {
    if (isset($_GET['submitted']) && $_GET['submitted'] === 'true') {
        return '<div class="cs-message">✅ Thank you! Your item is submitted and pending review.</div>';
    } elseif (isset($_GET['submitted']) && $_GET['submitted'] === 'missing') {
        return '<div class="cs-error">⚠️ Please fill required fields.</div>';
    } elseif (isset($_GET['submitted']) && $_GET['submitted'] === 'error') {
        return '<div class="cs-error">❌ An error occurred. Try again later.</div>';
    }
    return '';
}
