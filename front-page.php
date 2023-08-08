<?php get_header() ?>
<!-- <?php while (have_posts()) : the_post() ?>
    <div class="m-8 post flex flex-col gap-2 max-w-7xl m-auto p-4">
        <h1 class="text-4xl mb-4 text-center font-bold">
            <?php the_title() ?>
        </h1>
        <?php the_content() ?>

        <a href="<?php echo get_post_type_archive_link('post') ?>">Voir les dernières actualités </a>
    </div>
<?php endwhile; ?> -->
<div class="flex justify-center">
    <div class="grow">

        <!-- Bannière principale -->
        <section class="text-gray-900 py-16">
            <div class="container mx-auto text-center">
                <h2 class="text-4xl font-semibold mb-4">Trouvez la maison de vos rêves</h2>
                <p class="text-lg mb-8">Découvrez notre large sélection de biens immobiliers.</p>
                <a href="<?php echo get_post_type_archive_link('bien') ?>" class="bg-yellow-500 hover:bg-yellow-400 text-white font-semibold py-2 px-6 rounded-full transition duration-300">Voir les annonces</a>
            </div>
        </section>


        <!-- Annonces récentes -->
        <section class="py-16 grow-0 p-4">
            <div class="container mx-auto">
                <h2 class="text-2xl font-semibold mb-8">Annonces Récentes</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    $args = array(
                        'post_type' => 'bien', 
                        'posts_per_page' => 8 
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            get_template_part('template-parts/post-card-recent', 'post');
                        endwhile;
                        kaleneTheme_posts_pagination();
                    endif;

                    wp_reset_postdata();
                    ?>
                </div>
        </section>
    </div>

    <aside>
        <?php get_sidebar('homepage') ?>
    </aside>
</div>


<?php get_footer() ?>