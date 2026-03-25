<?php
/**
 * ACF Field Group — Support Block
 * Block: acf/support
 * Render: template-parts/blocks/support-section.php
 */

_group( 'group_block_support', 'Support', [
    _tab(      'field_bk_support_tab_header',     'Header' ),
    _textarea( 'field_bk_support_heading',        'Heading',     'support_heading',     50, "Support\nAnd Care\nStart Here.", 3, 'Each line break creates a new line in the heading.' ),
    _textarea( 'field_bk_support_description',    'Description', 'support_description', 50, "Whether you're donating, volunteering, or seeking help, BridgeWell connects you to meaningful opportunities for purpose and support." ),
    _tab(      'field_bk_support_tab_ctas',       'CTAs' ),
    _msg(      'field_bk_support_left_header',    'Left Column' ),
    _text(     'field_bk_support_left_title',     'Title',       'support_left_title',  100, 'Donate' ),
    _textarea( 'field_bk_support_left_desc',      'Description', 'support_left_desc',   100, 'For those who want to help expand access to care and community support.', 2 ),
    ..._btn( 'support_left', 'Button Label', 'Button URL', 'Donate Today' ),
    _msg(      'field_bk_support_right_header',   'Right Column' ),
    _text(     'field_bk_support_right_title',    'Title',       'support_right_title', 100, 'Get Support' ),
    _textarea( 'field_bk_support_right_desc',     'Description', 'support_right_desc',  100, 'Grants for local programs in Northern Colorado', 2 ),
    ..._btn( 'support_right', 'Button Label', 'Button URL', 'Explore Support' ),
], [
    [ [ 'param' => 'block', 'operator' => '==', 'value' => 'acf/support' ] ],
] );
