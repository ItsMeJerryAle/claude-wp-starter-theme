# ACF Field Groups — File Structure Rule

All ACF field group definitions live in `inc/acf/`. The main `inc/acf-fields.php` is a thin loader only — no field group definitions go there.

## Folder Structure

```
inc/
  acf-fields.php              ← loader only (require_once each file below)
  acf/
    helpers.php               ← all _tab(), _text(), _group(), etc. helpers (load first)
    options.php               ← Options Page groups (Topbar, Header, Footer)
    front-page.php            ← Front Page groups (Hero, Story, Events, Resources, Support)
    shared-sections.php       ← Sections used on 2+ templates (Services, Impact, Partners, CTA Contact)
    template-donate.php       ← Donate page template groups
    template-get-support.php  ← Get Support page template groups
    template-get-involved.php ← Get Involved page template groups
    template-{slug}.php       ← one file per new page template
```

## Rule: Adding a New Page Template

1. Create `inc/acf/template-{slug}.php`
2. Add a doc comment listing the groups defined and which shared sections it also uses
3. Add `require_once $acf_dir . 'template-{slug}.php';` to `inc/acf-fields.php`
4. Do NOT define field groups inline in `acf-fields.php`

## File Template

```php
<?php
/**
 * ACF Field Groups — {Page Name} Page Template
 * File: page-templates/template-{slug}.php
 * Covers: {Group Name 1}, {Group Name 2}
 *
 * Also uses: {Shared Section} (see shared-sections.php)
 */

_group( 'group_{slug}_hero', '{Page Name} Hero', [
    // fields...
], _loc( 'template-{slug}' ) );
```

## Rule: Shared vs Page-Specific

| Situation | Where to define |
|-----------|----------------|
| Group appears on only one page template | `inc/acf/template-{slug}.php` |
| Group appears on 2+ page templates | `inc/acf/shared-sections.php` |
| Group is on the Options Page | `inc/acf/options.php` |
| Group is front page only | `inc/acf/front-page.php` |

## Notes
- `helpers.php` must always be required first — all other files depend on it
- Field keys and names must never be renamed after first use (ACF stores them in the database)
- Helper functions (`_tab`, `_text`, `_group`, etc.) are defined once in `helpers.php` only
