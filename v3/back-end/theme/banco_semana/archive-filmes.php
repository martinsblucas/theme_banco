<?php get_header();
global $wp_query;
include (APP_DIR . 'controllers/ArchiveFilmes.php');
use Controllers\ArchiveFilmes as Controller;
$posts = $wp_query->posts;
$totalPosts = $wp_query->post_count;
$controller = new Controller;
$data = $controller->getFilmesSearchData(); ?>
<form method="get" action="<?= get_post_type_archive_link('filmes'); ?>">
<?php if(key_exists('diretores', $data)) { ?>
    <input type="text" name="s" value="<?= get_search_query(); ?>" placeholder="Título do filme ou trecho da sinopse">
    <br>
    <label for="direcao">Diretor</label>
    <select name="direcao" id="direcao">
        <option value=""></option>
        <?php while($data['diretores']->have_posts()) { ?>
            <?php $data['diretores']->the_post(); ?>
            <option value="<?= the_ID(); ?>" <?php echo get_the_ID() == get_query_var( 'direcao', FALSE ) ? 'selected' : null ?>><?php echo the_title(); ?></option>
        <?php } ?>
    </select>
<?php } ?>
<?php if(!empty($data['filtros'])) { ?>
    <h6>Filtros</h6>
    <?php foreach ($data['filtros'] as $key => $filtro) { ?>
    <div>
        <input
            type="checkbox"
            id="<?php echo $filtro->name; ?>"
            value="<?php echo $filtro->term_id; ?>"
            name="filtros_ids[]"
            <?php if(get_query_var('filtros_ids') && in_array($filtro->term_id, get_query_var( 'filtros_ids', FALSE))) { echo 'checked'; } ?>
        >
        <label for="<?php echo $filtro->name; ?>"><?php echo $filtro->name; ?></label>
    </div>
    <?php } } ?>
    <h6>Temas</h6>
    <?php if(!empty($data['temas'])) { ?>
        <?php foreach ($data['temas'] as $key => $tema) { ?>
        <div>
            <input
                    type="checkbox"
                    id="<?php echo $tema->name; ?>"
                    value="<?php echo $tema->term_id; ?>"
                    name="temas_ids[]"
                <?php if(get_query_var('temas_ids') && in_array($tema->term_id, get_query_var( 'temas_ids', FALSE))) { echo 'checked'; } ?>
            >
            <label for="<?php echo $tema->name; ?>"><?php echo $tema->name; ?></label>
        </div>
    <?php } } ?>
    <h6>Raça e Gênero</h6>
    <?php if(!empty($data['raca_e_genero'])) { ?>
        <?php foreach ($data['raca_e_genero'] as $key => $raca_e_genero) { ?>
            <div>
                <input
                        type="checkbox"
                        id="<?php echo $raca_e_genero->name; ?>"
                        value="<?php echo $raca_e_genero->term_id; ?>"
                        name="raca-e-genero_ids[]"
                    <?php if(get_query_var('raca-e-genero_ids') && in_array($raca_e_genero->term_id, get_query_var( 'raca-e-genero_ids', FALSE))) { echo 'checked'; } ?>
                >
                <label for="<?php echo $raca_e_genero->name; ?>"><?php echo $raca_e_genero->name; ?></label>
            </div>
        <?php } } ?>
    <h6>Gênero</h6>
    <?php if(!empty($data['genero'])) { ?>
        <?php foreach ($data['genero'] as $key => $genero) { ?>
            <div>
                <input
                        type="checkbox"
                        id="<?php echo $genero->name; ?>"
                        value="<?php echo $genero->term_id; ?>"
                        name="genero_ids[]"
                    <?php if(get_query_var('genero_ids') && in_array($genero->term_id, get_query_var( 'genero_ids', FALSE))) { echo 'checked'; } ?>
                >
                <label for="<?php echo $genero->name; ?>"><?php echo $genero->name; ?></label>
            </div>
        <?php } } ?>
    <button type="submit">Pesquisar</button>
</form>
<h2>Filmes (<?= $totalPosts; ?>)</h2>
<?php foreach ($posts as $key => $post) { ?>
    <article>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <hr>
    </article>
<?php } ?>
<?php get_footer(); ?>