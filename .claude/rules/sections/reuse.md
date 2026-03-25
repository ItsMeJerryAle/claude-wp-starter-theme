# Section Reuse Rule

When the same section layout is needed across multiple page templates, **do not create a new partial file per page**. Instead, make the partial data-agnostic via `$args` and let each page template supply its own values.

## Pattern

### The partial (`template-parts/sections/section-name.php`)
- Contains **no direct `get_field()` calls**
- Reads exclusively from `$args`
- Documents expected keys in a header comment

```php
/**
 * Expected $args keys:
 *   heading  (string)
 *   btn_text (string)
 *   btn_url  (string)
 *   bg_image (string) — full URL
 */
$heading  = $args['heading']  ?? 'Default Heading';
$btn_text = $args['btn_text'] ?? 'Learn More';
$btn_url  = $args['btn_url']  ?? '#';
$bg_image = $args['bg_image'] ?? '/wp-content/uploads/placeholder.png';
```

### The page template (`page-templates/template-name.php`)
- Fetches its own ACF fields
- Passes them into the shared partial via the third `$args` parameter

```php
get_template_part( 'template-parts/sections/hero-inner', null, array(
    'heading'  => get_field( 'my_page_heading' )  ?: 'Default',
    'btn_text' => get_field( 'my_page_btn_text' ) ?: 'Learn More',
    'btn_url'  => get_field( 'my_page_btn_url' )  ?: '#',
    'bg_image' => get_field( 'my_page_bg_image' ) ?: '/wp-content/uploads/placeholder.png',
) );
```

### The ACF group
- Register a **separate ACF field group** per page template with its own field names
- Scope it to that page template via location rule: `page_template == page-templates/template-name.php`
- The group only appears on the correct page editor — no meta box bleed across pages

## Decision Guide

| Situation | Action |
|-----------|--------|
| Same layout, different content per page | Reuse partial via `$args` — add ACF group per template |
| Layout differs significantly between pages | Create a new partial file |
| Section only ever appears on one page | `get_field()` directly inside the partial is fine |

## Existing Reusable Partials

| Partial | `$args` keys | Used by |
|---------|-------------|---------|
| `hero-inner.php` | `heading`, `description`, `btn_text`, `btn_url` | `template-get-support.php`, `single-service-default.php` |
| `application-process.php` | `eyebrow`, `heading`, `btn_text`, `btn_url`, `steps`, `theme` (`light`\|`dark`) | `template-get-support.php`, `single-service-apply-for-funds.php`, `single-service-default.php` |
| `faq-section.php` | `eyebrow`, `heading`, `items` (array of `faq_question`/`faq_answer`) | `single-service-default.php` |

> **Update this table** every time a partial is converted to `$args`-based or a new page template reuses an existing one.

## Hero Background Image Rule

**All hero sections on inner pages use the page's WordPress Featured Image as the background — no ACF background image field.**

- Set the Featured Image on the page in the WordPress editor (right sidebar)
- The partial calls `get_the_post_thumbnail_url( get_the_ID(), 'full' )` internally
- Falls back to the default hero image if no featured image is set
- Do **not** add a background image ACF field to any hero group
