# Skill: ACF Field Registration (Page-Specific)

## 1. Objective
When generating a UI section, also generate the PHP to register its ACF fields automatically — no manual dashboard setup required.

> For **global/sitewide** components (topbar, footer, header), use `skills/acf-options.md` instead.

## 2. File Placement
ACF registration code goes in `inc/acf/template-{slug}.php` (one file per page template).
See `rules/wordpress/acf-structure.md` for the full file structure.

## 3. Field Width Rules

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

## 4. Grouping Fields with Tabs
Use `tab` type fields to split a large field group into logical sections.

```php
array(
    'key'       => 'field_hero_tab_content',
    'label'     => 'Content',
    'type'      => 'tab',
    'placement' => 'top',
),
```

**Common tab groupings:**

| Section | Suggested Tabs |
|---|---|
| Hero | Content / Buttons / Background |
| Card / CTA | Content / Link / Style |
| FAQ | Content / Display Options |
| Team Member | Info / Photo / Social Links |
| Testimonial | Quote / Author / Style |

## 5. Code Blueprint

```php
acf_add_local_field_group( array(
    'key'   => 'group_hero_section',
    'title' => 'Hero Section',
    'fields' => array(

        array( 'key' => 'field_hero_tab_content', 'label' => 'Content', 'type' => 'tab', 'placement' => 'top' ),
        array(
            'key'     => 'field_hero_heading',
            'label'   => 'Heading',
            'name'    => 'hero_heading',
            'type'    => 'textarea',
            'rows'    => 2,
            'wrapper' => array( 'width' => '100' ),
        ),

        array( 'key' => 'field_hero_tab_buttons', 'label' => 'Buttons', 'type' => 'tab', 'placement' => 'top' ),
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

        array( 'key' => 'field_hero_tab_bg', 'label' => 'Background', 'type' => 'tab', 'placement' => 'top' ),
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
            array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ),
        ),
    ),
) );
```
