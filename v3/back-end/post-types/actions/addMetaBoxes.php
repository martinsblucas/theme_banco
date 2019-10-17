<?php
add_action('add_meta_boxes', 'add_meta_boxes');
function add_meta_boxes()
{
    Meta::add_meta_box('Ficha técnica', array('filmes'));
}
add_action('save_post', 'save_metas');
function save_metas($post_id)
{
    if (!current_user_can('edit_page', $post_id))
        return;
    Meta::save_metas('direcao');
    Meta::save_metas('producao');
}