<?php
/**
 * ACF Field Groups — Get Involved Page Template
 * File: page-templates/template-get-involved.php
 * Covers: Get Involved Hero, Engage Section
 *
 * Also uses: Services Section, Partners Section, Impact Section, CTA Contact (see shared-sections.php)
 */

// ── Get Involved Hero ─────────────────────────────────────────────────────────
_group( 'group_hero_get_involved', 'Get Involved Hero', [
    _textarea( 'field_hero_gi_heading',     'Heading',     'hero_gi_heading',     100, "GET\nINVOLVED", 3, 'Use line breaks for multi-line layout.' ),
    _textarea( 'field_hero_gi_description', 'Description', 'hero_gi_description', 100 ),
    ..._btn( 'hero_gi', 'Button Text', 'Button URL', 'Donate Now' ),
], _loc( 'template-get-involved' ) );

// ── Engage Section ────────────────────────────────────────────────────────────
_group( 'group_engage_section', 'Engage Section', [
    // Header
    _text(     'field_engage_eyebrow',      'Eyebrow',      'engage_eyebrow',      50,  'Ways to Engage' ),
    _text(     'field_engage_heading',      'Heading',      'engage_heading',       50,  'Business & Organization Partnerships' ),
    _textarea( 'field_engage_description',  'Description',  'engage_description',  100 ),
    // Image Card 1
    _msg(      'field_engage_card1_header', 'Image Card 1' ),
    _image(    'field_engage_card1_image',  'Background Image', 'engage_card1_image' ),
    _text(     'field_engage_card1_title',  'Title',        'engage_card1_title',  100, 'Corporate Sponsorships' ),
    _textarea( 'field_engage_card1_desc',   'Description',  'engage_card1_desc',   100 ),
    _url(      'field_engage_card1_url',    'Link URL',     'engage_card1_url',    100 ),
    // Image Card 2
    _msg(      'field_engage_card2_header', 'Image Card 2' ),
    _image(    'field_engage_card2_image',  'Background Image', 'engage_card2_image' ),
    _text(     'field_engage_card2_title',  'Title',        'engage_card2_title',  100, 'Community Partners' ),
    _textarea( 'field_engage_card2_desc',   'Description',  'engage_card2_desc',   100 ),
    _url(      'field_engage_card2_url',    'Link URL',     'engage_card2_url',    100 ),
    // Mini Card 1
    _msg(      'field_engage_mini1_header', 'Mini Card 1' ),
    _text(     'field_engage_mini1_title',  'Title',        'engage_mini1_title',  100, 'Fund Our Work' ),
    _textarea( 'field_engage_mini1_desc',   'Description',  'engage_mini1_desc',   100 ),
    _url(      'field_engage_mini1_url',    'Link URL',     'engage_mini1_url',    100 ),
    // Mini Card 2
    _msg(      'field_engage_mini2_header', 'Mini Card 2' ),
    _text(     'field_engage_mini2_title',  'Title',        'engage_mini2_title',  100, 'For Professional Advisors' ),
    _textarea( 'field_engage_mini2_desc',   'Description',  'engage_mini2_desc',   100 ),
    _url(      'field_engage_mini2_url',    'Link URL',     'engage_mini2_url',    100 ),
    // Bottom CTA
    _msg(      'field_engage_cta_header',   'Bottom CTA Card' ),
    _text(     'field_engage_cta_eyebrow',  'Eyebrow',      'engage_cta_eyebrow',   50, 'Have Questions?' ),
    _text(     'field_engage_cta_title',    'Title',        'engage_cta_title',     50, 'Partnership Opportunities' ),
    _textarea( 'field_engage_cta_desc',     'Description',  'engage_cta_desc',     100 ),
    ..._btn( 'engage_cta', 'Button Text', 'Button URL', 'Contact Us' ),
    // Bottom Image
    _image(    'field_engage_bottom_image', 'Bottom Image Card', 'engage_bottom_image' ),
], _loc( 'template-get-involved' ) );
