<?php
add_action('save_post', 'save_metas');
function save_metas($post_id)
{
    if (!current_user_can('edit_page', $post_id))
        return;
    $meta = new Meta();
    $meta->save_metas('direcao', 'internal_link');
    $meta->save_metas('producao');
    $meta->save_metas('foto_diretor', 'image');
    $meta->save_metas('foto_produtor', 'image');
}