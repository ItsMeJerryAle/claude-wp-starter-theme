<?php
/**
 * ACF Field Groups — Front Page
 * Covers: Hero Section, Story Section, Events Section, Resources Section, Support Section
 *
 * Sections that also appear on inner pages (Services, Impact, Partners) are in shared-sections.php.
 */

// ── Hero Section ──────────────────────────────────────────────────────────────
_group( 'group_hero_section', 'Hero Section', [
    _tab(      'field_hero_tab_content',  'Content' ),
    _textarea( 'field_hero_heading',      'Heading',             'hero_heading', 100, "BRIDGING GAPS.\nBUILDING HOPE.", 2, 'Use line breaks to split into two lines.' ),
    _textarea( 'field_hero_subtext',      'Sub-text Paragraph',  'hero_subtext', 100, 'For many, health feels out of reach. BridgeWell Foundation of Northern Colorado bridges critical gaps in health and wellness, connecting supporters to meaningful impact and neighbors to the care they deserve.', 4 ),
    _tab(      'field_hero_tab_buttons',  'Buttons' ),
    _text(     'field_hero_btn1_text',    'Primary Button — Label',    'hero_btn1_text', 50, 'DONATE' ),
    _url(      'field_hero_btn1_url',     'Primary Button — URL',      'hero_btn1_url' ),
    _text(     'field_hero_btn2_text',    'Secondary Button — Label',  'hero_btn2_text', 50, 'GET SUPPORT' ),
    _url(      'field_hero_btn2_url',     'Secondary Button — URL',    'hero_btn2_url' ),
    _tab(      'field_hero_tab_bg',       'Background' ),
    _image(    'field_hero_bg_image',     'Background Image (right column)', 'hero_bg_image' ),
], _loc( 'front_page' ) );

// ── Story Section ─────────────────────────────────────────────────────────────
_group( 'group_story_section', 'Story Section', [
    _tab(      'field_story_tab_cards',             'Action Cards' ),
    _msg(      'field_story_card1_header',           'Card 1' ),
    _text(     'field_story_card1_title',            'Title',       'story_card1_title', 100, 'GET SUPPORT' ),
    _url(      'field_story_card1_url',              'URL',         'story_card1_url',   100 ),
    _textarea( 'field_story_card1_body',             'Description', 'story_card1_body',  100 ),
    _msg(      'field_story_card2_header',           'Card 2' ),
    _text(     'field_story_card2_title',            'Title',       'story_card2_title', 100, 'GET INVOLVED' ),
    _url(      'field_story_card2_url',              'URL',         'story_card2_url',   100 ),
    _textarea( 'field_story_card2_body',             'Description', 'story_card2_body',  100 ),
    _tab(      'field_story_tab_testimonial',        'Testimonial' ),
    _image(    'field_story_testimonial_image',      'Background Image', 'story_testimonial_image' ),
    _textarea( 'field_story_testimonial_quote',      'Quote',       'story_testimonial_quote' ),
    _text(     'field_story_testimonial_name',       'Name',        'story_testimonial_name' ),
    _text(     'field_story_testimonial_role',       'Role / Title','story_testimonial_role' ),
    _text(     'field_story_testimonial_link_text',  'Button Label','story_testimonial_link_text', 50, 'READ FULL STORY' ),
    _url(      'field_story_testimonial_link_url',   'Button URL',  'story_testimonial_link_url' ),
], _loc( 'front_page', 'template-full' ) );

