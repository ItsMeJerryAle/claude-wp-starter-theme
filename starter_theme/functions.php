<?php
/**
 * BridgeWell Theme — functions.php
 */

// ── Theme Setup ──────────────────────────────────────────────────────────────
function tail_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'width'       => 200,
        'height'      => 80,
        'flex-width'  => true,
        'flex-height' => true,
    ) );

    register_nav_menus( array(
        'primary'             => __( 'Primary Navigation', 'starter_theme' ),
        'mobile_dialog'       => __( 'Mobile Menu Dialog', 'starter_theme' ),
        'footer_about'        => __( 'Footer — About', 'starter_theme' ),
        'footer_get_support'  => __( 'Footer — Get Support', 'starter_theme' ),
        'footer_get_involved' => __( 'Footer — Get Involved', 'starter_theme' ),
        'footer_resources'    => __( 'Footer — Resources', 'starter_theme' ),
    ) );
}
add_action( 'after_setup_theme', 'tail_theme_setup' );

// ── SVG Upload Support ───────────────────────────────────────────────────────
function tail_allow_svg_uploads( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'tail_allow_svg_uploads' );

function tail_fix_svg_mime_check( $data, $file, $filename, $mimes ) {
    $ext = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
    if ( in_array( $ext, array( 'svg', 'svgz' ), true ) ) {
        $data['ext']  = $ext;
        $data['type'] = 'image/svg+xml';
    }
    return $data;
}
add_filter( 'wp_check_filetype_and_ext', 'tail_fix_svg_mime_check', 10, 4 );

function tail_svg_media_thumbnail( $response, $attachment ) {
    if ( $response['mime'] === 'image/svg+xml' ) {
        $response['sizes'] = array(
            'full' => array( 'url' => $response['url'] ),
        );
    }
    return $response;
}
add_filter( 'wp_prepare_attachment_for_js', 'tail_svg_media_thumbnail', 10, 2 );

// ── Restrict Page Template Selector to Administrators ────────────────────────
// Non-admins cannot see or change the page template from the editor.
// Template assignment is an admin/developer-only operation.
add_filter( 'theme_page_templates', function( $templates ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        return array();
    }
    return $templates;
} );

add_action( 'admin_head', function() {
    if ( current_user_can( 'manage_options' ) ) return;
    $screen = get_current_screen();
    if ( ! $screen || $screen->id !== 'page' ) return;
    echo '<style>
        /* Gutenberg — hide template panel in sidebar */
        .edit-post-post-template,
        .editor-page-template { display: none !important; }
        /* Classic editor — hide template row in Page Attributes */
        .page-template-wrap { display: none !important; }
    </style>';
} );

// ── ACF — Default meta box order (matches front-page section order) ──────────
add_filter( 'get_user_option_meta-box-order_page', function( $order ) {
    if ( false === $order ) {
        return array(
            'normal'   => 'acf-group_hero_section,acf-group_story_section,acf-group_services_section,acf-group_impact_section,acf-group_events_section,acf-group_resources_section,acf-group_partners_section,acf-group_support_section',
            'side'     => '',
            'advanced' => '',
        );
    }
    return $order;
} );

// ── ACF — Collapse field groups by default ───────────────────────────────────
// When a user has no saved preference, return all ACF groups as closed.
// Once they manually toggle a box, WordPress saves their own choice and this is ignored.
add_filter( 'get_user_option_closedpostboxes_page', function( $closed ) {
    if ( false === $closed ) {
        return array(
            'acf-group_story_section',
            'acf-group_hero_section',
        );
    }
    return $closed;
} );

// ── Includes ─────────────────────────────────────────────────────────────────
require_once get_template_directory() . '/inc/enqueues.php';
require_once get_template_directory() . '/inc/theme-settings-page.php';
require_once get_template_directory() . '/inc/acf-fields.php';
require_once get_template_directory() . '/inc/cpt-services.php';
require_once get_template_directory() . '/inc/cpt-testimonials.php';
require_once get_template_directory() . '/inc/cpt-events.php';
