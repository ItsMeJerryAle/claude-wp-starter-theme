# WordPress + Tailwind Agentic Theme Builder

An AI-powered WordPress theme development setup using **Claude Code**. Drop in a screenshot, describe what you want, and Claude builds production-ready PHP/Tailwind components — complete with ACF field registration, dummy data, and export-ready files.

---

## What This Is

This is not a WordPress plugin or theme you install directly. It is a **Claude Code project workspace** — a folder structure that gives Claude persistent rules, skills, and site-specific context so it can act as a knowledgeable WordPress developer across multiple conversations.

All generated theme files are written to `export/starter_theme/` and are ready to zip and upload to WordPress.

---

## Requirements

- [Claude Code](https://claude.ai/claude-code) (CLI) — installed and authenticated
- A code editor (VS Code recommended — Claude Code has a native extension)
- WordPress site (local or remote) with:
  - **Advanced Custom Fields (ACF) PRO** — for field registration
  - PHP 8.2+, WordPress 6.x

---

## Getting Started

### 1. Clone or copy this repo

```bash
git clone <repo-url> my-project
cd my-project
```

### 2. Open in VS Code and start Claude Code

```bash
code .
claude
```

Claude will automatically load `.claude/CLAUDE.md` and all referenced rules on startup.

### 3. Adapt for your site

Before building, update these files for your project:

| File | What to change |
|------|---------------|
| `.claude/CLAUDE.md` | Project name, stack notes |
| `.claude/rules/frontend/tailwind.md` | Your brand colors, fonts, max-widths |
| `export/starter_theme/style.css` | Theme Name, Author, URI |

### 4. Create your site-specific rules file

Ask Claude:
> *"Create a new site-specific rules file for my theme called `theme-mysite.md` and add it to CLAUDE.md"*

Claude will create `.claude/rules/frontend/theme-mysite.md` and keep it updated as you build.

---

## Folder Structure

```
.
├── .claude/
│   ├── CLAUDE.md                        # Master instructions loaded on every session
│   ├── settings.json                    # Project metadata
│   ├── rules/
│   │   ├── code-style.md                # PHP/WP coding standards (prefixes, escaping, etc.)
│   │   ├── export-logic.md              # Where and how to export theme files
│   │   ├── svg-uploads.md               # Reusable rule: enable SVG uploads in WP
│   │   └── frontend/
│   │       ├── tailwind.md              # Design tokens: colors, fonts, max-widths
│   │       └── theme-{sitename}.md      # Site-specific patterns (gitignored)
│   └── skills/
│       ├── wp-component-logic.md        # File placement for template parts
│       ├── wp-acf-integration.md        # ACF fields for page-specific sections
│       ├── wp-acf-options-register.md   # ACF fields for global/options-page components
│       └── wp-cpt-creator.md            # Custom Post Type generator with dummy data
│
├── export/
│   └── starter_theme/                   # ← Production theme files go here
│       ├── style.css
│       ├── functions.php
│       ├── header.php
│       ├── footer.php
│       ├── index.php
│       ├── front-page.php
│       ├── inc/
│       │   ├── enqueues.php
│       │   ├── acf-fields.php
│       │   └── cpt-*.php
│       └── template-parts/
│           ├── components/
│           └── sections/
│
└── README.md
```

---

## How to Use Claude

### Build a section from a screenshot

Paste a screenshot directly into the chat:
> *"Build this hero section"*

Claude will:
1. Analyse the screenshot and identify editable content areas
2. Write the template part in `template-parts/sections/`
3. Register ACF fields in `inc/acf-fields.php` with proper tabs and field widths
4. Update `theme-{sitename}.md` with the new design patterns

### Build a global component (topbar, header, footer)

> *"Build this topbar from the screenshot"*

Claude uses `wp-acf-options-register.md` and registers fields on the **ACF Options Page** instead of a specific page template.

### Create a Custom Post Type

> *"Create a custom post type"*

Claude will ask for the CPT title, then generate:
- CPT registration with full labels and REST support
- ACF short description + label fields
- 5 contextually appropriate dummy posts with content
- Seeder that runs once on `admin_init`

### Apply a reusable rule

> *"Add SVG upload support"*

Claude reads `rules/svg-uploads.md` and applies the exact code pattern to `functions.php`.

---

## Rules System

Rules are markdown files in `.claude/rules/` that Claude reads as persistent instructions.

| Rule file | Purpose |
|-----------|---------|
| `code-style.md` | Enforces `tail_` function prefix, `esc_html` escaping, enqueue placement |
| `export-logic.md` | Tells Claude where to write files and what to exclude from export |
| `frontend/tailwind.md` | Brand colors and fonts injected into every Tailwind config |
| `frontend/theme-{site}.md` | Living document of every site-specific pattern decided during the build |
| `svg-uploads.md` | Reusable snippet — apply to any theme on demand |

### Adding your own rules

Create a `.md` file in `.claude/rules/` and reference it in `CLAUDE.md`:

```markdown
- Refer to `rules/my-rule.md` for ...
```

---

## Skills System

Skills are instruction files in `.claude/skills/` that tell Claude **how to perform a specific type of task**.

| Skill file | Triggered when |
|------------|---------------|
| `wp-component-logic.md` | Building any UI section from a screenshot |
| `wp-acf-integration.md` | Registering ACF fields for page-specific sections |
| `wp-acf-options-register.md` | Registering ACF fields on the Options Page |
| `wp-cpt-creator.md` | User asks to create a Custom Post Type |

### Adding your own skills

Create a `.md` file in `.claude/skills/` describing the task pattern and code blueprint, then reference it in `CLAUDE.md`.

---

## Deploying the Theme

1. Navigate to `export/starter_theme/`
2. Zip the folder contents
3. Upload via **Appearance → Themes → Add New → Upload** in WordPress
4. Activate the theme
5. Install and activate **Advanced Custom Fields PRO**
6. Go to **Theme Settings** (admin menu) to fill in global content
7. Set a static front page under **Settings → Reading**

---

## Tips

- **Update `theme-{site}.md` often** — Claude uses it to stay consistent across sessions. If you change a color or layout pattern, tell Claude and it will update the file.
- **One session = one component** — Claude works best when given focused tasks. Build one section at a time.
- **Screenshot quality matters** — higher resolution screenshots produce more accurate components.
- **CPT seeder runs once** — if you need to re-seed, delete the `tail_{cpt}_seeded` option from the WordPress database or via WP-CLI: `wp option delete tail_service_seeded`
