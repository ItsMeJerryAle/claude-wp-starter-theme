<?php
/**
 * Enqueue styles and scripts.
 */
function tail_enqueue_assets() {
    // Entrance animations
    wp_enqueue_script(
        'tail-animations',
        get_template_directory_uri() . '/assets/js/animations.js',
        array(),
        '1.0',
        true
    );

    // Donate Hero — gift widget
    wp_enqueue_script(
        'tail-hero-donate',
        get_template_directory_uri() . '/assets/js/hero-donate.js',
        array(),
        '1.0',
        true
    );

    // Ways to Give — clipboard copy
    wp_enqueue_script(
        'tail-ways-to-give',
        get_template_directory_uri() . '/assets/js/ways-to-give.js',
        array(),
        '1.0',
        true
    );

    // Google Fonts — Vollkorn + Barlow Condensed
    wp_enqueue_style(
        'tail-google-fonts',
        'https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800;900&family=Vollkorn:wght@400;700&display=swap',
        array(),
        null
    );
}
add_action( 'wp_enqueue_scripts', 'tail_enqueue_assets' );
