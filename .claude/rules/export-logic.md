# Theme Export & Packaging Rules

## Target Destination
All production-ready files must be mirrored or prepared for the final theme folder located at:
`export/starter_theme/`

## Export Requirements
1. **Clean Slate:** The export folder should only contain the final theme files (PHP, CSS, JS, Assets). It should NOT contain `.claude/`, `node_modules`, or any local config files.
2. **Theme Header:** Ensure `style.css` in the export folder has the correct Theme Name, URI, and Author details.
3. **Structure Mirroring:**
   - `export/starter_theme/template-parts/`
   - `export/starter_theme/inc/`
   - `export/starter_theme/assets/`
4. **Final Step:** When a section is "finalized" via the screenshot workflow, Claude should confirm: *"This file is ready to be saved/moved to export/starter_theme/..."*