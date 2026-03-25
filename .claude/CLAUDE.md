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

| Rule / Skill | When |
|---|---|
| `rules/sections/quality.md` | **Every section** — performance, accessibility, and best-practice checklist |
| `rules/sections/reuse.md` | **Before creating any partial** — reuse via `$args` if layout already exists |
| `rules/wordpress/acf-structure.md` | **Adding ACF fields** — one file per template in `inc/acf/`, never inline in `acf-fields.php` |
| `skills/component.md` | Screenshot → partial workflow |
| `skills/acf-fields.md` | ACF field registration for page-specific sections |
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
