# Skill: Screenshot-to-Component Workflow

## 1. Analyze the Screenshot
Identify the section type (Hero, FAQ, Cards, etc.) and every piece of editable content.

## 2. File Placement
- Section partials: `template-parts/sections/{name}.php`
- Component partials (header/footer elements): `template-parts/components/{name}.php`

## 3. Implementation Checklist
- Use `tail_` prefix for all custom PHP functions
- Use `get_template_part()` to include the partial in page templates — never `include`/`require`
- Register ACF fields in `inc/acf/template-{slug}.php` (see `rules/wordpress/acf-structure.md`)
- Add `data-animate` + `data-delay` to section headers and cards (hero sections are exempt)
- Meet all standards in `rules/sections/quality.md` before considering the section complete
- Check `rules/sections/reuse.md` before creating a new partial — reuse existing ones via `$args`
