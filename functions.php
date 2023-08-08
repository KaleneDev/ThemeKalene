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
