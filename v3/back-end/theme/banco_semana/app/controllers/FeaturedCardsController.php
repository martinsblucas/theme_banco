<?php


namespace App\Controllers;


class FeaturedCardsController
{

    private $wp_query;
    public $data;

    public function __construct() {

        $stickies = get_option( 'sticky_posts' );

        $this->wp_query = new \WP_Query(

            [
                'post_type' => 'post',
                'post__in' => $stickies,
                'ignore_sticky_posts' => 1,
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'ASC',
            ]

        );

        foreach ($this->wp_query->posts as $key => $post) {

            get_post_meta($post->ID, 'urls', true) ? $url = get_post_meta($post->ID, 'url', true) : $url = false;

            $this->data['posts'][$post->ID] = $post;
            $url ? $this->data['urls'][$post->ID] = $url[0] : $this->data['urls'][$post->ID] = get_permalink($post->ID);

        }

    }

}