# Skill: CPT Creator

## 1. Trigger
When a user asks to create a Custom Post Type (CPT), **always ask first:**
> "What is the CPT title? (e.g. News, Events, Team Members)"

Derive everything else from the title:
- **Slug:** lowercase, spaces → hyphens → e.g. `team-members`
- **Singular:** title as-is → e.g. `Team Member`
- **Plural:** title as-is → e.g. `Team Members`
- **Key prefix:** first word(s) snake_case → e.g. `team_member`

---

## 2. Files to Create / Update

| Action | File |
|---|---|
| Create | `inc/cpt-{slug}.php` — CPT registration + ACF fields + seeder |
| Update | `functions.php` — add `require_once` for the new file |

---

## 3. File Blueprint — `inc/cpt-{slug}.php`

Three sections: **CPT registration**, **ACF short description field**, **dummy data seeder**.

```php
<?php
/**
 * CPT: {Plural Label}
 */

// ── 1. Register CPT ───────────────────────────────────────────────────────────
function tail_register_cpt_{key}() {
    $labels = array(
        'name'          => _x( '{Plural}', 'post type general name', 'starter_theme' ),
        'singular_name' => _x( '{Singular}', 'post type singular name', 'starter_theme' ),
        'add_new_item'  => __( 'Add New {Singular}', 'starter_theme' ),
        'edit_item'     => __( 'Edit {Singular}', 'starter_theme' ),
        'view_item'     => __( 'View {Singular}', 'starter_theme' ),
        'search_items'  => __( 'Search {Plural}', 'starter_theme' ),
        'not_found'     => __( 'No {plural} found.', 'starter_theme' ),
        'menu_name'     => _x( '{Plural}', 'admin menu', 'starter_theme' ),
    );

    register_post_type( '{slug}', array(
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'    => 'dashicons-{icon}',
        'rewrite'      => array( 'slug' => '{slug}' ),
    ) );
}
add_action( 'init', 'tail_register_cpt_{key}' );


// ── 2. ACF — Short Description Field ─────────────────────────────────────────
add_action( 'acf/init', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_{key}_details',
        'title' => '{Singular} Details',
        'fields' => array(
            array(
                'key'          => 'field_{key}_short_desc',
                'label'        => 'Short Description',
                'name'         => '{key}_short_desc',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => 'A brief summary shown in listing cards (1–2 sentences).',
                'wrapper'      => array( 'width' => '100' ),
            ),
        ),
        'location' => array(
            array(
                array( 'param' => 'post_type', 'operator' => '==', 'value' => '{slug}' ),
            ),
        ),
    ) );
} );


// ── 3. Dummy Data Seeder ──────────────────────────────────────────────────────
add_action( 'admin_init', function() {
    if ( get_option( 'tail_{key}_seeded' ) ) return;
    if ( get_posts( array( 'post_type' => '{slug}', 'numberposts' => 1 ) ) ) {
        update_option( 'tail_{key}_seeded', true );
        return;
    }

    $dummy = array(
        array( 'title' => '{Dummy Title 1}', 'content' => '{Dummy body 1.}', 'short_desc' => '{Short desc 1.}' ),
        array( 'title' => '{Dummy Title 2}', 'content' => '{Dummy body 2.}', 'short_desc' => '{Short desc 2.}' ),
        array( 'title' => '{Dummy Title 3}', 'content' => '{Dummy body 3.}', 'short_desc' => '{Short desc 3.}' ),
        array( 'title' => '{Dummy Title 4}', 'content' => '{Dummy body 4.}', 'short_desc' => '{Short desc 4.}' ),
        array( 'title' => '{Dummy Title 5}', 'content' => '{Dummy body 5.}', 'short_desc' => '{Short desc 5.}' ),
    );

    foreach ( $dummy as $item ) {
        $post_id = wp_insert_post( array(
            'post_title'   => $item['title'],
            'post_content' => $item['content'],
            'post_status'  => 'publish',
            'post_type'    => '{slug}',
        ) );
        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '{key}_short_desc', $item['short_desc'] );
        }
    }

    update_option( 'tail_{key}_seeded', true );
} );
```

---

## 4. Update `functions.php`

```php
require_once get_template_directory() . '/inc/cpt-{slug}.php';
```

---

## 5. Placeholder Substitution Guide

| Placeholder | Example (News) | Example (Team Members) |
|---|---|---|
| `{slug}` | `news` | `team-members` |
| `{key}` | `news` | `team_member` |
| `{Singular}` | `News Post` | `Team Member` |
| `{Plural}` | `News` | `Team Members` |
| `{plural}` | `news posts` | `team members` |
| `{icon}` | `dashicons-megaphone` | `dashicons-groups` |

### Dashicon suggestions

| CPT type | Dashicon |
|---|---|
| News / Blog | `dashicons-megaphone` |
| Events | `dashicons-calendar` |
| Team Members | `dashicons-groups` |
| Services | `dashicons-clipboard` |
| Projects | `dashicons-portfolio` |
| Testimonials | `dashicons-format-quote` |
| FAQs | `dashicons-editor-help` |
| Resources | `dashicons-book` |

---

## 6. Dummy Content Guidelines

Generate dummy data thematically appropriate to the CPT:
- **News:** real-sounding headlines + 2–3 sentence summaries
- **Events:** event names with date/location in content
- **Team Members:** realistic names + role/bio
- **Testimonials:** quotes + attribution
- **Services:** service name + description paragraphs

Short descriptions: **1–2 sentences**, suitable for a listing card.

---

## 7. Export Checklist
- [ ] `starter_theme/inc/cpt-{slug}.php` — CPT + ACF + seeder
- [ ] `starter_theme/functions.php` — require line added
