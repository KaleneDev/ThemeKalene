<?php get_header() ?>
<?php while (have_posts()) : the_post() ?>
    <div class="m-8 post flex flex-col gap-2 max-w-7xl m-auto">
        <h1 class="text-4xl mb-4 text-center font-bold">
            <?php the_title() ?>
        </h1>
        <?php the_content() ?>

        <a href="<?php echo get_post_type_archive_link('post') ?>">Voir les dernières actualités</a>
    </div>
<?php endwhile; ?>

<?php get_footer() ?>