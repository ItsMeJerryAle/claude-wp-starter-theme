<?php
/**
 * ACF Field Groups — Donate Page Template
 * File: page-templates/template-donate.php
 * Covers: Donate Hero, Ways to Give Section
 *
 * Also uses: Impact Section, CTA Contact (see shared-sections.php)
 */

// ── Donate Hero ───────────────────────────────────────────────────────────────
_group( 'group_hero_donate', 'Donate Hero', [
    _textarea( 'field_donate_hero_heading',      'Heading',                    'donate_hero_heading',      100, "Donate to\nBridgeWell\nFoundation", 3, 'Use line breaks to split into multiple lines.' ),
    _text(     'field_donate_hero_desc',         'Description',                'donate_hero_desc',         100, 'Your support advances community-wide care. Join the movement toward a healthier, more connected Northern Colorado.' ),
    ..._btn( 'donate_hero', 'Button Text', 'Button URL', 'Other Ways to Give' ),
    _url(      'field_donate_hero_form_url',     'Donation Form URL (fallback)','donate_hero_form_url',    100, 'Fallback URL if Virtuous is not configured.' ),
    _url(      'field_donate_hero_virtuous_url', 'Virtuous Donation Form URL',  'donate_hero_virtuous_url', 100, 'Embed URL from Virtuous Software (e.g. https://app.virtuoussoftware.com/Giving/Embed/{id}). Amount and frequency will be appended as ?amount=100&frequency=Recurring.' ),
], _loc( 'template-donate' ) );

// ── Ways to Give Section ──────────────────────────────────────────────────────
_group( 'group_ways_to_give', 'Ways to Give Section', [
    _tab(      'field_ways_tab_header',        'Header' ),
    _text(     'field_ways_eyebrow',           'Eyebrow',     'ways_eyebrow',     50, 'Make an Impact' ),
    _textarea( 'field_ways_heading',           'Heading',     'ways_heading',     50, "Other Ways\nto Give", 2, 'Use line breaks to split into two lines.' ),
    _text(     'field_ways_description',       'Description', 'ways_description', 100, 'There are many ways to support our mission beyond direct donations. Explore the options below to find what works best for you.' ),
    _tab(      'field_ways_tab_featured',      'Featured Card' ),
    _image(    'field_ways_featured_image',    'Background Image',  'ways_featured_image' ),
    _text(     'field_ways_featured_heading',  'Heading',           'ways_featured_heading', 100, 'Qualified Charitable Distributions' ),
    _textarea( 'field_ways_featured_desc',     'Description',       'ways_featured_desc',    100, 'If you are 70½ or older, you can make a tax-free gift directly from your IRA to BridgeWell Foundation.' ),
    ..._btn( 'ways_featured', 'Button Text', 'Button URL', 'Contact Us' ),
    _tab(      'field_ways_tab_mail',          'Mail a Check' ),
    _text(     'field_ways_mail_heading',      'Heading',       'ways_mail_heading', 100, 'Mail a Check' ),
    _text(     'field_ways_mail_desc',         'Description',   'ways_mail_desc',    100, 'Make your check payable to BridgeWell Foundation and mail it to the address below.' ),
    _textarea( 'field_ways_mail_address',      'Mailing Address','ways_mail_address', 100, "BridgeWell Foundation\n808 W Eisenhower Blvd, Ste 202\nLoveland, CO 80537", 3, 'Displayed in a bordered box with a copy-to-clipboard button.' ),
    _tab(      'field_ways_tab_cards',         'Bottom Cards' ),
    [
        'key' => 'field_ways_bottom_cards', 'label' => 'Giving Options', 'name' => 'ways_bottom_cards',
        'type' => 'repeater', 'min' => 1, 'max' => 3, 'layout' => 'block', 'button_label' => 'Add Card',
        'sub_fields' => [
            _image( 'field_ways_card_icon',     'Icon',        'icon',     100, 'thumbnail' ),
            _text(  'field_ways_card_heading',  'Heading',     'heading',  100 ),
            _textarea( 'field_ways_card_desc',  'Description', 'desc',     100, null, 2 ),
            _text(  'field_ways_card_btn_text', 'Button Text', 'btn_text', 50, 'Learn More' ),
            _url(   'field_ways_card_btn_url',  'Button URL',  'btn_url' ),
        ],
    ],
], _loc( 'template-donate' ) );
