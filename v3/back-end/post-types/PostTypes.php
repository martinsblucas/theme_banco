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
require_once (__DIR__ . '/actions/typesInit.php');
require_once (__DIR__ . '/actions/registerMetas.php');
require_once (__DIR__ . '/actions/addMetaBoxes.php');
add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );
function add_admin_scripts( $hook ) {
    global $post;
    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'filmes' === $post->post_type ) {
            wp_enqueue_script(  'myscript', plugins_url( 'js/fichaTecnica.js', __FILE__ ) );
        }
    }
}