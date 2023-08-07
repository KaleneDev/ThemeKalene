<?php get_header() ?>
<div class="m-8 post flex flex-col gap-2 max-w-7xl m-auto p-4">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <h1 class="text-4xl mb-4 text-center font-bold">
                <?php the_title() ?>
            </h1>
            <?php if (get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true)  === '1') : ?>
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                            </svg></div>
                        <div>
                            <p class="font-bold">Article sponsorisé</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (has_post_thumbnail()) {
            ?>
                <div class="">
                    <img src="<?php the_post_thumbnail_url() ?>" class="rounded-2xl object-fill" alt="" style="width: 100%; height: auto">
                </div>
            <?php } ?>


            <?php the_content() ?>

            <a href="<?php echo get_edit_post_link(); ?>" class="btn btn-primary">Modifier</a>
            <a href="<?php echo get_delete_post_link(); ?>" class="btn btn-danger">Supprimer</a>


        <?php endwhile; ?>
        <!-- <?php
                $sports = get_terms([
                    'taxonomy' => 'sport',
                ]);
                if ($sports) {
                    echo '<ul class="flex gap-2">';
                    foreach ($sports as $sport) {
                        echo '<li><a class="' . is_tax('sport', $sport->term_id) . '" href="' . get_term_link($sport) . '">' . $sport->name  . '</a></li>';
                    }
                    echo '</ul>';
                }
                ?> -->
    <?php else : ?>
        <h1>Pas d'article</h1>
    <?php endif; ?>
</div>
<?php get_footer() ?>