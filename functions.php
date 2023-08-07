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
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/main.min.js', [], false, true);
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/assets/main.css');
}
function kaleneTheme_title_separator()
{
    return '|';
}

add_action('wp_enqueue_scripts', 'kaleneTheme_register_assets');
add_action('after_setup_theme', 'kaleneTheme_support');
add_filter('document_title_separator', 'kaleneTheme_title_separator');
