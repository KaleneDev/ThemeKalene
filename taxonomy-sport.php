<?php get_header() ?>
<div class="flex flex-col gap-12 p-4">

    <?php if (have_posts()) : ?>
        <h1 class="text-4xl"><?= esc_html(get_queried_object()->name) ?></h1>

        <?php
        $term = get_queried_object();
        if (esc_html($term->description)) :
        ?>
            <p>
                <?= $term->description ?>
            </p>
        <?php endif ?>

        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/post-card', 'post'); ?>
        <?php endwhile; ?>
        <?php kaleneTheme_posts_pagination(); ?>
    <?php else : ?>
        <h1>Pas d'article</h1>
    <?php endif; ?>
</div>
<?php get_footer() ?>