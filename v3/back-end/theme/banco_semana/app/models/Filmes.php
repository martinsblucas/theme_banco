<?php


namespace Models;


class Filmes
{
    public function getDiretores()
    {
        $diretores = new \WP_Query([
            'post_type' => 'diretores',
            'orderby' => 'name',
            'order' => 'asc',
            'posts_per_page' => -1
        ]);
        wp_reset_postdata();
        return $diretores;
    }
    public function getFiltros()
    {
        return get_terms([
            'taxonomy' => 'filtros'
        ]);
    }
    public function getTemas()
    {
        return get_terms([
            'taxonomy' => 'temas'
        ]);
    }
    public function getRacaEGenero()
    {
        return get_terms([
            'taxonomy' => 'raca-e-genero'
        ]);
    }
    public function getGenero()
    {
        return get_terms([
            'taxonomy' => 'genero'
        ]);
    }
}