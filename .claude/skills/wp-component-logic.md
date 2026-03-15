# Skill: Screenshot-to-Component Workflow

## 1. Analysis
When a user uploads a screenshot, identify the section type (Hero, FAQ, etc.).

## 2. File Creation
Save all UI sections to: `/template-parts/sections/[name].php`.

## 3. Implementation
- Use `wp-tail-` prefix for custom CSS.
- Ensure `the_custom_logo()` and `wp_nav_menu()` are used for headers.
- Use `get_template_part()` to include components in `index.php`.