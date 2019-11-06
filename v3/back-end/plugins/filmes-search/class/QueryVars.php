<?php


class QueryVars
{
    public function __construct(array $vars)
    {
        foreach ($vars as $key => $var) {
            $this->vars[$key] = $var;
        }
        return $this->vars;
    }
    public function get_query_vars($vars) {
        foreach ($this->vars as $key => $var) {
            $vars[] .= $var;
        }
        return $vars;
    }
    public function add_filter() {
        add_filter( 'query_vars', array($this, 'get_query_vars') );
    }
}