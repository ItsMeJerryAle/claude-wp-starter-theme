<?php
/**
 * ACF Field Groups — Options Page
 *
 * These groups are rendered via acf_form() in inc/theme-settings-page.php.
 * The Theme Settings admin page uses tab navigation to switch between them:
 *   Site Settings   → group_site_settings
 *   Header & Topbar → group_topbar, group_header
 *   Footer          → group_footer
 *
 * Contact Details live on Site Settings under "site_" prefixed field names
 * (e.g. site_address, site_phone) and are accessible site-wide via
 * get_field('site_address', 'option').
 */

// ── Site Settings ─────────────────────────────────────────────────────────────
_group( 'group_site_settings', 'Site Settings', [

    // ── Contact Details ───────────────────────────────────────────────────────
    _tab(      'field_site_tab_contact',      'Contact Details' ),
    _textarea( 'field_site_address',          'Address',          'site_address',       100, "808 W Eisenhower Blvd, Ste 202\nLoveland, CO 80537", 2 ),
    _text(     'field_site_phone',            'Phone',            'site_phone',          50, '(970) 617-2575' ),
    _text(     'field_site_email',            'Email',            'site_email',          50, 'info@bridgewell.org' ),
    _url(      'field_site_facebook_url',     'Facebook URL',     'site_facebook_url',   50 ),
    _url(      'field_site_youtube_url',      'YouTube URL',      'site_youtube_url',    50 ),
    _url(      'field_site_linkedin_url',     'LinkedIn URL',     'site_linkedin_url',   50 ),
    _url(      'field_site_instagram_url',    'Instagram URL',    'site_instagram_url',  50 ),

], _loc( 'options' ) );

// ── Topbar ────────────────────────────────────────────────────────────────────
_group( 'group_topbar', 'Topbar / Announcement Bar', [

    _tab(    'field_topbar_tab_content',   'Content' ),
    _toggle( 'field_topbar_enabled',       'Show Topbar',                   'topbar_enabled',      50, 1 ),
    _toggle( 'field_topbar_dismissible',   'Allow Dismiss (show × button)', 'topbar_dismissible',  50, 1 ),
    _text(   'field_topbar_message',       'Message',                       'topbar_message',     100, 'Bridgewell Foundation is Formerly McKee Wellness Foundation' ),
    _tab(    'field_topbar_tab_style',     'Style' ),
    _color(  'field_topbar_bg_color',      'Background Color',              'topbar_bg_color',   '#172d35' ),
    _color(  'field_topbar_text_color',    'Text Color',                    'topbar_text_color', '#c8b96e' ),

], _loc( 'options' ) );

// ── Header ────────────────────────────────────────────────────────────────────
_group( 'group_header', 'Header Settings', [

    _tab( 'field_header_tab_cta',    'CTA' ),
    _url( 'field_header_donate_url', 'Donate Button URL', 'header_donate_url' ),

], _loc( 'options' ) );

// ── Footer ────────────────────────────────────────────────────────────────────
_group( 'group_footer', 'Footer', [

    _tab(      'field_footer_tab_newsletter',     'Newsletter' ),
    _text(     'field_footer_newsletter_heading', 'Section Heading',           'footer_newsletter_heading', 50,  'Stay Connected' ),
    _url(      'field_footer_mailchimp_url',      'MailChimp Form Action URL', 'footer_mailchimp_url',      100, 'Paste the form action URL from your MailChimp embedded form code.' ),

    _tab(      'field_footer_tab_legal',          'Legal' ),
    _text(     'field_footer_copyright',          'Copyright Text',            'footer_copyright',          100, '© ' . date('Y') . ' BridgeWell Foundation. All rights reserved.' ),
    _url(      'field_footer_privacy_url',        'Privacy Policy URL',        'footer_privacy_url' ),
    _url(      'field_footer_accessibility_url',  'Accessibility URL',         'footer_accessibility_url' ),
    _image(    'field_footer_badge_1',            'Badge 1 (e.g. GuideStar Platinum)',  'footer_badge_1', 50, 'thumbnail' ),
    _image(    'field_footer_badge_2',            'Badge 2 (e.g. Charity Navigator)',   'footer_badge_2', 50, 'thumbnail' ),

], _loc( 'options' ) );
