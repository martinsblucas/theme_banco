<?php
add_action('admin_enqueue_scripts', 'add_admin_scripts', 10, 1);
function add_admin_scripts($hook)
{
    global $post;
    if ($hook == 'post-new.php' || $hook == 'post.php') {
        if ('filmes' === $post->post_type) {
            wp_enqueue_script('fields', plugins_url('../js/fields.js', __FILE__), array('jquery'), '1');
            wp_enqueue_script('media_library', plugins_url('../js/media_library.js', __FILE__), array('jquery'), '1');
            wp_register_script('save_post', plugins_url('../js/save_post.js', __FILE__), array('jquery'), '1');
            wp_enqueue_script('save_post');
        }
    }
}

add_action('wp_ajax_post_types_get_image', 'post_types_get_image');
function post_types_get_image()
{
    if (isset($_GET['id'])) {
        $ids = $_GET['id'];
        foreach ($ids as $key => $id) {
            $img = wp_get_attachment_image($id, 'medium', false, array('class' => 'img-fluid'));
            if ($img) {
                $image[] = "<div class='col-2'>" . $img . "</div>";
            }
        }
        $data = array(
            'image' => $image,
        );
        wp_send_json_success($data);
    } else {
        wp_send_json_error();
    }
}

add_action('wp_ajax_post_types_get_errors', 'post_types_get_errors');
function post_types_get_errors()
{
    if (isset($_GET['id'])) {
        $post_id = $_GET['id'];
        $current_user = wp_get_current_user();
        $author = $current_user->ID;
        $errors = get_transient('post-types-error-post-'.$post_id.'-author-'.$author);
        $data = array(
            $errors
        );
        wp_send_json_success($data);
    } else {
        wp_send_json_error();
    }
}

add_action('wp_ajax_post_types_delete_errors', 'post_types_delete_errors');
function post_types_delete_errors()
{
    if (isset($_GET['id'])) {
        $post_id = $_GET['id'];
        $current_user = wp_get_current_user();
        $author = $current_user->ID;
        delete_transient('post-types-error-post-'.$post_id.'-author-'.$author);
        $data = array(
            true
        );
        wp_send_json_success($data);
    }
}