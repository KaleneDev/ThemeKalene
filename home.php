<?php get_header() ?>
<div class="flex flex-col gap-12 p-4">
    <?php if (have_posts()) : ?>
        <div class="justify-between flex items-center">

            <h1 class="text-4xl">Actualités</h1>
            <?php
            // $add_post_page_id = 40; 
            // $add_post_url = get_permalink($add_post_page_id);
            $add_post_url = admin_url('post-new.php');
            echo '<a href="' . esc_url($add_post_url) . '" class="mr-2 text-xl bg-sky-300 py-2 px-4 rounded-lg text-white">Ajouter un nouvel article</a>';
            ?>
<!-- 
<form action="" method="post">
    <input type="text" name="post_title" placeholder="Titre de l'article" required>
    <textarea name="post_content" placeholder="Contenu de l'article" required></textarea>
    <input class="mr-2 text-xl bg-sky-300 py-2 px-4 rounded-lg cursor-pointer text-white" type="submit" name="submit_post" value="Ajouter un nouvel article">
</form>

<?php
if (isset($_POST['submit_post'])) {
    $post_title = sanitize_text_field($_POST['post_title']);
    $post_content = wp_kses_post($_POST['post_content']);
    
    $new_post = array(
        'post_title' => $post_title,
        'post_content' => $post_content,
        'post_status' => 'publish',
        'post_author' => get_current_user_id(),
        'post_type' => 'post'
    );

    $post_id = wp_insert_post($new_post);

    if ($post_id) {
        echo '<p>L\'article a été ajouté avec succès.</p>';
    } else {
        echo '<p>Une erreur s\'est produite lors de l\'ajout de l\'article.</p>';
    }
}
?> -->
        </div>
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
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/post-card', 'post'); ?>
        <?php endwhile; ?>
        <?php kaleneTheme_posts_pagination(); ?>
    <?php else : ?>
        <h1>Pas d'article</h1>
    <?php endif; ?>
</div>
<?php get_footer() ?>