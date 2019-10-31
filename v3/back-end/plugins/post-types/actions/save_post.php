<?php
add_action('save_post', 'save_metas');
function save_metas($post_id)
{
    if (!current_user_can('edit_page', $post_id))
        return;
    $meta = new Meta();
    $meta->save_metas('duracao', 'number');
    $meta->save_metas('ano', 'number');
    $meta->save_metas('formato');
    $meta->save_metas('origem');
    $meta->save_metas('cl-indicativa', 'number');
    $meta->save_metas('direcao', 'internal_link');
    $meta->save_metas('co-direcao');
    $meta->save_metas('roteiro');
    $meta->save_metas('producao');
    $meta->save_metas('co-producao');
    $meta->save_metas('produtora-associada');
    $meta->save_metas('producao-executiva');
    $meta->save_metas('companhia-produtora');
    $meta->save_metas('direcao-de-fotografia');
    $meta->save_metas('fotografia');
    $meta->save_metas('montagem');
    $meta->save_metas('direcao-de-arte');
    $meta->save_metas('som');
    $meta->save_metas('musicas');
    $meta->save_metas('edicao-de-som');
    $meta->save_metas('trilha-sonora');
    $meta->save_metas('figurino');
    $meta->save_metas('design');
    $meta->save_metas('maquiagem');
    $meta->save_metas('correcao-de-cor');
    $meta->save_metas('gravacao');
    $meta->save_metas('camera');
    $meta->save_metas('execucao-de-video-audio');
    $meta->save_metas('implementacao-do-site');
    $meta->save_metas('concessao-do-uso-da-cancao');
    $meta->save_metas('contato');
    $meta->save_metas('voz');
    $meta->save_metas('curadoria');
    $meta->save_metas('mixagem');
    $meta->save_metas('efeitos-especiais');
    $meta->save_metas('animador');
    $meta->save_metas('elenco');
    $meta->save_metas('principais-exibicoes');
    $meta->save_metas('sd-foley');
}