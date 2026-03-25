<?php
/**
 * ACF Field Group — Resources Block
 * Block: acf/resources
 * Render: template-parts/blocks/resources-section.php
 */

_group( 'group_block_resources', 'Resources', [
    _text( 'field_bk_resources_eyebrow',        'Eyebrow Text', 'resources_eyebrow',        50, 'Resources' ),
    _text( 'field_bk_resources_heading',        'Heading',      'resources_heading',        50, 'Latest Guides & Reports' ),
    _text( 'field_bk_resources_view_all_label', 'Link Label',   'resources_view_all_label', 33, 'View All Resources' ),
    _url(  'field_bk_resources_view_all_url',   'Link URL',     'resources_view_all_url',   33 ),
    [ 'key' => 'field_bk_resources_post_count', 'label' => 'Number of Posts', 'name' => 'resources_post_count', 'type' => 'number', 'default_value' => 3, 'min' => 1, 'max' => 12, 'wrapper' => [ 'width' => '33' ] ],
], [
    [ [ 'param' => 'block', 'operator' => '==', 'value' => 'acf/resources' ] ],
] );
