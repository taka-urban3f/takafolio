<?php

function takafolio_theme_setup()
{
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'takafolio_theme_setup');

function takafolio_enqueue_scripts()
{
    // js読み込み
    wp_enqueue_script(
        'lenis',
        get_template_directory_uri() . '/assets/js/lenis.1.1.13.min.js',
        array(),
        '1.1.13',
        true,
    );
    wp_enqueue_script(
        'barba',
        get_template_directory_uri() . '/assets/js/barba.2.10.3.js',
        array(),
        '2.10.3',
        true,
    );
    wp_enqueue_script(
        'gsap',
        get_template_directory_uri() . '/assets/js/gsap.min.js"',
        array(),
        '3.12.5',
        true,
    );
    wp_enqueue_script(
        'takafolio_js',
        get_template_directory_uri() . '/assets/js/script.js',
        array(),
        '1.0.0',
        true,
    );

    // CSS読み込み
    wp_enqueue_style(
        'destyle',
        get_template_directory_uri() . '/assets/css/destyle.css',
        array(),
        '4.0.1',
    );
    wp_enqueue_style(
        'takafolio_style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        '1.0.0',
    );
    // googlefonts
    wp_enqueue_style(
        'googlefonts_noto',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap',
        array(),
        '1.0.0',
    );
    wp_enqueue_style(
        'googlefonts_noto300',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap',
        array(),
        '1.0.0',
    );
    wp_enqueue_style(
        'googlefonts_wireone',
        'https://fonts.googleapis.com/css2?family=Wire+One&display=swap',
        array(),
        '1.0.0',
    );
    wp_enqueue_style(
        'googlefonts_rokkitt',
        'https://fonts.googleapis.com/css2?family=Rokkitt:wght@300&display=swap',
        array(),
        '1.0.0',
    );
}
add_action('wp_enqueue_scripts', 'takafolio_enqueue_scripts');
