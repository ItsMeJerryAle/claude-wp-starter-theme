<?php
/**
 * ACF Field Groups — Apply for Funds Page Template
 * File: page-templates/template-apply-for-funds.php
 * Specific to: /services/apply-for-funds/
 */

// ── Apply for Funds Hero ──────────────────────────────────────────────────────
_group( 'group_apply_for_funds', 'Page Hero', [
    _text(     'field_apply_funds_heading',     'Heading',     'apply_funds_heading',     100, 'APPLY FOR FUNDS' ),
    _textarea( 'field_apply_funds_description', 'Description', 'apply_funds_description', 100 ),
], _loc( 'template-apply-for-funds' ) );
