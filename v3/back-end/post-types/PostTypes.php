<?php
/**
 * Plugin Name: Post Types e metas
 * Description: Plugin de custom post types e custom metas
 * Author: Lucas Martins Barroso
 * Author URI: http://lucasmartinsbarroso.com.br/
 * Text Domain: post-types
 */
class PostTypes {
    static function install() {
    }
    static function deactivation() {
    }
    static function uninstall() {
    }
}
register_activation_hook( __FILE__, array( 'PostTypes', 'install' ) );
register_deactivation_hook( __FILE__, array( 'PostTypes', 'deactivation' ) );
register_uninstall_hook( __FILE__, array( 'PostTypes', 'uninstall' ) );
require_once (__DIR__ . '/class/classMeta.php');
require_once (__DIR__ . '/actions/types_init.php');
require_once (__DIR__ . '/actions/register_metas.php');
require_once (__DIR__ . '/actions/add_meta_boxes.php');
require_once (__DIR__ . '/actions/add_admin_scripts.php');
add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );