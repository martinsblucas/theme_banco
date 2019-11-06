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
            $this->meta_query_array[0] = ['relation' => 'AND'];
            $this->direcao ? $this->meta_query_array[1] = [ 'key' => 'direcao', 'value' => '"' . $this->direcao . '"', 'compare' => 'LIKE' ] : null;
            $query->set( 'meta_query', $this->meta_query_array );
            $this->tax_query_array[0] = ['relation' => 'OR'];
            $this->filtros ? $this->tax_query_array[1] = [ 'taxonomy' => 'filtros', 'field' => 'term_id', 'terms' => $this->filtros ] : null ;
            $query->set( 'tax_query', $this->tax_query_array);
        }
    }
}