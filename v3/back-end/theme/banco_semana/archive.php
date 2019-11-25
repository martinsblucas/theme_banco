<?php get_header(); ?>

    <main id="main" class="container-fluid">
        <div class="container">
            <?php get_template_part('partials/filmes_search', 'form'); ?>
        </div>
        <div class="container">
            <?php get_template_part('partials/filmes_cards', 'list'); ?>
        </div>
    </main>

<?php get_footer(); ?>