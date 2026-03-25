<?php
/**
 * ACF Field Groups — Loader
 *
 * Field definitions live in inc/acf/ — one file per page template or context.
 * To add fields for a new page template, create inc/acf/template-{slug}.php
 * and add a require_once line below.
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

// ── Load Field Group Files ────────────────────────────────────────────────────
$acf_dir = get_template_directory() . '/inc/acf/';

require_once $acf_dir . 'helpers.php';            // Helper functions (required first)
require_once $acf_dir . 'options.php';            // Topbar, Header, Footer
require_once $acf_dir . 'front-page.php';         // Hero, Story, Events, Resources, Support
require_once $acf_dir . 'shared-sections.php';    // Services, Impact, Partners, CTA Contact
require_once $acf_dir . 'template-donate.php';    // Donate Hero, Ways to Give
require_once $acf_dir . 'template-get-support.php';   // Get Support Hero, Application Process
require_once $acf_dir . 'template-get-involved.php';      // Get Involved Hero, Engage Section
require_once $acf_dir . 'template-service-default.php';   // Service Hero, Who Can Apply, Service Details, FAQ
