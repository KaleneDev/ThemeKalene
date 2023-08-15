<?php get_header() ?>
<div class="flex flex-col gap-12 p-4">
    <?php if (have_posts()) : ?>
        <div class="justify-between flex items-center">
            <h1 class="text-4xl">Voir tous nos Biens</h1>
            <?php
            $add_bien_url = admin_url('post-new.php?post_type=bien');
            echo '<a href="' . esc_url($add_bien_url) . '" class="mr-2 text-xl bg-sky-300 py-2 px-4 rounded-lg text-white">Ajouter un nouveau bien</a>';
            ?>
        </div>
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/post-card', 'post'); ?>
        <?php endwhile; ?>
        <?php kaleneTheme_posts_pagination(); ?>
    <?php else : ?>
        <h1>Pas d'article</h1>
    <?php endif; ?>
</div>
<?php get_footer() ?>