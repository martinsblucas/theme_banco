<?php
add_action('add_meta_boxes', 'add_meta_boxes');
function add_meta_boxes()
{
    add_meta_box(
        'ficha-tecnica',
        __('Ficha Técnica', 'post-types'),
        'meta_box_inner',
        array('filmes')
    );
}
function meta_box_inner ($post) {
    if (!current_user_can('edit_page', $post))
        return;
    $meta = new Meta();
    $meta->meta_box_inner($post);
}