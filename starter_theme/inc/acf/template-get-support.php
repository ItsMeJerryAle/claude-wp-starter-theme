<?php
/**
 * ACF Field Groups — Get Support Page Template
 * File: page-templates/template-get-support.php
 * Covers: Get Support Hero, Application Process Section
 *
 * Also uses: Services Section, CTA Contact (see shared-sections.php)
 */

// ── Get Support Hero ──────────────────────────────────────────────────────────
_group( 'group_hero_get_support', 'Get Support Hero', [
    _textarea( 'field_hero_gs_heading',     'Heading',     'hero_gs_heading',     100, "FIND THE\nSUPPORT YOU\nNEED", 3, 'Use line breaks for multi-line layout.' ),
    _textarea( 'field_hero_gs_description', 'Description', 'hero_gs_description', 100 ),
    ..._btn( 'hero_gs', 'Button Text', 'Button URL', 'Apply for Funds' ),
], _loc( 'template-get-support' ) );

// ── Application Process Section ───────────────────────────────────────────────
_group( 'group_application_process', 'Application Process Section', [
    _text( 'field_app_eyebrow',  'Eyebrow',     'app_eyebrow',  50, 'What to Expect' ),
    _text( 'field_app_heading',  'Heading',     'app_heading',  50, 'Application Process' ),
    ..._btn( 'app', 'Button Text', 'Button URL', 'Get Started' ),
    [
        'key' => 'field_app_steps', 'label' => 'Steps', 'name' => 'app_steps',
        'type' => 'repeater', 'min' => 1, 'max' => 6, 'layout' => 'table', 'button_label' => 'Add Step',
        'sub_fields' => [
            _text(     'field_app_step_title', 'Step Title',   'step_title', 40 ),
            _textarea( 'field_app_step_desc',  'Description',  'step_desc',  60, null, 2 ),
        ],
    ],
], array_merge( _loc( 'template-get-support' ), _loc( 'single-service-apply-for-funds' ), _loc( 'single-service-default' ) ) );
