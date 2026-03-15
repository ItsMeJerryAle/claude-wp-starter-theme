# Skill: ACF Options Page — Auto Field Registration from Screenshot

## 1. Purpose
When a user provides a screenshot of a **global/site-wide component** (topbar, announcement bar, footer notice, cookie banner, etc.), automatically:
1. Identify all editable content areas from the screenshot.
2. Register the corresponding ACF field group on the **ACF Options Page**.
3. Output the template part that reads from `get_field('field_name', 'option')`.

## 2. When to Use This Skill
Use this skill (options page registration) for components that appear **sitewide**, not tied to a specific page or post:
- Topbar / announcement bar
- Header settings (logo, phone, CTA button)
- Footer columns and copyright
- Cookie consent banners
- Global CTA strips
- Social media links

Use `wp-acf-integration.md` instead for **page-specific** field groups (Hero, FAQ, etc.).

## 3. Prerequisites — Options Page Setup
Ensure `inc/acf-fields.php` includes the options page registration. Add once at the top:

```php
if ( function_exists('acf_add_options_page') ) {
    acf_add_options_page( array(
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ) );
}
```

## 4. Field Width Rules
Every field array must include a `wrapper` key to control column layout in the ACF admin UI.

| Field Type                                      | `wrapper width` |
|-------------------------------------------------|-----------------|
| `textarea`, `wysiwyg`                           | `100`           |
| `image`, `gallery`, `file`                      | `100`           |
| `repeater`, `flexible_content`, `group`         | `100`           |
| `text`, `url`, `email`, `number`, `password`    | `50`            |
| `select`, `radio`, `button_group`               | `50`            |
| `color_picker`, `date_picker`                   | `50`            |
| `true_false` toggle                             | `50`            |
| Three small peer fields (e.g. 3 color pickers)  | `33`            |

## 5. Grouping Fields with Tabs
Use `tab` type fields to cluster related fields inside the ACF admin panel. Insert a tab before each logical cluster.

```php
array(
    'key'       => 'field_{slug}_tab_{name}',
    'label'     => 'Tab Label',
    'type'      => 'tab',
    'placement' => 'top',   // 'top' or 'left'
),
```

**Common tab groupings for global components:**

| Component    | Suggested Tabs                          |
|--------------|-----------------------------------------|
| Topbar       | Content / Style                         |
| Header       | Branding / Navigation / CTA             |
| Footer       | Columns / Bottom Bar / Social           |
| Cookie Banner | Content / Style / Behaviour            |

## 6. Workflow — Screenshot to Code

### Step 1: Analyze the Screenshot
Identify every piece of **editable content** visible in the component:

| Visual Element         | ACF Field Type  | Width |
|------------------------|-----------------|-------|
| Short text / label     | `text`          | `50`  |
| Paragraph / rich text  | `textarea` or `wysiwyg` | `100` |
| URL / link             | `url`           | `50`  |
| Button label + URL     | `text` + `url`  | `50` each (pair on same row) |
| Image / logo           | `image`         | `100` |
| Toggle show/hide       | `true_false`    | `50`  |
| Color picker           | `color_picker`  | `50`  |
| Two color pickers      | two `color_picker` | `50` each |
| Three peer fields      | any type        | `33` each |
| Repeater items         | `repeater`      | `100` |

### Step 2: Generate Field Group Key Convention
- Group key: `group_{component_slug}` → e.g., `group_topbar`
- Field key: `field_{component_slug}_{field_name}` → e.g., `field_topbar_message`
- Field name (slug): `{component_slug}_{field_name}` → e.g., `topbar_message`
- Tab key: `field_{component_slug}_tab_{tab_name}` → e.g., `field_topbar_tab_style`

### Step 3: Output Two Code Blocks

