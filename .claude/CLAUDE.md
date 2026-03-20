# Project: WordPress + Tailwind Modular Theme
**Context:** Building a WP starter theme from screenshots.
**Stack:** PHP 8.2, WordPress 6.x, Tailwind CSS (Play CDN).

## Folder References
- Refer to `rules/code-style.md` for PHP/naming standards.
- Refer to `rules/frontend/tailwind.md` for design tokens (fonts/colors).
- Refer to `rules/frontend/theme-bridgewell.md` for site-specific layout, color, and component decisions. **Update this file after every new site-specific pattern is established.**
- Refer to `skills/wp-component-logic.md` for file placement.
- Refer to `skills/wp-cpt-creator.md` when the user asks to create a Custom Post Type. **Always ask for the CPT title first before generating any code.**
- Refer to `rules/404-page.md` when creating a 404 page. Use the hero layout with the fixed texts defined there — no ACF fields required.
- Refer to `rules/section-reuse.md` before creating any new section partial. **If the same layout already exists as a partial, reuse it via `$args` — do not duplicate the file.**
- Refer to `rules/acf-structure.md` when adding ACF fields. **Each page template gets its own file in `inc/acf/`. Never define field groups directly in `inc/acf-fields.php`.**
- Refer to `rules/cpt-page-template.md` when creating a custom template for a specific CPT post. **Use `page_template ==` ACF location, not `post_type ==`, so fields only appear on the assigned post.**

## Export & Delivery
- **Export Directory:** `export-folder/theme_name`
- Refer to `rules/export-logic.md` for packaging instructions.
- After coding a component, Claude should provide the path relative to the export folder.
