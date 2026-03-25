<?php
/**
 * ACF Field Group — Partners Block
 * Block: acf/partners
 * Render: template-parts/blocks/partners-section.php
 */

_group( 'group_block_partners', 'Partners', [
    _textarea( 'field_bk_partners_heading',     'Heading',     'partners_heading',     50, "Trusted By\nCommunity Partners", 2, 'Use a line break to split into two lines.' ),
    _textarea( 'field_bk_partners_description', 'Description', 'partners_description', 50, 'We work with leading organizations to build a stronger, more supportive network for everyone. Without duplicating efforts.' ),
    [
        'key' => 'field_bk_partners_logos', 'label' => 'Partners', 'name' => 'partners_logos',
        'type' => 'repeater', 'layout' => 'table', 'min' => 0, 'button_label' => 'Add Partner', 'wrapper' => [ 'width' => '100' ],
        'sub_fields' => [
            _image( 'field_bk_partner_logo', 'Logo', 'partner_logo', 40, 'thumbnail' ),
            _text(  'field_bk_partner_name', 'Name', 'partner_name', 30 ),
            _url(   'field_bk_partner_url',  'URL',  'partner_url',  30 ),
        ],
    ],
], [
    [ [ 'param' => 'block', 'operator' => '==', 'value' => 'acf/partners' ] ],
] );
