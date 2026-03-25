<?php
/**
 * ACF Field Groups — Service Default Page Template
 * File: page-templates/single-service-default.php
 * Covers: Service Hero, Who Can Apply, Service Details (Cards), FAQ
 *
 * Also uses: Application Process (see template-get-support.php),
 *            Resources + Support (see shared-sections.php — all pages)
 */

// ── Service Hero ──────────────────────────────────────────────────────────────
_group( 'group_hero_service_default', 'Service Hero', [
	_textarea( 'field_service_hero_heading',     'Heading',     'service_hero_heading',     100, '', 3, 'Defaults to post title if empty.' ),
	_textarea( 'field_service_hero_description', 'Description', 'service_hero_description', 100, '', 3 ),
	..._btn( 'service_hero', 'Button Text', 'Button URL', 'Apply Now' ),
], _loc( 'single-service-default' ) );

// ── Who Can Apply Section ─────────────────────────────────────────────────────
_group( 'group_who_can_apply', 'Who Can Apply', [
	_text(     'field_wca_eyebrow',      'Eyebrow',      'wca_eyebrow',      50, 'Qualification' ),
	_text(     'field_wca_heading',      'Heading',      'wca_heading',      50, 'Who Can Apply' ),
	_textarea( 'field_wca_description',  'Description',  'wca_description',  100, '', 3 ),
	[
		'key' => 'field_wca_criteria', 'label' => 'Eligibility Criteria', 'name' => 'wca_criteria',
		'type' => 'repeater', 'min' => 1, 'max' => 8, 'layout' => 'table', 'button_label' => 'Add Criterion',
		'sub_fields' => [
			_text( 'field_wca_criterion_text', 'Text', 'criterion_text', 100 ),
		],
	],
	_text(     'field_wca_sidebar_heading', 'Sidebar Heading',      'wca_sidebar_heading', 50, 'Get Started' ),
	_textarea( 'field_wca_sidebar_desc',   'Sidebar Description',  'wca_sidebar_desc',    100, '', 3 ),
	_text(     'field_wca_checklist_label', 'Checklist Label',      'wca_checklist_label', 50, 'What to Have Ready' ),
	[
		'key' => 'field_wca_checklist_items', 'label' => 'Checklist Items', 'name' => 'wca_checklist_items',
		'type' => 'repeater', 'min' => 1, 'max' => 8, 'layout' => 'table', 'button_label' => 'Add Item',
		'sub_fields' => [
			_text(  'field_wca_item_text', 'Item Text', 'item_text', 70 ),
			_image( 'field_wca_item_icon', 'Icon',      'item_icon', 30, 'thumbnail' ),
		],
	],
	..._btn( 'wca_primary',   'Primary Button Text',   'Primary Button URL',   'Apply Now' ),
	..._btn( 'wca_secondary', 'Secondary Button Text', 'Secondary Button URL', '' ),
], _loc( 'single-service-default' ) );

// ── Service Details Section ───────────────────────────────────────────────────
_group( 'group_service_details_section', 'Service Details (Cards)', [
	_text(     'field_sds_eyebrow',     'Eyebrow',     'sds_eyebrow',     50, 'We Are Here For You' ),
	_text(     'field_sds_heading',     'Heading',     'sds_heading',     50 ),
	_textarea( 'field_sds_description', 'Description', 'sds_description', 100, '', 3 ),
	[
		'key' => 'field_sds_cards', 'label' => 'Service Cards', 'name' => 'sds_cards',
		'type' => 'repeater', 'min' => 0, 'max' => 6, 'layout' => 'block', 'button_label' => 'Add Service Card',
		'sub_fields' => [
			_text(     'field_sds_card_title',        'Card Title',                    'card_title',        100 ),
			_textarea( 'field_sds_card_description',  'Card Description',              'card_description',  100, '', 3 ),
			_text(     'field_sds_card_col1_heading', 'Column 1 Heading',              'card_col1_heading', 50, 'What We Cover' ),
			_textarea( 'field_sds_card_col1_items',   'Column 1 Items (one per line)', 'card_col1_items',   50, '', 6 ),
			_text(     'field_sds_card_col2_heading', 'Column 2 Heading',              'card_col2_heading', 50, 'Living Expenses We Can Help With' ),
			_textarea( 'field_sds_card_col2_items',   'Column 2 Items (one per line)', 'card_col2_items',   50, '', 6 ),
		],
	],
], _loc( 'single-service-default' ) );

// ── FAQ Section ───────────────────────────────────────────────────────────────
_group( 'group_faq_service', 'FAQ', [
	_text( 'field_faq_eyebrow', 'Eyebrow', 'faq_eyebrow', 50, '' ),
	_text( 'field_faq_heading', 'Heading', 'faq_heading', 50, 'FAQ' ),
	[
		'key' => 'field_faq_items', 'label' => 'FAQ Items', 'name' => 'faq_items',
		'type' => 'repeater', 'min' => 0, 'max' => 20, 'layout' => 'block', 'button_label' => 'Add FAQ Item',
		'sub_fields' => [
			_text(     'field_faq_question', 'Question', 'faq_question', 100 ),
			_textarea( 'field_faq_answer',   'Answer',   'faq_answer',   100, '', 4 ),
		],
	],
], _loc( 'single-service-default' ) );
