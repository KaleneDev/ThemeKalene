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

    <div class="border-r border-b border-l border-gray-300 lg:border-t lg:border-gray-300 bg-white rounded-b-2xl lg:rounded-b-none lg:rounded-r-2xl p-4 flex flex-col justify-between leading-normal">
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
                        the_content();
                    }
                    ?></p>
            </div>

            <?php if (!has_excerpt()) : ?>
                <a href="<?php the_permalink(); ?>" class="text-indigo-700 font-bold">Voir plus</a>
            <?php endif; ?>
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

            <div>
                <a href="<?php echo get_edit_post_link(); ?>" class="btn btn-primary">Modifier</a>
                <a href="<?php echo get_delete_post_link(); ?>" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
    </div>
</div>