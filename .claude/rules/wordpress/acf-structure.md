# ACF Structure — Blocks & File Layout

All sections are **ACF Blocks**. Field group definitions live in `inc/acf/blocks/`. The main `inc/acf-fields.php` is a thin loader only.

## Folder Structure

```
inc/
  blocks.php                  ← all acf_register_block_type() calls + block category
  acf-fields.php              ← loader only (require_once each file below)
  acf/
    helpers.php               ← _tab(), _text(), _group(), etc. helpers (load first)
    options.php               ← Options Page groups (Topbar, Header, Footer)
    blocks/                   ← one file per ACF block
      hero.php
      services.php
      story.php
      impact.php
      events.php
      resources.php
      partners.php
      support.php
      {name}.php              ← add one file per new block here

template-parts/
  blocks/                     ← block render templates (one per ACF block)
    hero.php
    services-section.php
    ...
  components/                 ← non-block global components (topbar, header, footer)
```

## Rule: Adding a New Block

1. Add `acf_register_block_type()` entry to `inc/blocks.php`
2. Create `inc/acf/blocks/{name}.php` with the field group scoped to `acf/{name}`
3. Create `template-parts/blocks/{name}.php` as the render template
4. Add `require_once $acf_dir . 'blocks/{name}.php';` to `inc/acf-fields.php`

## Field Group Location for Blocks

```php
_group( 'group_{name}', '{Title}', [
    // fields...
], array(
    array(
        array( 'param' => 'block', 'operator' => '==', 'value' => 'acf/{name}' ),
    ),
) );
```

## File Template — `inc/acf/blocks/{name}.php`

```php
<?php
/**
 * ACF Field Group — {Title} Block
 * Block: acf/{name}
 * Render: template-parts/blocks/{name}.php
 */

_group( 'group_{name}', '{Title}', [
    _tab( 'field_{name}_tab_content', 'Content' ),
    _text( 'field_{name}_heading', 'Heading', '{name}_heading', 50 ),
    // more fields...
], array(
    array(
        array( 'param' => 'block', 'operator' => '==', 'value' => 'acf/{name}' ),
    ),
) );
```

## Rule: Where to Define Field Groups

| Situation | Where to define |
|-----------|----------------|
| Section that is a Gutenberg block | `inc/acf/blocks/{name}.php` |
| Global/sitewide component | `inc/acf/options.php` |

## Notes
- `helpers.php` must always be required first — all other files depend on it
- Field keys and names must never be renamed after first use (ACF stores them in the database)
- Block field groups use an inline location array (not `_loc()`) — `_loc()` is for page template scoping only
- See `skills/acf-fields.md` for the full block registration blueprint