#### Block A — `inc/acf-fields.php` (add to existing file)
```php
// -----------------------------------------------
// Topbar / Announcement Bar — Options Page Fields
// -----------------------------------------------
if ( function_exists('acf_add_local_field_group') ) :

acf_add_local_field_group( array(
    'key'    => 'group_topbar',
    'title'  => 'Topbar / Announcement Bar',
    'fields' => array(

        // ── Tab: Content ──────────────────────────────
        array(
            'key'       => 'field_topbar_tab_content',
            'label'     => 'Content',
            'type'      => 'tab',
            'placement' => 'top',
        ),
        array(
            'key'           => 'field_topbar_enabled',
            'label'         => 'Show Topbar',
            'name'          => 'topbar_enabled',
            'type'          => 'true_false',
            'default_value' => 1,
            'ui'            => 1,
            'wrapper'       => array( 'width' => '50' ),
        ),
        array(
            'key'           => 'field_topbar_dismissible',
            'label'         => 'Allow Dismiss (show × button)',
            'name'          => 'topbar_dismissible',
            'type'          => 'true_false',
            'default_value' => 1,
            'ui'            => 1,
            'wrapper'       => array( 'width' => '50' ),
        ),
        array(
            'key'     => 'field_topbar_message',
            'label'   => 'Message',
            'name'    => 'topbar_message',
            'type'    => 'text',
            'wrapper' => array( 'width' => '100' ),
        ),

        // ── Tab: Style ────────────────────────────────
        array(
            'key'       => 'field_topbar_tab_style',
            'label'     => 'Style',
            'type'      => 'tab',
            'placement' => 'top',
        ),
        array(
            'key'           => 'field_topbar_bg_color',
            'label'         => 'Background Color',
            'name'          => 'topbar_bg_color',
            'type'          => 'color_picker',
            'default_value' => '#203942',
            'wrapper'       => array( 'width' => '50' ),
        ),
        array(
            'key'           => 'field_topbar_text_color',
            'label'         => 'Text Color',
            'name'          => 'topbar_text_color',
            'type'          => 'color_picker',
            'default_value' => '#FBEBBF',
            'wrapper'       => array( 'width' => '50' ),
        ),

    ),
    'location' => array(
        array(
            array(
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'theme-settings',
            ),
        ),
    ),
) );

endif;
```

#### Block B — `template-parts/components/topbar.php`
```php
<?php
$enabled     = get_field( 'topbar_enabled', 'option' );
$message     = get_field( 'topbar_message', 'option' );
$dismissible = get_field( 'topbar_dismissible', 'option' );
$bg_color    = get_field( 'topbar_bg_color', 'option' ) ?: '#203942';
$text_color  = get_field( 'topbar_text_color', 'option' ) ?: '#FBEBBF';

if ( ! $enabled || ! $message ) return;
?>

<div id="site-topbar"
     class="relative w-full px-6 py-2 text-sm text-center font-barlow-condensed"
     style="background-color: <?php echo esc_attr( $bg_color ); ?>; color: <?php echo esc_attr( $text_color ); ?>;">

    <span><?php echo esc_html( $message ); ?></span>

    <?php if ( $dismissible ) : ?>
        <button type="button" id="topbar-close"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-lg leading-none opacity-70 hover:opacity-100 transition-opacity"
                aria-label="<?php esc_attr_e( 'Dismiss', 'starter_theme' ); ?>">
            &times;
        </button>
    <?php endif; ?>
</div>

<script>
(function () {
    var bar = document.getElementById('site-topbar');
    var close = document.getElementById('topbar-close');
    if ( ! bar ) return;
    if ( sessionStorage.getItem('topbar_dismissed') ) { bar.style.display = 'none'; return; }
    if ( close ) {
        close.addEventListener('click', function () {
            bar.style.display = 'none';
            sessionStorage.setItem('topbar_dismissed', '1');
        });
    }
})();
</script>
```

#### Block C — Include in `header.php`
```php
<?php get_template_part( 'template-parts/components/topbar' ); ?>
```

## 7. Adapting to Other Global Components

| Component          | Slug            | Tabs                     | Full-width Fields               |
|--------------------|-----------------|--------------------------|----------------------------------|
| Announcement bar   | `topbar`        | Content / Style          | message                         |
| Header             | `header`        | Branding / Navigation / CTA | —                            |
| Footer             | `footer`        | Columns / Bottom Bar     | col_text (textarea), copyright  |
| Cookie banner      | `cookie_banner` | Content / Style / Behaviour | message                      |
| Promo ribbon       | `promo_ribbon`  | Content / Style          | —                               |

## 8. Reading Values in Templates
Always use the `'option'` second argument:
```php
$value = get_field( 'field_name', 'option' );
```

## 9. Export Checklist
- [ ] `export/starter_theme/inc/acf-fields.php` — options page setup + field group added
- [ ] `export/starter_theme/template-parts/components/{name}.php` — template part
- [ ] `export/starter_theme/header.php` — `get_template_part()` call added
