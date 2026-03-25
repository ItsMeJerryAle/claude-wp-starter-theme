# Section Quality Standards

When generating any section partial from a screenshot or description, every output file must meet the following standards before it is considered complete. These are not optional — treat them as part of the definition of done.

---

## 1. Page Speed / Performance

### Images
- Never use `<img>` with a raw URL where `wp_get_attachment_image()` or `add_image_size()` can provide responsive srcset. For ACF image fields that return a URL, at minimum add `loading="lazy"` and explicit `width`/`height` attributes.
- Background images set via inline `style="background-image: url(...)"` are acceptable for Ken Burns / hero sections, but all other decorative images should use `<img loading="lazy">`.
- Never embed base64 images inline in PHP templates.
- SVG icons used repeatedly (social icons, arrows, checkmarks) should be inline SVG, not `<img>` tags pointing to SVG files, to avoid extra HTTP requests.

### Scripts & Styles
- Do not add `<script>` or `<style>` blocks inside section partials unless the CSS is scoped to a unique keyframe animation that cannot live in `header.php`. All reusable animation CSS is already declared once in `header.php`.
- Never enqueue scripts inside a partial — use `inc/enqueues.php`.
- Do not load Google Fonts inside a section; fonts are already loaded in `inc/enqueues.php`.

### Rendering
- Avoid deeply nested PHP loops (more than 2 levels) when a single `WP_Query` or `get_posts()` call can return the data flat.
- Cache repeated `get_field( ..., 'option' )` calls in a variable at the top of the file — never call the same `get_field` more than once per render.

---

## 2. Accessibility

### Semantic HTML
- Every section must use a `<section>` element with a descriptive `aria-label` **or** contain a visible heading (`<h2>`–`<h4>`) that gives the section its accessible name.
- Use the correct heading hierarchy: page `<h1>` is in the hero. All subsequent sections start at `<h2>`. Cards/sub-items inside a section use `<h3>` or lower.
- Never skip heading levels (e.g. `<h2>` → `<h4>`).
- Do not use `<div>` or `<span>` for interactive elements — use `<button>` for actions and `<a href>` for navigation.

### Images
- Decorative images (backgrounds, overlays, badge logos used purely visually) must have `alt=""`.
- Content images (testimonial portraits, partner logos, card thumbnails) must have a meaningful `alt` that describes the image content — pull from a caption field or post title where possible, never leave it empty.

### Color & Contrast
- Text rendered directly on a background image must have an overlay or gradient that provides sufficient contrast. The existing overlay patterns (dark gradient, `bg-secondary/80 backdrop-blur`) satisfy this — always include one of these when placing text over images.
- Never use color alone to convey meaning (e.g. error states, required fields).

### Interactive Elements
- All `<a>` tags must have either visible text content or an `aria-label`.
- Icon-only buttons/links (social icons, arrow circles, hamburger) must include `aria-label="..."`.
- Accordion / toggle controls must use `aria-expanded` and `aria-controls` attributes updated by the JavaScript handler.
- Focus styles must not be removed (`outline: none` without a replacement is not allowed).

### Forms
- Every `<input>`, `<select>`, and `<textarea>` must have an associated `<label>` (either wrapping or via `for`/`id`). Placeholder text is not a substitute for a label.

---

## 3. Best Practices

### Output Escaping
- Every value output to the page must be escaped with the appropriate function:
  - `esc_html()` — plain text content
  - `esc_url()` — href, src, action attributes
  - `esc_attr()` — all other HTML attributes
  - `wp_kses()` / `wp_kses_post()` — rich text that intentionally contains allowed HTML
- Never use `echo $var` without escaping, even for values that look safe.

### WordPress APIs
- Use `wp_kses( nl2br( esc_html( $text ) ), [ 'br' => [] ] )` for multi-line plain-text fields that need preserved line breaks.
- Use `get_template_part()` for all section includes — never `include` or `require` partial files directly.
- Register all navigation menus in `functions.php` via `register_nav_menus()`. Never hard-code menu HTML unless it is a documented fallback inside `fallback_cb`.

### PHP
- Do not use short echo tags (`<?= ?>`). Use `<?php echo ... ?>` for consistency with the rest of the theme.
- All custom functions must be prefixed with `tail_` (see `rules/code-style.md`).
- Null-coalesce ACF fields to a sensible default: `get_field('foo') ?: 'Default'`. Never pass `null` or `false` directly to output functions.

### Tailwind
- Use design token class names (`bg-primary`, `text-secondary`) — never raw hex utilities (`bg-[#C2D432]`) for brand colors.
- Follow animation rules in `rules/frontend/tailwind.md`: add `data-animate` + `data-delay` to section headers and cards. Hero sections are exempt.
