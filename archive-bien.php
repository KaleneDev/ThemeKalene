<?php get_header() ?>
<div class="flex flex-col gap-12 p-4">
    <?php if (have_posts()) : ?>
        <h1 class="text-4xl">Voir tous nos Bien</h1>
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/post-card', 'post'); ?>
        <?php endwhile; ?>
        <?php kaleneTheme_posts_pagination(); ?>
    <?php else : ?>
        <h1>Pas d'article</h1>
    <?php endif; ?>
</div>
<?php get_footer() ?>