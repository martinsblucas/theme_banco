<?php


namespace App\Controllers;

class ImgSizesController
{

    public function __construct()
    {
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'foto_noticia', 510, 475, true );
        add_image_size( 'foto_filme_grande', 922, 300, true );
    }

}