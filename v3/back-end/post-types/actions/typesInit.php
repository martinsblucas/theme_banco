<?php
add_action('init', 'registerFimes');
function registerFimes()
{
    $labels = array(
        'name' => _x( 'Filmes', 'post type general name', 'post-types' ),
        'singular_name' => _x( 'Filme', 'post type singular name', 'post-types' ),
        'menu_name' => _x( 'Filmes', 'admin menu', 'post-types' ),
        'name_admin_bar' => _x( 'Filmes', 'add new on admin bar', 'post-types' ),
        'add_new' => _x( 'Adicionar filme', 'text', 'post-types' ),
        'add_new_item' => __( 'Adicionar novo filme', 'post-types' ),
        'new_item' => __( 'Novo filme', 'post-types' ),
        'edit_item' => __( 'Editar filme', 'post-types' ),
        'view_item' => __( 'Ver filme', 'post-types' ),
        'all_items' => __( 'Todos os filmes', 'post-types' ),
        'search_items' => __( 'Pesquisar filmes', 'post-types' ),
        'parent_item_colon' => __( 'Filmes pais', 'post-types' ),
        'not_found' => __('Filme não encontrado', 'post-types' ),
        'not_found_in_trash' => __( 'Nenhum filme na lixeira', 'post-types' )
    );
    $args = array(
        'labels' => $labels,
        'description' => __( 'Fichas completas dos filmes', 'post-types' ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'filmes'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 4,
        'menu_icon' => null,
        'supports' => array('editor', 'thumbnail', 'title'),
        'show_in_rest' => true
    );
    register_post_type('filmes', $args);
}