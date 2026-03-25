<?php
/**
 * CPT: Events
 */

// ── 1. Register CPT ───────────────────────────────────────────────────────────
function tail_register_cpt_event() {
    $labels = array(
        'name'          => _x( 'Events', 'post type general name', 'starter_theme' ),
        'singular_name' => _x( 'Event', 'post type singular name', 'starter_theme' ),
        'add_new_item'  => __( 'Add New Event', 'starter_theme' ),
        'edit_item'     => __( 'Edit Event', 'starter_theme' ),
        'view_item'     => __( 'View Event', 'starter_theme' ),
        'search_items'  => __( 'Search Events', 'starter_theme' ),
        'not_found'     => __( 'No events found.', 'starter_theme' ),
        'menu_name'     => _x( 'Events', 'admin menu', 'starter_theme' ),
    );

    register_post_type( 'event', array(
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
        'menu_icon'    => 'dashicons-calendar-alt',
        'rewrite'      => array( 'slug' => 'events' ),
    ) );
}
add_action( 'init', 'tail_register_cpt_event' );


// ── 2. ACF — Event Detail Fields ─────────────────────────────────────────────
add_action( 'acf/init', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'    => 'group_event_details',
        'title'  => 'Event Details',
        'fields' => array(

            array(
                'key'           => 'field_event_date',
                'label'         => 'Date',
                'name'          => 'event_date',
                'type'          => 'date_picker',
                'display_format' => 'M j, Y',
                'return_format'  => 'M j',
                'first_day'      => 1,
                'wrapper'        => array( 'width' => '33' ),
            ),
            array(
                'key'     => 'field_event_time',
                'label'   => 'Time',
                'name'    => 'event_time',
                'type'    => 'text',
                'instructions' => 'e.g. 6:00 PM',
                'wrapper' => array( 'width' => '33' ),
            ),
            array(
                'key'     => 'field_event_location',
                'label'   => 'Location',
                'name'    => 'event_location',
                'type'    => 'text',
                'instructions' => 'e.g. Downtown Center',
                'wrapper' => array( 'width' => '33' ),
            ),
            array(
                'key'     => 'field_event_link',
                'label'   => 'Event URL',
                'name'    => 'event_link',
                'type'    => 'url',
                'wrapper' => array( 'width' => '50' ),
            ),

        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'event',
                ),
            ),
        ),
    ) );
} );


// ── 3. Dummy Data Seeder ──────────────────────────────────────────────────────
add_action( 'admin_init', function() {
    if ( get_option( 'tail_event_seeded' ) ) return;
    if ( get_posts( array( 'post_type' => 'event', 'numberposts' => 1 ) ) ) {
        update_option( 'tail_event_seeded', true );
        return;
    }

    $dummy = array(
        array(
            'title'    => 'Fundraiser Gala 2026',
            'date'     => '20260411',
            'time'     => '6:00 PM',
            'location' => 'Downtown Center',
            'link'     => '#',
        ),
        array(
            'title'    => 'Community Health Fair',
            'date'     => '20260425',
            'time'     => '10:00 AM',
            'location' => 'City Park Pavilion',
            'link'     => '#',
        ),
        array(
            'title'    => 'Volunteer Orientation',
            'date'     => '20260503',
            'time'     => '2:00 PM',
            'location' => 'BridgeWell Office',
            'link'     => '#',
        ),
    );

    foreach ( $dummy as $item ) {
        $post_id = wp_insert_post( array(
            'post_title'  => $item['title'],
            'post_status' => 'publish',
            'post_type'   => 'event',
        ) );

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, 'event_date',     $item['date'] );
            update_post_meta( $post_id, 'event_time',     $item['time'] );
            update_post_meta( $post_id, 'event_location', $item['location'] );
            update_post_meta( $post_id, 'event_link',     $item['link'] );
        }
    }

    update_option( 'tail_event_seeded', true );
} );
