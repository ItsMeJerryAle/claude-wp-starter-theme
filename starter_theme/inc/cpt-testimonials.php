<?php
/**
 * CPT: Testimonials
 */

// ── 1. Register CPT ───────────────────────────────────────────────────────────
function tail_register_cpt_testimonial() {
    $labels = array(
        'name'          => _x( 'Testimonials', 'post type general name', 'starter_theme' ),
        'singular_name' => _x( 'Testimonial', 'post type singular name', 'starter_theme' ),
        'add_new_item'  => __( 'Add New Testimonial', 'starter_theme' ),
        'edit_item'     => __( 'Edit Testimonial', 'starter_theme' ),
        'view_item'     => __( 'View Testimonial', 'starter_theme' ),
        'search_items'  => __( 'Search Testimonials', 'starter_theme' ),
        'not_found'     => __( 'No testimonials found.', 'starter_theme' ),
        'menu_name'     => _x( 'Testimonials', 'admin menu', 'starter_theme' ),
    );

    register_post_type( 'testimonial', array(
        'labels'       => $labels,
        'public'       => false,
        'show_ui'      => true,
        'show_in_rest' => false,
        'supports'     => array( 'title' ),
        'menu_icon'    => 'dashicons-format-quote',
        'rewrite'      => false,
    ) );
}
add_action( 'init', 'tail_register_cpt_testimonial' );


// ── 2. ACF — Testimonial Fields ───────────────────────────────────────────────
add_action( 'acf/init', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'    => 'group_testimonial_details',
        'title'  => 'Testimonial Details',
        'fields' => array(

            array(
                'key'     => 'field_testimonial_quote',
                'label'   => 'Quote',
                'name'    => 'testimonial_quote',
                'type'    => 'textarea',
                'rows'    => 4,
                'instructions' => 'Do not include quotation marks — they are added automatically.',
                'wrapper' => array( 'width' => '100' ),
            ),
            array(
                'key'     => 'field_testimonial_role',
                'label'   => 'Role / Descriptor',
                'name'    => 'testimonial_role',
                'type'    => 'text',
                'instructions' => 'e.g. "Cancer Care Recipient"',
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_testimonial_link',
                'label'         => 'Story URL',
                'name'          => 'testimonial_link',
                'type'          => 'url',
                'instructions'  => 'Link to the full story page (optional).',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_testimonial_bg_image',
                'label'         => 'Background Image',
                'name'          => 'testimonial_bg_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Used as card background when displayed with an image overlay.',
                'wrapper'       => array( 'width' => '100' ),
            ),

        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'testimonial',
                ),
            ),
        ),
    ) );
} );


// ── 3. Dummy Data Seeder ──────────────────────────────────────────────────────
add_action( 'admin_init', function() {
    if ( get_option( 'tail_testimonial_seeded' ) ) return;
    if ( get_posts( array( 'post_type' => 'testimonial', 'numberposts' => 1 ) ) ) {
        update_option( 'tail_testimonial_seeded', true );
        return;
    }

    $dummy = array(
        array(
            'title' => 'Jenny',
            'role'  => 'Cancer Care Recipient',
            'quote' => 'The assistance we received didn\'t just pay a bill — it gave us the breathing room to focus on recovery instead of financial ruin.',
            'link'  => '#',
            'image' => '',
        ),
        array(
            'title' => 'David',
            'role'  => 'Housing Support Recipient',
            'quote' => 'Finding a safe place to sleep was the first step. The ongoing support helped me rebuild my life and find a job I love.',
            'link'  => '#',
            'image' => '',
        ),
    );

    foreach ( $dummy as $item ) {
        $post_id = wp_insert_post( array(
            'post_title'  => $item['title'],
            'post_status' => 'publish',
            'post_type'   => 'testimonial',
        ) );

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, 'testimonial_quote', $item['quote'] );
            update_post_meta( $post_id, 'testimonial_role',  $item['role'] );
            update_post_meta( $post_id, 'testimonial_link',  $item['link'] );
        }
    }

    update_option( 'tail_testimonial_seeded', true );
} );
