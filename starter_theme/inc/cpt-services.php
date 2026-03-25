<?php
/**
 * CPT: Get Support (post type key: service)
 */

// ── 1. Register CPT ───────────────────────────────────────────────────────────
function tail_register_cpt_service() {
    $labels = array(
        'name'          => _x( 'Get Support', 'post type general name', 'starter_theme' ),
        'singular_name' => _x( 'Get Support', 'post type singular name', 'starter_theme' ),
        'add_new_item'  => __( 'Add New Get Support', 'starter_theme' ),
        'edit_item'     => __( 'Edit Get Support', 'starter_theme' ),
        'view_item'     => __( 'View Get Support', 'starter_theme' ),
        'search_items'  => __( 'Search Get Support', 'starter_theme' ),
        'not_found'     => __( 'No get support items found.', 'starter_theme' ),
        'menu_name'     => _x( 'Get Support', 'admin menu', 'starter_theme' ),
    );

    register_post_type( 'service', array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'show_in_rest'  => true,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'menu_icon'     => 'dashicons-clipboard',
        'rewrite'       => array( 'slug' => 'services' ),
    ) );
}
add_action( 'init', 'tail_register_cpt_service' );


// ── 2. Single Template Routing ────────────────────────────────────────────────
// Priority: assigned _wp_page_template meta → slug-based auto-discovery → default.
add_filter( 'single_template', function( $template ) {
    if ( get_post_type() !== 'service' ) return $template;

    $assigned = get_post_meta( get_the_ID(), '_wp_page_template', true );
    if ( $assigned && 'default' !== $assigned ) {
        $path = get_template_directory() . '/' . $assigned;
        if ( file_exists( $path ) ) return $path;
    }

    $slug   = get_post_field( 'post_name', get_the_ID() );
    $custom = get_template_directory() . "/page-templates/single-service-{$slug}.php";
    return file_exists( $custom ) ? $custom : $template;
} );


// ── 3. ACF — Short Description Field ─────────────────────────────────────────
add_action( 'acf/init', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'    => 'group_service_details',
        'title'  => 'Service Details',
        'fields' => array(

            array(
                'key'          => 'field_service_label',
                'label'        => 'Card Label',
                'name'         => 'service_label',
                'type'         => 'text',
                'instructions' => 'Short audience label shown on the card, e.g. "For Individuals".',
                'wrapper'      => array( 'width' => '50' ),
            ),
            array(
                'key'          => 'field_service_short_desc',
                'label'        => 'Short Description',
                'name'         => 'service_short_desc',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => 'A brief summary shown in listing cards (1–2 sentences).',
                'wrapper'      => array( 'width' => '100' ),
            ),

        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'service',
                ),
            ),
        ),
    ) );
} );


// ── 3. Dummy Data Seeder ──────────────────────────────────────────────────────
add_action( 'admin_init', function() {
    if ( get_option( 'tail_service_seeded' ) ) return;
    if ( get_posts( array( 'post_type' => 'service', 'numberposts' => 1 ) ) ) {
        update_option( 'tail_service_seeded', true );
        return;
    }

    $dummy = array(
        array(
            'title'      => 'Financial Support',
            'label'      => 'For Individuals',
            'content'    => '<p>Our Financial Support program provides direct assistance to individuals and families facing health-related hardships. We partner with local healthcare providers to ensure no one in Northern Colorado goes without the care they need.</p><p>Applications are reviewed on a rolling basis and awarded based on demonstrated need.</p>',
            'short_desc' => 'Direct financial assistance for individuals and families navigating health challenges.',
        ),
        array(
            'title'      => 'Community Grants',
            'label'      => 'For Organizations',
            'content'    => '<p>BridgeWell Foundation supports local nonprofits working to improve health outcomes in our region. Through our Community Grants program, we provide funding, technical assistance, and networking opportunities to help organizations expand their impact.</p><p>Eligible nonprofits can apply for grants to grow programs, hire staff, or invest in infrastructure.</p>',
            'short_desc' => 'Grants and support for nonprofits advancing health and wellness across the region.',
        ),
        array(
            'title'      => 'Healthcare Education',
            'label'      => 'For Students',
            'content'    => '<p>We offer free health education workshops covering preventive care, mental health awareness, nutrition, and chronic disease management. Sessions are led by licensed healthcare professionals and open to all community members.</p><p>Workshops are held monthly at various locations to ensure accessibility for everyone in Northern Colorado.</p>',
            'short_desc' => 'Free workshops and resources helping community members make informed health decisions.',
        ),
        array(
            'title'      => 'Mental Health Services',
            'label'      => 'For Everyone',
            'content'    => '<p>BridgeWell Foundation funds a network of licensed counselors offering sliding-scale and no-cost sessions to underserved residents. We believe mental wellness is foundational to overall community health.</p><p>Referrals are available through our office or through partnering primary care providers.</p>',
            'short_desc' => 'Connecting residents to affordable mental health counseling through our provider network.',
        ),
        array(
            'title'      => 'Youth Health Initiatives',
            'label'      => 'For Youth',
            'content'    => '<p>Our Youth Health Initiatives fund school-based programs, after-school activities, and summer camps emphasizing physical activity, healthy nutrition, and emotional resilience for children and teens.</p><p>We collaborate with school districts, youth organizations, and pediatric providers to build a comprehensive support network for young people.</p>',
            'short_desc' => 'Programs dedicated to building healthy habits and resilience in children and teens.',
        ),
    );

    foreach ( $dummy as $item ) {
        $post_id = wp_insert_post( array(
            'post_title'   => $item['title'],
            'post_content' => $item['content'],
            'post_status'  => 'publish',
            'post_type'    => 'service',
        ) );

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, 'service_label',      $item['label'] );
            update_post_meta( $post_id, 'service_short_desc', $item['short_desc'] );
        }
    }

    update_option( 'tail_service_seeded', true );
} );


