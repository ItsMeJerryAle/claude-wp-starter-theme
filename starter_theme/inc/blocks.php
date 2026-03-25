<?php
/**
 * ACF Block Registrations
 * All homepage blocks are registered here.
 * Render templates live in template-parts/blocks/.
 * Field groups live in inc/acf/blocks/.
 */

// ── Custom Block Category ────────────────────────────────────────────────────
function tail_register_block_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'theme-blocks',
                'title' => __( 'Theme Blocks', 'starter_theme' ),
                'icon'  => null,
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'tail_register_block_category' );


// ── Register Block Types ─────────────────────────────────────────────────────
function tail_register_acf_blocks() {
    if ( ! function_exists( 'acf_register_block_type' ) ) return;

    $blocks = array(
        array(
            'name'            => 'hero',
            'title'           => __( 'Hero', 'starter_theme' ),
            'description'     => __( 'Full-width Ken Burns hero with heading, sub-text, and two buttons.', 'starter_theme' ),
            'render_template' => 'template-parts/blocks/hero.php',
            'icon'            => 'cover-image',
            'keywords'        => array( 'hero', 'banner', 'header' ),
        ),
        array(
            'name'            => 'story',
            'title'           => __( 'Story', 'starter_theme' ),
            'description'     => __( 'Two action cards + testimonial image block.', 'starter_theme' ),
            'render_template' => 'template-parts/blocks/story.php',
            'icon'            => 'format-quote',
            'keywords'        => array( 'story', 'cards', 'testimonial' ),
        ),
        array(
            'name'            => 'services',
            'title'           => __( 'Services', 'starter_theme' ),
            'description'     => __( 'Service CPT cards with featured image background.', 'starter_theme' ),
            'render_template' => 'template-parts/blocks/services-section.php',
            'icon'            => 'clipboard',
            'keywords'        => array( 'services', 'programs' ),
        ),
        array(
            'name'            => 'impact',
            'title'           => __( 'Impact', 'starter_theme' ),
            'description'     => __( 'Testimonial cards from CPT + animated stats counter.', 'starter_theme' ),
            'render_template' => 'template-parts/blocks/impact-section.php',
            'icon'            => 'chart-bar',
            'keywords'        => array( 'impact', 'stats', 'testimonials' ),
        ),
        array(
            'name'            => 'events',
            'title'           => __( 'Events', 'starter_theme' ),
            'description'     => __( 'Featured event card + sidebar events + volunteer block.', 'starter_theme' ),
            'render_template' => 'template-parts/blocks/events-section.php',
            'icon'            => 'calendar',
            'keywords'        => array( 'events', 'volunteer' ),
        ),
        array(
            'name'            => 'resources',
            'title'           => __( 'Resources', 'starter_theme' ),
            'description'     => __( 'Latest blog posts in a 3-column card grid.', 'starter_theme' ),
            'render_template' => 'template-parts/blocks/resources-section.php',
            'icon'            => 'book',
            'keywords'        => array( 'resources', 'posts', 'blog' ),
        ),
        array(
            'name'            => 'partners',
            'title'           => __( 'Partners', 'starter_theme' ),
            'description'     => __( 'Community partners logo grid.', 'starter_theme' ),
            'render_template' => 'template-parts/blocks/partners-section.php',
            'icon'            => 'groups',
            'keywords'        => array( 'partners', 'logos', 'sponsors' ),
        ),
        array(
            'name'            => 'support',
            'title'           => __( 'Support', 'starter_theme' ),
            'description'     => __( 'Full-width hero statement + two glassmorphism CTA columns.', 'starter_theme' ),
            'render_template' => 'template-parts/blocks/support-section.php',
            'icon'            => 'heart',
            'keywords'        => array( 'support', 'cta', 'donate' ),
        ),
    );

    foreach ( $blocks as $block ) {
        acf_register_block_type( array_merge( $block, array(
            'category' => 'theme-blocks',
            'supports' => array(
                'align' => false,
                'mode'  => false,
            ),
        ) ) );
    }
}
add_action( 'acf/init', 'tail_register_acf_blocks' );
