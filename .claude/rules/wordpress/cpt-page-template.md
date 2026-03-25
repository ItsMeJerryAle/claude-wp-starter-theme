# CPT Page Template Rule

Custom page templates can be assigned to individual CPT posts (not just WordPress pages).
This avoids ACF fields bleeding onto every post of the same type.

## How It Works

1. The CPT is registered with `page-attributes` support — this enables the native WordPress **Template** dropdown in the post editor sidebar
2. The template file declares `Template Name:` and `Template Post Type: {cpt}` headers — WordPress lists it in the dropdown automatically, restricted to that CPT only
3. WordPress saves the selection as `_wp_page_template` post meta natively (no custom save hook needed)
4. The `single_template` filter reads that meta and loads the file from `page-templates/`
5. ACF groups use `page_template == page-templates/single-{cpt}-{slug}.php` location — fields only appear when that template is assigned

## Adding a New CPT-specific Template

### 1. Create the template file with the required headers
```php
<?php
/**
 * Template Name: My Template Name
 * Template Post Type: {cpt}
 */
```
WordPress reads these headers and adds the template to the editor's Template dropdown, restricted to `{cpt}` posts only.

### 2. Register ACF fields scoped to the template
```php
'location' => array(
    array(
        array(
            'param'    => 'page_template',
            'operator' => '==',
            'value'    => 'page-templates/single-{cpt}-{slug}.php',
        ),
    ),
),
```
Or using `_loc()` helper:
```php
_loc( 'single-{cpt}-{slug}' )
```

### 3. Assign in WordPress admin
Open the CPT post → "Page Template" meta box (sidebar) → select the template → Update.

## Currently Implemented

| CPT | Template file | Assigned to |
|-----|---------------|-------------|
| `service` | `page-templates/single-service-apply-for-funds.php` | `/services/apply-for-funds/` |

## Notes
- The meta box is auto-populated — drop a new `single-{cpt}-*.php` file in `page-templates/` and it appears in the selector immediately
- `group_service_details` (card label + short desc) stays on `post_type == service` — it applies to all service posts
- Template-specific ACF groups (FAQ, How We Can Help, Application Process, CTA Contact) use `page_template ==` so they only appear when that template is assigned
