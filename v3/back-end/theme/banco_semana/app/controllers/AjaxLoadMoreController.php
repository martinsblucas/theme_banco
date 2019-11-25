<?php


namespace App\Controllers;

use App\Controllers\ArchiveController as AjaxController;

use App\View\CardsView as CardsView;


class AjaxLoadMoreController
{

    public function __construct()
    {

        add_action('wp_ajax_load_more', [$this, 'banco_de_obras_load_more']);
        add_action('wp_ajax_nopriv_load_more', [$this, 'banco_de_obras_load_more']);

    }

    public function banco_de_obras_load_more() {

        isset($_GET['post_type']) ? $post_type = $_GET['post_type'] : $post_type = get_post_types();
        isset($_GET['tax_query']) ? $tax_query = $_GET['tax_query'] : $tax_query = (object) [];
        isset($_GET['meta_query']) ? $meta_query = $_GET['meta_query'] : $meta_query = (object) [];
        isset($_GET['paged']) ? $paged = $_GET['paged'] : $paged = 1;
        isset($_GET['s']) ? $s = $_GET['s'] : $s = '';

        $tax_queries = (array) $tax_query;
        $meta_queries = (array) $meta_query;

        $args = [
            'post_type' => $post_type,
            'tax_query' => $tax_queries['queries'],
            'meta_query' => $meta_queries['queries'],
            's' => $s,
            'paged' => $paged,
            'orderby' => 'name',
            'order' => 'ASC'
        ];

        $newQuery = new \WP_Query($args);

        $controller = new AjaxController($newQuery);

        $controllerData = (array) $controller->data;
        $controllerPosts = $controllerData['posts'];
        $controllerMetas = $controllerData['metas'];

        $CardsView = new CardsView($controllerPosts, $controllerMetas, $paged, true);
        $views = (array) $CardsView->views;

        foreach ($views as $newQueryKey => $view) {

            $results[$newQueryKey] = $view;

        }

        $data = [
            'results' => $results
        ];

        wp_send_json_success($data);

    }

}