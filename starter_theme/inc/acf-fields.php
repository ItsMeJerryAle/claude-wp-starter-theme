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
require_once $acf_dir . 'shared-sections.php';    // Page-meta groups: Services, Impact, Partners, CTA Contact (other page templates)

// ── Block Field Groups ────────────────────────────────────────────────────────
$blocks_dir = $acf_dir . 'blocks/';
require_once $blocks_dir . 'hero.php';
require_once $blocks_dir . 'story.php';
require_once $blocks_dir . 'services.php';
require_once $blocks_dir . 'impact.php';
require_once $blocks_dir . 'events.php';
require_once $blocks_dir . 'resources.php';
require_once $blocks_dir . 'partners.php';
require_once $blocks_dir . 'support.php';
require_once $acf_dir . 'template-donate.php';    // Donate Hero, Ways to Give
require_once $acf_dir . 'template-get-support.php';   // Get Support Hero, Application Process
require_once $acf_dir . 'template-get-involved.php';      // Get Involved Hero, Engage Section
require_once $acf_dir . 'template-service-default.php';   // Service Hero, Who Can Apply, Service Details, FAQ
