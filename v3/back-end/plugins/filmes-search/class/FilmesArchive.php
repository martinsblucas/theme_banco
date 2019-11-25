<?php


class FilmesArchive
{
    public function __construct()
    {
        add_action('pre_get_posts', array($this, 'add_action'));
    }
    public function add_action ($query) {

        if($query->is_archive('filmes') && $query->is_main_query() && !is_admin()) {
            $this->direcao = get_query_var('direcao', FALSE);
            $this->filtros = get_query_var('filtros_ids', FALSE);
            $this->temas = get_query_var('temas_ids', FALSE);
            $this->raca_e_genero = get_query_var('raca-e-genero_ids', FALSE);
            $this->genero = get_query_var('genero_ids', FALSE);
            $this->meta_query_array[0] = ['relation' => 'AND'];
            if($this->direcao) {
                $this->meta_query_array[1] = [
                    'key' => 'direcao',
                    'value' => $this->direcao,
                    'compare' => 'LIKE'
                ];
            }
            $this->tax_query_array[0] = ['relation' => 'AND'];
            if($this->filtros) {
                $this->tax_query_array[1] = [
                    'taxonomy' => 'filtros',
                    'field' => 'term_id',
                    'terms' => $this->filtros,
                    'operator' => 'AND'
                ];
            }
            if($this->temas) {
                $this->tax_query_array[2] = [
                    'taxonomy' => 'temas',
                    'field' => 'term_id',
                    'terms' => $this->temas,
                    'operator' => 'AND'
                ];
            }
            if($this->raca_e_genero) {
                $this->tax_query_array[3] = [
                    'taxonomy' => 'raca-e-genero',
                    'field' => 'term_id',
                    'terms' => $this->raca_e_genero,
                    'operator' => 'AND'
                ];
            }
            if($this->genero) {
                $this->tax_query_array[4] = [
                    'taxonomy' => 'genero',
                    'field' => 'term_id',
                    'terms' => $this->genero,
                    'operator' => 'AND'
                ];
            }
            $query->set( 'meta_query', $this->meta_query_array );
            $query->set( 'tax_query', $this->tax_query_array);
        }
    }
}