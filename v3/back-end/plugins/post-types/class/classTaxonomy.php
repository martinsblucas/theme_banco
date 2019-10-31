<?php

class Taxonomy
{
    public function __construct()
    {
        add_action('init', array($this, 'registerTaxonomy'));
    }
    public function registerTaxonomy() {
        $labelsFiltros = array(
            'name' => _x( 'Filtros', 'taxonomy general name'),
            'singular_name' => _x( 'Filtro', 'taxonomy singular name' ),
            'search_items' => __( 'Procurar por filtros' ),
            'all_items' => __( 'Todos os filmes' ),
            'parent_item' => __( 'Filtro pai' ),
            'parent_item_colon' => __( 'FIltro pai:'),
            'edit_item' => __( 'Editar filtro'),
            'update_item' => __( 'Atualizar filtro'),
            'add_new_item' => __( 'Adicionar novo filtro'),
            'new_item_name' => __( 'Novo filtro'),
            'menu_name' => __( 'Filtros')
        );

        register_taxonomy( 'filtros', array( 'filmes' ), array(
            'hierarchical' => true,
            'labels' => $labelsFiltros,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'filtros' ),
            'show_in_rest' => true
        ) );

        $labelsTemas = array(
            'name' => _x( 'Temas', 'taxonomy general name'),
            'singular_name' => _x( 'Tema', 'taxonomy singular name'),
            'search_items' => __( 'Procurar por tema'),
            'all_items' => __( 'Todos os temas'),
            'parent_item' => __( 'Tema pai'),
            'parent_item_colon' => __( 'Tema pai:'),
            'edit_item' => __( 'Editar tema'),
            'update_item' => __( 'Atualizar tema'),
            'add_new_item' => __( 'Adicionar novo tema' ),
            'new_item_name' => __( 'Novo tema' ),
            'menu_name' => __( 'Temas' )
        );

        register_taxonomy( 'temas', array( 'filmes' ), array(
            'hierarchical' => true,
            'labels' => $labelsTemas,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'temas' ),
            'show_in_rest' => true
        ) );

        $labelsRacaEGenero = array(
            'name' => _x( 'Raça e gênero', 'taxonomy general name'),
            'singular_name' => _x( 'Raça e gênero', 'taxonomy singular name'),
            'search_items' => __( 'Procurar por raças e gêneros'),
            'all_items' => __( 'Todas as raças e gêneros'),
            'parent_item' => __( 'Categoria pai'),
            'parent_item_colon' => __( 'Categoria pai:' ),
            'edit_item' => __( 'Editar raça e gênero'),
            'update_item' => __( 'Atualizar raça e gênero'),
            'add_new_item' => __( 'Adicionar nova raça e gênero' ),
            'new_item_name' => __( 'Nova raça e gênero' ),
            'menu_name' => __( 'Raça e gênero' )
        );

        register_taxonomy( 'raca-e-genero', array( 'filmes' ), array(
            'hierarchical' => true,
            'labels' => $labelsRacaEGenero,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'raca-e-genero' ),
            'show_in_rest' => true
        ) );

        $labelGenero = array(
            'name' => _x( 'Gênero', 'taxonomy general name'),
            'singular_name' => _x( 'Gênero', 'taxonomy singular name'),
            'search_items' => __( 'Procurar por gênero'),
            'all_items' => __( 'Todas os gêneros'),
            'parent_item' => __( 'Categoria pai'),
            'parent_item_colon' => __( 'Categoria pai:' ),
            'edit_item' => __( 'Editar gênero'),
            'update_item' => __( 'Atualizar gênero'),
            'add_new_item' => __( 'Adicionar novo gênero' ),
            'new_item_name' => __( 'Novo gênero' ),
            'menu_name' => __( 'Gênero' )
        );

        register_taxonomy( 'genero', array( 'filmes' ), array(
            'hierarchical' => true,
            'labels' => $labelGenero,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'genero' ),
            'show_in_rest' => true
        ) );
    }
}