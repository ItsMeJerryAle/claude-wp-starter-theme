# Skill: Screenshot-to-Block Workflow

## 1. Analyze the Screenshot
Identify the section type (Hero, FAQ, Cards, etc.) and every piece of editable content.

## 2. Output: Three Files Per Block

| File | Purpose |
|------|---------|
| `template-parts/blocks/{name}.php` | Block render template |
| `inc/acf/blocks/{name}.php` | ACF field group scoped to `acf/{name}` |
| `inc/blocks.php` *(update)* | Add `acf_register_block_type()` entry |

> Global components (topbar, header, footer) are **not** blocks — use `skills/acf-options.md` and `template-parts/components/`.

## 3. Implementation Checklist
- Register the block in `inc/blocks.php` → category `theme-blocks`, `mode => false`
- Scope the field group: `param => 'block', value => 'acf/{name}'`
- Loader: add `require_once $acf_dir . 'blocks/{name}.php';` to `inc/acf-fields.php`
- Block template reads all fields at top with `?: 'Default'` fallbacks — no `get_field()` calls scattered inline
- Use `tail_` prefix for all custom PHP functions
- Add `data-animate` + `data-delay` to section headers and cards (hero blocks exempt)
- Meet all standards in `rules/sections/quality.md` before considering the block complete
