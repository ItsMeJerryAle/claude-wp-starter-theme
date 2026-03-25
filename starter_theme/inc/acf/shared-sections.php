<?php
/**
 * ACF Field Groups — Shared Sections
 * Sections that appear on more than one page template.
 * Covers: Services Section, Impact Section, Partners Section, CTA Contact
 */

// ── Services Section ──────────────────────────────────────────────────────────
_group( 'group_services_section', 'Services Section', [
    _text( 'field_services_eyebrow', 'Eyebrow Text', 'services_eyebrow', 50, 'How We Help' ),
    _text( 'field_services_heading', 'Heading',      'services_heading', 50, 'For Individuals & Organizations' ),
], _loc( 'front_page', 'template-full', 'template-get-support', 'template-get-involved' ) );

// ── Impact Section ────────────────────────────────────────────────────────────
_group( 'group_impact_section', 'Impact Section', [
    _tab(  'field_impact_tab_heading',   'Heading' ),
    _text( 'field_impact_eyebrow',       'Eyebrow Text', 'impact_eyebrow',       50, 'Our Impact' ),
    _text( 'field_impact_heading',       'Heading',      'impact_heading',       50, 'Real Stories. Real Support.' ),
    _text( 'field_impact_stories_label', 'Link Label',   'impact_stories_label', 50, 'Read All Stories' ),
    _url(  'field_impact_stories_url',   'Link URL',     'impact_stories_url' ),
    _tab(  'field_impact_tab_stats',     'Stats' ),
    ..._stat( 'impact', 1, '$900K', 'Shared',  'with the community in 2025' ),
    ..._stat( 'impact', 2, '72',    'Families', 'directly supported in 2025' ),
    ..._stat( 'impact', 3, '$40M',  'Donated',  'to the community since 1981' ),
], _loc( 'front_page', 'template-full', 'template-donate', 'template-get-involved' ) );

// ── Partners Section ──────────────────────────────────────────────────────────
_group( 'group_partners_section', 'Partners Section', [
    _textarea( 'field_partners_heading',     'Heading',     'partners_heading',     50, "Trusted By\nCommunity Partners", 2, 'Use a line break to split into two lines.' ),
    _textarea( 'field_partners_description', 'Description', 'partners_description', 50, 'We work with leading organizations to build a stronger, more supportive network for everyone. Without duplicating efforts.' ),
    [
        'key' => 'field_partners_logos', 'label' => 'Partners', 'name' => 'partners_logos',
        'type' => 'repeater', 'layout' => 'table', 'min' => 0, 'button_label' => 'Add Partner', 'wrapper' => [ 'width' => '100' ],
        'sub_fields' => [
            _image( 'field_partner_logo', 'Logo', 'partner_logo', 40, 'thumbnail' ),
            _text(  'field_partner_name', 'Name', 'partner_name', 30 ),
            _url(   'field_partner_url',  'URL',  'partner_url',  30 ),
        ],
    ],
], _loc( 'front_page', 'template-full', 'template-get-involved' ) );

// ── CTA Contact Section ───────────────────────────────────────────────────────
_group( 'group_cta_contact', 'CTA Contact', [
    _textarea( 'field_cta_contact_heading',  'Heading',          'cta_contact_heading',  100, "Questions\nAbout Giving?", 2, 'Use line breaks to split into two lines.' ),
    _text(     'field_cta_contact_desc',     'Description',      'cta_contact_desc',     100, 'Our team is available to help answer your questions about giving and support.' ),
    ..._btn( 'cta_contact', 'Button Text', 'Button URL', 'Contact Us' ),
    _image(    'field_cta_contact_bg_image', 'Background Image', 'cta_contact_bg_image' ),
], array_merge( _loc( 'template-donate', 'template-get-support', 'template-get-involved' ), _loc( 'single-service-apply-for-funds' ) ) );
