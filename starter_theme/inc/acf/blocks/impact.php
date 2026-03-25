<?php
/**
 * ACF Field Group — Impact Block
 * Block: acf/impact
 * Render: template-parts/blocks/impact-section.php
 */

_group( 'group_block_impact', 'Impact', [
    _tab(  'field_bk_impact_tab_heading',   'Heading' ),
    _text( 'field_bk_impact_eyebrow',       'Eyebrow Text', 'impact_eyebrow',       50, 'Our Impact' ),
    _text( 'field_bk_impact_heading',       'Heading',      'impact_heading',       50, 'Real Stories. Real Support.' ),
    _text( 'field_bk_impact_stories_label', 'Link Label',   'impact_stories_label', 50, 'Read All Stories' ),
    _url(  'field_bk_impact_stories_url',   'Link URL',     'impact_stories_url',   50 ),
    _tab(  'field_bk_impact_tab_stats',     'Stats' ),
    ..._stat( 'impact', 1, '$900K', 'Shared',   'with the community in 2025' ),
    ..._stat( 'impact', 2, '72',    'Families', 'directly supported in 2025' ),
    ..._stat( 'impact', 3, '$40M',  'Donated',  'to the community since 1981' ),
], [
    [ [ 'param' => 'block', 'operator' => '==', 'value' => 'acf/impact' ] ],
] );
