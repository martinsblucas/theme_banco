<?php

$meta = new Meta();

$meta->register_meta('duracao', 'number');
$meta->register_meta('ano', 'number');
$meta->register_meta('formato', 'string');
$meta->register_meta('origem', 'string');
$meta->register_meta('cl-indicativa', 'number');
$meta->register_meta('direcao', 'string');
$meta->register_meta('co-direcao', 'string');
$meta->register_meta('roteiro', 'string');
$meta->register_meta('producao', 'string');
$meta->register_meta('co-producao', 'string');
$meta->register_meta('produtora-associada', 'string');
$meta->register_meta('producao-executiva', 'string');
$meta->register_meta('companhia-produtora', 'string');
$meta->register_meta('direcao-de-fotografia', 'string');
$meta->register_meta('fotografia', 'string');
$meta->register_meta('montagem', 'string');
$meta->register_meta('direcao-de-arte', 'string');
$meta->register_meta('som', 'string');
$meta->register_meta('musicas', 'string');
$meta->register_meta('edicao-de-som', 'string');
$meta->register_meta('trilha-sonora', 'string');
$meta->register_meta('figurino', 'string');
$meta->register_meta('design', 'string');
$meta->register_meta('maquiagem', 'string');
$meta->register_meta('correcao-de-cor', 'string');
$meta->register_meta('gravacao', 'string');
$meta->register_meta('camera', 'string');
$meta->register_meta('execucao-de-video-audio', 'string');
$meta->register_meta('implementacao-do-site', 'string');
$meta->register_meta('concessao-do-uso-da-cancao', 'string');
$meta->register_meta('contato', 'string');
$meta->register_meta('voz', 'string');
$meta->register_meta('curadoria', 'string');
$meta->register_meta('mixagem', 'string');
$meta->register_meta('efeitos-especiais', 'string');
$meta->register_meta('animador', 'string');
$meta->register_meta('elenco', 'string');
$meta->register_meta('principais-exibicoes', 'string');
$meta->register_meta('sd-foley', 'string');

$metaPost = new PostMeta;

$metaPost->register_meta('url', 'url');