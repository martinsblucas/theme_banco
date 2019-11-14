<?php
namespace Controllers;
include (__DIR__.'/../models/Filmes.php');
use Models\Filmes as Model;
class ArchiveFilmes
{
    private $diretores;
    private $filtros;
    private $temas;
    private $raca_e_genero;
    private $genero;
    public function __construct()
    {
        $diretores = new Model;
        $this->diretores = $diretores->getDiretores();
        $filtros = new Model;
        $this->filtros = $filtros->getFiltros();
        $temas = new Model;
        $this->temas = $temas->getTemas();
        $racao_e_genero = new Model;
        $this->raca_e_genero = $racao_e_genero->getRacaEGenero();
        $genero = new Model;
        $this->genero = $genero->getGenero();
    }
    public function getFilmesSearchData()
    {
        $data = [];
        if($this->diretores->have_posts()) {
            $data['diretores'] = $this->diretores;
        }
        if (!empty($this->filtros)) {
            $data['filtros'] = $this->filtros;
        }
        if (!empty($this->temas)) {
            $data['temas'] = $this->temas;
        }
        if (!empty($this->raca_e_genero)) {
            $data['raca_e_genero'] = $this->raca_e_genero;
        }
        if (!empty($this->genero)) {
            $data['genero'] = $this->genero;
        }
        return $data;
    }
}