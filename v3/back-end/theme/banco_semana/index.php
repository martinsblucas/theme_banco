<?php get_header(); ?>

<main id="main" class="container-fluid">
    <div class="container-fluid mx-0 px-0">
        <?php get_template_part('partials/jumbotron-introduction', 'featured'); ?>
    </div>
    <div class="container">
        <?php get_template_part('partials/posts_cards', 'featured'); ?>
    </div>
    <div class="container">
        <?php get_template_part('partials/about-us', 'featured'); ?>
    </div>
</main>

<?php get_footer(); ?>