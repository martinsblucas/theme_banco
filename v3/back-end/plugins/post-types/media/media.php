<?php
function post_types_jpeg_quality() {
    return 80;
}
add_filter( 'jpeg_quality', 'post_types_jpeg_quality');
if (function_exists('add_image_size')) {
    add_image_size('foto_noticia', 510, 475, true);
    add_image_size('foto_filme_grande', 922, 300, true);
}