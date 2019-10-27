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
require_once (__DIR__ . '/class/classTransient.php');
require_once (__DIR__ . '/class/classTaxonomy.php');
require_once (__DIR__ . '/actions/init.php');
require_once (__DIR__ . '/actions/register_meta.php');
require_once (__DIR__ . '/actions/add_meta_box.php');
require_once (__DIR__ . '/actions/save_post.php');
require_once (__DIR__ . '/actions/add_admin_scripts.php');
require_once (__DIR__ . '/actions/wp_ajax.php');