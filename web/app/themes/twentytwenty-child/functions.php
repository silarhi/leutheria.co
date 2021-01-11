<?php

add_action('wp_enqueue_scripts', 'enqueue_parent_styles');

function enqueue_parent_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

add_filter('wp_nav_menu', function ($nav_menu, $args) {
    $menu = $args->menu;
    if (! in_array($menu->slug, ['main', 'main-fr', 'main-expanded', 'main-fr-expanded'], true)) {
        return $nav_menu;
    }

    $switcher = pll_the_languages([
        'echo' => false,
        'display_names_as' => 'slug',
    ]);

    if (in_array($menu->slug, ['main-expanded', 'main-fr-expanded'], true)) {
        return $switcher . $nav_menu;
    }

    return $nav_menu . $switcher;
}, 10, 2);
