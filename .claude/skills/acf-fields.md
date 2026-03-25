# Skill: ACF Block — Field Registration & Block Setup

## 1. Objective
Every section is an **ACF Block** — registered via `acf_register_block_type()`, with fields scoped to that block via `param => 'block'`. Users drag and drop blocks in the Gutenberg editor; no manual page-template includes needed.

> For **global/sitewide** components (topbar, header, footer), use `skills/acf-options.md` instead.

---

## 2. File Structure

| File | Purpose |
|------|---------|
| `inc/blocks.php` | All `acf_register_block_type()` calls + custom block category |
| `inc/acf/blocks/{name}.php` | Field group definition scoped to `acf/{name}` |
| `inc/acf-fields.php` | Thin loader — `require_once` blocks files |
| `template-parts/blocks/{name}.php` | Block render template |

---

## 3. Step-by-Step: Adding a New Block

### Step 1 — Register the block type in `inc/blocks.php`

```php
acf_register_block_type( array(
    'name'            => '{name}',
    'title'           => __( '{Title}', 'starter_theme' ),
    'description'     => __( '{One-line description}', 'starter_theme' ),
    'render_template' => 'template-parts/blocks/{name}.php',
    'category'        => 'theme-blocks',
    'icon'            => '{dashicon}',
    'keywords'        => array( '{keyword1}', '{keyword2}' ),
    'supports'        => array( 'align' => false, 'mode' => false ),
) );
```

### Step 2 — Define field group in `inc/acf/blocks/{name}.php`

```php
<?php
/**
 * ACF Field Group — {Title} Block
 * Block: acf/{name}
 * Render: template-parts/blocks/{name}.php
 */

_group( 'group_{name}', '{Title}', [
    _tab( 'field_{name}_tab_content', 'Content' ),
    _text( 'field_{name}_heading', 'Heading', '{name}_heading', 100 ),
    // add more fields...
], array(
    array(
        array( 'param' => 'block', 'operator' => '==', 'value' => 'acf/{name}' ),
    ),
) );
```

### Step 3 — Create the render template `template-parts/blocks/{name}.php`

```php
<?php
/**
 * Block: {Title}
 * Registered in: inc/blocks.php
 * ACF fields: {name}_heading, ...
 */
$heading = get_field( '{name}_heading' ) ?: 'Default Heading';
?>

<section class="bg-white py-16" aria-label="<?php echo esc_attr( $heading ); ?>">
    <div class="max-w-default mx-auto px-4">

        <div data-animate data-delay="0">
            <p class="font-barlow-condensed font-semibold uppercase text-accent text-[22px] leading-none tracking-tight">
                <?php echo esc_html( get_field( '{name}_eyebrow' ) ); ?>
            </p>
            <h2 class="font-barlow-condensed font-semibold uppercase leading-none tracking-tight text-secondary text-5xl xl:text-6xl mt-2">
                <?php echo esc_html( $heading ); ?>
            </h2>
        </div>

    </div>
</section>
```

### Step 4 — Add loader line to `inc/acf-fields.php`

```php
require_once $acf_dir . 'blocks/{name}.php';
```

---

## 4. `inc/blocks.php` — Full File Template

```php
<?php
/**
 * ACF Block Registrations
 * All theme blocks are registered here and rendered via template-parts/blocks/.
 */

// ── Custom Block Category ────────────────────────────────────────────────────
function tail_register_block_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'theme-blocks',
                'title' => __( 'Theme Blocks', 'starter_theme' ),
                'icon'  => null,
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'tail_register_block_category' );


// ── Register Block Types ─────────────────────────────────────────────────────
function tail_register_acf_blocks() {
    if ( ! function_exists( 'acf_register_block_type' ) ) return;

    $blocks = array(
        array(
            'name'            => 'hero',
            'title'           => __( 'Hero', 'starter_theme' ),
            'description'     => __( 'Full-width Ken Burns hero section.', 'starter_theme' ),
            'render_template' => 'template-parts/blocks/hero.php',
            'icon'            => 'cover-image',
            'keywords'        => array( 'hero', 'banner' ),
        ),
        // Add new blocks here following the same array shape
    );

    foreach ( $blocks as $block ) {
        acf_register_block_type( array_merge( $block, array(
            'category' => 'theme-blocks',
            'supports' => array( 'align' => false, 'mode' => false ),
        ) ) );
    }
}
add_action( 'acf/init', 'tail_register_acf_blocks' );
```

---

## 5. Field Width Rules

| Field Type | `wrapper width` |
|---|---|
| `textarea`, `wysiwyg` | `100` |
| `image`, `gallery`, `file` | `100` |
| `repeater`, `flexible_content`, `group` | `100` |
| `text`, `url`, `email`, `number` | `50` |
| `select`, `radio`, `button_group` | `50` |
| `color_picker`, `date_picker` | `50` |
| `true_false` toggle | `50` |
| Three small peer fields | `33` |

---

## 6. Block Render Template Rules

- Read all fields at the top using `get_field()` with a `?: 'Default'` fallback
- Never call the same `get_field()` more than once — cache in a variable
- Use `<section>` with `aria-label` (or a visible `<h2>`)
- Add `data-animate` + `data-delay` to section headers and cards (hero blocks exempt)
- Do not add `<script>` or `<style>` blocks — use `inc/enqueues.php` and `header.php`

---

## 7. Dashicon Suggestions

| Section type | Icon |
|---|---|
| Hero / Banner | `cover-image` |
| Services | `clipboard` |
| Story / About | `format-quote` |
| Events | `calendar` |
| Resources / Posts | `book` |
| Partners / Logos | `groups` |
| Impact / Stats | `chart-bar` |
| FAQ | `editor-help` |
| CTA / Contact | `megaphone` |
