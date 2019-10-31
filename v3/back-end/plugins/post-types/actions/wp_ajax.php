<?php
add_action('wp_ajax_post_types_get_image', 'post_types_get_image');
function post_types_get_image()
{
    if (isset($_GET['id'])) {
        $ids = $_GET['id'];
        foreach ($ids as $key => $id) {
            $img = wp_get_attachment_image($id, 'medium', false, array('class' => 'img-fluid'));
            if ($img) {
                $image[] = "<div class='col-4'>" . $img . "</div>";
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
        $transients = new Transient;
        $options_values = $transients->get();
        wp_send_json_success($options_values);
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_post_types_delete_errors', 'post_types_delete_errors');
function post_types_delete_errors()
{
    if (isset($_GET['id'])) {
        $transients = new Transient;
        $options_delete = $transients->delete();
        wp_send_json_success($options_delete);
    } else {
        wp_send_json_error();
    }
}