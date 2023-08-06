<?php
function kaleneTheme_support()
{
    add_theme_support('title-tag');
}

function kaleneTheme_register_assets()
{
    wp_enqueue_style('tailwind-styles', get_template_directory_uri() . '/tailwind.css');
}

add_action('wp_enqueue_scripts', 'kaleneTheme_register_assets');

add_action('after_setup_theme', 'kaleneTheme_support');
