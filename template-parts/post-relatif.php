<div class="w-full lg:max-w-full flex flex-col drop-shadow-md">
    <?php
    if (has_post_thumbnail()) {
    ?>
        <div class="h-48 lg:max-w-full flex-none bg-cover rounded-t-2xl  text-center overflow-hidden object-cover relative">
            <?php
            $permalink = get_permalink();

            the_post_thumbnail('large', ['class' => 'w-full h-full absolute inset-0 object-cover']);
            ?>
            <a href="<?php echo $permalink; ?>" class="w-full h-full absolute inset-0"></a>
        </div>
    <?php } ?>

    <div class="border-r border-b border-l border-gray-300 lg:border-t lg:border-gray-300 bg-white rounded-b-2xl p-4 flex flex-col justify-between leading-normal">
        <div class="mb-1">
            <div class="text-gray-900 font-bold text-2xl mb-2">
                <a href="<?php the_permalink(); ?>" class="card-link">
                    <?php the_title() ?>
                </a>
            </div>
            <div class="mb-4">

                <p class="text-gray-700 text-base hidden lg:flex">
                    <?php
                    if (has_excerpt()) {
                        the_excerpt();
                    } else {
                        $content = get_the_content();
                        $trimmed_content = wp_trim_words($content, 25, '...');
                        echo $trimmed_content;
                    }
                    ?></p>
            </div>

            <?php if (!has_excerpt()) : ?>
                <a href="<?php the_permalink(); ?>" class="text-indigo-700 font-bold">Voir plus</a>
            <?php endif; ?>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">

                <?php
                $post_id = get_the_ID();
                $author_id = get_post_field('post_author', $post_id);
                $author_avatar_url = get_avatar_url($author_id, array('size' => 96));
                ?>

                <img class="w-10 h-10 rounded-full mr-4" src="<?php echo $author_avatar_url; ?>" alt="Avatar">
                <div class="text-sm flex gap-2">
                    <p class="text-gray-900 leading-none"><?php the_author() ?></p>
                    <p class="text-gray-600"><?php echo get_the_date(); ?></p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <p>
                Tags :
            </p>
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
        </div>
    </div>
</div>