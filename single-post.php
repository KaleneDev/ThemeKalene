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
            <?php
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?>
            <h2 class="text-2xl font-bold">Articles relatifs :</h2>
            <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

                <?php $query = new WP_Query([
                    'post__not_in' => [get_the_ID()],
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'orderby' => 'rand',
                    'tax_query' => [
                        [
                            'taxonomy' => 'sport',
                            'field' => 'slug',
                            'terms' => wp_get_post_terms(get_the_ID(), 'sport', ['fields' => 'slugs'])
                        ]
                    ]
                ]);
                while ($query->have_posts()) : $query->the_post(); ?>
                    <?php get_template_part('template-parts/post-relatif', 'post'); ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata();
                ?>
            </div>

            <div class="flex justify-between my-12">
                <?php
                $post_id = get_the_ID();
                ?>

                <?php if (current_user_can('edit_post', $post_id)) : ?>
                    <a href="<?php echo get_edit_post_link($post_id); ?>" class="btn btn-primary bg-yellow-400 py-2 px-4 rounded-lg">Modifier</a>
                <?php endif; ?>

                <?php if (current_user_can('delete_post', $post_id)) : ?>
                    <a href="<?php echo get_delete_post_link($post_id); ?>" class="btn btn-danger bg-red-400 py-2 px-4 rounded-lg">Supprimer</a>
                <?php endif; ?>
            </div>

        <?php endwhile; ?>
        <div class="flex items-center gap-2">
            <p class="text-lg">
                Tags :
            </p>
            <?php
            $sports = get_terms([
                'taxonomy' => 'sport',
            ]);
            if ($sports) {
                echo '<ul class="flex gap-2">';
                foreach ($sports as $sport) {
                    $active_class = is_tax('sport', $sport->term_id) ? 'bg-sky-300 py-1 px-2 rounded-xl' : '';
                    echo '<li><a class="text-lg ' . $active_class  . '" href="' . get_term_link($sport) . '">' . $sport->name  . '</a></li>';
                }
                echo '</ul>';
            }
            ?>
        </div>
    <?php else : ?>
        <h1>Pas d'article</h1>
    <?php endif; ?>
</div>
<?php get_footer() ?>