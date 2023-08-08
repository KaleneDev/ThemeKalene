<div class="w-full lg:max-w-full lg:flex drop-shadow-md">
    <?php
    if (has_post_thumbnail()) {
    ?>
        <div class="h-48 lg:h-auto lg:w-72 flex-none bg-cover rounded-t lg:rounded-tr-none lg:rounded-l-2xl text-center overflow-hidden object-cover relative">
            <?php
            $permalink = get_permalink();

            the_post_thumbnail('large', ['class' => 'w-full h-full absolute inset-0 object-cover']);
            ?>
            <a href="<?php echo $permalink; ?>" class="w-full h-full absolute inset-0"></a>
        </div>
    <?php } ?>

    <div class="border-r border-b border-l border-gray-300 lg:border-t lg:border-gray-300 bg-white rounded-b-2xl lg:rounded-b-none lg:rounded-r-2xl p-4 flex flex-col justify-between leading-normal lg:min-w-[400px]">
        <div class="mb-8">
            <div class="text-gray-900 font-bold text-xl mb-2">
                <a href="<?php the_permalink(); ?>" class="card-link">
                    <?php the_title() ?>

                </a>
            </div>
            <div class="mb-4">

                <p class="text-gray-700 text-base">
                    <?php
                    if (has_excerpt()) {
                        the_excerpt();
                    } else {
                        $content = get_the_content();
                        $trimmed_content = wp_trim_words($content, 100, '...');
                        echo $trimmed_content;
                    }
                    ?></p>
            </div>

            <?php if (!has_excerpt()) : ?>
                <a href="<?php the_permalink(); ?>" class="text-indigo-700 font-bold">Voir plus</a>
            <?php endif; ?>
        </div>
        <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">

                <?php
                $post_id = get_the_ID();
                $author_id = get_post_field('post_author', $post_id);
                $author_avatar_url = get_avatar_url($author_id, array('size' => 96));

                ?>
                <img class="w-10 h-10 rounded-full mr-4" src="<?php echo $author_avatar_url; ?>" alt="Avatar">
                <div class="text-sm">
                    <p class="text-gray-900 leading-none"><?php the_author() ?></p>
                    <p class="text-gray-600"><?php echo get_the_date(); ?></p>
                </div>
                <p>
                    <?php
                    $categories = get_the_category();
                    $tags = get_the_terms(get_the_ID(), 'sport');
                    if ($categories) {
                        echo '<ul class="flex gap-2">';
                        foreach ($categories as $category) {
                            echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . $category->name . '</a></li>';
                        }
                    }


                    if ($tags) {

                        foreach ($tags as $tag) {
                            echo '<li><a class="bg-sky-300 py-1 px-3 rounded-xl' . (is_tax('sport', $tag->term_id) ? ' bg-indigo-700' : '') . '" href="' . esc_url(get_term_link($tag)) . '">' . $tag->name  . '</a></li>';
                        }
                        echo '</ul>';
                    }

                    ?>
                </p>
            </div>

            <div class="flex gap-2 justify-between">
                <?php
                // Assurez-vous d'avoir défini $post_id en conséquence
                $post_id = get_the_ID();
                ?>

                <?php if (current_user_can('edit_post', $post_id)) : ?>
                    <a href="<?php echo get_edit_post_link($post_id); ?>" class="btn btn-primary bg-yellow-400 py-2 px-4 rounded-lg text-xs">Modifier</a>
                <?php endif; ?>

                <?php if (current_user_can('delete_post', $post_id)) : ?>
                    <a href="<?php echo get_delete_post_link($post_id); ?>" class="btn btn-danger bg-red-400 py-2 px-4 rounded-lg text-xs">Supprimer</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>