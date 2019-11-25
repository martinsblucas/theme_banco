<?php


namespace App\Controllers;


class ArchiveController
{


    private $wp_query;

    public $data;

    public function __construct($custom_wp_query = '') {

        global $wp_query;

        $custom_wp_query ? $this->wp_query = $custom_wp_query : $this->wp_query = $wp_query;

        $this->data['total'] = $this->wp_query->found_posts;

        foreach ($this->wp_query->posts as $key => $post) {

            $this->data['posts'][$key] = $post;

            if(get_post_meta($post->ID, 'direcao', true)) {
                $direcaoArrIds[$post->ID] = get_post_meta($post->ID, 'direcao', true);
                foreach ($direcaoArrIds[$post->ID] as $direcaoPost) {
                    $direcaoArrNames[$post->ID][] = get_the_title($direcaoPost);
                }
                $this->data['metas']['direcao'][$post->ID] = [
                    'label' => 'Direção',
                    'meta' => implode(',', $direcaoArrNames[$post->ID])
                ];
            };

            if(get_post_meta($post->ID, 'duracao', true)) {
                $this->data['metas']['duracao'][$post->ID] = [
                    'label' => 'Duração',
                    'meta' => implode(',', get_post_meta($post->ID, 'duracao', true))
                ];
            };

            if(get_post_meta($post->ID, 'ano', true)) {
                $this->data['metas']['ano'][$post->ID] = [
                    'label' => 'Ano',
                    'meta' => implode(',', get_post_meta($post->ID, 'ano', true))
                ];
            };
            if(get_post_meta($post->ID, 'origem', true)) {
                $this->data['metas']['origem'][$post->ID] = [
                    'label' => 'Origem',
                    'meta' => implode(',', get_post_meta($post->ID, 'origem', true))
                ];
            };

            array_key_exists('paged', $this->wp_query->query) ? $this->data['paged'] = $this->wp_query->query['paged'] : $this->data['paged'] = 1;

            wp_reset_postdata();

        }


    }


}