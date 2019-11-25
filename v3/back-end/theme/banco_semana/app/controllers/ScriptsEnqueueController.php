<?php


namespace App\Controllers;


class ScriptsEnqueueController
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    private function register_scripts()
    {

        wp_register_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap/bootstrap.min.js', ['jquery'], 1, true);
        wp_register_script('popper', get_template_directory_uri() . '/assets/js/popper/popper.min.js', ['jquery'], 1, true);
        wp_register_script('banco-menu', get_template_directory_uri() . '/assets/js/menu.js', ['jquery'], 1, true);
        wp_register_script('banco-load-more', get_template_directory_uri() . '/assets/js/banco_load_more.js', ['jquery'], 1, true);

    }

    public function enqueue_scripts()
    {
        $this->register_scripts();
        wp_enqueue_script('bootstrap');
        wp_enqueue_script('popper');
        wp_enqueue_script('banco-menu');
        wp_enqueue_script('banco-load-more');
    }
}