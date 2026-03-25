# Theme Export & Packaging Rules

## Target Destination
All production-ready files live directly in the theme folder at the repo root:
`starter_theme/`

The `.claude/` folder sits alongside `starter_theme/` in the same working directory — this lets the whole repo be dropped into a WordPress `wp-content/themes/` directory and work immediately.

## Export Requirements
1. **Clean Slate:** `starter_theme/` should only contain final theme files (PHP, CSS, JS, Assets). It should NOT contain `.claude/`, `node_modules`, or any local config files.
2. **Theme Header:** Ensure `style.css` has the correct Theme Name, URI, and Author details.
3. **Structure:**
   - `starter_theme/template-parts/`
   - `starter_theme/inc/`
   - `starter_theme/assets/`
4. **Final Step:** When a section is "finalized" via the screenshot workflow, Claude should confirm: *"This file is ready at `starter_theme/...`"*
