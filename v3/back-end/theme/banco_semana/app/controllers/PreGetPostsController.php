<?php


namespace App\Controllers;


class PreGetPostsController
{

    public function __construct()
    {

        add_action('pre_get_posts', array($this, 'add_action'));

    }

    public function add_action($query)
    {

        if (!is_admin()) {

            if (is_post_type_archive('filmes') && $query->is_main_query() or is_tax() && $query->is_main_query()) {

                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $query->set('posts_per_page', get_option('posts_per_page'));
                $query->set('paged', $paged);
                $query->set('order', 'ASC');
                $query->set('orderby', 'name');

            }

        }

    }

}