// ── ACF — How We Can Help Section ─────────────────────────────────────────────
add_action( 'acf/init', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_how_we_can_help',
        'title' => 'How We Can Help Section',
        'fields' => array(

            array(
                'key'           => 'field_hwh_heading',
                'label'         => 'Section Heading',
                'name'          => 'hwh_heading',
                'type'          => 'text',
                'default_value' => 'How We Can Help',
                'wrapper'       => array( 'width' => '100' ),
            ),

            array(
                'key'          => 'field_hwh_columns',
                'label'        => 'Columns',
                'name'         => 'hwh_columns',
                'type'         => 'repeater',
                'min'          => 1,
                'max'          => 3,
                'layout'       => 'block',
                'button_label' => 'Add Column',
                'wrapper'      => array( 'width' => '100' ),
                'sub_fields'   => array(

                    array(
                        'key'     => 'field_hwh_col_title',
                        'label'   => 'Title',
                        'name'    => 'column_title',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '50' ),
                    ),
                    array(
                        'key'     => 'field_hwh_col_subtitle',
                        'label'   => 'Subtitle',
                        'name'    => 'column_subtitle',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '50' ),
                    ),
                    array(
                        'key'     => 'field_hwh_col_body',
                        'label'   => 'Body Text',
                        'name'    => 'column_body',
                        'type'    => 'textarea',
                        'rows'    => 4,
                        'wrapper' => array( 'width' => '100' ),
                    ),

                    array(
                        'key'          => 'field_hwh_col_buttons',
                        'label'        => 'Buttons',
                        'name'         => 'column_buttons',
                        'type'         => 'repeater',
                        'layout'       => 'table',
                        'button_label' => 'Add Button',
                        'wrapper'      => array( 'width' => '100' ),
                        'sub_fields'   => array(
                            array(
                                'key'     => 'field_hwh_btn_text',
                                'label'   => 'Label',
                                'name'    => 'btn_text',
                                'type'    => 'text',
                                'wrapper' => array( 'width' => '34' ),
                            ),
                            array(
                                'key'     => 'field_hwh_btn_url',
                                'label'   => 'URL',
                                'name'    => 'btn_url',
                                'type'    => 'url',
                                'wrapper' => array( 'width' => '33' ),
                            ),
                            array(
                                'key'     => 'field_hwh_btn_style',
                                'label'   => 'Style',
                                'name'    => 'btn_style',
                                'type'    => 'select',
                                'choices' => array(
                                    'solid'   => 'Solid (dark)',
                                    'outline' => 'Outline',
                                ),
                                'default_value' => 'solid',
                                'wrapper'       => array( 'width' => '33' ),
                            ),
                        ),
                    ),

                ),
            ),

        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-templates/single-service-apply-for-funds.php',
                ),
            ),
        ),
    ) );
} );


// ── ACF — FAQ Section ─────────────────────────────────────────────────────────
add_action( 'acf/init', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_service_faq',
        'title' => 'FAQ Section',
        'fields' => array(

            array(
                'key'           => 'field_faq_heading',
                'label'         => 'Section Heading',
                'name'          => 'faq_heading',
                'type'          => 'text',
                'default_value' => 'FAQ',
                'wrapper'       => array( 'width' => '100' ),
            ),

            array(
                'key'          => 'field_faq_tabs',
                'label'        => 'Tabs',
                'name'         => 'faq_tabs',
                'type'         => 'repeater',
                'min'          => 1,
                'max'          => 3,
                'layout'       => 'block',
                'button_label' => 'Add Tab',
                'wrapper'      => array( 'width' => '100' ),
                'sub_fields'   => array(

                    array(
                        'key'     => 'field_faq_tab_label',
                        'label'   => 'Tab Label',
                        'name'    => 'tab_label',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '100' ),
                    ),

                    array(
                        'key'          => 'field_faq_tab_items',
                        'label'        => 'FAQ Items',
                        'name'         => 'tab_items',
                        'type'         => 'repeater',
                        'layout'       => 'block',
                        'button_label' => 'Add Question',
                        'wrapper'      => array( 'width' => '100' ),
                        'sub_fields'   => array(
                            array(
                                'key'     => 'field_faq_item_question',
                                'label'   => 'Question',
                                'name'    => 'item_question',
                                'type'    => 'text',
                                'wrapper' => array( 'width' => '100' ),
                            ),
                            array(
                                'key'     => 'field_faq_item_answer',
                                'label'   => 'Answer',
                                'name'    => 'item_answer',
                                'type'    => 'textarea',
                                'rows'    => 3,
                                'wrapper' => array( 'width' => '100' ),
                            ),
                        ),
                    ),

                ),
            ),

        ),
        'location' => array(
            array(
                array(
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-templates/single-service-apply-for-funds.php',
                ),
            ),
        ),
    ) );
} );
