<?php
/**
 * ACF Field Group — Events Block
 * Block: acf/events
 * Render: template-parts/blocks/events-section.php
 */

_group( 'group_block_events', 'Events', [
    _tab(      'field_bk_events_tab_heading',      'Heading' ),
    _text(     'field_bk_events_eyebrow',          'Eyebrow Text', 'events_eyebrow',         50, 'Upcoming Events & Volunteering' ),
    _text(     'field_bk_events_heading',          'Heading',      'events_heading',         50, 'Join Us in Making a Difference' ),
    _text(     'field_bk_events_view_all_label',   'Link Label',   'events_view_all_label',  50, 'View All Events' ),
    _url(      'field_bk_events_view_all_url',     'Link URL',     'events_view_all_url',    50 ),
    _tab(      'field_bk_events_tab_cards',        'Events' ),
    _msg(      'field_bk_events_featured_header',  'Featured Event (large left card)' ),
    _post_obj( 'field_bk_events_featured',         'Event', 'events_featured',  'event' ),
    _msg(      'field_bk_events_sidebar1_header',  'Sidebar Event 1' ),
    _post_obj( 'field_bk_events_sidebar_1',        'Event', 'events_sidebar_1', 'event' ),
    _msg(      'field_bk_events_sidebar2_header',  'Sidebar Event 2' ),
    _post_obj( 'field_bk_events_sidebar_2',        'Event', 'events_sidebar_2', 'event' ),
    _tab(      'field_bk_events_tab_volunteer',    'Volunteer' ),
    _text(     'field_bk_events_vol_eyebrow',      'Eyebrow',     'events_vol_eyebrow', 50, 'Title Goes Here' ),
    _text(     'field_bk_events_vol_title',        'Title',       'events_vol_title',   50, 'Volunteer Opportunities' ),
    _textarea( 'field_bk_events_vol_desc',         'Description', 'events_vol_desc',   100, 'Admin, event, and ambassador roles available.' ),
    ..._btn( 'events_vol', 'Button Label', 'Button URL', 'Sign Up Today' ),
    _image(    'field_bk_events_vol_image',        'Right Image', 'events_vol_image' ),
], [
    [ [ 'param' => 'block', 'operator' => '==', 'value' => 'acf/events' ] ],
] );
