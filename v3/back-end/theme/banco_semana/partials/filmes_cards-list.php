<?php

use App\Controllers\ArchiveController as Controller;
use App\View\CardsView as View;

$controller = new Controller;
$data = $controller->data;

array_key_exists('metas', $data) ? $metas = $data['metas'] : $metas = [];
array_key_exists('paged', $data) ? $paged = $data['paged'] : $paged = null;

if(array_key_exists('posts', $data)) {
    $view = new View($data['posts'], $metas, $paged);
    $views = (array)$view->views;
}

?>

<section class="row filmes-archive">

    <?php if(array_key_exists('posts', $data)) { ?>

    <div class="col-12 filmes-archive-header">
        <h3>Filmes (<?= $data['total']; ?>)</h3>
    </div>

    <div class="card-group-banco row">

    <?php

    foreach ($views as $view) {
        echo $view;
     }

    ?>

    </div>

    <?php } else { get_template_part('partials/content', 'none'); } ?>

</section>