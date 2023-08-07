<?php get_header() ?>
<div class="flex flex-col gap-12 p-4">
    <?php if (have_posts()) : ?>
        <h1 class="text-4xl">Home</h1>
        <?php while (have_posts()) : the_post(); ?>
            <div class="w-full lg:max-w-full lg:flex">
                <?php
                if (has_post_thumbnail()) {
                ?>
                    <div class="h-48 lg:h-auto lg:w-72 flex-none bg-cover rounded-t lg:rounded-tr-none lg:rounded-l text-center overflow-hidden object-cover relative">
                        <?php
                        $permalink = get_permalink();

                        the_post_thumbnail('large', ['class' => 'w-full h-full absolute inset-0 object-cover']);
                        ?>
                        <a href="<?php echo $permalink; ?>" class="w-full h-full absolute inset-0"></a>
                    </div>
                <?php } ?>

                <div class="border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                    <div class="mb-8">
                        <div class="text-gray-900 font-bold text-xl mb-2">
                            <a href="<?php the_permalink(); ?>" class="card-link">
                                <?php the_title() ?>
                            </a>
                        </div>
                        <p class="text-gray-700 text-base">
                            <?php
                            if (has_excerpt()) {
                                the_excerpt();
                            } else {
                                the_content('Voir plus');
                            }
                            ?></p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">

                            <?php $current_user_avatar_url = get_avatar_url(get_current_user_id(), array('size' => 96));
                            ?>
                            <img class="w-10 h-10 rounded-full mr-4" src="<?php echo $current_user_avatar_url; ?>" alt="Avatar">
                            <div class="text-sm">
                                <p class="text-gray-900 leading-none"><?php the_author() ?></p>
                                <p class="text-gray-600"><?php echo get_the_date(); ?></p>
                            </div>
                            <p>
                                <?php
                                $categories = get_the_category();

                                if ($categories) {
                                    echo '<ul>';
                                    foreach ($categories as $category) {
                                        echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . $category->name . '</a></li>';
                                    }
                                    echo '</ul>';
                                } else {
                                    echo '<p>No categories found for this post.</p>';
                                }
                                ?>

                                <?php
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
                                ?>
                            </p>
                        </div>

                        <div>
                            <a href="<?php echo get_edit_post_link(); ?>" class="btn btn-primary">Modifier</a>
                            <a href="<?php echo get_delete_post_link(); ?>" class="btn btn-danger">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php kaleneTheme_posts_pagination(); ?>
    <?php else : ?>
        <h1>Pas d'article</h1>
    <?php endif; ?>
</div>
<?php get_footer() ?>