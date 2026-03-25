# WordPress + Tailwind Starter Theme

**Stack:** PHP 8.2 · WordPress 6.x · Tailwind CSS (Play CDN)
**Context:** Modular theme built from screenshots. Theme files live in `starter_theme/`.

---

## Always Apply

| Rule | Purpose |
|------|---------|
| `rules/wordpress/code-style.md` | PHP naming, escaping, enqueuing standards |
| `rules/frontend/tailwind.md` | Design tokens, animation system, component presets |
| `rules/frontend/theme-bridgewell.md` | Site-specific layout, color, and component decisions — **update after every new pattern** |

---

## Building Sections (from screenshot or description)

Sections are **ACF Blocks** — registered in `inc/blocks.php`, rendered via `template-parts/blocks/`, fields in `inc/acf/blocks/`. Users drag and drop blocks in Gutenberg.

| Rule / Skill | When |
|---|---|
| `rules/sections/quality.md` | **Every block** — performance, accessibility, and best-practice checklist |
| `rules/wordpress/acf-structure.md` | **File structure** — blocks/, options.php, helpers.php layout |
| `skills/component.md` | Screenshot → block workflow (3 files per block) |
| `skills/acf-fields.md` | ACF Block registration blueprint — `acf_register_block_type()`, field group, render template |
| `rules/sections/404.md` | 404 page — fixed layout and hardcoded text |

---

## Global / Sitewide Components

| Rule / Skill | When |
|---|---|
| `skills/acf-options.md` | ACF options fields for sitewide components (topbar, header, footer) |

---

## Custom Post Types

| Rule / Skill | When |
|---|---|
| `skills/cpt.md` | Full CPT scaffolding — **ask for the CPT title before writing any code** |
| `rules/wordpress/cpt-page-template.md` | Scoping a template to a specific CPT post using `page_template ==` |

---

## Media

| Rule | When |
|---|---|
| `rules/wordpress/svg-uploads.md` | Adding SVG upload support to `functions.php` |

---

## Export & Delivery

| Rule | When |
|---|---|
| `rules/wordpress/export.md` | Packaging the theme for delivery |

After completing any component, confirm the file path as `starter_theme/...`
