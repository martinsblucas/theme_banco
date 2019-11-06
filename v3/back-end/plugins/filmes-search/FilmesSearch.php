<?php
/**
 * Plugin Name: Pesquisa de filmes
 * Description: Personalização da pesquisa por filmes
 * Author: Lucas Martins Barroso
 * Author URI: http://lucasmartinsbarroso.com.br/
 * Text Domain: post-types
 */
class FilmesSearch {
    static function install() {
    }
    static function deactivation() {
    }
    static function uninstall() {
    }
}
register_activation_hook( __FILE__, array( 'FilmesSearch', 'install' ) );
register_deactivation_hook( __FILE__, array( 'FilmesSearch', 'deactivation' ) );
register_uninstall_hook( __FILE__, array( 'FilmesSearch', 'uninstall' ) );
require_once (__DIR__ . '/class/QueryVars.php');
require_once (__DIR__ . '/class/FilmesArchive.php');
require_once (__DIR__ . '/actions/add_action.php');
require_once (__DIR__ . '/filters/query_vars.php');