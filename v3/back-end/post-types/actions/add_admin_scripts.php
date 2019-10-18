<?php
function add_admin_scripts( $hook ) {
    global $post;
    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'filmes' === $post->post_type ) {
            wp_enqueue_script(  'fields', plugins_url( '../js/fields.js', __FILE__ ), array('jquery'), '1'  );
            wp_enqueue_script(  'media_library', plugins_url( '../js/media_library.js', __FILE__ ), array('jquery'), '1'  );
        }
    }
}
add_action( 'wp_ajax_post_types_get_image', 'post_types_get_image'   );
function post_types_get_image() {
    if(isset($_GET['id']) ){
        $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'post-types-preview-image' ) );
        $data = array(
            'image' => $image,
        );
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}