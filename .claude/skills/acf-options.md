# Skill: ACF Options Page — Field Registration (Global Components)

## 1. Purpose
When a user provides a screenshot of a **global/sitewide component** (topbar, header, footer, cookie banner, etc.), automatically:
1. Identify all editable content areas from the screenshot.
2. Register the corresponding ACF field group on the **ACF Options Page**.
3. Output the template part that reads via `get_field('field_name', 'option')`.

> For **page-specific** field groups (Hero, FAQ, etc.), use `skills/acf-fields.md` instead.

## 2. When to Use
Use for components that appear **sitewide**, not tied to a specific page:
- Topbar / announcement bar
- Header settings (logo, CTA button)
- Footer columns and copyright
- Cookie consent banners
- Global CTA strips
- Social media links

## 3. Theme Settings Page
This theme uses a custom admin page (`inc/theme-settings-page.php`) with tab-based navigation instead of ACF's native options sub-pages. Field groups are rendered via `acf_form()` with explicit `field_groups`. See the current tab structure:

| Tab slug | Label | Groups |
|---|---|---|
| `site` | Site Settings | `group_site_settings` |
| `header` | Header & Topbar | `group_topbar`, `group_header` |
| `footer` | Footer | `group_footer` |

To add a new options group: register it in `inc/acf/options.php` using `_loc('options')`, then add it to the relevant tab in `inc/theme-settings-page.php`.

## 4. Field Width Rules

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

## 5. Key Naming Convention
- Group key: `group_{slug}` → e.g. `group_topbar`
- Field key: `field_{slug}_{name}` → e.g. `field_topbar_message`
- Field name: `{slug}_{name}` → e.g. `topbar_message`
- Tab key: `field_{slug}_tab_{tab}` → e.g. `field_topbar_tab_style`

## 6. Tab Groupings for Global Components

| Component | Suggested Tabs |
|---|---|
| Topbar | Content / Style |
| Header | Branding / Navigation / CTA |
| Footer | Newsletter / Legal |
| Cookie Banner | Content / Style / Behaviour |

## 7. Reading Values in Templates
Always pass `'option'` as the second argument:
```php
$value = get_field( 'field_name', 'option' );
```

## 8. Component → Field Type Mapping

| Visual Element | ACF Field Type | Width |
|---|---|---|
| Short text / label | `text` | `50` |
| Paragraph / rich text | `textarea` or `wysiwyg` | `100` |
| URL / link | `url` | `50` |
| Button label + URL | `text` + `url` | `50` each |
| Image / logo | `image` | `100` |
| Toggle show/hide | `true_false` | `50` |
| Color picker | `color_picker` | `50` |
| Repeater items | `repeater` | `100` |
