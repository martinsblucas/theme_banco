<?php


namespace App\Controllers;


class LocalizeScriptsController
{

    public function __construct()
    {

        add_action( 'wp_enqueue_scripts', [$this, 'localize_scripts'] );

    }

    public function localize_scripts()
    {

        global $wp_query;
        $args = array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'posts_per_page' => get_option('posts_per_page'),
            'wp_query' => $wp_query
        );

        wp_localize_script( 'banco-load-more', 'bancoloadmore', $args );

    }

}