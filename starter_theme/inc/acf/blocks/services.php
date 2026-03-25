<?php
/**
 * ACF Field Group — Services Block
 * Block: acf/services
 * Render: template-parts/blocks/services-section.php
 */

_group( 'group_block_services', 'Services', [
    _text( 'field_bk_services_eyebrow', 'Eyebrow Text', 'services_eyebrow', 50, 'How We Help' ),
    _text( 'field_bk_services_heading', 'Heading',      'services_heading', 50, 'For Individuals & Organizations' ),
], [
    [ [ 'param' => 'block', 'operator' => '==', 'value' => 'acf/services' ] ],
] );
