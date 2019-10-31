<?php
add_action('admin_enqueue_scripts', 'add_admin_scripts', 10, 1);
function add_admin_scripts($hook)
{
    global $post;
    if ($hook == 'post-new.php' || $hook == 'post.php') {
        if ('filmes' === $post->post_type) {
            wp_register_script('fields', plugins_url('../js/fields.js', __FILE__), array('jquery'), '1');
            wp_enqueue_script('fields');
            wp_register_script('media_library', plugins_url('../js/media_library.js', __FILE__), array('jquery'), '1');
            wp_enqueue_script('media_library');
            wp_register_script('save_post', plugins_url('../js/save_post.js', __FILE__), array('jquery'), '1');
            wp_enqueue_script('save_post');
        }
    }
}