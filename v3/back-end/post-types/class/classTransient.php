<?php

class Transient
{
    public function __construct()
    {
        $this->post_ID = $_GET['id'];
        $this->current_user = wp_get_current_user();
    }

    private function db($type = 'get', $operation = 'like', $output = OBJECT)
    {
        global $wpdb;
        if ($type == 'get' && $operation == 'like') {
            $wild = '%';
            $find = "_transient_post-types-error-post-" . $this->post_ID . "-author-" . $this->current_user->ID;
            $like = $wild . $wpdb->esc_like($find) . $wild;
            $sql = $wpdb->prepare("SELECT * FROM $wpdb->options WHERE option_name LIKE %s", $like);
            return $wpdb->get_results($sql, $output);
        }
    }

    public function get()
    {
        $results = $this->db('get', 'like', OBJECT);
        $options_values = [];
        foreach ($results as $key => $result) {
            $response = unserialize($result->option_value);
            array_push($options_values, $response);
        }
        return $options_values;
    }

    public function delete()
    {
        $results = $this->db('get', 'like', OBJECT);
        $options_delete = [];
        foreach ($results as $key => $result) {
            $response = str_replace("_transient_", "", $result->option_name );
            $result = delete_transient($response);
            array_push($options_delete, $result);
        }
        return $options_delete;
    }
}