// ── Events Section ────────────────────────────────────────────────────────────
_group( 'group_events_section', 'Events Section', [
    _tab(      'field_events_tab_heading',      'Heading' ),
    _text(     'field_events_eyebrow',          'Eyebrow Text', 'events_eyebrow',         50, 'Upcoming Events & Volunteering' ),
    _text(     'field_events_heading',          'Heading',      'events_heading',         50, 'Join Us in Making a Difference' ),
    _text(     'field_events_view_all_label',   'Link Label',   'events_view_all_label',  50, 'View All Events' ),
    _url(      'field_events_view_all_url',     'Link URL',     'events_view_all_url' ),
    _tab(      'field_events_tab_cards',        'Events' ),
    _msg(      'field_events_featured_header',  'Featured Event (large left card)' ),
    _post_obj( 'field_events_featured',         'Event', 'events_featured',  'event' ),
    _msg(      'field_events_sidebar1_header',  'Sidebar Event 1' ),
    _post_obj( 'field_events_sidebar_1',        'Event', 'events_sidebar_1', 'event' ),
    _msg(      'field_events_sidebar2_header',  'Sidebar Event 2' ),
    _post_obj( 'field_events_sidebar_2',        'Event', 'events_sidebar_2', 'event' ),
    _tab(      'field_events_tab_volunteer',    'Volunteer' ),
    _text(     'field_events_vol_eyebrow',      'Eyebrow',     'events_vol_eyebrow', 50, 'Title Goes Here' ),
    _text(     'field_events_vol_title',        'Title',       'events_vol_title',   50, 'Volunteer Opportunities' ),
    _textarea( 'field_events_vol_desc',         'Description', 'events_vol_desc',   100, 'Admin, event, and ambassador roles available.' ),
    ..._btn( 'events_vol', 'Button Label', 'Button URL', 'Sign Up Today' ),
    _image(    'field_events_vol_image',        'Right Image', 'events_vol_image' ),
], _loc( 'front_page', 'template-full' ) );

// ── Resources Section ─────────────────────────────────────────────────────────
_group( 'group_resources_section', 'Resources Section', [
    _text( 'field_resources_eyebrow',        'Eyebrow Text',    'resources_eyebrow',        50, 'Resources' ),
    _text( 'field_resources_heading',        'Heading',         'resources_heading',        50, 'Latest Guides & Reports' ),
    _text( 'field_resources_view_all_label', 'Link Label',      'resources_view_all_label', 33, 'View All Resources' ),
    _url(  'field_resources_view_all_url',   'Link URL',        'resources_view_all_url',   33 ),
    [ 'key' => 'field_resources_post_count', 'label' => 'Number of Posts', 'name' => 'resources_post_count', 'type' => 'number', 'default_value' => 3, 'min' => 1, 'max' => 12, 'wrapper' => [ 'width' => '33' ] ],
], _loc( 'front_page', 'template-full' ) );

// ── Support Section ───────────────────────────────────────────────────────────
_group( 'group_support_section', 'Support Section', [
    _tab(      'field_support_tab_header',     'Header' ),
    _textarea( 'field_support_heading',        'Heading',     'support_heading',     50, "Support\nAnd Care\nStart Here.", 3, 'Each line break creates a new line in the heading.' ),
    _textarea( 'field_support_description',    'Description', 'support_description', 50, "Whether you're donating, volunteering, or seeking help, BridgeWell connects you to meaningful opportunities for purpose and support." ),
    _tab(      'field_support_tab_ctas',       'CTAs' ),
    _msg(      'field_support_left_header',    'Left Column' ),
    _text(     'field_support_left_title',     'Title',       'support_left_title',  100, 'Donate' ),
    _textarea( 'field_support_left_desc',      'Description', 'support_left_desc',   100, 'For those who want to help expand access to care and community support.', 2 ),
    ..._btn( 'support_left', 'Button Label', 'Button URL', 'Donate Today' ),
    _msg(      'field_support_right_header',   'Right Column' ),
    _text(     'field_support_right_title',    'Title',       'support_right_title', 100, 'Get Support' ),
    _textarea( 'field_support_right_desc',     'Description', 'support_right_desc',  100, 'Grants for local programs in Northern Colorado', 2 ),
    ..._btn( 'support_right', 'Button Label', 'Button URL', 'Explore Support' ),
], _loc( 'front_page', 'template-full' ) );
