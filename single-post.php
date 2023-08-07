<?php get_header() ?>
<div class="m-8 post flex flex-col gap-2 max-w-7xl m-auto p-4">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <h1 class="text-4xl mb-4 text-center font-bold">
                <?php the_title() ?>
            </h1>

            <?php if (has_post_thumbnail()) {
            ?>
                <div class="">
                    <img src="<?php the_post_thumbnail_url() ?>" class="rounded-2xl" alt="" style="width: 100%; height: auto">
                </div>
            <?php } ?>


            <?php the_content() ?>

            <?php edit_post_link('Modifier', '<span class="edit-link">', '</span>'); ?>
        <?php endwhile; ?>
    <?php else : ?>
        <h1>Pas d'article</h1>
    <?php endif; ?>
</div>
<?php get_footer() ?>