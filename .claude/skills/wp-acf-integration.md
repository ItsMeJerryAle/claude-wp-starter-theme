# Skill: Automatic ACF Field Registration

## 1. Objective
When generating a UI component, Claude must also generate the PHP code required to register those ACF fields automatically. This removes the need for manual dashboard setup.

## 2. Implementation Strategy
- **File Placement:** ACF registration code should be placed in `export/starter_theme/inc/acf-fields.php`.
- **Function:** Use `acf_add_local_field_group()`.
- **Logic:** Fields must be assigned to specific templates or the front page.

## 3. Field Width Rules
Every field array must include a `wrapper` key to control column layout in the ACF admin UI.

| Field Type                                      | `wrapper width` |
|-------------------------------------------------|-----------------|
| `textarea`, `wysiwyg`                           | `100`           |
| `image`, `gallery`, `file`                      | `100`           |
| `repeater`, `flexible_content`, `group`         | `100`           |
| `text`, `url`, `email`, `number`, `password`    | `50`            |
| `select`, `radio`, `button_group`               | `50`            |
| `color_picker`, `date_picker`, `date_time_picker` | `50`          |
| `true_false` toggle                             | `50`            |
| Three small peer fields (e.g. 3 color pickers)  | `33`           |

```php
// Example — half-width text field
array(
    'key'     => 'field_hero_title',
    'label'   => 'Title',
    'name'    => 'hero_title',
    'type'    => 'text',
    'wrapper' => array( 'width' => '50' ),
),

// Example — full-width textarea
array(
    'key'     => 'field_hero_body',
    'label'   => 'Body Text',
    'name'    => 'hero_body',
    'type'    => 'textarea',
    'rows'    => 4,
    'wrapper' => array( 'width' => '100' ),
),
```

## 4. Grouping Fields with Tabs
Use `tab` type fields to split a large field group into logical sections inside the ACF admin panel. Insert a tab before each cluster of related fields.

```php
// Tab field — no key/name needed, just label
array(
    'key'      => 'field_hero_tab_content',
    'label'    => 'Content',
    'type'     => 'tab',
    'placement' => 'top',   // 'top' or 'left'
),
```

**Common tab groupings by section type:**

| Section      | Suggested Tabs                          |
|--------------|-----------------------------------------|
| Hero         | Content / Buttons / Background          |
| Card / CTA   | Content / Link / Style                  |
| FAQ          | Content / Display Options               |
| Team Member  | Info / Photo / Social Links             |
| Testimonial  | Quote / Author / Style                  |

## 5. Code Blueprint

```php
acf_add_local_field_group( array(
    'key'   => 'group_hero_section',
    'title' => 'Hero Section',
    'fields' => array(

        // ── Tab: Content ──────────────────────────
        array(
            'key'       => 'field_hero_tab_content',
            'label'     => 'Content',
            'type'      => 'tab',
            'placement' => 'top',
        ),
        array(
            'key'     => 'field_hero_heading',
            'label'   => 'Heading',
            'name'    => 'hero_heading',
            'type'    => 'textarea',
            'rows'    => 2,
            'wrapper' => array( 'width' => '100' ),
        ),
        array(
            'key'     => 'field_hero_subtext',
            'label'   => 'Sub-text',
            'name'    => 'hero_subtext',
            'type'    => 'textarea',
            'rows'    => 3,
            'wrapper' => array( 'width' => '100' ),
        ),

        // ── Tab: Buttons ──────────────────────────
        array(
            'key'       => 'field_hero_tab_buttons',
            'label'     => 'Buttons',
            'type'      => 'tab',
            'placement' => 'top',
        ),
        array(
            'key'     => 'field_hero_btn1_text',
            'label'   => 'Primary Button — Label',
            'name'    => 'hero_btn1_text',
            'type'    => 'text',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key'     => 'field_hero_btn1_url',
            'label'   => 'Primary Button — URL',
            'name'    => 'hero_btn1_url',
            'type'    => 'url',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key'     => 'field_hero_btn2_text',
            'label'   => 'Secondary Button — Label',
            'name'    => 'hero_btn2_text',
            'type'    => 'text',
            'wrapper' => array( 'width' => '50' ),
        ),
        array(
            'key'     => 'field_hero_btn2_url',
            'label'   => 'Secondary Button — URL',
            'name'    => 'hero_btn2_url',
            'type'    => 'url',
            'wrapper' => array( 'width' => '50' ),
        ),

        // ── Tab: Background ───────────────────────
        array(
            'key'       => 'field_hero_tab_bg',
            'label'     => 'Background',
            'type'      => 'tab',
            'placement' => 'top',
        ),
        array(
            'key'           => 'field_hero_bg_image',
            'label'         => 'Background Image',
            'name'          => 'hero_bg_image',
            'type'          => 'image',
            'return_format' => 'url',
            'preview_size'  => 'medium',
            'wrapper'       => array( 'width' => '100' ),
        ),

    ),
    'location' => array(
        array(
            array(
                'param'    => 'page_type',
                'operator' => '==',
                'value'    => 'front_page',
            ),
        ),
    ),
) );
```

## 6. Skill Scope
This skill handles **page-specific** field groups (Hero, FAQ, Testimonials, etc.).
For **global/sitewide** components (topbar, footer, header settings), use `skills/wp-acf-options-register.md` instead.
