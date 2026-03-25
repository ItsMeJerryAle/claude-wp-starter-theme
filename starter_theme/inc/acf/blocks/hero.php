<?php
/**
 * ACF Field Group — Hero Block
 * Block: acf/hero
 * Render: template-parts/blocks/hero.php
 */

_group( 'group_block_hero', 'Hero', [
    _tab(      'field_bk_hero_tab_content',  'Content' ),
    _textarea( 'field_bk_hero_heading',      'Heading',                   'hero_heading',   100, "BRIDGING GAPS.\nBUILDING HOPE.", 2, 'Use line breaks to split into two lines.' ),
    _textarea( 'field_bk_hero_subtext',      'Sub-text Paragraph',        'hero_subtext',   100, 'For many, health feels out of reach. BridgeWell Foundation of Northern Colorado bridges critical gaps in health and wellness, connecting supporters to meaningful impact and neighbors to the care they deserve.', 4 ),
    _tab(      'field_bk_hero_tab_buttons',  'Buttons' ),
    _text(     'field_bk_hero_btn1_text',    'Primary Button — Label',    'hero_btn1_text',  50, 'DONATE' ),
    _url(      'field_bk_hero_btn1_url',     'Primary Button — URL',      'hero_btn1_url',   50 ),
    _text(     'field_bk_hero_btn2_text',    'Secondary Button — Label',  'hero_btn2_text',  50, 'GET SUPPORT' ),
    _url(      'field_bk_hero_btn2_url',     'Secondary Button — URL',    'hero_btn2_url',   50 ),
    _tab(      'field_bk_hero_tab_bg',       'Background' ),
    _image(    'field_bk_hero_bg_image',     'Background Image',          'hero_bg_image' ),
], [
    [ [ 'param' => 'block', 'operator' => '==', 'value' => 'acf/hero' ] ],
] );
