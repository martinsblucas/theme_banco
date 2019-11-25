<?php


use App\Controllers\FeaturedCardsController as Controller;

$controller = new Controller;
$data = $controller->data;

?>

<section class="row capa">
    <div class="col-12 capa-header">
        <h3>Explore nosso acervo</h3>
    </div>
    <div class="col-12 capa-body">
        <div class="card-group-banco row">

            <?php foreach ($data['posts'] as $key => $post) { ?>

            <article class="col-12 col-sm-6 col-lg-4">
                <div class="card card-banco card-banco">
                    <a href="<?= $data['urls'][$post->ID] ?>" class="card-link">
                        <img class="card-img" src="<?= get_the_post_thumbnail_url($post->ID, 'foto_noticia'); ?>">
                        <div class="card-footer">
                            <h4 class="card-title">
                                <?= the_title(); ?>
                            </h4>
                            <div class="card-text">
                                <?= the_excerpt(); ?>
                            </div>
                            <div class="card-btn btn btn-banco btn-banco-primary">
                                Buscar
                            </div>
                        </div>
                    </a>
                </div>
            </article>

            <?php } ?>

        </div>
    </div>
</section>