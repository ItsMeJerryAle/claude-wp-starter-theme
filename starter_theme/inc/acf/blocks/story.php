<?php
/**
 * ACF Field Group — Story Block
 * Block: acf/story
 * Render: template-parts/blocks/story.php
 */

_group( 'group_block_story', 'Story', [
    _tab(      'field_bk_story_tab_cards',             'Action Cards' ),
    _msg(      'field_bk_story_card1_header',           'Card 1' ),
    _text(     'field_bk_story_card1_title',            'Title',       'story_card1_title', 100, 'GET SUPPORT' ),
    _url(      'field_bk_story_card1_url',              'URL',         'story_card1_url',   100 ),
    _textarea( 'field_bk_story_card1_body',             'Description', 'story_card1_body',  100 ),
    _msg(      'field_bk_story_card2_header',           'Card 2' ),
    _text(     'field_bk_story_card2_title',            'Title',       'story_card2_title', 100, 'GET INVOLVED' ),
    _url(      'field_bk_story_card2_url',              'URL',         'story_card2_url',   100 ),
    _textarea( 'field_bk_story_card2_body',             'Description', 'story_card2_body',  100 ),
    _tab(      'field_bk_story_tab_testimonial',        'Testimonial' ),
    _image(    'field_bk_story_testimonial_image',      'Background Image', 'story_testimonial_image' ),
    _textarea( 'field_bk_story_testimonial_quote',      'Quote',       'story_testimonial_quote' ),
    _text(     'field_bk_story_testimonial_name',       'Name',        'story_testimonial_name' ),
    _text(     'field_bk_story_testimonial_role',       'Role / Title','story_testimonial_role' ),
    _text(     'field_bk_story_testimonial_link_text',  'Button Label','story_testimonial_link_text', 50, 'READ FULL STORY' ),
    _url(      'field_bk_story_testimonial_link_url',   'Button URL',  'story_testimonial_link_url',  50 ),
], [
    [ [ 'param' => 'block', 'operator' => '==', 'value' => 'acf/story' ] ],
] );
