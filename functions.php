<?php
function kaleneTheme_support()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}
function kaleneTheme_register_assets()
{
    wp_enqueue_script('main-script', get_template_directory_uri() . '/dist/main.min.js', [], false, true);
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/dist/main.css');
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/src/scss/main.scss');
}
function kaleneTheme_title_separator()
{
    return '|';
}
function kaleneTheme_posts_pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if ($pages === null) {
        return;
    }
    echo '<nav class="pagination flex flex-wrap gap-2 justify-center">';
    $pages = paginate_links(['type' => 'array']);
    foreach ($pages as $page) {
        echo '<div>' . $page . '</div>';
    }
    echo '</nav>';
}

function kaleneTheme_init()
{
    register_taxonomy('sport', 'post', [
        'labels' => [
            'name' => 'Sport',
            'singular_name' => 'Sport',
            'plural_name' => 'Sports',
            'search_items' => 'Rechercher des sports',
            'all_items' => 'Tous les sports',
            'edit_item' => 'Éditer le sport',
            'update_item' => 'Mettre à jour le sport',
            'add_new_item' => 'Ajouter un nouveau sport',
            'new_item_name' => 'Nouveau sport',
            'menu_name' => 'Sport',
        ],
        'show_in_rest' => true,
        'hierarchical' => true,
        'show_admin_column' => true,

    ]);
    register_post_type(
        'bien',
        [
            'public' => true,
            'menu_position' => 3,
            'menu_icon' => 'dashicons-building',
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
            'show_in_rest' => true,
            'has_archive' => true,
            'labels' => [
                'name' => 'Biens',
                'singular_name' => 'Bien',
                'add_new_item' => 'Ajouter un nouveau bien',
                'edit_item' => 'Éditer le bien',
                'all_items' => 'Tous les biens',
                'view_item' => 'Voir le bien',
                'not_found' => 'Aucun bien trouvé',
                'not_found_in_trash' => 'Aucun bien trouvé dans la corbeille',
            ],
        ]
    );
}

add_action('wp_enqueue_scripts', 'kaleneTheme_register_assets');
add_action('after_setup_theme', 'kaleneTheme_support');
add_filter('document_title_separator', 'kaleneTheme_title_separator');
require_once('metaboxes/sponso.php');
require_once('option/agence.php');
add_action('init', 'kaleneTheme_init');
SponsoMetaBox::register();
AgenceMenuPage::register();

add_filter('manage_bien_posts_columns', function ($columns) {
    return [
        'cb' => $columns['cb'],
        'title' => $columns['title'],
        'thumbnail' => 'Image',
        'price' => 'Prix',
        'city' => 'Ville',
        'date' => $columns['date'],
    ];
});
add_filter('manage_bien_posts_custom_column', function ($column, $postId) {
    if ($column === 'thumbnail') {
        the_post_thumbnail('thumbnail', $postId);
    }
    if ($column === 'price') {
        echo get_post_meta($postId, '_bien_price', true);
    }
    if ($column === 'city') {
        echo get_post_meta($postId, '_bien_city', true);
    }
}, 10, 2);
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('agence-admin', get_template_directory_uri() . '/assets/agence-admin.css');
});

add_filter('manage_post_posts_columns', function ($columns) {
    $newColumns = [];
    foreach ($columns as $k => $v) {
        if ($k === 'date') {
            $newColumns['sponso'] = 'Article sponsorisé ?';
        }
        $newColumns[$k] = $v;
    }
    return $newColumns;
});
add_filter('manage_post_posts_custom_column', function ($column, $postId) {
    if ($column === 'sponso') {
        $sponso = get_post_meta($postId, SponsoMetaBox::META_KEY, true);
        if ($sponso === '1') {
            $class = 'yes';
        } else {
            $class = 'no';
        }
        echo '<div class="bullet bullet-' . $class . '"></div>';
    }
}, 10, 2);

/**
 * @param WP_Query $query
 */
function kaleneTheme_pre_get_posts($query)
{
    if (is_admin() || !is_search() || !$query->is_main_query()) {
        return;
    }

    if (get_query_var('sponso') === '1') {
        $query->set('meta_key', SponsoMetaBox::META_KEY);
        $query->set('meta_value', '1');
    }
}
function kaleneTheme_query_vars($params)
{
    $params[] = 'sponso';
    return $params;
}

add_action('pre_get_posts', 'kaleneTheme_pre_get_posts');
add_filter('query_vars', 'kaleneTheme_query_vars');
require_once('widgets/YoutubeWidget.php');
function kaleneTheme_register_widget()
{
    register_widget(YoutubeWidget::class);
    register_sidebar(
        [
            'id' => 'homepage',
            'name' => 'Sidebar Accueil',
            'before_widget' => '<div class="p-4 %2$s" id="%1$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="font-bold">',
            'after_title' => '</h4>',

        ]
    );
}

add_action('widgets_init', 'kaleneTheme_register_widget');


add_filter('comment_form_defaults', function ($args) {
    $args['fields']['email'] = <<<HTML
    <div class="flex flex-col mb-4">
        <label for="email" class="text-sm mb-2">Email*</label>
        <input type="email" name="email" id="email" class="border border-gray-400 p-2 rounded">
    </div>
HTML;

    return $args;
});
add_filter('comment_form_defaults', function ($args) {
    $args['fields']['author'] = <<<HTML
    <div class="flex flex-col mb-4">
        <label for="author" class="text-sm mb-2">Nom*</label>
        <input type="text" name="author" id="author" class="border border-gray-400 p-2 rounded">
    </div>
HTML;

    return $args;
});

add_filter('comment_form_defaults', function ($args) {
    $args['comment_field'] = <<<HTML
    <div class="flex flex-col mb-4">
        <label for="comment" class="text-sm mb-2">Commentaire*</label>
        <textarea cols="50" name="comment" id="comment" class="border border-gray-400 p-2 rounded h-48"></textarea>
    </div>
HTML;

    return $args;
});

add_filter('comment_form_defaults', function ($args) {
    $args['submit_button'] = <<<HTML
    <div class="flex flex-col mb-4">
        <input type="submit" value="Envoyer" class="bg-blue-500 text-white p-2 rounded">
    </div>
HTML;

    return $args;
});
add_filter('comment_form_defaults', function ($args) {
    $args['class_form'] = 'flex flex-col mb-4';
    return $args;
});
// je veux personnaliser les commentaires
add_filter('comment_form_defaults', function ($args) {
    $args['title_reply'] = 'Laisser un commentaire';
    return $args;
});
add_filter('comment_class', function ($args) {
    $args[] = 'bg-gray-100 p-2 rounded list-none';
    return $args;

});
add_filter('comment_text', function ($comment_text,) {
    // Personnalisez le format du texte de commentaire comme vous le souhaitez
    $comment_text = '<div class="bg-gray-100 p-2 rounded">' . $comment_text . '</div>';

    return $comment_text;
}, 10, 2);
